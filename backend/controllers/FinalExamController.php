<?php

namespace backend\controllers;

use Yii;
use backend\models\FinalExam;
use backend\models\FinalExam_search;
use backend\models\AcedemicYear;
use backend\models\ClassInfo;
use backend\models\ClassSubject;
use backend\models\AddClass;
use backend\models\AddExam;
use backend\models\Subject;
use backend\models\Section;
use backend\models\FinalExamGrading;
use backend\models\FinalExamSubjects;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/**
 * FinalExamController implements the CRUD actions for FinalExam model.
 */
class FinalExamController extends Controller
{
    /**
     * @inheritdoc
     */
       public function behaviors()
    { 
		 $arr1= '';
		 if(isset(Yii::$app->user->identity->id)){
		if (Yii::$app->user->identity->role_id == 1 || Yii::$app->user->identity->role_id == 2 || Yii::$app->user->identity->role_id == 3 || Yii::$app->user->identity->role_id == 4){
			 $arr1 = array('create', 'update','delete','index','view','getsection','getsubject','addsubject','add_marks','update_gradess','update_markes');
		 }
		 else if (Yii::$app->user->identity->role_id == 5){
			 $arr1=array('create', 'update','delete','index','view','getsection','getsubject','addsubject','add_marks','update_gradess','update_markes');
		 }else {
			 $arr1=array('delete','getsection','getsubject','addsubject',);
		 }
		 }else{
			 $arr1=array('delete','getsection','getsubject','addsubject',);
		 }
		
        return [
		'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => $arr1,
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all FinalExam models.
     * @return mixed
     */
    public function actionIndex()
    {
		$model = new FinalExam();
        $model_second = new FinalExamSubjects();
        $searchModel = new FinalExam_search();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
		
		 if(isset($_POST['slection_exam']) && !empty($_POST['slection_exam'])){
            $exm_hid_id = $_POST['slection_exam'];
			 }
	else if (isset($_POST['slection_exam']) && ($_POST['slection_exam'] == '0')){
		 $exm_hid_id = '0'; 
	}
			 else{
				 $exm_hid_id = '0'; 
				 
		if(Yii::$app->request->isPost){
			$mitzrd = Yii::$app->request->post()['FinalExam']['section_id'];
			$eexam_id = Yii::$app->request->post()['FinalExam']['exam_id'];
			$classss_id = Yii::$app->request->post()['FinalExam']['class_id'];
			foreach($mitzrd as $subjectsda){
				if(!empty($subjectsda)){
					
					if(Yii::$app->user->identity->role_id == 1){
					$acsdmif = AcedemicYear::find()->Where(['=', 'school_id', Yii::$app->user->getId()])->AndWhere(['=', 'status', 1])->one();
						$schol_ild = Yii::$app->user->getId();
					}else{
						$acsdmif = AcedemicYear::find()->Where(['=', 'school_id', Yii::$app->user->identity->school_id])->AndWhere(['=', 'status', 1])->one();
						$schol_ild = Yii::$app->user->identity->school_id;
					}
					
					$Examinations_count = FinalExam::find()->where(['exam_id'=>$eexam_id])->andwhere(['class_id'=>$classss_id])->andwhere(['section_id'=>$subjectsda])->andwhere(['school_id'=>$schol_ild])->andwhere(['academic_year'=>$acsdmif])->count();
					
					if($Examinations_count == 0){
						
						
						$classgeiitnginfoid = ClassInfo::find()->where(['class_name'=>$classss_id])->andwhere(['class_section'=>$subjectsda])->andwhere(['school_id'=>$schol_ild])->andwhere(['academic_year'=>$acsdmif])->one();
						
						$getclass_subjects_counting = ClassSubject::find()->where(['class_id'=>$classgeiitnginfoid['id']])->andwhere(['academic_year'=>$acsdmif])->count();
						if($getclass_subjects_counting > 0){
							
							$model = new FinalExam();	
							$model->load(Yii::$app->request->post());
							if(Yii::$app->user->identity->role_id == 1){
							$saddfs = AcedemicYear::find()->Where(['=', 'school_id', Yii::$app->user->getId()])->AndWhere(['=', 'status', 1])->one();
								$model->school_id = Yii::$app->user->getId();
							}else{
								$saddfs = AcedemicYear::find()->Where(['=', 'school_id', Yii::$app->user->identity->school_id])->AndWhere(['=', 'status', 1])->one();
								$model->school_id = Yii::$app->user->identity->school_id;
							}
							
							$model->section_id = $subjectsda;
							$model->academic_year = $saddfs['id'];
							$model->created = time();
							$model->updated = time();
							$model->save(false);
							Yii::$app->session->setFlash('success', "Exam has been Added.");
							
					} else{
						$clks_nmd = AddClass::find()->where(['id'=>$classss_id])->one();
						$fgsd_sction = Section::find()->where(['id'=>$subjectsda])->one();
						
						$war_msg = " Class ".$clks_nmd['class_name']. " and Section ".$fgsd_sction['section_name']." has no subject.";
						Yii::$app->session->setFlash('error', $war_msg);
						
					}
						
					
					}
					else
					{
						$clks_nmd = AddClass::find()->where(['id'=>$classss_id])->one();
						$fgsd_sction = Section::find()->where(['id'=>$subjectsda])->one();
						$fgsd_examinas = AddExam::find()->where(['id'=>$eexam_id])->one();
						$war_msg = "Exam ".$fgsd_examinas['exam_name']." and Class ".$clks_nmd['class_name']. " and Section ".$fgsd_sction['section_name']." Already exist.";
						Yii::$app->session->setFlash('error', $war_msg);
					}
				}
				
			}
			
				
			
			  return $this->redirect(['index']);
			}
			 }
		
		
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
			'model' => $model,
			'model_second' => $model_second,
			'exmserch_id' => $exm_hid_id,
			
        ]);
    }

    /**
     * Displays a single FinalExam model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new FinalExam model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new FinalExam();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing FinalExam model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }
	
	public function actionGetsection()
    {
		extract($_POST);
		if(Yii::$app->user->identity->role_id == 1){
		$academine = AcedemicYear::find()->Where(['=', 'school_id', Yii::$app->user->getId()])->AndWhere(['=', 'status', 1])->one();
	   }else{
	   $academine = AcedemicYear::find()->Where(['=', 'school_id', Yii::$app->user->identity->school_id])->AndWhere(['=', 'status', 1])->one();
	   }
		echo "<span class='gurgon'><input type='checkbox' name='FinalExam[section_id][]' id='alclassing' value=''> All Sections </span>";
		$getingsection = ClassInfo::find()->where(['class_name'=>$class_ids])->andwhere(['=','academic_year',$academine['id']])->groupBy(['class_section'])->all();
		
		foreach($getingsection as $sectionwise) {
			$getsections_name = Section::find()->where(['id'=>$sectionwise->class_section])->one();
			echo "<span class='mrtzs'><input type='checkbox' name='FinalExam[section_id][]' id='finalexam-section_id' value='".$getsections_name['id']."'> ".$getsections_name['section_name']."</span>";
			
		}
	}
	
	public function actionGetsubject()
	{
		
		extract($_POST);
		if(Yii::$app->user->identity->role_id == 1){
		$academine = AcedemicYear::find()->Where(['=', 'school_id', Yii::$app->user->getId()])->AndWhere(['=', 'status', 1])->one();
	   }else{
	   $academine = AcedemicYear::find()->Where(['=', 'school_id', Yii::$app->user->identity->school_id])->AndWhere(['=', 'status', 1])->one();
	   }
		echo "<option value=''>Please select</option>";
		$getingsection_first = ClassInfo::find()->where(['class_name'=>$class_ids])->andwhere(['=','class_section',$section_id])->andwhere(['=','academic_year',$academine['id']])->one();
		
		$getingsection = ClassSubject::find()->where(['class_id'=>$getingsection_first['id']])->all();
		
		foreach($getingsection as $sectionwise) {
			$getsections_name = Subject::find()->where(['id'=>$sectionwise->subject_id])->one();
			echo "<option value='".$getsections_name['id']."'>".$getsections_name['subject_name']."</option>";
		}
	}
	
	public function actionAddsubject()
	{
		extract($_POST);
		$getsd = $subject;
		$gtdater = $exam_date;
		if(isset($maximum_numbers)){
			$getexmmarks = $maximum_numbers;
		}
		
		$getassigned_teacher = $assigned_teacher;
		$final_ids = $exam_id;
				$getcount = FinalExamSubjects::find()->where(['=','final_exam_id',$final_ids])->count();
				if($getcount > 0){
					$second_mosdel = FinalExamSubjects::find()->where(['=','final_exam_id',$final_ids])->all();
					foreach($second_mosdel as $deltmodal) {
						$deltmodal->delete();
					}
					foreach($getsd as $key => $getmysubject){
						if(!empty($gtdater[$key])){
					$model_second = new FinalExamSubjects();
				$model_second->load(Yii::$app->request->post());
				
					if(Yii::$app->user->identity->role_id == 1){
						$saddfs = AcedemicYear::find()->Where(['=', 'school_id', Yii::$app->user->getId()])->AndWhere(['=', 'status', 1])->one();
						$model_second->school_id = Yii::$app->user->getId();
					}else{
						$saddfs = AcedemicYear::find()->Where(['=', 'school_id', Yii::$app->user->identity->school_id])->AndWhere(['=', 'status', 1])->one();
						$model_second->school_id = Yii::$app->user->identity->school_id;
					}
					$model_second->final_exam_id = $final_ids;
					$model_second->subject_id = $getmysubject;
					$model_second->exam_date = $gtdater[$key];
					if(isset($maximum_numbers)){
					$model_second->maximum_marks = $getexmmarks[$key];
					}
					$model_second->Assigned_teacher_id = $getassigned_teacher[$key];
					$model_second->academic_year = $saddfs['id'];
					$model_second->created = time();
					$model_second->updated = time();
					$model_second->last_updated_by = Yii::$app->user->getId();
					$model_second->save(false);
						}
					}
				}
				else{
					foreach($getsd as $key => $getmysubject){
						if(!empty($gtdater[$key])){
						$model_second = new FinalExamSubjects();
						$model_second->load(Yii::$app->request->post());
					
						if(Yii::$app->user->identity->role_id == 1){
							$saddfs = AcedemicYear::find()->Where(['=', 'school_id', Yii::$app->user->getId()])->AndWhere(['=', 'status', 1])->one();
							$model_second->school_id = Yii::$app->user->getId();
						}else{
							$saddfs = AcedemicYear::find()->Where(['=', 'school_id', Yii::$app->user->identity->school_id])->AndWhere(['=', 'status', 1])->one();
							$model_second->school_id = Yii::$app->user->identity->school_id;
						}
						$model_second->final_exam_id = $final_ids;
						$model_second->subject_id = $getmysubject;
						$model_second->exam_date = $gtdater[$key];
						if(isset($maximum_numbers)){
						$model_second->maximum_marks = $getexmmarks[$key];
						}
						$model_second->Assigned_teacher_id = $getassigned_teacher[$key];
						$model_second->academic_year = $saddfs['id'];
						$model_second->created = time();
						$model_second->updated = time();
						$model_second->save(false);
						}
					}
				}
	}
	 
	public function actionAdd_marks($id)
	{
		return $this->render('add_marks', [
                'id' => $id,
            ]);
      
		
	}
	
	public function actionUpdate_gradess()
    {
        extract($_POST);
		$subjects_id = $_POST['subject_id'];
		$grade_val = $_POST['grade_val'];
		foreach($subjects_id as $key => $subject_id){
			$getval = FinalExamGrading::find()->where(['final_exam_id'=>$exam_id])->andwhere(['class_id'=>$class_id])->andwhere(['subject_id'=>$subject_id])->andwhere(['student_id'=>$student_id])->one();
		if(!empty($getval)){
			$getval['final_exam_id'] = $exam_id;
			$getval['class_id'] = $class_id;
			$getval['subject_id'] = $subject_id;
			$getval['section_id'] = $section_id;
			$getval['student_id'] = $student_id;
			$getval['grade'] = $grade_val[$key];
			$getval->save(false);
		}else{
			$model = new FinalExamGrading();
			$model->load(Yii::$app->request->post());
			$model->final_exam_id = $exam_id;
			$model->class_id = $class_id;
			$model->section_id = $section_id;
			$model->subject_id = $subject_id;
			$model->student_id = $student_id;
			$model->grade = $grade_val[$key];
			$model->save();
		}
		}
		
    }
	
	public function actionUpdate_markes()
    {
        extract($_POST);
		$subjects_id = $_POST['subject_id'];
		$mark_val = $_POST['mark_val'];
		foreach($subjects_id as $key => $subject_id){
			$getval = FinalExamGrading::find()->where(['final_exam_id'=>$exam_id])->andwhere(['class_id'=>$class_id])->andwhere(['subject_id'=>$subject_id])->andwhere(['student_id'=>$student_id])->one();
		if(!empty($getval)){
			$getval['final_exam_id'] = $exam_id;
			$getval['class_id'] = $class_id;
			$getval['subject_id'] = $subject_id;
			$getval['section_id'] = $section_id;
			$getval['student_id'] = $student_id;
			$getval['marks'] = $mark_val[$key];
			$getval->save(false);
		}else{
			$model = new FinalExamGrading();
			$model->load(Yii::$app->request->post());
			$model->final_exam_id = $exam_id;
			$model->class_id = $class_id;
			$model->section_id = $section_id;
			$model->subject_id = $subject_id;
			$model->student_id = $student_id;
			$model->marks = $mark_val[$key];
			$model->save();
		}
		}
		
    }

    /**
     * Deletes an existing FinalExam model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
				
        $model = $this->findModel($id);
		
		$second_mosdel = FinalExamSubjects::find()->where(['=','final_exam_id',$id])->all();
		foreach($second_mosdel as $deltmodal) {
			$deltmodal->delete();
		}
		$model->delete();
		Yii::$app->session->setFlash('success', "Exam has been Deleted.");
        return $this->redirect(['index']);
    }

    /**
     * Finds the FinalExam model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return FinalExam the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = FinalExam::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}

<?php

namespace backend\controllers;

use Yii;
use backend\models\TeacherTestExam;
use backend\models\TeacherTestExam_search;
use backend\models\Exam;
use backend\models\ExamClass;
use backend\models\Exam_search;
use backend\models\ClassInfo;
use backend\models\AcedemicYear;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use backend\models\Section;
use backend\models\AddClass;
use backend\models\ClassSubject;
use backend\models\TeacherExamClass;

/**
 * TeacherTestExamController implements the CRUD actions for TeacherTestExam model.
 */
class TeacherTestExamController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        $arr1= '';
		 if(isset(Yii::$app->user->identity->id)){
		if (Yii::$app->user->identity->role_id == 1 || Yii::$app->user->identity->role_id == 2 || Yii::$app->user->identity->role_id == 3 || Yii::$app->user->identity->role_id == 4){
			 $arr1 = array('create', 'update','delete','index','view','getsubjectforteacher','update_teacherexam');
		 }
		 else{
			 $arr1=array('update','update_teacherexam','delete','teacher_examindex','teacher_form','getsubjectforteacher');
		 }
		 }else{
			 $arr1=array('update','update_teacherexam','delete','getsubjectforteacher');
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
     * Lists all TeacherTestExam models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new TeacherTestExam_search();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
	
    /**
     * Displays a single TeacherTestExam model.
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
     * Creates a new TeacherTestExam model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new TeacherTestExam();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing TeacherTestExam model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
		$second_modelss = TeacherExamClass::find()->where(['exam_id'=> $model->id]);
		$second_count = $second_modelss->count();
		$model_second = $second_modelss->all();
       
		if(Yii::$app->user->identity->role_id == 1){
			$saddfs = AcedemicYear::find()->Where(['=', 'school_id', Yii::$app->user->getId()])->AndWhere(['=', 'status', 1])->one();
		}else{
			$saddfs = AcedemicYear::find()->Where(['=', 'school_id', Yii::$app->user->identity->school_id])->AndWhere(['=', 'status', 1])->one();
		}
		if(Yii::$app->request->isPost){
		
			$classen = Yii::$app->request->post()['TeacherExamClass']['class_id'];
			$sectioneseen = Yii::$app->request->post()['TeacherExamClass']['subject_id'];
			$model->load(Yii::$app->request->post());
			$model->updated_date = time();
		if($model->save(false)){
			
			foreach($model_second as $deltemodal) {
				$deltemodal->delete();
			} 
			foreach ($classen as $key => $allclass){
				
					 $model_second = new TeacherExamClass();
					$model_second->exam_id = $model->id;
					
						$model_second->class_id = $allclass;
						$model_second->subject_id = $sectioneseen;
						if(Yii::$app->user->identity->role_id == 1){
							$model_second->school_id = Yii::$app->user->getId();
						}else{
							$model_second->school_id = Yii::$app->user->identity->school_id;
						}
						$model_second->academic_year = $saddfs['id'];
						$model_second->created = time();
						$model_second->updated = time();
						$model_second->save(false);
						
									
				
			}
			Yii::$app->session->setFlash('success', "Exam has been Updated.");
			return $this->redirect(['teacher_examindex']);
		}
		}
	
            return $this->render('update', [
                'model' => $model,'model_second' => $model_second,
            ]);
        
    }
	
	

    /**
     * Deletes an existing TeacherTestExam model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
		$second_model = TeacherExamClass::find()->where(['exam_id'=>$model->id])->all();
		$model->delete();
		foreach($second_model as $deltmodal) {
			$deltmodal->delete();
		}
		
			Yii::$app->session->setFlash('success', "Exam has been Deleted.");
        return $this->redirect(['teacher_examindex']);
    }
	
	public function actionTeacher_form()
    {
		
        $model = new TeacherTestExam(); 
		$model_second = new TeacherExamClass();
		if(Yii::$app->user->identity->role_id == 1){
			$saddfs = AcedemicYear::find()->Where(['=', 'school_id', Yii::$app->user->getId()])->AndWhere(['=', 'status', 1])->one();
		}else{
			$saddfs = AcedemicYear::find()->Where(['=', 'school_id', Yii::$app->user->identity->school_id])->AndWhere(['=', 'status', 1])->one();
		}
		if(Yii::$app->request->isPost){
		
			$classen = Yii::$app->request->post()['TeacherExamClass']['class_id'];
			$sectioneseen = Yii::$app->request->post()['TeacherExamClass']['subject_id'];
			$model->load(Yii::$app->request->post());
			
			$model->exam_name = Yii::$app->request->post()['TeacherTestExam']['exam_name'];
			$model->exam_date = Yii::$app->request->post()['TeacherTestExam']['exam_date'];
			$model->marks = Yii::$app->request->post()['TeacherTestExam']['marks'];
			if(Yii::$app->user->identity->role_id == 1){
					$model->school_id = Yii::$app->user->getId();
			}else{
					$model->school_id = Yii::$app->user->identity->school_id;
			}
			$model->academic_year = $saddfs['id'];
			$model->created_date = time();
			$model->updated_date = time();
		if($model->save(false)){
			
			$model_second->load(Yii::$app->request->post());
			foreach ($classen as $key => $allclass){
				
					 $model_second = new TeacherExamClass();
					$model_second->exam_id = $model->id;
					
						$model_second->class_id = $allclass;
						$model_second->subject_id = $sectioneseen;
						if(Yii::$app->user->identity->role_id == 1){
							$model_second->school_id = Yii::$app->user->getId();
						}else{
							$model_second->school_id = Yii::$app->user->identity->school_id;
						}
						$model_second->academic_year = $saddfs['id'];
						$model_second->created = time();
						$model_second->updated = time();
						$model_second->save(false);
						
									
				
			}
			Yii::$app->session->setFlash('success', "Exam has been Added.");
			return $this->redirect(['teacher_examindex']);
		}
		}
		return $this->render('teacher_form', [
                'model' => $model,'model_second' => $model_second,
            ]);
	} 
	
	public function actionTeacher_examindex()
    {
 
        $searchModel = new TeacherTestExam_search();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('teacher_examindex', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
	}
	
	public function actionGetsubjectforteacher()
    {
		extract($_POST); 
		if($subject_ids != ''){
			echo "<span class='gurgon'><input type='checkbox' name='FinalExam[section_id][]' id='alclassing' value='0'> All Sections </span>";
		}
		
			 $academic_years = AcedemicYear::find()->where(['school_id'=>Yii::$app->user->identity->school_id])->andwhere(['=','status','1'])->one();
		
			$gtsubjctsl = ClassSubject::find()->where(['subject_id'=>$subject_ids])->andwhere(['=','Assigned_teacher_id',Yii::$app->user->getId()])->andwhere(['=','academic_year',$academic_years['id']])->all();
			
			foreach($gtsubjctsl as $getclasses) {
				$clsd = ClassInfo::find()->where(['id'=>$getclasses->class_id])->one();
				$mysectionsd = Section::find()->where(['id'=>$clsd['class_section']])->one();
				$mycls_nme = AddClass::find()->where(['id'=>$clsd['class_name']])->one();
				echo "<span class='mrtzs'><input type='checkbox' name='TeacherExamClass[class_id][]' id='teachertestexam-class_id' value='".$getclasses->class_id."'> ". $mycls_nme['class_name']. " ". $mysectionsd['section_name']." "."</span>";
			}
	}

    /**
     * Finds the TeacherTestExam model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return TeacherTestExam the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = TeacherTestExam::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}

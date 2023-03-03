<?php

namespace backend\controllers;

use Yii;
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

/**
 * ExamController implements the CRUD actions for Exam model.
 */
class ExamController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    { 
		 $arr1= '';
		 if(isset(Yii::$app->user->identity->id)){
		if (Yii::$app->user->identity->role_id == 1 || Yii::$app->user->identity->role_id == 2 || Yii::$app->user->identity->role_id == 3 || Yii::$app->user->identity->role_id == 4){
			 $arr1 = array('create', 'update','delete','index','view','class_view','getsection','deleteidstudent','getsubjectforteacher');
		 }
		 else{
			 $arr1=array('delete','class_view','getsection','deleteidstudent','teacher_examindex','teacher_form','getsubjectforteacher');
		 }
		 }else{
			 $arr1=array('delete','getsection','deleteidstudent','getsubjectforteacher');
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
     * Lists all Exam models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new Exam_search();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Exam model.
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
     * Creates a new Exam model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
		/* print_r(Yii::$app->request->post());
		die;   */ 
        $model = new Exam(); 
		$model_second = new ExamClass();
		if(Yii::$app->user->identity->role_id == 1){
			$saddfs = AcedemicYear::find()->Where(['=', 'school_id', Yii::$app->user->getId()])->AndWhere(['=', 'status', 1])->one();
		}else{
			$saddfs = AcedemicYear::find()->Where(['=', 'school_id', Yii::$app->user->identity->school_id])->AndWhere(['=', 'status', 1])->one();
		}
		
		 
		if(Yii::$app->request->isPost){
		$classen = Yii::$app->request->post()['ExamClass']['class_id'];
		$sectioneseen = Yii::$app->request->post()['ExamClass']['section_id'];
		$model->load(Yii::$app->request->post());
		if(Yii::$app->user->identity->role_id != '5'){
			$model->inhouse_global = '0';
		}else {
			$model->inhouse_global = '1';
		}
		$model->exam_name = Yii::$app->request->post()['Exam']['exam_name'];
		$model->exam_date = Yii::$app->request->post()['Exam']['exam_date'];
		$model->marks = Yii::$app->request->post()['Exam']['marks'];
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
		    $class_save = false;
			foreach ($classen as $key => $allclass){
				if(!empty($allclass)){	
					$model_second = new ExamClass();
					$model_second->exam_id = $model->id;
					$getmrg_class =	ClassInfo::find()->Where(['=', 'class_name', $allclass])->AndWhere(['=', 'class_section', $sectioneseen[$key]])->one();
					
					if(!empty($getmrg_class)){
						$class_save = true;
						$model_second->class_id = $getmrg_class['id'];
						$model_second->section_id = $sectioneseen[$key];
						if(Yii::$app->user->identity->role_id == 1){
							$model_second->school_id = Yii::$app->user->getId();
						}else{
							$model_second->school_id = Yii::$app->user->identity->school_id;
						}
						$model_second->academic_year = $saddfs['id'];
						$model_second->created = time();
						$model_second->updated = time();
						$model_second->save(false);
						Yii::$app->session->setFlash('success', "Exam has been Added.");
						
					}else{
						$clks_nmd = AddClass::find()->where(['id'=>$allclass])->one();
						$fgsd_sction = Section::find()->where(['id'=>$sectioneseen[$key]])->one();
						$war_msg = "Class ".$clks_nmd['class_name']. " and Section ".$fgsd_sction['section_name']." does not exist.";
						Yii::$app->session->setFlash('warning', $war_msg);
					}
					
					
				}
			}
			if($class_save == false){
				$delting_examination = Exam::find()->where(['id'=>$model->id])->one()->delete();
			}
			return $this->redirect(['index']);
		}
		
		}
            return $this->render('create', [
                'model' => $model, 'model_second' => $model_second,
            ]);
        
    }

    /**
     * Updates an existing Exam model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
		 /* print_r(Yii::$app->request->post());
		die;   */
        $model = $this->findModel($id); 
		$second_modelss = ExamClass::find()->where(['exam_id'=> $model->id]);
		$second_count = $second_modelss->count();
		$model_second = $second_modelss->all();
		if(Yii::$app->user->identity->role_id == 1){
			$saddfs = AcedemicYear::find()->Where(['=', 'school_id', Yii::$app->user->getId()])->AndWhere(['=', 'status', 1])->one();
		}else{
			$saddfs = AcedemicYear::find()->Where(['=', 'school_id', Yii::$app->user->identity->school_id])->AndWhere(['=', 'status', 1])->one();
		}
		if(Yii::$app->request->isPost){
			$model->load(Yii::$app->request->post());
			$model->last_updated_by = Yii::$app->user->getId();
			if($model->save(false)){
			
		$classen = Yii::$app->request->post()['ExamClass']['class_id'];
		$sectioneseen = Yii::$app->request->post()['ExamClass']['section_id'];
			foreach($model_second as $deltemodal) {
				$deltemodal->delete();
			}
			$class_save = false;
			foreach ($classen as $key => $allclass){
				if(!empty($allclass)){	
					$model_second = new ExamClass();
					$model_second->exam_id = $model->id;
					$getmrg_class =	ClassInfo::find()->Where(['=', 'class_name', $allclass])->AndWhere(['=', 'class_section', $sectioneseen[$key]])->one();
					
					if(!empty($getmrg_class)){
						$class_save = true;
						$model_second->class_id = $getmrg_class['id'];
						$model_second->section_id = $sectioneseen[$key];
						if(Yii::$app->user->identity->role_id == 1){
							$model_second->school_id = Yii::$app->user->getId();
						}else{
							$model_second->school_id = Yii::$app->user->identity->school_id;
						}
						$model_second->academic_year = $saddfs['id'];
						$model_second->created = time();
						$model_second->updated = time();
						$model_second->save(false);
						Yii::$app->session->setFlash('success', "Exam has been Updated.");
						
					}else{
						$clks_nmd = AddClass::find()->where(['id'=>$allclass])->one();
						$fgsd_sction = Section::find()->where(['id'=>$sectioneseen[$key]])->one();
						$war_msg = "Class ".$clks_nmd['class_name']. " and Section ".$fgsd_sction['section_name']." does not exist.";
						Yii::$app->session->setFlash('warning', $war_msg);
					}
					
					
				}
			}
			if($class_save == false){
				$delting_examination = Exam::find()->where(['id'=>$model->id])->one()->delete();
			}
		}
			
            return $this->redirect(['index']);
        } 
            return $this->render('update', [
                'model' => $model,'model_second' => $model_second,
            ]);
        
    }
	
	public function actionTeacher_form()
    {
		/* print_r(Yii::$app->request->post());
		die;   */ 
        $model = new Exam(); 
		$model_second = new ExamClass();
		return $this->render('teacher_form', [
                'model' => $model,'model_second' => $model_second,
            ]);
	}
	
	public function actionTeacher_examindex()
    {
		/* print_r(Yii::$app->request->post());
		die;   */ 
        $model = new Exam(); 
		$model_second = new ExamClass();
		return $this->render('teacher_examindex', [
                'model' => $model,'model_second' => $model_second,
            ]);
	}
    /**
     * Deletes an existing Exam model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
		$second_model = ExamClass::find()->where(['exam_id'=>$model->id])->all();
		$model->delete();
		foreach($second_model as $deltmodal) {
			$deltmodal->delete();
		}
		
			Yii::$app->session->setFlash('success', "Exam has been Deleted.");
        return $this->redirect(['index']);
    }
	
	
	
	
	
	public function actionGetsection()
    {
		extract($_POST);
		if(Yii::$app->user->identity->role_id == 1){
		$academine = AcedemicYear::find()->Where(['=', 'school_id', Yii::$app->user->getId()])->AndWhere(['=', 'status', 1])->one();
	   }else{
	   $academine = AcedemicYear::find()->Where(['=', 'school_id', Yii::$app->user->identity->school_id])->AndWhere(['=', 'status', 1])->one();
	   }
		echo "<option value=''>Please select</option>";
		$getingsection = ClassInfo::find()->where(['class_name'=>$class_ids])->andwhere(['=','academic_year',$academine['id']])->groupBy(['class_section'])->all();
		
		foreach($getingsection as $sectionwise) {
			$getsections_name = Section::find()->where(['id'=>$sectionwise->class_section])->one();
			echo "<option value='".$getsections_name['id']."'>".$getsections_name['section_name']."</option>";
		}
	}
	
	public function actionGetsubjectforteacher()
    {
		extract($_POST); 
			$gtsubjctsl = ClassSubject::find()->where(['subject_id'=>$subject_ids])->all();
			foreach($gtsubjctsl as $getclasses) {
				$clsd = ClassInfo::find()->where(['id'=>$getclasses->class_id])->one();
				$mysectionsd = Section::find()->where(['id'=>$clsd['class_section']])->one();
				$mycls_nme = AddClass::find()->where(['id'=>$clsd['class_name']])->one();
				echo "<input type='checkbox' name='class' value='".$getclasses->class_id."'> ". $mycls_nme['class_name']. " ". $mysectionsd['section_name']." "." ";
			}
	}
	
	
	public function actionClass_view($id)
    {
        return $this->render('class_view', [
            'model' => $this->findModel($id),
        ]);
    } 
	
	
	public function actionDeleteidstudent()
    {
		$id = $_POST['id'];
        $model = ExamClass::find()
                    ->where(['id'=> $id])
                    ->one();
		
		if($model->delete()){
			
			echo "Removed";
		}
    }

    /**
     * Finds the Exam model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Exam the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Exam::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}

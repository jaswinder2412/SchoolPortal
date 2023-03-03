<?php

namespace backend\controllers;

use Yii;
use backend\models\ClassInfo;
use backend\models\ClassSubject;
use backend\models\ClassStudent;
use backend\models\ClassInfo_search;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/**
 * ClassinfoController implements the CRUD actions for ClassInfo model.
 */
class ClassinfoController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    { 
		 $arr1= '';
		 if(isset(Yii::$app->user->identity->id)){
		if (Yii::$app->user->identity->role_id == 1 || Yii::$app->user->identity->role_id == 2 || Yii::$app->user->identity->role_id == 3 || Yii::$app->user->identity->role_id == 4){
			 $arr1 = array('create', 'update','delete','index','view','deleteid','class_view','teacherindexs');
		 }
		 else if (Yii::$app->user->identity->role_id == 5){
			 $arr1=array('index','view','deleteid','class_view','teacherindexs');
		 }else {
			 $arr1=array('deleteid');
		 }
		 }else{
			 $arr1=array('delete');
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
     * Lists all Classinfo models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ClassInfo_search();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Classinfo model.
     * @param integer $id
     * @return mixed
     */
     public function actionClass_view($id)
    {
        return $this->render('class_view', [
            'model' => $this->findModel($id),
        ]);
    } 

    /**
     * Creates a new Classinfo model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
	/* 	 print_r(Yii::$app->request->post());
		die;  */
        $model = new ClassInfo();
        $second_model = new ClassSubject();	
		$third_model = new ClassStudent();	
		if(Yii::$app->request->isPost){
			$model->load(Yii::$app->request->post());
			$newDate = Yii::$app->request->post()['ClassInfo']['class_name'];
			$newDate_second = Yii::$app->request->post()['ClassInfo']['class_section'];
			$acedmins = Yii::$app->request->post()['ClassInfo']['academic_year'];
			
			if(Yii::$app->user->identity->role_id == 1){
				$check_model = ClassInfo::find()->where(['class_name' => $newDate])->andwhere(['class_section'=>$newDate_second])->andwhere(['school_id'=>Yii::$app->user->getId()])->andwhere(['academic_year'=>$acedmins])->count();
			}else{
				$check_model = ClassInfo::find()->where(['class_name' => $newDate])->andwhere(['class_section'=>$newDate_second])->andwhere(['school_id'=>Yii::$app->user->identity->school_id])->andwhere(['academic_year'=>$acedmins])->count();
			}
			
			if($check_model == '0'){			
			$model->created_date = time();
			$model->updated_date = time();
			$model->last_updated_by = '';
			if(Yii::$app->user->identity->role_id == 1){
				$model->school_id = Yii::$app->user->getId();
			}else{
				$model->school_id = Yii::$app->user->identity->school_id;
			}
			if($model->save(false)){
				
				$second_model->load(Yii::$app->request->post());
				$subjicts = Yii::$app->request->post()['ClassSubject']['subject_id'];
				$teachs= Yii::$app->request->post()['ClassSubject']['Assigned_teacher_id'];
				$i=0;
				foreach($subjicts as $key => $subject_value) {
					if(!empty($subject_value)){
					$second_model = new ClassSubject();	
					$second_model->class_id = $model->id;
					$second_model->subject_id = $subject_value;
					$second_model->Assigned_teacher_id = $teachs[$key];
					$second_model->created_date = time();
					$second_model->updated_date = time();
					if(Yii::$app->user->identity->role_id == 1){
					$second_model->school_id = Yii::$app->user->getId();
					}else{
						$second_model->school_id = Yii::$app->user->identity->school_id;
					}
					$second_model->academic_year = Yii::$app->request->post()['ClassInfo']['academic_year'];
					$second_model->save(false);
					$i++;
					}
				}
				
				$third_model->load(Yii::$app->request->post());
				if(isset(Yii::$app->request->post()['ClassStudent']['student_id'])){
				$students_multiple = Yii::$app->request->post()['ClassStudent']['student_id'];
				foreach($students_multiple as $key => $multiple) { 
					$third_model = new ClassStudent();	
					$third_model->class_id = $model->id;
					$third_model->student_id = $multiple;
					$third_model->Academic_year_id = Yii::$app->request->post()['ClassInfo']['academic_year'];
					if(Yii::$app->user->identity->role_id == 1){
					$third_model->school_id = Yii::$app->user->getId();
					}else{
						$third_model->school_id = Yii::$app->user->identity->school_id;
					}
					
					$third_model->created_date = time();
					$third_model->updated_date = time();
					$third_model->save(false);
				}
				}
				
								
				Yii::$app->session->setFlash('success', "Class has been Added.");
				  return $this->redirect(['index']);
			}
			}else {
				Yii::$app->session->setFlash('warning', "Class already Exist.");
			}
		}
            return $this->render('create', [
                'model' => $model,'second_model' => $second_model,'third_model' => $third_model,
            ]);
       
    }

    /**
     * Updates an existing Classinfo model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
		/* print_r(Yii::$app->request->post()); die; */
		$model = $this->findModel($id);
        $second_modelss = ClassSubject::find()->where(['class_id'=> $model->id]);
		$second_count = $second_modelss->count();
		$second_model = $second_modelss->all();
		$third_modelsd = ClassStudent::find()->where(['class_id'=> $model->id]);
		$third_model = $third_modelsd->all();	
		if(Yii::$app->request->isPost){
			$model->load(Yii::$app->request->post());
		$newDate = Yii::$app->request->post()['ClassInfo']['class_name'];
		$newDate_second = Yii::$app->request->post()['ClassInfo']['class_section'];
		$acedmins = Yii::$app->request->post()['ClassInfo']['academic_year'];
		if(Yii::$app->user->identity->role_id == 1){
				$check_model = ClassInfo::find()->where(['class_name' => $newDate])->andwhere(['class_section'=>$newDate_second])->andwhere(['school_id'=>Yii::$app->user->getId()])->andwhere(['academic_year'=>$acedmins])->andwhere(['!=','id',$id])->count();
			}else{
				$check_model = ClassInfo::find()->where(['class_name' => $newDate])->andwhere(['class_section'=>$newDate_second])->andwhere(['school_id'=>Yii::$app->user->identity->school_id])->andwhere(['academic_year'=>$acedmins])->andwhere(['!=','id',$id])->count();
			}
			
		if($check_model == '0'){
			$model->last_updated_by = Yii::$app->user->getId();
			$model->updated_date = time();
			$model->save(false);
			$subjicts = Yii::$app->request->post()['ClassSubject']['subject_id'];
			$teachs= Yii::$app->request->post()['ClassSubject']['Assigned_teacher_id'];
			
			foreach($second_model as $deltemodal) {
				$deltemodal->delete();
			}
			$i=0;
			foreach($subjicts as $key => $subject_value) {
				if(!empty($subject_value)){
				$second_model = new ClassSubject();	
				$second_model->class_id = $model->id;
				$second_model->subject_id = $subject_value;
				$second_model->Assigned_teacher_id = $teachs[$key];
				$second_model->created_date = time();
				$second_model->updated_date = time();
				if(Yii::$app->user->identity->role_id == 1){
					$second_model->school_id = Yii::$app->user->getId();
					}else{
						$second_model->school_id = Yii::$app->user->identity->school_id;
					}
					$second_model->academic_year = Yii::$app->request->post()['ClassInfo']['academic_year'];
				$second_model->save(false); 
				$i++;
				}
			}
				foreach($third_model as $thir_deletemodal) {
					$thir_deletemodal->delete();
				}
				if(isset(Yii::$app->request->post()['ClassStudent']['student_id'])){		
				$students_multiple = Yii::$app->request->post()['ClassStudent']['student_id'];
				
				foreach($students_multiple as $key => $multiple) { 
					$third_model = new ClassStudent();	
					$third_model->class_id = $model->id;
					$third_model->student_id = $multiple;
					$third_model->Academic_year_id = Yii::$app->request->post()['ClassInfo']['academic_year'];
					if(Yii::$app->user->identity->role_id == 1){
					$third_model->school_id = Yii::$app->user->getId();
					}else{
						$third_model->school_id = Yii::$app->user->identity->school_id;
					}
					$third_model->created_date = time();
					$third_model->updated_date = time();
					$third_model->save(false);
				} 
				}
			Yii::$app->session->setFlash('success', "Class has been Updated.");
			return $this->redirect(['index']);
		}else{
			Yii::$app->session->setFlash('warning', "Class already Exist.");
			}
		}
 
            return $this->render('update', [
                'model' => $model,'second_model' => $second_model,'third_model' => $third_model,'second_count'=>$second_count,
            ]); 
    }

    /**
     * Deletes an existing Classinfo model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
       $model =  $this->findModel($id);
	   $second_model = ClassSubject::find()->where(['class_id'=>$model->id])->all();
	   $third_modelsd = ClassStudent::find()->where(['class_id'=> $model->id])->all();
		$model->delete();
		foreach($second_model as $deltmodal) {
			$deltmodal->delete();
		}
		foreach($third_modelsd as $thirddeltmodal) {
			$thirddeltmodal->delete();
		}
		
		Yii::$app->session->setFlash('success', "Class has been Deleted.");
        return $this->redirect(['index']);
    }
	
	
	public function actionDeleteid()
    {
		$id = $_POST['id'];
        $model = ClassSubject::find()
                    ->where(['id'=> $id])
                    ->one();
		
		if($model->delete()){
			
			echo "Removed";
		}
    }
	
	public function actionView()
    {
		extract($_POST);		
		$modelfs = $acad_id;		
		return $this->renderAjax('view', [
                'modelfs' => $modelfs,
            ]);
    }
	
	public function actionTeacherindexs()
    {	
		return $this->render('teacherindexs');
    }

    /**
     * Finds the Classinfo model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Classinfo the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ClassInfo::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}

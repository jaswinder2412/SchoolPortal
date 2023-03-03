<?php

namespace backend\controllers;

use Yii;
use backend\models\AnnouncementsTeacher;
use backend\models\AnnouncementsTeacher_search;
use backend\models\AnouncementTeachersUserids;
use backend\models\AcedemicYear;
use backend\models\UserCustom;
use common\models\User;
use backend\models\AnnouncementsParent;
use backend\models\AnnouncementsParent_search;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\widgets\ActiveForm;
/**
 * AnouncementsController implements the CRUD actions for AnnouncementsTeacher model.
 */
class AnouncementsController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    { 
		 $arr1= '';
		 if(isset(Yii::$app->user->identity->id)){
		if (Yii::$app->user->identity->role_id == 1 || Yii::$app->user->identity->role_id == 2 || Yii::$app->user->identity->role_id == 3 || Yii::$app->user->identity->role_id == 4){
			 $arr1 = array('create', 'update','delete','index','view','student_index','comm_thread','update_com_thread','delete_com_thread','comm_getval','announcement_seen');
		 }
		 else if (Yii::$app->user->identity->role_id == 5){
			 $arr1=array('index','student_index','comm_thread','update_com_thread','delete_com_thread','comm_getval','announcement_seen');
		 }else {
			 $arr1=array('student_index','delete_com_thread','comm_getval');
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
     * Lists all Anouncements models.
     * @return mixed
     */
    public function actionIndex()
    {
		if(isset($_POST['newacademic']) && !empty($_POST['newacademic'])){
            $acad = $_POST['newacademic'];
			
			 }
		else{
				$presnt_acad = AcedemicYear::find()->Where(['=', 'school_id', Yii::$app->user->identity->school_id])->AndWhere(['=', 'status', 1])->one();
			 $acad = $presnt_acad['id'];
		
		}
 
        $searchModel = new AnnouncementsTeacher_search();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
			'academics_set' => $acad,
        ]);
    }
	
	public function actionStudent_index()
    {
		if(isset($_POST['newacademic']) && !empty($_POST['newacademic'])){
            $acad = $_POST['newacademic'];
			
			 }
		else{
				$presnt_acad = AcedemicYear::find()->Where(['=', 'school_id', Yii::$app->user->identity->school_id])->AndWhere(['=', 'status', 1])->one();
			 $acad = $presnt_acad['id'];
		
		}
		if(isset($_GET['newid']) && !empty($_GET['newid'])){
            $newidsr = $_GET['newid'];
			
			 }
		else{
				
			 $newidsr = 0;
		
		}
		
        $searchModel = new AnnouncementsParent_search();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('student_index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
			'academics_set' => $acad,
			'assignid' => $newidsr,
        ]);
    }

    /**
     * Displays a single Anouncements model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }
	
	public function actionAnnouncement_seen()
    {
		
       extract($_POST);
	   $miklor = AnouncementTeachersUserids::find()->where(['=','announcement_id',$announceid])->andwhere(['=','teacher_id',Yii::$app->user->getId()])->one();
		$miklor->seen = 1;
		$miklor->save(false);
	   
    }

    /**
     * Creates a new Anouncements model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
	
			$model = new AnnouncementsTeacher();
			$model_second = new AnouncementTeachersUserids();
			if(Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())){
			Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
			return ActiveForm::validate($model);
			}
			if(Yii::$app->request->isPost){
				
			$model->load(Yii::$app->request->post());
			$model->announcements_from = Yii::$app->user->getId();
			
			
			if(Yii::$app->user->identity->role_id == 1){
				$model->school_id = Yii::$app->user->getId();
				$presnt_acad = AcedemicYear::find()->Where(['=', 'school_id', Yii::$app->user->getId()])->AndWhere(['=', 'status', 1])->one();
				$acad = $presnt_acad['id'];
			}else{
				$model->school_id = Yii::$app->user->identity->school_id;
				$presnt_acad = AcedemicYear::find()->Where(['=', 'school_id', Yii::$app->user->identity->school_id])->AndWhere(['=', 'status', 1])->one();
			 $acad = $presnt_acad['id'];
			}
			if(Yii::$app->request->post()['AnnouncementsTeacher']['announcements_to'][0] == '0'){
			$model->announcements_to = '0';
			}
			else{
				$model->announcements_to = 'M';
			}
			$model->academic_year = $acad;
			$model->created_by = Yii::$app->user->getId();
			$model->created_time = time();
			$model->updated_time = time();
			
			if($model->save(false)){
				if(Yii::$app->request->post()['AnnouncementsTeacher']['announcements_to'][0] == '0'){
				if(Yii::$app->user->identity->role_id == 1){
					$getcord = UserCustom::find()->where(['=','school_id',Yii::$app->user->identity->id])->andwhere(['or',['role_id'=>5],['role_id'=>3]])->all();
					
				}else{
					$getcord = UserCustom::find()->where(['=','school_id',Yii::$app->user->identity->school_id])->andwhere(['or',['role_id'=>5],['role_id'=>3]])->all();
				}
				foreach($getcord as $newval){
					$model_second = new AnouncementTeachersUserids();
					$model_second->announcement_id = $model->id;
					$model_second->teacher_id = $newval->id;
					$model_second->school_id = $model->school_id;
					$model_second->seen = 0;
					$model_second->academic_year = $acad;
					$model_second->save(false);
				} 
				
			}else{
				$getcord = Yii::$app->request->post()['AnnouncementsTeacher']['announcements_to'];
				foreach($getcord as $newval){
					$model_second = new AnouncementTeachersUserids();
					$model_second->announcement_id = $model->id;
					$model_second->teacher_id = $newval;
					$model_second->school_id = $model->school_id;
					$model_second->academic_year = $acad;
					$model_second->seen = 0;
					$model_second->save(false);
				} 
			}
				
				Yii::$app->session->setFlash('success', "Announcement has been Added.");
			}
			
			
			
			
            return $this->redirect(['index']);
		}

        
            return $this->render('create', [
                'model' => $model,
            ]);
       
    }
	
	public function actionComm_thread()
	{
		/* print_r(Yii::$app->request->post());
		die; */
		$model = new AnnouncementsParent();
		if(Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())){
			Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
			return ActiveForm::validate($model);
		}
		if(Yii::$app->request->isPost){
			$model->load(Yii::$app->request->post());
			if(!empty(Yii::$app->request->post()['AnnouncementsParent']['student_id'])){
				$model->student_id =implode(',',Yii::$app->request->post()['AnnouncementsParent']['student_id']);
			}
			$model->class_id = implode(',',Yii::$app->request->post()['AnnouncementsParent']['class_id']);
			$model->created_by = Yii::$app->user->getId();
			$model->created = time();
			$model->updated = time();
			$model->save(false); 
			Yii::$app->session->setFlash('success', "Announcement has been Added.");
			return $this->redirect(['student_index']);
		}
			return $this->render('comm_thread', [
				'model' => $model,
			]);
	
	}
	
	public function actionUpdate_com_thread($id)
	{
		
		$model = $this->findModel_parent($id);
		if(Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())){
			Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
			return ActiveForm::validate($model);
		}
		$old = $model->student_id;
		if(Yii::$app->request->isPost){
			$model->load(Yii::$app->request->post());
			if(!empty(Yii::$app->request->post()['AnnouncementsParent']['student_id'])){
				$model->student_id =implode(',',Yii::$app->request->post()['AnnouncementsParent']['student_id']);
			}else {
				$model->student_id = '';
			}
			$model->updated = time();
			$model->save(false); 
			
			Yii::$app->session->setFlash('success', "Announcements has been Updated.");
			return $this->redirect(['student_index']);
		}
			return $this->render('update_com_thread', [
				'model' => $model,
			]);
	
	}
			
	public function actionComm_getval()
	{
		extract($_POST);
		return $this->renderAjax('comm_getval', [
				'class' => $classi,'sect' => $sect,'schl' => $schl,'acad_id' => $acad_id,
			]);
	}
			
		

    /**
     * Updates an existing Anouncements model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
		
			$model = $this->findModel($id);
			$model_secondsone = AnouncementTeachersUserids::find()->where(['announcement_id'=>$model->id]);
			$conut_model = $model_secondsone->count();
			$model_second = $model_secondsone->all();
		if(Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())){
			Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
			return ActiveForm::validate($model);
		}
			if(Yii::$app->request->isPost){
			$model->load(Yii::$app->request->post());
			$model->announcements_from = Yii::$app->user->getId();
				
			if(Yii::$app->user->identity->role_id == 1){
					$model->school_id = Yii::$app->user->getId();
				}else{
					$model->school_id = Yii::$app->user->identity->school_id;
				}
			$model->announcements_to = '0';
			$model->created_time = time();
			$model->updated_time = time();
			if($model->save(false)){
				
				foreach($model_second as $thir_deletemodal) {
					$thir_deletemodal->delete();
				}
				
				
				if(Yii::$app->request->post()['AnnouncementsTeacher']['announcements_to'][0] == '0'){
				if(Yii::$app->user->identity->role_id == 1){
					$getcord = UserCustom::find()->where(['=','school_id',Yii::$app->user->identity->id])->andwhere(['or',['role_id'=>5],['role_id'=>3]])->all();
					
				}else{
					$getcord = UserCustom::find()->where(['=','school_id',Yii::$app->user->identity->school_id])->andwhere(['or',['role_id'=>5],['role_id'=>3]])->all();
				}
				foreach($getcord as $newval){
					$model_second = new AnouncementTeachersUserids();
					$model_second->announcement_id = $model->id;
					$model_second->teacher_id = $newval->id;
					$model_second->school_id = $model->school_id;
					
					$model_second->academic_year = $acad;
					$model_second->save(false);
				} 
				
			}else{
				$getcord = Yii::$app->request->post()['AnnouncementsTeacher']['announcements_to'];
				foreach($getcord as $newval){
					$model_second = new AnouncementTeachersUserids();
					$model_second->announcement_id = $model->id;
					$model_second->teacher_id = $newval;
					$model_second->school_id = $model->school_id;
					$model_second->academic_year = $acad;
					$model_second->save(false);
				} 
			}
				
			}
			
			
			Yii::$app->session->setFlash('success', "Announcements has been Updated.");
            return $this->redirect(['index']);
			}
            return $this->render('update', [
                'model' => $model,
            ]);
        
    }

    /**
     * Deletes an existing Anouncements model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();
		
			Yii::$app->session->setFlash('success', "Announcements has been Deleted.");
        return $this->redirect(['index']);
    }
	
	
	public function actionDelete_com_thread($id)
    {
        $this->findModel_parent($id)->delete();
			Yii::$app->session->setFlash('success', "Announcements has been Deleted.");
        return $this->redirect(['student_index']);
    }

    /**
     * Finds the Anouncements model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Anouncements the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = AnnouncementsTeacher::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    } 
	
	protected function findModel_parent($id)
    {
        if (($model = AnnouncementsParent::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}

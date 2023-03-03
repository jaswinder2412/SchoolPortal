<?php

namespace backend\controllers;

use Yii;

use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use backend\models\newStaffdata;
use backend\models\AcedemicYear;
use backend\models\newStaffdata_search;
use backend\models\CordinatorStaff;
use backend\models\CordinatorStaff_search;
use backend\models\SignupForm;
use yii\web\UploadedFile;
use yii\filters\AccessControl;
use backend\models\UserCustom;
use yii\widgets\ActiveForm;

/**
 * StaffController implements the CRUD actions for Staff model.
 */
class StaffController extends Controller
{
    /**
     * @inheritdoc
     */
	 public function behaviors()
    { 
		 $arr1= '';
		 if(isset(Yii::$app->user->identity->id)){
		if (Yii::$app->user->identity->role_id == 1 || Yii::$app->user->identity->role_id == 2 || Yii::$app->user->identity->role_id == 3 || Yii::$app->user->identity->role_id == 4){
			 $arr1 = array('create', 'index','time_table','myprofile','update','delete','deleteimage','staff_profile','cordinator_staff','anouncements','profile_data','viewvarioustime');
		 }
		  else if (Yii::$app->user->identity->role_id == 5){
			 $arr1=array('delete','time_table','myprofile','staff_profile','deleteimage');
		 }else {
			  $arr1=array('delete');
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
     * Lists all Staff models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new newStaffdata_search();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams); 
 
        return $this->render('index', [
             'searchModel' => $searchModel,
            'dataProvider' => $dataProvider, 
        ]); 
    }
	
	 public function actionProfile_data()
		{		
			extract($_POST);
			
			return $this->renderAjax('profile_data', [
             'iid' => $id,
        ]); 
		}

	public function actionCordinator_staff()
    {
        $searchModel = new CordinatorStaff_search();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
 
        return $this->render('cordinator_staff', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]); 
    }

    /**
     * Displays a single Staff model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }
	
	public function actionAnouncements($id)
    {
		
        return $this->render('anouncements', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new newStaffdata model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
		
		
        $model = new newStaffdata();
		$model_second = new SignupForm();
		if(Yii::$app->request->isAjax && $model_second->load(Yii::$app->request->post())){
			//echo "<pre>"; print_r($model_second); die();
			Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
			return ActiveForm::validate($model_second);
		}
		if (Yii::$app->request->isPost) {
            $model_second->load(Yii::$app->request->post());
            $model_second->username = Yii::$app->request->post()['SignupForm']['email'];
            $model_second->email = Yii::$app->request->post()['SignupForm']['email'];
            $model_second->role_id = Yii::$app->request->post()['SignupForm']['role_id']; 
			if(Yii::$app->user->identity->role_id == 1){
				$model_second->school_id = Yii::$app->user->getId();
			}else{
				$model_second->school_id = Yii::$app->user->identity->school_id;
			}
            
            $model_second->password = Yii::$app->request->post()['SignupForm']['password'];
			$model_second->hidden_password = Yii::$app->request->post()['SignupForm']['password'];
			$model->load(Yii::$app->request->post());
			if($myData = $model_second->signup()){
				if(Yii::$app->request->post()['newStaffdata']['status'] == '0'){
					$user_model = UserCustom::find()
						->where(['id'=> $myData->id])
						->one();
						$user_model->status = 0;
						$user_model->save(false);
				}
			$model->user_id = $myData->id;
			$model->created = time();
			$model->updated = time();
			$model->last_updated_by = Yii::$app->user->getId();
			if(Yii::$app->user->identity->role_id == 1){
				$model->school_id = Yii::$app->user->getId();
			}else{
				$model->school_id = Yii::$app->user->identity->school_id;
			}
			$model->co_ordinator_id = Yii::$app->request->post()['newStaffdata']['co_ordinator_id'];
			$model->status = Yii::$app->request->post()['newStaffdata']['status'];
			$model->image = UploadedFile::getInstance($model, 'image');
			if($model->image){
				
			$img_name = time().'_'.$model->image->baseName;
				$model->image->saveAs('uploads/' . $img_name . '.' . $model->image->extension);
                $model->image = $img_name . '.' . $model->image->extension;
			} 
			
			$model->save(false);
			Yii::$app->session->setFlash('success', "New Staff has been Added.");
			 return $this->redirect(['index']);
			
			}
			}
            return $this->render('create', [
                'model' => $model,
				'model_second' => $model_second,
            ]);
        
     }
	
	public function actionTime_table()
	{
		$model = new newStaffdata();
		if(isset($_POST['newacademic']) && !empty($_POST['newacademic'])){
            $acad = $_POST['newacademic'];
			
			 }
		else{
				$presnt_acad = AcedemicYear::find()->Where(['=', 'school_id', Yii::$app->user->identity->school_id])->AndWhere(['=', 'status', 1])->one();
			 $acad = $presnt_acad['id'];
		
		}
		return $this->render('time_table', [
			'model' => $model,
			'academics_set' => $acad,
		]);
	}
		
		public function actionMyprofile()
		{
			
			return $this->render('myprofile');
		}
		
		public function actionViewvarioustime($id)
		{
			$model = $this->findModel($id);			
			return $this->render('viewvarioustime',[
			'model'=>$model,
			]);
		}

    /**
     * Updates an existing Staff model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
		$model_second = $this->findSecondmodel($model->user_id);
		
		/* UserCustom::find()
                    ->where(['id'=> $model->user_id])
                    ->one(); */
			
		$old = $model_second->password_hash;
        $old_img = $model->image;
		$old_hidden_pass = $model_second->hidden_password;
		if(Yii::$app->request->isAjax && $model_second->load(Yii::$app->request->post())){
			//echo "<pre>"; print_r($model_second); die();
			Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
			return ActiveForm::validate($model_second);
		}
		
		if (Yii::$app->request->isPost) {
			
			if($model_second->load(Yii::$app->request->post())){
			
            $model_second->username = Yii::$app->request->post()['UserCustom']['email'];
            $model_second->email = Yii::$app->request->post()['UserCustom']['email'];
			$model_second->role_id = Yii::$app->request->post()['UserCustom']['role_id'];
			$model_second->status = Yii::$app->request->post()['newStaffdata']['status'];
			if(Yii::$app->request->post()['UserCustom']['password'] == ''){
                $model_second->password_hash = $old;
				$model_second->hidden_password = $old_hidden_pass;
				
            }
            else {
                    $model_second->password_hash = Yii::$app->security->generatePasswordHash(Yii::$app->request->post()['UserCustom']['password']);
					$model_second->hidden_password = Yii::$app->request->post()['UserCustom']['password'];
            }

				if ($model_second->save(false)){
					$model->load(Yii::$app->request->post());
					
					  
					$uploaded_image = UploadedFile::getInstance($model, 'image');
					
					if(!empty($uploaded_image)){
						$img_name = time().'_'.$uploaded_image->baseName;
						$uploaded_image->saveAs('uploads/' . $img_name . '.' . $uploaded_image->extension);
						$model->image = $img_name . '.' . $uploaded_image->extension;
								
							}
							else{
								
								$model->image = $old_img;
							}
					if(Yii::$app->request->post()['UserCustom']['role_id'] == '5'){
						$model->co_ordinator_id = Yii::$app->request->post()['newStaffdata']['co_ordinator_id'];
					}else{
						$model->co_ordinator_id = '';
					}
					$model->last_updated_by = Yii::$app->user->getId();
					$model->save(false);
					Yii::$app->session->setFlash('success', "Staff has been Updated.");
					return $this->redirect(['index']);
				}
	    }
		}
            return $this->render('update', [
                'model' => $model, 
				'model_second' => $model_second,
            ]);
        
    }
	
	public function actionStaff_profile() 
    {

		$user_id = Yii::$app->user->getId();
		$get_id = newStaffdata::find()->where(['user_id' => $user_id])->one();
		$id = $get_id['id'];
		$model = $this->findModel($id);
		
		$model_second = $this->findSecondmodel($model->user_id);
	
        $old_img = $model->image;
	
		if (Yii::$app->request->isPost) {
			
			
					$model->load(Yii::$app->request->post());
					
					/* $uploaded_image = UploadedFile::getInstance($model, 'image');
					
					if(!empty($uploaded_image)){
						$img_name = time().'_'.$uploaded_image->baseName;
						$uploaded_image->saveAs('uploads/' . $img_name . '.' . $uploaded_image->extension);
						$model->image = $img_name . '.' . $uploaded_image->extension;
								
							}
							else{
								
								$model->image = $old_img;
							} */
				if(Yii::$app->request->post()['newStaffdata']['image'] == '')
					 {					 
						$code_base64 = Yii::$app->request->post()['base_value'];
						$code_base64 = str_replace('data:image/jpeg;base64,','',$code_base64);
					if(Yii::$app->request->post()['base_value'] != ''){
						$code_binary = base64_decode($code_base64);
						$new_image_name = time().'.jpg';
						$new_path = Yii::getAlias('@backend/web/uploads/'.$new_image_name);
						$file = file_put_contents($new_path, $code_binary);
						
						$model->image = $new_image_name; 
					 }
					 else{
						
						$model->image = $old_img;
					}
				 }
					else{ 
					
					$image = Yii::$app->request->post()['newStaffdata']['image'];
					if($image == $old_img){
						$model->image = $image;
						
					}else{
						$image = strtolower(substr($image,strpos($image,'/')+1));
							$image = strtolower(substr($image,strpos($image,'/')+1));
							$image = strtolower(substr($image,strpos($image,'/')+1));
							$image = strtolower(substr($image,strpos($image,'/')+1));
							$image = strtolower(substr($image,strpos($image,'/')+1));
														
						$model->image = $image;
					}
					
				 }
					$model->last_updated_by = Yii::$app->user->getId();
					$model->save(false);
					Yii::$app->session->setFlash('success', "Profile has been Updated.");
					
				}
	    
	
            return $this->render('staff_profile', [
                'model' => $model, 
				'model_second' => $model_second,
            ]);
        
    }
	
	public function actionDeleteimage()
    {
		$id = $_POST['id'];
        $model = newStaffdata::find()
                    ->where(['id'=> $id])
                    ->one();
		$mix = 'uploads/'.$model->image;
		unlink($mix);
		$model->image = '';
		
		if($model->save(false)){
			
			echo "Removed";
		}
    }
	
    /**
     * Deletes an existing newStaffdata model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
       $model = $this->findModel($id);
		  $second_model= UserCustom::findOne($model->user_id); 
		  $second_model->status = '2';		  
		  $model->status = '2';
		  $second_model->save(); 
		  $model->save(); 
		  
		  Yii::$app->session->setFlash('success', "Staff has been Deactivated.");
        return $this->redirect(['index']);
    }

    /**
     * Finds the newStaffdata model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return newStaffdata the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = newStaffdata::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    } 
	
	protected function findSecondmodel($id)
    {
        if (($model = UserCustom::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    } 
	
	
}

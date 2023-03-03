<?php

namespace backend\controllers;

use Yii;
use backend\models\SchoolList;
use backend\models\SchoolList_search;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use yii\filters\AccessControl;
use backend\models\SignupForm;
use backend\models\UserCustom;
use backend\models\newStaffdata;
use backend\models\AddStudent;
use common\models\User;
use yii\widgets\ActiveForm;
/**
 * SchoolListController implements the CRUD actions for SchoolList model.
 */
class SchoolListController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
		 $arr1= '';
		 if(isset(Yii::$app->user->identity->id)){
		if (Yii::$app->user->identity->role_id == 0){
			 $arr1 = array('create', 'index', 'update', 'view','delete','deleteimage','deleteimageprinc');
		 }
		 else{
			 $arr1=array('view', 'profile','deleteimage','deleteimageprinc');
		 }
		 }else{
			 $arr1=array('view', 'profile','deleteimage','deleteimageprinc');
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
     * Lists all SchoolList models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new SchoolList_search();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
		
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single SchoolList model.
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
     * Creates a new SchoolList model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
		
        $model = new SchoolList();
		$model_second = new SignupForm();
		$model_third = new User();
		if(Yii::$app->request->isAjax && $model_second->load(Yii::$app->request->post())){
			//echo "<pre>"; print_r($model_second); die();
			Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
			return ActiveForm::validate($model_second);
		}
	
		if (Yii::$app->request->isPost) {
			$model_second->load(Yii::$app->request->post());
            $model_second->username = Yii::$app->request->post()['SignupForm']['email'];
            $model_second->email = Yii::$app->request->post()['SignupForm']['email'];
             $model_second->hidden_password = Yii::$app->request->post()['SignupForm']['hidden_password'];
            $model_second->role_id = 1; 
            $model_third->status = Yii::$app->request->post()['SchoolList']['status'];
            $model_second->password = Yii::$app->request->post()['SignupForm']['password'];
			$model->load(Yii::$app->request->post());
		
		 if($myData = $model_second->signup()){
			 
			$model->school_user_id = $myData->id;
			if(Yii::$app->request->post()['SchoolList']['status'] == '0'){
				
				$user_model = UserCustom::find()
                    ->where(['id'=> $myData->id])
                    ->one();
					$user_model->status = 0;
					$user_model->save(false);
			} 
			$model->created_time = time(); 
			$model->updated = time();
			$model->created_by = Yii::$app->user->getId();
			$model->school_logo = UploadedFile::getInstance($model, 'school_logo');
			
			if($model->school_logo){
				$img_name = time().'_'.$model->school_logo->baseName;
				$model->school_logo->saveAs('uploads/' . $img_name . '.' . $model->school_logo->extension);
                $model->school_logo = $img_name . '.' . $model->school_logo->extension;
			}
			
			$model->image = UploadedFile::getInstance($model, 'image');
			
			if($model->image){
				$img_name = time().'-'.$model->image->baseName;
				$model->image->saveAs('uploads/' . $img_name . '.' . $model->image->extension);
                $model->image = $img_name . '.' . $model->image->extension;
			} 
		$model->save(false);
		Yii::$app->session->setFlash('success', "School has been added.");
		return $this->redirect(['index']);
         }  
		
		}
            return $this->render('create', [
                'model' => $model,
				'model_second' => $model_second,
            ]);
       
    }
	
	
/**
     * Creates a new SchoolList model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionProfile()
    {
		$user_id = Yii::$app->user->getId();
		$get_id = SchoolList::find()->where(['school_user_id' => $user_id])->one();
		$id = $get_id['id'];
        $model = $this->findModel($id);
		$model_second = UserCustom::find()
                    ->where(['id'=> $model['school_user_id']])
                    ->one();
					
		$old_img = $model->school_logo;
		$old_img_princ = $model->image;
		if (Yii::$app->request->isPost) {
			$model->load(Yii::$app->request->post());
					
			$uploaded_image = UploadedFile::getInstance($model, 'school_logo');
					
					if(!empty($uploaded_image)){
						$img_name = time().'_'.$uploaded_image->baseName;
						$uploaded_image->saveAs('uploads/' . $img_name . '.' . $uploaded_image->extension);
						$model->school_logo = $img_name . '.' . $uploaded_image->extension;
								
							}
							else{
								
								$model->school_logo = $old_img;
							}
							
			/* $uploaded_image_princ = UploadedFile::getInstance($model, 'image');
					
					if(!empty($uploaded_image_princ)){
						$img_name = time().'-'.$uploaded_image_princ->baseName;
						$uploaded_image_princ->saveAs('uploads/' . $img_name . '.' . $uploaded_image_princ->extension);
						$model->image = $img_name . '.' . $uploaded_image_princ->extension;
							}
							else{
								
								$model->image = $old_img_princ;
							} */
						
					if(Yii::$app->request->post()['SchoolList']['image'] == '')
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
						
						$model->image = $old_img_princ;
					}
				 }
					else{ 
					
					$image = Yii::$app->request->post()['SchoolList']['image'];
					if($image == $old_img_princ){
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
					$model->updated = time();
					$model->save(false);
					Yii::$app->session->setFlash('success', "School has been Updated.");
		
		}
            return $this->render('profile', [
                'model' => $model,
				'model_second' => $model_second,
            ]);
       
    }

    /**
     * Updates an existing SchoolList model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
		$model_second = UserCustom::find()
                    ->where(['id'=> $model->school_user_id])
                    ->one();
		$scholr_id = $model->school_user_id;	
		$old = $model_second->password_hash;
        $old_img = $model->school_logo;
        $old_img_princ = $model->image;
		$old_hidden_pass = $model_second->hidden_password;
		if(Yii::$app->request->isAjax && $model_second->load(Yii::$app->request->post())){
			//echo "<pre>"; print_r($model_second); die();
			Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
			return ActiveForm::validate($model_second);
		}
		
		if (Yii::$app->request->isPost) {
			$model_second->load(Yii::$app->request->post());
			
            $model_second->username = Yii::$app->request->post()['UserCustom']['email'];
            $model_second->email = Yii::$app->request->post()['UserCustom']['email'];
            $model_second->status = Yii::$app->request->post()['SchoolList']['status'];
			if(Yii::$app->request->post()['SchoolList']['status'] == '0'){
				
			$mis =	UserCustom::updateAll(['status' => 0], 'school_id ='.$scholr_id.' AND status = 10');
			$mikl = AddStudent::updateAll(['status' => 0], 'school_id ='.$scholr_id.' AND status = 10');
			$mikls = newStaffdata::updateAll(['status' => 0], 'school_id ='.$scholr_id.' AND status = 10');
			
			}else {
				$mis =	UserCustom::updateAll(['status' => 10], 'school_id ='.$scholr_id.' AND status = 0');
				$mikl = AddStudent::updateAll(['status' => 10], 'school_id ='.$scholr_id.' AND status = 0');
				$mikls = newStaffdata::updateAll(['status' => 10], 'school_id ='.$scholr_id.' AND status = 0');
			}
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
					
					  
					$uploaded_image = UploadedFile::getInstance($model, 'school_logo');
					
					if(!empty($uploaded_image)){
						$img_name = time().'_'.$uploaded_image->baseName;
						$uploaded_image->saveAs('uploads/' . $img_name . '.' . $uploaded_image->extension);
						$model->school_logo = $img_name . '.' . $uploaded_image->extension;
								
							}
							else{
								
								$model->school_logo = $old_img;
							}
				$uploaded_image_princ = UploadedFile::getInstance($model, 'image');
					
					if(!empty($uploaded_image_princ)){
						$img_name = time().'-'.$uploaded_image_princ->baseName;
						$uploaded_image_princ->saveAs('uploads/' . $img_name . '.' . $uploaded_image_princ->extension);
						$model->image = $img_name . '.' . $uploaded_image_princ->extension;
							}
							else{
								
								$model->image = $old_img_princ;
							}
					
					$model->save(false);
					Yii::$app->session->setFlash('success', "School has been Updated.");
					return $this->redirect(['index']);
					
				}
				
				
	    }
            return $this->render('update', [
                'model' => $model, 
				'model_second' => $model_second,
            ]);
        
    
}
    /**
     * Deletes an existing SchoolList model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
		$second_model= UserCustom::findOne($model->school_user_id); 
		$model->status = '0';
		$second_model->status = '0';
			$model->save(false);	
			$second_model->save(false);
			$mis =	UserCustom::updateAll(['status' => 0], 'school_id ='.$model->school_user_id.' AND status = 10');
			$mikl = AddStudent::updateAll(['status' => 0], 'school_id ='.$model->school_user_id.' AND status = 10');
			$mikls = newStaffdata::updateAll(['status' => 0], 'school_id ='.$model->school_user_id.' AND status = 10');
			
			
	   
		 Yii::$app->session->setFlash('success', "School has been Deactivated.");
        return $this->redirect(['index']);
    }
	
	
	public function actionDeleteimage()
    {
		$id = $_POST['id'];
        $model = SchoolList::find()
                    ->where(['id'=> $id])
                    ->one();
		$model->school_logo = '';
		if($model->save(false)){
			
			echo "Removed";
		}
    }
	
	public function actionDeleteimageprinc()
    {
		$id = $_POST['id'];
        $model = SchoolList::find()
                    ->where(['id'=> $id])
                    ->one();
		$model->image = '';
		if($model->save(false)){
			
			echo "Removed";
		}
    }

    /**
     * Finds the SchoolList model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return SchoolList the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = SchoolList::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
	
	public static function findIdentityRole($id)
    {
		$myrole = Users::find()->where(['id'=> Yii::$app->user->identity->id])->one();
		return $myrole;
	}
	
}

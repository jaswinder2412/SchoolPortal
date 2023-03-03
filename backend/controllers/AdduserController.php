<?php

namespace backend\controllers;

use Yii;
use backend\models\AddStudent;
use backend\models\AddStudent_search;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use backend\models\SignupForm;
use yii\web\UploadedFile;
use yii\filters\AccessControl;
use yii\widgets\ActiveForm;
use backend\models\UserCustom;
use backend\models\TeacherStudent;
use backend\models\TeacherStudent_search;
use backend\models\ClassteacherSubject;
use backend\models\Section;
use backend\models\ClassteacherSubject_search;
use backend\models\AcedemicYear;
use backend\models\AnnouncementsParent;
use backend\models\Assignmentclasses;
use backend\models\ClassInfo;
use backend\models\ClassSubject;
use backend\models\ClassStudent;
use backend\models\ClassAssignedStudent;
use backend\models\InhouseTestGrading;
use backend\models\FinalExamGrading;

/**
 * AdduserController implements the CRUD actions for AddStudent model.
 */
class AdduserController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    { 
		 $arr1= '';
		 if(isset(Yii::$app->user->identity->id)){
		if (Yii::$app->user->identity->role_id == 1 || Yii::$app->user->identity->role_id == 2 || Yii::$app->user->identity->role_id == 3 || Yii::$app->user->identity->role_id == 4){
			 $arr1 = array('create', 'index','myprofile','update','delete','deleteimage','getsection','deletealltable');
		 }
		 else if (Yii::$app->user->identity->role_id == 5){
			 $arr1=array('myprofile','editprofile','deleteimage','teacherindex','getsection','deletealltable');
		 }else {
			 $arr1=array('myprofile','editprofile','deleteimage','datesheet','inhouse_datesheet','getsection','deletealltable');
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
     * Lists all AddStudent models.
     * @return mixed
     */
    public function actionIndex()
    {
		
        $searchModel = new AddStudent_search();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    } 

    public function actionTeacherindex()
    {
		if(isset($_POST['newacademic']) && !empty($_POST['newacademic'])){
            $acad = $_POST['newacademic'];
			
			 }
		else{
				$presnt_acad = AcedemicYear::find()->Where(['=', 'school_id', Yii::$app->user->identity->school_id])->AndWhere(['=', 'status', 1])->one();
			 $acad = $presnt_acad['id'];
		
		}
        $searchModel = new ClassteacherSubject_search();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('teacherindex', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
			'academics_set' => $acad,
        ]);
    }

    /**
     * Displays a single AddStudent model.
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
     * Creates a new AddStudent model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
		 
        $model = new AddStudent();
		$model_second = new SignupForm();
		$model_thirds = new ClassAssignedStudent();
		$creation_model = new ClassStudent;
		if(Yii::$app->request->isAjax && $model_second->load(Yii::$app->request->post())){
			Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
			return ActiveForm::validate($model_second);
		}
		if (Yii::$app->request->isPost) {
			
            $model_second->load(Yii::$app->request->post());
            $model_second->username = Yii::$app->request->post()['SignupForm']['email'];
            $model_second->email = Yii::$app->request->post()['SignupForm']['email'];
            $model_second->role_id = 6; 
			if(Yii::$app->user->identity->role_id == 1){
				$model_second->school_id = Yii::$app->user->getId();
			}else{
				$model_second->school_id = Yii::$app->user->identity->school_id;
			}
          
            $model_second->password = Yii::$app->request->post()['SignupForm']['password'];
			$model_second->hidden_password = Yii::$app->request->post()['SignupForm']['password'];
			$model->load(Yii::$app->request->post()); 
			if($myData = $model_second->signup()){
				if(Yii::$app->request->post()['AddStudent']['status'] == '0'){
					$user_model = UserCustom::find()
						->where(['id'=> $myData->id])
						->one();
						$user_model->status = 0;
						$user_model->save(false);
				}
			$model->user_id = $myData->id;
			$model->created = time();
			$model->updated = time();
			if(Yii::$app->user->identity->role_id == 1){
				$model->school_id = Yii::$app->user->getId();
			}else{
				$model->school_id = Yii::$app->user->identity->school_id;
			}
			$model->status = Yii::$app->request->post()['AddStudent']['status'];
			$model->last_updated_by = Yii::$app->user->getId();
			 
				  
			 $model->image = UploadedFile::getInstance($model, 'image');
			
			if($model->image){
				$img_name = time().'_'.$model->image->baseName;
				$model->image->saveAs('uploads/' . $img_name . '.' . $model->image->extension);
                $model->image = $img_name . '.' . $model->image->extension;
			} 
			
			$model->save(false);
			$get_class = Yii::$app->request->post()['ClassAssignedStudent']['class_id'];
			if(!empty($get_class)){
				$get_section = Yii::$app->request->post()['ClassAssignedStudent']['section_id'];
			} 
			else{
				$get_section = '';
			}
			
			
			if(!empty($get_class) && !empty($get_section)){
				
				if (Yii::$app->user->identity->role_id == 1) {
					$presentacad = AcedemicYear::find()->Where(['=', 'school_id', Yii::$app->user->getId()])->AndWhere(['=', 'status', 1])->one();
					
					$presnt_acad_id = $presentacad['id'];
					$newschol = Yii::$app->user->getId();
					
				} else {
					$presentacad = AcedemicYear::find()->Where(['=', 'school_id', Yii::$app->user->identity->school_id])->AndWhere(['=', 'status', 1])->one();
					$presnt_acad_id = $presentacad['id'];
					$newschol = Yii::$app->user->identity->school_id;
				}
				
				$presentacadclass = ClassInfo::find()->where(['class_name'=>$get_class])->andwhere(['=','class_section',$get_section])->andwhere(['=','school_id',$newschol])->andwhere(['=','academic_year',$presnt_acad_id])->one();
				
				$creation_model->class_id = $presentacadclass['id'];
				$creation_model->student_id = $myData->id;
				$creation_model->Academic_year_id = $presnt_acad_id;
				$creation_model->school_id = $newschol;
				$creation_model->created_date = time();
				$creation_model->updated_date = time();
				$creation_model->save(false);
				
			}
			
			
			Yii::$app->session->setFlash('success', "New Student has been Added.");
            return $this->redirect(['index']); 
				
			}
			
        } 
            return $this->render('create', [
                'model' => $model,
				'model_second' => $model_second,
				'model_thirds' => $model_thirds, 
            ]);
        
    }

    /**
     * Updates an existing AddStudent model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
		$model_thirds = new ClassAssignedStudent();
		$studentrs = $model->user_id;
		$model_second = UserCustom::find()
                    ->where(['id'=> $model->user_id])
                    ->one();
			
		$old = $model_second->password_hash;
        $old_img = $model->image;
		$old_hidden_pass = $model_second->hidden_password;
		if(Yii::$app->request->isAjax && $model_second->load(Yii::$app->request->post())){
	
			Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
			return ActiveForm::validate($model_second);
		}
		
		if (Yii::$app->request->isPost) {
			
			if($model_second->load(Yii::$app->request->post())){
			
            $model_second->username = Yii::$app->request->post()['UserCustom']['email'];
            $model_second->email = Yii::$app->request->post()['UserCustom']['email'];
			$model_second->status = Yii::$app->request->post()['AddStudent']['status'];
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
					$model->last_updated_by = Yii::$app->user->getId();
					
					 $uploaded_image = UploadedFile::getInstance($model, 'image');
					
					if(!empty($uploaded_image)){
						$img_name = time().'_'.$uploaded_image->baseName;
						$uploaded_image->saveAs('uploads/' . $img_name . '.' . $uploaded_image->extension);
						$model->image = $img_name . '.' . $uploaded_image->extension;
								
					}
					else{
						
						$model->image = $old_img;
					} 
						
					$model->status = Yii::$app->request->post()['AddStudent']['status'];
					$model->save(false);
			
				if (Yii::$app->user->identity->role_id == 1) {
					$presentacad = AcedemicYear::find()->Where(['=', 'school_id', Yii::$app->user->getId()])->AndWhere(['=', 'status', 1])->one();
					
					$presnt_acad_id = $presentacad['id'];
					$newschol = Yii::$app->user->getId();
					
				} else {
					$presentacad = AcedemicYear::find()->Where(['=', 'school_id', Yii::$app->user->identity->school_id])->AndWhere(['=', 'status', 1])->one();
					$presnt_acad_id = $presentacad['id'];
					$newschol = Yii::$app->user->identity->school_id;
				}
			

			$class_countcheck = ClassStudent::find()->where(['student_id'=>$studentrs])->andwhere(['=','school_id',$newschol])->andwhere(['=','Academic_year_id',$presnt_acad_id])->count();
			if($class_countcheck > 0){
				
				$get_class = Yii::$app->request->post()['ClassAssignedStudent']['class_id'];
			$get_section = Yii::$app->request->post()['ClassAssignedStudent']['section_id'];
					
					
				if(!empty($get_class) && !empty($get_section)){
					
					$creation_model = ClassStudent::find()->where(['student_id'=>$studentrs])->andwhere(['=','school_id',$newschol])->andwhere(['=','Academic_year_id',$presnt_acad_id])->one();
					
					$presentacadclass = ClassInfo::find()->where(['class_name'=>$get_class])->andwhere(['=','class_section',$get_section])->andwhere(['=','school_id',$newschol])->andwhere(['=','academic_year',$presnt_acad_id])->one();
					
					$creation_model->class_id = $presentacadclass['id'];
					$creation_model->student_id = $studentrs;
					$creation_model->Academic_year_id = $presnt_acad_id;
					$creation_model->school_id = $newschol;
					$creation_model->created_date = time();
					$creation_model->updated_date = time();
					$creation_model->save(false);
					
				}
				
			}
			else
			{
			
			$get_class = Yii::$app->request->post()['ClassAssignedStudent']['class_id'];
			if(!empty($get_class)){
				$get_section = Yii::$app->request->post()['ClassAssignedStudent']['section_id'];
			} 
			else{
				$get_section = '';
			}		
					
			if(!empty($get_class) && !empty($get_section)){
				
				$creation_model = new ClassStudent;
				
				$presentacadclass = ClassInfo::find()->where(['class_name'=>$get_class])->andwhere(['=','class_section',$get_section])->andwhere(['=','school_id',$newschol])->andwhere(['=','academic_year',$presnt_acad_id])->one();
				
				$creation_model->class_id = $presentacadclass['id'];
				$creation_model->student_id = $studentrs;
				$creation_model->Academic_year_id = $presnt_acad_id;
				$creation_model->school_id = $newschol;
				$creation_model->created_date = time();
				$creation_model->updated_date = time();
				$creation_model->save(false);
				
			}
			}
			
					
					
					
					Yii::$app->session->setFlash('success', "Student has been Updated.");
					return $this->redirect(['index']);
				}
	    }
		}
            return $this->render('update', [
                'model' => $model, 
				'model_second' => $model_second,
				'model_thirds' => $model_thirds,
            ]);
    }
	
	
	public function actionGetsection()
    {
		extract($_POST);
		if(Yii::$app->user->identity->role_id == 1){
		$academine = AcedemicYear::find()->Where(['=', 'school_id', Yii::$app->user->getId()])->AndWhere(['=', 'status', 1])->one();
	   }else{
	   $academine = AcedemicYear::find()->Where(['=', 'school_id', Yii::$app->user->identity->school_id])->AndWhere(['=', 'status', 1])->one();
	   }
		echo "<option value=''>Please Select</option>";
		$getingsection = ClassInfo::find()->where(['class_name'=>$class_ids])->andwhere(['=','academic_year',$academine['id']])->groupBy(['class_section'])->all(); 
		
		foreach($getingsection as $sectionwise) {
			$getsections_name = Section::find()->where(['id'=>$sectionwise->class_section])->one();
			echo "<option value='".$getsections_name['id']."' > ".$getsections_name['section_name']."</option>";
			
		}
	}
	
	public function actionEditprofile($id)
    {
        $model = $this->findModel($id);
		$model_second = UserCustom::find()
                    ->where(['id'=> $model->user_id])
                    ->one();
			
        $old_img = $model->image;
		if(Yii::$app->request->isAjax && $model_second->load(Yii::$app->request->post())){
	
			Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
			return ActiveForm::validate($model_second);
		}
		
		if (Yii::$app->request->isPost) {
			
		
					$model->load(Yii::$app->request->post());
					$model->last_updated_by = Yii::$app->user->getId();
					/* $uploaded_image = UploadedFile::getInstance($model, 'image');
					
					if(!empty($uploaded_image)){
						$img_name = time().'_'.$uploaded_image->baseName;
						$uploaded_image->saveAs('uploads/' . $img_name . '.' . $uploaded_image->extension);
						$model->image = $img_name . '.' . $uploaded_image->extension;
								
							}
							else{
								
								$model->image = $old_img;
							} */
						
					if(Yii::$app->request->post()['AddStudent']['image'] == '')
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
					
					$image = Yii::$app->request->post()['AddStudent']['image'];
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
					$model->save(false);
					Yii::$app->session->setFlash('success', "Profile has been Updated.");
					return $this->redirect(['myprofile', 'id' => $model->id]);
					    
		}
            return $this->render('editprofile', [
                'model' => $model, 
				'model_second' => $model_second,
            ]);
    }
	
	public function actionMyprofile($id)
	{
		$model = $this->findModel($id);
		$model_second = UserCustom::find()
                    ->where(['id'=> $model->user_id])
                    ->one();
		
		return $this->render('myprofile', [
                'model' => $model, 
				'model_second' => $model_second,
            ]);
	}
    /**
     * Deletes an existing AddStudent model.
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
		Yii::$app->session->setFlash('success', "Student has been Deactivated.");
        return $this->redirect(['index']);
    }
	
	public function actionDeleteimage()
    {
		$id = $_POST['id'];
        $model = AddStudent::find()
                    ->where(['id'=> $id])
                    ->one();
		$mix = 'uploads/'.$model->image;
		unlink($mix);
		$model->image = '';
		
		if($model->save(false)){
			
			echo "Removed";
		}
    }
	
	public function actionDeletealltable($id) {
        $model = AddStudent::findOne($id);
        $tablename = $_POST['tablename'];
		
	  if ($tablename == 'parentsannouncements'){
			 
                $checkin = AnnouncementsParent::deleteAll('student_id = :student_ids', [':student_ids' => $id]); 
                return "Announcement data deleted";
				
		}else if($tablename == 'classassignments') {
			
		$checkin = Assignmentclasses::deleteAll('student_id = :student_ids', [':student_ids' => $id]); 
			return "Assignment data deleted";
		} 
		else  if($tablename == 'exammarks') {
			 $checkin =	FinalExamGrading::deleteAll('student_id = :student_ids', [':student_ids' => $id]); 
			return "Test data deleted";
		} 
		else if($tablename == 'testmarks') {
			$checkin = InhouseTestGrading::deleteAll('student_id = :student_ids', [':student_ids' => $id]);
			return "Exam data deleted";
		} 
		else if($tablename == 'class') {
			$checkin = ClassStudent::deleteAll('student_id = :student_ids', [':student_ids' => $id]);
			return "Class data deleted";
		} 
		else if($tablename == 'student') {
			$checkin = AddStudent::deleteAll('user_id = :student_ids', [':student_ids' => $id]);
			return "Student data deleted";
		} 
		else if($tablename == 'user') {
			$checkin = UserCustom::deleteAll('id = :student_ids', [':student_ids' => $id]);
			return "User data deleted";
		}
		
		
    }
	
	
	public function actionDatesheet()
    { 
	
		if(isset($_POST['newacademic']) && !empty($_POST['newacademic'])){
            $acad = $_POST['newacademic'];
			
			 }
		else{
				$presnt_acad = AcedemicYear::find()->Where(['=', 'school_id', Yii::$app->user->identity->school_id])->AndWhere(['=', 'status', 1])->one();
			 $acad = $presnt_acad['id'];
		
		}
     
	   return $this->render('datesheet',[
			'academics_set' => $acad,
        ]);
		
		
    }
	
	public function actionInhouse_datesheet()
    { 
	
		if(isset($_POST['newacademic']) && !empty($_POST['newacademic'])){
            $acad = $_POST['newacademic'];
			
			 }
		else{
				$presnt_acad = AcedemicYear::find()->Where(['=', 'school_id', Yii::$app->user->identity->school_id])->AndWhere(['=', 'status', 1])->one();
			 $acad = $presnt_acad['id'];
		
		}
     
	   return $this->render('inhouse_datesheet',[
			'academics_set' => $acad,
        ]);
		
		
    }

    /**
     * Finds the AddStudent model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return AddStudent the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = AddStudent::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
	
	

}
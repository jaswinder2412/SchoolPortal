<?php

namespace backend\controllers;

use Yii;
use backend\models\AcedemicYear;
use backend\models\Assignmentclasses;
use backend\models\Assignmentclasses_search;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\UploadedFile;

/**
 * AssignmentController implements the CRUD actions for Assignmentclasses model.
 */
class AssignmentController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
		$arr1= '';
		 if(isset(Yii::$app->user->identity->id)){
		if (Yii::$app->user->identity->role_id == 1 || Yii::$app->user->identity->role_id == 2 || Yii::$app->user->identity->role_id == 3 || Yii::$app->user->identity->role_id == 4 || Yii::$app->user->identity->role_id == 5){
			 $arr1 = array('create', 'update','delete','index','view','comm_getval','filedupload','deletefiles');
		 }
		 else{
			 $arr1=array('index');
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

	public function beforeAction($action) {
    $this->enableCsrfValidation = false;
    return parent::beforeAction($action);
		}
    /**
     * Lists all Assignmentclasses models.
     * @return mixed
     */
    public function actionIndex()
    {
		if(isset($_POST['newacademic']) && !empty($_POST['newacademic'])){
            $acad = $_POST['newacademic'];
			
			 }
		else{
				$presnt_acad = AcedemicYear::find()->Where(['=', 'school_id', Yii::$app->user->identity->school_id])->AndWhere(['=', 'status', 1])->one();
			 $acad = $presnt_acad->id;
		
		}
		
     if(isset($_GET['newid']) && !empty($_GET['newid'])){
            $newidsr = $_GET['newid'];
			
			 }
		else{
				
			 $newidsr = 0;
		
		}
		
     
        $searchModel = new Assignmentclasses_search();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
			'academics_set' => $acad,
			'assignid' => $newidsr,
        ]);
    }

    /**
     * Displays a single Assignmentclasses model.
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
     * Creates a new Assignmentclasses model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Assignmentclasses();
		if(Yii::$app->request->isPost){
			$model->load(Yii::$app->request->post());
			if(!empty(Yii::$app->request->post()['Assignmentclasses']['student_id'])){
				$model->student_id =implode(',',Yii::$app->request->post()['Assignmentclasses']['student_id']);
			}
			$model->class_id = implode(',',Yii::$app->request->post()['Assignmentclasses']['class_id']);
			$model->created_by = Yii::$app->user->getId();
			$model->created = time();
			$model->updated = time();
			$model->fileupload = UploadedFile::getInstance($model, 'fileupload');
			
			if($model->fileupload){
				$img_name = time().'_'.$model->fileupload->baseName;
				$model->fileupload->saveAs('upload_file/' . $img_name . '.' . $model->fileupload->extension);
                $model->fileupload = $img_name . '.' . $model->fileupload->extension;
			}
			
			$model->save(false); 
			Yii::$app->session->setFlash('success', "Assignment has been Added.");
			return $this->redirect(['index']);
		}
			return $this->render('create', [
				'model' => $model,
			]);
    }

    /**
     * Updates an existing Assignmentclasses model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
		 $old_img = $model->fileupload;
        $old = $model->student_id;
		if(Yii::$app->request->isPost){
			$model->load(Yii::$app->request->post());
			if(!empty(Yii::$app->request->post()['Assignmentclasses']['student_id'])){
				$model->student_id =implode(',',Yii::$app->request->post()['Assignmentclasses']['student_id']);
			}else {
				$model->student_id = '';
			}
			$model->updated = time();
			$uploaded_image = UploadedFile::getInstance($model, 'fileupload');
					
					if(!empty($uploaded_image)){
						$img_name = time().'_'.$uploaded_image->baseName;
						$uploaded_image->saveAs('upload_file/' . $img_name . '.' . $uploaded_image->extension);
						$model->fileupload = $img_name . '.' . $uploaded_image->extension;
								
							}
							else{
								
								$model->fileupload = $old_img;
							}
			$model->save(false); 
			
			Yii::$app->session->setFlash('success', "Assignment has been Updated.");
			return $this->redirect(['index']);
		}
			return $this->render('update', [
				'model' => $model,
			]);
    }

    /**
     * Deletes an existing Assignmentclasses model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();
        Yii::$app->session->setFlash('success', "Assignment has been Deleted.");
        return $this->redirect(['index']);
    }

	public function actionComm_getval()
	{
		extract($_POST);
		return $this->renderAjax('comm_getval', [
				'class' => $classi,'sect' => $sect,'schl' => $schl,'acad_id' => $acad_id,
			]);
	}
	
	
	public function actionFiledupload() { 
		
        if ($_FILES) {
			
            $uploaddir = Yii::getAlias('@uploads_file/');
			
            $image_name = time() . '_' . $_FILES['file']['name'];
            $uploadfile = $uploaddir . $image_name;
            $filename = $_FILES['file']['name'];

            $my_array = array($filename);
            $imageName = explode('.', $_FILES['file']['name']);
           
                    $_SESSION['file1'][] = $imageName;
                    if (move_uploaded_file($_FILES['file']['tmp_name'], $uploadfile)) {
                        //$images = array($image_name);
                        $_SESSION['image'][] = $image_name;
                        $output['Success'] = "File Uploaded Successfully";
                        $output['filename'] = $image_name;
                        return json_encode($_SESSION['image']);
					} else {
                        $output['Error'] = "File donot uploaded";
                        return json_encode($output);
                    }
        } 
		return $this->render('index', [
                    'session' => $session,
        ]);
	 }
	 
	public function actionDeletefiles()
    {
		$id = $_POST['id'];
        $model = Assignmentclasses::find()
                    ->where(['id'=> $id])
                    ->one();
		$mix = 'upload_file/'.$model->fileupload;
		unlink($mix);
		$model->fileupload = '';
		
		if($model->save(false)){
			
			echo "Removed";
		}
    }	 
    /**
     * Finds the Assignmentclasses model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Assignmentclasses the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Assignmentclasses::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}

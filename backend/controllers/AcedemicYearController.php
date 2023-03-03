<?php

namespace backend\controllers;

use Yii;
use backend\models\AcedemicYear;
use backend\models\AcedemicYear_Search;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\widgets\ActiveForm;
use yii\filters\AccessControl;
/**
 * AcedemicYearController implements the CRUD actions for AcedemicYear model.
 */
class AcedemicYearController extends Controller
{
   public function behaviors()
    {
		 $arr1= '';
		 if(isset(Yii::$app->user->identity->id)){
		if (Yii::$app->user->identity->role_id == 1){
			 $arr1 = array('create', 'index', 'update', 'view','delete');
		 }
		 else{
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
     * Lists all AcedemicYear models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new AcedemicYear_Search();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single AcedemicYear model.
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
     * Creates a new AcedemicYear model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
		
        $model = new AcedemicYear();
		if(Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())){
			Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
			return ActiveForm::validate($model);
		}
		if (Yii::$app->request->isPost){
			$model->load(Yii::$app->request->post());
			$originalDate = Yii::$app->request->post()['AcedemicYear']['from']; 	
			$newDate = Yii::$app->request->post()['AcedemicYear']['from'];
			$originalDate_second = Yii::$app->request->post()['AcedemicYear']['to']; 	
			$newDate_second = Yii::$app->request->post()['AcedemicYear']['to']; 
			
			$check_model = AcedemicYear::find()->where(['from' => $newDate])->andwhere(['to'=>$newDate_second])->andwhere(['school_id'=>Yii::$app->user->getId()])->count();
			
			if($check_model == '0'){
				$model->from = $newDate ;
				$model->to = $newDate_second;
				$model->created_date = time();
				$model->updated_date = time();
				$model->school_id = Yii::$app->user->getId();
				$model->save(false);
				Yii::$app->session->setFlash('success', "Academic Year has been Added.");
			}else
			{
				Yii::$app->session->setFlash('warning', "Academic Year already exist.");
			}

			
			 return $this->redirect(['index']);
		}
       
            return $this->render('create', [
                'model' => $model,
            ]);
        
    }

    /**
     * Updates an existing AcedemicYear model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
		if(Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())){
			Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
			return ActiveForm::validate($model);
		}
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
			Yii::$app->session->setFlash('success', "Academic Year has been Updated.");
            return $this->redirect(['index']);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing AcedemicYear model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();
		Yii::$app->session->setFlash('success', "Academic Year has been Deleted.");
        return $this->redirect(['index']);
    }

    /**
     * Finds the AcedemicYear model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return AcedemicYear the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = AcedemicYear::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
	

	
}

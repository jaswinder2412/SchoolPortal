<?php

namespace backend\controllers;

use Yii;
use backend\models\AddTest;
use backend\models\AddTest_search;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\widgets\ActiveForm;

/**
 * AddTestController implements the CRUD actions for AddTest model.
 */
class AddTestController extends Controller
{
    /**
     * @inheritdoc
     */
   public function behaviors()
    {
		 $arr1= '';
		 if(isset(Yii::$app->user->identity->id)){
		if (Yii::$app->user->identity->role_id == 5){
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
     * Lists all AddTest models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new AddTest_search();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single AddTest model.
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
     * Creates a new AddTest model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new AddTest();

        if(Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())){
			Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
			return ActiveForm::validate($model);
		}
        if (Yii::$app->request->isPost){
			$model->load(Yii::$app->request->post());
			$model->created = time();
			$model->created_by = Yii::$app->user->getId();
			$model->updated = time();
			if(Yii::$app->user->identity->role_id == 1){
				$model->school_id = Yii::$app->user->getId();
			}else{
				$model->school_id = Yii::$app->user->identity->school_id;
			}
			$model->save(false);
			Yii::$app->session->setFlash('success', "Test Name has been Added.");
            return $this->redirect(['index']);
		}
		return $this->render('create', [
                'model' => $model,
            ]);
    }

    /**
     * Updates an existing AddTest model.
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
		if(Yii::$app->request->isPost){
		   $model->load(Yii::$app->request->post()); 
		   $model->updated = time();
		   $model->save(false);
			Yii::$app->session->setFlash('success', "Test Name has been Updated.");
		   return $this->redirect(['index']);
        } 
            return $this->render('update', [
                'model' => $model,
            ]);
    }

    /**
     * Deletes an existing AddTest model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();
		Yii::$app->session->setFlash('success', "Exam has been Deleted.");
        return $this->redirect(['index']);
    }

    /**
     * Finds the AddTest model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return AddTest the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = AddTest::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}

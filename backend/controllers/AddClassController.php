<?php

namespace backend\controllers;

use Yii;
use backend\models\AddClass;
use backend\models\AddClass_search;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\widgets\ActiveForm;
/**
 * AddClassController implements the CRUD actions for AddClass model.
 */
class AddClassController extends Controller
{
    /**
     * @inheritdoc
     */
   public function behaviors()
    {
		 $arr1= '';
		 if(isset(Yii::$app->user->identity->id)){
		if (Yii::$app->user->identity->role_id == 1 || Yii::$app->user->identity->role_id == 2 || Yii::$app->user->identity->role_id == 3 || Yii::$app->user->identity->role_id == 4){
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
     * Lists all AddClass models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new AddClass_search();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single AddClass model.
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
     * Creates a new AddClass model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new AddClass();
		if(Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())){
			Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
			return ActiveForm::validate($model);
		}
        if (Yii::$app->request->isPost){
			$model->load(Yii::$app->request->post());
			$model->created = time();
			$model->updated = time();
			if(Yii::$app->user->identity->role_id == 1){
				$model->school_id = Yii::$app->user->getId();
			}else{
				$model->school_id = Yii::$app->user->identity->school_id;
			}
			$model->save(false);
			Yii::$app->session->setFlash('success', "Class has been Added.");
            return $this->redirect(['index']);
		}
		return $this->render('create', [
                'model' => $model,
            ]);
      
    }

    /**
     * Updates an existing AddClass model.
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
		  $model->last_updated_by = Yii::$app->user->getId();
		   $model->save(false);
			Yii::$app->session->setFlash('success', "Class has been Updated.");
		   return $this->redirect(['index']);
        } 
            return $this->render('update', [
                'model' => $model,
            ]);
        
    }

    /**
     * Deletes an existing AddClass model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();
		Yii::$app->session->setFlash('success', "Class has been Deleted.");
        return $this->redirect(['index']);
    }

    /**
     * Finds the AddClass model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return AddClass the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = AddClass::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}

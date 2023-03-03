<?php

namespace backend\controllers;

use Yii;
use backend\models\Subject;
use backend\models\Subject_search;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\widgets\ActiveForm;
/**
 * SubjectController implements the CRUD actions for Subject model.
 */
class SubjectController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
		$arr1= '';
		 if(isset(Yii::$app->user->identity->id)){
		if (Yii::$app->user->identity->role_id == 1 || Yii::$app->user->identity->role_id == 2 || Yii::$app->user->identity->role_id == 3 || Yii::$app->user->identity->role_id == 4){
			 $arr1 = array('create', 'index','delete','update');
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
     * Lists all Subject models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new Subject_search();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel, 
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Subject model.
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
     * Creates a new Subject model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
		
		
        $model = new Subject();
		if(Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())){
			Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
			return ActiveForm::validate($model);
		}		
        if (Yii::$app->request->isPost) {
			$model->load(Yii::$app->request->post());
			$model->created_by = Yii::$app->user->getId();
			if(Yii::$app->user->identity->role_id == 1){
				$model->school_id = Yii::$app->user->getId();
			}else{
				$model->school_id = Yii::$app->user->identity->school_id;
			} 
			$model->created_date = time();
			$model->updated_date = time();
			$model->save(false);
			Yii::$app->session->setFlash('success', "New Subject has been Added.");
			return $this->redirect(['index']);
        } 
            return $this->render('create', [
                'model' => $model,
            ]);
       
    }

    /**
     * Updates an existing Subject model.
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
				$model->updated_date = time();
		  $model->last_updated_by = Yii::$app->user->getId();
				$model->save(false); 
			Yii::$app->session->setFlash('success', "Subject has been Updated.");
            return $this->redirect(['index']);
		}
		return $this->render('update', [
                'model' => $model,
            ]);
    }

    /**
     * Deletes an existing Subject model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();
		Yii::$app->session->setFlash('success', "Subject has been Deleted.");
        return $this->redirect(['index']);
    }

    /**
     * Finds the Subject model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Subject the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Subject::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}

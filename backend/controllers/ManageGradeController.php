<?php

namespace backend\controllers;

use Yii;
use backend\models\Exam;
use backend\models\ExamClass;
use backend\models\Exam_search;
use backend\models\ManageGrade;
use backend\models\ManageGrade_Search;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/**
 * ManageGradeController implements the CRUD actions for ManageGrade model.
 */
class ManageGradeController extends Controller
{
    /**
     * @inheritdoc
     */
 public function behaviors()
    { 
		 $arr1= '';
		 if(isset(Yii::$app->user->identity->id)){
		if (Yii::$app->user->identity->role_id == 1 || Yii::$app->user->identity->role_id == 2 || Yii::$app->user->identity->role_id == 3 || Yii::$app->user->identity->role_id == 4 || Yii::$app->user->identity->role_id == 5){
			 $arr1 = array('create', 'update','delete','index','view','teacher_index','view_exam','exam_managing','update_markes','update_gradess','addgrade');
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
     * Lists all ManageGrade models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ManageGrade_Search();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
	
	 public function actionTeacher_index()
    {
        $searchModel = new Exam_search();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('teacher_index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
	
	public function actionView_exam()
    {
        $model = new ManageGrade();

        
            return $this->render('view_exam', [
                'model' => $model,
            ]);
        
    }


    /**
     * Displays a single ManageGrade model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }
	
	public function actionExam_managing()
    {
        return $this->render('exam_managing');
    }
	
	
	public function actionUpdate_gradess()
    {
        extract($_POST);
		$subjects_id = $_POST['subject_id'];
		$grade_val = $_POST['grade_val'];
		foreach($subjects_id as $key => $subject_id){
			$getval = ManageGrade::find()->where(['exam_id'=>$exam_id])->andwhere(['class_id'=>$class_id])->andwhere(['subject_id'=>$subject_id])->andwhere(['student_id'=>$student_id])->one();
		if(!empty($getval)){
			$getval['exam_id'] = $exam_id;
			$getval['class_id'] = $class_id;
			$getval['section_id'] = $section_id;
			$getval['subject_id'] = $subject_id;
			$getval['student_id'] = $student_id;
			$getval['grade'] = $grade_val[$key];
			$getval->save(false);
		}else{ 
			$model = new ManageGrade();
			$model->load(Yii::$app->request->post());
			$model->exam_id = $exam_id;
			$model->class_id = $class_id;
			$model->section_id = $section_id;
			$model->subject_id = $subject_id;
			$model->student_id = $student_id;
			$model->grade = $grade_val[$key];
			$model->save();
		}
		}
		
    }
	
	public function actionUpdate_markes()
    {
        extract($_POST);
		$subjects_id = $_POST['subject_id'];
		$mark_val = $_POST['mark_val'];
		foreach($subjects_id as $key => $subject_id){
			$getval = ManageGrade::find()->where(['exam_id'=>$exam_id])->andwhere(['class_id'=>$class_id])->andwhere(['subject_id'=>$subject_id])->andwhere(['student_id'=>$student_id])->one();
		if(!empty($getval)){
			$getval['exam_id'] = $exam_id;
			$getval['class_id'] = $class_id;
			$getval['section_id'] = $section_id;
			$getval['subject_id'] = $subject_id;
			$getval['student_id'] = $student_id;
			$getval['marks'] = $mark_val[$key];
			$getval->save(false);
		}else{
			$model = new ManageGrade();
			$model->load(Yii::$app->request->post());
			$model->exam_id = $exam_id;
			$model->class_id = $class_id;
			$model->section_id = $section_id;
			$model->subject_id = $subject_id;
			$model->student_id = $student_id;
			$model->marks = $mark_val[$key];
			$model->save();
		}
		}
		
    }

    /**
     * Creates a new ManageGrade model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new ManageGrade();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }
	
		/**
     * Creates a new ManageGrade model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionAddgrade()
    {
        $model = new ManageGrade();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('addgrade', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing ManageGrade model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing ManageGrade model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the ManageGrade model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ManageGrade the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ManageGrade::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}

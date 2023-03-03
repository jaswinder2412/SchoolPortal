<?php

namespace backend\controllers;

use Yii;
use backend\models\TeacherManageGrade;
use backend\models\TeacherManageGrade_search;
use backend\models\TeacherTestExam;
use backend\models\TeacherTestExam_search;
use backend\models\Exam;
use backend\models\ExamClass;
use backend\models\Exam_search;
use backend\models\ClassInfo;
use backend\models\AcedemicYear;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use backend\models\Section;
use backend\models\AddClass;
use backend\models\ClassSubject;
use backend\models\TeacherExamClass;
/**
 * TeacherManageGradeController implements the CRUD actions for TeacherManageGrade model.
 */
class TeacherManageGradeController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all TeacherManageGrade models.
     * @return mixed
     */
    public function actionIndex()
    {
      $searchModel = new TeacherTestExam_search();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single TeacherManageGrade model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
		
         return $this->render('view', [
            'model' => $this->findModel_second($id),
        ]);
    }
	
	public function actionExam_managing()
    {
        return $this->render('exam_managing');
    }
	
	

    /**
     * Creates a new TeacherManageGrade model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new TeacherManageGrade();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing TeacherManageGrade model.
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
     * Deletes an existing TeacherManageGrade model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }
	
	public function actionUpdate_gradess()
    {
        extract($_POST);
		$subjects_id = $_POST['subject_id'];
		$grade_val = $_POST['grade_val'];
		foreach($subjects_id as $key => $subject_id){
			$getval = TeacherManageGrade::find()->where(['exam_id'=>$exam_id])->andwhere(['class_id'=>$class_id])->andwhere(['subject_id'=>$subject_id])->andwhere(['student_id'=>$student_id])->one();
		if(!empty($getval)){
			$getval['exam_id'] = $exam_id;
			$getval['class_id'] = $class_id;
			$getval['subject_id'] = $subject_id;
			$getval['student_id'] = $student_id;
			$getval['grade'] = $grade_val[$key];
			$getval->save(false);
		}else{
			$model = new TeacherManageGrade();
			$model->load(Yii::$app->request->post());
			$model->exam_id = $exam_id;
			$model->class_id = $class_id;
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
			$getval = TeacherManageGrade::find()->where(['exam_id'=>$exam_id])->andwhere(['class_id'=>$class_id])->andwhere(['subject_id'=>$subject_id])->andwhere(['student_id'=>$student_id])->one();
		if(!empty($getval)){
			$getval['exam_id'] = $exam_id;
			$getval['class_id'] = $class_id;
			$getval['subject_id'] = $subject_id;
			$getval['student_id'] = $student_id;
			$getval['marks'] = $mark_val[$key];
			$getval->save(false);
		}else{
			$model = new TeacherManageGrade();
			$model->load(Yii::$app->request->post());
			$model->exam_id = $exam_id;
			$model->class_id = $class_id;
			$model->subject_id = $subject_id;
			$model->student_id = $student_id;
			$model->marks = $mark_val[$key];
			$model->save();
		}
		}
		
    }


    /**
     * Finds the TeacherManageGrade model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return TeacherManageGrade the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = TeacherManageGrade::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    } 
	
	protected function findModel_second($id)
    {
        if (($model = TeacherTestExam::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}

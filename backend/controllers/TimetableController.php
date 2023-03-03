<?php

namespace backend\controllers;

use Yii;
use backend\models\Timetable;
use backend\models\Timetable_search;
use backend\models\ClassInfo;
use backend\models\Section;
use backend\models\ClassSubject;
use backend\models\Subject;
use backend\models\AcedemicYear;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * TimetableController implements the CRUD actions for Timetable model.
 */
class TimetableController extends Controller
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
     * Lists all Timetable models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new Timetable_search();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Timetable model.
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
     * Creates a new Timetable model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
		extract($_POST);
		if(isset($brkpoint) && !empty($brkpoint)){
			$mybrk = $brkpoint;
		}else{
			$mybrk = 0;
		}
		if(isset($stets) && !empty($stets)){
			$lectstat = $stets;
		}else{
			$lectstat = 0;
		}
	 	$second_model = Timetable::find()->where(['day_id'=>$day_ids])->andwhere(['=','lecture_id',$lectr_ids])->andwhere(['=','teacher_id',Yii::$app->user->identity->id])->andwhere(['=','academic_year',$academic_ids]);
		$getcount = $second_model->count();
		if($getcount != 0){
		$scnd_modil = $second_model->one();
		$scnd_modil->teacher_id = $techr_ids;
		$scnd_modil->day_id = $day_ids;
		$scnd_modil->lecture_id = $lectr_ids;
		$scnd_modil->class_id = $class_ids;
		$scnd_modil->section_id = $section_ids;
		$scnd_modil->subject_id = $subject_ids;
		$scnd_modil->academic_year = $academic_ids;
		$scnd_modil->updated = time();
		$scnd_modil->lecturestatus = $lectstat;
		$scnd_modil->lunchbreak = $mybrk;
			if($scnd_modil->save(false)){
			echo "done";
			}
		} else{
			$model = new Timetable();
		$model->load(Yii::$app->request->post());
		$model->teacher_id = $techr_ids;
		$model->day_id = $day_ids;
		$model->lecture_id = $lectr_ids;
		$model->class_id = $class_ids;
		$model->section_id = $section_ids;
		$model->subject_id = $subject_ids;
		$model->academic_year = $academic_ids;
		$model->created = time();
		$model->updated = time();
		$model->lecturestatus = $lectstat;
		$model->lunchbreak = $mybrk;
		if($model->save(false)){
			echo "done";
		}
		}
         
    }

    /**
     * Updates an existing Timetable model.
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
	
	
	public function actionGetsection()
    {
        extract($_POST);
		
		echo "<option value=''>Please select</option>";
		$presnt_acadi = AcedemicYear::find()->Where(['=', 'school_id', Yii::$app->user->identity->school_id])->AndWhere(['=', 'status', 1])->one();
			$presnt_acad = $presnt_acadi['id'];
		$getingsection = ClassInfo::find()->where(['class_name'=>$class_ids])->andwhere(['=','academic_year',$presnt_acad])->groupBy(['class_section'])->all();
		
		foreach($getingsection as $sectionwise) {
			$getsections_name = Section::find()->where(['id'=>$sectionwise->class_section])->one();
			echo "<option value='".$getsections_name['id']."'>".$getsections_name['section_name']."</option>";
		}
		
    }
	
	public function actionGetsubject()
    {
        extract($_POST);
		$presnt_acadi = AcedemicYear::find()->Where(['=', 'school_id', Yii::$app->user->identity->school_id])->AndWhere(['=', 'status', 1])->one();
		$presnt_acad = $presnt_acadi['id'];
		echo "<option value=''>Please select</option>";
		$getingsubsection = ClassInfo::find()->where(['class_name'=>$class_ids])->andwhere(['class_section'=>$sectionsd])->andwhere(['=','academic_year',$presnt_acad])->one();
		$getingsecondsubsection = ClassSubject::find()->where(['class_id'=>$getingsubsection['id']])->andwhere(['=','Assigned_teacher_id',Yii::$app->user->identity->id])->all();
			foreach($getingsecondsubsection as $sectionwise) {
			$getsections_name = Subject::find()->where(['id'=>$sectionwise->subject_id])->one();
			echo "<option value='".$getsections_name['id']."'>".$getsections_name['subject_name']."</option>";
		} 
		
    }

    /**
     * Deletes an existing Timetable model.
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
     * Finds the Timetable model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Timetable the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Timetable::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}

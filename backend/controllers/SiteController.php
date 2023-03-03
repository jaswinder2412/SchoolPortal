<?php
namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use backend\models\UserCustom;
use backend\models\AcedemicYear;
/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['login', 'error','mainindex'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['logout', 'index','exam_student','test_student','uploadPhoto'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                   // 'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
			'uploadPhoto' => [
             'class' => 'budyaga\cropper\actions\UploadAction',
            'url' => '/uploads/',
            'path' => '/uploads/', 
        ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
		if(isset($_POST['newacademic']) && !empty($_POST['newacademic'])){
            $acad = $_POST['newacademic'];
			
			 }
		else{
				$presnt_acad = AcedemicYear::find()->Where(['=', 'school_id', Yii::$app->user->identity->school_id])->AndWhere(['=', 'status', 1])->one();
			 $acad = $presnt_acad['id'];
		
		}
     
	   return $this->render('index',[
			'academics_set' => $acad,
        ]);
    }

	
	
	public function actionExam_student()
    {
     if(isset($_POST['exam_id']) && !empty($_POST['exam_id'])){
            $exm_hid_id = $_POST['exam_id'];
			
			 }
		else{ 
			 $exm_hid_id = 0;
		
		}	
		
		$student_id = Yii::$app->user->identity->id;

	   return $this->renderAjax('exam_student',[
			'exmserch_id' => $exm_hid_id,
			'student' => $student_id,
        ]);
    }

	
	
	public function actionTest_student()
    {
     if(isset($_POST['test_id']) && !empty($_POST['test_id'])){
            $exm_hid_id = $_POST['test_id'];
			
			 }
		else{ 
			 $exm_hid_id = 0;
		
		}	
		
		$student_id = Yii::$app->user->identity->id;

	   return $this->renderAjax('test_student',[
			'exmserch_id' => $exm_hid_id,
			'student' => $student_id,
        ]);
    } 
	


    /**
     * Login action.
     *
     * @return string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
			$model_second = UserCustom::find()
                    ->where(['id'=> Yii::$app->user->getId()])
                    ->one();
			$model_second->last_login = time(); 	
			$model_second->save(false);
			$role = Yii::$app->user->identity->role_id;
			if($role == 0){
				return $this->redirect(['school-list/index']);
			}else{
				 return $this->goBack();
			}
           
        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }
	
	public function actionMainindex()
    {
		
		die('ss');
         /* return $this->render('login', [
                'model' => $model,
            ]); */
    }
	
	

    /**
     * Logout action.
     *
     * @return string
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }
	
	
		
	
	
}

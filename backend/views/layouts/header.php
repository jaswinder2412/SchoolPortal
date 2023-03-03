<?php
use yii\helpers\Html;
use common\models\User;
/* @var $this \yii\web\View */
/* @var $content string */

$role = Yii::$app->user->identity->role_id;
$User = new User();
$getname = $User->getUsername($role); 
$getimage = $User->getUserimage($role);
$getschool = $User->getSchoolname($role);
$getacademic = $User->getacademicyear($role);
$getschool_logd = $User->getUserschoolimage($role);
?>

<header class="main-header">

    <?= Html::a('<span class="logo-mini"></span><span class="logo-lg">' . ucfirst($getacademic) . '</span>', Yii::$app->homeUrl, ['class' => 'logo']) ?>


    <nav class="navbar navbar-static-top" role="navigation">

        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>
		<div>
		<span class="acad_head"><?php echo ucfirst($getschool); ?></span>
		</div>
        <div class="navbar-custom-menu">
		
            <ul class="nav navbar-nav">
 
                <!-- User Account: style can be found in dropdown.less -->

                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <img src="<?= Yii::getAlias('@base').'/uploads/'.$getschool_logd ?>" class="user-image" alt="User Image"/>
                        <span class="hidden-xs"><?php
						echo ucfirst($getname); ?></span>
                    </a>

                </li>

               
            </ul>
        </div>
    </nav>
</header>

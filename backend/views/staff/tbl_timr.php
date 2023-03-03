<?php

use yii\helpers\Html;
use yii\grid\GridView;
use backend\models\AnnouncementsTeacher;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\Staff_search */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'My Timetable';
$this->params['breadcrumbs'][] = $this->title;
?>
<style> .hint { display: none; }
.field:hover .hint { display: inline; }</style>
<div class="staff-index">
 <?php $announcingms = AnnouncementsTeacher::find()->where(['status'=>1])->all(); 
		foreach($announcingms as $ancmnts){
			
		$getdcas = explode(',',$ancmnts->announcements_to);	
		$user_id = Yii::$app->user->getId();
		if(in_array($user_id,$getdcas)){
			?>
		<div id="w1-warning" class="alert-warning alert fade in">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>

			<i class="icon fa fa-circle-o"></i><?php echo ucfirst($ancmnts->anouncement_title) ."."; ?>
			<br/>
			<span style="font-size : 12px;"><?php echo ucfirst($ancmnts->anouncement_description) ."."; ?></span>
		</div>
	<?php	}
		}
 ?>
		<div class="row ">
		<div class="col-xs-12 index_rowing">
          <div class="box box-primary">
           
              <table id="" class="table box-body table-bordered timetable">
                <thead>
                <tr>
                  <th valign="middle"><img style="width: 35%;" src="<?= Yii::getAlias('@base') ?>/images/timetable/6.png"> 
				  <br/><b>Days</b></th>
                  <th valign="middle"><img style="width: 25%;" src="<?= Yii::getAlias('@base') ?>/images/timetable/q5.png"> 
				  <br/>1st</th>
                  <th valign="middle">
				  <img style="width: 25%;" src="<?= Yii::getAlias('@base') ?>/images/timetable/q4.png"> 
				  <br/>2nd</th> 
				  <th valign="middle"><img style="width: 25%;" src="<?= Yii::getAlias('@base') ?>/images/timetable/q3.png"> 
				  <br/>3rd</th>
                  <th valign="middle"><img style="width: 25%;" src="<?= Yii::getAlias('@base') ?>/images/timetable/q6.png"> 
				  <br/>4th</th>
				  <th valign="middle">
				  <img style="width: 25%;" src="<?= Yii::getAlias('@base') ?>/images/timetable/q5.png"> 
				  <br/>
				  5th</th>
				  <th valign="middle"><img style="width: 30%;" src="<?= Yii::getAlias('@base') ?>/images/timetable/lunch.png"> 
				  <br/>6th</th>
				  <th valign="middle"><img style="width: 25%;" src="<?= Yii::getAlias('@base') ?>/images/timetable/q2.png"> 
				  <br/>7th</th>
				  <th valign="middle"><img style="width: 25%;" src="<?= Yii::getAlias('@base') ?>/images/timetable/q1.png"> 
				  <br/>8th</th>
				  <th valign="middle"><img style="width: 25%;" src="<?= Yii::getAlias('@base') ?>/images/timetable/q5.png"> 
				  <br/>9th</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                  <td valign="middle">
				  <img style="width: 35%;" src="<?= Yii::getAlias('@base') ?>/images/timetable/1.png"> 
				  <br/><b>
				  Monday</b></td>
                  <td class="field" valign="middle"><a href="#" data-toggle="modal" data-target="#myModal"><a href="#" data-toggle="modal" data-target="#myModal"><span class="glyphicon glyphicon-pencil hint"></span></a></a><br/> Class 5th - A <br/> English</td>
                  <td class="field" valign="middle"><a href="#" data-toggle="modal" data-target="#myModal"><span class="glyphicon glyphicon-pencil hint"></span></a><br/>Class 8th - A <br/> Science</td>
				  <td class="field" valign="middle"><a href="#" data-toggle="modal" data-target="#myModal"><span class="glyphicon glyphicon-pencil hint"></span></a><br/>Class 7th - B <br/> English</td>
                  <td class="field" valign="middle"><a href="#" data-toggle="modal" data-target="#myModal"><span class="glyphicon glyphicon-pencil hint"></span></a><br/>Class 4th - c <br/> English</td>
				  <td class="field" valign="middle"><a href="#" data-toggle="modal" data-target="#myModal"><span class="glyphicon glyphicon-pencil hint"></span></a><br/>Class 6th - D <br/> Science</td>
				  <td class="field" valign="middle">Lunch Time</td>
				  <td class="field" valign="middle"><img style="width: 25%;" src="<?= Yii::getAlias('@base') ?>/images/timetable/smile.png"> 
				  <br/><span style="color : red;">Free Lecture</span></td> 
				  <td class="field" valign="middle"><a href="#" data-toggle="modal" data-target="#myModal"><span class="glyphicon glyphicon-pencil hint"></span></a><br/>Class 8th - A <br/> Science</td> 
				  <td class="field" valign="middle"><a href="#" data-toggle="modal" data-target="#myModal"><span class="glyphicon glyphicon-pencil hint"></span></a><br/>Class 9th - A <br/> English</td>
                </tr>
               <tr>
                  <td valign="middle">
				  <img style="width: 35%;" src="<?= Yii::getAlias('@base') ?>/images/timetable/2.png"> 
				  <br/><b>
				  Tuesday</b></td>
                  <td class="field" valign="middle"><a href="#" data-toggle="modal" data-target="#myModal"><span class="glyphicon glyphicon-pencil hint"></span></a><br/>Class 5th - A <br/> English</td>
                  <td class="field" valign="middle"><a href="#" data-toggle="modal" data-target="#myModal"><span class="glyphicon glyphicon-pencil hint"></span></a><br/>Class 8th - A <br/> Science</td>
				  <td class="field" valign="middle"><a href="#" data-toggle="modal" data-target="#myModal"><span class="glyphicon glyphicon-pencil hint"></span></a><br/>Class 7th - B <br/> English</td>
                  <td class="field" valign="middle"><a href="#" data-toggle="modal" data-target="#myModal"><span class="glyphicon glyphicon-pencil hint"></span></a><br/>Class 4th - c <br/> English</td>
				  <td class="field" valign="middle"><a href="#" data-toggle="modal" data-target="#myModal"><span class="glyphicon glyphicon-pencil hint"></span></a><br/>Class 6th - D <br/> Science</td>
				  <td class="field" valign="middle">Lunch Time</td>
				  <td class="field" valign="middle"><a href="#" data-toggle="modal" data-target="#myModal"><span class="glyphicon glyphicon-pencil hint"></span></a><br/>Class 3rd - A <br/> English</td> 
				  <td class="field" valign="middle"><img style="width: 25%;" src="<?= Yii::getAlias('@base') ?>/images/timetable/smile.png"> 
				  <br/><span style="color : red;">Free Lecture</span></td> 
				  <td class="field" valign="middle"><a href="#" data-toggle="modal" data-target="#myModal"><span class="glyphicon glyphicon-pencil hint"></span></a><br/>Class 9th - A <br/> English</td>
                </tr>
               <tr>
                  <td valign="middle">
				  <img style="width: 35%;" src="<?= Yii::getAlias('@base') ?>/images/timetable/3.png"> 
				  <br/><b>
				  Wednesday</b></td>
                  <td class="field" valign="middle"><a href="#" data-toggle="modal" data-target="#myModal"><span class="glyphicon glyphicon-pencil hint"></span></a><br/>Class 5th - A <br/> English</td>
                  <td class="field" valign="middle"><a href="#" data-toggle="modal" data-target="#myModal"><span class="glyphicon glyphicon-pencil hint"></span></a><br/>Class 8th - A <br/> Science</td>
				  <td class="field" valign="middle"><a href="#" data-toggle="modal" data-target="#myModal"><span class="glyphicon glyphicon-pencil hint"></span></a><br/>Class 7th - B <br/> English</td>
                  <td class="field" valign="middle"><img style="width: 25%;" src="<?= Yii::getAlias('@base') ?>/images/timetable/smile.png"> 
				  <br/><span style="color : red;">Free Lecture</span></td>
				  <td class="field" valign="middle"><a href="#" data-toggle="modal" data-target="#myModal"><span class="glyphicon glyphicon-pencil hint"></span></a><br/>Class 6th - D <br/> Science</td>
				  <td class="field" valign="middle">Lunch Time</td>
				  <td class="field" valign="middle"><a href="#" data-toggle="modal" data-target="#myModal"><span class="glyphicon glyphicon-pencil hint"></span></a><br/>Class 3rd - A <br/> English</td> 
				  <td class="field" valign="middle"><a href="#" data-toggle="modal" data-target="#myModal"><span class="glyphicon glyphicon-pencil hint"></span></a><br/>Class 8th - A <br/> Science</td> 
				  <td class="field" valign="middle"><a href="#" data-toggle="modal" data-target="#myModal"><span class="glyphicon glyphicon-pencil hint"></span></a><br/>Class 9th - A <br/> English</td>
                </tr>
               <tr>
                  <td valign="middle">
				  <img style="width: 35%;" src="<?= Yii::getAlias('@base') ?>/images/timetable/4.png"> 
				  <br/><b>
				  Thursday</b></td>
                  <td class="field" valign="middle"><a href="#" data-toggle="modal" data-target="#myModal"><span class="glyphicon glyphicon-pencil hint"></span></a><br/>Class 5th - A <br/> English</td>
                  <td class="field" valign="middle"><a href="#" data-toggle="modal" data-target="#myModal"><span class="glyphicon glyphicon-pencil hint"></span></a><br/>Class 8th - A <br/> Science</td>
				  <td class="field" valign="middle"><a href="#" data-toggle="modal" data-target="#myModal"><span class="glyphicon glyphicon-pencil hint"></span></a><br/>Class 7th - B <br/> English</td>
                  <td class="field" valign="middle"><a href="#" data-toggle="modal" data-target="#myModal"><span class="glyphicon glyphicon-pencil hint"></span></a><br/>Class 4th - c <br/> English</td>
				  <td class="field" valign="middle"><img style="width: 25%;" src="<?= Yii::getAlias('@base') ?>/images/timetable/smile.png"> 
				  <br/><span style="color : red;">Free Lecture</span></td>
				  <td class="field" valign="middle">Lunch Time</td>
				  <td class="field" valign="middle"><a href="#" data-toggle="modal" data-target="#myModal"><span class="glyphicon glyphicon-pencil hint"></span></a><br/>Class 3rd - A <br/> English</td> 
				  <td class="field" valign="middle"><a href="#" data-toggle="modal" data-target="#myModal"><span class="glyphicon glyphicon-pencil hint"></span></a><br/>Class 8th - A <br/> Science</td> 
				  <td class="field" valign="middle"><a href="#" data-toggle="modal" data-target="#myModal"><span class="glyphicon glyphicon-pencil hint"></span></a><br/>Class 9th - A <br/> English</td>
                </tr>
               <tr>
                  <td valign="middle">
				  <img style="width: 35%;" src="<?= Yii::getAlias('@base') ?>/images/timetable/5.png"> 
				  <br/><b>
				  Friday</b></td>
                  <td class="field" valign="middle"><a href="#" data-toggle="modal" data-target="#myModal"><span class="glyphicon glyphicon-pencil hint"></span></a><br/>Class 5th - A <br/> English</td>
                  <td class="field" valign="middle"><a href="#" data-toggle="modal" data-target="#myModal"><span class="glyphicon glyphicon-pencil hint"></span></a><br/>Class 8th - A <br/> Science</td>
				  <td class="field" valign="middle"><a href="#" data-toggle="modal" data-target="#myModal"><span class="glyphicon glyphicon-pencil hint"></span></a><br/>Class 7th - B <br/> English</td>
                  <td class="field" valign="middle"><a href="#" data-toggle="modal" data-target="#myModal"><span class="glyphicon glyphicon-pencil hint"></span></a><br/>Class 4th - c <br/> English</td>
				  <td class="field" valign="middle"><a href="#" data-toggle="modal" data-target="#myModal"><span class="glyphicon glyphicon-pencil hint"></span></a><br/>Class 6th - D <br/> Science</td>
				  <td class="field" valign="middle">Lunch Time</td>
				  <td class="field" valign="middle"><a href="#" data-toggle="modal" data-target="#myModal"><span class="glyphicon glyphicon-pencil hint"></span></a><br/>Class 3rd - A <br/> English</td> 
				  <td class="field" valign="middle"><img style="width: 25%;" src="<?= Yii::getAlias('@base') ?>/images/timetable/smile.png"> 
				  <br/><span style="color : red;">Free Lecture</span></td> 
				  <td class="field" valign="middle">Class 9th - A <br/> English</td>
                </tr>
               <tr>
                  <td valign="middle">
				  <img style="width: 35%;" src="<?= Yii::getAlias('@base') ?>/images/timetable/7.png"> 
				  <br/><b>
				  Saturday</b></td>
                  <td class="field" valign="middle"><a href="#" data-toggle="modal" data-target="#myModal"><span class="glyphicon glyphicon-pencil hint"></span></a><br/>Class 5th - A <br/> English</td>
                  <td class="field" valign="middle"><a href="#" data-toggle="modal" data-target="#myModal"><span class="glyphicon glyphicon-pencil hint"></span></a><br/>Class 8th - A <br/> Science</td>
				  <td class="field" valign="middle"><a href="#" data-toggle="modal" data-target="#myModal"><span class="glyphicon glyphicon-pencil hint"></span></a><br/>Class 7th - B <br/> English</td>
                  <td class="field" valign="middle"><img style="width: 25%;" src="<?= Yii::getAlias('@base') ?>/images/timetable/smile.png"> 
				  <br/><span style="color : red;">Free Lecture</span></td>
				  <td class="field" valign="middle"><a href="#" data-toggle="modal" data-target="#myModal"><span class="glyphicon glyphicon-pencil hint"></span></a><br/>Class 6th - D <br/> Science</td>
				  <td class="field" valign="middle">Lunch Time</td>
				  <td class="field" valign="middle"><a href="#" data-toggle="modal" data-target="#myModal"><span class="glyphicon glyphicon-pencil hint"></span></a><br/>Class 3rd - A <br/> English</td> 
				  <td class="field" valign="middle"><a href="#" data-toggle="modal" data-target="#myModal"><span class="glyphicon glyphicon-pencil hint"></span></a><br/>Class 8th - A <br/> Science</td> 
				  <td class="field" valign="middle"><a href="#" data-toggle="modal" data-target="#myModal"><span class="glyphicon glyphicon-pencil hint"></span></a><br/>Class 9th - A <br/> English</td>
                </tr>
                            
                </tbody>
                
              </table>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
		
		
			  <!-- Modal -->
			  <div class="modal fade" id="myModal" role="dialog">
				<div class="modal-dialog">
				
				  <!-- Modal content-->
				  <div class="modal-content">
					<div class="modal-header">
					  <button type="button" class="close" data-dismiss="modal">&times;</button>
					  <h4 class="modal-title">Change Class</h4>
					</div>
					<div class="modal-body">
            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal">
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Change Class</label>

                  <div class="col-sm-10">
                    <input class="form-control" id="inputEmail3" placeholder="Enter Class" type="text">
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputPassword3" class="col-sm-2 control-label">Section</label>

                  <div class="col-sm-10">
                    <input class="form-control" id="inputPassword3" placeholder="Enter Section" type="text">
                  </div>
                </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <button type="submit" class="btn btn-default">Cancel</button>
                <button type="submit" class="btn btn-info pull-right">Submit</button>
              </div>
              <!-- /.box-footer -->
            </form>
					</div>
				  </div>
				   
				</div>
			  </div>
  
</div>

</div>
<?php
use common\models\User;
use backend\models\AddStudent;
 $User = new User();
				$user_idd = Yii::$app->user->getId();
				$map_data = User::find()->Where(['id'=>$user_idd])->all();
				$roli = '';
				foreach ($map_data as $mp){ 
					$roli = $mp->role_id;
					$getname = $User->getUsername($roli);
					$getimage = $User->getUserimage($roli);
					$getdesignation = $User->getDesignation($roli);
				} 
				$mycurrenclass = $User->getCurrentclass();
				
				$getstudent_ids = AddStudent::find()->where(['user_id'=>$user_idd])->one();
			?>
<aside class="main-sidebar">

    <section class="sidebar">

        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="<?= Yii::getAlias('@base').'/uploads/'.$getimage ?>" class="img-circle" alt="User Image"/>
            </div>
            <div class="pull-left info">
			
                <p><?php echo ucfirst($getname); ?></p>

                <a href="#"><i class="fa fa-circle text-success"></i> <?php echo $getdesignation;
				
				?>
				<?php if(Yii::$app->user->identity->role_id == '6'){ ?>
					 (<?php echo $mycurrenclass; ?>)
				<?php } ?>
				</a>
				
            </div>
        </div>
		
<?php if($roli == '0'){ ?>

        <?= dmstr\widgets\Menu::widget(
            [
                'options' => ['class' => 'sidebar-menu tree', 'data-widget'=> 'tree'],
                'items' => [
                   
                    ['label' => 'Schools', 'icon' => 'university', 'url' => ['#'] ,
					'items' => [
                            ['label' => 'Add School', 'icon' => 'circle-o', 'url' => ['/school-list/create'],],
                            ['label' => 'Manage Schools', 'icon' => 'circle-o', 'url' => ['/school-list/index'],],
						],
					],
                    
					['label' => 'Logout', 'icon' => 'sign-out', 'url' => ['/site/logout'] ],
				
                ],
            ]
        ) ?>

		
<?php } elseif($roli == '1') { ?>

		<?= dmstr\widgets\Menu::widget(
            [
                'options' => ['class' => 'sidebar-menu tree', 'data-widget'=> 'tree'],
                'items' => [
				
					 ['label' => 'Students', 'icon' => 'mortar-board', 'url' => ['#'] ,
					'items' => [
                            ['label' => 'Add Student', 'icon' => 'circle-o', 'url' => ['/adduser/create'],],
                            ['label' => 'Manage Students', 'icon' => 'circle-o', 'url' => ['/adduser/index'],],
						],
					],
                   
					['label' => 'Staff', 'icon' => 'users', 'url' => ['#'] ,
					'items' => [
                            ['label' => 'Add Staff', 'icon' => 'circle-o', 'url' => ['/staff/create'],],
                            ['label' => 'Manage Staff', 'icon' => 'circle-o', 'url' => ['/staff/index'],],
						],
					], 
					
					['label' => 'Manage Content', 'icon' => 'file-text', 'url' => ['#'] ,
					'items' => [
							['label' => 'Section', 'icon' => 'circle-o', 'url' => ['/section/index'],],
                            ['label' => 'Class', 'icon' => 'circle-o', 'url' => ['/add-class/index'],],
							['label' => 'Subject', 'icon' => 'circle-o', 'url' => ['/subject/index'],],
							['label' => 'Merge Class', 'icon' => 'circle-o', 'url' => ['/classinfo/index'],],
							
						],
					],
					
					['label' => 'Exams', 'icon' => 'building-o', 'url' => ['#'] ,
					'items' => [
					
                            ['label' => 'Add Exam Name', 'icon' => 'circle-o', 'url' => ['/add-exam/index'],],
                            ['label' => 'Manage Grades', 'icon' => 'circle-o', 'url' => ['/add-grades/index'],],
                            ['label' => 'Manage Exams', 'icon' => 'circle-o', 'url' => ['/final-exam/index'],],
                            /* ['label' => 'Manage Marks', 'icon' => 'circle-o', 'url' => ['/manage-grade/teacher_index'],], */
						],
					],
					
					['label' => 'Acadamic Year', 'icon' => 'calendar', 'url' => ['#'] ,
					'items' => [
                            ['label' => 'Manage Acadamic', 'icon' => 'circle-o', 'url' => ['/acedemic-year/index'],],
                            
						],
					],
					
					['label' => 'Announcements', 'icon' => 'bullhorn', 'url' => ['#'] ,
					'items' => [
                            ['label' => 'Teacher Announcements', 'icon' => 'circle-o', 'url' => ['/anouncements/index'],],
							['label' => 'Parent Announcements', 'icon' => 'circle-o', 'url' => ['/anouncements/student_index'],], 
                            
						],
					],
					['label' => 'School Profile', 'icon' => 'university', 'url' => ['/school-list/profile'] ],
				['label' => 'Logout', 'icon' => 'sign-out', 'url' => ['/site/logout'] ],
				
                ],
            ]
        ) ?>
<?php } else if($roli == '2'){ ?>
	
			<?= dmstr\widgets\Menu::widget(
            [
                'options' => ['class' => 'sidebar-menu tree', 'data-widget'=> 'tree'],
                'items' => [
				
					 ['label' => 'Students', 'icon' => 'mortar-board', 'url' => ['#'] ,
					'items' => [
                            ['label' => 'Add Student', 'icon' => 'circle-o', 'url' => ['/adduser/create'],],
                            ['label' => 'Manage Students', 'icon' => 'circle-o', 'url' => ['/adduser/index'],],
						],
					],
                   
					['label' => 'Staff', 'icon' => 'users', 'url' => ['#'] ,
					'items' => [
                            ['label' => 'Add Staff', 'icon' => 'circle-o', 'url' => ['/staff/create'],],
                            ['label' => 'Manage Staff', 'icon' => 'circle-o', 'url' => ['/staff/index'],],
						],
					], 
					
					['label' => 'Manage Content', 'icon' => 'file-text', 'url' => ['#'] ,
					'items' => [
							['label' => 'Section', 'icon' => 'circle-o', 'url' => ['/section/index'],],
                            ['label' => 'Class', 'icon' => 'circle-o', 'url' => ['/add-class/index'],],
							['label' => 'Subject', 'icon' => 'circle-o', 'url' => ['/subject/index'],],
							['label' => 'Merge Class', 'icon' => 'circle-o', 'url' => ['/classinfo/index'],],
							
						],
					],
					
					['label' => 'Exams', 'icon' => 'building-o', 'url' => ['#'] ,
					'items' => [
					
                            ['label' => 'Add Exam Name', 'icon' => 'circle-o', 'url' => ['/add-exam/index'],],
							['label' => 'Manage Grades', 'icon' => 'circle-o', 'url' => ['/add-grades/index'],],
                            ['label' => 'Manage Exams', 'icon' => 'circle-o', 'url' => ['/final-exam/index'],],
                            /* ['label' => 'Manage Marks', 'icon' => 'circle-o', 'url' => ['/manage-grade/teacher_index'],], */
						],
					],
					

					['label' => 'Announcements', 'icon' => 'bullhorn', 'url' => ['#'] ,
					'items' => [
                            ['label' => 'Teacher Announcements', 'icon' => 'circle-o', 'url' => ['/anouncements/index'],],
							['label' => 'Parent Announcements', 'icon' => 'circle-o', 'url' => ['/anouncements/student_index'],], 
                            
						],
					],
					['label' => 'My Profile', 'icon' => 'university', 'url' => ['/staff/staff_profile'] ],

				['label' => 'Logout', 'icon' => 'sign-out', 'url' => ['/site/logout'] ],
				
                ],
            ]
        ) ?>
	
	

<?php	} elseif($roli == '4') { ?>
		
		
		<?= dmstr\widgets\Menu::widget(
            [
                'options' => ['class' => 'sidebar-menu tree', 'data-widget'=> 'tree'],
                'items' => [
                   
                    ['label' => 'Students', 'icon' => 'mortar-board', 'url' => ['#'] ,
					'items' => [
                            ['label' => 'Add Student', 'icon' => 'circle-o', 'url' => ['/adduser/create'],],
                            ['label' => 'Manage Students', 'icon' => 'circle-o', 'url' => ['/adduser/index'],],
						],
					],
					
					['label' => 'Staff', 'icon' => 'users', 'url' => ['#'] ,
					'items' => [
                            ['label' => 'Add Staff', 'icon' => 'circle-o', 'url' => ['/staff/create'],],
                            ['label' => 'Manage Staff', 'icon' => 'circle-o', 'url' => ['/staff/index'],],
						],
					], 
					['label' => 'Manage Content', 'icon' => 'file-text', 'url' => ['#'] ,
					'items' => [
							['label' => 'Section', 'icon' => 'circle-o', 'url' => ['/section/index'],],
                            ['label' => 'Class', 'icon' => 'circle-o', 'url' => ['/add-class/index'],],
							['label' => 'Subject', 'icon' => 'circle-o', 'url' => ['/subject/index'],],
							['label' => 'Merge Class', 'icon' => 'circle-o', 'url' => ['/classinfo/index'],],
							
						],
					],
					
					['label' => 'Exams', 'icon' => 'building-o', 'url' => ['#'] ,
					'items' => [
					
                            ['label' => 'Add Exam Name', 'icon' => 'circle-o', 'url' => ['/add-exam/index'],],
							['label' => 'Manage Grades', 'icon' => 'circle-o', 'url' => ['/add-grades/index'],],
                            ['label' => 'Manage Exams', 'icon' => 'circle-o', 'url' => ['/final-exam/index'],],
                            /* ['label' => 'Manage Marks', 'icon' => 'circle-o', 'url' => ['/manage-grade/teacher_index'],], */
						],
					],
					
					['label' => 'Announcements', 'icon' => 'bullhorn', 'url' => ['#'] ,
					'items' => [
                            ['label' => 'Teacher Announcements', 'icon' => 'circle-o', 'url' => ['/anouncements/index'],],
							 
                            
						],
					],
					['label' => 'My Profile', 'icon' => 'university', 'url' => ['/staff/staff_profile'] ],
					['label' => 'Logout', 'icon' => 'sign-out', 'url' => ['/site/logout'] ],
				
                ],
            ]
        ) ?>
		 
<?php } elseif($roli == '3') { ?>

<?= dmstr\widgets\Menu::widget(
            [
                'options' => ['class' => 'sidebar-menu tree', 'data-widget'=> 'tree'],
                'items' => [
                   
                   ['label' => 'Staff', 'icon' => 'users', 'url' => ['#'] ,
					'items' => [
							['label' => 'Add Staff', 'icon' => 'circle-o', 'url' => ['/staff/create'],],
                            ['label' => 'Manage Staff', 'icon' => 'circle-o', 'url' => ['/staff/cordinator_staff'],],
						],
					], 
                    ['label' => 'Assign Classes', 'icon' => 'mortar-board', 'url' => ['site/index'], ],
					['label' => 'Manage Content', 'icon' => 'file-text', 'url' => ['#'] ,
					'items' => [
							['label' => 'Section', 'icon' => 'circle-o', 'url' => ['/section/index'],],
                            ['label' => 'Class', 'icon' => 'circle-o', 'url' => ['/add-class/index'],],
							['label' => 'Subject', 'icon' => 'circle-o', 'url' => ['/subject/index'],],
							['label' => 'Merge Class', 'icon' => 'circle-o', 'url' => ['/classinfo/index'],],
							
						],
					],
					['label' => 'Exams', 'icon' => 'building-o', 'url' => ['#'] ,
					'items' => [
					
                            ['label' => 'Add Exam Name', 'icon' => 'circle-o', 'url' => ['/add-exam/index'],],
							['label' => 'Manage Grades', 'icon' => 'circle-o', 'url' => ['/add-grades/index'],],
                            ['label' => 'Manage Exams', 'icon' => 'circle-o', 'url' => ['/final-exam/index'],],
                            /* ['label' => 'Manage Marks', 'icon' => 'circle-o', 'url' => ['/manage-grade/teacher_index'],], */
						],
					],
					['label' => 'Announcements', 'icon' => 'bullhorn', 'url' => ['#'] ,
					'items' => [
                            ['label' => 'Teacher Announcements', 'icon' => 'circle-o', 'url' => ['/anouncements/index'],],
							['label' => 'Parent Announcements', 'icon' => 'circle-o', 'url' => ['/anouncements/student_index'],], 
                            
						],
					],
					['label' => 'My Profile', 'icon' => 'university', 'url' => ['/staff/staff_profile'] ],
					['label' => 'Logout', 'icon' => 'sign-out', 'url' => ['/site/logout'] ],
				
                ],
            ]
        ) ?>

<?php } elseif($roli == '5') { ?>

<?= dmstr\widgets\Menu::widget(
            [
                'options' => ['class' => 'sidebar-menu tree', 'data-widget'=> 'tree'],
                'items' => [
                   
               /*     ['label' => 'Students', 'icon' => 'mortar-board', 'url' => ['#'] ,
					'items' => [
                            ['label' => 'Manage Students', 'icon' => 'circle-o', 'url' => ['/adduser/teacherindex'],],
						],
					], */
					['label' => 'Manage Class', 'icon' => 'file-text', 'url' => ['#'] ,
					'items' => [
							['label' => 'Class', 'icon' => 'circle-o', 'url' => ['/classinfo/teacherindexs'],],
							
						],
					],
					['label' => 'Teacher Timetable', 'icon' => 'calendar', 'url' => ['/staff/time_table'] ],
					
					 ['label' => 'Class Test', 'icon' => 'building-o', 'url' => ['#'] ,
					'items' => [
                            ['label' => 'Add Class Test Name', 'icon' => 'circle-o', 'url' => ['/add-test/index'],],
                            ['label' => 'Manage Class Test', 'icon' => 'circle-o', 'url' => ['/inhouse-test/index'],],
						],
					], 
					
					['label' => 'Exams', 'icon' => 'building-o', 'url' => ['#'] ,
					'items' => [
					
                            /* ['label' => 'Add Exam', 'icon' => 'circle-o', 'url' => ['/add-exam/index'],], */
                            ['label' => 'Manage Exams', 'icon' => 'circle-o', 'url' => ['/final-exam/index'],],
                            /* ['label' => 'Manage Marks', 'icon' => 'circle-o', 'url' => ['/manage-grade/teacher_index'],], */
						],
					],
					
					
					['label' => 'Announcements', 'icon' => 'bullhorn', 'url' => ['#'] ,
					'items' => [
					
					['label' => 'Parent Announcements', 'icon' => 'circle-o', 'url' => ['/anouncements/student_index'],],
                            
						],
					],
					['label' => 'Assignments', 'icon' => 'file-pdf-o', 'url' => ['#'] ,
					'items' => [
					
					['label' => 'Manage Assignments', 'icon' => 'circle-o', 'url' => ['/assignment/index'],],
                            
						],
					],
					['label' => 'My Profile', 'icon' => 'university', 'url' => ['/staff/staff_profile'] ],
					['label' => 'My Announcements', 'icon' => 'university', 'url' => ['/anouncements/index'] ],
					['label' => 'Logout', 'icon' => 'sign-out', 'url' => ['/site/logout'] ],
				
                ],
            ]
        ) ?>

<?php } elseif($roli == '6') { ?>

<?= dmstr\widgets\Menu::widget(
            [
                'options' => ['class' => 'sidebar-menu tree', 'data-widget'=> 'tree'],
                'items' => [
                   
					 
					['label' => 'Dashboard', 'icon' => 'dashboard', 'url' => ['/site/index'] ],
					
					['label' => 'Profile', 'icon' => 'user', 'url' => ['#'] ,
					'items' => [
					
					['label' => 'View Profile', 'icon' => 'circle-o', 'url' => ['/adduser/myprofile','id'=>$getstudent_ids['id']],],
                    ['label' => 'Edit Profile', 'icon' => 'circle-o', 'url' => ['/adduser/editprofile','id'=>$getstudent_ids['id']],],
                        ]],
					['label' => 'Date sheet', 'icon' => 'th', 'url' => ['/adduser/datesheet'] ],
					
					/* ['label' => 'Class Test Date sheet', 'icon' => 'th', 'url' => ['/adduser/inhouse_datesheet'] ], */
					
					['label' => 'My Announcements', 'icon' => 'bullhorn', 'url' => ['/anouncements/student_index'] ],
					['label' => 'My Assignments', 'icon' => 'th', 'url' => ['/assignment/index'] ],
					
					
					
					['label' => 'Logout', 'icon' => 'sign-out', 'url' => ['/site/logout'] ],
				
                ],
            ]
        ) ?>

<?php } ?>






    </section>

</aside>

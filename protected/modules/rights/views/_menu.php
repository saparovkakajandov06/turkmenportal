<?php
                        $action = Yii::app()->controller->action->id;
                        $this->menu=array(
                                array(
                                        'label'=>Rights::t('core', 'Assignments'),
                                        'url'=>array('assignment/view'),
                                        'htmlOptions'=>array('class'=>'item-assignments '.($action=='view' ? ' active': '')),
                                ),
                                array(
                                        'label'=>Rights::t('core', 'Permissions'),
                                        'url'=>array('authItem/permissions'),
                                        'htmlOptions'=>array('class'=>'item-permissions '.($action=='permissions' ? ' active': '')),
                                ),
                                array(
                                        'label'=>Rights::t('core', 'Roles'),
                                        'url'=>array('authItem/roles'),
                                        'htmlOptions'=>array('class'=>'item-roles '.($action=='roles' ? ' active': '')),
                                ),
                                array(
                                        'label'=>Rights::t('core', 'Tasks'),
                                        'url'=>array('authItem/tasks'),
                                        'htmlOptions'=>array('class'=>'item-tasks '.($action=='tasks' ? ' active': '')),
                                ),
                                array(
                                        'label'=>Rights::t('core', 'Operations'),
                                        'url'=>array('authItem/operations'),
                                        'htmlOptions'=>array('class'=>'item-operations '.($action=='operations' ? ' active': '')),
                                ),
                            );
                        ?>
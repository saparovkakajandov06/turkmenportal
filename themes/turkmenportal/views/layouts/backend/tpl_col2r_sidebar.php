<?php
$controller_id = Yii::app()->controller->id;
$action_id = Yii::app()->controller->action->id;
//    $module_id=Yii::app()->controller->module->id;
$module_id = '';
?>

<div class="row">
    <div class=" sidebar">
        <ul class="nav nav-list admin_sidebar" id="nav">


            <li class="has_sub"><a class="" href="#"><i
                        class="fa fa-user-md"></i><span><?php echo Yii::t('app', 'My Account'); ?></span><span
                        class="pull-right"></span></a>
                <ul>
                    <li><a <?php if ($controller_id == 'profile' && $action_id == 'profile') {
                            echo 'class="active"';
                        } ?> href="<?php echo Yii::app()->createUrl("//user/profile"); ?>"><i class="fa fa-user"></i>Profile</a>
                    </li>
                    <li><a href="<?php echo Yii::app()->createUrl("//user/logout"); ?>"><i
                                class="fa fa-power-off"></i><?php echo Yii::t('app', 'Logout') ?></a></li>
                </ul>
            </li>

            <?php
            $opened = FALSE;
            if ($controller_id == 'category' || $controller_id == 'blog' || $controller_id == 'catalog' ||
                $controller_id == 'work' || $controller_id == 'estates' || $controller_id == 'auto' || $controller_id == 'compositions' || $controller_id == 'advert'
            ) {
                $opened = true;
            }

            $access = FALSE;
            if (Yii::app()->user->checkAccess('Category.Admin') ||
                Yii::app()->user->checkAccess('Blog.Admin') ||
                Yii::app()->user->checkAccess('Catalog.Admin') ||
                Yii::app()->user->checkAccess('Compositions.Admin') ||
                Yii::app()->user->checkAccess('Work.Admin') ||
                Yii::app()->user->checkAccess('Estates.Admin') ||
                Yii::app()->user->checkAccess('Advert.Admin') ||
                Yii::app()->user->checkAccess('Auto.Admin')
            ) {
                $access = true;
            }
            ?>

            <?php if ($access == true) { ?>
                <li class="has_sub"><a class="<?php echo ($opened == true) ? "subdrop" : ""; ?>" href="#"><i
                            class="fa fa-star"></i><span><?php echo Yii::t('app', 'Frontend'); ?></span><span
                            class="pull-right"></span></a>
                    <ul style="<?php echo ($opened == true) ? "display:block" : ""; ?>">
                        <?php if (Yii::app()->user->checkAccess('Category.Admin')) { ?>
                            <li><a <?php if ($controller_id == 'category') {
                                echo 'class="active"';
                            } ?> href="<?php echo Yii::app()->createUrl("//category/admin"); ?>">Category</a>
                            </li><?php } ?>
                        <?php if (Yii::app()->user->checkAccess('Blog.Admin')) { ?>
                            <li><a <?php if ($controller_id == 'blog') {
                                echo 'class="active"';
                            } ?> href="<?php echo Yii::app()->createUrl("//blog/admin"); ?>">Blog</a></li><?php } ?>
                        <?php if (Yii::app()->user->checkAccess('Catalog.Admin')) { ?>
                            <li><a <?php if ($controller_id == 'catalog') {
                                echo 'class="active"';
                            } ?> href="<?php echo Yii::app()->createUrl("//catalog/admin"); ?>">Catalog</a>
                            </li><?php } ?>
                        <?php if (Yii::app()->user->checkAccess('Compositions.Admin')) { ?>
                            <li><a <?php if ($controller_id == 'compositions') {
                                echo 'class="active"';
                            } ?> href="<?php echo Yii::app()->createUrl("//compositions/admin"); ?>">Compositions</a>
                            </li><?php } ?>
                        <?php if (Yii::app()->user->checkAccess('Work.Admin')) { ?>
                            <li><a <?php if ($controller_id == 'work') {
                                echo 'class="active"';
                            } ?> href="<?php echo Yii::app()->createUrl("//work/admin"); ?>">Work</a></li><?php } ?>
                        <?php if (Yii::app()->user->checkAccess('Estates.Admin')) { ?>
                            <li><a <?php if ($controller_id == 'estates') {
                                echo 'class="active"';
                            } ?> href="<?php echo Yii::app()->createUrl("//estates/admin"); ?>">Estates</a>
                            </li><?php } ?>
                        <?php if (Yii::app()->user->checkAccess('Advert.Admin')) { ?>
                            <li><a <?php if ($controller_id == 'advert') {
                                echo 'class="active"';
                            } ?> href="<?php echo Yii::app()->createUrl("//advert/admin"); ?>">Baraholka</a>
                            </li><?php } ?>
                        <?php if (Yii::app()->user->checkAccess('Auto.Admin')) { ?>
                            <li><a <?php if ($controller_id == 'auto') {
                                echo 'class="active"';
                            } ?> href="<?php echo Yii::app()->createUrl("//auto/admin"); ?>">Auto</a></li><?php } ?>
                    </ul>
                </li>
            <?php } ?>


            <?php
            $opened = FALSE;
            if ($controller_id == 'contact' || $controller_id == 'comments' || $controller_id == 'polls' ||
                $controller_id == 'pollsAnswers' || $controller_id == 'information'
            ) {
                $opened = true;
            }

            $access = FALSE;
            if (Yii::app()->user->checkAccess('Contact.Admin') ||
                Yii::app()->user->checkAccess('Comments.Admin') ||
                Yii::app()->user->checkAccess('Polls.Admin') ||
                Yii::app()->user->checkAccess('PollsAnswers.Admin') ||
                Yii::app()->user->checkAccess('Information.Admin')
            ) {
                $access = true;
            }
            ?>
            <?php if ($access == true) { ?>
                <li class="has_sub"><a class="<?php echo ($opened == true) ? "subdrop" : ""; ?>" href="#"><i
                            class="fa fa-bell-o"></i><span><?php echo Yii::t('app', 'Social Forms'); ?></span><span
                            class="pull-right"></span></a>
                    <ul>
                        <?php if (Yii::app()->user->checkAccess('Contact.Admin')) { ?>
                            <li><a <?php if ($controller_id == 'contact') {
                                    echo 'class="active"';
                                } ?> href="<?php echo Yii::app()->createUrl("//contact/admin"); ?>">Contact us</a>
                            </li> <?php } ?>
                        <?php if (Yii::app()->user->checkAccess('Comments.Admin')) { ?>
                            <li><a <?php if ($controller_id == 'comments') {
                                    echo 'class="active"';
                                } ?>
                                    href="<?php echo Yii::app()->createUrl("//comments/admin"); ?>"><?php echo Yii::t('app', 'Comments') ?></a>
                            </li> <?php } ?>
                        <?php if (Yii::app()->user->checkAccess('Polls.Admin')) { ?>
                            <li><a <?php if ($controller_id == 'polls') {
                                echo 'class="active"';
                            } ?>
                                href="<?php echo Yii::app()->createUrl("//polls/admin"); ?>"><?php echo Yii::t('app', 'Polls') ?></a>
                            </li><?php } ?>
                        <?php if (Yii::app()->user->checkAccess('PollsAnswers.Admin')) { ?>
                            <li><a <?php if ($controller_id == 'pollsAnswers') {
                                echo 'class="active"';
                            } ?>
                                href="<?php echo Yii::app()->createUrl("//pollsAnswers/admin"); ?>"><?php echo Yii::t('app', 'pollsAnswers') ?></a>
                            </li><?php } ?>
                        <?php if (Yii::app()->user->checkAccess('Information.Admin')) { ?>
                            <li><a <?php if ($controller_id == 'information') {
                                echo 'class="active"';
                            } ?>
                                href="<?php echo Yii::app()->createUrl("//information/admin"); ?>"><?php echo Yii::t('app', 'information') ?></a>
                            </li><?php } ?>
                    </ul>
                </li>
            <?php } ?>



            <?php
            $access = FALSE;
            if (Yii::app()->user->checkAccess('BannerType.Admin')) {
                $access = true;
            }
            ?>
            <?php if ($access) { ?>
                <li class="has_sub"><a class="<?php echo ($controller_id == 'bannerType') ? "subdrop" : ""; ?>"
                                       href="#"><i
                            class="fa fa-bitcoin"></i><span><?php echo Yii::t('app', 'Banners'); ?></span><span
                            class="pull-right"></span></a>
                    <ul style="<?php echo ($controller_id == 'bannerType') ? "display:block" : ""; ?>">
                        <?php if (Yii::app()->user->checkAccess('BannerType.Admin')) { ?>
                            <li><a <?php if ($controller_id == 'bannerType') {
                                echo 'class="active"';
                            } ?>
                                href="<?php echo Yii::app()->createUrl("//bannerType/admin"); ?>"><?php echo Yii::t('app', 'Banners') ?></a>
                            </li><?php } ?>
                    </ul>
                </li>
            <?php } ?>


            <?php
            $opened = FALSE;
            if ($controller_id == 'regions' || $controller_id == 'autoMakes' || $controller_id == 'autoModels' || $controller_id == 'professions' ||
                $controller_id == 'language' || $controller_id == 'branches'
            ) {
                $opened = true;
            }

            $access = FALSE;
            if (Yii::app()->user->checkAccess('Regions.Admin') ||
                Yii::app()->user->checkAccess('AutoMakes.Admin') ||
                Yii::app()->user->checkAccess('AutoModels.Admin') ||
                Yii::app()->user->checkAccess('Language.Admin') ||
                Yii::app()->user->checkAccess('Professions.Admin') ||
                Yii::app()->user->checkAccess('Branches.Admin') ||
                Yii::app()->user->checkAccess('InfoCities.Admin') ||
                Yii::app()->user->checkAccess('WordList.Admin')
            ) {
                $access = true;
            }
            ?>
            <?php if ($access) { ?>
                <li class="has_sub"><a class="<?php echo ($opened == true) ? "subdrop" : ""; ?>" href="#"><i
                            class="fa fa-bars"></i><span><?php echo Yii::t('app', 'Classificators'); ?></span><span
                            class="pull-right"></span></a>
                    <ul>
                        <?php if (Yii::app()->user->checkAccess('Regions.Admin')) { ?>
                            <li><a <?php if ($controller_id == 'regions') {
                                echo 'class="active"';
                            } ?> href="<?php echo Yii::app()->createUrl("//regions/admin"); ?>">Regions</a>
                            </li><?php } ?>
                        <?php if (Yii::app()->user->checkAccess('AutoMakes.Admin')) { ?>
                            <li><a <?php if ($controller_id == 'autoMakes') {
                                echo 'class="active"';
                            } ?> href="<?php echo Yii::app()->createUrl("//autoMakes/admin"); ?>">AutoMakes</a>
                            </li><?php } ?>
                        <?php if (Yii::app()->user->checkAccess('AutoModels.Admin')) { ?>
                            <li><a <?php if ($controller_id == 'autoModels') {
                                echo 'class="active"';
                            } ?> href="<?php echo Yii::app()->createUrl("//autoModels/admin"); ?>">AutoModels</a>
                            </li><?php } ?>
                        <?php if (Yii::app()->user->checkAccess('Language.Admin')) { ?>
                            <li><a <?php if ($controller_id == 'language') {
                                echo 'class="active"';
                            } ?> href="<?php echo Yii::app()->createUrl("//language/admin"); ?>">language</a>
                            </li><?php } ?>
                        <?php if (Yii::app()->user->checkAccess('Branches.Admin')) { ?>
                            <li><a <?php if ($controller_id == 'branches') {
                                echo 'class="active"';
                            } ?> href="<?php echo Yii::app()->createUrl("//branches/admin"); ?>">Branches</a>
                            </li><?php } ?>
                        <?php if (Yii::app()->user->checkAccess('Professions.Admin')) { ?>
                            <li><a <?php if ($controller_id == 'professions') {
                                echo 'class="active"';
                            } ?> href="<?php echo Yii::app()->createUrl("//professions/admin"); ?>">Professions</a>
                            </li><?php } ?>
                        <?php if (Yii::app()->user->checkAccess('InfoCities.Admin')) { ?>
                            <li><a <?php if ($controller_id == 'infoCities') {
                                echo 'class="active"';
                            } ?> href="<?php echo Yii::app()->createUrl("//infoCities/admin"); ?>">Info Cities</a>
                            </li><?php } ?>
                        <?php if (Yii::app()->user->checkAccess('WordList.Admin')) { ?>
                            <li><a <?php if ($controller_id == 'wordList') {
                                echo 'class="active"';
                            } ?> href="<?php echo Yii::app()->createUrl("//wordList/admin"); ?>">Word Filter</a>
                            </li><?php } ?>


                    </ul>
                </li>
            <?php } ?>


            <?php
            $opened = FALSE;
            if ($module_id == 'rights' || $module_id == 'user' || $module_id == 'backup') {
                $opened = true;
            }

            $access = FALSE;
            if (Yii::app()->user->checkAccess('Admin')) {
                $access = true;
            }
            ?>
            <?php if ($access) { ?>
                <li class="has_sub"><a class="<?php echo ($opened == true) ? "subdrop" : ""; ?>" href="#"><i
                            class="fa fa-cogs"></i><span><?php echo Yii::t('app', 'Settings'); ?></span><span
                            class="pull-right"></span></a>
                    <ul>
                        <?php if (Yii::app()->user->checkAccess('Admin')) { ?>
                            <li><a <?php if ($module_id == 'rights') {
                                    echo 'class="active"';
                                } ?>
                                    href="<?php echo Yii::app()->createUrl("//rights/assignment/view"); ?>">Hukuklar</a>
                            </li> <?php } ?>
                        <?php if (Yii::app()->user->checkAccess('Admin')) { ?>
                            <li><a <?php if ($module_id == 'user' && $action_id != 'profile') {
                                echo 'class="active"';
                            } ?> href="<?php echo Yii::app()->createUrl("//user/admin/admin"); ?>">Users</a>
                            </li><?php } ?>
                        <?php if (Yii::app()->user->checkAccess('Admin')) { ?>
                            <li><a <?php if ($module_id == 'backup') {
                                echo 'class="active"';
                            } ?> href="<?php echo Yii::app()->createUrl("//backup"); ?>">Backup</a></li><?php } ?>
                    </ul>
                </li>
            <?php } ?>


        </ul>
    </div>
</div>

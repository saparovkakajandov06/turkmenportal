<?php if (isset($data) && isset($data->text) && strlen(trim($data->text)) > 0) { ?>

    <div class="comment_box ">
        <div class="row">
            <div class="col-lg-1">
                <?php
                $avatar = $data->getOwnerAvatar(50, 50, 'auto');
                if (isset($avatar) && strlen(trim($avatar)) > 1) {
                    echo CHtml::image($avatar, '', array ('class' => 'user_avatar'));
                }
                ?>
            </div>

            <div class="col-lg-11 comment_panel">
                <div class="row">

                    <div class="col-lg-12 pull-left">
                        <?php
                        if (!empty($data->create_username)) {
                            ?>
                            <div class="field username">
                                <?php
                                echo CHtml::encode($data->create_username);
                                echo '<span class="comment_date" > ( ' . Yii::app()->controller->renderDate($data->date_added) . " )</span>";
                                ?>
                            </div>
                            <?php
                        }
                        ?>
                    </div>
                </div>


                <div class="row">

                    <div class="col-lg-12">
                        <?php
                        if (!empty($data->text)) {
                            echo '<p>' . CHtml::encode($data->text) . '</p>';
                        }
                        ?>
                        <div class="comment_tools_panel">
                            <div class="like_panel action_panel">
                                <?php echo CHtml::link('<i class="fa fa-thumbs-up"></i>', Yii::app()->createUrl('//comments/like', array ('id' => $data->id)), array ('class' => 'like_button', 'data-comment_id' => $data->id)); ?>
                                <span class="like"
                                      data-qnt="<?php echo CHtml::encode($data->like_count); ?>"> <?php echo CHtml::encode($data->like_count); ?></span>
                            </div>

                            <div class="dislike_panel action_panel">
                                <?php echo CHtml::link('<i class="fa fa-thumbs-down"></i>', Yii::app()->createUrl('//comments/dislike', array ('id' => $data->id)), array ('class' => 'dislike_button', 'data-comment_id' => $data->id)); ?>
                                <span class="dislike"
                                      data-qnt="<?php echo CHtml::encode($data->dislike_count); ?>"><?php echo CHtml::encode($data->dislike_count); ?></span>
                            </div>


                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php if (Yii::app()->user->checkAccess('Comments.Create')) { ?>
            <div class="row">
                <div class="col-lg-12">
                    <div class="row comment_tools">
                        <div class="col-lg-2 pull-right">
                            <?php echo CHtml::link(Yii::t('app', '$LNG_REPLY'), Yii::app()->createUrl('//comments/create', array ('related_relation' => $data->related_relation, 'related_relation_id' => $data->related_relation_id, 'parent_id' => $data->id)), array ('class' => 'reply_button', 'data-comment_id' => $data->id)); ?>
                        </div>

                        <div class="col-lg-12" id="reply_form">
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>


    <div class="children">
        <?php echo $this->renderPartial('//comments/_replied_comments', array ('replyModels' => $data->childrens), true, false); ?>
    </div>
    <?php
} ?>
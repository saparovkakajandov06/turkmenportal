<?php
    $criteria=new CDbCriteria();
    $criteria->with=array("regions");
    $criteria->together=true;

    $criteria->addCondition('length(title_'.Yii::app()->language.') > 0 ');
    $criteria->addNotInCondition('regions.code', array('tm'));
    $criteria->scopes=array('enabled','not_photoreport','sort_newest');
    $criteria->limit=8;

    $blogModels=Blog::model()->findAll($criteria);
    foreach ($blogModels as $key=>$data) { ?>
        <div class="entry-title">
            <?php
            $title = $data->getTitle();
            echo CHtml::link(Yii::app()->controller->truncate($title, 15, 200), Yii::app()->createUrl("//blog/view", array('id' => $data->id)), array('alt' => $title, 'title' => $title,'rel' => 'bookmark'));
            ?>
        </div>
<?php }?>

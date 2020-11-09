<?php
    $this->breadcrumbs = array(
       $model->getTitle()
    );
?>
<div class=" col-md-12">
    <h1 class="blog_header"> <?php echo $model->getTitle(); ?></h1>
    
    <div class="article_text" itemprop="articleBody">
        <?php
            echo $model->getMixedDescriptionModel()->text;
        ?>
    </div>
    
    <?php
    $documents = $model->files;
    if (isset($documents) && count($documents) > 0) {
        ?>
        <table class="detail-view table table-striped table-condensed " id="related_files">
            <thead>
                <tr><td colspan="2">
                        <?php echo Yii::t('app', 'related_documents'); ?>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($documents as $docs) { ?>
                    <tr class="odd">
                        <th><?php echo CHtml::link($docs->name, $docs->getUploadedPath($docs->path), array("download" => $docs->name, "target" => "_blank")); ?> </th>
                        <td> <?php echo $this->filesize_formatted($docs->getUploadedPath($docs->path)); ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>

    <?php } ?>
    
    <?php if($model->code=="department"){ ?>

        <?php
            $this->widget('application.widgets.news.NewsListviewWidget', array(
                'count' => 8,
                'category_id' => $model->id,
                'item_class' => 'col-sm-12 col-md-12',
                'headerText' => Yii::t('app', 'Theme news'),
                'headerCssClass' => 'comments__head',
                'itemView' => '/_views/_listview',
            ));
        ?>
    <?php } ?>
</div>


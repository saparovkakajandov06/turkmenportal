<?php
/* @var $this WordFilterController */
/* @var $model WordList */

$this->breadcrumbs=array(
	'Word Filters'=>array('index'),
	'Manage',
);

$this->menu=array(
//	array('label'=>'List WordFilter', 'url'=>array('index')),
//	array('label'=>'Create WordFilter', 'url'=>array('create')),
);
?>

<div class="container">
    <div class="row">
        <form class="form-inline" action="/wordList/a/add" method="post" id="WordFilter">
            <div class="form-group">

                <div class="input-group">

                    <input type="text" class="form-control" name="WordList[word]" placeholder="Word">

                </div>
            </div>
            <button type="submit" class="btn btn-success">Add</button>
        </form>
    </div>
</div>


<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'word-filter-grid',
	'dataProvider'=>$model->search2(),
	'filter'=>$model,
	'columns'=>array(
        array(
            'header' => 'number',
            'value' => '$this->grid->dataProvider->totalItemCount- $this->grid->dataProvider->pagination->offset - $row',
            'htmlOptions' => array('style' => 'text-align:center;width:30px;')
        ),
        array(
            'name' => 'word',
            'value' => '$data->word',
//            'type' => 'raw',
            'htmlOptions' => array('style' => 'text-align:center;width:80%;')
        ),
//		'word',
//		'content',
//		'type',
		array(
			'class'=>'CButtonColumn',
            'template' => '{update}{delete}',

        ),
	),
)); ?>

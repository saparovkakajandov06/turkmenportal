<?php
    $this->renderPartial('_search_form',array(
        'model'=>$searchFormModel,
    ));
    
    $records=array_merge($blogDescriptionModel->generalSearchByLanguage()->data , $catalogDescriptionModel->generalSearchByLanguage()->data);
    
    $provAll = new CArrayDataProvider($records,
        array(
            'sort' => array( //optional and sortring
                'attributes' => array(
                    'id', 
                    'title'
                ),
            ),
            'pagination' => array('pageSize' => 2) //optional add a pagination
        )
    );
?>


<div class="horizontal_divider"></div>
<?php 
//$this->widget('zii.widgets.CListView', array(
//	'dataProvider'=>$blogDescriptionModel->generalSearchByLanguage(),
//	'itemView'=>'_search_view_blog',
//        'summaryText'=>false,
//                        'pagerCssClass'=>"pagination",
//                        'pager' => array('header' => '',
//                //                    'CSS_HIDDEN_PAGE' => 'disabled',
//                                     'maxButtonCount' => 3,
//                                     'cssFile' => false,
//                                     'htmlOptions'=>array('class'=>'pagination pull-right'),
//                                     'prevPageLabel' => '<i class="fa fa-chevron-left"></i>',
//                                     'nextPageLabel' => '<i class="fa fa-chevron-right"></i>',
//                                     'firstPageLabel' => Yii::t('app','$LNG_FIRST'),
//                                     'lastPageLabel' => Yii::t('app','$LNG_LAST'),
//                    ),
//)); 
?>




<?php 
$this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$provAll,
	'itemView'=>'_search_view_catalog',
        'summaryText'=>false,
                        'pagerCssClass'=>"pagination",
                        'pager' => array('header' => '',
                //                    'CSS_HIDDEN_PAGE' => 'disabled',
                                     'maxButtonCount' => 3,
                                     'cssFile' => false,
                                     'htmlOptions'=>array('class'=>'pagination pull-right'),
                                     'prevPageLabel' => '<i class="fa fa-chevron-left"></i>',
                                     'nextPageLabel' => '<i class="fa fa-chevron-right"></i>',
                                     'firstPageLabel' => Yii::t('app','$LNG_FIRST'),
                                     'lastPageLabel' => Yii::t('app','$LNG_LAST'),
                    ),
));
?>
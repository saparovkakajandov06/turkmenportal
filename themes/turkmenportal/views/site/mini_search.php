 <div class="col-xs-12 hidden">
    <div class="search-wrapper js-stoppropagation">
        <div class="search-wrapper-inner">
                <?php $form=$this->beginWidget('CActiveForm', array(
                    'id'=>'search-form',
                    'method'=>'get',
                    'action'=>Yii::app()->createUrl('//search/search'),
                    'enableAjaxValidation'=>false,
                    ));
                ?>
            
                
                      
    
                <?php echo CHtml::textField('query','',array("placeholder"=>"search ... ")); ?>
                <?php echo CHtml::submitButton('search'); ?>

                <?php $this->endWidget(); ?>
        </div>
    </div>
</div>


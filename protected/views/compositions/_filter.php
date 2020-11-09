<div class="row filter">
        <?php $this->widget('bootstrap.widgets.TbButton', array(
          'label'=>Yii::t('app', 'popular'),
//          'icon'=>'fa fa-times',
          'type'=>'null', // null, 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
          'size'=>'mini', // null, 'large', 'small' or 'mini'
          'url'=>Yii::app()->createUrl('//compositions/index',array('filter'=>'popular')),
          'buttonType'=>'ajaxButton',
          'ajaxOptions'=>array(
                    'success'=>'js:function(data){
                              try {
                                  var data = $.parseJSON(data);
                                  setMessage(data.status,data.message);
                                  $.fn.yiiGridView.update("harytlar-grid");
                                  $.fn.yiiGridView.update("satylan-harytlar-grid");
                               } catch (e) {
                                      var data={
                                          status:"error",
                                          message:"Yalnyshlyk boldy tazeden barlap gorun"
                                      }
                                      setMessage(data.status,data.message);
                               }
                          }'
               ),

      )); ?>
  </div>
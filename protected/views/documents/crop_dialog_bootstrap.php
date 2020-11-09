        
<?php $this->beginWidget('bootstrap.widgets.TbModal', array(
    'id'=>'crop_dialog',
    'fade'=>true,
    'options'=>array('width'=>1000),
)); ?>
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Image crop dialo</h4>
            </div>
            <div class="modal-body">
                <div class="row" style="width: 1000px">
                <?php
                    $this->renderPartial('//documents/crop', array(
                        'model' => $model)
                    );
                ?>
            </div>
            </div>
        </div>
    </div>
     
<?php $this->endWidget(); ?>
<div class="inner-panel">
       
    <div class="tab-content-focused">
        <?php
          echo $this->renderPartial('_menu_print_word',false,true);
          $this->renderPartial('_list', array(
		'dataProvider'=>$dataProvider,)); ?>
    </div>
</div>
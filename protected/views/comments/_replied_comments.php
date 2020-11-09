<?php if (isset($replyModels) && count($replyModels) > 0) { ?>
    <div class="replied_comments">
        <?php
            foreach ($replyModels as $data) {
                $this->renderPartial('//comments/_view', array('data' => $data));
            }
        ?>
    </div>
<?php } ?>
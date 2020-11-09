  <div class="files "  >
    <?php 
    if(isset($this->docs) ){ ?>
        <?php foreach ($this->docs as $document) {
            if(isset ($document['thumbnail_url'])) {?>
                <div class="form-uploader-item template-download fade count_ in" style="height: 73px;">
                    <img src="<?php echo $document['thumbnail_url']; ?>">
                    <input class="js-uploader-item-image-id" type="hidden" name="XUploadForm[images][]" value="<?php echo $document['filename']; ?>">
                    <div class="delete">
                        <input type="hidden" name="delete" value="1">
                        <button class="btn btn-delete" data-type="POST" data-url="<?php echo $document['delete_url']; ?>">
                            <i class="fa fa-times white"></i>
                        </button>
                    </div>
                </div>
           <?php }?>
        <?php } ?>
    <?php } ?>
</div>
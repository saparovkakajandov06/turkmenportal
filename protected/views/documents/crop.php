
<?php
    $filename=$model->path;

    $uploadfolder=trim(Yii::app()->params['uploadfolder'],'/');
    $imageUrl=$uploadfolder.$model->path;
    $realUrl = realpath($imageUrl);
    $imageUrl=Yii::app()->baseUrl.'/'.$uploadfolder.$model->path;

?>

<div class="col-md-9">
<h3>Asyl surat</h3>
<?php
if(Yii::app()->user->hasFlash('message'))
    echo '<div class="flash-success">'. Yii::app()->user->getFlash('message').'</div>';
?>

<p class="alt_text">
Asyl suratyň üstünden gerekli bölegini saýlap <b>"Saýlanan bölegi kes"</b> düwmesine basyň!
</p>
<?php
list($w,$h)=  getimagesize($realUrl);
if($w>700){
    $h=(int)(700/$w*$h);
    $w=700;
}
if($h>560){
    $w=(int)(560/$h*$w);
    $h=560;
}
    
?>
<label>Ratio</label>
<select id="ratio" style="margin-bottom: 25px;">
    <option value="1">Kwadrat (1)</option>
    <option value="0.886">Main cubic size (0.886)</option>
    <option value="1.33">Other cubic sizes (1.33)</option>
    <option value="1.686">Afisha Big((1.68)</option>
    <option value="1.643">Afisha Small((1.64)</option>
    <option value="0.75">0.75</option>
    <option value="0.5">0.5</option>
</select>
<br />


<img src=<?php echo $imageUrl; ?> name="<?php echo $filename;?>" id="imageId" style="width: <?php echo $w;?>px; height: <?php echo $h;?>px;">
<img src=<?php echo $imageUrl; ?> name="<?php echo $filename;?>" id="size" style="display: none;">
<br />
<form >
   
    <input type="hidden" size="4" id="cache_class" name="cache_class" value="<?php echo $model->cache_class; ?>"/>
    <input type="hidden" size="4" id="x" name="x" />
    <input type="hidden" size="4" id="y" name="y" />
    <input type="hidden" size="4" id="w" name="w" />
    <input type="hidden" size="4" id="h" name="h" />
    <input type="submit" value="Saýlanan bölegi kes" id="image_crop" class="btn btn-success"/>
    <?php 
     echo '&nbsp;';
    echo CHtml::Button(Yii::t('app', 'Cancel'), array(
                'submit' => 'javascript:history.go(-1)',
                'class'  => 'btn btn-danger'
                )
          );
    ?>
</form>
</div>

<?php
$themeUrl = Yii::app()->theme->baseUrl; 
Yii::app()->clientScript->registerScriptFile($themeUrl.'/js/jcrop/jquery.Jcrop.min.js',CClientScript::POS_END);
Yii::app()->clientScript->registerCSSFile($themeUrl.'/css/jcrop/jquery.Jcrop.css',CClientScript::POS_END);

Yii::app()->clientScript->registerScript('crop','
    var ratio=1;
    var jcrop_api=null;
    

    $(function(){
    	$("#imageId").Jcrop({
    		onChange: showPreview,
    		onSelect: showPreview,
    		aspectRatio: ratio
    	},function () {
            jcrop_api = this;
        });
    });


    $("#ratio").change(function () {
            var text = $(this).find(":selected").val();
            ratio = text;
            val = $(this).val();
            selection = "[0,0," + val + "]";
            if(jcrop_api!=undefined){
                jcrop_api.setOptions({
                    aspectRatio: ratio
                }); 
                $("#previewWrapper").css({width:val*200+"px"});
            }
      }).trigger("change");


    function showPreview(coords)
    {
    	var rx = 200 / coords.w*ratio;
    	var ry = 200 / coords.h;

        updateCoords(coords);

    	$("#preview").css({
    		width: Math.round(rx * $("#imageId").width()) + \'px\',
    		height: Math.round(ry * $("#imageId").height()) + \'px\',
    		marginLeft: \'-\' + Math.round(rx * coords.x) + \'px\',
    		marginTop: \'-\' + Math.round(ry * coords.y) + \'px\'
    	});
    }

    function updateCoords(c)
    {
            $(\'#x\').val(c.x);
            $(\'#y\').val(c.y);
            $(\'#w\').val(c.w);
            $(\'#h\').val(c.h);
    };

    $("#image_crop").live("click",function(e){
        e.preventDefault();
        var realH=$("#size").height(), h=$("#imageId").height();
        var ratio=realH/h;
        var varX=Math.ceil($("#x").val()*ratio);
        var varY=Math.ceil($("#y").val()*ratio);
        var varH=Math.ceil($("#h").val()*ratio);
        var varW=Math.ceil($("#w").val()*ratio);

        if(varX==null || varH==0){
            alert("Asyl suratdan bir bölek saýlaň!");
            return;
        }
        
        var data={
            x: varX,
            y: varY,
            w: varW,
            h: varH,
            name:$("#imageId").attr("name"),
            id: '.$model->id.',
        };

        var cache_class=$("#cache_class").val();
        if(cache_class!=undefined && cache_class.length>1){
            data["cache_class"]=cache_class;
        }

         $.ajax({
            url: "' . Yii::app()->createUrl("documents/ajaxCrop") . '",
            type: "post",
            data: data,
            success: function(data){
                console.log(data);
                javascript:history.go(-1);
               // window.location="'.Yii::app()->createUrl("//catalog/admin").'";
            }
        });
        return false;
    });
');

?>
<div class="col-md-3 last">
  <h3>Netije</h3>
  <p class="alt_text">Netijede çykýan surat</p>
  <div id="previewWrapper" style="width:200px;height:200px;overflow:hidden; margin-top: 10px; border: 1px dashed #DFDFDF">
      <img src=<?php echo $imageUrl; ?> id="preview">
  </div>
</div>

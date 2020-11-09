<a href="<?php echo Yii::app()->homeUrl; ?>">
<div class="logo"></div>
</a>

<div class="box">
<h3 class="header">Downloads</h3>
<div class="box_content">
    <ul class="downloads-list">
      <li><a href="#">Presentation</a><span class="download-type">(PDF)</span></li>
      <li><a href="#">Catalogue</a><span class="download-type">(PDF)</span></li>
      <li><a href="#">Company Map</a><span class="download-type">(JPG)</span></li>
    </ul>
</div>
</div>


<div class="img-polaroid"><img width="100%" src="<?php echo Yii::app()->theme->baseUrl;?>/img/kamaz.png"  /></div>
<p class="mini_font"> 
    <i>Watch our presentation video on 
    youtube. about how we doing this
    work till 1992.</i>
</p>


<div class="box" id="quick_form" style="margin-top: 30px;">
    <h3 class="header">Request a Callback</h3>
    <div class="box_content">
        <?php $this->renderPartial('//contact/_form2'); ?>
    </div>
</div>


<div class="box">
    <h3 class="header orange">Infirmation</h3>
    <div class="box_content">
        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the been the since </p>
    </div>
</div>
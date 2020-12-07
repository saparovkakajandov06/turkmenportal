<?php
if (isset($this->document)) {
    $posterImgPath = $this->document->resize($this->width / 1.3, $this->height / 1.3, 'crop', false, false);
    $videoPath = $this->document->getVideoUrl();
    $type = 'video/mp4';
    $videoHlsPlaylistUrl = $this->document->getVideoHlsPlaylistUrl();
    if (isset($videoHlsPlaylistUrl)) {
        $type = 'application/x-mpegURL';
    }
//    if (!isset($videoResolutions)) {
//        $videoResolutions = array('url' => $videoPath, 'height' => 'auto');
//    }
    $player_id = "my-player" . uniqid();
}

?>

<!--<video id="--><? //= $player_id ?><!--" width=600 height=300 class="video-js" controls></video>-->
<div class="wrapper">
    <div class="videocontent" style="width: 99%; margin-left: 1px; max-width:<?= $this->width ?>px">
        <video id="<?= $player_id ?>" class="video-js vjs-default-skin vjs-16-9"
               controls
               preload="auto"
               poster="<?= $posterImgPath ?>"
               width="<?= $this->width ?>" height="<?= $this->height ?>">
            <source src="<?= $videoHlsPlaylistUrl ?>" type="application/x-mpegURL">
        </video>
    </div>
</div>
<?php
Yii::app()->clientScript->registerScript($player_id, "
    var player = videojs(document.getElementById('$player_id'), {
        autoplay: false,
        controlBar: {
            'pictureInPictureToggle': false
        },
        html5: {
            hls: {
                overrideNative: true, // add this line
            }
        },
    },
    function() {
     var myPlayer = this;
     var volume = localStorage.getItem('_player_volume');
       if (volume) {
          this.volume(volume);
      }
         myPlayer.on('ended', function() {
             myPlayer.posterImage.show();
         });
     });
     
   player.hlsQualitySelector();
   player.downloadButton();
   player.ready(function() {
     this.hotkeys({
         volumeStep: 0.1,
         alwaysCaptureHotkeys: true,
         customKeys: {
             ctrldKey: {
                 key: function(event) {
                     return (event.ctrlKey && event.which === 68);
                 },
                 handler: function(player, options, event) {
                     if (options.enableMute) {
                         player.muted(!player.muted());
                     }
                 }
             }
         }
     });
 });
", CClientScript::POS_READY);
?>


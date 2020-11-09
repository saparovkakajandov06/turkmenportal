<?php
if (isset($this->document)) {
    $posterImgPath = $this->document->resize($this->width, $this->height, 'w', true, false);
    $videoPath = $this->document->getVideoUrl();
    $videoResolutions = $this->document->getVideoResolutions();

    if (!isset($videoResolutions)) {
        $videoResolutions = array('url' => $videoPath, 'height' => 'auto');
    }

    $player_id = "my-player" . uniqid();
}

?>

<video
    id="<?= $player_id ?>"
    class="video-js"
    controls
    preload="auto"
    width="<?= $this->width ?>"
    height="<?= $this->height ?>"
    poster="<?= $posterImgPath ?>"
    data-setup='{}'>

    <?php
    if (isset($videoResolutions) && is_array($videoResolutions)) {
        foreach ($videoResolutions as $resolution) { ?>
            <source src="<?= $resolution['url'] ?>" type="video/mp4" label="<?= $resolution['height'] ?>P"
                <?php if ($resolution['height'] == 360) echo 'selected="true"' ?>
            >
        <?php } ?>
    <?php } ?>

    <p class="vjs-no-js">
        To view this video please enable JavaScript, and consider upgrading to a
        web browser that
    </p>
</video>

<?php
Yii::app()->clientScript->registerScript('scripts', "
    $(document).ready(function ($) {
    var options = {
//        controlBar: {
//            children: [
//            'playToggle',
//             'volumePanel',
//             'currentTimeDisplay',
//             'timeDivider',
//             'durationDisplay',
//             'progressControl',
////             'liveDisplay',
////             'seekToLive',
//             'remainingTimeDisplay',
//             'customControlSpacer',
//             'playbackRateMenuButton',
//             'chaptersButton',
//             'descriptionsButton',
//             'subsCapsButton',
//             'audioTrackButton',
//             'qualitySelector',
//             'fullscreenToggle'                    
////              'playToggle',
////                'progressControl',
////                'volumePanel',
////                'Spacer',
////                'qualitySelector',
////                'fullscreenToggle',
//            ],
//        },
    };

    var player = videojs('$player_id', options, function onPlayerReady() {
        debugger;
        this.controlBar.addChild('QualitySelector', {tabIndex: 5});
        videojs.log('Your player is ready!');
        // In this context, `this` is the player that was created by Video.js.
        // this.play();

        // How about an event listener?
        this.on('ended', function () {
            videojs.log('Awww...over so soon?!');
        });
    });
    
//    player.controlBar.addChild('QualitySelector');
});
", CClientScript::POS_READY);

?>

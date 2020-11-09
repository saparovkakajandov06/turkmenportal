<?php

/**
 * Created by PhpStorm.
 * User: batyr
 * Date: 9/30/2019
 * Time: 10:05 PM
 */
class ConvertHlsCommand extends CConsoleCommand
{
    public function actionIndex()
    {

//        $config = [
//            'version' => 'latest',
//            'region' => 'nyc3',
//            'credentials' => [
//                'key' => 'K4RMSJ3XHGU3W6CFTEBY',
//                'secret' => 'hwMKwnDqYRivuAZpBPpKCJtgO0saAp/+I35F4oGkK48',
//            ]
//        ];
//        $bucket = 'turkmenportal';
//        $key = 'images/videouploads/export-x264.mp4';
//        $ffmpeg = Streaming\FFMpeg::create($config);
//        $video = $ffmpeg->fromS3($config, $bucket, $key);

        $ffmpeg = Streaming\FFMpeg::create();
        $rep_1 = (new \Streaming\Representation())->setKiloBitrate(200)->setResize(640, 360);
        $rep_2 = (new \Streaming\Representation())->setKiloBitrate(100)->setResize(480, 270);

//        $video = $ffmpeg->fromS3($config, $bucket, $key);
        $video = $ffmpeg->open('/home/admin/web/turkmenportal.com/public_html/images/test/input.mp4');
        $video->HLS()
            ->X264()
//            ->setTsSubDirectory('ts_files2')
            ->addRepresentation($rep_1)
            ->addRepresentation($rep_2)
            ->save('/home/admin/web/turkmenportal.com/public_html/images/test/output.m3u8');
//            ->autoGenerateRepresentations([426,240])// You can limit the numbers of representatons
//            ->save('images/test.m3u8');

        echo "geldi";
    }
}
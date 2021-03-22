<?php

class VideoConverterService
{
    public $document_id;


    public function convert($src, $output, $target_width = 640, $target_height = 480)
    {
        $original = $this->get_vid_dim($src);
        if (!empty($original['width']) && !empty($original['height']) && !is_file($output)) {
//            if ($original['width'] >= $target_witdth && $original['height'] >= $target_height) {
            if ($original['height'] >= $target_height) {
//                echo 'SIZE PASSED';
                $bash_script_command = './converter.sh \'' . $src . '\' \'' . $output . '\' ' . $target_width . ' ' . $target_height . ' ' . $this->document_id;

//                $command = '/usr/bin/ffmpeg -i ' . $src . ' -vf "scale=iw*min(' . $target_width . '/iw\,' . $target_height . '/ih):ih*min(' . $target_width . '/iw\,' . $target_height . '/ih),pad=' . $target_width . ':' . $target_height . ':(' . $target_width . '-iw)/2:(' . $target_height . '-ih)/2"';
//                $command .= ' -c:a copy ' . $output;
//
//                $syncCommand = "";
//                if (isset($this->document_id)) {
//                    $syncCommand = " && chmod 777 " . $output . " && /usr/bin/curl --user-agent cPanel-Cron https://turkmenportal.com/documents/a/syncSpace?id=" . $this->document_id . "&width=" . $target_width . "&height=" . $target_height . "&path=" . $output;
//                    $command .= $syncCommand;
//                }
//
//                $command .= ' 2>&1 > /var/log/ffmpeg.log';
                $bash_script_command .= ' 2>&1 | tee -a /var/log/ffmpeg.log 2>/dev/null >/dev/null &';
//                echo "</br>COMMAND: </br>";
//                echo $bash_script_command;

                $old_path = getcwd();
                chdir('/opt/tpvideoconverter/bin');
                $output = shell_exec($bash_script_command);
                chdir($old_path);
//                echo "<pre>";
//                print_r($output);
//                echo "</pre>";

//                $str = shell_exec($bash_script_command);
//                exec($bash_script_command);

//            $target = $this->get_dimensions($original['width'], $original['height'], $target_witdth, $target_height, $force_aspect);
//            $command = '/usr/bin/ffmpeg -i ' . $src . ' -ab 96k -b 700k -ar 44100 -s ' . $target['width'] . 'x' . $target['height'];
//            $command .= (!empty($target['padtop']) ? ' -padtop ' . $target['padtop'] : '');
//            $command .= (!empty($target['padbottom']) ? ' -padbottom ' . $target['padbottom'] : '');
//            $command .= (!empty($target['padleft']) ? ' -padleft ' . $target['padleft'] : '');
//            $command .= (!empty($target['padright']) ? ' -padright ' . $target['padright'] : '');
//            $command .= ' -acodec mp3 ' . $output . ' 2>&1';
//            $command .= ' -c:a copy ' . $output . ' 2>&1';
//            echo "COMMAND: </br>";
//            echo $command;
//            exit(1);
//            exec($command, $output, $status);
//            if ($status == 0) {
//                // Success
//                echo 'Woohoo!';
//            } else {
//                // Error.  $output has the details
//                echo '<pre>', join('\n', $output), '</pre>';
//            }
            } else {
                Yii::log('orignial sizes are smaller than targets', CLogger::LEVEL_WARNING);
            }
        } else {
            Yii::log('video convert target file already exists', CLogger::LEVEL_INFO);
        }
    }


    public function convertHLS($src, $targetfolder)
    {
        $playlist_path = trim($targetfolder, '/') . '/playlist.m3u8';
        if (is_file($src) && !is_file($targetfolder) && !file_exists($playlist_path)) {
            $hls_bash_script_command = '/opt/tpvideoconverter/bin/create-vod-hls.sh \'' . $src . '\' \'' . $targetfolder . '\' ' . $this->document_id;
            $hls_bash_script_command .= ' 2>&1 | tee -a /var/log/ffmpeg.log 2>/dev/null >/dev/null &';
//            $hls_bash_script_command .= ' </dev/null >/dev/null 2>/var/log/ffmpeg.log &';
            $old_path = getcwd();
//            echo "<pre>";
//            print_r($hls_bash_script_command);
//            echo "</pre>";
//            exit(1);

//            chdir('/opt/tpvideoconverter/bin');
            $targetfolder = shell_exec($hls_bash_script_command);
//            chdir($old_path);
        } else {
            Yii::log('video convert target file already exists', CLogger::LEVEL_INFO);
        }
    }


    public function triggerConvertHLS($full_path, $full_url, $targetfolder)
    {
        $playlist_path = trim($targetfolder, '/') . '/playlist.m3u8';
        if (is_file($full_path) && !is_file($targetfolder) && !file_exists($playlist_path)) {

            $json_array = array(
                'download_src' => $full_url,
                'targetfolder' => $targetfolder,
                'document_id' => $this->document_id
            );

//            echo "<pre>";
//            print_r($json_array);
//            echo "</pre>";

            $curl = curl_init();
            curl_setopt_array($curl, array(
//                CURLOPT_URL => "https://nesipetsin.info/payment/backend/api/video/convert",
                CURLOPT_URL => "http://mygreenway.website/backend/tk/convertor/convertor",
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 3,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "POST",
                CURLOPT_POSTFIELDS => json_encode($json_array, true),
                CURLOPT_HTTPHEADER => array(
                    "Content-Type: application/json"
                ),
            ));

            $response = curl_exec($curl);
            curl_close($curl);
//            echo "<pre>";
//            print_r($response);
//            echo "</pre>";
//            exit(1);
//            echo $response;
        } else {
            Yii::log('video convert target file already exists', CLogger::LEVEL_INFO);
        }
    }


    public function get_vid_dim($file)
    {
        $dimensions = array();
        $output = shell_exec('ffprobe -v quiet -print_format json -show_entries stream=width,height ' . escapeshellarg($file));
        $output = json_decode($output, true);

        if (!empty($output['streams'][0]['width']) && !empty($output['streams'][0]['height'])) {
            $dimensions['width'] = $output['streams'][0]['width'];
            $dimensions['height'] = $output['streams'][0]['height'];
        }
        return $dimensions;
    }

//    public function get_dimensions($original_width, $original_height, $target_width, $target_height, $force_aspect = true) {
//        // Array to be returned by this function
//        $target = array ();
//        // Target aspect ratio (width / height)
//        $aspect = $target_width / $target_height;
//        // Target reciprocal aspect ratio (height / width)
//        $raspect = $target_height / $target_width;
//
//        if ($original_width / $original_height !== $aspect) {
//            // Aspect ratio is different
//            if ($original_width / $original_height > $aspect) {
//                // Width is the greater of the two dimensions relative to the target dimensions
//                if ($original_width < $target_width) {
//                    // Original video is smaller.  Scale down dimensions for conversion
//                    $target_width = $original_width;
//                    $target_height = round($raspect * $target_width);
//                }
//                // Calculate height from width
//                $original_height = round($original_height / $original_width * $target_width);
//                $original_width = $target_width;
//                if ($force_aspect) {
//                    // Pad top and bottom
//                    $dif = round(($target_height - $original_height) / 2);
//                    $target['padtop'] = $dif;
//                    $target['padbottom'] = $dif;
//                }
//            } else {
//                // Height is the greater of the two dimensions relative to the target dimensions
//                if ($original_height < $target_height) {
//                    // Original video is smaller.  Scale down dimensions for conversion
//                    $target_height = $original_height;
//                    $target_width = round($aspect * $target_height);
//                }
//                //Calculate width from height
//                $original_width = round($original_width / $original_height * $target_height);
//                $original_height = $target_height;
//                if ($force_aspect) {
//                    // Pad left and right
//                    $dif = round(($target_width - $original_width) / 2);
//                    $target['padleft'] = $dif;
//                    $target['padright'] = $dif;
//                }
//            }
//        } else {
//            // The aspect ratio is the same
//            if ($original_width !== $target_width) {
//                if ($original_width < $target_width) {
//                    // The original video is smaller.  Use its resolution for conversion
//                    $target_width = $original_width;
//                    $target_height = $original_height;
//                } else {
//                    // The original video is larger,  Use the target dimensions for conversion
//                    $original_width = $target_width;
//                    $original_height = $target_height;
//                }
//            }
//        }
//        if ($force_aspect) {
//            // Use the target_ vars because they contain dimensions relative to the target aspect ratio
//            $target['width'] = $target_width;
//            $target['height'] = $target_height;
//        } else {
//            // Use the original_ vars because they contain dimensions relative to the original's aspect ratio
//            $target['width'] = $original_width;
//            $target['height'] = $original_height;
//        }
//        return $target;
//    }

}
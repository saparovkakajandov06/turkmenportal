<?php

/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class Controller extends RController
{


    /**
     * @var string the default layout for the controller view. Defaults to '//layouts/column1',
     * meaning using a single column layout. See 'protected/views/layouts/column1.php'.
     */
    public $layout = '//layouts/main';
    /**
     * @var array context menu items. This property will be assigned to {@link CMenu::items}.
     */

    /**
     * @var array the breadcrumbs of the current page. The value of this property will
     * be assigned to {@link CBreadcrumbs::links}. Please refer to {@link CBreadcrumbs::links}
     * for more details on how to specify this property.
     */
    public $breadcrumbs = array();
    public $maxButtonCount = 5;
    public $subCategoryModel = null;
    public $form_name = '';
    public $mobileBaner_listview_index = 3;
    public $adsense_listview_index = 4;
    public $adsense_listview_index2 = 15;
    public $enable_mobile_banner_vtop1 = false;
    public $enable_mobile_banner_vtop2 = false;
    public $categoryUrl = '';

    public $calendar_url = 'blog/calendar';

    public $lenta_news = true;
    public $department = true;
    public $press = true;


    public function init()
    {
        $this->mobileBaner_listview_index = rand(2, 5);
        $this->adsense_listview_index = rand(3, 5);
        $this->adsense_listview_index2 = rand(16, 20);
        if (isset($_SERVER['HTTP_X_REQUESTED_WITH'])) {
//                 Yii::app()->clientScript->scriptMap['jquery-ui-timepicker-addon.js'] = false;
//                 Yii::app()->clientScript->scriptMap['jquery.yiigridview.js'] = false;
//                 Yii::app()->clientScript->scriptMap['jquery-ui.min.js'] = false;
//                 Yii::app()->clientScript->scriptMap['jquery-ui-i18n.min.js'] = false;
            Yii::app()->clientScript->scriptMap['jquery.yiiactiveform.js'] = false;
//                 Yii::app()->clientScript->scriptMap['jquery.autocomplete.js'] = false;
            Yii::app()->clientScript->scriptMap['jquery.ba-bbq.js'] = false;
//                 Yii::app()->clientScript->scriptMap['ba-bbq.js'] = false;
//                 Yii::app()->clientScript->scriptMap['jquery.fileupload-fp.js'] = false;
//                 Yii::app()->clientScript->scriptMap['jquery.fileupload-ip.js'] = false;
//                 Yii::app()->clientScript->scriptMap['jquery.fileupload-ui.js'] = false;
//                 Yii::app()->clientScript->scriptMap['jquery.fileupload.js'] = false;
//                 Yii::app()->clientScript->scriptMap['jquery.iframe-transport.js'] = false;
//                 Yii::app()->clientScript->scriptMap['load-image.min.js'] = false;
//                 Yii::app()->clientScript->scriptMap['spinner.js'] = false;
        }

        error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);
        date_default_timezone_set('Asia/Ashgabat');
        ini_set("sendmail_form", "no-reply@turkmenportal.com");
//            if(isset(Yii::app()->session['lang']))
//                Yii::app()->setLanguage(Yii::app()->session['lang']);
//                Yii::app()->setLanguage('tm');


        $_SESSION['KCFINDER']['disabled'] = false; // enables the file browser in the admin
        $_SESSION['KCFINDER']['uploadURL'] = Yii::app()->baseUrl . "/images/uploads/"; // URL for the uploads folder
        $_SESSION['KCFINDER']['uploadDir'] = Yii::app()->basePath . "/../images/uploads/"; // path to the uploads
//            $this->meta_description=Yii::t('app', 'site_name');
        parent::init();
    }


    public function beforeAction($action)
    {
//            if(Yii::app()->request->isAjaxRequest)
//            if(isset($_SERVER['HTTP_X_REQUESTED_WITH']))
//                $this->layout = 'main_ajax';

//        if(defined('YII_DEBUG') && YII_DEBUG){
//            Yii::app()->assetManager->forceCopy = true;
//        }

        return parent::beforeAction($action);
    }


    public function limit_words($string, $word_limit)
    {
        $words = explode(" ", $string);
        return implode(" ", array_splice($words, 0, $word_limit));
    }


    public function truncate($input, $maxWords, $maxChars)
    {
//            $words = preg_split('/\s+/', $input);
        $words = explode(' ', $input);
        $words = array_slice($words, 0, $maxWords);
        $words = array_reverse($words);

        $chars = 0;
        $truncated = array();

        while (count($words) > 0) {
            $fragment = trim(array_pop($words));
            $chars += strlen($fragment);

            if ($chars > $maxChars) break;

            $truncated[] = $fragment;
        }

        $result = implode($truncated, ' ');

        return $result . ($input == $result ? '' : '...');
//            return $input;
    }


    public static function getFragment($text, $word)
    {
        if ($word) {
            $pos = max(mb_stripos($text, $word, null, 'UTF-8') - 100, 0);
            $fragment = mb_substr($text, $pos, 200, 'UTF-8');
            $highlighted = str_ireplace($word, '<mark>' . $word . '</mark>', $fragment);
        } else {
            $highlighted = mb_substr($text, 0, 200, 'UTF-8');
        }
        return $highlighted . (strlen($text) == strlen($highlighted) ? '' : '...');
    }


    public function dynamicUsername()
    {
        return $this->renderPartial('//site/_user_login_page', null, true);
    }


    public function formatValidationMessage($json_msg)
    {
        $error_msg_text = "";
        $error_messages = json_decode($json_msg);
        foreach ($error_messages as $key => $value) {
            if (is_array($value))
                $text = implode("</br>", $value);
            else
                $text = $value;
            $text = "* " . $text . "</br>";
            $error_msg_text .= $text;
        }

        return $error_msg_text;
    }

    function filesize_formatted($path)
    {
        if (is_file($path)) {
            $size = filesize($path);
            $units = array('B', 'KB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB');
            $power = $size > 0 ? floor(log($size, 1024)) : 0;
            return number_format($size / pow(1024, $power), 2, '.', ',') . ' ' . $units[$power];
        }
    }

    function price_to_dollar($price)
    {
        $price = preg_replace("/[^0-9]/", "", $price);
        if (!isset($price) || strlen(trim($price)) == 0)
            $price = 0;
        $price = "$" . $price;
        return $price;
    }


    public function setMetaFromCategory($modelCategory = null)
    {
        if (isset($modelCategory)) {
            $modelParentCategory = $modelCategory->parent;

            //meta keywords
            $this->meta_keyword = $modelCategory->{"meta_keyword_" . Yii::app()->language};
            $this->meta_keyword = $this->meta_keyword . ',' . $modelCategory->getFullTitle(false, ',');
            $this->meta_keyword = trim($this->meta_keyword, ',');


            $this->meta_description = $modelCategory->{"meta_description_" . Yii::app()->language};


            $description = $modelCategory->getDescription();
            if (isset($description) && strlen(trim($description)) > 0)
                $this->pageTitle = $description;
            else
                $this->pageTitle = $modelCategory->name;


            if (isset($modelParentCategory)) {
                $description = $modelParentCategory->getDescription();
                if (isset($description) && strlen(trim($description)) > 0 && strlen(trim($this->pageTitle . $description)) < 65)
                    $this->pageTitle .= ' | ' . $description;
                else
                    $this->pageTitle .= ' | ' . $modelParentCategory->name;
            }

            $this->pageTitle = $this->pageTitle . ' | ' . Yii::app()->params['title'];

            $this->pageTitle .= PageHelper::pageString('page');
            if (strlen($this->meta_description) > 5)
                $this->meta_description .= PageHelper::pageString('page');
        }
    }


    public function getRealIp()
    {
        if (!empty($_SERVER['HTTP_CLIENT_IP']))   //check ip from share internet
        {
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))   //to check ip is pass from proxy
        {
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else {
            $ip = $_SERVER['REMOTE_ADDR'];
        }
//            $ip=Yii::app()->request->getUserHostAddress();
        return $ip;
    }


    public function dateToW3C($date)
    {
        if (is_int($date))
            return date(DATE_W3C, $date);
        else
            return date(DATE_W3C, strtotime($date));
    }


    public function renderDate($mydate)
    {
        $mydate = new DateTime($mydate);
        $mydate->setTimezone(new DateTimeZone("Asia/Ashgabat"));
        $day_name = $mydate->format("d/m/Y");
        $time = $mydate->format("H:i");
        $mydate_ts = $mydate->getTimestamp();


        if ($mydate_ts >= strtotime('today'))
            $day_name = Yii::t('app', 'today') . ' ' . $time;
        else if ($mydate_ts >= strtotime('yesterday'))
            $day_name = Yii::t('app', 'yesterday') . ' ' . $time;

        return $day_name;
    }


    public function renderDateTime($date, $raw = false)
    {
        $time_str = '';
        $date_str = '';
        if (is_int($date)) {
            $time_str = date('H:i', $date);
            $date_str = date('d.m.Y', $date);
        } else {
            $time_str = date('H:i', strtotime($date));
            $date_str = date('d.m.Y', strtotime($date));
        }
        if ($raw) {
            return $time_str . ' ' . $date_str;
        } else
            return '<span class="article_header_time">' . $time_str . '</span>' . $date_str;
    }


    public function renderDateToWord($date, $year = true)
    {
        $date_str = '';
        $months = array(
            "en" => array("", 'January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'),
            "tm" => array("", 'Ýanwar', 'Fewral', 'Mart', 'Aprel', 'Maý', 'Iýun', 'Iýul', 'Awgust', 'Sentýabr', 'Oktýabr', 'Noýabr', 'Dekabr'),
            "ru" => array("", 'Январь', 'Февраль', 'Март', 'Апрель', 'Май', 'Июнь', 'Июль', 'Август', 'Сентябрь', 'Октябрь', 'Ноябрь', 'Декабрь'),
        );

        if (!is_int($date)) {
            $date = strtotime($date);
        }
        $str = date('d', $date) . " " . $months[Yii::app()->language][ltrim(date('m', $date), "0")];
//            echo $months[Yii::app()->language][date ('m',$date)];
        if ($year)
            $str = $str . " " . date('Y', $date);


        return $str;
    }


    public function isMobile()
    {
        if (!Yii::app()->mobileDetect->isMobile() && !Yii::app()->mobileDetect->isTablet() && !Yii::app()->mobileDetect->isIphone())
            return false;
        else
            return true;
    }


    public function sendEmail($to, $subject, $message)
    {
        $mail = new YiiMailer();
        $mail->clearLayout();//if layout is already set in config
//            $mail->setFrom('from@example.com', 'John Doe');
        $mail->setFrom(Yii::app()->params['adminEmail'], 'Turkmenportal.com');
        $mail->setTo($to);
        $mail->setSubject($subject);
        $mail->setBody($message);
        return $mail->send();
    }


    public function sendTemplateEmail($email, $subject, $template = '', $data = array(), $attachemnts = array())
    {
        if (!isset($template) || count($data) == 0) {
            return;
        }

        $mail = new YiiMailer();
        $mail->setView($template);
        $mail->setData($data);
        $mail->setFrom(Yii::app()->params['adminEmail'], 'Turkmenportal.com');
        $mail->setTo($email);
        $mail->setSubject($subject);
        $mail->setReplyTo(Yii::app()->params['adminEmail']);

        if (isset($attachemnts) && count($attachemnts) > 0) {
            $mail->setAttachment($attachemnts);
        }

        return $mail->send();
    }


    protected function sendAlertEmail($model, $view, $destination = "", $emails = 'adminAlertEmail')
    {
        $documents = $model->documents;
        $attachments = array();
        foreach ($documents as $doc) {
            $path = $doc->getRealPath();
            if (isset($path))
                $attachments[$path] = $doc->name;
        }

        $to = Yii::app()->params[$emails];
        if (strlen($destination) == 0) {
            $destination = Yii::t('app', 'item_add_form');
        }
        $subject = Yii::app()->controller->truncate($model->getTitle(), 10, 50) . ' (' . $destination . ')';
        return Yii::app()->controller->sendTemplateEmail($to, $subject, $view, array('model' => $model), $attachments);
    }



    public function getCurl($url)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_URL, $url);
        $result = curl_exec($ch);
        curl_close($ch);
        return $result;
    }


    function download_image($image_url, $image_file)
    {
        $fp = fopen($image_file, 'w+');              // open file handle

        $ch = curl_init($image_url);
        // curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // enable if you want
        curl_setopt($ch, CURLOPT_FILE, $fp);          // output to file
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_TIMEOUT, 1000);      // some large value to allow curl to run for a long time
        curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0');
        // curl_setopt($ch, CURLOPT_VERBOSE, true);   // Enable this line to see debug prints
        curl_exec($ch);

        curl_close($ch);                              // closing curl handle
        fclose($fp);                                  // closing file handle
    }


    public function downloadImage($url, $filename)
    {
        if (file_exists($filename)) {
            @unlink($filename);
        }
        $fp = fopen($filename, 'w');
        if ($fp) {
            $ch = curl_init($url);
            curl_setopt($ch, CURLOPT_HEADER, 0);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
            curl_setopt($ch, CURLOPT_MAXREDIRS, 10);
            curl_setopt($ch, CURLOPT_BINARYTRANSFER, 1);
            $result = parse_url($url);
            curl_setopt($ch, CURLOPT_REFERER, $result['scheme'] . '://' . $result['host']);
            curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:45.0) Gecko/20100101 Firefox/45.0');
            $raw = curl_exec($ch);
            curl_close($ch);
            if ($raw) {
                fwrite($fp, $raw);
//                    echo "TYPE: ".mime_content_type($filename);
            }
            fclose($fp);
            if (!$raw) {
                @unlink($filename);
                return false;
            }
            return true;
        }
        return false;
    }


    function validateDateTime($dateStr, $format)
    {
        date_default_timezone_set('UTC');
        $date = DateTime::createFromFormat($format, $dateStr);
        return $date && ($date->format($format) === $dateStr);
    }


    function removePtagsOutImg($fullText)
    {
        preg_match_all('/<p[^>]*><img[^>]*><\/p>/',$fullText, $matches);

        $matches= $matches[0];
        $pattern = '/<p[^>]*><img[^>]*><\/p>/';
        foreach ($matches as $match){
            preg_match_all('/<img[^>]*>/',$match,$items[]);
        }

        foreach ($items as $item){
            $images[] = $item[0][0];
        }
        if (isset($images)){
            foreach ($images as $image){
                $fullText = preg_replace($pattern, $image, $fullText, 1);
            }
        }
        return $fullText;
    }

    function  categoryLink($code)
    {
        $sub_categories = array ();
        $categoryModel = null;

        $criteria = new CDbCriteria();
        $criteria->compare('t.code', $code, false);

        $criteria->scopes = array ('enabled', 'sort_by_sort_order');
        $categoryModels = Category::model()->cache(Yii::app()->params['cache_duration'], new CTagCacheDependency('Category'))->sort_by_sort_order()->findAll($criteria);

        foreach ($categoryModels as $cat) {
            if ($cat->parent_id == null && $cat->status == 1)
                $categoryModel = $cat;
            else if ($cat->status == 1) {
                $sub_categories[] = $cat;
            }
        }

        if (isset ($categoryModel)) {
            return $categoryModel;
        }
    }

    function isIosDevice(){
        $userAgent = strtolower($_SERVER['HTTP_USER_AGENT']);
        $iosDevice = array('iphone', 'ipod', 'ipad');
        $isIos = false;

        foreach ($iosDevice as $val) {
            if(stripos($userAgent, $val) !== false){
                $isIos = true;
                break;
            }
        }

        return $isIos;
    }

    public function renderDateWeekDay($date, $weekday = 'N')
    {
        $weeks = array(
            "tm" => array("", 'Duşenbe', 'Sişenbe', 'Çarşenbe', 'Perşenbe', 'Anna', 'Şenbe', 'Ýekşenbe'),
            "ru" => array("", "Понедельник", "Вторник", "Среда", "Четверг", "Пятница", "Суббота", "Воскресенье"),
            "en" => array("", 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'),
        );

        if (!is_int($date)) {
            $date = strtotime($date);
        }

        $str = "";
        if (isset($weekday))
            $str = $str . " " . $weeks[Yii::app()->language][ltrim(date($weekday, $date), "0")];

        return $str;
    }

    public function renderDateWeekDay3l($date, $weekday = 'N')
    {
        $weeks = array(
            "tm" => array("", 'Dş', 'Sş', 'Çş', 'Pş', 'An', 'Şn', 'Ýş'),
            "ru" => array("", "Пн", "Вт", "Ср", "Чт", "Пт", "Сб", "Вс"),
            "en" => array("", 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'),
        );

        if (!is_int($date)) {
            $date = strtotime($date);
        }

        $str = "";
        if (isset($weekday))
            $str = $str . " " . $weeks[Yii::app()->language][ltrim(date($weekday, $date), "0")];

        return $str;
    }

}
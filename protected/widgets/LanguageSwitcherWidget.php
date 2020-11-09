<?php

class LanguageSwitcherWidget extends CWidget
{
    public function run()
    {
        $currentUrl = ltrim(Yii::app()->request->url, '/');
        $index = DMultilangHelper::_getLangIndex();
        $translated = Yii::app()->controller->translated;

        $links = array();
        foreach (DMultilangHelper::suffixList() as $suffix => $name) {

//            $url = '/' . ($suffix ? trim($suffix, '_') . '/' : '') . $currentUrl;
            $domains = explode('/', ltrim($currentUrl, '/'));
            $lang = ($suffix ? trim($suffix, '_') : '');
            if (isset($lang) && strlen(trim($lang)) > 0)
                array_splice($domains, $index, 0, $lang);
            $url = '/' . implode('/', $domains);

            if (strlen(trim($suffix, "_")) == 0)
                $suffix = Yii::app()->params['defaultLanguage'];

            $image_path = Yii::app()->theme->baseUrl . "/img/icons/flag/" . trim($suffix, '_') . ".png";
            $image = CHtml::image($image_path, $name);

            if (is_array($translated) && isset($translated[trim($suffix, '_')]) && $translated[trim($suffix, '_')] == false) {
                $links[] = $image;
                continue;
            }
            $links[] = CHtml::link($image, $url);
        }

        echo CHtml::tag('span', array('class' => 'language'), implode("\n", $links));
    }
}

?>
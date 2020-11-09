<?php

/**
 * Виджет YaShare (для Yii 1.x)
 * Используя api Яндекса, отрисовывает кнопки для публикации в соцсети
 * Документация: https://tech.yandex.ru/share/doc/dg/add-docpage/
 *
 * @author     LIAL <dev@instup.com>
 * @link       http://github.com/lial/yii-yashare
 * @version    0.1
 */
class YaShare extends CWidget
{
    //Язык блока. Локализуются подписи кнопок соцсетей и кнопка Скопировать ссылку.
    public $lang;
    //Ограничение на количество отображаемых иконок
    public $iconLimit;
    //Размер кнопок соцсетей (medium|small)
    public $iconSize;
    //Список идентификаторов социальных сетей, отображаемых в блоке
    public $services;
    //Текст-заголовок для кнопок
    public $title = '';
    //Отображать ссылки в виде текста
    public $asText = false;
    //Отображать кнопку Скопировать ссылку (first|last|hidden)
    public $showCopyLink = 'last';

    //Список доступных языков
    private $_acceptedLang = array('ru', 'az', 'be', 'en', 'hy', 'ka', 'kk', 'ro', 'tr', 'tt', 'uk');
    //Список доступных соцсетей
    private $_acceptedServices = array(
        'blogger',
        'delicious',
        'digg',
        'evernote',
        'facebook',
        'gplus',
        'linkedin',
        'lj',
        'moimir',
        'odnoklassniki',
        'pocket',
        'qzone',
        'renren',
        'sinaWeibo',
        'surfingburd',
        'tencentWeibo',
        'tumblr',
        'twitter',
        'viber',
        'vkontakte',
        'whatsapp'
    );

    public function init() {
        $this->iconLimit = (isset($this->iconLimit) && is_numeric($this->iconLimit)) ? $this->iconLimit : false;
        $this->iconSize = (isset($this->iconSize) && $this->iconSize == 'small') ? 's' : 'm';

        $this->lang = Yii::app()->language;
        if (!$this->lang || !in_array($this->lang, $this->_acceptedLang)) {
            $this->lang = 'en';
        }

        if (!$this->services || $this->services === 'all' || !is_string($this->services)) {
            $this->services = $this->_acceptedServices;
        } else {
            $services = array();
            $this->services = explode(',', $this->services);

            foreach ($this->services as $service)
                if (in_array($service, $this->_acceptedServices)) array_push($services, $service);

            $this->services = implode(',', $services);
        }
    }

    public function run() {
        $this->renderHtml();
    }

    public function renderHtml() {
        Yii::app()->getClientScript()->registerScriptFile('https://yastatic.net/share2/share.js', CClientScript::POS_END);
        $yashare = '<div class="ya-share2" data-lang="'.$this->lang.'" data-size="'.$this->iconSize.'" data-services="'.$this->services.'"'.
            ($this->iconLimit ? ' data-limit="'.$this->iconLimit.'"' : '').
            ($this->asText ? ' data-bare' : '').
            ($this->showCopyLink ? ' data-copy="'.$this->showCopyLink.'"' : '').'></div>';

        if ($this->title) $yashare = '<div class="yashare"><span>'.$this->title.'</span>'.$yashare.'</div>';
        echo $yashare;
    }
}

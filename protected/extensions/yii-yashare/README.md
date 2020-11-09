# Виджет YaShare для Yii 1.x
Виджет шаринга в социальные сети (Блок Поделиться от Яндекса)

## Подключение
Скопируйте файл YaShare.php в нужную вам директорию. Например это protected/extensions, тогда подключение будет выглядеть так:

```
$this->widget('application.extensions.YaShare', array(
  'services' => 'vkontakte,twitter,facebook,gplus,odnoklassniki,moimir',
  'iconLimit' => 3,
  'title' => 'Поделиться в социальной сети:',
));
```

## Параметры виджета
* **lang** - Язык блока. Локализуются подписи кнопок соцсетей и кнопка Скопировать ссылку.
* **iconLimit** - Ограничение на количество отображаемых иконок
* **iconSize** - Размер кнопок соцсетей (medium|small), по умолчанию medium
* **title** - Текст-заголовок для кнопок (текст в блоке перед кнопками)
* **asText** - Отображать ссылки в виде текста
* **showCopyLink** - Отображать кнопку Скопировать ссылку (first|last|hidden)
* **services** - Список идентификаторов социальных сетей, отображаемых в блоке (*all* - все возможные варианты или через запятую, нужные вам на выбор из списка: *blogger, delicious, digg, evernote, facebook, gplus, linkedin, lj, moimir, odnoklassniki, pocket, qzone, renren, sinaWeibo, surfingburd, tencentWeibo, tumblr, twitter, viber, vkontakte, whatsapp*)



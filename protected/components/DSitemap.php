<?php
class DSitemap
{
    const ALWAYS = 'always';
    const HOURLY = 'hourly';
    const DAILY = 'daily';
    const WEEKLY = 'weekly';
    const MONTHLY = 'monthly';
    const YEARLY = 'yearly';
    const NEVER = 'never';
 
    public $items = array();
 
    /**
     * @param $url
     * @param string $changeFreq
     * @param float $priority
     * @param int $lastmod
     */
    public function addUrl($url, $changeFreq=self::DAILY, $priority=0.5, $lastMod=0)
    {
//        $host = Yii::app()->request->hostInfo;
        $host = '';
        $item = array(
            'loc' => $host . $url,
            'changefreq' => $changeFreq,
            'priority' => $priority
        );
        if ($lastMod)
            $item['lastmod'] = $this->dateToW3C($lastMod);
 
        $this->items[] = $item;
    }
 
    /**
     * @param CActiveRecord[] $models
     * @param string $changeFreq
     * @param float $priority
     */
    public function addModels($models, $changeFreq=self::DAILY, $priority=0.5)
    {
//        $host = Yii::app()->request->hostInfo;
        $host ='';
        foreach ($models as $model)
        {
            $url=$model->getUrl();
            $url=str_replace('http:',"https:",$url);
            $item = array(
                'loc' => $host . $url,
                'changefreq' => $changeFreq,
                'priority' => $priority
            );
 
            if ($model->hasAttribute('date_modified') && $model->hasAttribute('date_added')){
                if($model->date_modified!=$model->date_added)
                    $item['lastmod'] = $this->dateToW3C($model->date_modified);
            }

            $this->items[] = $item;
        }
    }
 
    /**
     * @return string XML code
     */
    public function render()
    {
        $dom = new DOMDocument('1.0', 'utf-8');
        $urlset = $dom->createElement('urlset');
        $urlset->setAttribute('xmlns','http://www.sitemaps.org/schemas/sitemap/0.9');
        $urlset->setAttribute('xmlns:xsi',"http://www.w3.org/2001/XMLSchema-instance");
        $urlset->setAttribute('xsi:schemaLocation',"http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd");

        foreach($this->items as $item)
        {
            $url = $dom->createElement('url');
 
            foreach ($item as $key=>$value)
            {
                $elem = $dom->createElement($key);
                $elem->appendChild($dom->createTextNode($value));
                $url->appendChild($elem);
            }
 
            $urlset->appendChild($url);
        }
        $dom->appendChild($urlset);
 
        return $dom->saveXML();
    }
 
    protected function dateToW3C($date)
    {
        if (is_int($date))
            return date(DATE_W3C, $date);
        else
            return date(DATE_W3C, strtotime($date));
    }
}
?>
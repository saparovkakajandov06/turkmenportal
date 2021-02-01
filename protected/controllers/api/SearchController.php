<?php


class SearchController extends Controller
{


    public function init(){
        parent::init(); 
    }
    
    
    public function actionSearch($query=null)
    {

        if (isset($_GET['page']))
            $page = (int)$_GET['page'];
        if (isset($_GET['per_page']))
            $per_page = (int)$_GET['per_page'];
        if (isset($_GET['hl'])){
            if ($_GET['hl'] == 'tm' || $_GET['hl'] == 'ru' || $_GET['hl'] == 'en')
                $hl = $_GET['hl'];
        } else {
            $hl = 'ru';
        }

        $search = New Search();

        $dataProvider = $search->searchApi($per_page, $page);

        $models = $dataProvider->getData();

        foreach ($models as $key => $model){
            $data['models'][] = array(
                'title' => $model->title,
                'url' => 'https://turkmenportal.com'.$model->material->url,
                'content' => $this->getFragment(strip_tags($model['text']), $query),
            );
        }
        if (!isset($data)){
            $data['models'] = [];
        }
        header('Content-Type: application/json; charset=UTF-8');
        echo Json::encode($data);die;


    }
    
//    
//    public function actionSearch()
//    {
//        setlocale(LC_CTYPE, 'ru_RU.UTF-8');
//        Zend_Search_Lucene_Analysis_Analyzer::setDefault(
//        new Zend_Search_Lucene_Analysis_Analyzer_Common_Utf8());
//
//        $this->layout='column2';
//        $term=$_POST['query'];
//         if ($term !== null) {
//            $index = new Zend_Search_Lucene(Yii::getPathOfAlias('application.' . $this->_indexFiles));
//            $results = $index->find($term);
//            $query = Zend_Search_Lucene_Search_QueryParser::parse($term);      
//
//
//            $this->render('search', compact('results', 'term', 'query'));
//        }
//    }
    
    
    
//    public function actionCreate()
//    {
//        setlocale(LC_CTYPE, 'ru_RU.UTF-8');
//        Zend_Search_Lucene_Analysis_Analyzer::setDefault(new Zend_Search_Lucene_Analysis_Analyzer_Common_Utf8());       
//
//        $index = new Zend_Search_Lucene(Yii::getPathOfAlias('application.' . $this->_indexFiles), true);
//        $blogs = Blog::model()->findAll(array('limit'=>'300','order'=>'id desc'));
////        echo "COUNT: ".count($blogs);
//        foreach($blogs as $blog){
//            $doc = new Zend_Search_Lucene_Document();
//            $doc->addField(Zend_Search_Lucene_Field::Text('title',CHtml::encode($blog->getMixedDescriptionModel()->title), 'UTF-8'));
//            $doc->addField(Zend_Search_Lucene_Field::Text('link',CHtml::encode($blog->getUrl()), 'UTF-8'));   
//            
//            $content = $this->clean_content($post->description);
//            $doc->addField(Zend_Search_Lucene_Field::Text('content',$content, 'UTF-8'));
//            $index->addDocument($doc);
//        }
//        $index->optimize();
//        $index->commit();
//        echo 'Lucene index successfully created: ';
//    }
    
    public function actionCreate()
    {
        
        Yii::app()->db->createCommand("
            TRUNCATE tbl_search
        ")->execute();
        
        
        Yii::app()->db->createCommand("
            INSERT INTO tbl_search 
            SELECT b.date_added as date_added,b.category_id as category_id,br.region_id as region_id, b.title_ru as title, b.text_ru as text, b.id AS material_id, 'application.models.Blog' AS material_import, 'Blog' AS material_class FROM `tbl_blog` b LEFT JOIN `tbl_blog_to_regions` br ON b.id=br.blog_id WHERE title_ru is not null AND status=1 UNION 
            SELECT b.date_added as date_added,b.category_id as category_id,br.region_id as region_id, b.title_tm as title, b.text_tm as text, b.id AS material_id, 'application.models.Blog' AS material_import, 'Blog' AS material_class FROM `tbl_blog` b LEFT JOIN `tbl_blog_to_regions` br ON b.id=br.blog_id WHERE title_tm is not null AND status=1 UNION 
            SELECT c.date_added as date_added,c.category_id as category_id,c.region_id as region_id, c.title_ru as title, c.content_ru as text, c.id AS material_id, 'application.models.Compositions' AS material_import, 'Compositions' AS material_class FROM `tbl_compositions` c  WHERE title_ru is not null AND status=1 UNION 
            SELECT c.date_added as date_added,c.category_id as category_id,c.region_id as region_id, c.title_ru as title, c.content_ru as text, c.id AS material_id, 'application.models.Compositions' AS material_import, 'Compositions' AS material_class FROM `tbl_compositions` c  WHERE title_tm is not null AND status=1 UNION 
            SELECT c.date_added as date_added, region_id,category_id,title_ru as title, content_ru as text, id AS material_id, 'application.models.Catalog' AS material_import, 'Catalog' AS material_class FROM `tbl_catalog` c  WHERE title_ru is not null AND status=1 UNION
            SELECT c.date_added as date_added, region_id,category_id,title_tm as title, content_tm as text, id AS material_id, 'application.models.Catalog' AS material_import, 'Catalog' AS material_class FROM `tbl_catalog` c WHERE title_ru is not null AND status=1
        ")->execute();
    }
    
    
    
// Function for returning a preview of the content:
// The preview is the first XXX characters.
    private function preview_content($data, $limit = 400) {
       return substr($data, 0, $limit) . '...';
    } 
// End of preview_content() function.
// Function for stripping junk out of content:
    private function clean_content($data) {
       return strip_tags($data);
    }
}
?>
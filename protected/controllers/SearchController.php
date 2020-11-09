<?php


class SearchController extends Controller
{
    public $layout='//layouts/column2';

//    private $_indexFiles = 'runtime.search';
    
    public function init(){
//        spl_autoload_unregister(array('YiiBase', 'autoload'));  
//        Yii::import('application.vendors.*');
//        require_once('Zend/Search/Lucene.php');
//        spl_autoload_register(array('YiiBase', 'autoload'));   
        parent::init(); 
    }
    
    
    public function actionSearch($query=null)
    {
        $this->layout='//layouts/column2';

        if(isset ($_POST['query']))
            $query=trim($_POST['query']);
        elseif(isset ($_GET['query']))
            $query=trim($_GET['query']);
        $criteria = new CDbCriteria();
        $criteria->addSearchCondition('title', $query);
        $criteria->addSearchCondition('text', $query, true, 'OR');

        if(isset ($_GET['category_id'])){
            $category_id=trim($_GET['category_id']);
            $criteria->compare('category_id', $category_id);
        }
        if(isset ($_GET['region_id'])){
            $region_id=trim($_GET['region_id']);
            $criteria->compare('region_id', $region_id);
        }

        $criteria->order='date_added desc';
        
        $dataProvider = new CActiveDataProvider('Search', array(
            'criteria'=>$criteria,
            'pagination'=>array(
                    'pageSize'=>20,
             ),
        ));
 
        $this->render('//search/index', array(
            'dataProvider'=>$dataProvider,
            'query'=>$query,
            'category_id'=>$category_id,
            'region_id'=>$region_id,
        ));
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
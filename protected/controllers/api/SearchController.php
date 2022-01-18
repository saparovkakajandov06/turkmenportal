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
                'id' => $model->material->id,
                'title' => $model->title,
                'url' => 'https://turkmenportal.com'.$model->material->url,
                'image_url' => 'https://turkmenportal.com'.$model->material->getThumbPath(512, 288, 'w'),
                'thumb_url' => 'https://turkmenportal.com'.$model->material->getThumbPath(256, 144, 'w'),
                'date' => $model->material->date_added,
                'cat_name' => $model->material->category->name,
                'cat_id' => (int)$model->material->category->id,
                'view_count' => (int)$model->material->visited_count,
            );
        }
        if (!isset($data)){
            $data['models'] = [];
        }
        header('Content-Type: application/json; charset=UTF-8');
        echo Json::encode($data);die;


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
<?php

class AnnouncementController extends Controller
{
//    public $layout='//layouts/user_profile';
    public $layout = '//layouts/user_profile';
    private $_model;


    public function actionIndex()
    {
        $userModel = $this->loadUser();
        $username = $userModel->username;

        $rawData = Yii::app()->db->createCommand("
                SELECT CONCAT(id,\"_catalog\") as item_id, c.create_username as create_username, c.date_added as date_added, c.region_id, c.category_id, id AS material_id, 'application.models.Catalog' AS material_import, 'Catalog' AS material_class FROM `tbl_catalog` c WHERE create_username='" . $username . "'
            UNION 
                SELECT CONCAT(id,\"_advert\") as item_id, c.create_username as create_username, c.date_added as date_added, c.region_id, c.category_id, id AS material_id, 'application.models.Advert' AS material_import, 'Advert' AS material_class FROM `tbl_advert` c WHERE create_username='" . $username . "'
            UNION 
                SELECT CONCAT(id,\"_auto\") as item_id, a.create_username as create_username, a.date_added as date_added,region_id as region_id,category_id, a.id AS material_id, 'application.models.Auto' AS material_import, 'Auto' AS material_class FROM `tbl_auto` a WHERE create_username='" . $username . "'
            UNION 
                SELECT CONCAT(id,\"_work\") as item_id, a.create_username as create_username, a.date_added as date_added,region_id as region_id,category_id, a.id AS material_id, 'application.models.Work' AS material_import, 'Work' AS material_class FROM `tbl_work` a WHERE create_username='" . $username . "'
            UNION 
                SELECT CONCAT(id,\"_estate\") as item_id, a.create_username as create_username, a.date_added as date_added,region_id as region_id,category_id, a.id AS material_id, 'application.models.Estates' AS material_import, 'Estates' AS material_class FROM `tbl_estates` a WHERE create_username='" . $username . "'
        ")->queryAll();


        $content_data = [];
        foreach ($rawData as $key => $data) {
            $material = CActiveRecord::model($data["material_class"])->findByPk($data["material_id"]);
            if (isset($material)) {
                $rawData[$key]['material'] = $material;
                $rawData[$key]['material_title'] = $material->getTitle();
                $rawData[$key]['material_description'] = $material->getDescription();
                $categoryModel = $material->category;
                if (isset($categoryModel)) {
                    $rawData[$key]['category_name'] = $categoryModel->getFullTitle(false, ' / ');
                }
                $rawData[$key]['thumb'] = $material->getThumbPath(90, 90, 'w', true);
                $content_data[] = $rawData[$key];
            }
        }

        $dataProvider = new CArrayDataProvider($content_data, array(
            'id' => 'announcement_provider',
            'keyField' => 'item_id',
            'sort' => array(
                'defaultOrder' => "date_added desc",
                'attributes' => array(
                    'item_id' => array(
                        'asc' => 'item_id',
                        'desc' => 'item_id DESC',
                    ),
                    '*'
                )
            ),
            'pagination' => array(
                'pageSize' => 10,
            )
        ));

//        echo "<pre>";
//        print_r($dataProvider->getData());
//        echo "</pre>";
//        exit(1);
//        Yii::app()->db->createCommand("
//            CREATE OR REPLACE VIEW user_announcement AS
//                SELECT c.create_username as create_username, c.date_added as date_added, c.region_id, c.category_id, id AS material_id, 'application.models.Catalog' AS material_import, 'Catalog' AS material_class FROM `tbl_catalog` c
//            UNION
//                SELECT a.create_username as create_username, a.date_added as date_added,region_id as region_id,category_id,ad.description as title, '' as text, a.id AS material_id, 'application.models.Auto' AS material_import, 'Auto' AS material_class FROM `tbl_auto` a LEFT JOIN `tbl_auto_description` ad ON a.id=ad.autos_id
//            UNION
//                SELECT e.create_username as create_username, e.date_added as date_added,region_id as region_id,category_id, ed.description as title, '' as text, e.id AS material_id, 'application.models.Estates' AS material_import, 'Estates' AS material_class FROM `tbl_estates` e LEFT JOIN `tbl_estates_description` ed ON e.id=ed.estates_id
//            UNION
//                SELECT e.create_username as create_username, e.date_added as date_added,region_id,'' as category_id, ed.description as title, ed.experience as text, e.id AS material_id, 'application.models.Employees' AS material_import, 'Employees' AS material_class FROM `tbl_employees` e LEFT JOIN `tbl_employees_description` ed ON e.id=ed.employees_id
//            UNION
//                SELECT e.create_username as create_username, e.date_added as date_added,region_id,'' as category_id, ed.description as title, ed.requirement as text, e.id AS material_id, 'application.models.Employers' AS material_import, 'Employers' AS material_class FROM `tbl_employers` e LEFT JOIN `tbl_employers_description` ed ON e.id=ed.employers_id
//        ")->execute();
//

//        $model = new Announcement();
//        $model->unsetAttributes();
//
//

//        if (isset($_GET['Announcement']))
//                $model->setAttributes($_GET['Announcement']);
        if (isset($_GET['status'])){
            $alertMsg = yii::t('app', 'obyava_alert_msg');
        } else {
            $alertMsg = '';
        }
        unset($_GET['status']);
        $this->render('/profile/announcement', array(
            'dataProvider' => $dataProvider,
            'alertMsg' => $alertMsg,
            ));
    }


    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer the primary key value. Defaults to null, meaning using the 'id' GET variable
     */
    public function loadUser()
    {
        if ($this->_model === null) {
            if (Yii::app()->user->id)
                $this->_model = Yii::app()->controller->module->user();
            if ($this->_model === null)
                $this->redirect(Yii::app()->controller->module->loginUrl);
        }
        return $this->_model;
    }
}

?>
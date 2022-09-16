<?php


class SearchCommand extends CConsoleCommand
{

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

}
<h5>
    <?php
        echo CHtml::link($this->parentCategoryModel->name, $this->parentCategoryModel->url, array('class' => 'show_all_big'));
    ?>
</h5>

<div class="row">
    <?php
    echo '<ul class="category_list">';
    if (isset($this->categories) && is_array($this->categories)) {
        foreach ($this->categories as $category) {
            if(isset($this->relatedActiveRecord)){
                $count=$this->relatedActiveRecord->countByAttributes(array('category_id'=>$category->id,'status'=>1));
//                if($count==0){
//                    continue;
//                }
            }

            $assoc_array = array_keys($category->getBreadcrumbs(true));
            $assoc_array = array_slice($assoc_array, 1, count($assoc_array));
            $full_name=array();
            if (count($assoc_array) > 1) {
                foreach ($assoc_array as $key => $val) {
                    $assoc_array[$key] = Yii::app()->controller->truncate($val, 2, 25);
                    $full_name[]=$val;
                }
            }else{
                $full_name=$assoc_array;
            }

            if (count($assoc_array) > 0) {
                $cat_name = Yii::app()->controller->truncate(implode($assoc_array, ' / '), 3, 22);
                $full_name = implode($full_name, ' / ');

                if(isset($count)){
                    $cat_name=$cat_name." (".$count.")";
                }

                echo '<li class="' . $this->item_class . '">' . CHtml::link($cat_name, $category->url,array('title'=>$full_name,'hreflang'=>Yii::app()->language)) . "</li>";
            }
        }
    }
    echo "</ul>";

    ?>
</div>


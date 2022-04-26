<div class="sub_categories">
    <div class=" col-sm-12 ">
        <?php if ($this->route != 'blog/index') $this->beginWidget('DNofollowWidget'); ?>
        <?php
        $sub_categories = Category::model()->enabled()->sort_by_sort_order()->findAllByAttributes(array('parent_id' => $modelCategory->id));
        if (count($sub_categories) == 0) {
            $parentCategory = $modelCategory->parent;
            if (isset($parentCategory)) {
                $sub_categories = $parentCategory->getSubcategoryList();
            }
        }
        if (isset ($sub_categories) && count($sub_categories) > 0) {
            echo "<ul>";
            foreach ($sub_categories as $subcatModel) {
                $cssClass = $subcatModel->id == $modelCategory->id ? "active" : "";
                echo CHtml::tag("li", array('class' => $cssClass), CHtml::link($subcatModel->name, $subcatModel->url), true);
            }
            echo "</ul>";
        }
        ?>
        <?php if ($this->route != 'blog/index') $this->endWidget(); ?>
    </div>
</div>

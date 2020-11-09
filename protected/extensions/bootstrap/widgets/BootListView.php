<?php
/**
 * BootListView class file.
 * @author Christoffer Niska <ChristofferNiska@gmail.com>
 * @copyright Copyright &copy; Christoffer Niska 2011-
 * @license http://www.opensource.org/licenses/bsd-license.php New BSD License
 * @package bootstrap.widgets
 */

Yii::import('zii.widgets.CListView');

/**
 * Bootstrap list view.
 * Used to enable the bootstrap pager.
 */
class BootListView extends CListView
{
	/**
	 * @var string the CSS class name for the pager container. Defaults to 'pagination'.
	 */
	public $pagerCssClass = 'pagination';
	/**
	 * @var array the configuration for the pager.
	 */
	public $pager = array('class'=>'bootstrap.widgets.BootPager');
	/**
	 * @var string the URL of the CSS file used by this detail view.
	 * Defaults to false, meaning that no CSS will be included.
	 */
	public $cssFile = false;

	/**
	 * Initializes the widget.
	 */
	public function init()
	{
		parent::init();

		$popover = Yii::app()->bootstrap->popoverSelector;
		$tooltip = Yii::app()->bootstrap->tooltipSelector;

		$afterAjaxUpdate = "js:function() {
			jQuery('.popover').remove();
			jQuery('{$popover}').popover();
			jQuery('.tooltip').remove();
			jQuery('{$tooltip}').tooltip();
		}";

		if (!isset($this->afterAjaxUpdate))
			$this->afterAjaxUpdate = $afterAjaxUpdate;
	}



    public function renderSorter() {
        if ($this->dataProvider->getItemCount() <= 0 || !$this->enableSorting || empty($this->sortableAttributes))
            return;
        echo CHtml::openTag('div', array ('class' => $this->sorterCssClass)) . "\n";
        echo $this->sorterHeader === null ? Yii::t('zii', 'Sort by: ') : $this->sorterHeader;
        echo "<ul>\n";
        $sort = $this->dataProvider->getSort();
        foreach ($this->sortableAttributes as $name => $label) {
            echo "<li>";
            if (is_integer($name))
                echo $sort->link($label, null, array ("rel" => "nofollow"));
            else
                echo $sort->link($name, $label, array ("rel" => "nofollow"));
            echo "</li>\n";
        }
        echo "</ul>";
        echo $this->sorterFooter;
        echo CHtml::closeTag('div');
    }
}

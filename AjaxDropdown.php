<?php
/**
 * @author chervand <chervand@gmail.com>
 */

namespace chervand\bootstrap;

use yii\bootstrap\Dropdown;
use yii\helpers\Json;

/**
 * Class AjaxDropdown
 * @package chervand\bootstrap
 */
class AjaxDropdown extends Dropdown
{
    public $ajaxOptions = [];
    public $confirm;
    public $itemSelector;

    /**
     * @inheritdoc
     * @return string
     */
    public function run()
    {
        $id = $this->options['id'];
        $options = $this->getClientOptions();
        $options = empty($options) ? '' : Json::htmlEncode($options);

        $view = &$this->getView();
        Yii2BootstrapAsset::register($view);
        $view->registerJs("jQuery('#$id').ajaxDropdown($options);");

        return parent::run();
    }

    /**
     * @return array client script options
     */
    protected function getClientOptions()
    {
        $options = [];
        if ($this->ajaxOptions) {
            $options['ajaxOptions'] = $this->ajaxOptions;
        }
        if ($this->itemSelector) {
            $options['itemSelector'] = $this->itemSelector;
        }
        if ($this->confirm) {
            $options['confirm'] = $this->confirm;
        }

        return $options;
    }
}

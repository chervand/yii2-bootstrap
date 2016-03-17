<?php
/**
 * @author chervand <chervand@gmail.com>
 */

namespace chervand\bootstrap;

use yii\base\InvalidConfigException;
use yii\bootstrap\Widget;
use yii\helpers\ArrayHelper;

/**
 * Class \chervand\bootstrap\Panel implements Bootstrap 3 Panel widget.
 *
 * @package chervand\bootstrap
 * @see http://getbootstrap.com/components/#panels
 * @see http://www.yiiframework.com/doc-2.0/yii-bootstrap-widget.html
 */
class Panel extends Widget
{
    /**
     * inheritdoc
     */
    public $options = [];
    /**
     * @var array|string heading section
     * @see \chervand\bootstrap\Panel::prepareSection()
     */
    public $heading;
    /**
     * @var array|string body section
     * @see \chervand\bootstrap\Panel::prepareSection()
     */
    public $body;
    /**
     * @var array|string footer section
     * @see \chervand\bootstrap\Panel::prepareSection()
     */
    public $footer;

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
        $this->clientOptions = false;

        if (empty($this->options['class'])) {
            Html::addCssClass($this->options, ['panel', 'panel-default']);
        } else {
            Html::addCssClass($this->options, ['widget' => 'panel']);
        }

        $this->heading = static::prepareSection('heading', $this->heading);
        $this->body = static::prepareSection('body', $this->body);
        $this->footer = static::prepareSection('footer', $this->footer);


        echo Html::beginTag('div', $this->options);

        if (isset($this->heading['content'])) {
            echo Html::tag('div', $this->heading['content'], $this->heading['options']);
        }

        if (isset($this->body['content'])) {
            echo Html::tag('div', $this->body['content'], $this->body['options']);
        } else {
            echo Html::beginTag('div', $this->body['options']);
        }
    }

    /**
     * @param string $name section name, e.g. 'heading', 'body' or 'footer'
     * @param array|string $section todo: section description
     * @return array
     * @throws InvalidConfigException
     */
    public function prepareSection($name, &$section)
    {
        if (is_string($section)) {
            $section = ['content' => $section];
        } elseif (is_callable($section)) {
            $section = ['view' => $section];
        }

        if (is_array($section) && isset($section['view'])) {
            if (is_string($section['view'])) {
                $params = ArrayHelper::getValue($section, 'params', []);
                $section['content'] = $this->getView()
                    ->render($section['view'], $params);
            } elseif (is_callable($section['view'])) {
                $section['content'] = call_user_func($section['view'], $this);
            }
        }

        if (isset($section['content']) && !is_string($section['content'])) {
            throw new InvalidConfigException('Invalid attribute type, string expected.');
        }

        $section['options'] = ArrayHelper::getValue($section, 'options', []);
        Html::addCssClass($section['options'], ['widget' => 'panel-' . $name]);

        return $section;
    }

    /**
     * @inheritdoc
     */
    public function run()
    {
        if (!isset($this->body['content'])) {
            echo Html::endTag('div');
        }

        if (isset($this->footer['content'])) {
            echo Html::tag('div', $this->footer['content'], $this->footer['options']);
        }

        echo Html::endTag('div');
    }
}

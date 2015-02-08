<?php

namespace Oxygen\Dashboard;

use Oxygen\Core\Html\RenderableInterface;
use Oxygen\Core\Html\RenderableTrait;

use Oxygen\Dashboard\Widget\WidgetInterface;

class Dashboard implements RenderableInterface {

    use RenderableTrait;

    /**
     * Pool of available widgets.
     *
     * @var array
     */

    protected $widgetPool;

    /**
     * Pool of widgets that haven't been loaded yet.
     *
     * @var array
     */

    protected $lazyLoadWidgets;

    /**
     * Constructs the Dashboard.
     */

    public function __construct() {
        $this->widgetPool = [];
        $this->lazyLoadWidgets = [];
    }

    /**
     * Adds a widget to the pool of available widgets.
     *
     * @param WidgetInterface $widget
     * @return void
     */

    public function add($widget) {
        if(is_callable($widget)) {
            $this->registerLazyWidget($widget);
        } else {
            $this->registerWidget($widget);
        }
    }

    /**
     * Adds a widget to the pool of available widgets.
     *
     * @param WidgetInterface $widget
     * @return void
     */

    public function registerWidget(WidgetInterface $widget) {
        $this->widgetPool[$widget->getIdentifier()] = $widget;
    }

    /**
     * Adds a callable that will return a widget.
     *
     * @param callable $widget
     * @return void
     */

    public function registerLazyWidget(callable $widget) {
        $this->lazyLoadWidgets[] = $widget;
    }

    /**
     * Removes a widget from the pool of available widgets.
     *
     * @param WidgetInterface $widget
     * @return void
     */

    public function unregisterWidget(WidgetInterface $widget) {
        unset($this->widgetPool[$widget->getIdentifier()]);
    }

    /**
     * Returns the widgets to be displayed.
     *
     * @return array
     */

    public function getWidgets() {
        $this->loadLazyWidgets();

        return $this->widgetPool;
    }

    /**
     * Loads widgets that haven't been loaded yet.
     */

    protected function loadLazyWidgets() {
        foreach($this->lazyLoadWidgets as $widget) {
            $this->registerWidget($widget());
        }
    }

}
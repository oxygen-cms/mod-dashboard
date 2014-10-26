<?php

namespace Oxygen\Dashboard;

use Oxygen\Core\Html\RenderableTrait;

use Oxygen\Dashboard\Widget\WidgetInterface;

class Dashboard {

    use RenderableTrait;

    /**
     * Pool of available widgets.
     *
     * @var array
     */

    protected $widgetPool;

    /**
     * Constructs the Dashboard.
     */

    public function __construct() {
        $this->widgetPool = [];
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
        return $this->widgetPool;
    }

}
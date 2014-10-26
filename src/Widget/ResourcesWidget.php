<?php

namespace Oxygen\Dashboard\Widget;

use Oxygen\Core\Blueprint\Manager;
use Oxygen\Core\Html\RenderableTrait;

class ResourcesWidget implements WidgetInterface {

    use RenderableTrait;

    /**
     * Blueprints to use.
     *
     * @var Manager
     */

    public $blueprintManager;

    /**
     * Order of Blueprints
     *
     * @var array
     */

    public $order;

    /**
     * Constructs the ResourcesWidget.
     *
     * @param Manager $blueprintManager
     * @param array $order Order of the Blueprints
     */

    public function __construct(Manager $blueprintManager, array $order = []) {
        $this->blueprintManager = $blueprintManager;
        $this->order = $order;
    }

    /**
     * Returns the Blueprints in order.
     *
     * @return array
     */

    public function getBlueprintsInOrder() {
        if(empty($order)) {
            return $this->blueprintManager->all();
        }

        $blueprints = [];
        foreach($this->order as $item) {
            $blueprints[] = $this->blueprintManager->get($item);
        }
        return $blueprints;
    }

    /**
     * Returns a unique identifier for the widget.
     *
     * @return string
     */

    public function getIdentifier() {
        return 'resources';
    }

}
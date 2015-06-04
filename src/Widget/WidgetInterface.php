<?php

namespace Oxygen\Dashboard\Widget;

use Oxygen\Core\Html\RenderableInterface;

interface WidgetInterface extends RenderableInterface {

    /**
     * Returns a unique identifier for the widget.
     *
     * @return string
     */
    public function getIdentifier();

}
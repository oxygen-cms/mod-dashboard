<?php

namespace Oxygen\Dashboard\Widget;

interface WidgetInterface {

    /**
     * Returns a unique identifier for the widget.
     *
     * @return string
     */

    public function getIdentifier();

    /**
     * Renders the widget.
     *
     * @return string
     */

    public function render();

}
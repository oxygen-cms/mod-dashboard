<?php

namespace OxygenModule\Dashboard\Controller;

use Lang;
use Illuminate\View\Factory as View;

use Oxygen\Core\Controller\Controller;

class DashboardController extends Controller {

    /**
     * View Factory dependency.
     *
     * @var Illuminate\View\Factory
     */

    protected $view;

    /**
     * Injects required dependencies.
     *
     * @param View $view
     */
    public function __construct(View $view) {
        $this->view = $view;
    }

    /**
     * Shows the Dashboard page.
     *
     * @return Response
     */
    public function getIndex() {
        return $this->view->make('oxygen/mod-dashboard::home', [
            'title' => Lang::get('oxygen/mod-dashboard::dashboard.title')
        ]);
    }

}

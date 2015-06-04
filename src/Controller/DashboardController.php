<?php

namespace Oxygen\Dashboard\Controller;

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
        return $this->view->make('oxygen/dashboard::home', [
            'title' => Lang::get('oxygen/dashboard::dashboard.title')
        ]);
    }

}

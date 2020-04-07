<?php

namespace OxygenModule\Dashboard\Controller;

use Oxygen\Core\Controller\Controller;

class DashboardController extends Controller {

    /**
     * Shows the Dashboard page.
     */
    public function getIndex() {
        return view('oxygen/mod-dashboard::home', [
            'title' => __('oxygen/mod-dashboard::dashboard.title')
        ]);
    }

}

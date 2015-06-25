<?php

namespace OxygenModule\Dashboard\Facades;

use Illuminate\Support\Facades\Facade;

use OxygenModule\Dashboard\Dashboard as DashboardManager;

class Dashboard extends Facade {

    protected static function getFacadeAccessor() {
        return DashboardManager::class;
    }

}
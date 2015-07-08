<?php

use Illuminate\Database\Migrations\Migration;
use Oxygen\Preferences\PreferencesManager;

class AddDashboardToAuth extends Migration {

    /**
     * Run the migrations.
     *
     */
    public function up() {
        $preferences = App::make(PreferencesManager::class);

        $schema = $preferences->getSchema('modules.auth');
        $schema->getRepository()->set('dashboard', 'dashboard.main');
        $schema->getRepository()->set('home', 'pages.getView');
        $schema->storeRepository();
    }

    /**
     * Reverse the migrations.
     */
    public function down() {
        $preferences = App::make(PreferencesManager::class);

        $schema = $preferences->getSchema('modules.auth');
        $schema->getRepository()->set('dashboard', null);
        $schema->getRepository()->set('home', null);
        $schema->storeRepository();
    }
}

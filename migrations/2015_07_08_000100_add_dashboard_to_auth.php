<?php

use Illuminate\Database\Migrations\Migration;
use Oxygen\Preferences\PreferencesManager;

class AddDashboardToAuth extends Migration {

    /**
     * Run the migrations.
     *
     * @param \Oxygen\Preferences\PreferencesManager $preferences
     */
    public function up(PreferencesManager $preferences) {
        $schema = $preferences->getSchema('modules.auth');
        $schema->getRepository()->set('dashboard', 'dashboard.main');
        $schema->getRepository()->set('home', 'pages.getView');
        $schema->storeRepository();
    }

    /**
     * Reverse the migrations.
     *
     * @param \Oxygen\Preferences\PreferencesManager $preferences
     */
    public function down(PreferencesManager $preferences) {
        $schema = $preferences->getSchema('modules.auth');
        $schema->getRepository()->set('dashboard', null);
        $schema->getRepository()->set('home', null);
        $schema->storeRepository();
    }
}

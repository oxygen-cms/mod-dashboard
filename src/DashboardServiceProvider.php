<?php namespace OxygenModule\Dashboard;

use Illuminate\Support\ServiceProvider;

use Oxygen\Core\Action\Action;
use Oxygen\Core\Blueprint\BlueprintManager;
use Oxygen\Core\Contracts\CoreConfiguration;
use Oxygen\Core\Contracts\Routing\BlueprintRegistrar;
use Oxygen\Core\Database\AutomaticMigrator;
use Oxygen\Core\Html\Navigation\Navigation;
use Oxygen\Core\Html\Toolbar\ButtonToolbarItem;
use Oxygen\Core\Html\Toolbar\SpacerToolbarItem;

use OxygenModule\Dashboard\Widget\ResourcesWidget;
use OxygenModule\Dashboard\Renderer\Dashboard as DashboardRenderer;
use OxygenModule\Dashboard\Renderer\ResourcesWidget as ResourcesWidgetRenderer;

class DashboardServiceProvider extends ServiceProvider {

	/**
	 * Indicates if loading of the provider is deferred.
	 *
	 * @var bool
	 */

	protected $defer = false;

	/**
	 * Bootstrap the application events.
	 *
	 * @return void
	 */

	public function boot() {
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'oxygen/mod-dashboard');
        $this->loadTranslationsFrom(__DIR__ . '/../resources/lang', 'oxygen/mod-dashboard');
        $this->publishes([
            __DIR__ . '/../resources/lang' => base_path('resources/lang/vendor/oxygen/mod-dashboard'),
            __DIR__ . '/../resources/views' => base_path('resources/views/vendor/oxygen/mod-dashboard')
        ]);

        $this->app[AutomaticMigrator::class]->loadMigrationsFrom(__DIR__ . '/../migrations', 'oxygen/mod-dashboard');

		$this->registerRenderers();
		$this->registerWidgets();
		$this->registerActions();
	}

	/**
	 * Registers renderers used by the Dashboard component.
	 */

	public function registerRenderers() {
		$view = $this->app['view'];
		Dashboard::setRenderer(new DashboardRenderer($view));
        ResourcesWidget::setRenderer(new ResourcesWidgetRenderer($view));
	}

	/**
	 * Register's the Dashboard component's default widgets.
	 */
	public function registerWidgets() {
		$this->app[Dashboard::class]->add(function() {
            $order = $this->app['auth']->check()
                ? $this->app['auth']->user()->getPreferences()->get('dashboard.resources.order')
                : null;

            if(!is_array($order)) {
                $order = [];
            }

            return new ResourcesWidget($this->app[BlueprintManager::class], $order);
        });
	}

	/**
	 * Registers the Dashboard component's actions
	 * and adds them to the main nav.
	 */

	public function registerActions() {
		$dashboardAction = new Action(
		    'dashboard.main', // name
		     $this->app[CoreConfiguration::class]->getAdminUriPrefix() . '/dashboard',
		    'OxygenModule\Dashboard\Controller\DashboardController@getIndex'
		);
		$dashboardAction->middleware[] = 'web';
		$dashboardAction->middleware[] = 'oxygen.auth';
        $dashboardAction->useSmoothState = true;

		$dashboardToolbarItem = new ButtonToolbarItem(
		    'Dashboard',
		    $dashboardAction
		);
		// $dashboardToolbarItem->icon = 'home';

		$this->app[BlueprintRegistrar::class]->action($dashboardAction);
		$this->app[Navigation::class]->add($dashboardToolbarItem);
	}

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register() {
        $this->app->singleton(Dashboard::class, function() {
            return new Dashboard();
        });
    }

}

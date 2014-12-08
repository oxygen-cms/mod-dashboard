<?php namespace Oxygen\Dashboard;

use Illuminate\Support\ServiceProvider;

use Oxygen\Core\Action\Action;
use Oxygen\Core\Html\Toolbar\ButtonToolbarItem;
use Oxygen\Core\Html\Toolbar\SpacerToolbarItem;

use Oxygen\Dashboard\Widget\ResourcesWidget;
use Oxygen\Dashboard\Renderer\Dashboard as DashboardRenderer;
use Oxygen\Dashboard\Renderer\ResourcesWidget as ResourcesWidgetRenderer;

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
		$this->package('oxygen/dashboard', 'oxygen/dashboard', __DIR__ . '/../resources');

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
		$this->app['oxygen.dashboard']->add(function() {
            $order = $this->app['auth']->check()
                ? $this->app['auth']->user()->getPreferences()->get('dashboard.resources.order')
                : null;
            if(!is_array($order)) {
                $order = [];
            }

            return new ResourcesWidget($this->app['oxygen.blueprintManager'], $order);
        });
	}

	/**
	 * Registers the Dashboard component's actions
	 * and adds them to the main nav.
	 */

	public function registerActions() {
		$dashboardAction = new Action(
		    'dashboard.main', // name
		     $this->app['config']->get('oxygen/core::baseURI') . '/dashboard',
		    'Oxygen\Dashboard\Controller\DashboardController@getIndex'
		);
		$dashboardAction->beforeFilters[] = 'oxygen.auth';
        $dashboardAction->useSmoothState = true;

		$dashboardToolbarItem = new ButtonToolbarItem(
		    'Dashboard',
		    $dashboardAction
		);

		$this->app['router']->action($dashboardAction);
		$this->app['oxygen.navigation']->add($dashboardToolbarItem);
	}

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register() {
		// bind Dashboard
        $this->app->bindShared(['oxygen.dashboard' => 'Oxygen\Dashboard\Dashboard'], function() {
            return new Dashboard();
        });
	}

	/**
	 * Get the services provided by the provider.
	 *
	 * @return array
	 */

	public function provides() {
		return [
			'oxygen.dashboard'
		];
	}

}

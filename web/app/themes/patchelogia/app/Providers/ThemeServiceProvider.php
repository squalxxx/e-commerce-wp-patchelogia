<?php

namespace App\Providers;

use Roots\Acorn\Sage\SageServiceProvider;

class ThemeServiceProvider extends SageServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        parent::register();

        $this->registerPages();
        $this->registerBlocks();
        $this->registerAjaxHandler();
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();
    }

    /**
     * Auto-register every pages.
     */
    protected function registerPages(): void
    {
        new \App\View\Admin\NewsletterPage();
        new \App\View\Admin\FeedbacksPage();
        new \App\View\Admin\AmbassadorshipPage();
    }

    /**
     * Auto-register every block in App\View\Blocks.
     */
    protected function registerBlocks(): void
    {
        collect(glob(app_path('View/Blocks/*.php')))
            ->map(fn($file) => 'App\\View\\Blocks\\' . basename($file, '.php'))
            ->reject(fn($class) => $class === \App\View\Blocks\Block::class)
            ->each(fn($class) => new $class());
    }

    /**
     * Register the themes AJAX endpoints.
     */
    protected function registerAjaxHandler(): void
    {
        require_once app_path('Http/AjaxHandler.php');
    }
}

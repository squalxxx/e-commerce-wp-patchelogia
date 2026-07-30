<?php

namespace App\Providers;

use App\View\Blocks\Block;
use Roots\Acorn\Sage\SageServiceProvider;
use Symfony\Component\Finder\Finder;

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

        \App\Http\AjaxHandler::register();

        $this->registerPages();
        $this->registerBlocks();
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
        app(\App\View\Admin\NewsletterPage::class);
        app(\App\View\Admin\FeedbacksPage::class);
        app(\App\View\Admin\AmbassadorshipPage::class);
    }

    /**
     * Auto-register every block in App\View\Blocks.
     */
    protected function registerBlocks(): void
    {
        collect(
            Finder::create()
                ->files()
                ->in(app_path('View/Blocks'))
                ->name('*.php')
        )
            ->map(fn($file) => 'App\\View\\Blocks\\' . $file->getBasename('.php'))
            ->reject(fn($class) => $class === Block::class)
            ->each(fn($class) => app($class));
    }
}

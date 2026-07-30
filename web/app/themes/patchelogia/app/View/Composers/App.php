<?php

namespace App\View\Composers;

use Roots\Acorn\View\Composer;

class App extends Composer
{
    protected static $views = [
        '*',
    ];

    public function siteName(): string
    {
        return get_bloginfo('name', 'display');
    }

    public function isHome(): bool
    {
        return is_home();
    }

    public function pageTitle(): string
    {
        if (is_home()) {
            if ($home = get_option('page_for_posts', true)) {
                return get_the_title($home);
            }

            return __('Latest Posts', 'sage');
        }

        if (is_archive()) {
            return get_the_archive_title();
        }

        if (is_search()) {
            return sprintf(
                __('Search Results for %s', 'sage'),
                get_search_query()
            );
        }

        if (is_404()) {
            return __('Not Found', 'sage');
        }

        return get_the_title();
    }

    public function pageSubtitle(): string
    {
        return get_field('subtitle') ?: '';
    }

    public function pageNotice(): string
    {
        return get_field('notice') ?: '';
    }

    public function socials(): array
    {
        return getOptionField('socials') ?: [];
    }
}

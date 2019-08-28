<?php

namespace Fanintek\Fantasena\Providers;

use Illuminate\Support\ServiceProvider;

use Spatie\Menu\Laravel\Link;

class SidebarMenuProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        Link::macro('fanRender', function($menuArray) {
            switch($menuArray['menu_link_type']) {
                case "ROUTE_NAME": 
                    return Link::toRoute($menuArray['menu_data'], "<i class='{$menuArray['menu_icon']}'></i> <span>{$menuArray['menu_label']}</span>");
                    break;
                case "ROUTE_ACTION":
                    return Link::toAction($menuArray['menu_data'], "<i class='{$menuArray['menu_icon']}'></i> <span>{$menuArray['menu_label']}</span>");
                    break;
                case "URL":
                    return Link::toUrl($menuArray['menu_data'], "<i class='{$menuArray['menu_icon']}'></i> <span>{$menuArray['menu_label']}</span>");
                    break;
                default: 
                    throw new \Exception("Invalid Link Type");
            }
        });

        Link::macro('subMenuRender', function($menuArray) {
            return Link::toUrl('#', "<i class='{$menuArray['menu_icon']}'></i> <span>{$menuArray['menu_label']}</span> <span class='pull-right-container'><i class='fa fa-angle-left pull-right'></i></span>");
        });
    }
}

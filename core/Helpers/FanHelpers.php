<?php
use Illuminate\Support\Facades\Route;

use Fanintek\Fantasena\Models\FanMenu;

use Spatie\Menu\Laravel\Menu;
use Spatie\Menu\Laravel\Link;

if (!function_exists('buildTree')) {
    function buildTree(array $elements, $parentId = 0) {
        $branch = array();

        foreach ($elements as $element) {
            if ($element['parent_id'] == $parentId) {
                $children = buildTree($elements, $element['id']);
                if ($children) {
                    $element['children'] = $children;
                    unset($children['parent_id']);
                    unset($children['id']);
                }
                unset($element['parent_id']);
                unset($element['id']);
                $branch[] = $element;
            }
        }

        return $branch;
    }
}

if (!function_exists('generate_menu')) {
    function generate_menu() {
        $menus = buildTree(FanMenu::all()->toArray());

        return Menu::build($menus, function($menu, $link) {
            if (array_key_exists('children', $link)) {
                // Dropdown
                $menu->subMenu($link['menu_label'], 
                    Menu::build($link['children'], function($menu, $link) {
                        if (!empty($link['menu_url'])) {
                            $linkx = Link::toUrl($link['menu_url'], $link['menu_label']);
                        } else {
                            $linkx = Link::toRoute($link['menu_route'], $link['menu_label']);
                        }
                        
                        $isAllowed = (auth()->user()->hasAnyRole(json_decode($link['granted_to'])->roles) || (config('fanrbac.super_admin') !== null) ? auth()->user()->hasRole(config('fanrbac.super_admin')) : false );

                        $menu->addIf($isAllowed, $linkx);
                    })
                );
                
            } else {
                if (!empty($link['menu_url'])) {
                    $linkx = Link::toUrl($link['menu_url'], $link['menu_label']);
                } else {
                    $linkx = Link::toRoute($link['menu_route'], $link['menu_label']);
                }
                $isAllowed = (auth()->user()->hasAnyRole(json_decode($link['granted_to'])->roles) || (config('fanrbac.super_admin') !== null) ? auth()->user()->hasRole(config('fanrbac.super_admin')) : false );
                $menu->addIf($isAllowed, $linkx);
            }
        })->render();
    }
}
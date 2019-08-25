<?php
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

if (!function_exists('buildMenu')) {
    function buildMenu(array $menuItems) {
        $sidebar = Menu::new()->addClass('sidebar-menu')->setAttributes(['data-widget' => 'tree']);
    
        foreach ($menuItems as $menu) {
            if (array_key_exists('children', $menu)) {

                $sidebar->submenu(Link::subMenuRender($menu), function(Menu $spatieMenu) use ($menu) {
                foreach($menu['children'] as $child) {
                    $spatieMenu->add(Link::fanRender($child));
                }
                $spatieMenu->addClass('treeview-menu')->addParentClass('treeview');
                });
            } else {
                $sidebar->add(Link::fanRender($menu));
            }
        }

        return $sidebar->setActiveFromRequest()->render();
    }
}
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
                $roles = json_decode($menu['granted_to'])->roles;
                $roles[] = config('fanrbac.super_admin');

                $sidebar->submenuIf(auth()->user()->hasRole($roles), Link::subMenuRender($menu), function(Menu $spatieMenu) use ($menu) {
                foreach($menu['children'] as $child) {
                    $roles = json_decode($child['granted_to'])->roles;
                    $roles[] = config('fanrbac.super_admin');

                    $access = auth()->user()->hasRole($roles);
                    $spatieMenu->addIf($access, Link::fanRender($child));
                }
                $spatieMenu->addClass('treeview-menu')->addParentClass('treeview');
                });
            } else {
                $roles = json_decode($menu['granted_to'])->roles;
                $roles[] = config('fanrbac.super_admin');

                $access = auth()->user()->hasRole($roles);
                $sidebar->addIf($access, Link::fanRender($menu));
            }
        }

        return $sidebar->setActiveFromRequest()->render();
    }
}

if (!function_exists('buildAction')) {
    function buildAction($id) {
        return <<<ACTION
        <div class="text-center">
            <a href="#viewModal" data-toggle="modal" data-target="#viewModal" data-userid="$id" class="btn btn-xs btn-info"><i class="fa fa-eye"></i> View</a>
            <a href="#editModal" data-toggle="modal" data-target="#editModal" data-userid="$id" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i> Edit</a>
            <a href="#deleteModal" data-toggle="modal" data-target="#deleteModal" data-userid="$id" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i> Delete</a>
        </div>
ACTION;
    }
}
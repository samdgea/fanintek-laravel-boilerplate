<?php

namespace Fanintek\Fantasena\Forms\Admin;

use Kris\LaravelFormBuilder\Field;
use Kris\LaravelFormBuilder\Form;

use Fanintek\Fantasena\Models\FanMenu;
use Spatie\Permission\Models\Role;
class MenuForm extends Form
{
    public function buildForm()
    {
        $menus = FanMenu::pluck('menu_label', 'id')->toArray();
        $roles = Role::pluck('name', 'name')->toArray();

        $this
            ->add('parent_id', Field::SELECT, [
                'empty_value' => 'No Parent',
                'choices' => $menus
            ])
            ->add('menu_label', Field::TEXT, [
                'attr' => ['placeholder' => 'Menu Name'],
            ])
            ->add('menu_link_type', Field::SELECT, [
                'label' => 'Link Type',
                'choices' => ['ROUTE_NAME' => 'Route Name', 'ROUTE_ACTION' => 'Route Action', 'URL' => 'URL'],
                'selected' => 'URL',
                'rules' => 'required'
            ])
            ->add('menu_data', Field::TEXT, [
                'label' => 'Menu Link / Route / Action',
                'attr' => ['placeholder' => 'Menu Link / Route / Action'],
                'rules' => 'required'
            ])
            ->add('menu_icon', Field::TEXT, [
                'attr' => ['placeholder' => 'Menu Icon'],
                // 'rules' => 'nul'
            ])
            ->add('granted_to', Field::CHOICE, [
                'label' => 'Allowed Role',
                'choice_options' => [
                    'wrapper' => ['class' => 'choice-wrapper'],
                    'label_attr' => ['class' => 'label-class'],
                ],
                'choices' => $roles,
                'expanded' => true,
                'multiple' => true,
                'selected' => function ($data) {
                    if (empty($data)) return [];
                    return json_decode($data)->roles;
                }
            ])
            ->add('submit', 'submit', ['label' => 'Save changes', 'attr' => ['class' =>'btn btn-primary pull-right']])
            ->add('clear', 'reset', ['label' => 'Clear form', 'attr' => ['class' =>'btn btn-default']]);
    }
}

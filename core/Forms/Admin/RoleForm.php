<?php

namespace Fanintek\Fantasena\Forms\Admin;

use Kris\LaravelFormBuilder\Field;
use Kris\LaravelFormBuilder\Form;

class RoleForm extends Form
{
    public function buildForm()
    {
        $this
            ->add('name', Field::TEXT, [
                'attr' => ['placeholder' => 'Role Name'],
            ])
            ->add('submit', 'submit', ['label' => 'Save changes', 'attr' => ['class' =>'btn btn-primary pull-right']])
            ->add('clear', 'reset', ['label' => 'Clear form', 'attr' => ['class' =>'btn btn-default']]);
    }
}

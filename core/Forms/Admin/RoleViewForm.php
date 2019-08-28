<?php

namespace Fanintek\Fantasena\Forms\Admin;

use Kris\LaravelFormBuilder\Field;
use Kris\LaravelFormBuilder\Form;

class RoleViewForm extends Form
{
    public function buildForm()
    {
        $this
            ->add('name', Field::TEXT, [
                'attr' => ['placeholder' => 'Role Name', 'readonly'],
            ])
            ->add('created_at', Field::STATIC, [
                'attr' => ['placeholder' => 'Creation Date', 'readonly'],
                // 'rules' => 'nullable|max:50'
            ])
            ->disableFields();
    }
}

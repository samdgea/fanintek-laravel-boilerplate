<?php

namespace Fanintek\Fantasena\Forms\Admin;

use Kris\LaravelFormBuilder\Field;
use Kris\LaravelFormBuilder\Form;

class UserViewForm extends Form
{
    public function buildForm()
    {
        $this
            ->add('first_name', Field::TEXT, [
                'attr' => ['placeholder' => 'John', 'readonly'],
                // 'rules' => 'required|min:5|max:50'
            ])
            ->add('last_name', Field::TEXT, [
                'attr' => ['placeholder' => 'Doe', 'readonly'],
                // 'rules' => 'nullable|max:50'
            ])
            ->add('email', Field::EMAIL, [
                'attr' => ['placeholder' => 'john.doe@example.com', 'readonly'],
                // 'rules' => 'email'
            ])
            ->add('user_role', Field::STATIC, [
                'attr' => ['placeholder' => 'User Role', 'readonly'],
                'value' => implode(',', $this->getModel()->roles->pluck('name')->toArray())
                // 'rules' => 'email'
            ])
            ->disableFields();
    }
}

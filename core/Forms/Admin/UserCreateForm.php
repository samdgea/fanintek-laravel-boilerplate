<?php

namespace Fanintek\Fantasena\Forms\Admin;

use Kris\LaravelFormBuilder\Field;
use Kris\LaravelFormBuilder\Form;

use Spatie\Permission\Models\Role;

class UserCreateForm extends Form
{
    public function buildForm()
    {
        $roles = Role::pluck('name', 'name')->toArray();

        $this
            ->add('first_name', Field::TEXT, [
                'attr' => ['placeholder' => 'John'],
                'rules' => 'required|min:5|max:50'
            ])
            ->add('last_name', Field::TEXT, [
                'attr' => ['placeholder' => 'Doe'],
                'rules' => 'nullable|max:50'
            ])
            ->add('email', Field::EMAIL, [
                'attr' => ['placeholder' => 'john.doe@example.com'],
                'rules' => 'email'
            ])
            ->add('password', Field::PASSWORD, [
                'attr' => ['placeholder' => '******'],
                'rules' => 'required|string|min:6|max:50|confirmed'
            ])
            ->add('password_confirmation', Field::PASSWORD, [
                'label' => 'Re-type Password',
                'attr' => ['placeholder' => '******'],
                // 'rules' => 'required|string|min:6|max:50'
            ])
            ->add('is_active', Field::SELECT, [
                'choices' => ['0' => 'Non-Active', '1' => 'Active'],
                'empty_value' => '=== Select Status User ===',
                'rules' => 'required'
            ])
            ->add('assign_role', Field::SELECT, [
                'choices' => $roles,
                'selected' => config('fanrbac.new_user_default_role'),
                'rules' => 'required'
            ])
            ->add('submit', 'submit', ['label' => 'Save changes', 'attr' => ['class' =>'btn btn-primary pull-right']])
            ->add('clear', 'reset', ['label' => 'Clear form', 'attr' => ['class' =>'btn btn-default']]);
    }
}

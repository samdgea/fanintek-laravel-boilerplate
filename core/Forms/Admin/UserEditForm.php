<?php

namespace Fanintek\Fantasena\Forms\Admin;

use Kris\LaravelFormBuilder\Field;
use Kris\LaravelFormBuilder\Form;

use Spatie\Permission\Models\Role;

class UserEditForm extends Form
{
    public function buildForm()
    {
        $roles = [];
        foreach(Role::all()->toArray() as $role) {
            $roles[$role['name']] = $role['name'];
        }

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
                'attr' => ['placeholder' => 'john.doe@example.com', 'readonly'],
                'rules' => 'email'
            ])
            ->add('is_active', Field::SELECT, [
                'choices' => ['0' => 'Non-Active', '1' => 'Active'],
                'empty_value' => '=== Select Status User ===',
                'rules' => 'required'
            ])
            ->add('assign_role', Field::SELECT, [
                'choices' => $roles,
                'selected' => $this->getModel()->roles->first()->name,
                'rules' => 'required'
            ])
            ->add('submit', 'submit', ['label' => 'Save changes', 'attr' => ['class' =>'btn btn-primary pull-right']]);
    }
}

<?php

namespace Fanintek\Fantasena\Forms\Admin;

use Kris\LaravelFormBuilder\Field;
use Kris\LaravelFormBuilder\Form;

class UserChangePassword extends Form
{
    public function buildForm()
    {
        $this
        ->add('password', Field::PASSWORD, [
            'attr' => ['placeholder' => '******'],
            'rules' => 'required|string|min:6|max:50|confirmed'
        ])
        ->add('password_confirmation', Field::PASSWORD, [
            'label' => 'Re-type Password',
            'attr' => ['placeholder' => '******'],
            // 'rules' => 'required|string|min:6|max:50'
        ])
            ->add('submit', 'submit', ['label' => 'Change user password', 'attr' => ['class' =>'btn btn-primary pull-right']]);
    }
}

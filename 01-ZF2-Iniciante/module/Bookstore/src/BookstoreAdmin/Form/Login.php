<?php

namespace BookstoreAdmin\Form;

use Zend\Form\Form;

class Login extends Form
{
    public function __construct($name = null)
    {
        parent::__construct('user');

        $this->setAttribute('method', 'POST')
            ->setAttributes([
                'class'=> 'form-horizontal',
            ]);
        $this->setInputFilter(new LoginFilter());

        $this->add([
            'name' => 'email',
            'options' => [
                'type' => 'email',
                'label' => 'E-mail: ',
                'label_attributes' => [
                    'class'  => 'control-label'
                ],
            ],
            'attributes' => [
                'id' => 'email',
                'placeholder' => 'Digite seu E-mail',
                'class' => 'form-control'
            ]
        ]);

        $this->add([
            'name' => 'password',
            'options' => [
                'type' => 'password',
                'label' => 'Senha: ',
                'label_attributes' => [
                    'class'  => 'control-label',
                    'type' => 'password',
                ],
            ],
            'attributes' => [
                'id' => 'password',
                'placeholder' => 'Digite sua Senha',
                'class' => 'form-control'
            ]
        ]);

        $this->add([
            'name' => 'submit',
            'type' => 'Zend\Form\Element\Submit',
            'attributes' => [
                'value' => 'Login',
                'class' => 'btn alert-success'
            ]
        ]);
    }
}
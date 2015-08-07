<?php

namespace User\Form;

use Zend\Form\Form;

class Login extends Form
{
    public function __construct($name = null, $options = [])
    {
        parent::__construct('login', $options );

        $this->setInputFilter(new LoginFilter());

        $this->setAttribute('method', 'POST')
            ->setAttributes([
                'class'=> 'form-horizontal',
            ]);


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
                'class' => 'form-control',
                'placeholder' => 'Digite sua Senha',
            ]
        ]);

        $this->add([
            'name' => 'submit',
            'type' => 'Zend\Form\Element\Submit',
            'attributes' => [
                'value' => 'Salvar',
                'class' => 'btn alert-success'
            ]
        ]);

    }

}
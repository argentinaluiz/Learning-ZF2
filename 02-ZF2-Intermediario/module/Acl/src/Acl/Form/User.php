<?php

namespace User\Form;

use Zend\Form\Element\Csrf;
use Zend\Form\Element\Hidden;
use Zend\Form\Element\Password;
use Zend\Form\Element\Submit;
use Zend\Form\Element\Text;
use Zend\Form\Form;

class User extends Form
{
    public function __construct($name = null, $options = [])
    {
        parent::__construct('user', $options );

        $this->setInputFilter(new UserFilter());

        $this->setAttribute('method', 'POST')
            ->setAttributes([
                'class'=> 'form-horizontal',
            ]);

        $this->add([
            'name' => 'id',
            'attributes' => [
                'type' => 'hidden'
            ]
        ]);

        $this->add([
            'name' => 'name',
            'options' => [
                'type' => 'text',
                'label' => 'Nome: ',
                'label_attributes' => [
                    'class'  => 'control-label'
                ],
            ],
            'attributes' => [
                'id' => 'name',
                'placeholder' => 'Digite seu Usuário',
                'class' => 'form-control'
            ]
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
            'name' => 'confirmation',
            'options' => [
                'type' => 'password',
                'label' => 'Redigite a Senha: ',
                'label_attributes' => [
                    'class'  => 'control-label',
                    'type' => 'password',
                ],
            ],
            'attributes' => [
                'id' => 'password',
                'class' => 'form-control',
                'placeholder' => 'Redigite sua Senha',
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
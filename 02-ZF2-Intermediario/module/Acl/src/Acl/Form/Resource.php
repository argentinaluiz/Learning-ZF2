<?php

namespace Acl\Form;

use Zend\Form\Form;

class Resource extends Form
{
    public function __construct($name = null)
    {
        parent::__construct('resources' );

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
            'name' => 'submit',
            'type' => 'Zend\Form\Element\Submit',
            'attributes' => [
                'value' => 'Salvar',
                'class' => 'btn alert-success'
            ]
        ]);

    }

}
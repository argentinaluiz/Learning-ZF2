<?php

namespace User\Form;

use Zend\Form\Element\Csrf;
use Zend\Form\Element\Hidden;
use Zend\Form\Element\Password;
use Zend\Form\Element\Submit;
use Zend\Form\Element\Text;
use Zend\Form\Form;

class User
{
    public function __construct($name = null, $options = [])
    {
        parent::__construct('user', $options );

        $this->setInputFilter(new UserFilter());

        $this->setAttribute('method', 'post');

        $id = new Hidden('id');
        $this->add($id);

        $name = new Text('name');
        $name->setLabel('Nome: ')
            ->setAttribute('placeholder', 'Digite seu Nome' );
        $this->add($name);

        $email = new Text('email');
        $email->setLabel('E-mail: ')
            ->setAttribute('placeholder', 'Digite seu Email' );
        $this->add($email);

        $password = new Password('password');
        $password->setLabel('Senha: ')
            ->setAttribute('placeholder', 'Digite sua Senha' );
        $this->add($password);

        $confirmation = new Password('confirmation');
        $confirmation->setLabel('Redigite: ')
            ->setAttribute('placeholder', 'Redigite a Senha' );
        $this->add($confirmation);

        $csrf = new Csrf('security');
        $this->add($csrf);

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
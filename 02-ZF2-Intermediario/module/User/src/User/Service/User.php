<?php

namespace User\Service;

use Bookstore\Service\AbstractService;
use Doctrine\ORM\EntityManager;

use Zend\Stdlib\Hydrator;
use Zend\Mail\Transport\Smtp as SmtpTransport;

use Base\Mail\Mail;

class User extends AbstractService
{
    protected $transport;

    protected $view;

    /**
     * User constructor.
     * @param $transport
     */
    public function __construct(EntityManager $em,SmtpTransport $transport, $view)
    {
        parent::__construct($em);

        $this->em = 'Use\Entity\User';
        $this->transport = $transport;
        $this->view = $view;
    }

    /**
     * Insert User and Send Email
     *
     * @param array $data
     * @return mixed
     */
    public function insert(array $data)
    {
        $entity = parent::insert($data);

        $dataEmail = ['name' => $data['name'], 'activationkey' => $entity->getActivationKey()];

        if ($entity) {
            $mail = new Mail($this->transport, $this->view, 'add-user');
            $mail->setSubject('Confirmação de Cadastro')
                ->setTo($data['email'])
                ->setData($dataEmail)
                ->prepare()
                ->send();

            return $entity;
        }
    }
}

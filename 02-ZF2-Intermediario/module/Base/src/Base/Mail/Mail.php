<?php

namespace Base\Mail;

use Zend\Mail\Message;
use Zend\Mail\Transport\SmtpOptions as SmtpTransport;
use Zend\View\Model\ViewModel;

use Zend\Mime\Message as MimeMessage;
use Zend\Mime\Part  as MimePart;


/**
 * Class Mail
 * @package Base\Mail
 */
class Mail
{
    protected $transport;

    protected $view;

    protected $body;

    protected $message;

    protected $subject;

    protected $to;

    protected $data;

    protected $page;

    /**
     * Construct
     *
     * @param SmtpTransport $transport
     * @param $view
     * @param $page
     */
    public function __construct(SmtpTransport $transport, $view, $page)
    {
        $this->transport = $transport;
        $this->view = $view;
        $this->page = $page;
    }

    /**
     * @param $subject
     * @return $this
     */
    public function setSubject($subject)
    {
        $this->subject = $subject;
        return $this;
    }

    /**
     * @param $to
     * @return $this
     */
    public function setTo($to)
    {
        $this->to = $to;
        return $this;
    }

    /**
     * @param $data
     * @return $this
     */
    public function setData($data)
    {
        $this->data = $data;
        return $this;
    }

    /**
     * Render the View
     *
     * @param $page
     * @param array $data
     * @return mixed
     */
    public function renderView($page, array $data)
    {
        $model = new ViewModel();
        $model->setTemplate("mailer/{$page}.phtml");
        $model->setOptions('has_parent', true);
        $model->setVariables($data);

        return $this->view->render($model);
    }

    /**
     * Prepare Mail
     *
     * @return $this
     */
    public function prepare()
    {
        $html = new MimePart($this->renderView($this->page, $this->data));
        $html->type = 'text/html';

        $body = new MimeMessage($html);
        $body->setParts([$html]);
        $this->body = $body;

        $config = $this->transport->getOptions()->toArray();

        $this->message = new Message();
        $this->message->addFrom($config['connection_config']['from'])
            ->addTo($this->to)
            ->setSubject($this->subject)
            ->setBody($this->$body);

        return $this;
    }

    /**
     * Send Mail
     */
    public function send()
    {
        $this->transport->send($this->message);
    }
}

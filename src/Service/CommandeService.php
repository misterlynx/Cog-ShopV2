<?php

namespace App\Service;

use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Validator\Constraints\IsFalse;

use Symfony\Bridge\Twig\Mime\TemplatedEmail;


class CommandeService{

    private $mailer;

    public function __construct(
        MailerInterface $mailer
    ) {
        $this->mailer = $mailer;
        $this->mon_email = 'alexandrehainy12@gmail.com';
        $this->data = array (
            'from' => false,
            'to' => false,
            'replyTo'=> false,
            'subject' => false,
            'template' => false,
            'context' => false,
        );
    }

    public function send($data){

        $data = array_merge($this->data, $data);
        if(!$data['from']) {$data ['from'] = $_ENV['MY_EMAIL'] ; }
        if(!$data['to']) {$data ['to'] = $_ENV['MY_EMAIL'] ; }
        if(!$data['replyTo']) {$data ['replyTo'] = $data['from'] ; }

        if($_ENV['APP_ENV'] == 'dev') { $data['to'] = $_ENV['MY_EMAIL'] ; }
        // dump($data); die;

        $email = ( new TemplatedEmail() )
        ->from($data['from'])
        ->to($data['to'])
        ->replyTo($data['replyTo'])
        ->subject($data['subject'])
        ->htmlTemplate($data['template'])
        ->context($data['context']);

        // dump($email); die;
        $this->mailer->send($email);
    }

    public function ValidCommande()
    {
        $data = array(
            'from' => 'alexandrehainy12@gmail.com',
            'subject' => 'Validation de votre commande !',
            'template' => 'emails/validcommande.html.twig',
            'context' =>array(
                
            ) 
         );
 
        
         $this->send($data);
     }
}
<?php

namespace App\Service;

use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Validator\Constraints\IsFalse;

use Symfony\Bridge\Twig\Mime\TemplatedEmail;


class EmailService{

    private $mailer;

    public function __construct(
        MailerInterface $mailer
    ) {
        $this->mailer = $mailer;
        $this->mon_email = 'demo.wf3.victor@gmail.com';
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


    

    public function contact_pro($nom, $prenom, $societe, $sujet, $email, $message){


        $mail = ( new Email() )
        ->from($email)
        ->to($this->mon_email)
        ->replyTo($email)
        ->subject( '[KARLA]' )
        
        ->text($message);

        $this->mailer->send($mail);



        
        $replyEmail = (new Email())
        ->from($this->mon_email)
        ->to($email)
        // ->replyTo($email)
        ->subject('Reply')
        
        ->text('Le mail etait bien recu');

        $this->mailer->send($replyEmail);


    }

    public function contact($contact) {

       $data = array(
           'from' =>$contact->getEmail(),
           'subject' => '[Karla - email du site]',
           'template' => 'emails/contact.email.twig',
           'context' =>array(
               'contact' => $contact
           ) 
        );

       
        $this->send($data);
    }


    public function register($user){
        $data = array(
            'to' =>$user->getEmail(),
            'subject' =>"Confirmez votre inscription",
            'template' =>'emails/security/register.email.twig',
            'context' => ['user' => $user]
        );
        $this->send($data);
    }

    public function password_forgotten($user, $link){
        $data = array(
            'to' =>$user->getEmail(),
            'subject' =>"Modifier votre mot de passe",
            'template' =>'emails/security/password_forgotten.email.twig',
            'context' => ['user' => $user, 'link' => $link]
        );
        $this->send($data);
    }
}
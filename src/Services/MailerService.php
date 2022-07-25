<?php

namespace App\Services;


use Faker\Calculator\Ean;
use Symfony\component\Mailer\MailerInterface;
use Symfony\component\Mime\Email;
use Twig\Environment;
use App\Services\Charset;

class MailerService
{
    /**
     *
     * @var [MailerInterface]
     */
    private $mailer;

    /**
     *
     * @var [Environment]
     */
    private $twig;

    public function __construct(MailerInterface $mailer, Environment $twig) {
        $this->mailer = $mailer;
        $this->twig = $twig;

    }

    /**
     * Undocumented function
     *
     * @param string $subject = objet de l'email
     * @param string $from = expéditeur du mail
     * @param string $to = destinataire du mail
     * @param string $template  = page twig contenant le mail qui s'envoi
     * @param array $parameters = (nom, prénom , email, ...)
     * @return void
     */
    public function send(string $subject, string $from, string $to, string $template, array $parameters)
    {
        //On fait de Email un objet
        $email = (new Email())
                ->from($from)
                ->to($to)
                ->subject($subject)
                //On envoi au template
                ->html( $this->twig->render($template, $parameters),'text/html');
        //On envoi l' Email        
        $this->mailer->send($email);
    }

}
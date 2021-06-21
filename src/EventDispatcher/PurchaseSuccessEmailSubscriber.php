<?php

namespace App\EventDispatcher;

use App\Entity\User;
use Psr\Log\LoggerInterface;
use App\Event\PurchaseSuccessEvent;
use Symfony\Component\Mime\Address;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class PurchaseSuccessEmailSubscriber implements EventSubscriberInterface
{
    protected $logger;
    protected $mailer;
    protected $security;  
    
    public function __construct(LoggerInterface $logger, MailerInterface $mailer, Security $security)
    {
        $this->security = $security;
        $this->mailer = $mailer;
        $this->logger = $logger;
    }
    public static function getSubscribedEvents()
    {
        return[
            'purchase.success' => 'sendSuccessEmail'
        ];
    }
    public function sendSuccessEmail( PurchaseSuccessEvent $purchaseSuccessEvent)
    {
        // 1. Récupérer l'utilisateur actuellement en ligne (Pour connaitre sont adresse mail) Security
        /** @var User */
        $currentUser = $this->security->getUser();

        // 2. Récupérer la commande (PurchaseSuccessEvent)
        $purchase = $purchaseSuccessEvent->getPurchase();
        // 3. Ecrire le mail (New TemplatedEmail)
        $email = new TemplatedEmail();

        $email
            ->from("contact@mail.com")
            ->to(new Address($currentUser->getEmail() , $currentUser->getFullName()))
            ->htmlTemplate('email/purchase_success.html.twig')
            ->subject("Bravo, Votre commande n°({$purchase->getId()}) a bien été confirmer" )
            ->context([
                'purchase' => $purchase,
                'user' => $currentUser
            ]);

        


        // 4. Envoyer le mail (MailerInterface)
        $this->mailer->send($email);
        
        $this->logger->info("Email envoyé pour la commande n°". $purchaseSuccessEvent->getPurchase()->getId());
    }
}
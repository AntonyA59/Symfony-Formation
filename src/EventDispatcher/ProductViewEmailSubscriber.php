<?php

namespace App\EventDispatcher;

use App\Event\ProductViewEvent;
use Psr\Log\LoggerInterface;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Address;
use Symfony\Component\Mime\Email;

class ProductViewEmailSubscriber implements EventSubscriberInterface
{
    protected $logger;
    protected $mailer;

    public function __construct(LoggerInterface $logger, MailerInterface $mailer)
    {
        $this->logger = $logger;
        $this->mailer = $mailer;
    }
    public static function getSubscribedEvents()
    {
        return [
            'product.view' => 'sendViewEmail'
        ];
    }

    // public function sendViewEmail(ProductViewEvent $productViewEvent)
    // {
        // $email = new TemplatedEmail();

        // $email
        //     ->from(new Address("contact@mail.com", "Infos de la boutique"))
        //     ->to("admin@mail.com")
        //     ->text("Un visiteur est en train de voir la page du produit n° " . $productViewEvent->getProduct()->getId() . " qui porte le nom de " . $productViewEvent->getProduct()->getName())
        //     ->htmlTemplate('email/product_view.html.twig')
        //     ->context([
        //         'product' => $productViewEvent->getProduct()
        //     ])
        //     ->subject("Visite du produit n° " . $productViewEvent->getProduct()->getId());

        // $this->mailer->send($email);
        // $this->logger->info("Email envoyé pour la visite du produit n° " . $productViewEvent->getProduct()->getId() . " et qui porte le nom " . $productViewEvent->getProduct()->getName());
    // }
}
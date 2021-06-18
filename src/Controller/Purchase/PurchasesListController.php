<?php
namespace App\Controller\Purchase;


use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class PurchasesListController extends AbstractController
{   

    /** 
     * @Route("/purchases", name="purchase_index")
     * @IsGranted("ROLE_USER", message="Vous devez être connecté pour accéder a vos commandes")
    */
    public function index()
    {
        // 1. Nous devons nous assurer que la personne est connectée (sinon page d'accueil) -> Security
        /** @var User */
        $user = $this->getUser();

        // 2. Nous voulons savoir QUI est connecté -> Security

        // 3. Nous voulons passer l'utilisateur connecté à TWIG afin d'afficher ses commandes ->Environment de TWIG
        return $this->render('purchase/index.html.twig', [
            'purchases'=> $user->getPurchases()
        ]);

    }
}
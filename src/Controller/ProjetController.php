<?php
namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ProjetController extends AbstractController {
    #[Route('/', name: 'accueil')]
    public function homepage(): Response
    {
        return $this->render('Accueil/accueil.html.twig',[
            'h1' => "Mes Projets, page d'accueil",
        ]);
    }

    #[Route('/contact', name: 'contact')]
    public function contactPage(): Response
    {
        return $this->render('Contact/contact.html.twig',[
            'h1' => "Contact",
        ]);
    }

    #[Route('/projets', name: 'projets')]
    public function projetPage(): Response
    {
        $projets = ['Agence Spatiale','Avenant','Mes Oeuvres','Pretooty'];
        return $this->render('Projets/projets.html.twig',[
            'h1' => "Projets",
            'Liste' => $projets,
        ]);
    }
}
<?php
namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Form\ContactType;

class ProjetController extends AbstractController {
    #[Route('/', name: 'accueil')]
    public function homepage(): Response
    {
        return $this->render('Accueil/accueil.html.twig',[
            'h1' => "Mes Projets, page d'accueil",
        ]);
    }

    #[Route('/contact', name: 'contact')]
    public function contactPage(Request $request): Response
    {
        $form = $this->createForm(ContactType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // data is an array with "name", "eamil" and "message" keys
            $data = $form->getData();
            dump($data);
            return $this->redirectToRoute('accueil');
        }

        return $this->render('Contact/contact.html.twig',[
            'h1' => "Contact",
            'form' => $form,
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
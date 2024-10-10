<?php
namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Form\ContactType;
use Symfony\Bundle\SecurityBundle\DependencyInjection\Security\Factory\FormLoginFactory;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;

class PageController extends AbstractController {
    #[Route('/', name: 'accueil')]
    public function homepage(): Response
    {
        return $this->render('Accueil/accueil.html.twig',[
            'h1' => "Mes Projets, page d'accueil",
        ]);
    }

    #[Route('/contact', name: 'contact')]
    public function contactPage(Request $request, MailerInterface $mailer): Response
    {
        $form = $this->createForm(ContactType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // data is an array with "name", "email" and "message" keys
            $data = $form->getData();
            $userEmail = $data['email'];
            $userMessage = $data['message'];

            $email = (new Email())
                ->from($userEmail)
                ->to('ange.elodie@gmail.com')
                ->subject('Nouveau contact de "Mes Projets".')
                ->html('<p>'. htmlspecialchars($userMessage).' </p>')
                ->text($userMessage)    
            ;
            $mailer->send($email);

            $this->addFlash('success', 'Votre message a été envoyé avec succès.');
            return $this->redirectToRoute('contact');
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

    #[Route('/login', name: 'login')]
    public function loginPage(): Response
    {       
        return $this->render('login/login.html.twig',[
            
        ]);
    }
}
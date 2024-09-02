<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use App\Form\ContactType;

class ContactController extends AbstractController
{
    #[Route('/contact', name: 'contact')]
    public function contact(Request $request, MailerInterface $mailer): Response
    {
        $form = $this->createForm(ContactType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
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

        return $this->render('contact/contact.html.twig',[
            'form' => $form->createView(),
        ]);
    }
}
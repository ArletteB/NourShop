<?php

namespace App\Controller;

use App\Form\ContactType;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(): Response
    {
        return $this->render('home/index.html.twig');
    }

    /**
     * @Route("/tailleur", name="home_tailleur")
     */
     public function tailleur(): Response {
         return $this->render('home/tailleur.html.twig');
     }


     /**
     * @Route("/qui-sommes-nous", name="home_about")
     */
    public function about(): Response {
        return $this->render('home/about.html.twig');
    }

     /**
     * @Route("/contact", name="home_contact")
     */
    public function contact(Request $request, MailerInterface $mailer): Response {
        $form = $this->createForm(ContactType::class);

        $contact = $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $email = (new TemplatedEmail())
            ->from($contact->get('email')->getData())
            ->to('nourshop241@nour.com')
            ->subject('Information sur les tissus')
            ->htmlTemplate('emails/contact.html.twig')
            ->context([
                'name' => $contact->get('name')->getData(),
                'lastname' => $contact->get('lastname')->getData(),
                'phone' => $contact->get('phone')->getData(),
                'mail' => $contact->get('email')->getData(),
                'message' => $contact->get('message')->getData(),
            ]);

            $mailer->send($email);
            $this->addFlash('success', 'Votre message a bien été envoyé');
            return $this->redirectToRoute('home_contact');
        }
        return $this->render('home/contact.html.twig', [
            'form' => $form->createView()
        ]);
    }
}

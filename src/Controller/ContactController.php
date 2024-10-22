<?php
namespace App\Controller;

use App\Entity\Contact;
use App\Repository\ContactRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ContactController extends AbstractController
{
    #[Route("/contact", name: "contact")]
    function contact()
    {
        return $this->render('contact.html.twig');
    }

    #[Route("/processForm", name: "processForm", methods: ["POST"])]
    function processForm(Request $req, ContactRepository $repository)
    {
        $nom = $req->request->get("nom");
        $email = $req->request->get("email");
        $message = $req->request->get("message");
        $message;

        if(!isset($nom) || empty($nom) || !isset($email) || empty($email) || !isset($message) || empty($message))
        {
            $message = "Données Obligatoires";
            return $this->render('contact.html.twig', ["message" => $message]);
        }

        if(!filter_var($email, FILTER_VALIDATE_EMAIL))
        {
            $message = "Pas le bon format d'email";
            return $this->render('contact.html.twig', ["message" => $message]);
        }

        $nouveauMessage = new Contact();
        $nouveauMessage->setNom($nom)->setEmail($email)->setMessage($message);

        $repository->sauvegarder($nouveauMessage, true);
        $message = "Message envoyée";
        return $this->render('contact.html.twig', ["message" => $message]);
    }
}
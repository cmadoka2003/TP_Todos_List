<?php

namespace App\Controller;

use App\Entity\Note;
use App\Form\MatieresForm;
use App\Repository\NoteRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class NotesController extends AbstractController
{
    #[Route("/notes", name: "notes")]
    function accueil(Request $req, NoteRepository $repo): Response
    {
        $note = new Note();
        $formulaire = $this->createForm(MatieresForm::class, $note);

        $formulaire->handleRequest($req);
        if ($formulaire->isSubmitted() && $formulaire->isValid()) {
            $repo->sauvegarder($note, true);
        }

        return $this->render('notes.html.twig', ["formulaire" => $formulaire->createView()]);
    }
}
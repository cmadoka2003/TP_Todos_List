<?php
namespace App\Controller;

use App\Entity\User;
use App\Form\InscriptionForm;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{
    #[Route('/inscription', name: 'inscription')]
    public function inscription(Request $req, UserRepository $repo)
    {
        $user = new User();

        $formulaire = $this->createForm(InscriptionForm::class, $user);

        $formulaire->handleRequest($req);

        if($formulaire->isSubmitted() && $formulaire->isValid())
        {
            $repo->sauvegarder($user, true);
            return $this->redirectToRoute('accueil');
        }

        return $this->render('user.html.twig', ['formulaire' => $formulaire->createView()]);
    }

}

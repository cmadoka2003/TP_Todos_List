<?php
namespace App\Controller;

use App\Entity\User;
use App\Form\InscriptionForm;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{
    #[Route('/inscription', name: 'inscription')]
    public function inscription(Request $req, UserRepository $repo, UserPasswordHasherInterface $hash)
    {
        // creation d'un objet user
        $user = new User();

        // remplir la class user avec les données remplis du formulaire
        $formulaire = $this->createForm(InscriptionForm::class, $user);

        // Iriguer les formulaire avec les données de la requête
        $formulaire->handleRequest($req);

        // verifier que le formulaire est fournis et validé
        if($formulaire->isSubmitted() && $formulaire->isValid())
        {
            // hasher le password
            $passwordhash = $hash->hashPassword($user, $user->getPassword());

            // mettre à jour le password
            $user->setPassword($passwordhash);

            // envoyer les données dans la BDD
            $repo->sauvegarder($user, true);

            // rediriger dans la page accueil
            return $this->redirectToRoute('connexion');
        }

        return $this->render('user.html.twig', ['formulaire' => $formulaire->createView()]);
    }

    #[Route('/connexion', name: 'connexion')]
    function connexion()
    {
        $connexionForm = $this->createForm(InscriptionForm::class);
        return $this->render('connexion.html.twig', ["connexionForm" => $connexionForm]);
    }

    #[Route('/profil', name: 'profil')]
    function profil()
    {
        return $this->render('profil.html.twig');
    }

    #[Route('/logout', name: 'logout')]
    function logout()
    {
        return $this->redirectToRoute('connexion');
    }

}

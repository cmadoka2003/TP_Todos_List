<?php
namespace App\Controller;

use App\Entity\Taches;
use App\Entity\TodosList;
use App\Repository\TachesRepository;
use App\Repository\TodosRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class TodosController extends AbstractController
{
    #[Route("/todosList", name: "todosList")]
    function todosList(TodosRepository $todosRepo)
    {
        $todos = $todosRepo->findAll();
        if(!$todos){
            $message = "aucun todos"; 
            return $this->render('todos.html.twig', ["nombresTodos" => $message]);
        }
        return $this->render('todos.html.twig', ["todos" => $todos]);
    }

    #[Route("/processTodosForm", name: "processTodosForm")]
    function processTodosForm(Request $req, TodosRepository $todosrepository)
    {
        $titre = $req->request->get('titre');
        $taches = $req->request->get('firstTache');

        if(!isset($titre) || empty($titre) || !isset($taches) || empty($taches)){
            $message = "Données Obligatoires!";
            return $this->redirectToRoute('todosList', ["message" => $message]);
        }

        $nouveauTodos = new TodosList();
        $nouveauTodos->setNom($titre)->setDate(date('Y-m-d'));

        $nouvelleTaches = new Taches();
        $nouvelleTaches->setNom($taches);

        $nouveauTodos->addTaches($nouvelleTaches); 

        $todosrepository->sauvegarder($nouveauTodos, true);

        return $this->redirectToRoute('todosList');
    }

    #[Route("/processIsFinished/{id}", name: "processIsFinished")]
    function processIsFinished(TachesRepository $tachesRepository, $id)
    {
        $isFinished = $tachesRepository->find($id);

        $isFinished->setIsFinished(!$isFinished->getIsFinished());

        $tachesRepository->sauvegarder($isFinished, true);

        return $this->redirectToRoute('todosList');
    }

    #[Route("/processAjoutForm/{id}", name: "processAjoutForm")]
    function processAjoutForm($id, TodosRepository $todosRepository, Request $req)
    {
        $tache = $req->request->get("tache");
        
        if(!$tache){
            $message = "Données Obligatoires!";
            return $this->redirectToRoute('todosList', ["message" => $message]);
        }
        $ajout = $todosRepository->find($id);

        $nouvelleTache = new Taches();
        $nouvelleTache->setNom($tache);

        $ajout->addTaches($nouvelleTache); 

        $todosRepository->sauvegarder($ajout, true);

        return $this->redirectToRoute('todosList');
    }

    #[Route("/delete/{id}", name: "tache.delete")]
    function delete($id, TodosRepository $todosRepository)
    {
        $deleteTodo = $todosRepository->find($id);
        if(!$deleteTodo){
            return $this->redirectToRoute('todosList');
        }
        $todosRepository->supprimer($deleteTodo);
        return $this->redirectToRoute('todosList');
    }
}
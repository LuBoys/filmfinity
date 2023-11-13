<?php

namespace App\Controller\Admin;

use App\Entity\Commentaire;
use App\Entity\Film; // Assurez-vous d'inclure l'entité Film si elle est utilisée
use App\Form\CommentaireType;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
// ... autres utilisations

class CommentaireCrudController extends AbstractCrudController
{
    // ... autres méthodes et configurations de EasyAdmin
    public static function getEntityFqcn(): string
    {
        return Commentaire::class;
    }

    public function createCommentaireForFilm(Film $film, Request $request): Response
    {
        $commentaire = new Commentaire();
        $form = $this->createForm(CommentaireType::class, $commentaire);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $commentaire->setUsers($this->getUser());
            $commentaire->setFilms($film);
            $commentaire->setDateCommentaire(new \DateTime());
            // ... (gestion de la modération si nécessaire)

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($commentaire);
            $entityManager->flush();

            // Rediriger ou ajouter un message flash de succès
            // return $this->redirect(...);
            // $this->addFlash('success', 'Commentaire ajouté avec succès!');
        }

        // Récupérer les commentaires du film
        // $commentaires = $film->getCommentaires(); // Si vous avez une relation et une méthode pour cela

        return $this->render('films/detail.html.twig', [
            'film' => $film,
            'form' => $form->createView(),
        ]);
    
    }
    
    // ... le reste de votre contrôleur
}

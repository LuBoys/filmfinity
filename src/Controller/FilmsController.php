<?php

namespace App\Controller;

use App\Entity\Films;
use App\Entity\Commentaire;
use App\Form\CommentaireType;
use App\Repository\FilmsRepository; // Ce use statement est nécessaire pour la recherche
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FilmsController extends AbstractController
{
    #[Route('/film/{id}', name: 'app_film_detail')]
    public function filmDetail(Films $film, Request $request, EntityManagerInterface $entityManager): Response
    {
        if (!$film) {
            throw $this->createNotFoundException('Ce film n\'existe pas.');
        }
    
        // Récupération des commentaires du film
        $commentaires = $film->getCommentaires();
    
      // Calcul de la moyenne des notes
$totalNotes = 0;
foreach ($commentaires as $comment) {
    $totalNotes += $comment->getRating();
}
$moyenneNotes = count($commentaires) > 0 ? round($totalNotes / count($commentaires), 1) : null;

    
        // Vérifier si l'utilisateur connecté a déjà commenté
        $userHasCommented = false;
        $existingComment = null;
        if ($this->getUser()) {
            foreach ($commentaires as $comment) {
                if ($comment->getUsers() === $this->getUser()) {
                    $userHasCommented = true;
                    $existingComment = $comment;
                    break;
                }
            }
        }
    
        $commentaire = new Commentaire();
        if (!$userHasCommented) {
            // Assigner le film et l'utilisateur actuel au commentaire si nécessaire
            $commentaire->setFilms($film); // Assurez-vous que votre entité Commentaire a une propriété pour le film
            $commentaire->setUsers($this->getUser()); // Assurez-vous que votre entité Commentaire a une propriété pour l'utilisateur
    
            // Créer le formulaire
            $form = $this->createForm(CommentaireType::class, $commentaire);
    
            // Gérer la requête
            $form->handleRequest($request);
    
            if ($form->isSubmitted() && $form->isValid()) {
                // Persist the new comment
                $entityManager->persist($commentaire);
                $entityManager->flush();
    
                // Rediriger l'utilisateur ou ajouter un message flash si nécessaire
                $this->addFlash('success', 'Commentaire ajouté avec succès!');
                return $this->redirectToRoute('app_film_detail', ['id' => $film->getId()]);
            }
        }
    
       // Passer la vue du formulaire (seulement si pas encore commenté), les commentaires, et la moyenne des notes au template
return $this->render('films/detail.html.twig', [
    'film' => $film,
    'form' => $userHasCommented ? null : $form->createView(),
    'commentaires' => $commentaires,
    'moyenne_notes' => $moyenneNotes, // Ici la moyenne des notes est déjà arrondie
    'userHasCommented' => $userHasCommented,
    'existingComment' => $existingComment,
]);
}
#[Route('/', name: 'app_home')]
public function index(FilmsRepository $filmsRepository): Response
{
    // Récupérer les films triés par date de sortie la plus récente
    $filmsSortedByReleaseDate = $filmsRepository->findBy([], ['date_sortie' => 'DESC'], 5);

    // Récupérer les films triés par note la plus élevée
    // NOTE: Assurez-vous que la méthode findByHighestRating() est définie dans FilmsRepository
    $filmsSortedByRating = $filmsRepository->findByHighestRating();
    $commentaires = $commentaireRepository->findBy([], ['date_commentaire' => 'DESC'], 5);

    return $this->render('homepage/index.html.twig', [
        'controller_name' => 'HomepageController',
        'films' => $films, // Passer les films à votre vue
        'commentaires' => $commentaires, // Passer les commentaires à votre vue
    ]);
    return $this->render('homepage/index.html.twig', [
        'filmsSortedByReleaseDate' => $filmsSortedByReleaseDate,
        'filmsSortedByRating' => $filmsSortedByRating,
    ]);
}
    

    #[Route('/edit-comment/{id}', name: 'app_edit_comment', methods: ['GET', 'POST'])]
    public function editComment(Commentaire $commentaire, Request $request, EntityManagerInterface $entityManager): Response
    {
        if (!$commentaire || $commentaire->getUsers() !== $this->getUser()) {
            throw $this->createAccessDeniedException('Vous n\'avez pas le droit de modifier ce commentaire.');
        }

        $form = $this->createForm(CommentaireType::class, $commentaire);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();
            $this->addFlash('success', 'Votre commentaire a été mis à jour.');

            return $this->redirectToRoute('app_film_detail', ['id' => $commentaire->getFilms()->getId()]);
        }

        return $this->render('films/edit_comment.html.twig', [
            'commentForm' => $form->createView(),
        ]);
    } // Cette accolade fermante est correcte pour terminer la méthode editComment

    #[Route('/recherche/films', name: 'recherche_film')]
    public function search(Request $request, FilmsRepository $filmsRepository): Response
    {
        $searchTerm = $request->query->get('recherche');
        $films = $filmsRepository->findBy(['name' => $searchTerm]);

        return $this->render('films/recherche_film.html.twig', [
            'films' => $films,
        ]);
    } // Cette accolade fermante est correcte pour terminer la méthode search

    // ... Ajoutez ici d'autres méthodes de votre contrôleur si nécessaire ...
    
}

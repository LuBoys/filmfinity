<?php

namespace App\Controller;

use App\Entity\Commentaire;
use App\Repository\FilmsRepository;
use App\Repository\CommentaireRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomepageController extends AbstractController
{
    #[Route('/', name: 'app_homepage')]
    public function index(FilmsRepository $filmsRepository, CommentaireRepository $commentaireRepository): Response
    {
        // Récupérer les 5 derniers films
        $films = $filmsRepository->findBy([], ['date_sortie' => 'DESC'], 5);

        // Récupérer les 5 derniers commentaires
        $commentaires = $commentaireRepository->findBy([], ['date_commentaire' => 'DESC'], 5);

        return $this->render('homepage/index.html.twig', [
            'controller_name' => 'HomepageController',
            'films' => $films, // Passer les films à votre vue
            'commentaires' => $commentaires, // Passer les commentaires à votre vue
        ]);
    }
}

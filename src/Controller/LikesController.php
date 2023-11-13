<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use App\Entity\Films;
use App\Entity\LikesFilms;
use App\Repository\LikesFilmsRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Routing\Annotation\Route;

class LikesController extends AbstractController
{
    #[Route('/likes', name: 'app_likes')]
    public function index(): Response
    {
        return $this->render('likes/index.html.twig', [
            'controller_name' => 'LikesController',
        ]);
    }

    /**
     * @Route("/film/{id}/like", name="film_like")
     */
    public function like(Films $film, EntityManagerInterface $em, LikesFilmsRepository $likesFilmsRepository): Response {
        $user = $this->getUser();

        if (!$user) return $this->json(['message' => 'Unauthorized'], 403);

        // Assurez-vous d'avoir une méthode isLikedByUser dans l'entité Films
        if ($film->isLikedByUser($user)) {
            // Supprimer le like
            $like = $likesFilmsRepository->findOneBy(['film' => $film, 'user' => $user]);
            $em->remove($like);
            $em->flush();

            return $this->json(['likes' => $film->getLikesFilms()->count()], 200);
        }

        // Ajouter le like
        $like = new LikesFilms();
        $like->setFilm($film)
             ->setUser($user);
        $em->persist($like);
        $em->flush();

        return $this->json(['likes' => $film->getLikesFilms()->count()], 200);
    }
}

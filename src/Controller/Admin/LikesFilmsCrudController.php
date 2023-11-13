<?php

namespace App\Controller\Admin;

use App\Entity\LikesFilms;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use App\Form\RatingType;
use App\OtherNamespace\LikesFilms as OtherLikesFilms;

class LikesFilmsCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return LikesFilms::class;
    }


public function show($id, Request $request, EntityManagerInterface $em)
{
// Supposons que $id contient l'identifiant du film que vous souhaitez récupérer
$film = $entityManager->getRepository(Film::class)->find($id);
    $rating = new LikesFilms();
    $form = $this->createForm(RatingType::class, $rating);

    $form->handleRequest($request);
    if ($form->isSubmitted() && $form->isValid()) {
        $rating->setFilm($film);
        $rating->setUser($this->getUser()); // Assurez-vous que l'utilisateur est connecté
        $em->persist($rating);
        $em->flush();

        // Ajoutez une confirmation ou redirigez selon vos besoins
    }

    // ... return de la vue avec le formulaire ...
}
    /*
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            TextField::new('title'),
            TextEditorField::new('description'),
        ];
    }
    */
}

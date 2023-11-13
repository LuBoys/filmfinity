<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Form\UserProfileType;



class ProfileController extends AbstractController
{
    #[Route('/profile', name: 'app_profile')]
    /**
 * @Route("/profile/edit", name="profile_edit")
 */
public function edit(Request $request): Response
{
    $user = $this->getUser(); // Récupérer l'utilisateur actuellement connecté

    $form = $this->createForm(UserProfileType::class, $user);
    $form->handleRequest($request);

    // Dans votre méthode de contrôleur
    if ($form->isSubmitted() && $form->isValid()) {
    // Hasher le mot de passe
    $hashedPassword = $passwordEncoder->encodePassword($user, $user->getPassword());
    $user->setPassword($hashedPassword);

    // ... Sauvegardez les modifications dans la base de données

    return $this->redirectToRoute('profile_view'); // rediriger vers la page de vue du profil
}


    return $this->render('profile/index.html.twig', [
        'form' => $form->createView(),
    ]);
}

}

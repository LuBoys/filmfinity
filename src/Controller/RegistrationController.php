<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use App\Entity\Users;
use App\Form\RegistrationFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Http\Authentication\UserAuthenticatorInterface;
use App\Security\YourAuthenticator; // Remplacez par le chemin de votre propre authenticator

class RegistrationController extends AbstractController 
{
    #[Route('/register', name: 'app_register')]
    public function register(
        Request $request, 
        UserPasswordHasherInterface $passwordHasher, 
        EntityManagerInterface $entityManager,
        UserAuthenticatorInterface $userAuthenticator,
        YourAuthenticator $authenticator // Remplacez par le service d'authentification que vous utilisez
    ): Response {
        $user = new Users();
        $form = $this->createForm(RegistrationFormType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // hash the plain password
            $user->setPassword(
                $passwordHasher->hashPassword(
                    $user,
                    $form->get('plainPassword')->getData()
                )
            );
            
            $entityManager->persist($user);
            $entityManager->flush();
            
            // Authenticate the user
            $userAuthenticator->authenticateUser(
                $user, 
                $authenticator,
                $request // Pass the current request
            );

            // Redirect to the homepage after successful registration and login
            return $this->redirectToRoute('app_homepage');
        }

        return $this->render('registration/register.html.twig', [
            'registrationForm' => $form->createView(),
        ]);
    }
}

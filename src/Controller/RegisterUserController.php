<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\User;
use App\Form\RegistrationFormType;
use App\Form\UserType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class RegisterUserController extends AbstractController
{
    /** @var EntityManagerInterface*/
    public $entityManagerInterface;

    /**
     * @param EntityManagerInterface $entityManagerInterface
     */
    public function __construct(EntityManagerInterface $entityManagerInterface)
    {
        $this->entityManagerInterface = $entityManagerInterface;
    }

    /**
     * @param Request $request
     * @param UserPasswordHasherInterface $encoder
     * @return Response
     */
    #[Route('/register/user', name: 'app_register_user')]
    public function registerUser(Request $request, UserPasswordHasherInterface $encoder): Response
    {
        $user = new User();
        
        $form = $this->createForm(
            RegistrationFormType::class,
            $user,
        );
        $form->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()) {
            $encoded = $encoder->hashPassword($user, $user->getPassword());
            $user->setPassword($encoded);
            $this->entityManagerInterface->persist($user);
            $this->entityManagerInterface->flush();

            return $this->redirectToRoute('home');
        }

        return $this->render('register_user/index.html.twig', [
            'controller_name' => 'RegisterUserController',
            'form' => $form->createView(),
        ]);
    }
}

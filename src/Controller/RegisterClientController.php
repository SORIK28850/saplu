<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Client;
use Symfony\Component\HttpFoundation\Request;
use App\Form\ClientType;

class RegisterClientController extends AbstractController
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
     * @return Reponse
     */
    #[Route('/register/client', name: 'app_register_client')]
    public function registerClient(Request $request): Response
    {
        $client = new Client();
        
        $form = $this->createForm(
            ClientType::class,
            $client,
            [
                'method' => 'POST',
                'empty_data' =>
                [
                    'submitContent' => 'Registrar usuario'
                ]
            ]
        );
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->entityManagerInterface->persist($client);
            $this->entityManagerInterface->flush();
            
            return $this->redirectToRoute('home');
        }

        return $this->render('register_client/index.html.twig', [
            'controller_name' => 'RegisterClientController',
            'form' => $form->createView(),
        ]);
    }
}

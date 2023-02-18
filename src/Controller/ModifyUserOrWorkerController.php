<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\ClientRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use App\Form\QueryClientType;
use App\Form\QueryWorkerType;
use App\Entity\Client;
use App\Form\ClientType;
use App\Entity\User;
use App\Form\UserType;

class ModifyUserOrWorkerController extends AbstractController
{
    /** @var EntityManagerInterface*/
    protected $entityManagerInterface;

    /** @var ClientRepository*/
    protected $clientRepository;

    /** @var UserRepository*/
    protected $userRepository;

    /** @var ClientsAndUsersUtil */
    protected $clientsAndUsersUtil;


   /**
     * @param EntityManagerInterface $entityManagerInterface
     * @param ClientRepository $clientRepository
     * @param UserRepository $userRepository
     * @param ClientsAndUsersUtil $clientsAndUsersUtil
     */
    public function __construct(
        EntityManagerInterface $entityManagerInterface,
        ClientRepository $clientRepository,
        UserRepository $userRepository,
        )
    {
        $this->entityManagerInterface = $entityManagerInterface;
        $this->clientRepository = $clientRepository;
        $this->userRepository = $userRepository;
        $this->clientsAndUsersUtil = new ClientsAndUsersUtil($this->clientRepository, $this->userRepository);
    }

    /**
     * @param Request $request
     * @return Response
     */
    #[Route('/modify/user/or/worker', name: 'app_modify_user_or_worker')]
    public function index(Request $request): Response
    {
        $usuarios = $this->clientsAndUsersUtil->getDistinctClients();
        $workers = $this->clientsAndUsersUtil->getDistinctWorkers();
       
        $formUsers = $this->createForm(
            QueryClientType::class,
            null,
            [
                'method' => 'POST',
                'empty_data' =>
                [
                    'usuarios' => $usuarios,
                    'submitContent' => 'Modificar usuario'
                ]
            ]
        );
        $formUsers->handleRequest($request);

        $formWorkers = $this->createForm(
            QueryWorkerType::class,
            null,
            [
                'method' => 'POST',
                'empty_data' =>
                [
                    'workers' => $workers,
                    'submitContent' => 'Modificar trabajador'
                ]
            ]
        );
        $formWorkers->handleRequest($request);

        if (
            $formUsers->isSubmitted() && $formUsers->isValid() ||
            $formWorkers->isSubmitted() && $formWorkers->isValid()
            ) {

            $formUserResult = $formUsers->getData();
            $formWorkersResult = $formWorkers->getData();

            return $this->redirectToRoute(
                'app_modify_user_or_worker_form',
                [
                    'client' => $formUserResult['usuario'] ?? null,
                    'worker' => $formWorkersResult['usuario'] ?? null,
                    
                ]
            );

        }

        return $this->render('modify_user_or_worker/index.html.twig', [
            'controller_name' => 'ModifyUserOrWorkerController',
            'formUsers' => $formUsers->createView(),
            'formWorkers' => $formWorkers->createView(),
        ]);
    }
    
    /**
     * @param $userToModify
     * @param $$typeEntity
     * @return Response
     */
    #[Route('/modify/user/or/worker/form', name: 'app_modify_user_or_worker_form')]
    public function modifyUserOrWorker(Request $request): Response
    {

        if ($request->get('client')) {
        
            $form = $this->createForm(
                ClientType::class,
                $this->clientRepository->findOneBy(['name' => $request->get('client')]),
                [
                    'method' => 'POST',
                    'empty_data' =>
                    [
                        'submitContent' => 'Modificar usuario'
                    ]
                ]
            );
            $form->handleRequest($request);

        } else {

            $form = $this->createForm(
                UserType::class,
                $this->userRepository->findOneBy(['name' => $request->get('worker')]),
                [
                    'method' => 'POST',
                    'empty_data' =>
                    [
                        'submitContent' => 'Modificar trabajador'
                    ]
                ]
            );
            $form->handleRequest($request);
        }
        
        if ($form->isSubmitted() && $form->isValid()) {
            $this->entityManagerInterface->flush();

            return $this->redirectToRoute('home');
        }

        return $this->render('modify_user_or_worker/index.html.twig', [
            'controller_name' => 'ModifyUserOrWorkerController',
            'form' => $form->createView(),
        ]);
    }
}

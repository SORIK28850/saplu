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

class DeleteUserOrWorkerController extends AbstractController
{
    /** @var EntityManagerInterface*/
    public $entityManagerInterface;

    /** @var ClientRepository*/
    public $clientRepository;

    /** @var UserRepository*/
    public $userRepository;

    public function __construct(
        EntityManagerInterface $entityManagerInterface,
        ClientRepository $clientRepository,
        UserRepository $userRepository
        )
    {
        $this->entityManagerInterface = $entityManagerInterface;
        $this->clientRepository = $clientRepository;
        $this->userRepository = $userRepository;
    }

    #[Route('/delete/user/or/worker', name: 'app_delete_user_or_worker')]
    public function index(Request $request): Response
    {
        $usuarios = $this->getDistinctClients();
        $workers = $this->getDistinctWorkers();
       
        $formUsers = $this->createForm(
            QueryClientType::class,
            null,
            [
                'method' => 'POST',
                'empty_data' =>
                [
                    'usuarios' => $usuarios,
                    'submitContent' => 'Eliminar usuario'
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
                    'submitContent' => 'Eliminar trabajador'
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

            if ($formUserResult) {
                $userToDelete = $this->clientRepository->findOneBy(['name' => $formUserResult['usuario']]);
            } elseif ($formWorkersResult) {
                $userToDelete = $this->userRepository->findOneBy(['name' => $formWorkersResult['usuario']]);
            }
            
            $this->entityManagerInterface->remove($userToDelete);
            $this->entityManagerInterface->flush();
            

            return $this->redirectToRoute('home');
        }

        return $this->render('delete_user_or_worker/index.html.twig', [
            'controller_name' => 'DeleteUserOrWorkerController',
            'formUsers' => $formUsers->createView(),
            'formWorkers' => $formWorkers->createView(),
        ]);
    }

    private function getDistinctClients(): array
    {
        $clients = $this->clientRepository->findAll();
        $clientsNames = array();

        foreach ($clients as $client) {
            $clientsNames[$client->getName()] = $client->getName();
        }

        return $clientsNames;
    }

    private function getDistinctWorkers(): array
    {
        $workers = $this->userRepository->findAll();
        $workersNames = array();

        foreach ($workers as $worker) {
            $workersNames[$worker->getName()] = $worker->getName();
        }

        return $workersNames;
    }
}

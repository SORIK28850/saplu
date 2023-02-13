<?php

namespace App\Controller;

use App\Entity\Work;
use App\Form\WorkType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\ClientRepository;
use App\Repository\UserRepository;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;

class RegisterWorkController extends AbstractController
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

    #[Route('/register/work', name: 'app_register_work')]
    public function index(Request $request): Response
    {
        $work = new Work();
        $form = $this->createForm(
            WorkType::class,
            $work,
            [
                'method' => 'POST',
                'empty_data' =>
                [
                    'usuarios' => $this->getDistinctClients(),
                    'workers' => $this->getDistinctWorkers(),
                ]
            ]
        );
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $work->setTime(new DateTime('now'));
            $this->entityManagerInterface->persist($work);
            $this->entityManagerInterface->flush();

            return $this->redirectToRoute('home');
        }

        return $this->render('register_work/index.html.twig', [
            'controller_name' => 'RegisterWorkController',
            'form' => $form->createView(),
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

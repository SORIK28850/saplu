<?php

namespace App\Controller;

use App\Repository\ClientRepository;
use App\Repository\UserRepository;

class ClientsAndUsersUtil
{


    /** @var ClientRepository*/
    public $clientRepository;

    /** @var UserRepository*/
    public $userRepository;

    /**
     * @param ClientRepository $clientRepository
     * @param UserRepository $userRepository
     */
    public function __construct(
        ClientRepository $clientRepository,
        UserRepository $userRepository
        )
    {
        $this->clientRepository = $clientRepository;
        $this->userRepository = $userRepository;
    }

    /**
     * @return array
     */
    public function getDistinctClients(): array
    {
        $clients = $this->clientRepository->findAll();
        $clientsNames = array();

        foreach ($clients as $client) {
            $clientsNames[$client->getName()] = $client->getName();
        }

        return $clientsNames;
    }

    /**
     * @return array
     */
    public function getDistinctWorkers(): array
    {
        $workers = $this->userRepository->findAll();
        $workersNames = array();

        foreach ($workers as $worker) {
            $workersNames[$worker->getName()] = $worker->getName();
        }

        return $workersNames;
    }

}
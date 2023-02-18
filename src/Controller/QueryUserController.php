<?php

namespace App\Controller;

use App\Form\QueryClientType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\ClientRepository;
use Symfony\Component\HttpFoundation\Request;

class QueryUserController extends AbstractController
{
     /** @var ClientRepository*/
     public $clientRepository;
 
     /**
      * @param ClientRepository $clientRepository
      */
     public function __construct(ClientRepository $clientRepository)
     {
         $this->clientRepository = $clientRepository;
     }

     /**
      * @param Request $request
      * @return Reponse
      */
    #[Route('/query/user', name: 'app_query_user')]
    public function index(Request $request): Response
    {
        $usuarios = $this->getDistinctClients();
       
        $form = $this->createForm(
            QueryClientType::class,
            null,
            [
                'method' => 'POST',
                'empty_data' =>
                [
                    'usuarios' => $usuarios,
                ]
            ]
        );
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $formResult = $form->getData();
            $dataClient = $this->getDataClient($formResult['usuario']);

            foreach ($dataClient as $value) {
                $data = $value;
            }
            
            return $this->render('query_user/table.html.twig', [
                'controller_name' => 'QueryUserController',
                'data' => $data,
            ]);

        }

        return $this->render('query_user/index.html.twig', [
            'controller_name' => 'QueryUserController',
            'form' => $form->createView(),
        ]);
    }

    /**
     * @return array
     */
    private function getDistinctClients(): array
    {
        $clients = $this->clientRepository->findAll();
        $clientsNames = array();

        foreach ($clients as $client) {
            $clientsNames[$client->getName()] = $client->getName();
        }

        return $clientsNames;
    }

    /**
     * @param string $clientName
     * @return array
     */
    private function getDataClient(string $clientName): array
    {
        return $this->clientRepository->findBy(['name' => $clientName]);
    }

}

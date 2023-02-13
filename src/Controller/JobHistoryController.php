<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\WorkRepository;

class JobHistoryController extends AbstractController
{
    /** @var WorkRepository*/
    public $workRepository;
 
    public function __construct(WorkRepository $workRepository)
    {
        $this->workRepository = $workRepository;
    }

    #[Route('/job/history', name: 'app_job_history')]
    public function index(): Response
    {
        return $this->render('job_history/index.html.twig', [
            'controller_name' => 'JobHistoryController',
            'data' => $this->getLastWorks()
        ]);
    }

    private function getLastWorks()
    {
        return $this->workRepository->findBy(array(), ['time' => 'DESC']);
    }
}

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
 
    /**
     * @param WorkRepository $workRepository
     */
    public function __construct(WorkRepository $workRepository)
    {
        $this->workRepository = $workRepository;
    }

    /**
     * @return Response
     */
    #[Route('/job/history', name: 'app_job_history')]
    public function index(): Response
    {
        return $this->render('job_history/index.html.twig', [
            'controller_name' => 'JobHistoryController',
            'data' => $this->getLastWorks()
        ]);
    }

    /**
     * @return array
     */
    private function getLastWorks(): array
    {
        return $this->workRepository->findBy(array(), ['time' => 'DESC']);
    }
}

<?php
namespace App\Controller;

use App\Repository\EmployeRepository;
use App\Repository\ServiceRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;

class  HomeController extends AbstractController {

    /**
     * @Route("/", name="home")
     * @param EmployeRepository $repository
     * @return Response
     */
    public function index(EmployeRepository $repository, ServiceRepository $repositorys): Response{

        $employes = $repository->findLatest();
        $services = $repositorys->findAll();
        return $this->render('pages/home.html.twig', [
            'employes' => $employes,
            'services' => $services
        ]);
    }
}

?>
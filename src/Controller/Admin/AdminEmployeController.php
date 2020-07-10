<?php
namespace App\Controller\Admin;

use App\Entity\Employe;
use App\Entity\Service;
use App\Form\EmployeType;
use App\Form\ServiceType;
use App\Repository\EmployeRepository;
use App\Repository\ServiceRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminEmployeController extends AbstractController{

    /**
     * @var EmployeRepository
     */
    private $repository;
    /**
     * @var ObjectManager
     */
    private $em;
    /**
     * @var ServiceRepository
     */
    private $repositorys;

    public function __construct(EmployeRepository $repository, ServiceRepository $repositorys, ObjectManager $em)
    {

        $this->repository = $repository;
        $this->em = $em;
        $this->repositorys = $repositorys;
    }

    /**
     * @Route("/admin", name="admin.employe.index")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index(){
        $services = $this->repositorys->findAll();
        $employes = $this->repository->findAll();
        return $this->render('admin/employe/index.html.twig', [
            'employes' => $employes,
            'services' => $services
        ]);
    }

    /**
     * @Route("/admin/employe/create", name="admin.employe.new")
     */
    public function new(Request $request){
        $employe = new Employe();
        $form = $this->createForm(EmployeType::class, $employe);

        //traiter le formulaire d'edition
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()){
            $this->em->persist($employe);
            $this->em->flush();
            $this->addFlash('success', 'Bien créé avec succès.');
            return $this->redirectToRoute('admin.employe.index');
        }
        return $this->render('admin/employe/new.html.twig', [
            'employe' => $employe,
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/admin/service/create", name="admin.service.new")
     */
    public function news(Request $request){
        $service = new Service();
        $form = $this->createForm(ServiceType::class, $service);

        //traiter le formulaire d'edition
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()){
            $this->em->persist($service);
            $this->em->flush();
            $this->addFlash('success', 'Bien créé avec succès.');
            return $this->redirectToRoute('admin.employe.index');
        }
        return $this->render('admin/service/new.html.twig', [
            'service' => $service,
            'form' => $form->createView()
        ]);
    }


    /**
     * @Route("/admin/employe/{id}", name="admin.employe.edit", methods="GET|POST")
     * @param Employe $employe
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function edit(Employe $employe, Request $request){
        $form = $this->createForm(EmployeType::class, $employe);

        //traiter le formulaire d'edition
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()){
            $this->em->flush();
            $this->addFlash('success', 'Bien modifié avec succès.');
            return $this->redirectToRoute('admin.employe.index');
        }

        return $this->render('admin/employe/edit.html.twig', [
            'employe' => $employe,
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/admin/service/{id}", name="admin.service.edit", methods="GET|POST")
     * @param Employe $service
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function edits(Service $service, Request $request){
        $form = $this->createForm(ServiceType::class, $service);

        //traiter le formulaire d'edition
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()){
            $this->em->flush();
            $this->addFlash('success', 'Bien modifié avec succès.');
            return $this->redirectToRoute('admin.employe.index');
        }

        return $this->render('admin/service/edit.html.twig', [
            'service' => $service,
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/admin/employe/{id}", name="admin.employe.delete", methods="DELETE")
     * @param Employe $employe
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function delete(Employe $employe, Request $request){
        if($this->isCsrfTokenValid('delete' . $employe->getId(), $request->get('_token'))){
            $this->em->remove($employe);
            $this->em->flush();
            $this->addFlash('success', 'Bien supprimé avec succès.');
            //return new Response('Suppression');
        }
        return $this->redirectToRoute('admin.employe.index');
    }

    /**
     * @Route("/admin/service/{id}", name="admin.service.delete", methods="DELETEs")
     * @param Service $service
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function deletes(Service $service, Request $request){
        if($this->isCsrfTokenValid('delete' . $service->getId(), $request->get('_token'))){
            $this->em->remove($service);
            $this->em->flush();
            $this->addFlash('success', 'Bien supprimé avec succès.');
            //return new Response('Suppression');
        }
        return $this->redirectToRoute('admin.employe.index');
    }

}
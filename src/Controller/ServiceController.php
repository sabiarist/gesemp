<?php
namespace App\Controller;

use App\Entity\Service;
use App\Repository\ServiceRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ServiceController extends AbstractController {
    /**
     * @var ServiceRepository
     */
    private $repository;
    /**
     * @var ObjectManager
     */
    private $em;

    public function __construct(ServiceRepository $repository, ObjectManager $em)
    {
        $this->repository = $repository;
        $this->em = $em;
    }

    /**
     * @Route("/services", name="service.index")
     * @return Response
     */
    public function index():Response{
        /*$property = new Property();
        $property->setTitle('Mon premier bien')
            ->setAddress('22 Rue Mermoz')
            ->setBedrooms(3)
            ->setCity('Dakar')
            ->setDescription('Une petite description')
            ->setHeat(1)
            ->setFloor(4)
            ->setPostalCode(12500)
            ->setPrice(200000)
            ->setSurface(60)
            ->setRooms(4);
        //Creer le gestionnaire d'entités
        $em = $this->getDoctrine()->getManager();
        // Persister l'entité property
        $em->persist($property);
        //porter tous les changement faits sur l'entity manager dans la base de donnee
        $em->flush();*/
        //recuperer proprietes par id
        //$property = $this->repository->find(1);
        //recuperer all properties
        //$property = $this->repository->findAll();
        //recuperer all properties where ...
        //$property = $this->repository->findOneBy(['floor' => 4]);

        //recuperer all properties non vendue
        /*$property = $this->repository->findAllVisible();
        dump($property);*/

        //Modifier entité
        /* $property[0]->setSold(true);
         $this->em->flush();*/

        return $this->render('service/index.html.twig', [
            'current_menu' => 'services'
        ]);
    }

    /**
     * @Route("/biens/{slug}-{id}", name="service.show", requirements={"slug":"[a-zA-Z0-9\-]*"})
     * @param Service $service
     * @param string $slug
     * @return Response
     */
    //Affiche la propriete avec son slug et son id dans le lien
    public function show(Service $service, string $slug):Response{
        //verifie si les slug correspondent Si non corrige le bon et fait une redirect permanante sur le lien canonique
        if ($service->getSlug() !== $slug){
            return $this->redirectToRoute('service.show',[
                'id' =>$service->getId(),
                'slug' =>$service->getSlug()
            ], 301);
        }
        return $this->render('service/show.html.twig', [
            'service' => $service,
            'current_menu' => 'services'
        ]);
    }
}
<?php
namespace App\Controller;

use App\Entity\Employe;
use App\Repository\EmployeRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class EmployeController extends AbstractController {
    /**
     * @var EmployeRepository
     */
    private $repository;
    /**
     * @var ObjectManager
     */
    private $em;

    public function __construct(EmployeRepository $repository, ObjectManager $em)
    {
        $this->repository = $repository;
        $this->em = $em;
    }

    /**
     * @Route("/biens", name="employe.index")
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

        return $this->render('employe/index.html.twig', [
            'current_menu' => 'employes'
        ]);
    }

    /**
     * @Route("/biens/{slug}-{id}", name="employe.show", requirements={"slug":"[a-zA-Z0-9\-]*"})
     * @param Employe $employe
     * @param string $slug
     * @return Response
     */
    //Affiche avec son slug et son id dans le lien
    public function show(Employe $employe, string $slug):Response{
        //verifie si les slug correspondent Si non corrige le bon et fait une redirect permanante sur le lien canonique
        if ($employe->getSlug() !== $slug){
            return $this->redirectToRoute('employe.show',[
                'id' =>$employe->getId(),
                'slug' =>$employe->getSlug()
            ], 301);
        }
        return $this->render('employe/show.html.twig', [
            'employe' => $employe,
            'current_menu' => 'employes'
        ]);
    }
}
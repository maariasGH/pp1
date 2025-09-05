<?php
    namespace App\Controller;

    use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
    use Symfony\Component\HttpFoundation\Response;
    use Symfony\Component\Routing\Annotation\Route;
    use Doctrine\ORM\EntityManagerInterface;
    use Symfony\Component\HttpFoundation\Request;
    use App\Manager\SubastaManager;
    use App\Entity\Subasta;
    
    class SubastaController extends AbstractController {
        
        #[Route('/', name: 'listar_subastas')] // http://localhost/pp1/BubuTech/public
        
        public function listarSubastas(SubastaManager $manager): Response {
            $subastas = $manager->getSubastas();
            return $this->render("Subastas/subastas.html.twig", ['subastas' => $subastas]);
        }

        #[Route('/verpublicar', name: 'ver_publicar_subasta')]
        
        public function verPublicar(): Response {
            return $this->render("Publicar/publicar.html.twig");
        }
        
        #[Route('/publicarsubasta', name: 'publicar_subasta', methods: ['GET','POST'])]
        public function publicarSubasta(Request $request, SubastaManager $subastaManager): Response
        {
            $subastaManager->publicarSubasta($request);
            return $this->redirectToRoute('listar_subastas');
        }
        
        #[Route('/subasta/{id}', name: 'detalle_subasta', methods: ['GET'])]
        public function detalle(int $id, EntityManagerInterface $em): Response
        {
            $subasta = $em->getRepository(Subasta::class)->find($id);

            if (!$subasta) {
                throw $this->createNotFoundException('La subasta no existe');
            }

            return $this->render('Subastas/detalle.html.twig', [
                'subasta' => $subasta,
            ]);
        }
        
}
?> 
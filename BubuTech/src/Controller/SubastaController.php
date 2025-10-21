<?php
    namespace App\Controller;

    use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
    use Symfony\Component\HttpFoundation\Response;
    use Symfony\Component\Routing\Annotation\Route;
    use Doctrine\ORM\EntityManagerInterface;
    use Symfony\Component\HttpFoundation\Request;
    use App\Manager\SubastaManager;
    use App\Entity\Subasta;
    use App\Entity\Comentario;
    use App\Entity\Oferta;
    use App\Entity\Usuario;
    use App\Enum\EstadoSubasta;
    
    class SubastaController extends AbstractController {
        
        #[Route('/', name: 'listar_subastas')] // http://localhost/pp1/BubuTech/public
        
        public function listarSubastas(SubastaManager $manager, Request $request): Response {
            $query = $request->query->get('q');

            if ($query) {
                $subastas = $manager->buscarPorNombre($query);
            } else {
                $subastas = $manager->getSubastas();
            }

            return $this->render("Subastas/subastas.html.twig", ['subastas' => $subastas]);
        }

        #[Route('/verpublicar', name: 'ver_publicar_subasta')]
        
        public function verPublicar(): Response {
            return $this->render("Publicar/publicar.html.twig");
        }
        
        #[Route('/publicarsubasta', name: 'publicar_subasta', methods: ['GET','POST'])]
        public function publicarSubasta(Request $request, SubastaManager $subastaManager): Response
        {
            if ($request->isMethod('POST')) {
                try {
                    $usuario = $this->getUser();
                    $usuario->addRol('ROLE_VENDEDOR');
                    $subastaManager->publicarSubasta($request, $usuario);
                    $this->addFlash('publicada', 'Subasta publicada correctamente.');
                    return $this->redirectToRoute('listar_subastas');
                } catch (\InvalidArgumentException $e) {
                    $this->addFlash('error', $e->getMessage());
                    return $this->redirectToRoute('publicar_subasta');
                }
            }
            return $this->render('Publicar/publicar.html.twig');
        }
        
        #[Route('/subasta/{id}', name: 'detalle_subasta', methods: ['GET', 'POST'])]
        public function detalle(int $id, EntityManagerInterface $em, Request $request): Response
        {
            $subasta = $em->getRepository(Subasta::class)->find($id);

            if (!$subasta) {
                throw $this->createNotFoundException('La subasta no existe');
            }

            $user = $this->getUser(); 

            // Procedimiento para registrar la Oferta
            if ($request->request->has('monto')) {
                $monto = (float) $request->request->get('monto');

                if ($monto > 0) {
                    $oferta = new Oferta();
                    $oferta->setMonto($monto);
                    $oferta->setFecha(new \DateTime());
                    $oferta->setOfertante($user);
                    $oferta->setSubasta($subasta);
                    $user->setDineroGastado($monto);
                    if ($user->getSubastaMasCara()<$monto) {
                        $user->setSubastaMasCara($monto);
                    }

                    // Validacion contra precio base o mayor oferta existente
                    if ($monto < $subasta->getPrecioBase() || $monto < $subasta->getOfertaParcialGanadora() ) {
                        $this->addFlash('error', 'La oferta debe ser mayor al precio base o a la oferta parcialmente ganadora');
                    } else {
                        $subasta->setOfertaParcialGanadora($monto);
                        $subasta->setGanador($user);
                        $em->persist($oferta);
                        $em->flush();
                        $this->addFlash('success', 'Oferta realizada con éxito');
                        return $this->redirectToRoute('detalle_subasta', ['id' => $id]);
                    }
                }
            }

            // Proceso para realizar comentarios
            if ($request->request->has('comentario')) {
                $texto = trim($request->request->get('comentario'));

                if ($texto !== '') {
                    if (strlen($texto)>2 && strlen($texto)<301) {
                        $comentario = new Comentario();
                        $comentario->setDetalle($texto);
                        $comentario->setFecha(new \DateTime());
                        $comentario->setCantidadLikes(0);
                        $comentario->setComentador($user);
                        $comentario->setSubasta($subasta);

                        $em->persist($comentario);
                        $em->flush();
                        $this->addFlash('success-coment', 'Comentario publicado');
                        return $this->redirectToRoute('detalle_subasta', ['id' => $id]);
                    } else {
                        $this->addFlash('error', 'El comentario debe tener entre 3 y 300 caracteres');
                    } 
                } else {
                    $this->addFlash('info', 'El comentario no puede estar vacio');
                }
            }

            // traer comentarios ya hechos
            $comentarios = $em->getRepository(Comentario::class)->findBy(
                ['subasta' => $subasta],
                ['Fecha' => 'DESC']
            );
            
            return $this->render('Subastas/detalle.html.twig', [
                'subasta' => $subasta,
                'comentarios' => $comentarios,
                'usuario' => $this->getUser(),
            ]);
        }

        #[Route('/gestionar-subastas', name: 'gestionar_subastas')]
        public function gestionar(SubastaManager $manager): Response
        {
            $user = $this->getUser();
            if (!$user) {
                throw $this->createAccessDeniedException('Debes iniciar sesión como vendedor.');
            }

            $subastas = $manager->getSubastasPorVendedor($user);

            return $this->render('Subastas/gestionar.html.twig', [
                'subastas' => $subastas
            ]);
        }

        #[Route('/subasta/{id}/editar', name: 'editar_subasta', methods: ['GET','POST'])]
        public function editar(int $id, Request $request, EntityManagerInterface $em, SubastaManager $subastaManager): Response
        {
            $subasta = $em->getRepository(Subasta::class)->find($id);

            if (!$subasta) {
                throw $this->createNotFoundException('Subasta no encontrada');
            }

            $user = $this->getUser();
            if (!$user || $subasta->getVendedor() === null || $user->getId() !== $subasta->getVendedor()->getId()) {
                throw $this->createAccessDeniedException('No puedes editar esta subasta');
            }

            // Si es POST procesamos la actualización
            if ($request->isMethod('POST')) {
                try {
                    $subastaManager->actualizarSubasta($subasta, $request);
                    $this->addFlash('success', 'Subasta actualizada correctamente');
                    return $this->redirectToRoute('gestionar_subastas');
                } catch (\InvalidArgumentException $e) {
                    $this->addFlash('error', $e->getMessage());
                    return $this->redirectToRoute('editar_subasta', ['id' => $subasta->getId()]);
                }
            }

            // GET -> mostramos el formulario con los datos actuales
            return $this->render('Subastas/editar.html.twig', [
                'subasta' => $subasta,
            ]);
        }

        #[Route('/subasta/{id}/eliminar', name: 'eliminar_subasta')]
        public function eliminar(int $id, EntityManagerInterface $em): Response
        {
            $subasta = $em->getRepository(Subasta::class)->find($id);

            if (!$subasta) {
                throw $this->createNotFoundException('Subasta no encontrada');
            }

            $em->remove($subasta);
            $em->flush();

            $this->addFlash('success', 'Subasta eliminada correctamente');
            return $this->redirectToRoute('gestionar_subastas');
        }

        #[Route('/subasta/{id}/pausar', name: 'pausar_subasta')]
        public function pausar(int $id, EntityManagerInterface $em): Response
        {
            $subasta = $em->getRepository(Subasta::class)->find($id);
            $subasta->setEstado(EstadoSubasta::PAUSADA);

            $em->flush();
            $this->addFlash('info', 'Subasta pausada');
            return $this->redirectToRoute('gestionar_subastas');
        }

        #[Route('/subasta/{id}/reanudar', name: 'reanudar_subasta')]
        public function reanudar(int $id, EntityManagerInterface $em): Response
        {
            $subasta = $em->getRepository(Subasta::class)->find($id);

            if (!$subasta) {
                throw $this->createNotFoundException('Subasta no encontrada');
            }

            // Verificar que el usuario actual sea el vendedor
            $user = $this->getUser();
            if (!$user || $subasta->getVendedor() === null || $user->getId() !== $subasta->getVendedor()->getId()) {
                throw $this->createAccessDeniedException('No puedes reanudar esta subasta');
            }

            // Solo reanudar si está pausada
            if ($subasta->getEstado() === EstadoSubasta::PAUSADA) {
                $subasta->setEstado(EstadoSubasta::ACTIVA);
                $em->flush();
                $this->addFlash('success', 'La subasta fue reanudada');
            } else {
                $this->addFlash('info', 'La subasta no está pausada');
            }

            return $this->redirectToRoute('gestionar_subastas');
        }


        #[Route('/subasta/{id}/confirmar', name: 'confirmar_subasta')]
        public function confirmar(int $id, EntityManagerInterface $em): Response
        {
            $subasta = $em->getRepository(Subasta::class)->find($id);
            $vendedor = $subasta->getVendedor();
            $subasta->setEstado(EstadoSubasta::FINALIZADA);
            $subasta->setOfertaFinalGanadora($subasta->getOfertaParcialGanadora());
            $vendedor->setDineroGanado($subasta->getOfertaFinalGanadora());
            if ($subasta->getGanador()) {
                $compradorGanador = $subasta->getGanador();
                $compradorGanador->setDineroGastado($subasta->getOfertaFinalGanadora());
                $compradorGanador->setCantidadSubastasGanadas(1);
            }
            

            $em->flush();
            $this->addFlash('success', 'Subasta confirmada');
            return $this->redirectToRoute('gestionar_subastas');
        }

        #[Route('/subasta/{id}/like/{id_com}', name: 'likear', methods: ['GET','POST'] ) ]
        public function likear(int $id, int $id_com, EntityManagerInterface $em, Request $request): Response { 
            $usuario = $this->getUser();
            $comentario = $em->getRepository(Comentario::class)->find($id_com);
            $usuariosMg= $comentario->getUsuariosMeGusta();
            $CantidadLikes= $comentario->getCantidadLikes();
            if ((!in_array($usuario, $comentario->getUsuariosMeGusta()->toArray())) || $CantidadLikes==0) {
                $comentario->setCantidadLikes($CantidadLikes+1);
                $comentario->addUsuariosMeGusta($usuario);
                $em->persist($comentario);
                $em->flush();
                return $this->redirectToRoute('detalle_subasta', ['id'=>$id]);
            } else {
                $comentario->setCantidadLikes($CantidadLikes-1);
                $comentario->removeUsuariosMeGusta($usuario);
                $em->persist($comentario);
                $em->flush();
                return $this->redirectToRoute('detalle_subasta', ['id'=>$id]);
            }
            
        }
        #[Route('/subasta/{id}/eliminar/{id_com}', name: 'eliminar_comentario', methods: ['GET','POST'] ) ]
        public function eliminarComentario(int $id, int $id_com, EntityManagerInterface $em, Request $request): Response { 
            $usuario = $this->getUser();
            $comentario = $em->getRepository(Comentario::class)->find($id_com);
            // Buscar la subasta
            $subasta = $em->getRepository(Subasta::class)->find($id);
            if (!$subasta) {
                $this->addFlash('error', 'Subasta no encontrada.');
                return $this->redirectToRoute('listar_subastas');
            }

            // Verificar que el usuario sea el vendedor
            if ($subasta->getVendedor()->getId() !== $usuario->getId() && $comentario->getComentador()->getId() !== $usuario->getId() ) {
                $this->addFlash('error', 'No tenés permiso para eliminar comentarios en esta subasta.');
                return $this->redirectToRoute('detalle_subasta', ['id' => $id]);
            }

            // Buscar el comentario
            
            if (!$comentario || $comentario->getSubasta()->getId() !== $id) {
                $this->addFlash('error', 'Comentario no válido.');
                return $this->redirectToRoute('detalle_subasta', ['id' => $id]);
            }

            // Eliminar el comentario
            $em->remove($comentario);
            $em->flush();

            $this->addFlash('success', 'Comentario eliminado correctamente.');
            return $this->redirectToRoute('detalle_subasta', ['id' => $id]);
        }

}
?> 
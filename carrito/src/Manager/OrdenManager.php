<?php
    namespace App\Manager;
    
    use App\Repository\OrdenRepository;

    class OrdenManager {

        private OrdenRepository $repositorio;

        function __construct(OrdemRepository $repository) {
            $this->repositorio=$repository;
        }
        public function getOrdenes() {
           return $this->repositorio->findAll();
        }
        public function getOrden(int $id) {
            $orden= $this->repositorio->find($id);
            return $orden;
        }     
    }
?>
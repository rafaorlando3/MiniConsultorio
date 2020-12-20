<?php
    
    /**
    * Classe AbstractCrud
    *@autor - Rafael Orlando Mendes
    *@email - rafaorlando3@gmail.com 
    */
    
    namespace Consultorio\persistencia;

    use Doctrine\ORM\Tools\Setup;
    use Doctrine\ORM\EntityManager;
    
    class AbstractCrud {
        private $entityManager;
        private $entityPath;

        public function __construct($entityPath) 
        {   $this->entityPath = $entityPath;
            $this->entityManager = $this->createEntityManager();
        }
        
        public function createEntityManager() 
        {   
            $isDevMode = true;
            $configuration = Setup::createAnnotationMetadataConfiguration(
                [__DIR__.'Consultorio/entidades'], 
                $isDevMode
            );
        
            $connection = [
                'dbname' => 'consultorio',
                'user' => 'root',
                'password' => '',
                'host' => 'localhost',
                'driver' => 'pdo_mysql'
            ];
        
            return EntityManager::create($connection, $configuration);
        }
        
        public function insert($obj) 
        {   
            $this->entityManager->persist($obj);
            $this->entityManager->flush();
        }
        
        public function update($obj) 
        {
            $this->entityManager->merge($obj);
            $this->entityManager->flush();
        }
        
        public function delete($id) 
        {   
            $obj = $this->findById($id);
            if ($obj) {
                $this->entityManager->remove($obj);
                $this->entityManager->flush();
                return true;
            }
            return false; 
        }
        
        public function findById($id) 
        { 
            return $this->entityManager->find($this->entityPath, $id);
        }

        public function findBySearch() 
        {   
                $query = $this->entityManager->createQuery('SELECT p.id, p.nome FROM Consultorio\entidades\pacientes p, Consultorio\entidades\prontuario pr WHERE p.id=pr.paciente GROUP BY p.nome');
                $data = array();
                foreach($query->getResult() as $obj) {
                    $data[] = $obj;
                }
                return $data;
        }

        public function findBySearchId($id) 
        {   
                $query = $this->entityManager->createQuery('SELECT pr.id, pr.descricao, pr.data_pront, pr.paciente FROM Consultorio\entidades\prontuario pr WHERE pr.paciente='.$id.'');
                $data = array();
                foreach($query->getResult() as $obj) {
                    $data[] = $obj;
                }
                return $data;
        }
        
        public function findAll() 
        { 
            $collection = $this->entityManager->getRepository($this->entityPath)->findAll();

            $data = array();
            foreach($collection as $obj) {
                $data[] = $obj;
            }
            return $data;
        }
    }
?>
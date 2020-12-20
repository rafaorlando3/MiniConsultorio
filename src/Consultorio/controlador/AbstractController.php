<?php

    /**
    * Classe AbstractController
    *@autor - Rafael Orlando Mendes
    *@email - rafaorlando3@gmail.com 
    */

    namespace Consultorio\controlador;

    use Consultorio\persistencia\AbstractCrud;
    use Exception;

    abstract class AbstractController {
        // attr
        private $dao;
        
        public function __construct($dao) 
        {
            if (!$dao instanceof AbstractCrud) {
                throw new Exception("error");
            }
            $this->dao = $dao;
        }
        
        public function getDao() 
        {
            return $this->dao;
        }
        
        public function setDao($dao) 
        {
            $this->dao = $dao;
        }
        
        public function get($id) 
        {
            if ($id === null) {
                $data = array ();
                $result = $this->getDao()->findAll();

                foreach ($result as $obj) {
                    $data [] = $obj->toArray();
                }
            } else {
                $obj = $this->getDao()->findById($id);
                if ($obj != null) {
                    $data = $obj->toArray();
                } else {
                    $data = [];
                }
            }
            return $data;
        }

        public function getPaciConsult() 
        {
            $data = array();
            $result = $this->getDao()->findBySearch();
            return $result;
        }

        public function getConsultas($id) 
        {
            $data = array();
            $result = $this->getDao()->findBySearchId($id);
            return $result;
        }
        
        abstract public function insert($json);
        abstract public function update($json);
        abstract public function delete($id);
    }
?>
<?php

    /**
    * Classe Prontuario
    *@autor - Rafael Orlando Mendes
    *@email - rafaorlando3@gmail.com 
    */

    namespace Consultorio\entidades;

    /**
    * @Entity @Table(name="prontuario")
    */
    class Prontuario {

        /**
        * @var integer @Id
        *              @Column(name="id", type="integer")
        *              @GeneratedValue(strategy="AUTO")
        */
        private $id;
        /**
         *
         * @var string @Column(type="string", length=1000)
        */
        private $descricao;
        /**
         *
         * @var string @Column(type="datetime")
        */
        private $data_pront;
        /**
         *
         * @var integer @Column(type="integer")
        */
        private $paciente;
        
        public function __construct($id = 0, $descricao = "", $data_pront = "0000-00-00 00:00:00", $paciente = 0) 
        {
            $this->id = $id;
            $this->descricao = $descricao;
            $this->data_pront = $data_pront;
            $this->paciente = $paciente;
        }

        public function getId() 
        {
            return $this->id;
        }

        public function setId($id) 
        {
            $this->id = $id;
        }

        public function getDesc() 
        {
            return $this->desc;
        }

        public function setDesc($descricao) 
        {
            $this->descricao = $descricao;
        }

        public function getDataPront()
        {
            return $this->data_pront;
        }

        public function setDataPront($data_pront)
        {
            $this->data_pront = $data_pront;
        }

        public function getPaciente()
        {
            return $this->paciente;
        }

        public function setPaciente($paciente)
        {
            $this->paciente = $paciente;
        }

        public function equals($object) 
        {
            if ($object instanceof Pacientes) {
                if ($this->id != $object->id) {
                    return false;
                }

                if ($this->descricao != $object->descricao) {
                    return false;
                }

                if ($this->data_pront != $object->data_pront) {
                    return false;
                }

                if ($this->paciente != $object->paciente) {
                    return false;
                }
                return true;
            } else {
                return false;
            }
        }
        
        public function toString() 
        {
            return " [id:" .$this->id. "]  [descricao:" .$this->descricao. "]  [data_pront:" .$this->data_pront. "]  [paciente:" .$this->paciente. "] " ;
        }
        
        public function toArray() 
        {
            return [ 
                'id' =>  $this->id,
                'descricao' =>  $this->descricao,
                'data_pront' =>  $this->data_pront,
                'paciente' =>  $this->paciente
            ];
        }

    }
?>
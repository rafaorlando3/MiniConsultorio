<?php

    /**
    * Classe Pacientes
    *@autor - Rafael Orlando Mendes
    *@email - rafaorlando3@gmail.com 
    */

    namespace Consultorio\entidades;
    
    /**
    * @Entity @Table(name="pacientes")
    */
    class Pacientes extends Entidade 
    {

        /**
        * @var integer @Id
        *              @Column(name="id", type="integer")
        *              @GeneratedValue(strategy="AUTO")
        */
        private $id;
        /**
         *
         * @var string @Column(type="string", length=255)
        */
        private $nome;
        /**
         *
         * @var string @Column(type="string", length=10)
        */
        private $sexo;
        /**
         *
         * @var string @Column(type="date")
        */
        private $nasc;
        /**
         *
         * @var string @Column(type="string", length=20)
        */
        private $documento;
        /**
         *
         * @var string @Column(type="datetime")
        */
        private $data_cadastro;
        
        public function __construct($id = 0, $nome = "", $sexo = "", $nasc = "", $documento = "", $data_cadastro = "0000-00-00 00:00:00") 
        {
            $this->id = $id;
            $this->nome = $nome;
            $this->sexo = $sexo;
            $this->nasc = new \DateTime('1990-06-22');
            $this->documento = $documento;
            $this->data_cadastro = new \DateTime('1990-06-22');

        }

        public function getId() 
        {
            return $this->id;
        }

        public function setId($id) 
        {
            $this->id = $id;
        }

        public function getNome() 
        {
            return $this->nome;
        }

        public function setNome($nome) 
        {
            $this->nome = $nome;
        }

        public function getSexo()
        {
            return $this->sexo;
        }

        public function setSexo($sexo)
        {
            $this->sexo = $sexo;
        }

        public function getNasc()
        {
            return $this->nasc;
        }

        public function setNasc($nasc)
        {
            $this->nasc = $nasc;
        }

        public function getDocumento()
        {
            return $this->documento;
        }

        public function setDocumento($documento)
        {
            $this->documento = $documento;
        }

        public function getData_cadastro()
        {
            return $this->data_cadastro;
        }

        public function setData_cadastro($data_cadastro)
        {
            $this->data_cadastro = $data_cadastro;
        }
        public function equals($object) 
        {
            if ($object instanceof Pacientes) {
                if ($this->id != $object->id) {
                    return false;
                }

                if ($this->nome != $object->nome) {
                    return false;
                }

                if ($this->sexo != $object->sexo) {
                    return false;
                }

                if ($this->nasc != $object->nasc) {
                    return false;
                }

                if ($this->documento!=$object->documento){
                    return false;

                }

                if ($this->data_cadastro!=$object->data_cadastro){
                    return false;
                }
                return true;
            } else {
                return false;
            }
        }
        
        public function toString() 
        {
            return "  [id:" .$this->id. "]  [nome:" .$this->nome. "]  [sexo:" .$this->sexo. "]  [nasc:" .$this->nasc. "]  [documento:" .$this->documento. "]  [data_cadastro:" .$this->data_cadastro. "]  " ;
        }
        
        public function toArray() 
        {
            return [ 
                'id' =>  $this->id,
                'nome' =>  $this->nome,
                'sexo' =>  $this->sexo,
                'nasc' =>  $this->nasc,
                'documento' =>  $this->documento,
                'data_cadastro' =>  $this->data_cadastro
            ];
        }

    }

?>
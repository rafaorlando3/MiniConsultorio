<?php

    /**
    * Classe ProntuarioController
    *@autor - Rafael Orlando Mendes
    *@email - rafaorlando3@gmail.com 
    */

    namespace Consultorio\controlador;

    use Consultorio\persistencia\ProntuarioCrud;
    use Consultorio\entidades\Prontuario;
    use Consultorio\controlador\AbstractController;
    use DateTime;

    class ProntuarioController extends AbstractController {

        public function __construct() 
        {
            parent::__construct(new ProntuarioCrud());
        }
            
        public function insert($json) 
        {
            $data_pront = new \DateTime("$json->data_pront");
            $prontuario = new Prontuario(0, $json->descricao, $data_pront, $json->paciente);
            $this->getDao()->insert($prontuario);
            return ["mensagem"=> "Prontuario inserido com sucesso"];
        }
        
        public function update($json)
        {
            $data_pront = new \DateTime("$json->data_pront");
            $prontuario = new Prontuario($json->id, $json->descricao, $data_pront, $json->paciente);
            $this->getDao()->update($prontuario);
            return ["mensagem"=> "Prontuario Atualizado com sucesso"];
        }

        public function delete($id) 
        {
            $deleted = $this->getDao()->delete($id);
            if ($deleted) {
                return ["mensagem"=> "Prontuario excluido com sucesso"];
            }
            return ["mensagem"=> "Prontuario nao existe."]; 
        }
    }

?>
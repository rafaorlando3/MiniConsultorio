<?php

    /**
    * Classe PacientesController
    *@autor - Rafael Orlando Mendes
    *@email - rafaorlando3@gmail.com 
    */

    namespace Consultorio\controlador;

    use Consultorio\persistencia\PacientesCrud;
    use Consultorio\entidades\Pacientes;
    use Consultorio\controlador\AbstractController;

    class PacientesController extends AbstractController {

        public function __construct() 
        {
            parent::__construct(new PacientesCrud());
        }
        
        public function insert($json) 
        {
            $nasc = new \DateTime("$json->nasc");
            $data_cadastro = date('Y-m-d H:i');
            $paciente = new Pacientes(0, $json->nome, $json->sexo, $nasc, $json->documento, $data_cadastro);
            $this->getDao()->insert($paciente);
            return ["mensagem"=> "Paciente inserido com sucesso"];
        }
        
        public function update($json) 
        { 
            $nasc = new \DateTime("$json->nasc");
            $data_cadastro = date('Y-m-d H:i');
            $paciente = new Pacientes($json->id, $json->nome, $json->sexo, $nasc, $json->documento, $data_cadastro);
            $this->getDao()->update($paciente);
            return ["mensagem"=> "Paciente Atualizado com sucesso"];
        }
        
        public function delete($id) 
        {
            $deleted = $this->getDao()->delete($id);
            if ($deleted) {
                return ["mensagem"=> "Paciente excluido com sucesso"];
            }
            return ["mensagem"=> "Paciente nao existe."];
        }
    }
?>
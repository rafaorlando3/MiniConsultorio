<?php
    
    /**
    * Classe ProntuarioCrud
    *@autor - Rafael Orlando Mendes
    *@email - rafaorlando3@gmail.com 
    */

    namespace Consultorio\persistencia;

    use Doctrine\ORM\Tools\Setup;
    use Doctrine\ORM\EntityManager;
    use Consultorio\persistencia\AbstractCrud;
    use Consultorio\entidades\Prontuario;
    
    class ProntuarioCrud extends AbstractCrud {
        
        public function __construct() 
        {   
            parent::__construct('Consultorio\entidades\Prontuario');
        }
    }
?>
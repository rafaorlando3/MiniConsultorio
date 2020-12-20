<?php 
    date_default_timezone_set('America/Sao_Paulo');
    
    $loader = require __DIR__ . '/vendor/autoload.php';
    
    use Consultorio\entidades\Pacientes;
    use Consultorio\entidades\Prontuario;
    use Consultorio\controlador\PacientesController;
    use Consultorio\controlador\ProntuarioController;

    $app = new \Slim\Slim();

    $paciente = new PacientesController();
    $prontuario = new ProntuarioController();


    $app->get('/', function() {
        echo json_encode([
            "api" => "Consultorio REST",
            "version" => "1.0.0",
            "Desenvolvedor" => "Rafael Orlando Mendes"
        ]);
    });

    $app->get('/paciente(/(:id))', function($id = null) use ($paciente) {
        echo json_encode($paciente->get($id));
    });

    $app->get('/pacienteconsulta(/)', function($id = null) use ($paciente) {
        echo json_encode($paciente->getPaciConsult());
    });
        
    $app->post('/paciente(/)', function() use ($paciente, $app) {
        $json = json_decode($app->request()->getBody());
        echo json_encode($paciente->insert($json)); 
    });
    
    $app->put('/paciente/:id', function($id) use ($paciente, $app) {
        $json = json_decode($app->request()->getBody());
        echo json_encode($paciente->update($json));
    });
    
    $app->delete('/paciente/:id', function($id) use ($paciente) {
        echo json_encode($paciente->delete($id));
    });
    
    $app->get('/prontuario(/(:id))', function($id = null) use ($prontuario) {
        echo json_encode($prontuario->get($id));
    });

    $app->get('/consultaspacientes(/(:id))', function($id) use ($paciente) {
        echo json_encode($paciente->getConsultas($id));
    });
    
    $app->post('/prontuario(/)', function() use ($prontuario, $app) {
        $json = json_decode($app->request()->getBody());
        echo json_encode($prontuario->insert($json));
    });
    
    $app->put('/prontuario/:id', function($id) use ($prontuario, $app) {
        $json = json_decode($app->request()->getBody());
        echo json_encode($prontuario->update($json));
    });
    
    $app->delete('/prontuario/:id', function($id) use ($prontuario) {
        echo json_encode($prontuario->delete($id));
    });

    $app->run();
?>
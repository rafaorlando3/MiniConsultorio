# Mini Consultório

## Projeto
Projeto de cadastro de pacientes e consulta simplificado com suas funcionalidades todas em uma tela. O mesmo consome uma API REST php feita com Doctrine e Slim.

## Tecnologias
Foram utilizadas as seguintes tecnologias para o desenvolvimento desse projeto:
- PHP
- Doctrine
- Slim
- Mysql
- Bootstrap
- Jquery

## Configuração
Para rodar o projeto é necessário ter um servidor apache com PHP e Mysql configurados. Segue os passos:

    1- Após configurado servidor, criar banco e importar tabelas no Mysql versão 5.0.4. O sql das tabelas utilizadas encontra-se em 'Consultorio\config\consultorio.sql'.
 
    2 - Editar a classe AbstractCrud.php ('Consultorio\src\Consultorio\persistencia\AbstractCrud.php') na função createEntityManager(). Adicionar os dados de conexão do seu banco Mysql.
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

    1 - Editar a classe AbstractCrud.php ('Consultorio\src\Consultorio\persistencia\AbstractCrud.php') na função createEntityManager(). Adicionar os dados de conexão do seu banco Mysql.

    2 - Modificar o arquivo /config/bootstrap.php com as mesmas configurações de conexão do seu banco e gerar tabelas com o Doctrine.

    3- Caso não consiga gerar as tabelas, é possível importar tabelas no Mysql (versão 5.0.4) no qual o sql das tabelas utilizadas encontra-se em 'Consultorio\config\consultorio.sql'.

## Acesso
Após feitas as configurações acessar app/index.html. Para visualizar o projeto em seu funcionamento veja o vídeo "Processo Seletivo DEV.mp4" que se encontra aqui na raiz ou na pasta Screenshots.
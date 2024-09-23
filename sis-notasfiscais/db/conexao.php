<?php 
// Incluindo o arquivo de configuração onde estão definidas as constantes de conexão
include("config.php"); // Este arquivo deve conter as definições de SERVIDOR, USUARIO, SENHA e BANCO

// Estabelecendo a conexão com o banco de dados utilizando as constantes definidas em 'config.php'
$conexao = mysqli_connect(SERVIDOR, USUARIO, SENHA, BANCO) 
    or die("Erro na conexão com o servidor!" . mysqli_connect_error()); // Se a conexão falhar, exibe uma mensagem de erro com detalhes

// Nota: A função mysqli_connect retorna um objeto de conexão que pode ser utilizado para executar consultas SQL.
// A mensagem de erro é importante para identificar problemas, mas em produção, é recomendável tratá-la adequadamente para não expor informações sensíveis.

?>


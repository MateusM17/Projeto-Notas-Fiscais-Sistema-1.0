<?php 
// Definindo constantes de configuração para a conexão com o banco de dados
// Isso facilita a mudança dos parâmetros de conexão em um único lugar, se necessário.

// NOME DO SERVIDOR onde o banco de dados está hospedado
define("SERVIDOR", "localhost"); // 'localhost' indica que o banco de dados está no mesmo servidor que o script PHP

// NOME DE USUÁRIO para autenticação no banco de dados
define("USUARIO", "root"); // 'root' é muitas vezes o usuário padrão em ambientes de desenvolvimento, considere usar um usuário com menos privilégios em produção

// SENHA do usuário do banco de dados
define("SENHA", ""); // A senha está vazia por default, recomenda-se garantir que isso não ocorra em ambientes de produção, a segurança é essencial

// NOME DO BANCO DE DADOS ao qual o script se conectará
define("BANCO", "dbsisnotasfiscais"); // Especifica o nome do banco de dados a ser utilizado, deve existir no servidor mencionado

?>
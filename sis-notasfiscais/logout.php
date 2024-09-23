<?php 
// Inicia uma nova sessão ou retoma a sessão atual
session_start(); // É importante iniciar a sessão antes de modificar ou destruir

// Remove todas as variáveis da sessão
session_unset(); 

// Destrói a sessão, limpando todos os dados armazenados
session_destroy(); 

// Redireciona o usuário para a página de login
header('Location: login.php'); 

// Termina o script para garantir que nada mais será executado após o redirecionamento
exit(); 
?>
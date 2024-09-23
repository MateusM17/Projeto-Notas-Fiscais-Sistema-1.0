<?php 
// Inicia ou retoma a sessão existente
session_start(); 

// Remove todas as variáveis de sessão, apagando seus valores, mas mantendo a sessão viva
session_unset(); // Limpa todas as variáveis de sessão atuais

// Destroi a sessão, limpando todas as informações armazenadas
session_destroy(); // O ambiente de sessão não estará mais disponível após essa chamada

// Opcional: Redirecionar o usuário após o logout (adapte o redirecionamento conforme necessário)
header("Location: login.php"); // Redireciona para a página de login após o logout
exit; // Garante que o script será encerrado após o redirecionamento
?>

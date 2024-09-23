<?php 
// Inicia uma nova sessão ou retoma a sessão existente
session_start(); 

// Exibe um título de página
echo "<h1>Página 1</h1>"; // Corrigido: falta de um caractere '>' no título

// Exibe o ID da sessão atual
echo "ID da Sessão: " . session_id() . "<br>";

// Armazenando informações do usuário na sessão
$_SESSION['username'] = "marcelo"; // Nome de usuário na sessão
$_SESSION['senha'] = "abcde"; // Senha na sessão (Não recomendado armazenar senhas em texto puro)

// Exibe o nome de usuário armazenado na sessão
echo "Usuário: " . $_SESSION['username'] . "<br>"; 
// Exibe a senha armazenada na sessão (Não recomendado para produção)
echo "Senha: " . $_SESSION['senha'] . "<br>"; 

?>
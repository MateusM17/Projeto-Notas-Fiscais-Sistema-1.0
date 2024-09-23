<?php 
// Inicia ou retoma a sessão existente
session_start(); 

// Exibe um título de página
echo "<h1>Página 3</h1>"; // Corrigido: Adicionado o caractere '>' que estava faltando na tag <h1>

// Exibe o ID da sessão atual
echo "ID da Sessão: " . session_id() . "<br>"; // Mensagem clara sobre o ID da sessão

?>
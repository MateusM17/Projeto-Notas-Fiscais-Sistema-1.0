<?php 
// Inicia ou retoma a sessão existente
session_start(); 

// Exibe um título de página
echo "<h1>Página 2</h1>"; // Corrigido: adicionada a tag de fechamento '>' que estava faltando

// Exibe o ID da sessão atual
echo "ID da Sessão: " . session_id() . "<br>"; // Mensagem clara sobre o ID da sessão

?>
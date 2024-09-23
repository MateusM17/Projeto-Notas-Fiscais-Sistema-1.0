<?php 
// Senha a ser criptografada
$senha = "abcde";

// Criptografa a senha usando o algoritmo SHA-256
$senhaCripto = hash('sha256', $senha);

// Exibe a senha original de forma segura
echo "Senha original: ";
var_dump($senha);
echo "<br>";

// Exibe a senha criptografada
echo "Senha criptografada (SHA-256): ";
var_dump($senhaCripto);

?>
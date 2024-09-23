<header>
    <h3>
        <i class="bi bi-calendar-check"></i> Atualizar Eventos
    </h3>
</header>

<?php 
// Escapagem de dados recebidos via POST para evitar SQL Injection
$idEvento = mysqli_real_escape_string($conexao, $_POST['idEvento']);
$tituloEvento = mysqli_real_escape_string($conexao, $_POST['tituloEvento']);
$descriçãoEvento = mysqli_real_escape_string($conexao, $_POST['descriçãoEvento']);
$dataInícioEvento = mysqli_real_escape_string($conexao, $_POST['dataInícioEvento']);
$horaInícioEvento = mysqli_real_escape_string($conexao, $_POST['horaInícioEvento']);
$dataFimEvento = mysqli_real_escape_string($conexao, $_POST['dataFimEvento']);
$horaFimEvento = mysqli_real_escape_string($conexao, $_POST['horaFimEvento']);


// Construção da consulta SQL para atualizar a Evento com base no ID fornecido
$sql = "UPDATE tbeventos SET
    tituloEvento = '{$tituloEvento}',
    descriçãoEvento = '{$descriçãoEvento}',
    dataInícioEvento = '{$dataInícioEvento}',
    horaInícioEvento = '{$horaInícioEvento}',
    dataFimEvento = '{$dataFimEvento}',
    horaFimEvento = '{$horaFimEvento}'
WHERE idEvento = '{$idEvento}'";

// Execução da consulta SQL e tratamento de erros
$rs = mysqli_query($conexao, $sql) or die("Erro ao executar a consulta: " . mysqli_error($conexao)); 

// Verifica se a atualização foi realizada com sucesso
if ($rs) {
?>
<div class="alert alert-success" role="alert"> 
    <h4 class="alert-heading">Atualizar Evento</h4>
    <p>Evento atualizada com sucesso.</p>
    <hr>
    <p class="mb-0">
        <a href="?menuop=eventos">Voltar para a lista de Eventos.</a>
    </p>
</div>
<?php 
} else {
?>
<div class="alert alert-danger" role="alert">
    <h4 class="alert-heading">Erro</h4>
    <p>A Evento não pode ser atualizada.</p>
    <hr>
    <p class="mb-0">
        <a href="?menuop=eventos">Voltar para a lista de Eventos.</a>
    </p>
</div>
<?php 
}
?>
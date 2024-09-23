<header>
    <h3>
        <i class="bi bi-list-task"></i> Atualizar Tarefas
    </h3>
</header>

<?php 
// Escapagem de dados recebidos via POST para evitar SQL Injection
$idTarefa = mysqli_real_escape_string($conexao, $_POST['idTarefa']);
$tituloTarefa = mysqli_real_escape_string($conexao, $_POST['tituloTarefa']);
$descricaoTarefa = mysqli_real_escape_string($conexao, $_POST['descricaoTarefa']);
$dataConclusaoTarefa = mysqli_real_escape_string($conexao, $_POST['dataConclusaoTarefa']);
$horaConclusaoTarefa = mysqli_real_escape_string($conexao, $_POST['horaConclusaoTarefa']);
$dataLembreteTarefa = mysqli_real_escape_string($conexao, $_POST['dataLembreteTarefa']);
$horaLembreteTarefa = mysqli_real_escape_string($conexao, $_POST['horaLembreteTarefa']);
$recorrenciaTarefa = mysqli_real_escape_string($conexao, $_POST['recorrenciaTarefa']);

// Construção da consulta SQL para atualizar a tarefa com base no ID fornecido
$sql = "UPDATE tbtarefas SET
    tituloTarefa = '{$tituloTarefa}',
    descricaoTarefa = '{$descricaoTarefa}',
    dataConclusaoTarefa = '{$dataConclusaoTarefa}',
    horaConclusaoTarefa = '{$horaConclusaoTarefa}',
    dataLembreteTarefa = '{$dataLembreteTarefa}',
    horaLembreteTarefa = '{$horaLembreteTarefa}',
    recorrenciaTarefa = '{$recorrenciaTarefa}'  // vírgula removida antes do WHERE
WHERE idTarefa = '{$idTarefa}'";

// Execução da consulta SQL e tratamento de erros
$rs = mysqli_query($conexao, $sql) or die("Erro ao executar a consulta: " . mysqli_error($conexao)); 

// Verifica se a atualização foi realizada com sucesso
if ($rs) {
?>
<div class="alert alert-success" role="alert"> 
    <h4 class="alert-heading">Atualizar Tarefa</h4>
    <p>Tarefa atualizada com sucesso.</p>
    <hr>
    <p class="mb-0">
        <a href="?menuop=tarefas">Voltar para a lista de tarefas.</a>
    </p>
</div>
<?php 
} else {
?>
<div class="alert alert-danger" role="alert">
    <h4 class="alert-heading">Erro</h4>
    <p>A tarefa não pode ser atualizada.</p>
    <hr>
    <p class="mb-0">
        <a href="?menuop=tarefas">Voltar para a lista de tarefas.</a>
    </p>
</div>
<?php 
}
?>

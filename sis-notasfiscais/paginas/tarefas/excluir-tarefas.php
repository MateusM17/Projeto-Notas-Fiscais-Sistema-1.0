<header>
    <h3>Excluir Tarefas</h3> <!-- Cabeçalho da página indicando a funcionalidade de exclusão de tarefas -->
</header>

<?php 
// Obtém o ID da tarefa a ser excluída a partir da URL (gestão de parâmetros GET)
$idTarefa = $_GET["idTarefa"];

// Monta a consulta SQL para excluir a tarefa com o ID fornecido
$sql = "DELETE FROM tbtarefas WHERE idTarefa = '{$idTarefa}'";

// Executa a consulta de exclusão no banco de dados
$rs = mysqli_query($conexao, $sql);

// Verifica se a execução da consulta foi bem-sucedida
if ($rs) {
    // Caso a tarefa tenha sido excluída com sucesso, exibe uma mensagem de sucesso
    ?>
    <div class="alert alert-success" role="alert"> 
        <h4 class="alert-heading">Excluir Tarefa</h4>
        <p>Tarefa excluída com sucesso!</p> <!-- Mensagem confirmando a exclusão da tarefa -->
        <hr>
        <p class="mb-0">
            <a href="?menuop=tarefas">Voltar para a lista de tarefas.</a> <!-- Link para retornar à lista de tarefas -->
        </p>
    </div>
    <?php 
} else {
    // Em caso de erro durante a exclusão, exibe uma mensagem de erro
    ?>
    <div class="alert alert-danger" role="alert">
        <h4 class="alert-heading">Erro</h4>
        <p>A tarefa não pode ser excluída: <?php echo mysqli_error($conexao); ?></p> <!-- Exibe o erro retornado pelo MySQL -->
        <hr>
        <p class="mb-0">
            <a href="?menuop=tarefas">Voltar para a lista de tarefas.</a> <!-- Link para retornar à lista de tarefas -->
        </p>
    </div>
    <?php 
}
?>

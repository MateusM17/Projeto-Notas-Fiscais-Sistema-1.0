<header>
    <h3>
        <i class="bi bi-list-task"></i> Inserir Tarefa <!-- Título da página que indica a funcionalidade de inserir uma nova tarefa -->
    </h3>
</header>

<?php 

// Verifica se o método da requisição é POST, indicando que o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Escapa os dados recebidos do formulário para evitar SQL Injection
    $tituloTarefa = mysqli_real_escape_string($conexao, $_POST['tituloTarefa']);
    $descriçãoTarefa = mysqli_real_escape_string($conexao, $_POST['descriçãoTarefa']);
    $dataConclusãoTarefa = mysqli_real_escape_string($conexao, $_POST['dataConclusãoTarefa']);
    $horaConclusãoTarefa = mysqli_real_escape_string($conexao, $_POST['horaConclusãoTarefa']);
    $dataLembreteTarefa = mysqli_real_escape_string($conexao, $_POST['dataLembreteTarefa']);
    $horaLembreteTarefa = mysqli_real_escape_string($conexao, $_POST['horaLembreteTarefa']);
    $recorrenciaTarefa = mysqli_real_escape_string($conexao, $_POST['recorrenciaTarefa']);

    // Monta a consulta SQL para inserir uma nova tarefa na tabela tbtarefas
    $sql = "INSERT INTO tbtarefas (
        tituloTarefa,
        descriçãoTarefa,
        dataConclusãoTarefa,
        horaConclusãoTarefa,
        dataLembreteTarefa,
        horaLembreteTarefa,
        recorrenciaTarefa
    ) VALUES (
        '{$tituloTarefa}',
        '{$descriçãoTarefa}',
        '{$dataConclusãoTarefa}',
        '{$horaConclusãoTarefa}',
        '{$dataLembreteTarefa}',
        '{$horaLembreteTarefa}',
        '{$recorrenciaTarefa}'
    )";

    // Executa a consulta SQL e verifica se a inserção foi bem-sucedida
    if (mysqli_query($conexao, $sql)) {
        // Se a inserção for bem-sucedida, exibe uma mensagem de sucesso
        ?>
        <div class="alert alert-success" role="alert"> 
            <h4 class="alert-heading">Inserir Tarefa</h4>
            <p>Tarefa inserida com sucesso!</p>
            <hr>
            <p class="mb-0">
                <a href="?menuop=tarefas">Voltar para a lista de tarefas.</a> <!-- Link para voltar à lista de tarefas -->
            </p>
        </div>
        <?php 
    } else {
        // Se ocorrer um erro na inserção, exibe uma mensagem de erro
        ?>
        <div class="alert alert-danger" role="alert">
            <h4 class="alert-heading">Erro</h4>
            <p>A tarefa não pode ser inserida: <?php echo mysqli_error($conexao); ?></p> <!-- Exibe o erro retornado pelo MySQL -->
            <hr>
            <p class="mb-0">
                <a href="?menuop=tarefas">Voltar para a lista de tarefas.</a> <!-- Link para voltar à lista de tarefas -->
            </p>
        </div>
        <?php 
    }
}
?>
<header>
    <h3>
        <i class="bi bi-calendar-check"></i> Inserir Evento <!-- Título da página que indica a funcionalidade de inserir uma nova Evento -->
    </h3>
</header>

<?php 

// Verifica se o método da requisição é POST, indicando que o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Escapa os dados recebidos do formulário para evitar SQL Injection
    $tituloEvento = mysqli_real_escape_string($conexao, $_POST['tituloEvento']);
    $descriçãoEvento = mysqli_real_escape_string($conexao, $_POST['descriçãoEvento']);
    $dataInícioEvento = mysqli_real_escape_string($conexao, $_POST['dataInícioEvento']);
    $horaInícioEvento = mysqli_real_escape_string($conexao, $_POST['horaInícioEvento']);
    $dataFimEvento = mysqli_real_escape_string($conexao, $_POST['dataFimEvento']);
    $horaFimEvento = mysqli_real_escape_string($conexao, $_POST['horaFimEvento']);
    
    // Monta a consulta SQL para inserir um novo Evento na tabela tbeventos
    $sql = "INSERT INTO tbeventos (
        tituloEvento,
        descriçãoEvento,
        dataInícioEvento,
        horaInícioEvento,
        dataFimEvento,
        horaFimEvento
    ) VALUES (
        '{$tituloEvento}',
        '{$descriçãoEvento}',
        '{$dataInícioEvento}',
        '{$horaInícioEvento}',
        '{$dataFimEvento}',
        '{$horaFimEvento}'
    )";

    // Executa a consulta SQL e verifica se a inserção foi bem-sucedida
    if (mysqli_query($conexao, $sql)) {
        // Se a inserção for bem-sucedida, exibe uma mensagem de sucesso
        ?>
        <div class="alert alert-success" role="alert"> 
            <h4 class="alert-heading">Inserir Evento</h4>
            <p>Evento inserida com sucesso!</p>
            <hr>
            <p class="mb-0">
                <a href="?menuop=eventos">Voltar para a lista de Eventos.</a> <!-- Link para voltar à lista de Eventos -->
            </p>
        </div>
        <?php 
    } else {
        // Se ocorrer um erro na inserção, exibe uma mensagem de erro
        ?>
        <div class="alert alert-danger" role="alert">
            <h4 class="alert-heading">Erro</h4>
            <p>A Evento não pode ser inserida: <?php echo mysqli_error($conexao); ?></p> <!-- Exibe o erro retornado pelo MySQL -->
            <hr>
            <p class="mb-0">
                <a href="?menuop=eventos">Voltar para a lista de Eventos.</a> <!-- Link para voltar à lista de Eventos -->
            </p>
        </div>
        <?php 
    }
}
?>
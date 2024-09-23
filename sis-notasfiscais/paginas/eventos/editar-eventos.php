<?php
// Recupera o parâmetro 'idEvento' da URL
$idEvento = $_GET['idEvento'];

// Cria a consulta SQL para selecionar todos os dados do Evento com o ID especificado
$sql = "SELECT * FROM tbeventos WHERE idEvento = '$idEvento'";

// Executa a consulta SQL e trata possíveis erros
$rs = mysqli_query($conexao, $sql) or die("Erro ao recuperar os dados do registro: " . mysqli_error($conexao));

// Obtém os dados do Evento como um array associativo
$dados = mysqli_fetch_assoc($rs);
?>
<header>
    <h3>
        <i class="bi bi-calendar-check"></i> Editar Eventos
    </h3>
</header>
<div>
    <!-- Formulário para editar o Evento -->
    <form class="needs-validation" action="index.php?menuop=atualizar-eventos" method="post" novalidate>
        <!-- Campo para o ID do Evento, somente leitura -->
        <div class="mb-3 col-3">
            <label for="idEvento" class="form-label">ID</label>
            <input class="form-control" type="text" name="idEvento" id="idEvento" value="<?= $dados["idEvento"] ?>" readonly>
        </div>
        
        <!-- Campo para o título do Evento -->
        <div class="mb-3">
            <label for="tituloEvento" class="form-label">Título</label>
            <input class="form-control" type="text" name="tituloEvento" id="tituloEvento" value="<?= $dados["tituloEvento"] ?>" required>
        </div>
        
        <!-- Campo para a descrição do Evento -->
        <div class="mb-3">
            <label for="descriçãoEvento" class="form-label">Descrição</label>
            <textarea name="descriçãoEvento" id="descriçãoEvento" cols="30" rows="10" class="form-control" required><?= htmlspecialchars($dados["descriçãoEvento"]) ?></textarea>
        </div>
        
        <!-- Campos para a data e hora de Início do Evento -->
        <div class="row">
            <div class="mb-3 col-3">
                <label for="dataInícioEvento" class="form-label">Data de Início</label>
                <input class="form-control" type="date" name="dataInícioEvento" value="<?= $dados["dataInícioEvento"] ?>" required id="dataInícioEvento">
            </div>
            <div class="mb-3 col-3">
                <label for="horaInícioEvento" class="form-label">Hora de Início</label>
                <input class="form-control" type="time" name="horaInícioEvento" value="<?= $dados["horaInícioEvento"] ?>" required id="horaInícioEvento">
            </div>
        </div>
        
        <!-- Campos para a data e hora de Fim do Evento -->
        <div class="row">
            <div class="mb-3 col-3">
                <label for="dataFimEvento" class="form-label">Data de Fim</label>
                <input class="form-control" type="date" name="dataFimEvento" id="dataFimEvento" value="<?= $dados["dataFimEvento"] ?>">
            </div>
            <div class="mb-3 col-3">
                <label for="horaFimEvento" class="form-label">Hora de Fim</label>
                <input class="form-control" type="time" name="horaFimEvento" id="horaFimEvento" value="<?= $dados["horaFimEvento"] ?>">
            </div>
        </div>
                      
        <!-- Botão para enviar o formulário -->
        <div class="mb-3">
            <input class="btn btn-success" type="submit" value="Atualizar" name="btnAtualizar">
        </div>
    </form>
</div>
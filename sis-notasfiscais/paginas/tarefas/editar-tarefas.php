<?php
// Recupera o parâmetro 'idTarefa' da URL
$idTarefa = $_GET['idTarefa'];

// Cria a consulta SQL para selecionar todos os dados da tarefa com o ID especificado
$sql = "SELECT * FROM tbtarefas WHERE idTarefa = '$idTarefa'";

// Executa a consulta SQL e trata possíveis erros
$rs = mysqli_query($conexao, $sql) or die("Erro ao recuperar os dados do registro: " . mysqli_error($conexao));

// Obtém os dados da tarefa como um array associativo
$dados = mysqli_fetch_assoc($rs);
?>
<header>
    <h3>
        <i class="bi bi-list-task"></i> Editar Tarefas
    </h3>
</header>
<div>
    <!-- Formulário para editar a tarefa -->
    <form class="needs-validation" action="index.php?menuop=inserir-tarefas" method="post" novalidate>
        <!-- Campo para o ID da tarefa, somente leitura -->
        <div class="mb-3 col-3">
            <label for="idTarefa" class="form-label">ID</label>
            <input class="form-control" type="text" name="idTarefa" id="idTarefa" value="<?= $dados["idTarefa"] ?>" readonly>
        </div>
        
        <!-- Campo para o título da tarefa -->
        <div class="mb-3">
            <label for="tituloTarefa" class="form-label">Título</label>
            <input class="form-control" type="text" name="tituloTarefa" id="tituloTarefa" value="<?= $dados["tituloTarefa"] ?>" required>
        </div>
        
        <!-- Campo para a descrição da tarefa -->
        <div class="mb-3">
            <label for="descriçãoTarefa" class="form-label">Descrição</label>
            <textarea name="descriçãoTarefa" id="descriçãoTarefa" cols="30" rows="10" class="form-control" required><?= htmlspecialchars($dados["descriçãoTarefa"]) ?></textarea>
        </div>
        
        <!-- Campos para a data e hora de conclusão da tarefa -->
        <div class="row">
            <div class="mb-3 col-3">
                <label for="dataConclusãoTarefa" class="form-label">Data de Conclusão</label>
                <input class="form-control" type="date" name="dataConclusãoTarefa" value="<?= $dados["dataConclusãoTarefa"] ?>" required id="dataConclusãoTarefa">
            </div>
            <div class="mb-3 col-3">
                <label for="horaConclusãoTarefa" class="form-label">Hora de Conclusão</label>
                <input class="form-control" type="time" name="horaConclusãoTarefa" value="<?= $dados["horaConclusãoTarefa"] ?>" required id="horaConclusãoTarefa">
            </div>
        </div>
        
        <!-- Campos para a data e hora de lembrete da tarefa -->
        <div class="row">
            <div class="mb-3 col-3">
                <label for="dataLembreteTarefa" class="form-label">Data de Lembrete</label>
                <input class="form-control" type="date" name="dataLembreteTarefa" id="dataLembreteTarefa" value="<?= $dados["dataLembreteTarefa"] ?>">
            </div>
            <div class="mb-3 col-3">
                <label for="horaLembreteTarefa" class="form-label">Hora de Lembrete</label>
                <input class="form-control" type="time" name="horaLembreteTarefa" id="horaLembreteTarefa" value="<?= $dados["horaLembreteTarefa"] ?>">
            </div>
        </div>
        
        <!-- Campo para a recorrência da tarefa -->
        <div class="row">
            <div class="mb-3 col-3">
                <label for="recorrenciaTarefa" class="form-label">Recorrência</label>
                <select name="recorrenciaTarefa" id="recorrenciaTarefa" class="form-select">
                    <!-- Opções para a recorrência da tarefa -->
                    <option value="0" <?= ($dados["recorrenciaTarefa"] == 0) ? "selected" : "" ?>>Não Recorrente</option>
                    <option value="1" <?= ($dados["recorrenciaTarefa"] == 1) ? "selected" : "" ?>>Diariamente</option>
                    <option value="2" <?= ($dados["recorrenciaTarefa"] == 2) ? "selected" : "" ?>>Semanalmente</option>
                    <option value="3" <?= ($dados["recorrenciaTarefa"] == 3) ? "selected" : "" ?>>Mensalmente</option>
                    <option value="4" <?= ($dados["recorrenciaTarefa"] == 4) ? "selected" : "" ?>>Anualmente</option>
                </select>
            </div>
        </div>
        
        <!-- Botão para enviar o formulário -->
        <div class="mb-3">
            <input class="btn btn-success" type="submit" value="Atualizar" name="btnAtualizar">
        </div>
    </form>
</div>
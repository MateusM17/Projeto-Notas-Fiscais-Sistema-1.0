<?php 
// Obtém o ID da nota a ser editada através do método GET
$idNota = $_GET["idNota"];

// Criação da consulta SQL para recuperar os dados da nota correspondente ao ID fornecido
$sql = "SELECT * FROM tbcontatos WHERE idNota = {$idNota}";
// Executando a consulta e manipulando erros de forma adequada
$rs = mysqli_query($conexao, $sql) or die("Erro ao recuperar os dados do registro: " . mysqli_error($conexao));

// Busca os dados retornados e os armazena em um array associativo
$dados = mysqli_fetch_assoc($rs);
?>

<header>
    <h3>Editar Nota</h3> <!-- Cabeçalho da seção que informa ao usuário que está na página de edição de notas -->
</header>

<div>
    <!-- Formulário que enviará os dados atualizados para a página de processamento 'index.php' -->
    <form action="index.php?menuop=atualizar-nota" method="post">
        
        <!-- Campo para exibir e editar o ID da nota -->
        <div class="mb-3">
            <label class="form-label" for="idNota">ID:</label>
            <div class="input-group">
                <span class="input-group-text">
                    <i class="bi bi-key-fill"></i>
                </span>
                <input class="form-control" type="text" name="idNota" value="<?=$dados["idNota"]?>">
            </div>  
        </div>

        <!-- Campo para exibir e editar o Nome da nota -->
        <div class="mb-3">
            <label class="form-label" for="nomeNota">Nome:</label>
            <div class="input-group">
                <span class="input-group-text">
                    <i class="bi bi-journal-plus"></i>
                </span>
                <input class="form-control" type="text" name="nomeNota" value="<?=$dados["nomeNota"]?>">
            </div>
        </div>

        <!-- Campo para exibir e editar o E-mail da nota -->
        <div class="mb-3">
            <label class="form-label" for="emailNota">E-mail:</label>
            <div class="input-group">
                <span class="input-group-text">
                    <i class="bi bi-envelope-at-fill"></i>
                </span>
                <input class="form-control" type="email" name="emailNota" value="<?=$dados["emailNota"]?>">
            </div>
        </div>

        <!-- Campo para exibir e editar o Telefone da nota -->
        <div class="mb-3">
            <label class="form-label" for="telefoneNota">Telefone:</label>
            <div class="input-group">
                <span class="input-group-text">
                    <i class="bi bi-telephone-fill"></i>
                </span>
                <input class="form-control" type="text" name="telefoneNota" value="<?=$dados["telefoneNota"]?>">
            </div>
        </div>

        <!-- Campo para exibir e editar o Endereço da nota -->
        <div class="mb-3">
            <label class="form-label" for="endereçoNota">Endereço:</label>
            <div class="input-group">
                <span class="input-group-text">
                    <i class="bi bi-mailbox2"></i>
                </span>
                <input class="form-control" type="text" name="endereçoNota" value="<?=$dados["endereçoNota"]?>">
            </div>
        </div>

        <!-- Seção para selecionar a Situação da Nota -->
        <div class="row mb-3">
            <div class="mb-3 col-4">
                <label class="form-label" for="situaçãoNota">Situação da Nota:</label>
                <div class="input-group">
                    <span class="input-group-text">
                        <i class="bi bi-diagram-2"></i>
                    </span>
                    <select class="form-select" name="situaçãoNota" id="situaçãoNota">
                        <option <?php echo ($dados['situaçãoNota']=='')?'selected':'' ?> value="">Selecione a situação da Nota</option>
                        <option <?php echo ($dados['situaçãoNota']=='P')?'selected':'' ?> value="P">PAGA</option>
                        <option <?php echo ($dados['situaçãoNota']=='A')?'selected':'' ?> value="A">ABERTA</option>
                    </select>
                </div>
            </div>

            <!-- Campo para exibir e editar a data de Emissão da Nota -->
            <div class="mb-3 col-3">
                <label class="form-label" for="emissãoNota">Emissão da Nota:</label>
                <div class="input-group">
                    <span class="input-group-text">
                        <i class="bi bi-calendar"></i>
                    </span>
                    <input class="form-control" type="date" name="emissãoNota" value="<?=$dados["emissãoNota"]?>">
                </div>
            </div>

            <!-- Campo para exibir e editar a data de Vencimento da Nota -->
            <div class="mb-3 col-3">
                <label class="form-label" for="vencimentoNota">Vencimento da Nota:</label>
                <div class="input-group">
                    <span class="input-group-text">
                        <i class="bi bi-calendar"></i>
                    </span>
                    <input class="form-control" type="date" name="vencimentoNota" value="<?=$dados["vencimentoNota"]?>">
                </div>
            </div>
        </div>

        <!-- Botão para enviar o formulário e atualizar a nota -->
        <div class="mb-3">
            <input class="btn btn-warning" type="submit" value="Atualizar" name="btnAtualizar">
        </div>
    </form>
</div>
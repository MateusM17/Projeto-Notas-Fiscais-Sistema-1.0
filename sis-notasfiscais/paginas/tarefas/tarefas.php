<?php

// Inicializa a variável para armazenar o texto de pesquisa, caso tenha sido enviado via POST
$txt_pesquisa = (isset($_POST["txt_pesquisa"])) ? $_POST["txt_pesquisa"] : "";

// Alterna o status da tarefa entre concluído (1) e não concluído (0)
$idTarefa = (isset($_GET['idTarefa'])) ? (int)$_GET['idTarefa'] : 0; // Conversão para inteiro para evitar SQL Injection
$statusTarefa = (isset($_GET['statusTarefa']) && $_GET['statusTarefa'] == '0') ? '1' : '0';

// Somente execute a atualização se o ID da tarefa for válido (maior que 0)
if ($idTarefa > 0) {
    // Prepara a consulta SQL para atualizar o status da tarefa
    $sql = "UPDATE tbtarefas SET statusTarefa = {$statusTarefa} WHERE idTarefa = {$idTarefa}";
    
    // Executa a consulta e lida com possíveis erros
    mysqli_query($conexao, $sql) or die("Erro ao atualizar a tarefa: " . mysqli_error($conexao));
}
// ----------------------------------------------


?>

<header>
    <h3><i class="bi bi-list-task"></i> Tarefas</h3> <!-- Cabeçalho da seção de tarefas -->
</header>

<div>
    <!-- Botão para adicionar uma nova tarefa -->
    <a class="btn btn-outline-secondary mb-2" href="index.php?menuop=cad-tarefas"><i class="bi bi-list-task"></i> Nova Tarefa</a>
</div>

<div>
    <!-- Formulário de pesquisa de tarefas -->
    <form action="index.php?menuop=tarefas" method="post">
        <div class="input-group">
            <input class="form-control" type="text" name="txt_pesquisa" value="<?=$txt_pesquisa?>"> <!-- Campo de pesquisa -->
            <button class="btn btn-outline-success btn-sm" type="submit"><i class="bi bi-search"></i>Pesquisar</button>
        </div>
    </form>
</div>

<div class="tabela">
    <!-- Tabela para exibir a lista de tarefas -->
    <table class="table table-dark table-hover table-bordered table-sm">
        <thead>
            <tr>
                <th>Status</th>
                <th>Título</th>
                <th>Descrição</th>
                <th>Data da Conclusão</th>
                <th>Hora da Conclusão</th>
                <th>Editar</th>
                <th>Excluir</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            
            // Define quantas tarefas exibir por página
            $quantidade = 10;

            // Obtém o número da página atual da URL, se não for definido, utiliza a página 1
            $pagina = (isset($_GET['pagina'])) ? (int)$_GET['pagina'] : 1;

            // Calcula o início da consulta com base no número da página atual
            $inicio = ($quantidade * $pagina) - $quantidade; // (10 * 2) - 10 = 10, por exemplo
            
            // Prepara e executa a consulta para selecionar as tarefas, permitindo pesquisa por título, descrição ou data
            $sql = "SELECT
                        idTarefa, 
                        statusTarefa,
                        tituloTarefa,
                        descriçãoTarefa,
                        DATE_FORMAT(dataConclusãoTarefa, '%d/%m/%Y') AS dataConclusãoTarefa,
                        horaConclusãoTarefa
                    FROM tbtarefas
                    WHERE
                        tituloTarefa LIKE '%{$txt_pesquisa}%' OR     
                        descriçãoTarefa LIKE '%{$txt_pesquisa}%' OR
                        DATE_FORMAT(dataConclusãoTarefa, '%d/%m/%Y') LIKE '%{$txt_pesquisa}%'
                    ORDER BY statusTarefa, dataConclusãoTarefa
                    LIMIT $inicio, $quantidade";

            // Executa a consulta e lida com possíveis erros
            $rs = mysqli_query($conexao, $sql) or die("Erro ao executar a consulta!" . mysqli_error($conexao));
            
            // Loop para criar as linhas da tabela a partir dos resultados da consulta
            while ($dados = mysqli_fetch_assoc($rs)) {
            ?>
            <tr>
                <td>
                    <!-- Botão para alterar o status da tarefa -->
                    <a class="btn btn-secondary btn-sm" href="index.php?menuop=tarefas&pagina=<?=$pagina?>&idTarefa=<?=$dados['idTarefa']?>&statusTarefa=<?=$dados['statusTarefa']?>">
                        <?php 
                        // Mostra um ícone dependendo do status da tarefa
                        if ($dados['statusTarefa'] == 0) {
                            echo '<i class="bi bi-square"></i>'; // Tarefa não concluída
                        } else {
                            echo '<i class="bi bi-check-square"></i>'; // Tarefa concluída
                        }
                        ?>
                    </a>
                </td>
                <td class="text-nowrap"><?=$dados["tituloTarefa"]?></td>
                <td class="text-nowrap"><?=$dados["descriçãoTarefa"]?></td>
                <td class="text-nowrap"><?=$dados["dataConclusãoTarefa"]?></td>
                <td class="text-nowrap"><?=$dados["horaConclusãoTarefa"]?></td>
                <td class="text-center">
                    <!-- Botão para editar a tarefa -->
                    <a class="btn btn-outline-warning btn-sm" href="index.php?menuop=editar-tarefas&idTarefa=<?=$dados["idTarefa"] ?>"><i class="bi bi-pencil-square"></i></a>
                </td>
                <td class="text-center">
                    <!-- Botão para excluir a tarefa -->
                    <a class="btn btn-outline-danger btn-sm" href="index.php?menuop=excluir-tarefas&idTarefa=<?=$dados["idTarefa"] ?>"><i class="bi bi-trash-fill"></i></a>
                </td>
            </tr>
            <?php 
            }
            ?>
        </tbody>
    </table>
</div>

<!-- Paginação abaixo da tabela -->
<ul class="pagination justify-content-center">
    <br>
    <?php 
    // Consulta para contar o total de tarefas
    $sqlTotal = "SELECT idTarefa FROM tbtarefas";
    $qrTotal = mysqli_query($conexao, $sqlTotal) or die(mysqli_error($conexao));
    $numTotal = mysqli_num_rows($qrTotal);
    
    // Calcula o número total de páginas
    $totalPagina = ceil($numTotal / $quantidade);
    echo "<li class='page-item'><span class='page-link'>Total de Registros: " . $numTotal . " </span></li>"; 
    echo '<li class="page-item"><a class="page-link" href="?menuop=tarefas&pagina=1">Primeira Página</a></li>';
    
    // Botão para página anterior, se não estiver nas primeiras 6 páginas
    if ($pagina > 6) {
    ?>
    <li class="page-item"><a class="page-link" href="?menuop=tarefas&pagina=<?php echo $pagina - 1 ?>"> <<</a></li>
    <?php 
    }
    
    // Loop para mostrar os números das páginas
    for ($i = 1; $i <= $totalPagina; $i++) {
        if ($i >= ($pagina - 5) && $i <= ($pagina + 5)) {
            if ($i == $pagina) {
                echo "<li class='page-item active'><span class='page-link'>$i</span></li>"; // Página atual
            } else {
                echo "<li class='page-item'><a class='page-link' href=\"?menuop=tarefas&pagina=$i\">$i</a></li>";
            }
        }
    }
    
    // Botão para próxima página, se não estiver nas últimas 5 páginas
    if ($pagina < ($totalPagina - 5)) {
    ?>
    <li class="page-item"><a class="page-link" href="?menuop=tarefas&pagina=<?php echo $pagina + 1 ?>"> >></a></li>
    <?php 
    }
    echo "<li class='page-item'> <a class='page-link' href=\"?menuop=tarefas&pagina=$totalPagina\">Última Página</a></li>";
    ?>
</ul>
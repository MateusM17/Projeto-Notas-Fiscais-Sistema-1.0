<?php

// Inicializa a variável para armazenar o texto de pesquisa, caso tenha sido enviado via POST
$txt_pesquisa = (isset($_POST["txt_pesquisa"])) ? $_POST["txt_pesquisa"] : "";

// Alterna o status do Evento entre concluído (1) e não concluído (0)
$idEvento = (isset($_GET['idEvento'])) ? (int)$_GET['idEvento'] : 0; // Conversão para inteiro 
$statusEvento = (isset($_GET['statusEvento']) && $_GET['statusEvento'] == '0') ? '1' : '0';

// Somente execute a atualização se o ID do Evento for válido (maior que 0)
if ($idEvento > 0) {
    // Prepara a consulta SQL para atualizar o status do Evento
    $sql = "UPDATE tbeventos SET statusEvento = {$statusEvento} WHERE idEvento = {$idEvento}";
    
    // Executa a consulta e lida com possíveis erros
    mysqli_query($conexao, $sql) or die("Erro ao atualizar o Evento: " . mysqli_error($conexao));
}

?>

<header>
    <h3><i class="bi bi-calendar-check"></i> Eventos</h3>
</header>

<div>
    <a class="btn btn-outline-secondary mb-2" href="index.php?menuop=cad-eventos"><i class="bi bi-list-task"></i> Novo Evento</a>
</div>

<div>
    <form action="index.php?menuop=eventos" method="post">
        <div class="input-group">
            <input class="form-control" type="text" name="txt_pesquisa" value="<?= htmlspecialchars($txt_pesquisa) ?>"> 
            <button class="btn btn-outline-success btn-sm" type="submit"><i class="bi bi-search"></i>Pesquisar</button>
        </div>
    </form>
</div>

<div class="tabela">
    <table class="table table-dark table-hover table-bordered table-sm">
        <thead>
            <tr>
                <th>Status</th>
                <th>Título</th>
                <th>Descrição</th>
                <th>Data de Início</th>
                <th>Hora de Início</th>
                <th>Data de Fim</th>
                <th>Hora de Fim</th>
                <th>Editar</th>
                <th>Excluir</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            
            // Define quantos Eventos exibir por página
            $quantidade = 10;

            // Obtém o número da página atual da URL
            $pagina = (isset($_GET['pagina'])) ? (int)$_GET['pagina'] : 1;

            // Calcula o início da consulta com base no número da página atual
            $inicio = ($quantidade * $pagina) - $quantidade; 
            
            // Prepara e executa a consulta para selecionar os Eventos
            $sql = "SELECT
                        idEvento, 
                        statusEvento,
                        tituloEvento,
                        descriçãoEvento,
                        DATE_FORMAT(dataInícioEvento, '%d/%m/%Y') AS dataInícioEvento,
                        horaInícioEvento,
                        DATE_FORMAT(dataFimEvento, '%d/%m/%Y') AS dataFimEvento,
                        horaFimEvento
                    FROM tbeventos
                    WHERE
                        tituloEvento LIKE '%{$txt_pesquisa}%' OR     
                        descriçãoEvento LIKE '%{$txt_pesquisa}%' OR
                        DATE_FORMAT(dataInícioEvento, '%d/%m/%Y') LIKE '%{$txt_pesquisa}%'
                    ORDER BY statusEvento, dataInícioEvento
                    LIMIT $inicio, $quantidade";

            // Executa a consulta e lida com possíveis erros
            $rs = mysqli_query($conexao, $sql) or die("Erro ao executar a consulta!" . mysqli_error($conexao));
            
            // Loop para criar as linhas da tabela a partir dos resultados da consulta
            while ($dados = mysqli_fetch_assoc($rs)) {
            ?>
            <tr>
                <td>
                    <a class="btn btn-secondary btn-sm" href="index.php?menuop=eventos&pagina=<?=$pagina?>&idEvento=<?=$dados['idEvento']?>&statusEvento=<?=$dados['statusEvento']?>">
                        <?php 
                        // Mostra um ícone dependendo do status do Evento
                        if ($dados['statusEvento'] == 0) {
                            echo '<i class="bi bi-square"></i>'; // Evento não concluído
                        } else {
                            echo '<i class="bi bi-check-square"></i>'; // Evento concluído
                        }
                        ?>
                    </a>
                </td>
                <td class="text-nowrap"><?= htmlspecialchars($dados["tituloEvento"]) ?></td>
                <td class="text-nowrap"><?= htmlspecialchars($dados["descriçãoEvento"]) ?></td>
                <td class="text-nowrap"><?= htmlspecialchars($dados["dataInícioEvento"]) ?></td>
                <td class="text-nowrap"><?= htmlspecialchars($dados["horaInícioEvento"]) ?></td>
                <td class="text-nowrap"><?= htmlspecialchars($dados["dataFimEvento"]) ?></td>
                <td class="text-nowrap"><?= htmlspecialchars($dados["horaFimEvento"]) ?></td>
                <td class="text-center">
                    <a class="btn btn-outline-warning btn-sm" href="index.php?menuop=editar-eventos&idEvento=<?=$dados["idEvento"] ?>"><i class="bi bi-pencil-square"></i></a>
                </td>
                <td class="text-center">
                    <a class="btn btn-outline-danger btn-sm" href="index.php?menuop=excluir-eventos&idEvento=<?=$dados["idEvento"] ?>"><i class="bi bi-trash-fill"></i></a>
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
    // Consulta para contar o total de Eventos
    $sqlTotal = "SELECT idEvento FROM tbeventos";
    $qrTotal = mysqli_query($conexao, $sqlTotal) or die(mysqli_error($conexao));
    $numTotal = mysqli_num_rows($qrTotal);
    
    // Calcula o número total de páginas
    $totalPagina = ceil($numTotal / $quantidade);
    echo "<li class='page-item'><span class='page-link'>Total de Registros: " . $numTotal . " </span></li>"; 
    echo '<li class="page-item"><a class="page-link" href="?menuop=eventos&pagina=1">Primeira Página</a></li>';
    
    // Botão para página anterior, se não estiver nas primeiras 6 páginas
    if ($pagina > 6) {
        echo '<li class="page-item"><a class="page-link" href="?menuop=eventos&pagina=' . ($pagina - 1) . '"> <<</a></li>';
    }
    
    // Loop para mostrar os números das páginas
    for ($i = 1; $i <= $totalPagina; $i++) {
        if ($i >= ($pagina - 5) && $i <= ($pagina + 5)) {
            if ($i == $pagina) {
                echo "<li class='page-item active'><span class='page-link'>$i</span></li>"; // Página atual
            } else {
                echo "<li class='page-item'><a class='page-link' href=\"?menuop=eventos&pagina=$i\">$i</a></li>";
            }
        }
    }
    
    // Botão para próxima página, se não estiver nas últimas 5 páginas
    if ($pagina < ($totalPagina - 5)) {
        echo '<li class="page-item"><a class="page-link" href="?menuop=eventos&pagina=' . ($pagina + 1) . '"> >></a></li>';
    }
    echo "<li class='page-item'><a class='page-link' href=\"?menuop=eventos&pagina=$totalPagina\">Última Página</a></li>";
    ?>
</ul>
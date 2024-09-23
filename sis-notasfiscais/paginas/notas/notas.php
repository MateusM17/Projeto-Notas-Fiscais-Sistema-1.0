<?php 
// Variável para armazenar o texto da pesquisa, se fornecido
$txt_pesquisa = (isset($_POST["txt_pesquisa"])) ? $_POST["txt_pesquisa"] : "";
?>

<header>
    <h3><i class="bi bi-card-checklist"></i> Notas</h3> <!-- Título da seção -->
</header>

<div>
    <a class="btn btn-outline-secondary mb-2" href="index.php?menuop=cad-notas">
        <i class="bi bi-journal-plus"></i> Nova Nota
    </a> <!-- Botão para criar uma nova nota -->
</div>

<div>
    <!-- Formulário para pesquisa de notas -->
    <form action="index.php?menuop=notas" method="post">
        <div class="input-group">
            <input class="form-control" type="text" name="txt_pesquisa" value="<?=$txt_pesquisa?>"> <!-- Campo de entrada de pesquisa -->
            <button class="btn btn-outline-success btn-sm" type="submit">
                <i class="bi bi-search"></i> Pesquisar
            </button> <!-- Botão de pesquisa -->
        </div>
    </form>
</div>

<div class="tabela">
    <table class="table table-dark table-hover table-bordered table-sm">
        <thead> <!-- Corrigido de <thread> para <thead> -->
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>E-mail</th>
                <th>Telefone</th>
                <th>Endereço</th>
                <th>Situação</th>
                <th>Data da Emissão</th>
                <th>Data de Vencimento</th>
                <th>Editar</th>
                <th>Excluir</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            // Configurações de paginação
            $quantidade = 10; // Número de registros por página
            $pagina = (isset($_GET['pagina'])) ? (int)$_GET['pagina'] : 1; // Pega o número da página atual
            $inicio = ($quantidade * $pagina) - $quantidade; // Calcula o início dos registros

            // Consulta SQL para selecionar notas com base na pesquisa
            $sql = "
            SELECT 
                idNota,
                upper(nomeNota) AS nomeNota,
                lower(emailNota) AS emailNota,
                telefoneNota,
                upper(endereçoNota) AS endereçoNota,
                CASE
                    WHEN situaçãoNota = 'A' THEN 'ABERTA'
                    WHEN situaçãoNota = 'P' THEN 'PAGA'
                    ELSE 'NÃO ESPECIFICADO'
                END AS situaçãoNota,
                date_format(emissãoNota, '%d/%m/%Y') AS emissãoNota,
                date_format(vencimentoNota, '%d/%m/%Y') AS vencimentoNota
            FROM tbcontatos 
            WHERE 
                idNota='{$txt_pesquisa}' OR
                nomeNota LIKE '%{$txt_pesquisa}%'
            ORDER BY nomeNota ASC
            LIMIT $inicio, $quantidade"; // Limita o número de resultados a exibir

            // Executa a consulta SQL e trata erros
            $rs = mysqli_query($conexao, $sql) or die("Erro ao executar a consulta!" . mysqli_error($conexao));

            // Loop para exibir os resultados na tabela
            while ($dados = mysqli_fetch_assoc($rs)) {
            ?>
                <tr>
                    <td><?=$dados["idNota"]?></td>
                    <td class="text-nowrap"><?=$dados["nomeNota"]?></td>
                    <td class="text-nowrap"><?=$dados["emailNota"]?></td>
                    <td class="text-nowrap"><?=$dados["telefoneNota"]?></td>
                    <td class="text-nowrap"><?=$dados["endereçoNota"]?></td>
                    <td><?=$dados["situaçãoNota"]?></td>
                    <td><?=$dados["emissãoNota"]?></td>
                    <td><?=$dados["vencimentoNota"]?></td>
                    <td class="text-center">
                        <!-- Botão para editar a nota -->
                        <a class="btn btn-outline-warning btn-sm" href="index.php?menuop=editar-nota&idNota=<?=$dados["idNota"]?>">
                            <i class="bi bi-pencil-square"></i>
                        </a>
                    </td>
                    <td class="text-center">
                        <!-- Botão para excluir a nota -->
                        <a class="btn btn-outline-danger btn-sm" href="index.php?menuop=excluir-nota&idNota=<?=$dados["idNota"]?>">
                            <i class="bi bi-trash-fill"></i>
                        </a>
                    </td>
                </tr>
            <?php 
            }
            ?>
        </tbody>
    </table>
</div>

<!-- Paginação -->
<ul class="pagination justify-content-center">
    <br>
    <?php 
    // Consulta para contar o total de notas
    $sqlTotal = "SELECT idNota FROM tbcontatos";
    $qrTotal = mysqli_query($conexao, $sqlTotal) or die(mysqli_error($conexao));
    $numTotal = mysqli_num_rows($qrTotal); // Total de registros
    $totalPagina = ceil($numTotal / $quantidade); // Total de páginas

    // Exibe o total de registros
    echo "<li class='page-item'><span class='page-link'>Total de Registros: " . $numTotal . " </span></li>"; 
    echo '<li class="page-item"><a class="page-link" href="?menuop=notas&pagina=1">Primeira Página</a></li>'; // Link para a primeira página

    // Link para a página anterior, se não for a primeira
    if ($pagina > 6) {
    ?>
        <li class="page-item"><a class="page-link" href="?menuop=notas&pagina=<?php echo $pagina - 1; ?>"> <<</a></li>
    <?php 
    }

    // Loop para criar links para as páginas
    for ($i = 1; $i <= $totalPagina; $i++) {
        // Exibe links apenas para páginas próximas à atual
        if ($i >= ($pagina - 5) && $i <= ($pagina + 5)) {
            if ($i == $pagina) {
                echo "<li class='page-item active'><span class='page-link'>$i</span></li>"; // Página ativa
            } else {
                echo "<li class='page-item'><a class='page-link' href=\"?menuop=notas&pagina=$i\">$i</a></li>"; // Link para página
            }
        }
    }

    // Link para a próxima página, se não for a última
    if ($pagina < ($totalPagina - 5)) {
    ?>
        <li class="page-item"><a class="page-link" href="?menuop=notas&pagina=<?php echo $pagina + 1; ?>">>></a></li>
    <?php 
    }

    // Link para a última página
    echo "<li class='page-item'><a class='page-link' href=\"?menuop=notas&pagina=$totalPagina\">Última Página</a></li>";
    ?>
</ul>
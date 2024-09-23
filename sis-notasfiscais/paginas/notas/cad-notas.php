<header>
    <h3><i class="bi bi-card-checklist"></i> Cadastro de Notas</h3> <!-- Cabeçalho da seção de cadastro, com um ícone representativo -->
</header>
<div>
    <!-- Formulário para cadastro de notas, utilizando o método POST para enviar os dados -->
    <form class="needs-validation" action="index.php?menuop=inserir-notas" method="post" novalidate>
        
        <!-- Campo para entrada da Nota -->
        <div class="mb-3">
            <label class="form-label" for="nomeNota">Nota:</label>
            <div class="input-group">
                <span class="input-group-text"><i class="bi bi-journal-plus"></i></span>
                <input class="form-control" type="text" name="nomeNota" required> <!-- Campo obrigatório -->
                <div class="valid-feedback">Está Correto.</div> <!-- Mensagem de feedback positivo para validação -->
                <div class="invalid-feedback">Campo Obrigatório de no máximo 255 caracteres.</div> <!-- Mensagem de feedback negativo -->
            </div>
        </div>

        <!-- Campo para entrada do E-mail -->
        <div class="mb-3">
            <label class="form-label" for="emailNota">E-mail:</label>
            <div class="input-group">
                <span class="input-group-text"><i class="bi bi-envelope-at-fill"></i></span>
                <input class="form-control" type="email" name="emailNota" required> <!-- Campo obrigatório, espera um e-mail -->
                <div class="valid-feedback">Está Correto.</div>
                <div class="invalid-feedback">Campo Obrigatório para um e-mail.</div>
            </div>
        </div>

        <!-- Campo para entrada do Telefone -->
        <div class="mb-3">
            <label class="form-label" for="telefoneNota">Telefone:</label>
            <div class="input-group">
                <span class="input-group-text"><i class="bi bi-telephone-fill"></i></span>
                <input class="form-control" type="text" name="telefoneNota" required> <!-- Campo obrigatório -->
                <div class="valid-feedback">Está Correto.</div>
                <div class="invalid-feedback">Campo Obrigatório, adicione um telefone.</div>
            </div>
        </div>

        <!-- Campo para entrada do Endereço -->
        <div class="mb-3">
            <label class="form-label" for="endereçoNota">Endereço:</label>
            <div class="input-group">
                <span class="input-group-text"><i class="bi bi-mailbox2"></i></span>
                <input class="form-control" type="text" name="endereçoNota" required> <!-- Campo obrigatório -->
                <div class="valid-feedback">Está Correto.</div>
                <div class="invalid-feedback">Campo Obrigatório, adicione um endereço.</div>
            </div>
        </div>

        <!-- Campo para selecionar a Situação da Nota -->
        <div class="mb-3">
            <label class="form-label" for="situaçãoNota">Situação da Nota:</label>
            <div class="input-group">
                <span class="input-group-text"><i class="bi bi-diagram-2"></i></span>
                <select class="form-select" name="situaçãoNota" id="situaçãoNota" required> <!-- Campo obrigatório -->
                    <option selected value="">Selecione a situação da Nota</option> <!-- Opção padrão -->
                    <option value="P">PAGA</option> <!-- Opção de situação -->
                    <option value="A">ABERTA</option> <!-- Opção de situação -->
                </select>
            </div>
        </div>

        <!-- Seção para entrada de datas de Emissão e Vencimento -->
        <div class="row mb-3">
            <!-- Campo para Emissão da Nota -->
            <div class="col-md-6">
                <label class="form-label" for="emissãoNota">Emissão da Nota:</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-calendar"></i></span>
                    <input class="form-control" type="date" name="emissãoNota" required> <!-- Campo obrigatório -->
                    <div class="valid-feedback">Está Correto.</div>
                    <div class="invalid-feedback">Campo Obrigatório, adicione uma data.</div>
                </div>
            </div>
            <!-- Campo para Vencimento da Nota -->
            <div class="col-md-6">
                <label class="form-label" for="vencimentoNota">Vencimento da Nota:</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-calendar"></i></span>
                    <input class="form-control" type="date" name="vencimentoNota" required> <!-- Campo obrigatório -->
                    <div class="valid-feedback">Está Correto.</div>
                    <div class="invalid-feedback">Campo Obrigatório, adicione uma data.</div>
                </div>
            </div>
        </div>

        <!-- Botão para enviar o formulário -->
        <div>
            <input class="btn btn-success" type="submit" value="Adicionar" name="btnAdicionar"> <!-- Botão de submissão do formulário -->
        </div>
    </form>
</div>
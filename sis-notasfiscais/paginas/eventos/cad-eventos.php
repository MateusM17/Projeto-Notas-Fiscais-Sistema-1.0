<header>
    <h3>
        <i class="bi bi-calendar-check"></i> Cadastro de Eventos
    </h3>
</header>

<div>
    <!-- Formulário para adicionar novos Eventos -->
    <form class="needs-validation" action="index.php?menuop=inserir-eventos" method="post" novalidate>
        
        <!-- Campo para o título do Evento -->
        <div class="mb-3">
            <label for="tituloEvento" class="form-label">Título</label>
            <input class="form-control" type="text" name="tituloEvento" id="tituloEvento" required>
            <!-- O atributo 'required' garante que o campo não possa ser deixado em branco -->
        </div>
        
        <!-- Campo para a descrição do Evento -->
        <div class="mb-3">
            <label for="descriçãoEvento" class="form-label">Descrição</label>
            <textarea name="descriçãoEvento" id="descriçãoEvento" cols="30" rows="10" class="form-control" required></textarea>
            <!-- O atributo 'required' garante que o campo não possa ser deixado em branco -->
        </div>
        
        <!-- Campos para a data e hora de Início do Evento -->
        <div class="row">
            <div class="mb-3 col-3">
                <label for="dataInícioEvento" class="form-label">Data de Início</label>
                <input class="form-control" type="date" name="dataInícioEvento" required id="dataInícioEvento">
                <!-- O atributo 'required' garante que a data de Início seja fornecida -->
            </div>
            <div class="mb-3 col-3">
                <label for="horaInícioEvento" class="form-label">Hora de Início</label>
                <input class="form-control" type="time" name="horaInícioEvento" required id="horaInícioEvento">
                <!-- O atributo 'required' garante que a hora de Início seja fornecida -->
            </div>
        </div>
        
        <!-- Campos para a data e hora de Fim da Evento (opcionais) -->
        <div class="row">
            <div class="mb-3 col-3">
                <label for="dataFimEvento" class="form-label">Data de Fim</label>
                <input class="form-control" type="date" name="dataFimEvento" id="dataFimEvento">
                <!-- Este campo é opcional, a data de Fim pode ser deixada em branco -->
            </div>
            <div class="mb-3 col-3">
                <label for="horaFimEvento" class="form-label">Hora de Fim</label>
                <input class="form-control" type="time" name="horaFimEvento" id="horaFimEvento">
                <!-- Este campo é opcional, a hora de Fim pode ser deixada em branco -->
            </div>
        </div>
                      
        <!-- Botão para enviar o formulário -->
        <div class="mb-3">
            <input class="btn btn-success" type="submit" value="Adicionar" name="btnAdicionar">
            <!-- O botão 'Adicionar' envia o formulário para o processamento -->
        </div>
    </form>
</div>
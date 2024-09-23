<header>
    <h3>
        <i class="bi bi-list-task"></i> Cadastro de Tarefas
    </h3>
</header>

<div>
    <!-- Formulário para adicionar novas tarefas -->
    <form class="needs-validation" action="index.php?menuop=inserir-tarefas" method="post" novalidate>
        
        <!-- Campo para o título da tarefa -->
        <div class="mb-3">
            <label for="tituloTarefa" class="form-label">Título</label>
            <input class="form-control" type="text" name="tituloTarefa" id="tituloTarefa" required>
            <!-- O atributo 'required' garante que o campo não possa ser deixado em branco -->
        </div>
        
        <!-- Campo para a descrição da tarefa -->
        <div class="mb-3">
            <label for="descriçãoTarefa" class="form-label">Descrição</label>
            <textarea name="descriçãoTarefa" id="descriçãoTarefa" cols="30" rows="10" class="form-control" required></textarea>
            <!-- O atributo 'required' garante que o campo não possa ser deixado em branco -->
        </div>
        
        <!-- Campos para a data e hora de conclusão da tarefa -->
        <div class="row">
            <div class="mb-3 col-3">
                <label for="dataConclusãoTarefa" class="form-label">Data de Conclusão</label>
                <input class="form-control" type="date" name="dataConclusãoTarefa" required id="dataConclusãoTarefa">
                <!-- O atributo 'required' garante que a data de conclusão seja fornecida -->
            </div>
            <div class="mb-3 col-3">
                <label for="horaConclusãoTarefa" class="form-label">Hora de Conclusão</label>
                <input class="form-control" type="time" name="horaConclusãoTarefa" required id="horaConclusãoTarefa">
                <!-- O atributo 'required' garante que a hora de conclusão seja fornecida -->
            </div>
        </div>
        
        <!-- Campos para a data e hora de lembrete da tarefa (opcionais) -->
        <div class="row">
            <div class="mb-3 col-3">
                <label for="dataLembreteTarefa" class="form-label">Data de Lembrete</label>
                <input class="form-control" type="date" name="dataLembreteTarefa" id="dataLembreteTarefa">
                <!-- Este campo é opcional, a data de lembrete pode ser deixada em branco -->
            </div>
            <div class="mb-3 col-3">
                <label for="horaLembreteTarefa" class="form-label">Hora de Lembrete</label>
                <input class="form-control" type="time" name="horaLembreteTarefa" id="horaLembreteTarefa">
                <!-- Este campo é opcional, a hora de lembrete pode ser deixada em branco -->
            </div>
        </div>
        
        <!-- Campo para selecionar a recorrência da tarefa -->
        <div class="row">
            <div class="mb-3 col-3">
                <label for="recorrenciaTarefa" class="form-label">Recorrência</label>
                <select name="recorrenciaTarefa" id="recorrenciaTarefa" class="form-select">
                    <!-- Opções de recorrência para a tarefa -->
                    <option value="0">Não Recorrente</option>
                    <option value="1">Diariamente</option>
                    <option value="2">Semanalmente</option>
                    <option value="3">Mensalmente</option>
                    <option value="4">Anualmente</option>
                </select>
            </div>
        </div>
        
        <!-- Botão para enviar o formulário -->
        <div class="mb-3">
            <input class="btn btn-success" type="submit" value="Adicionar" name="btnAdicionar">
            <!-- O botão 'Adicionar' envia o formulário para o processamento -->
        </div>
    </form>
</div>
// Exemplo de JavaScript inicial para desabilitar envios de formulário se houver campos inválidos
(() => {
  'use strict' // Habilita o modo estrito, que ajuda a evitar erros comuns

  // Seleciona todos os formulários que desejamos aplicar estilos de validação personalizados do Bootstrap
  const forms = document.querySelectorAll('.needs-validation')

  // Itera sobre cada formulário selecionado
  Array.from(forms).forEach(form => {
      // Adiciona um evento para o envio do formulário
      form.addEventListener('submit', event => {
          // Verifica se o formulário é válido
          if (!form.checkValidity()) {
              // Se o formulário não é válido, previne o envio
              event.preventDefault()
              event.stopPropagation() // Impede a propagação do evento para outros elementos
          }

          // Adiciona a classe 'was-validated' ao formulário para aplicar estilos de validação do Bootstrap
          form.classList.add('was-validated')
      }, false) // O terceiro parâmetro 'false' indica que o evento deve ser tratado na fase de captura
  })
})() // IIFE (Immediately Invoked Function Expression) que mantém o escopo limitado
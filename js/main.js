const form = document.getElementById('formCadastro');
const mensagem = document.getElementById('mensagem');

form.addEventListener('submit', function (event) {
    const nome = document.getElementById('nome').value.trim();
    const email = document.getElementById('email').value.trim();

    if (!nome || !email) {
        mensagem.textContent = "Preencha os campos!";
        mensagem.style.color = "red";
        event.preventDefault();
        return;
    }

    mensagem.textContent = "Enviando...";
    mensagem.style.color = "green";
});

// TELEFONE
document.getElementById('telefone').addEventListener('input', function () {
    let numbers = this.value.replace(/\D/g, '');
    numbers = numbers.substring(0, 11);

    let formatted = "+55 ";

    if (numbers.length > 0) {
        formatted += numbers.substring(0, 2);
    }

    if (numbers.length > 2) {
        formatted += " " + numbers.substring(2, 7);
    }

    if (numbers.length > 7) {
        formatted += "-" + numbers.substring(7, 11);
    }

    this.value = formatted;
});

// CPF
document.getElementById('cpf').addEventListener('input', function () {
    let value = this.value.replace(/\D/g, '');
    value = value.substring(0, 11);

    value = value.replace(/(\d{3})(\d)/, "$1.$2");
    value = value.replace(/(\d{3})(\d)/, "$1.$2");
    value = value.replace(/(\d{3})(\d{1,2})$/, "$1-$2");

    this.value = value;
});

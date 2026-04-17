const form = document.getElementById('formCadastro'); // Input Formulário
const input_nome = document.getElementById('nome'); // Input Nome
const input_email = document.getElementById('email'); // Input Email
const input_telefone = document.getElementById('telefone'); // Input  Telefone
const input_cpf = document.getElementById('cpf'); // Input CPF
const input_dataNascimento = document.getElementById('dataNascimento'); // Input DataNascimento
const mensagem = document.getElementById('mensagem');

form.addEventListener('submit', function (event) { //Se algum botão do Formulário com a tag "submit" for pressionado, executa.
    event.preventDefault();  
    const untrimmedtelefone = input_telefone.value; // Telefone sem Formtação
    const untrimmedcpf = input_telefone.value; // CPF sem Formtação
    const data = { // "Compila" os dados em uma lista.
    nome: input_nome.value.trim(), // Nome formatado
    email: input_email.value.trim(), // Email Formatado
    telefone: input_telefone.value.replace(/\D/g, ''), // Telefone Formatado
    cpf: input_cpf.value.replace(/\D/g, ''), // CPF Formatdo
    dataNascimento: input_dataNascimento.value.trim() // Data Nascimento Formatado
    };
    if (!data.nome || !data.email || !data.telefone || !data.cpf || !data.dataNascimento) { /// Verifica se os campos nome, email e telefone estão preenchidos
        mensagem.textContent = "Preencha todos os campos!";  // mensagens
        mensagem.className = "error";
        return;
    };

    if (!data.email.includes("@")) { // Verifica se o Email INCLUI @
        mensagem.textContent = "Email inválido!"; // mensagens de erro
        mensagem.className = "error";
        return;
    };

    mensagem.textContent = "Cadastro realizado com sucesso!"; 
    mensagem.className = "success";

    console.log("Dados cadastrados:", data); // Envia pro Console
    form.reset(); // Reseta o formulario
    alert(
        `Dados cadastrados: \nNome: ${data.nome} \nEmail: ${data.email}\nTelefone: ${untrimmedtelefone}\nCPF: ${untrimmedcpf}\nData de Nascimento: ${data.dataNascimento}`); // Mensagem formatada
}
);
/* reutilizado*/
input_telefone.addEventListener('input', function () { // Formata o Telefone quando está sendo preenchido
    let numbers = input_telefone.value.replace(/\D/g, '');

    if (numbers.startsWith("55")) {
        numbers = numbers.slice(2);
    }

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

    input_telefone.value = formatted;
});
// Formatação do CPF
input_cpf.addEventListener('input', function () {
    let value = input_cpf.value.replace(/\D/g, ''); 

    value = value.substring(0, 11); 

    value = value.replace(/(\d{3})(\d)/, "$1.$2");
    value = value.replace(/(\d{3})(\d)/, "$1.$2");
    value = value.replace(/(\d{3})(\d{1,2})$/, "$1-$2");

    input_cpf.value = value;
});
document.getElementById('telefone').addEventListener('input', function () {
    let numbers = this.value.replace(/\D/g, '');
    numbers = numbers.substring(0, 11);

    let formatted = "";

    if (numbers.length > 0) {
        formatted += "(" + numbers.substring(0, 2);
    }

    if (numbers.length >= 2) {
        formatted += ") ";
    }

    if (numbers.length > 2) {
        formatted += numbers.substring(2, 7);
    }

    if (numbers.length > 7) {
        formatted += "-" + numbers.substring(7, 11);
    }

    this.value = formatted;
});

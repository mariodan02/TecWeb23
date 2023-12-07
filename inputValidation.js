function validateFormSignUp() {
    var password = document.getElementById('password').value;
    var nome = document.getElementById('nome').value;
    var cognome = document.getElementById('cognome').value;
    var username = document.getElementById('username').value;
    var confirmPassword = document.getElementById('repassword').value;

    // Verifica che la password sia di almeno 8 caratteri e contenga almeno un numero
    if (password.length < 8 || !/\d/.test(password)) {
        alert("La password deve contenere almeno 8 caratteri e un numero.");
        return false;
    }

    // Verifica che il campo nome non sia vuoto
    if (nome === '') {
        alert("Il campo 'nome' deve essere compilato.");
        return false;
    }

    // Verifica che il campo cognome non sia vuoto
    if (cognome === '') {
        alert("Il campo 'cognome' deve essere compilato.");
        return false;
    }

    // Verifica che il campo username non sia vuoto
    if (username === '') {
        alert("Il campo 'username' deve essere compilato.");
        return false;
    }

    // Verifica che il campo "ripeti password" non sia vuoto e corrisponda alla password inserita
    if (confirmPassword === '' || confirmPassword !== password) {
        alert("Il campo 'ripeti password' deve essere compilato correttamente.");
        return false;
    }

    return true;
}


function validateFormCandidatura() {
    var phoneNumber = document.getElementById('telefono').value;
    var email = document.getElementById('mail').value;
    var nome = document.getElementById('nome').value;
    var cognome = document.getElementById('cognome').value;

    // Verifica che il numero di telefono sia di 10 cifre
    if (phoneNumber.length !== 10 || isNaN(phoneNumber)) {
        alert("Il numero di telefono deve essere di 10 cifre.");
        return false;
    }

    // Verifica che l'indirizzo email contenga almeno una chiocciola
    if (!email.includes('@')) {
        alert("L'indirizzo email deve contenere almeno un simbolo '@'.");
        return false;
    }

    // Verifica che il campo nome non sia vuoto
    if (nome === '') {
        alert("Il campo 'nome' deve essere compilato.");
        return false;
    }

    // Verifica che il campo cognome non sia vuoto
    if (cognome === '') {
        alert("Il campo 'cognome' deve essere compilato.");
        return false;
    }

    return true;
}
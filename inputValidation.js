function validateFormSignUp() {
    var password = document.getElementById('password').value;
    var username = document.getElementById('username').value;
    var email = document.getElementById('email').value;

    // Verifica che la password sia di almeno 8 caratteri e contenga almeno un numero
    if (password.length < 8 || !/\d/.test(password)) {
        alert("La password deve contenere almeno 8 caratteri e un numero.");
        return false;
    }

    // Verifica che il campo email non sia vuoto
    if (email === '') {
        alert("Il campo 'email' deve essere compilato.");
        return false;
    }

    // Verifica che il campo username non sia vuoto
    if (username === '') {
        alert("Il campo 'username' deve essere compilato.");
        return false;
    }
    
    return true;
}

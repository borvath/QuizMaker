// noinspection DuplicatedCode

const username = document.getElementById("username-field");
const password = document.getElementById("password-field");
const passconfirm = document.getElementById("confirm-password-field");

username.addEventListener('keyup', validateUsername);
password.addEventListener('keyup', validatePassword);
passconfirm.addEventListener('keyup', validatePasswordMatch);

function validateSignup() {
    return (validateUsername() && validatePassword() && validatePasswordMatch());
}

function validateUsername() {
    const input = username.value;
    const error = document.getElementById("username-requirements");
    const minUsernameLength = 6;
    const maxUsernameLength = 32;

    if (input.length < minUsernameLength || input.length > maxUsernameLength) {
        error.classList.add('invalid-input');
        return false;
    } else {
        error.innerHTML = "";
        error.classList.remove('invalid-input');
        return true;
    }
}

function validatePassword() {
    const input = password.value;
    const user = username.value;
    const minPasswordLength = 8;
    const containsNumberPattern = /\d/;
    let validPassword = true;

    if (input.length < minPasswordLength) {
        document.getElementById("minCharacters").classList.add('invalid-input');
        validPassword = false;
    } else document.getElementById("minCharacters").classList.remove('invalid-input');

    if (input.toLowerCase() === input) {
        document.getElementById("minCapital").classList.add('invalid-input');
        validPassword = false;
    } else document.getElementById("minCapital").classList.remove('invalid-input');

    if (!containsNumberPattern.test(input)) {
        document.getElementById("minNumber").classList.add('invalid-input');
        validPassword = false;
    } else document.getElementById("minNumber").classList.remove('invalid-input');

    if (input.toLowerCase().includes(user.toLowerCase())) {
        document.getElementById("containsUsername").classList.add('invalid-input');
        validPassword = false;
    } else document.getElementById("containsUsername").classList.remove('invalid-input');

    return validPassword;
}

function validatePasswordMatch() {
    const originalPassword = password.value;
    const confirmPassword = passconfirm.value;
    const error = document.getElementById("confirm-password-match");
    error.innerHTML = "";

    if (originalPassword !== confirmPassword || originalPassword === "" || confirmPassword === "") {
        error.innerHTML += "Does not match entered password<br>";
        error.classList.add('invalid-input');
    } else error.classList.remove('invalid-input');

    return (error.innerHTML === "");
}
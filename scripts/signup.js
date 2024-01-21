// List of special characters for passwords adapted from https://owasp.org/www-community/password-special-characters
var SPECIAL_CHARS = /[!\"#$%&'()*+,\-./:;<=>?@[\\\]^_~]/;
var UPPERCASE_LETTERS = /[A-Z]/;
var LOWERCASE_LETTERS = /[a-z]/;

$(document).ready(() => {
    let savedBgColor = localStorage.getItem("landingBgColor")
    if (savedBgColor){
        $("body").css("background-color", savedBgColor);
    }
    $("body").css("visibility", "visible");

    $("#signup-btn").on('click', (e) => {
        let name = $("#name").val();
        let email = $("#email").val();
        let password = $("#password").val();
        let passwordConfirm = $("#confirm-password").val();
        
        let isLongerThan8Chars = password.length > 8;
        let usesASpecialCharacter = SPECIAL_CHARS.test(password);
        let hasACapitalLetter = UPPERCASE_LETTERS.test(password);

        if (!name || !email || !password || !passwordConfirm || (password != passwordConfirm)){
            // If form is incomplete or passwords don't match, let the server handle input validation.
            return;
        }

        if (!isLongerThan8Chars || !usesASpecialCharacter || !hasACapitalLetter){
            e.preventDefault();

            alert(`Your password does not meet our complexity requirements. Please make sure you satisfy all of the requirements below.
            
            \u2022 Password has 8 or more characters
            \u2022 Password uses at least one special character
            \u2022 Password has at least one uppercase letter
            \u2022 Password has at least one lowercase letter

            Special characters: !"#$%&'()*+,-./:;<=>?@[\]^_~
            `);
        }
    })


});
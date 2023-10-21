
const validation = new JustValidate("#signUp");


var nameError = document.getElementById('name-error');
var emailError = document.getElementById('email-error');
var passwordError = document.getElementById('password-error');

validation
    .addField("#name", [
        {
            rule: "required",
            errorMessage: "Please enter a NAME",
            getMessage: () => {
                return {
                    message: "Please enter a NAME",
                    class: "just-validate-error",
                };
            }

        }
    ])

    .addField("#email", [
        {
            rule: "required",
            errorMessage: "&nbsp;&nbsp;Please enter an email",
        },
        {
            rule: "email",
            errorMessage: "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Please enter a valid email",
        },
        {
            validator: (value) => {
                return () => {
                    return fetch("./LogInBackEnd/email-validation.php?email=" + encodeURIComponent(value))
                        .then(function(response) {
                            return response.json();
                        })
                        .then(function(json) {
                            return json.available;
                        });
                };
            },
            errorMessage: "Email already taken"
        }
    ])

    .addField("#password", [
        {
            rule: "required",
            errorMessage: "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Please enter a password",
        },
        {
            rule: "password",
            errorMessage: "Not valid Password",
            style: "color: blue",
            getMessage: () => {
                return {
                    message: "Numbers and special characters are required",
                    class: "just-validate-error",
                    style: "color: blue;" // Set the color to red
                };
            }
        }
    ])

    .onSuccess((event) => {
        document.getElementById("signUp").submit();
    });



    const validation2 = new JustValidate("#signUp2");



console.log("DAVID");
validation2
    .addField("#name2", [
        {
            rule: "required",
            errorMessage: "Please enter a NAME",
            getMessage: () => {
                return {
                    message: "Please enter a NAME",
                    class: "just-validate-error",
                };
            }

        }
    ])

    .addField("#email2", [
        {
            rule: "required",
            errorMessage: "&nbsp;&nbsp;Please enter an email",
        },
        {
            rule: "email",
            errorMessage: "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Please enter a valid email",
        },
        {
            validator: (value) => {
                return () => {
                    return fetch("./LogInBackEnd/email-validation11.php?email=" + encodeURIComponent(value))
                        .then(function(response) {
                            return response.json();
                        })
                        .then(function(json) {
                            console.log(json);
                            return json.available;
                        });
                };
            },
            errorMessage: "Email already taken"
        }
    ])

    .addField("#password2", [
        {
            rule: "required",
            errorMessage: "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Please enter a password",
        },
        {
            rule: "password",
            errorMessage: "Not valid Password",
            style: "color: blue",
            getMessage: () => {
                return {
                    message: "Numbers and special characters are required",
                    class: "just-validate-error",
                    style: "color: blue;" // Set the color to red
                };
            }
        }
    ])

    .onSuccess((event) => {
        document.getElementById("signUp2").submit();
    });

    console.log("prova");
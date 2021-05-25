$(() => {

    var validationCode;
    
    $('button.send-an-email').on(
        'click', () => {

            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    validationCode = this.responseText;

                    $('.change-user-password').css(
                        {
                            "display": "block",
                            "border-top" : "1px solid #34495e",
                            "margin-top": "2em",
                            "padding-top" : "2em"
                        }
                    )
                }
            };
            
            xmlhttp.open("GET", "./forgotPasswordEmail.php?userEmail=" + $(".user-email").val(), true);
            xmlhttp.send();

            alert("Nous venons de vous envoyer un email, veuillez vérifier votre messagerie.");

    });

    $('.user-code-validation').on(
        'keypress', () => {
            if ($('.user-code-validation').val() === validationCode) {

                $('body').css("height", "140vh");

                $('.change-user-password-form').css(
                    {
                        "display": "block",
                        "border-top" : "1px solid #34495e",
                        "margin-top": "2em",
                        "padding-top" : "2em"
                    }
                );

            }
        }
    );

});

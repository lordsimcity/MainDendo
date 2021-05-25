$(() => {
    $('button.validation-button').on(
        "click", () => {
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                if (this.responseText === "true") {
                    $('.is-not-registered').css(
                        "display", "none" 
                    )
                    $('.is-registered').css(
                        {
                            "display": "block",
                            "border-top" : "1px solid #34495e",
                            "margin-top": "2em",
                            "padding-top" : "2em"
                        } 
                    )
                } else {
                    $('.is-registered').css(
                        "display", "none" 
                    )
                    $('.is-not-registered').css(
                        {
                            "display": "block",
                            "border-top" : "1px solid #34495e",
                            "margin-top": "2em",
                            "padding-top" : "2em"
                        }  
                    )
                }
            }
            };
            xmlhttp.open("GET", "./forgotPasswordTreatment.php?userEmail=" + $(".user-email").val(), true);
            xmlhttp.send();
        }
    )
})
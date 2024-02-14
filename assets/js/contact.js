$(document).ready(function () {
    $("#userFirstName").val("")
    $("#userLastName").val("")
    $("#userEmail").val("")
    $("#userMessage").val("")

    checkFormClientSide()
})

function checkFormClientSide() {
    $("#userFirstName").blur(checkFirstName)
    $("#userLastName").blur(checkLastName)
    $("#userEmail").blur(checkEmail)
    $("#userMessage").blur(checkMessage)

    $("#sendMessage").click(checkForm)

    let reFirstName = /^[A-Z][a-z]{1,14}$/
    let reLastName = /^[A-Z][a-z]{1,14}$/
    let reEmail = /^[\w]+[\.\w\d]*\@[\w]+([\.][\w]+)+$/
    let reMessage = /^[\w\d\s\.\,\+]+$/

    function checkFirstName() {
        let firstName = $("#userFirstName").val()
        if (!reFirstName.test(firstName)) {
            $("#userFirstName").addClass("notCorrect")
        } else {
            $("#userFirstName").removeClass("notCorrect")
        }
    }

    function checkLastName() {
        let lastName = $("#userLastName").val()
        if (!reLastName.test(lastName)) {
            $("#userLastName").addClass("notCorrect")
        } else {
            $("#userLastName").removeClass("notCorrect")
        }
    }

    function checkEmail() {
        let email = $("#userEmail").val()
        if (!reEmail.test(email)) {
            $("#userEmail").addClass("notCorrect")
        } else {
            $("#userEmail").removeClass("notCorrect")
        }
    }

    function checkMessage() {
        let message = $("#userMessage").val()
        if (!reMessage.test(message)) {
            $("#userMessage").addClass("notCorrect")
            $('.textarea-box').css('padding', '0')
        } else {
            $("#userMessage").removeClass("notCorrect")
        }
    }

    function checkForm() {
        let firstName = $("#userFirstName").val()
        let lastName = $("#userLastName").val()
        let email = $("#userEmail").val()
        let message = $("#userMessage").val()

        checkEmpty(firstName, lastName, email, message)


        let arrayMistakes = []
        

        if ($('.notCorrect').length || (firstName == "") || (email == "") || (message == "") || (lastName == "")) {
            if (!reFirstName.test(firstName))
                arrayMistakes.push("First letter for first name must be uppercase, min 2 chartacters and max 15 characters.")
            if (!reLastName.test(lastName))
                arrayMistakes.push("First letter for last name must be uppercase, min 2 chartacters and max 15 characters.")
            if (!reEmail.test(email))
                arrayMistakes.push("Email is not in good format.")
            if (!reMessage.test(message))
                arrayMistakes.push("Message must contain only uppercase, lowercase, numbers and .,+")

            if (arrayMistakes.length) {
                let print = ""
                for (let i = 0; i < arrayMistakes.length; i++) {
                    print += arrayMistakes[i] + "<br/>"
                }
                $('#notification').html(print)
            }
        } else {
            $("#notification").html("")

            $.ajax({
                url: "models/formToEmail.php",
                method: "POST",
                data: {
                    userFirstName: firstName,
                    userLastName: lastName,
                    userEmail: email,
                    userMessage: message,
                    send: true
                },
                success: function (data, status, xhr) {
                    if (xhr.status == 200) {
                        $("#userFirstName").val("")
                        $("#userLastName").val("")
                        $("#userEmail").val("")
                        $("#userMessage").val("")

                        window.location.href = 'index.php?page=thanksEmail';
                    }
                },
                error: function (xhr, status, statusTxt) {
                    console.log(xhr.status)
                    console.log(xhr)
                }
            });
        }
    }

    function checkEmpty(firstName, lastName, email, message) {
        if (firstName == "") {
            $("#userFirstName").addClass("notCorrect")
        }
        if (lastName == "") {
            $("#userLastName").addClass("notCorrect")
        }
        if (email == "") {
            $("#userEmail").addClass("notCorrect")
        }
        if (message == "") {
            $("#userMessage").addClass("notCorrect")
            $('.textarea-box').css('padding', '0')
        }
    }
}
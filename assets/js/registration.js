const form = document.getElementById('formRegister')

form.addEventListener('submit', e => {
    e.preventDefault()
    checkInputs()
})

function checkInputs() {
    let firstNameValue = document.getElementById('firstName').value.trim()
    let lastNameValue = document.getElementById('lastName').value.trim()
    let usernameValue = document.getElementById('username').value.trim()
    let emailValue = document.getElementById('email').value.trim()
    let passwordValue = document.getElementById('password').value.trim()

    if (firstNameValue === '') {
        setErrorFor(firstName, 'First Name cannot be blank')
    } else if (!isFirstName(firstNameValue)) {
        setErrorFor(firstName, 'Not a valid first name')
    } else {
        setSuccessFor(firstName)
    }

    if (lastNameValue === '') {
        setErrorFor(lastName, 'Last Name cannot be blank')
    } else if (!isLastName(lastNameValue)) {
        setErrorFor(lastName, 'Not a valid last name')
    } else {
        setSuccessFor(lastName)
    }

    if (usernameValue === '') {
        setErrorFor(username, 'Username cannot be blank')
    } else if (!isUsername(usernameValue)) {
        setErrorFor(username, 'Not a valid username')
    } else {
        setSuccessFor(username)
    }

    if (emailValue === '') {
        setErrorFor(email, 'Email cannot be blank')
    } else if (!isEmail(emailValue)) {
        setErrorFor(email, 'Not a valid email')
    } else {
        setSuccessFor(email)
    }

    if (passwordValue === '') {
        setErrorFor(password, 'Password cannot be blank')
    } else if (!isPassword(passwordValue)) {
        setErrorFor(password, 'Not a valid password')
    } else {
        setSuccessFor(password)
    }
}

function setErrorFor(input, message) {
    const formControl = input.parentElement
    const small = formControl.querySelector('small')
    formControl.className = 'form-group error'
    small.innerText = message
}

function setSuccessFor(input) {
    const formControl = input.parentElement
    formControl.className = 'form-group success'
}

function isFirstName(firstName) {
    return /^[A-ZŠĐČĆŽ][a-zšđčćž]{2,15}$/.test(firstName)
}

function isLastName(lastName) {
    return /^[A-ZŠĐČĆŽ][a-zšđčćž]{2,15}$/.test(lastName)
}

function isUsername(username) {
    return /^[a-zšđčćž0-9\_]{4,15}$/.test(username)
}

function isEmail(email) {
    return /^[\w]+(\w\.\_\-)*\@[\w]+(\.[\w]+)?(\.[a-z]{2,3})$/.test(email)
}

function isPassword(password) {
    return /^(?=.*[a-zšđčćž])(?=.*[A-ZŠĐČĆŽ])(?=.*\d).{6,32}$/.test(password);
}

$("#btnRegister").click(function () {
    $.ajax({
        url: BASE_URL + "models/register.php",
        method: "POST",
        dataType: "json",
        data: {
            firstName: $("#firstName").val(),
            lastName: $("#lastName").val(),
            email: $("#email").val(),
            username: $("#username").val(),
            password: $("#password").val(),
            send: true
        },
        success: function () {
            $('#formRegister input[type="text"]').val('')
            $('#formRegister input[type="password"]').val('')

            alert("Successfully Registered!")
            
            $("#registrationModal .close").click()
        },
        error: function (xhr, status, error) {
            let msgErrReg = "You have error!"

            switch (xhr.status) {
                case 404:
                    msgErrReg = "Page Not Found!"
                    break
                case 409:
                    msgErrReg = "Username or email already exists!"
                    break
                case 422:
                    msgErrReg = "Data not valid!"
                    console.log(xhr.responseText)
                    break
                case 500:
                    msgErrReg = "Error, sorry!"
                    break
            }
        }
    })
})
const loginForm = $("#loginForm");
const loginEmail = $("#loginEmail");
const loginPassword = $("#loginPassword");
const loader = $("#loader");
const btnLogin = $("#btnLogin");
const loginErrors = $(".login-errors");

$(document).ready(function () {
  loginForm.submit(function (e) {
    e.preventDefault();

    validateLogin();
  });

  loginEmail.blur(checkEmail);
  loginPassword.blur(checkPassword);

  loginPassword.css("border", "1px solid gray");
  loginEmail.css("border", "1px solid gray");
})

function validateLogin() {
  const valid = checkEmail() && checkPassword();

  // console.log(loginForm.serialize()); // loginEmail=marko&loginPassword=gacanovic07

  loader.show();
  btnLogin.prop("disabled", true);

  setTimeout(function () {
    loader.hide();
    btnLogin.prop("disabled", false);
  }, 500);

  if (valid) {
    $.ajax({
      type: "POST",
      url: BASE_URL + "models/login.php",
      data: loginForm.serialize(),
      success: function (response) {
        handleLoginResponse(response)
      },
      error: function (xhr, status, error) {
        loginErrors.html("An error occurred.");
      }
    });
  }
}

function handleLoginResponse(response) {
  switch (response) {
    case "admin":
      window.location.href = "index.php?page=adminDashboard";
      break;
    case "home":
      window.location.href = "index.php?page=home";
      break;
    case "wrong_credentials":
      loginErrors.html("Invalid email or password.");
      break;
    case "wrong_password":
      loginErrors.html("Wrong password.");
      break;
    case "user_not_found":
      loginErrors.html("User does not exist.");
      break;
    default:
      loginErrors.html("An unexpected error occurred.");
  }
}

function checkField(value, regex, element) {
  const isValid = regex.test(value);

  element.css("border", isValid ? "1px solid green" : "1px solid red");

  loginErrors.html("");

  return isValid;
}

function checkEmail() {
  let regEx_email = /^[\w]+[\w\d\.\_\-]*\@[\w]+(\.[\w]+)?(\.[a-z]{2,3})$/;

  return checkField(loginEmail.val(), regEx_email, loginEmail);
}

function checkPassword() {
  let regEx_password = /^(?=.*[a-zšđčćž])(?=.*[A-ZŠĐČĆŽ])(?=.*\d).{6,32}$/;

  return checkField(loginPassword.val(), regEx_password, loginPassword);
}

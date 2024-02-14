if (window.location.href == BASE_URL + "index.php?page=adminUsers" || window.location.href == BASE_URL + "index.php?page=adminUsers#") {
  $(document).ready(function () {
    printUsers();

    $("#formUpdateUser").submit(function (e) {
      e.preventDefault();

      validateUpdateUser();
    });

    $('#footer').css('margin-top', '390px');

    $(".update").hide();

    $("body").on("click", ".update-user", function (e) {  
      e.preventDefault();

      let updateDiv = $(".update");
      updateDiv.show(300);

      let scrollPosition = updateDiv.offset().top;

      $("html, body").animate({
        scrollTop: scrollPosition
      }, 800);

      let idUser = $(this).data("id");

      $.ajax({
        url: "models/users/ajaxGetUser.php",
        method: "POST",
        dataType: "json",
        data: {
          id: idUser,
        },
        success: function (data) {
          $("#hiddenUserId").val(data.idUser);

          $("#tbFirstName").val(data.firstName);
          $("#tbLastName").val(data.lastName);
          $("#tbEmail").val(data.email);
          $("#tbUsername").val(data.username);
          $("#ddlRole").val(data.idRole);

          let dateTime = data.dateRegistration.split(" ");
          $("#dateRegistration").val(dateTime[0]);

          $("input[name='chbActive']").removeAttr("checked");
          if (data.active == 1) {
            $("input[name='chbActive']").prop("checked", true);
            $("input[name='chbActive']").val(data.active);
          }
        },
        error: function (xhr, statusTxt, error) {
          let status = xhr.status;

          switch (status) {
            case 500:
              console.log("Error on server");
              break;
            case 404:
              console.log("Page not found");
              break;
            default:
              console.log("Error: " + status + " - " + statusTxt);
          }
        },
      });
    });

    $("body").on("click", ".delete-user", function (e) {
      e.preventDefault();

      let id = $(this).data("id");

      if (confirm("Are you sure you want to delete this user?")) {
        $.ajax({
          url: "models/users/delete.php",
          method: "POST",
          data: {
            id: id
          },
          success: function () {
            printUsers();
          },
          error: function (xhr, status, error) {
            console.log(xhr.status);
            console.log(error);
          },
        });
      }
    });
  });

  function validateUpdateUser() {
    let formData = new FormData($("#formUpdateUser")[0]);

    $.ajax({
      url: "models/users/update.php",
      method: "POST",
      data: formData,
      contentType: false,
      processData: false,
      success: function (response) {
        if (response == 'success') {
          alert("User updated successfully.");
          printUsers();
        } else if (response == 'error') {
          alert("Error updating user.");
        } else if (response == 'password') {
          alert("Wrong password.");
        } else {
          let errorArray = JSON.parse(response);
          let errorMessages = errorArray.map(function (error) {
            return '<li >' + error + '</li>';
          }).join('');

          $('.updateResponse').html('<ul>' + errorMessages + '</ul>');
        }
      },
      error: function (xhr, status, error) {
        console.log(xhr.status);
        console.log(error);
      },
    })
  }

  function printUsers() {
    $.ajax({
      url: "models/users/ajaxAllUsers.php",
      method: "POST",
      dataType: "json",
      success: function (data) {
        makeUsersTable(data);
      },
      error: function (xhr, status, statusTxt) {
        console.log(xhr.status)
        console.log(xhr)
      }
    })
  }

  function makeUsersTable(users) {
    let html = ``;

    html = `
      <tr>
        <th>ID</th>
        <th>First Name</th>
        <th>Last Name</th>
        <th>Email</th>
        <th>Username</th>
        <th>Role</th>
        <th>Date Registration</th>
        <th>Setup</th>
      </tr>
    `
    for (let user of users) {
      html += `
      <tr>
        <td>${user.idUser}</td>
        <td>${user.firstName}</td>
        <td>${user.lastName}</td>
        <td>${user.email}</td>
        <td>${user.username}</td>
        <td>${user.name}</td>
        <td>${user.dateRegistration}</td>
        <td>
            <a href="#" class="btn btn-outline-danger delete-user" data-id="${user.idUser}">Delete</a>
            <a href="#" class="btn btn-outline-success update-user" data-id="${user.idUser}">Edit</a>
        </td>
      </tr>
      `
    }

    $(".table-admin-users").html(html);
  }
}
const articleName = $("#articleName");
const articleDescription = $("#articleDescription");
const articlePrice = $("#articlePrice");
const articleImageAlt = $("#articleImageAlt");
const ddlCategory = $("#ddlCategory");
const insertArticleForm = $("#insertArticleForm");
const insertErrors = $(".error-message-insert-product");
const btnInsert = $("#btnInsertArticle");

$(document).ready(function () {
  insertArticleForm.submit(function (e) {
    e.preventDefault();

    validateInsertArticle();
  });

  articleName.blur(checkName);
  articleDescription.blur(checkDescription);
  articlePrice.blur(checkPrice);
  articleImageAlt.blur(checkAlt);
  ddlCategory.blur(checkCategory);

  (articleName, articleDescription, articlePrice, articleImageAlt, ddlCategory).css("border", "1px solid gray");
})

function validateInsertArticle() {
  const valid = checkName() && checkDescription() && checkPrice() && checkAlt() && checkCategory();

  loader.show();
  btnInsert.prop("disabled", true);

  setTimeout(function () {
    loader.hide();
    btnInsert.prop("disabled", false);
  }, 500);

  if (valid) {
    let formData = new FormData(insertArticleForm[0]);

    $.ajax({
      type: "POST",
      url: BASE_URL + "models/articles/insert.php",
      data: formData,
      processData: false,
      contentType: false,
      success: function (responseText, statusText, response) {
        if (response.status === 201) {
          alert("Successfully added article");

          $('.close').click();

          (articleName, articleDescription, articlePrice, articleImageAlt, ddlCategory).val("").css("border", "1px solid gray");
        } else {
          let errorArray = JSON.parse(response);

          let errorMessages = errorArray.map(function (error) {
            return '<li>' + error + '</li>';
          }).join('');

          insertErrors.html('<ul>' + errorMessages + '</ul>');
        }
      },
      error: function (xhr, status, error) {
        insertErrors.html(JSON.parse(xhr.responseText));
      }
    });
  }
}

function checkField(value, regex, element) {
  const isValid = regex.test(value);

  element.css("border", isValid ? "1px solid green" : "1px solid red");

  insertErrors.html("");

  return isValid;
}

function checkName() {
  let regExName = /^[\w\s\-\_\.]{1,255}$/;

  return checkField(articleName.val(), regExName, articleName);
}

function checkDescription() {
  let regExDesc = /^[\w\s\-\_\.]{1,1001}$/;

  return checkField(articleDescription.val(), regExDesc, articleDescription);
}

function checkPrice() {
  let regExPrice = /^\d+(.\d+)?$/;

  return checkField(articlePrice.val(), regExPrice, articlePrice);
}

function checkAlt() {
  let regExName = /^[\w\s\-\_\.]{1,255}$/;

  return checkField(articleImageAlt.val(), regExName, articleImageAlt);
}

function checkCategory() {
  let category = $("#ddlCategory").val()

  if (category == '0' || category == '') {
    $("#ddlCategory").css("border", "1px solid red")
    insertErrors.html("");
    return false;
  } else {
    $("#ddlCategory").css("border", "1px solid green")
    return true;
  }
}


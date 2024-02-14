if (window.location.href == BASE_URL + "index.php?page=adminArticles" || window.location.href == BASE_URL + "index.php?page=adminArticles#") {

  $(document).ready(function () {
    printArticles();

    $("#updateArticleForm").submit(function (e) {
      e.preventDefault();

      validateUpdateArticle();
    });

    $('#footer').css('margin-top', '390px');

    $(".update").hide();

    $("body").on("click", ".update-article", function (e) {
      e.preventDefault();

      let updateDiv = $(".update");
      updateDiv.show(300);

      let scrollPosition = updateDiv.offset().top;

      $("html, body").animate({
        scrollTop: scrollPosition
      }, 800);

      let idArticle = $(this).data("id");

      $.ajax({
        url: "models/articles/ajaxGetArticle.php",
        method: "POST",
        dataType: "json",
        data: {
          id: idArticle,
        },
        success: function (data) {
          $("#hiddenArticleId").val(data.idArticle);

          $("#articleName").val(data.name);
          $("#taDescription").val(data.description);
          $("#articlePrice").val(data.price);
          $("#srcImage").val(data.image);
          $("#articleImageAlt").val(data.alt);
          $("#ddlAdminUpdateCat").val(data.idCategory);

          $("#emptyImage").attr("src", data.image);
          $("#emptyImage").attr("alt", data.alt);
        },
        error: function (xhr, status, error) {
          console.log(xhr.status);
          console.log(error);
        },
      });
    });

    $("body").on("click", ".delete-article", function (e) {
      e.preventDefault();

      let id = $(this).data("id");
      let originalImage = $(this).data("originalImage")
      let newImage = $(this).data("newImage")

      if (confirm("Are you sure you want to delete this article?")) {
        $.ajax({
          url: "models/articles/delete.php",
          method: "POST",
          data: {
            id: id,
            originalImage: originalImage,
            newImage: newImage
          },
          success: function () {
            printArticles();
          },
          error: function (xhr, status, statusTxt) {
            console.log(xhr.status)
            console.log(xhr)
          }
        })
      }
    })
  });

  function validateUpdateArticle() {
    let formData = new FormData($("#updateArticleForm")[0]);

    $.ajax({
      url: "models/articles/update.php",
      method: "POST",
      data: formData,
      contentType: false,
      processData: false,
      success: function (response) {
        if (response == 'success') {
          alert("Article updated successfully");
          printArticles();
          $('.update-response').html('');
        } else {
          let errorArray = JSON.parse(response);

          let errorMessages = errorArray.map(function (error) {
            return '<li >' + error + '</li>';
          }).join('');

          $('.update-response').html('<ul>' + errorMessages + '</ul>');
        }
      },
      error: function (xhr, status, error) {
        console.log(xhr.status);
        console.log(error);
      },
    })
  }

  function printArticles() {
    $.ajax({
      url: "models/articles/ajaxAllArticles.php",
      method: "POST",
      dataType: "json",
      success: function (data) {
        makeArticlesTable(data)
      },
      error: function (xhr, status, statusTxt) {
        console.log(xhr.status)
        console.log(xhr)
      }
    })
  }

  function makeArticlesTable(articles) {
    let html = ``;

    html = `
    <tr>
      <th>ID</th>
      <th>Name</th>
      <th>Price</th>
      <th>Image</th>
      <th>Category</th>
      <th>Setup</th>
    </tr>`
    for (let article of articles) {
      html += `
      <tr>
        <td>${article.idArticle}</td>
        <td>${article.name}</td>
        <td>${article.price} &euro;</td>
        <td align="center"><img src="${article.newImage}" alt="${article.alt}" width="80" height="80"></td>
        <td>${article.categoryName}</td>
        <td>
            <a href="#" class="btn btn-outline-danger delete-article" data-id="${article.idArticle}" data-originalImage=${article.image} data-newImage=${article.newImage}>Delete</a>
            <a href="#" class="btn btn-outline-success update-article" data-id="${article.idArticle}">Edit</a>
        </td>
      </tr>
      `
    }

    $(".table-admin-articles").html(html)
  }
}
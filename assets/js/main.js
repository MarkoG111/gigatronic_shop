const BASE_URL = "http://localhost/gigatronic_shop/";

$(document).ready(function () {
  populateAllArticles();
  showPagination(0);

  $('#footer').css('margin-top', '300px');
});

function populateAllArticles() {
  $.ajax({
    url: "models/articles/ajaxArticlesPagination.php",
    method: "POST",
    dataType: "json",
    data: {
      id: 1,
    },
    success: function (data) {
      printArticles(data);
    },
    error: function (xhr, status, error) {
      console.log(xhr.status);
    },
  });
}

function printArticles(articles) {
  let print = "";

  for (let article of articles) {
    print += printArticle(article);
  }

  $("#allArticles").html(print);
  $("#pagination").show();
}

function printArticle(article) {
  return `
    <div class="col-xs-12 col-sm-4 one-article featured-container mb-4">
        <img src="${article.image}" alt="${article.alt}" class="img-fluid d-block mx-auto" />

        <button name="view" value="View" class="viewArticleData" id="${article.idArticle}">
            <i class="fa fa-search"></i>
        </button>
        
        <div class="text-center">
            <p>${article.name}</p>
            <p>${article.price} &euro;</p>
        </div>
    </div>`;
}

function showPagination(id) {
  $.ajax({
    url: "models/articles/pagination.php",
    method: "POST",
    dataType: "json",
    data: {
      id: id,
    },
    success: function (data) {
      let print = ``;
      let number = data.numOfArticles;
      let numberOfLinks = Math.ceil(number / 6);

      for (let i = 1; i <= numberOfLinks; i++) {
        if (i == 1) {
          print += `<li class='active'><a href='javascript:void(0)' class='paginationLink' data-id='${i}'>${i}</a></li>`;
        } else {
          print += `<li><a href='javascript:void(0)' class='paginationLink' data-id='${i}'>${i}</a></li>`;
        }
      }

      $("#paginationList").html(print);
    },
    error: function (xhr, status, error) {
      console.log(xhr.status);
      console.log(error);
      console.log(xhr.responseText);
    },
  });
}

$(document).on("click", ".viewArticleData", function (e) {
  e.preventDefault();
  let idArticle = $(this).attr("id");

  $.ajax({
    url: "views/pages/articleDetails.php",
    method: "POST",
    data: {
      idArticle: idArticle,
    },
    success: function (data) {
      $("#articleDetail").html(data);
      $("#dataModal").modal("show");
    },
  });
});

$("#pagination").on("click", ".paginationLink", function () {
  let id = $(this).data("id");
  let idCategory = $("#ddlCategoryShow").val();
  let idSort = $("#ddlSort").val();

  $("#paginationList .active").removeAttr("class");

  $(this).parent().attr("class", "active");

  $.ajax({
    url: "models/articles/filter.php",
    method: "POST",
    dataType: "json",
    data: {
      idPagination: id,
      idCategory: idCategory,
      idSort: idSort,
      send: true,
    },
    success: function (data) {
      printArticles(data);
    },
    error: function (xhr, status, error) {
      console.log(xhr.status);
      console.log(error);
    },
  });
});

$("#ddlCategoryShow").change(function () {
  let idCategory = $(this).val();

  $("#ddlSort").val(0);

  showPagination(idCategory);

  $.ajax({
    url: "models/articles/filter.php",
    method: "POST",
    dataType: "json",
    data: {
      idPagination: 1,
      idCategory: idCategory,
      idSort: 0,
      send: true,
    },
    success: function (data) {
      printArticles(data);
    },
    error: function (xhr, status, error) {
      console.log(error);
      console.log(xhr.status);
    },
  });
});

$("#searchArticles").keyup(function () {
  let searchValue = $(this).val().trim().toLowerCase();

  if (searchValue != "") {
    $.ajax({
      url: "models/articles/search.php",
      method: "POST",
      dataType: "json",
      data: {
        searchValue: searchValue,
        send: true,
      },
      success: function (data) {
        printArticles(data);
        $("#pagination").hide();
      },
      errror: function (xhr, status, error) {
        console.log(xhr.status);
      },
    });
  } else {
    populateAllArticles();
  }
});

$("#ddlSort").change(function () {
  let idSort = $(this).val();
  let idCategory = $("#ddlCategoryShow").val();

  showPagination(idCategory);

  $.ajax({
    url: "models/articles/filter.php",
    method: "POST",
    dataType: "json",
    data: {
      idPagination: 1,
      idCategory: idCategory,
      idSort: idSort,
      send: true,
    },
    success: function (data) {
      printArticles(data);
    },
    error: function (xhr, status, statusTxt) {
      console.log(xhr);
    },
  });
});


let totalAmountCart = 0;
let removed_article_flag = 0;

$(document).ready(function () {
    populateCart();

    // Provera da li korpa postoji u localStorage
    if (!allArticlesInCart()) {
        // Ako ne postoji, postavi praznu korpu
        localStorage.setItem("cartData", JSON.stringify([]));

        $("#button-order").hide();
    }

    // Provera da li u korpi nema artikala
    if (!allArticlesInCart().length) {
        $("#cart").html(
            `<div class="cart-row">
            <span class="cart-item cart-header cart-column">ARTICLE</span>
            <span class="cart-price cart-header cart-column">PRICE</span>
            <span class="cart-quantity cart-header cart-column">QUANTITY</span>
        </div>`
        ).css("margin-bottom", "200px");

        $("#button-order").hide();
    }

    // Provera da li u korpi ima artikala
    if (allArticlesInCart()) {
        if (allArticlesInCart().length) {
            $("#button-order").show();

            // Obrada dogadjaja kada se klikne na dugme za kupovinu
            $("#button-order").click(function () {
                let idUser = $("#hdnUserId").val();
                let totalAmount = totalAmountCart;

                $.ajax({
                    url: "models/orders/postOrder.php",
                    method: "POST",
                    data: {
                        idUser: idUser,
                        totalAmount: totalAmount,
                        obj: allArticlesInCart(),
                        send: true
                    },
                    dataType: "json",
                    success: function (response) {
                        $(this).hide();

                        localStorage.removeItem("cartData");

                        populateCart();

                        alert("Order placed successfully!");
                    },
                    error: function (xhr, status, error) {
                        console.error(error);
                        alert("Error placing the order. Please try again.");
                    }
                });
            });
        }
    }

    // Obrada dogadjaja kada se promeni kolicina u korpi
    $("body").on("change", ".cart-quantity-input", function () {
        let currentQuantity = Number($(this).val());
        let startPrice = Number($(this).closest('.cart-row').find(".cart-start-price").text().split(" ")[0]);

        let cartAmountPrice = $(this).closest('.cart-row').find('.cart-amount-price');
        // let initialData = Number(cartAmountPrice.data('price'));

        let newData = (startPrice * currentQuantity).toFixed(2);

        cartAmountPrice.data('price', newData);
        cartAmountPrice.html(newData + " &euro;");

        saveCartDataToLocalStorage($(this).closest('.cart-row'));

        updateTotalAmount();
    });

    // Obrada dogadjaja kada se pritisne taster na tastaturi za izmenu kolicine
    $("body").on("keydown", ".cart-quantity-input", function (e) {
        let currentQuantity = Number($(this).val());

        if (currentQuantity <= 0) {
            e.preventDefault();
        }
    });

    // Obrada dogadjaja kada se klikne na dugme za dodavanje artikla u korpu
    $("body").on("click", ".add-to-cart", function () {
        $("#dataModal .close").click();

        let id = $(this).data("id");
        let articles = allArticlesInCart();

        let articlePrice = $(".article-price").text().split(" ")[0];

        if (articles.filter((a) => a.id == id).length) {
            for (let article of articles) {
                if (article.id == id) {
                    article.quantity++;
                    break;
                }
            }

            localStorage.setItem("cartData", JSON.stringify(articles));
        } else {
            articles.push({
                id: id,
                quantity: 1,
                price: articlePrice
            });

            localStorage.setItem("cartData", JSON.stringify(articles));
        }

        alert("You successfully added article to cart.");
    });

    // Obrada dogadjaja kada se klikne na dugme za uklanjanje artikla iz korpe
    $("#cart").on("click", ".remove-cart-item", function () {
        let articles = allArticlesInCart();
        let id = $(this).data("id");
        let removedArticle = articles.filter((a) => a.id == id);

        if (removedArticle) {
            let remainingArticles = articles.filter((a) => a.id != id);
            let startPrice = Number($(this).closest('.cart-row').find(".cart-start-price").text().split(" ")[0]);

            localStorage.setItem("cartData", JSON.stringify(remainingArticles));

            totalAmountCart = totalAmountCart - (removedArticle[0].quantity * startPrice);

            removed_article_flag = 1;

            populateCart();
        }
    });
});

// Funkcija koja vraca sve artikle u korpi iz localStorage
function allArticlesInCart() {
    return JSON.parse(localStorage.getItem("cartData")) || [];
}

// Funkcija koja popunjava korpu artiklima
function populateCart() {
    let articles = allArticlesInCart();

    $.ajax({
        url: "models/articles/ajaxAllArticles.php",
        method: "POST",
        dataType: "json",
        success: function (data) {
            data = data.filter((a) => {
                for (let article of articles) {
                    if (article.id == a.idArticle) {
                        a.quantity = article.quantity;
                        return true;
                    }
                }

                return false;
            });

            makeTable(data);
            updateTotalAmount();

            removed_article_flag = 0;
        },
        error: function (xhr, status, error) {
            console.log(xhr.status);
            console.log(error);
        },
    });
}

// Funkcija koja kreira tabelu sa artiklima
function makeTable(data) {
    let print = `
    <div class="cart-row">
        <span class="cart-item cart-header cart-column">ARTICLE</span>
        <span class="cart-price cart-header cart-column">PRICE</span>
        <span class="cart-quantity cart-header cart-column">QUANTITY</span>
        <span class="cart-amount cart-header cart-column">AMOUNT</span>
        <span class="cart-delete cart-header cart-column">DELETE</span>
    </div>
    `;

    for (let i of data) {
        let amount = (Number(i.price) * Number(i.quantity)).toFixed(2);

        if (removed_article_flag == 0) {
            totalAmountCart += Number(amount);
        }

        print += `
        <div class='cart-items'>
            <div class='cart-row' data-row='${i.idArticle}'>
                <div class='cart-item cart-column'>
                    <img src='${i.image}' alt='${i.alt}' class='cart-item-image' width='100' height='100'>
                    <span class='cart-item-title'>${i.name}</span>
                </div>
                <div class='cart-price cart-start-price cart-column'>${i.price} &euro;</div>
                <div class='cart-quantity cart-column'>
                    <input type='number' class='cart-quantity-input' min="1" value='${i.quantity}'>
                </div>
                <div class='cart-column cart-amount'>
                    <span class="cart-amount-price align-self-center" data-price="${amount}">${amount} &euro;<span>    
                </div>
                <div class='cart-column cart-delete'>
                    <button class='btn btn btn-outline-danger remove-cart-item' type='button' data-id='${i.idArticle}'>REMOVE</button>
                </div>
            </div>
        </div>
      `;
    }

    $("#cart").html(print);

    if (removed_article_flag == 0) {
        $(".totalCash").text("Total: " + totalAmountCart.toFixed(2) + " €");
    }
}

// Funkcija koja azurira ukupan iznos u korpi
function updateTotalAmount() {
    totalAmountCart = 0;

    $(".cart-amount-price").each(function () {
        totalAmountCart += parseFloat($(this).data("price"));
    })

    let totalCashElement = $("#totalAmountCart").find(".totalCash");

    totalCashElement.text("Total: " + totalAmountCart.toFixed(2) + " €");
}

// Funkcija koja cuva podatke o korpi u localStorage
function saveCartDataToLocalStorage(cartRow) {
    let articles = allArticlesInCart();
    let articleId = cartRow.data('row');
    let articleIndex = articles.findIndex(a => a.id == articleId);

    if (articleIndex !== -1) {
        articles[articleIndex].quantity = Number(cartRow.find('.cart-quantity-input').val());

        localStorage.setItem("cartData", JSON.stringify(articles));
    }
}
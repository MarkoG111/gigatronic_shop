<div class="container">
    <div class="row">
        <div class="col-lg-12 cart-center">
            <h2 class="text-center mt-4">Shopping Cart</h2>
            <hr class="underTitle mb-4" />

            <div id="cart" class="container">

            </div>

            <div id="totalAmountCart">
                <h3 class="totalCash ml-3 mb-5">Total: </h3>
            </div>

            <button type='button' class='btn btn-outline-success' id='button-order'>Make a purchase</button>

            <input type="hidden" name="hdnUserId" id="hdnUserId" value="<?= $_SESSION['user']->idUser; ?>">
        </div>
    </div>
</div>
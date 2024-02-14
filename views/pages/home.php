<main>
    <!-- Start of slider -->
    <div id="carouselFeatured" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner" role="listbox">
            <div class="carousel-item active">
            </div>

            <div class="carousel-item">
                <div class="carousel-caption d-none d-md-block">
                </div>
            </div>

            <div class="carousel-item">
                <div class="carousel-caption d-none d-md-block">
                </div>
            </div>
        </div>
        <a class="carousel-control-prev" href="#carouselFeatured" role="button" data-slide="prev">
            <span><i class="fa fa-angle-left" aria-hidden="true"></i></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselFeatured" role="button" data-slide="next">
            <span><i class="fa fa-angle-right" aria-hidden="true"></i></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
    <!-- End of slider -->

    <!-- Start of details about company -->
    <div id="info">
        <div class="info-box">
            <i class="fas fa-truck fa-2x"></i>
            <div class="info-box-txt">
                <h4>Free Shipping</h4>
                <p>On the territory of Belgrade <br /> for orders over 20$</p>
            </div>
        </div>
        <div class="info-box">
            <i class="far fa-credit-card fa-2x"></i>
            <div class="info-box-txt">
                <h4>More Payment Methods</h4>
                <p>Payment cards, cash on delivery, <br /> through the account</p>
            </div>
        </div>
        <div class="info-box">
            <i class="fas fa-gift fa-2x"></i>
            <div class="info-box-txt">
                <h4>We Know What You Need</h4>
                <p>Over 20.000 items on offer <br /> and win up to 50% discount </p>
            </div>
        </div>
        <div class="info-box">
            <i class="fas fa-phone fa-2x"></i>
            <div class="info-box-txt">
                <h4>Call Our Operator</h4>
                <p>Mobile: 069/312-354-27 <br /> Service: 011/1111-347 </p>
            </div>
        </div>
    </div>
    <!-- End of details about company -->

    <!-- Start of separated articles from database -->
    <div id="separatedArticles">
        <div class="container-fluid">
            <h2 class="text-center">Featured Articles</h2>
            <hr class="underTitle mb-4" />
            <div class="col-10 col-md-7 col-lg-9 mx-auto">
                <div class="row">
                    <?php
                    $articlesFeatured = getAllArticlesFeatured();
                    foreach ($articlesFeatured as $aF) :
                    ?>
                        <div class="mx-auto col-md-6 col-lg-3 my-3">
                            <div class="featured-container text-center p-5">
                                <img src="<?= $aF->image ?>" alt="<?= $aF->alt ?>" class="img-fluid" />

                                <button name="view" value="View" id=<?= $aF->idArticle ?> class="viewArticleData">
                                    <i class="fa fa-search"></i>
                                </button>

                            </div>
                            <h6 class="text-center my-2"><?= $aF->name ?></h6>
                            <h6 class="text-center">
                                <span><?= $aF->price ?> &euro;</span>
                            </h6>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
    <!-- End of separated articles from database -->

</main>
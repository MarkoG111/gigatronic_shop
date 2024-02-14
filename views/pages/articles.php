<div class="container">
    <h2 class="text-center mt-4">Our Articles</h2>
    <hr class="underTitle mb-4" />

    <div class="row">
        <div class="col-lg-3 text-center articlesFilters">
            <form action="" method="GET" class="boxed-form">
                <div id="filter-div" class="toggle-menu">
                    <p>Category</p>
                    <select name="ddlCategoryShow" id="ddlCategoryShow" class="custom-select">
                        <option value="0">Choose</option>
                        <?php
                        $categories = getCategories();
                        foreach ($categories as $cat) : ?>
                            <option value="<?= $cat->idCategory ?>"><?= $cat->name ?></option>
                        <?php endforeach; ?>
                    </select>

                    <p>Search</p>
                    <div class="form-group">
                        <input type="text" class="form-control" id="searchArticles" placeholder="Search" />
                    </div>

                    <p>Sort by price</p>
                    <select name="ddlSort" id="ddlSort" class="custom-select">
                        <option value="0">Choose</option>
                        <option value="1">Ascending</option>
                        <option value="2">Descending</option>
                    </select>
                </div>
            </form>
        </div>

        <div id="allArticles" class="col-lg-9">

        </div>

        <div id="pagination">
            <ul id="paginationList">

            </ul>
        </div>
    </div>
</div>
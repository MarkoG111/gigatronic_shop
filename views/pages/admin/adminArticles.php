<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <h2 class="text-center mt-4">All Articles</h2>
            <hr class="underTitle mb-4" />
            <table class="table table-stripped table-hover table-admin-articles table-responsive-sm">
               
            </table>
        </div>
    </div>

    <div class="row update">
        <div class="col-md-6 mx-auto">
            <form action="" id="updateArticleForm" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="hiddenArticleId" id="hiddenArticleId">

                <div class="form-group">
                    <label for="articleName">Article Name:</label>
                    <input type="text" name="articleName" id="articleName" class="form-control">
                </div>

                <div class="form-group">
                    <label for="taDescription">Description:</label>
                    <textarea name="taDescription" id="taDescription" cols="30" rows="10" class="form-control"></textarea>
                </div>

                <div class="form-group">
                    <label for="articlePrice">Article Price:</label>
                    <input type="number" name="articlePrice" id="articlePrice" class="form-control" style="display: inline !important; width: 20% !important;"> 
                    <span style="margin-left: 5px;">&euro;</span>
                </div>

                <div class="form-group">
                    <label for="articleImage">Article Image:</label>
                    <img src="" alt="" style="width:20%;" id="emptyImage" name="emptyImage">
                    <input type="file" name="articleImage" id="articleImage">
                </div>

                <div class="form-group">
                    <label for="articleImageAlt">Article Alt:</label>
                    <input type="text" name="articleImageAlt" id="articleImageAlt" class="form-control">
                </div>

                <div class="form-group">
                    <label for="ddlAdminUpdateCat">Category:</label>
                    <select name="ddlAdminUpdateCat" id="ddlAdminUpdateCat" class="form-control">
                        <option value="0">Choose category</option>
                        <?php
                        $categories = getCategories();
                        foreach ($categories as $cat) : ?>
                            <option value="<?= $cat->idCategory ?>"><?= $cat->name ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <input type="submit" value="Update" id="btnUpdateArticle" class="btn btn-outline-success" name="btnUpdateArticle">
            </form>
        </div>
    </div>

    <div class="update-response" style="text-align:center;margin-top:25px;color:red;font-size:20px;">

    </div>
</div>
<header id="header-dashboard" class="mb-4">
  <div class="row py-2">
    <div class="col-md-10">
      <h1><i class="fa fa-cog"></i> Dashboard</h1>
    </div>
    <div class="col-md-2">
      <div class="dropdown create">
        <button class="btn btn-outline-warning dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
          Create Content
          <span class="caret"></span>
        </button>
        <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
          <li><a type="button" data-toggle="modal" data-target="#add-article">Add Article</a></li>
        </ul>
      </div>
    </div>
  </div>
</header>


<section id="main-dashboard">
  <div class="row">
    <div class="col-md-3 mt-4">
      <div class="list-group">
        <a href="#" class="list-group-item bg-warning">
          <i class="fa fa-cog"></i> Dashboard
        </a>
        <a href="index.php?page=adminUsers" class="list-group-item"> Users <i class="fa fa-user"></i></a>
        <a href="index.php?page=adminArticles" class="list-group-item"> Articles <i class="fas fa-box-open"></i></a>
        <a href="index.php?page=adminPoll" class="list-group-item"> Poll <i class="fa fa-chart-pie"></i></a>
        <a href="index.php?page=adminStatistics" class="list-group-item"> Statistics <i class="fa fa-bar-chart"></i></a>
        <a href="index.php?page=adminOrders" class="list-group-item"> Orders <i class="fa fa-shopping-cart"></i></a>
      </div>
    </div>
    <div class="col-md-9 mx-auto card p-0 mt-4">
      <div class="card-title bg-warning">
        <h3 class="card-title pl-3">Website Overview</h3>
      </div>
      <div class="card-group text-center">
        <div class="col-lg-3">
          <div class="card my-4">
            <div class="card-body">
              <a href="index.php?page=adminUsers">
                <h2>
                  <?php $users = countUsers(); ?>
                  <?= $users->userCount; ?>
                  <i class="fa fa-user"></i>
                </h2>
                <h5 class="card-title">Users</h5>
              </a>
            </div>
          </div>
        </div>
        <div class="col-lg-3">
          <div class="card my-4">
            <div class="card-body">
              <a href="index.php?page=adminArticles">
                <h2>
                  <?php $articles = getNumberOfArticles(); ?>
                  <?= $articles->numOfArticles ?>
                  <i class="fas fa-box-open"></i>
                </h2>
                <h5 class="card-title">Articles</h5>
              </a>
            </div>
          </div>
        </div>
        <div class="col-lg-3">
          <div class="card my-4">
            <div class="card-body">
              <a href="index.php?page=adminPoll">
                <h2><i class="fa fa-pie-chart"></i></h2>
                <h5 class="card-title">Poll</h5>
              </a>
            </div>
          </div>
        </div>
        <div class="col-lg-3">
          <div class="card my-4">
            <div class="card-body">
              <a href="index.php?page=adminStatistics">
                <h2><i class="fa fa-bar-chart"></i></h2>
                <h5 class="card-title">Statistics</h5>
              </a>
            </div>
          </div>
        </div>
        <div class="col-lg-3">
          <div class="card my-4">
            <div class="card-body">
              <a href="index.php?page=adminOrders">
                <h2>
                  <?php $orders = countOrders(); ?>
                  <?= $orders->ordersCount; ?>
                  <i class="fa fa-shopping-cart"></i>
                </h2>
                <h5 class="card-title">Orders</h5>
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-md-3 mt-4">
      <div class="card">
        <img class="card-img-top" src="assets/img/fa-user.png" alt="Card image cap" />
        <div class="card-body">
          <h4 class="card-text">Number of currently logged users: <?= countLoggedUsers() ?></h4>
        </div>
      </div>
    </div>
    <div class="col-md-9 mx-auto card p-0 mt-4">
      <div class="card-title bg-warning">
        <h3 class="card-title pl-3">Latest Users</h3>
      </div>
      <div class="card-body">
        <table class="table table-striped table-hover">
          <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Joined</th>
          </tr>

          <?php
          $latsetUsers = getLatestUsers();
          foreach ($latsetUsers as $user) :
          ?>
            <tr>
              <td><?= $user->firstName . " " . $user->lastName ?></td>
              <td><?= $user->email ?></td>
              <td><?= $user->dateRegistration ?></td>
            </tr>
          <?php endforeach; ?>
        </table>
      </div>
    </div>
  </div>
</section>

<div class="modal fade" id="add-article" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <form action="" method="POST" id="insertArticleForm" enctype="multipart/form-data">
        <div class="modal-header">
          <h4 class="modal-title" id="myModalLabel">Add Article</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <label>Name</label>
            <input type="text" class="form-control" name="articleName" id="articleName">
          </div>
          <div class="form-group">
            <label>Description</label>
            <textarea class="form-control" name="articleDescription" id="articleDescription"></textarea>
          </div>
          <div class="form-group">
            <label for="articlePrice">Article Price:</label>
            <input type="number" step="0.01" name="articlePrice" id="articlePrice" class="form-control" style="display: inline !important; width: 20% !important;">
            <span style="margin-left: 5px;">&euro;</span>
          </div>
          <div class="form-group">
            <label>Image:</label>
            <input type="file" name="fileArticleImage" id="fileArticleImage">
          </div>
          <div class="form-group">
            <label>Alt</label>
            <input type="text" class="form-control" name="articleImageAlt" id="articleImageAlt">
          </div>
          <div class="form-group">
            <label>Category</label>
            <select name="ddlCategory" id="ddlCategory" class="form-control">
              <option value="0">Choose</option>
              <?php
              $categories = getCategories();
              foreach ($categories as $category) :
              ?>
                <option value="<?= $category->idCategory ?>"><?= $category->name ?></option>
              <?php endforeach; ?>
            </select>
          </div>
        </div>
        <div class="modal-footer" style="display: block;">
          <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-outline-success" name="btnInsertArticle" id="btnInsertArticle">Save Changes</button>

          <div class="row error-message-insert-product">

          </div>
        </div>
      </form>
    </div>
  </div>
</div>
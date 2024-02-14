<footer class="bg-darkest" id="footer">
    <div class="container-fluid">
        <div class="container">
            <div class="row">
                <div class="col-md-4 col-sm-12">
                    <ul class="footer-links">
                        <li>
                            <h3>User Account</h3>
                        </li>
                        <?php if (!isset($_SESSION['user'])) : ?>
                            <li>
                                <i class="fa fa-angle-right"></i>
                                <a href="#" data-target="#loginModal" data-toggle="modal">Already registered? Login here</a>
                            </li>
                            <li>
                                <i class="fa fa-angle-right"></i>
                                <a href="#" data-target="#registrationModal" data-toggle="modal">Register</a>
                            </li>
                        <?php else : ?>
                            <li>
                                <i class="fa fa-angle-right"></i>
                                <a href="models/logout.php">Logout</a>
                            </li>
                        <?php endif; ?>
                    </ul>
                </div>
                <div class="col-md-4 col-sm-12">
                    <ul class="footer-links social-media">
                        <li>
                            <h3>Social Media</h3>
                        </li>
                        <li>
                            <a href="http://www.facebook.com">
                                <i class="fab fa-facebook fa-2x"></i>
                            </a>
                        </li>
                        <li>
                            <a href="http://www.twitter.com">
                                <i class="fab fa-twitter fa-2x"></i>
                            </a>
                        </li>
                        <li>
                            <a href="https://www.linkedin.com/in/marko-gacanovic-4a133016a/">
                                <i class="fab fa-linkedin fa-2x"></i>
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="col-md-4 col-sm-12">
                    <ul class="footer-links">
                        <li>
                            <h3>About Author</h3>
                        </li>
                        <li>
                            <i class="fa fa-angle-right"></i>
                            <a href="https://www.linkedin.com/in/marko-gacanovic-4a133016a/">
                                Link to bio
                            </a>
                        </li>
                        <li>
                            <i class="fa fa-angle-right"></i>
                            <a href="#">
                                Documentation
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</footer>


<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>


<script src="assets/js/main.js"></script>
<script src="assets/js/adminInsertArticle.js"></script>
<script src="assets/js/adminArticles.js"></script>
<script src="assets/js/adminUsers.js"></script>
<script src="assets/js/adminOrders.js"></script>
<script src="assets/js/contact.js"></script>
<script src="assets/js/cart.js"></script>
<script src="assets/js/poll.js"></script>
<script src="assets/js/login.js"></script>
<script src="assets/js/registration.js"></script>

</body>

</html>
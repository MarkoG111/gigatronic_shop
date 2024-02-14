<div class="container">
    <div class="row">
        <div class="col-xs-8 col-sm-10 col-lg-12 mx-auto contact-container">
            <h2 class="text-center mt-4">Contact Us Here</h2>
            <hr class="underTitle mb-4" />

            <form action="" method="POST" onSubmit="return checkFormClientSide();">
                <div class="row100">
                    <div class="col">
                        <div class="input-box">
                            <input type="text" name="userFirstName" id="userFirstName" required="required" />
                            <span class="text-span">First Name</span>
                            <span class="line"></span>
                        </div>
                    </div>
                    <div class="col">
                        <div class="input-box">
                            <input type="text" name="userLastName" id="userLastName" required="required" />
                            <span class="text-span">Last Name</span>
                            <span class="line"></span>
                        </div>
                    </div>
                </div>

                <div class="row100">
                    <div class="col">
                        <div class="input-box">
                            <input type="text" name="userEmail" id="userEmail" required="required" />
                            <span class="text-span">Email</span>
                            <span class="line"></span>
                        </div>
                    </div>
                </div>

                <div class="row100">
                    <div class="col">
                        <div class="input-box textarea-box">
                            <textarea required="required" name="userMessage" id="userMessage"></textarea>
                            <span class="text-span">Type your message here</span>
                            <span class="line"></span>
                        </div>
                    </div>
                </div>

                <div class="row100">
                    <div class="col">
                        <input type="button" value="Send" name="sendMessage" id="sendMessage">
                    </div>
                </div>

                <div id="notification">
                    <?php
                    if (isset($_SESSION['contactErrors'])) {
                        $errors = $_SESSION['contactErrors'];
                        foreach ($errors as $one) {
                            echo $one . "<br/>";
                        }
                        unset($_SESSION['contactErrors']);
                    }
                    ?>
                </div>
            </form>
        </div>
    </div>
</div>
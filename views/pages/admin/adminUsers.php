<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <h2 class="text-center mt-4">Users</h2>
            <hr class="underTitle mb-4" />
            <table class="table table-stripped table-hover table-responsive-md table-admin-users">
               
            </table>
            <a href="models/users/exportExcel.php" class="btn btn-info ml-3">Export To Excel</a>
        </div>
    </div>

    <div class="row update">
        <div class="col-md-6 mx-auto">
            <form action="" id="formUpdateUser" method="POST">
                <input type="hidden" name="hiddenUserId" id="hiddenUserId">

                <div class="form-group">
                    <label for="tbFirstName">First Name:</label>
                    <input type="text" placeholder="First Name" name="tbFirstName" id="tbFirstName" class="form-control">
                </div>

                <div class="form-group">
                    <label for="tbLastName">Last Name:</label>
                    <input type="text" placeholder="Last Name" name="tbLastName" id="tbLastName" class="form-control">
                </div>

                <div class="form-group">
                    <label for="tbEmail">Email:</label>
                    <input type="text" placeholder="Email" name="tbEmail" id="tbEmail" class="form-control">
                </div>

                <div class="form-group">
                    <label for="tbUsername">Username:</label>
                    <input type="text" placeholder="Username" name="tbUsername" id="tbUsername" class="form-control">
                </div>

                <div class="form-group">
                    <label for="tbPassword">Password:</label>
                    <input type="password" placeholder="Password" name="tbPassword" id="tbPassword" class="form-control">
                </div>

                <div class="form-group">
                    <label for="ddlRole">Role:</label>
                    <select name="ddlRole" id="ddlRole" class="form-control">
                        <option value="0">choose role</option>
                        <?php
                        $roles = getAllRoles();
                        foreach ($roles as $role) : ?>
                            <option value="<?= $role->idRole ?>"><?= $role->name ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="form-group">
                    <label for="dateRegistration">Registration Date:</label>
                    <input type="date" name="dateRegistration" id="dateRegistration" class="form-control">
                </div>

                <div class="form-group">
                    <label for="chbActive">Active user? Yes / No</label>
                    <input type="checkbox" name="chbActive" id="chbActive" value="1">
                </div>

                <input type="submit" value="Update" id="btnUpdateUser" class="btn btn-outline-success" name="btnUpdateUser">
            </form>
        </div>
    </div>

    <div class="updateResponse" style="text-align:center;margin-top:25px;color:red;">

    </div>
</div>
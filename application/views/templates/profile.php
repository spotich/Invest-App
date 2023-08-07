<h2 class="pageName">Profile</h2>
<div class="container text-center">
    <div class="row">
        <div class="col-2"></div>
        <div class="col-8">
            <form method="post" action="">
                <div class="form-group row mb-5">
                    <div class="col-2"></div>
                    <div class="col-8">
                        <img class="profile-pic mb-5" src="img/person.jpg">
                        <input id="name" type="text" class="form-control form-control-lg mb-2" placeholder="Name" value="<?php echo $user["name"]; ?>" name="name">
                        <input id="surname" type="text" class="form-control form-control-lg mb-2" placeholder="Surname" value="<?php echo $user["surname"]; ?>" name="surname">
                        <input id="email" type="text" class="form-control form-control-lg mb-2" placeholder="Email" value="<?php echo $user["email"]; ?>" name="email">
                        <input id="oldPassword" type="hidden" class="form-control form-control-lg mb-2"
                               placeholder="Old Password" name="oldPassword">
                        <input id="password" type="hidden" class="form-control form-control-lg mb-2"
                               placeholder="New password" onkeyup="check();" name="password">
                        <input id="repeatPassword" type="hidden" class="form-control form-control-lg mb-2"
                               placeholder="Repeat new password" onkeyup="check();" name="repeatPassword">
                        <span id='message'></span>
                        <a id="change-password-btn">Change password</a>
                    </div>
                    <div class="col-2"></div>
                </div>
                <div class="row">
                    <div class="col"></div>
                    <button type="submit" class="btn btn-primary btn-lg col mb-5">Update</button>
                    <div class="col"></div>
                </div>
            </form>
        </div>
        <div class="col-2"></div>
    </div>
</div>

<script type="text/javascript" src="js/changePassword.js"></script>
<script type="text/javascript" src="js/validatePassword.js"></script>
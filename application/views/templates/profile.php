<h2 class="pageName">Profile</h2>
<div class="container text-center">
    <div class="row">
        <div class="col-2"></div>
        <div class="col-8">
            <form method="post" action="/profile" class="needs-validation" novalidate>
                <div class="form-group row mb-5">
                    <div class="col-2"></div>
                    <div class="col-8">
                        <img class="profile-pic mb-5" src="img/person.jpg">
                        <?php if ($message !== ''): ?>
                            <p class="error"><?php echo $message; ?></p>
                        <?php endif; ?>
                        <input id="name" type="text" class="form-control form-control-lg mb-2" placeholder="Name"
                               value="<?php echo $user["name"]; ?>" name="name" disabled>
                        <input id="surname" type="text" class="form-control form-control-lg mb-2" placeholder="Surname"
                               value="<?php echo $user["surname"]; ?>" name="surname" disabled>
                        <input id="email" type="text" class="form-control form-control-lg mb-2" placeholder="Email"
                               value="<?php echo $user["email"]; ?>" name="email" disabled>
                        <input required id="oldPassword" type="hidden" class="form-control form-control-lg mb-2"
                               placeholder="Old Password" name="oldPassword" pattern="(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,30}">
                        <div class="row">
                            <div class="col has-validation position-relative">
                                <input required id="password" type="hidden"
                                       class="form-control form-control-lg col"
                                       placeholder="New password" name="password"
                                       pattern="(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,30}"
                                       onkeyup="comparePassword()">
                                <div class="valid-tooltip">
                                    OK
                                </div>
                                <div class="invalid-tooltip text-start">
                                    Password should match following rules:
                                    <ul>
                                        <li>8-30 symbols long</li>
                                        <li>no whitespaces</li>
                                        <li>at least one uppercase letter (A-Z)</li>
                                        <li>at least one lowercase letter (a-z)</li>
                                        <li>at least one number (0-9)</li>
                                        <li>at least one special character (@$!%*?&)</li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col has-validation position-relative">
                                <input required id="repeatPassword" type="hidden"
                                       class="form-control form-control-lg col" placeholder="Repeat new password"
                                       name="repeatPassword" onkeyup="comparePassword()">
                                <div class="valid-tooltip">
                                    OK
                                </div>
                                <div class="invalid-tooltip">
                                    This field should match "Password" field
                                </div>
                            </div>
                        </div>


<!--                        <input id="password" type="hidden" class="form-control form-control-lg mb-2"-->
<!--                               placeholder="New password" onkeyup="comparePassword()" name="password">-->
<!--                        <input id="repeatPassword" type="hidden" class="form-control form-control-lg mb-2"-->
<!--                               placeholder="Repeat new password" onkeyup="comparePassword()" name="repeatPassword">-->
<!--                        <span id='message'></span>-->
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
<script type="text/javascript" src="js/formValidation.js"></script>
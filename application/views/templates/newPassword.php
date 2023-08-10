<div class="container">
    <div class="row">
        <div class="col-2"></div>
        <div class="modal-content col-10">
            <h2 class="pageName">Recover</h2>
            <p class="text-center">Create new password</p>
            <div class="container text-center">
                <div class="row">
                    <div class="col-2"></div>
                    <div class="col-8">
                        <form method="post" action="/recover" class="needs-validation" novalidate>
                            <?php if ($message !== ''): ?>
                                <p><?php echo $message; ?></p>
                            <?php endif; ?>
                            <div class="form-group row mb-5">
                                <div class="col has-validation position-relative">
                                    <input required id="password" type="password"
                                           class="form-control form-control-lg col"
                                           placeholder="Password" name="password"
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
                                    <input required id="repeatPassword" type="password"
                                           class="form-control form-control-lg col" placeholder="Repeat password"
                                           name="repeatPassword" onkeyup="comparePassword()"">
                                    <div class="valid-tooltip">
                                        OK
                                    </div>
                                    <div class="invalid-tooltip">
                                        This field should match "Password" field
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col"></div>
                                <button type="submit" class="btn btn-primary btn-lg col">Update password</button>
                                <div class="col"></div>
                            </div>
                        </form>
                    </div>
                    <div class="col-2"></div>
                </div>
            </div>
        </div>
        <div class="col-2"></div>
    </div>
</div>

<script type="text/javascript" src="js/formValidation.js"></script>
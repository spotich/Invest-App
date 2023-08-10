<div class="container">
    <div class="row">
        <div class="col-2"></div>
        <div class="modal-content col-10">
            <h2 class="pageName">Sign in</h2>
            <div class="container text-center">
                <div class="row">
                    <div class="col-2"></div>
                    <div class="col-8">
                        <form method="post" action="/login" class="needs-validation" novalidate>
                            <?php if ($message !== ''): ?>
                                <p class="error"><?php echo $message; ?></p>
                            <?php endif; ?>
                            <div class="row mb-2 ms-4">
                                <div class="col"></div>
                                <div class="col text-start">
                                    <a href="/recover">Forgot password?</a>
                                </div>
                            </div>
                            <div class="form-group row mb-5">
                                <div class="col has-validation position-relative">
                                    <input required id="email" type="email" class="form-control form-control-lg"
                                           placeholder="Email" name="email"
                                           pattern="(?!.{51})[a-z0-9_]+@[a-z]+\.[a-z]{2,3}">
                                    <div class="valid-tooltip">
                                        OK
                                    </div>
                                    <div class="invalid-tooltip">
                                        Email should contain 6-50 symbols
                                    </div>
                                </div>
                                <div class="col has-validation position-relative">
                                    <input required id="password" type="password"
                                           class="form-control form-control-lg col"
                                           placeholder="Password" name="password"
                                           pattern="(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,30}">
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
                            </div>
                            <div class="row">
                                <div class="col"></div>
                                <button type="submit" class="btn btn-primary btn-lg col">Sign In</button>
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
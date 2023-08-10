<div class="container">
    <div class="row">
        <div class="col-2"></div>
        <div class="modal-content col-10">
            <h2 class="pageName">Join us!</h2>
            <p class="text-center">Create personal account and become a member!</p>
            <div class="container text-center">
                <div class="row">
                    <div class="col-2"></div>
                    <div class="col-8">
                        <form method="post" action="/register" class="needs-validation" novalidate>
                            <?php if ($message !== ''): ?>
                                <p class="error"><?php echo $message; ?></p>
                            <?php endif; ?>
                            <div class="row mb-5">
                                <div class="col has-validation position-relative">
                                    <input required id="name" type="text" class="form-control form-control-lg col me-4"
                                           placeholder="Name" name="name" pattern="[A-Z][a-z]{1,29}" autocomplete="given-name">
                                    <div class="valid-tooltip">
                                        OK
                                    </div>
                                    <div class="invalid-tooltip">
                                        Length is 2-30 symbols. First letter is capital.
                                    </div>
                                </div>
                                <div class="col has-validation position-relative">
                                    <input required id="surname" type="text" class="form-control form-control-lg col"
                                           placeholder="Surname" name="surname" pattern="[A-Z][a-z]{1,29}" autocomplete="family-name">
                                    <div class="valid-tooltip">
                                        OK
                                    </div>
                                    <div class="invalid-tooltip">
                                        Length is 2-30 symbols. First letter is capital.
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-5">
                                <div class="col has-validation position-relative">
                                    <input required id="email" type="email" class="form-control form-control-lg"
                                           placeholder="Email" name="email" pattern="(?!.{51})[a-z0-9_]+@[a-z]+\.[a-z]{2,3}" autocomplete="email">
                                    <div class="valid-tooltip">
                                        OK
                                    </div>
                                    <div class="invalid-tooltip">
                                        Email should contain 6-50 symbols
                                    </div>
                                </div>
                                <div class="col position-relative">
                                    <select required id="role" class="form-select form-select-lg text-muted" name="role">
                                        <option value="Investor">Investor</option>
                                        <option value="Team Member">Team Member</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-5">
                                <div class="col has-validation position-relative">
                                    <input required id="password" type="password" class="form-control form-control-lg col me-4"
                                           placeholder="Password" name="password" pattern="(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,30}" onkeyup="comparePassword()">
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
                                           class="form-control form-control-lg col" placeholder="Repeat password" name="repeatPassword" onkeyup="comparePassword()">
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
                                <button type="submit" class="btn btn-primary btn-lg col">Sign Up</button>
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

<div class="container">
    <div class="row">
        <h1 id="title">Invest in startups and hold shares</h1>
    </div>
    <div class="row">
        <div class="col">
            <h2 class="number">50+</h2>
            <p>active startups<br>to invest in</p>
        </div>
        <div class="col">
            <h2 class="number">600+</h2>
            <p>investors hold<br>shares already</p>
        </div>
        <div class="col">
            <h2 class="number">400+</h2>
            <p>team members achieving<br>their goals</p>
        </div>
        <div class="col">
            <h2 class="number">$50k+</h2>
            <p>invested in projects<br>last month</p>
        </div>
    </div>
</div>

<div id="sign-up-modal" class="modal">
    <div class="container">
        <div class="row">
            <div class="col-2"></div>
            <div class="modal-content col-10">
                <h2 class="popup-title">Join us!</h2>
                <p class="text-center">Create personal account and become a member!</p>
                <div class="container text-center">
                    <div class="row">
                        <div class="col-2"></div>
                        <div class="col-8">
                            <form method="post" action="">
                                <div class="form-group row mb-2">
                                    <input required id="name" type="text" class="form-control form-control-lg col me-4"
                                           placeholder="Name">
                                    <input required id="surname" type="text" class="form-control form-control-lg col"
                                           placeholder="Surname">
                                </div>
                                <div class="form-group row mb-2">
                                    <input required id="email" type="text" class="form-control form-control-lg col me-4"
                                           placeholder="Email">
                                    <select required id="role" class="form-control form-control-lg text-muted col" name="Role">
                                        <option value="investor">Investor</option>
                                        <option value="team member">Team Member</option>
                                    </select>
                                </div>
                                <div class="form-group row mb-5">
                                    <input required id="password" type="password" class="form-control form-control-lg col me-4"
                                           placeholder="Password">
                                    <input required id="repeatPassword" type="password"
                                           class="form-control form-control-lg col" placeholder="Repeat password">
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
</div>
<div id="sign-in-modal" class="modal">
    <div class="container">
        <div class="row">
            <div class="col-2"></div>
            <div class="modal-content col-10">
                <h2 class="popup-title">Welcome</h2>
                <p class="text-center">Sign in to continue</p>
                <div class="container text-center">
                    <div class="row">
                        <div class="col-2"></div>
                        <div class="col-8">
                            <form method="post" action="/login">
                                <?php if (!empty($pageData['error'])): ?>
                                    <p><?php echo $pageData['error']; ?></p>
                                <?php endif; ?>
                                <div class="form-group row mb-5">
                                    <div class="col-2"></div>
                                    <div class="col-8">
                                        <input required id="email" name="email" type="text"
                                               class="form-control form-control-lg mb-2" placeholder="Email">
                                        <input required id="password" name="password" type="password"
                                               class="form-control form-control-lg mb-3" placeholder="Password">
                                        <a href="#">Forgot password?</a>
                                    </div>
                                    <div class="col-2"></div>
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
</div>

<script type="text/javascript" src="js/popup.js"></script>
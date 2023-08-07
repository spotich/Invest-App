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
                        <form method="post" action="/register">
                            <?php if ($message !== ''): ?>
                                <p class="error"><?php echo $message; ?></p>
                            <?php endif; ?>
                            <div class="form-group row mb-2">
                                <input required id="name" type="text" class="form-control form-control-lg col me-4"
                                       placeholder="Name" name="name">
                                <input required id="surname" type="text" class="form-control form-control-lg col"
                                       placeholder="Surname" name="surname">
                            </div>
                            <div class="form-group row mb-2">
                                <input required id="email" type="text" class="form-control form-control-lg col me-4"
                                       placeholder="Email" name="email">
                                <select required id="role" class="form-control form-control-lg text-muted col" name="role">
                                    <option value="Investor">Investor</option>
                                    <option value="Team Member">Team Member</option>
                                </select>
                            </div>
                            <div class="form-group row mb-5">
                                <input required id="password" type="password" class="form-control form-control-lg col me-4"
                                       placeholder="Password" name="password" onkeyup="check();">
                                <input required id="repeatPassword" type="password"
                                       class="form-control form-control-lg col" placeholder="Repeat password" name="repeatPassword" onkeyup="check();">
                                <span id='message'></span>
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

<script type="text/javascript" src="js/validatePassword.js"></script>
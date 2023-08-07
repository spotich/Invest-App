<div class="container">
    <div class="row">
        <div class="col-2"></div>
        <div class="modal-content col-10">
            <h2 class="pageName">Reset</h2>
            <p class="text-center">We will send verification link to your email.</p>
            <div class="container text-center">
                <div class="row">
                    <div class="col-2"></div>
                    <div class="col-8">
                        <form method="post" action="/recover">
                            <?php if ($message !== ''): ?>
                                <p><?php echo $message; ?></p>
                            <?php endif; ?>
                            <div class="form-group row mb-5">
                                <div class="col-2"></div>
                                <div class="col-8">
                                    <input required id="email" name="email" type="text"
                                           class="form-control form-control-lg mb-2" placeholder="Email">
                                    <input required id="password" name="password" type="password"
                                           class="form-control form-control-lg mb-2" placeholder="New password" onkeyup="check();">
                                    <input required id="repeatPassword" name="repeatPassword" type="password"
                                           class="form-control form-control-lg mb-3" placeholder="Repeat new password" onkeyup="check();">
                                    <span id='message'></span>
                                </div>
                                <div class="col-2"></div>
                            </div>

                            <div class="row">
                                <div class="col"></div>
                                <button type="submit" class="btn btn-primary btn-lg col">Send</button>
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
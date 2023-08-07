<div class="container">
    <div class="row">
        <div class="col-2"></div>
        <div class="modal-content col-10">
            <h2 class="pageName">Sign in</h2>
<!--            <p class="text-center">Sign in to continue</p>-->
            <div class="container text-center">
                <div class="row">
                    <div class="col-2"></div>
                    <div class="col-8">
                        <form method="post" action="/authenticate">
                            <?php if ($message !== ''): ?>
                                <p><?php echo $message; ?></p>
                            <?php endif; ?>
                            <div class="form-group row mb-5">
                                <div class="col-2"></div>
                                <div class="col-8">
                                    <input required id="email" name="email" type="text"
                                           class="form-control form-control-lg mb-2" placeholder="Email">
                                    <input required id="password" name="password" type="password"
                                           class="form-control form-control-lg mb-3" placeholder="Password">
                                    <a href="/recover">Forgot password?</a>
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
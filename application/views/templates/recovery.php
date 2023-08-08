<div class="container">
    <div class="row">
        <div class="col-2"></div>
        <div class="modal-content col-10">
            <h2 class="pageName">Enter your email</h2>
            <p class="text-center">We will send a link to recover the password</p>
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
                                </div>
                                <div class="col-2"></div>
                            </div>
                            <div class="row">
                                <div class="col"></div>
                                <button type="submit" class="btn btn-primary btn-lg col">Send link</button>
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
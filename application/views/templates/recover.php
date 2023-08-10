<div class="container">
    <div class="row">
        <div class="col-2"></div>
        <div class="modal-content col-10">
            <h2 class="pageName">Enter email</h2>
            <p class="text-center">We will send a link to recover the password</p>
            <div class="container text-center">
                <div class="row">
                    <div class="col-2"></div>
                    <div class="col-8">
                        <form method="post" action="/recover" class="needs-validation" novalidate>
                            <?php if ($message !== ''): ?>
                                <p class="error"><?php echo $message; ?></p>
                            <?php endif; ?>
                            <div class="form-group row mb-5">
                                <div class="col-2"></div>
                                <div class="col-8">
                                    <div class="col has-validation position-relative">
                                        <input required id="email" type="email" class="form-control form-control-lg"
                                               placeholder="Email" name="email" pattern="(?!.{51})[a-z0-9]+@[a-z]+\.[a-z]{2,3}">
                                        <div class="valid-tooltip">
                                            OK
                                        </div>
                                        <div class="invalid-tooltip">
                                            Email should contain 6-50 symbols
                                        </div>
                                    </div>
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

<script type="text/javascript" src="js/formValidation.js"></script>
<nav class="navbar navbar-expand-xl fixed-top mx-lg-5 mt-4 ">
    <div class="container-fluid">
        <a class="navbar-brand mx-4" href="/">Invest-App</a>
        <button class="navbar-toggler button-sm" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarsExample04"
                aria-controls="navbarsExample04" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse " id="navbarsExample04">
            <ul class="navbar-nav me-auto mb-2 mb-md-0">
                <?php echo $navigation; ?>
            </ul>
            <button type="button" class="btn btn-lg btn-light me-3 px-4" onclick="location.href='/login'">
                <img class="icon" src="../img/login.png">
                Sign in
            </button>
            <button type="button" class="btn btn-lg btn-primary px-4 me-3" onclick="location.href='/register'">
                <img class="icon" src="../img/add-friend.png">
                Join us
            </button>
        </div>
    </div>
</nav>
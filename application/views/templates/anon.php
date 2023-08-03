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
                <li class="nav-item active me-3 py-2 px-4 my-2 my-lg-0">
                    <a class="nav-link" href="#" onclick="showModal(signInModal); return false;" draggable="false">
                        <img src="img/shuttle.png">
                        Projects
                    </a>
                </li>
                <li class="nav-item me-3 py-2 px-4 mb-2 mb-lg-0">
                    <a class="nav-link" href="#" onclick="showModal(signInModal); return false;" draggable="false">
                        <img src="img/diagram.png">
                        Analytics
                    </a>
                </li>
                <li class="nav-item me-3 py-2 px-4 mb-3 mb-lg-0">
                    <a class="nav-link" href="#" onclick="showModal(signInModal); return false;" draggable="false">
                        <img src="img/website.png">
                        Profile
                    </a>
                </li>
            </ul>
            <button id="sign-in-button" type="button" class="btn btn-lg btn-light me-3 px-4">
                <img src="img/login.png">
                Sign in
            </button>
            <button id="sign-up-button" type="button" class="btn btn-lg btn-primary px-4 me-3">
                <img src="img/add-friend.png">
                Join us
            </button>
        </div>
    </div>
</nav>
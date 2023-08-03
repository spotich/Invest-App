<nav class="navbar navbar-expand-xl fixed-top mx-lg-5 mt-4 ">
    <div class="container-fluid">
        <a class="navbar-brand mx-4" href="/">Invest-App</a>
        <button class="navbar-toggler button-sm" type="button" data-bs-toggle="collapse"
                data-bs-target="#collapse-part"
                aria-controls="collapse-part" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse " id="collapse-part">
            <ul class="navbar-nav me-auto mb-2 mb-md-0">
                <li class="nav-item active me-3 py-2 px-4 my-2 my-lg-0">
                    <a class="nav-link" href="#" draggable="false">
                        <img src="img/shuttle.png">
                        Projects
                    </a>
                </li>
                <li class="nav-item me-3 py-2 px-4 mb-2 mb-lg-0">
                    <a class="nav-link" href="#" draggable="false">
                        <img src="img/diagram.png">
                        Analytics
                    </a>
                </li>
                <li class="nav-item me-3 py-2 px-4 mb-3 mb-lg-0">
                    <a class="nav-link" href="/profile" draggable="false">
                        <img src="img/website.png">
                        Profile
                    </a>
                </li>
            </ul>
            <div class="d-flex me-3">
                <img class="avatar flex-shrink-0" src="img/person.jpg">
                <div class="container ">
                    <div class="row gx-0">
                        <p class="mb-0 text-left"><b><?php echo $user["name"]; ?> <?php echo $user["surname"]; ?></b></p>
                    </div>
                    <div class="row gx-0">
                        <p class="mb-0 text-left role"><?php echo $user["role"]; ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</nav>
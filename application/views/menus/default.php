<nav class="navbar navbar-expand-xl fixed-top mx-lg-5 mt-4 ">
    <div class="container-fluid">
        <a class="navbar-brand mx-4" href="/">Invest-App</a>
        <button class="navbar-toggler button-sm" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarsExample04"
                aria-controls="navbarsExample04" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse " id="navbarsExample04">
            <ul id="nav-item-group" class="navbar-nav me-auto mb-2 mb-md-0">
                <?php foreach ($navItems as $item): ?>
                    <li class="nav-item me-3 py-2 px-4 my-2 my-lg-0">
                        <a class="nav-link" href="<?php echo $item['href']; ?>" draggable="false">
                            <img class="icon" src="../img/<?php echo $item['icon']; ?>">
                            <?php echo $item['name']; ?>
                        </a>
                    </li>
                <?php endforeach; ?>
            </ul>
            <?php echo $buttons; ?>
            <?php echo $miniature; ?>
        </div>
    </div>
</nav>
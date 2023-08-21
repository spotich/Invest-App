<div class="d-flex me-3 align-items-center">
    <a href="/profile" draggable="false">
        <img class="avatar flex-shrink-0" src="../img/users/<?php echo $user->avatar; ?>">
    </a>
    <div class="container me-3">
        <div class="row gx-0">
            <p class="mb-0 text-left"><b><?php echo $user->name; ?> <?php echo $user->surname; ?></b></p>
        </div>
        <div class="row gx-0">
            <p class="mb-0 text-left role"><?php echo $user->role; ?></p>
        </div>
    </div>
    <a class="nav-link" href="/logout" draggable="false">
        <img class="icon" src="../img/logout.png">
    </a>
</div>
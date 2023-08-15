<div class="container">
    <h1 class="pageName"><?php echo $project['name']; ?></h1>
    <div class="row ">
        <div class="col-1"></div>
        <div class="col-10 project">
            <h2 class="mb-5 mt-3"><?php echo $project['description_short']; ?></h2>
            <img src="/img/projects/<?php echo $project['cover']; ?>"
                 class="img-fluid w-100 border border-2 rounded-3 mb-5">
            <h3 class="mb-5"><?php echo $project['description_long']; ?></h3>
            <div class="row row-cols-sm-1 row-cols-md-2 row-cols-lg-3">
                <?php foreach ($project['team_members'] as $team_member): ?>
                    <div class="col d-flex">
                        <div class="border border-2 rounded-3 p-4 mb-4">
                            <img src="/img/users/<?php echo $team_member['avatar']; ?>"
                                 class="img-fluid rounded-3 mb-3">
                            <h4><b><?php echo $team_member['name']; ?> <?php echo $team_member['surname']; ?></b></h4>
                            <h5><?php echo $team_member['role']; ?></h5>
                            <p><?php echo $team_member['description']; ?></p>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
            <h5 class="mt-5">We have collected <?php echo $project['progressbar']; ?>%</h5>
            <div class="row">
                <div class="col-10">
                    <div class="progress" role="progressbar" aria-label="Animated striped example" aria-valuemin="0"
                         aria-valuemax="100">
                        <div class="progress-bar progress-bar-striped progress-bar-animated"
                             style="width: <?php echo $project['progressbar']; ?>%"></div>
                    </div>
                </div>
                <div class="col-2">
                    <button id="payment-button" type="button" class="btn btn-lg btn-primary w-100">
                        Invest
                    </button>
                </div>
            </div>
            <div class="row">
                <div class="col-10 d-flex justify-content-between">
                    <p>0</p>
                    <p><?php echo $project['goal']; ?></p>
                </div>
                <div class="col-2"></div>
            </div>
            <div id="payment" class="modal">
                <div class="container">
                    <div class="row">
                        <div class="col-2"></div>
                        <div class="modal-content col-10">
                            <h2 class="popup-title"><?php echo $project['name']; ?></h2>
                            <p class="text-center">To commit payment fill the form down below</p>
                            <div class="container text-center">
                                <div class="row">
                                    <div class="col"></div>
                                    <div class="col">
                                        <form method="post" action="">
                                            <div class="form-group mb-5">
                                                <div class="row">
                                                    <input id="email" type="text"
                                                           class="form-control form-control-lg mb-2"
                                                           placeholder="Credit Card Number" maxlength="16">
                                                </div>
                                                <div class="row">
                                                    <input id="expiration-date" type="text" placeholder="03/23"
                                                           class="form-control form-control-lg col me-3" maxlength="4">
                                                    <input id="code-cvv" type="password"
                                                           class="form-control form-control-lg col"
                                                           placeholder="CVV" pattern="^\d{3}$" maxlength="3">
                                                </div>
                                            </div>
                                            <div class="row">
                                                <button type="submit" class="btn btn-primary btn-lg mb-5">Invest
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="col"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-2"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-1"></div>
    </div>
</div>

<script type="text/javascript" src="../js/popup.js"></script>
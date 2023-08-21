<div class="container">
    <h1 class="pageName"><?php echo $project->name; ?></h1>
    <div class="row ">
        <div class="col-1"></div>
        <div class="col-10 project">
            <h2 class="mb-5 mt-3"><?php echo $project->descriptionShort; ?></h2>
            <h2 class="mt-5 mb-4 text-center test">We have collected <span class="num"><?php echo $project->progress; ?></span>$</h2>
            <div class="row mb-2">
                <div class="col-9">
                    <div class="progress" role="progressbar" aria-label="Animated striped example" aria-valuemin="0"
                         aria-valuemax="100">
                        <div class="progress-bar progress-bar-striped progress-bar-animated"
                             style="width: <?php echo $project->progressBar; ?>%"></div>
                    </div>
                </div>
                <div class="col-3">
                    <button type="button" class="btn btn-lg btn-primary w-100 payment-button">
                        Invest
                    </button>
                </div>
            </div>
            <div class="row">
                <div class="col-9 d-flex justify-content-between">
                    <p>0$</p>
                    <p><span class="num"><?php echo $project->goal; ?></span>$</p>
                </div>
                <div class="col-3 text-center">
                    <p>and return 10% annually</p>
                </div>
            </div>
            <img src="/img/projects/<?php echo $project->cover; ?>"
                 class="img-fluid w-100 border border-2 rounded-3 mb-5 mt-4">
            <h3 class="mb-5"><?php echo $project->descriptionLong; ?></h3>

            <div id="carouselExampleCaptions" class="carousel slide mb-5">
                <div class="carousel-indicators">
                    <?php for ($i = 0 ; $i < sizeof($project->slides); $i++): ?>
                        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="<?php echo $i; ?>" <?php if ($i == 0) echo 'class="active"'; ?> aria-current="true" aria-label="Slide <?php echo $i + 1; ?>"></button>
                    <?php endfor;?>
                </div>
                <div class="carousel-inner rounded">
                    <?php for ($i = 0 ; $i < sizeof($project->slides); $i++): ?>
                        <?php if ($i === 0): ?>
                            <div class="carousel-item active">
                        <?php else: ?>
                            <div class="carousel-item">
                        <?php endif;?>
                            <img src="/img/projects/<?php echo $project->slides[$i]['cover']; ?>" class="carousel-img d-block img-fluid" alt="...">
                            <div class="carousel-caption d-none d-md-block">
                                <h5><?php echo $project->slides[$i]['title']; ?></h5>
                                <p><?php echo $project->slides[$i]['description']; ?></p>
                            </div>
                        </div>
                    <?php endfor;?>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>

            <div class="row row-cols-sm-1 row-cols-md-2 row-cols-lg-3">
                <?php foreach ($project->teamMembers as $teamMember): ?>
                    <div class="col d-flex">
                        <div class="border border-2 rounded-3 p-4 mb-4">
                            <img src="/img/users/<?php echo $teamMember['avatar']; ?>"
                                 class="img-fluid rounded-3 mb-3">
                            <h4><b><?php echo $teamMember['name']; ?> <?php echo $teamMember['surname']; ?></b></h4>
                            <h5><?php echo $teamMember['role']; ?></h5>
                            <p><?php echo $teamMember['description']; ?></p>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
            <h2 class="mt-5 mb-4 text-center test">We have collected <span class="num"><?php echo $project->progress; ?></span>$</h2>
            <div class="row mb-2">
                <div class="col-9">
                    <div class="progress" role="progressbar" aria-label="Animated striped example" aria-valuemin="0"
                         aria-valuemax="100">
                        <div class="progress-bar progress-bar-striped progress-bar-animated"
                             style="width: <?php echo $project->progressBar; ?>%"></div>
                    </div>
                </div>
                <div class="col-3">
                    <button type="button" class="btn btn-lg btn-primary w-100 payment-button">
                        Invest
                    </button>
                </div>
            </div>
            <div class="row">
                <div class="col-9 d-flex justify-content-between">
                    <p>0$</p>
                    <p><span class="num"><?php echo $project->goal; ?></span>$</p>
                </div>
                <div class="col-3 text-center">
                    <p>and return 10% annually</p>
                </div>
            </div>
            <div id="payment" class="modal">
                <div class="container">
                    <div class="row">
                        <div class="col-2"></div>
                        <div class="modal-content col-10">
                            <h2 class="popup-title"><?php echo $project->name; ?></h2>
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
<script type="text/javascript" src="../js/numberFormat.js"></script>это с
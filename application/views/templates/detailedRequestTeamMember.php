<div class="container">
    <h1 class="pageName"><?php echo $request->name; ?></h1>
    <div class="row">
        <div class="col-1"></div>
        <div class="col-10 project">
            <?php if ($request->status === 'pending'): ?>
            <div class="alert alert-secondary text-center mb-5" role="alert">
                Your request will be reviewed soon!
            </div>
            <?php elseif ($request->status === 'active'): ?>
            <div class="alert alert-success text-center mb-5" role="alert">
                Congratulations! Your project is now active!
            </div>
            <?php else: ?>
            <div class="alert alert-danger mb-5" role="alert">
                <?php echo $request->message; ?>
            </div>
            <?php endif; ?>
            <h2>Name</h2>
            <p class="mb-5 mt-3"><?php echo $request->name; ?></p>
            <h2>Created at</h2>
            <p class="mb-5 mt-3"><?php echo $request->created_at; ?></p>
            <h2>Goal</h2>
            <p class="mb-5 mt-3"><?php echo $request->goal; ?></p>
            <h2>Tags</h2>
            <div class="row row-cols-auto mb-5 mt-3">
                <?php foreach ($request->tags as $tag): ?>
                    <div class="col border border-2 rounded-3 px-3 py-1 mx-1 my-1"><?php echo $tag; ?></div>
                <?php endforeach; ?>
            </div>
            <h2>Short Description</h2>
            <textarea class="form-control mt-3 mb-5" rows="3" readonly><?php echo $request->description_short; ?></textarea>
            <h2>Long Description</h2>
            <textarea class="form-control mt-3 mb-5" rows="15" readonly><?php echo $request->description_long; ?></textarea>
            <h2>Cover</h2>
            <img src="/img/projects/<?php echo $request->cover; ?>"
                 class="img-fluid w-100 border border-2 rounded-3 mb-5 mt-4" draggable="false">
            <h2>Carousel</h2>
            <div id="carouselExampleCaptions" class="carousel slide mb-5 mt-3">
                <div class="carousel-indicators">
                    <?php for ($i = 0; $i < sizeof($request->slides); $i++): ?>
                        <button type="button" data-bs-target="#carouselExampleCaptions"
                                data-bs-slide-to="<?php echo $i; ?>" <?php if ($i == 0) echo 'class="active"'; ?>
                                aria-current="true" aria-label="Slide <?php echo $i + 1; ?>"></button>
                    <?php endfor; ?>
                </div>
                <div class="carousel-inner rounded">
                    <?php for ($i = 0; $i < sizeof($request->slides); $i++): ?>
                        <div class="carousel-item <?php if ($i === 0) echo 'active'; ?>">
                            <img src="/img/projects/<?php echo $request->slides[$i]['cover']; ?>"
                                 class="carousel-img d-block img-fluid" alt="..." draggable="false">
                            <div class="carousel-caption d-none d-md-block">
                                <h5><?php echo $request->slides[$i]['title']; ?></h5>
                                <p><?php echo $request->slides[$i]['description']; ?></p>
                            </div>
                        </div>
                    <?php endfor; ?>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions"
                            data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions"
                            data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </div>
            <h2>Team Members</h2>
            <div class="row row-cols-sm-1 row-cols-md-2 row-cols-lg-3 mb-5 mt-3">
                <?php foreach ($request->team_members as $team_member): ?>
                    <div class="col d-flex">
                        <div class="border border-2 rounded-3 p-4 mb-4">
                            <img src="/img/users/<?php echo $team_member['avatar']; ?>"
                                 class="img-fluid rounded-3 mb-3" draggable="false">
                            <h4><b><?php echo $team_member['name']; ?> <?php echo $team_member['surname']; ?></b></h4>
                            <h5><?php echo $team_member['role']; ?></h5>
                            <p><?php echo $team_member['description']; ?></p>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
        <div class="col-1"></div>
    </div>
</div>
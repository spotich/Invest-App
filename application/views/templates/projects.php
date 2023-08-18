<div class="container-lg">
    <h1 class="pageName">Discover projects</h1>
    <div class="container-lg projects">
        <?php foreach($projects as $project): ?>
            <a href="projects/<?php echo $project->id; ?>" draggable="false">
                <div class="container-lg row border border-2 rounded-3 mb-4 px-5 py-4">
                    <div class="col-xl-6 col-xxl container mb-4 mb-xl-0">
                        <img src="img/projects/<?php echo $project->cover; ?>" class="img-fluid w-100">
                    </div>
                    <div class="col-xl-6 col-xxl align-self-center mb-4 mb-xl-0">
                        <div class="row mb-3">
                            <h2><?php echo $project->name; ?></h2>
                        </div>
                        <div class="row">
                            <h3><?php echo $project->descriptionShort; ?></h3>
                        </div>
                    </div>

                    <div class="col-xl col-xxl-3 align-self-center">
                        <div class="row mb-3">
                            <h2>Category</h2>
                        </div>
                        <div class="row row-cols-auto mb-2">
                            <?php foreach ($project->tags as $tag): ?>
                                <div class="col border border-2 rounded-3 px-3 py-1 mx-1 my-1"><?php echo $tag; ?></div>
                            <?php endforeach;?>
                        </div>
                    </div>
                </div>
            </a>
        <?php endforeach;?>
    </div>
</div>
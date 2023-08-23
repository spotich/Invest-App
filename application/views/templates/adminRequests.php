<div class="container-lg">
    <h1 class="pageName">Project Requests</h1>
    <div class="container-lg projects">
        <div class="row row-cols-sm-1 row-cols-md-2 row-cols-lg-3">
            <?php foreach ($requests as $request): ?>
            <a href="requests/<?php echo $request->id; ?>" draggable="false">
                <div class="col d-flex">
                    <div class="border border-2 rounded-3 p-4 mb-4">
                        <img src="/img/projects/<?php echo $request->cover; ?>"
                             class="img-fluid rounded-3 mb-3" draggable="false">
                        <h4><b><?php echo $request->name; ?></b></h4>
                        <h5><?php echo $request->created_at; ?></h5>
                        <div class="row row-cols-auto mt-3">
                            <?php foreach ($request->tags as $tag): ?>
                                <div class="col border border-2 rounded-3 px-3 py-1 mx-1 my-1"><?php echo $tag; ?></div>
                            <?php endforeach;?>
                        </div>
                    </div>
                </div>
            </a>
            <?php endforeach; ?>
        </div>
    </div>
</div>
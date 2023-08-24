<div class="container-lg">
    <h1 class="pageName">My Requests</h1>
    <div class="container-lg projects">
        <h2 class="mb-3 pending">Pending</h2>
        <div class="row row-cols-sm-1 row-cols-md-2 row-cols-lg-3 mb-5">
            <?php foreach ($pendingRequests as $request): ?>
                <div class="col d-flex">
                    <div class="border border-2 rounded-3 p-4 mb-4">
                        <a href="my-requests/<?php echo $request->id; ?>" draggable="false">
                            <img src="/img/projects/<?php echo $request->cover; ?>"
                                 class="img-fluid rounded-3 mb-3" draggable="false">
                            <h4><b><?php echo $request->name; ?></b></h4>
                            <h5><?php echo $request->created_at; ?></h5>
                            <div class="row row-cols-auto mt-3">
                                <?php foreach ($request->tags as $tag): ?>
                                    <div class="col border border-2 rounded-3 px-3 py-1 mx-1 my-1"><?php echo $tag; ?></div>
                                <?php endforeach; ?>
                            </div>
                        </a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        <h2 class="mb-3 error">Declined</h2>
        <div class="row row-cols-sm-1 row-cols-md-2 row-cols-lg-3 mb-5">
            <?php foreach ($declinedRequests as $request): ?>
                <div class="col d-flex">
                    <div class="border border-2 rounded-3 p-4 mb-4">
                        <a href="my-requests/<?php echo $request->id; ?>" draggable="false">
                            <img src="/img/projects/<?php echo $request->cover; ?>"
                                 class="img-fluid rounded-3 mb-3" draggable="false">
                            <h4><b><?php echo $request->name; ?></b></h4>
                            <h5><?php echo $request->created_at; ?></h5>
                            <div class="row row-cols-auto mt-3">
                                <?php foreach ($request->tags as $tag): ?>
                                    <div class="col border border-2 rounded-3 px-3 py-1 mx-1 my-1"><?php echo $tag; ?></div>
                                <?php endforeach; ?>
                            </div>

                        </a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        <h2 class="mb-3 fine">Active</h2>
        <div class="row row-cols-sm-1 row-cols-md-2 row-cols-lg-3 mb-5">
            <?php foreach ($activeRequests as $request): ?>
                <div class="col d-flex">
                    <div class="border border-2 rounded-3 p-4 mb-4">
                        <a href="my-requests/<?php echo $request->id; ?>" draggable="false">
                            <img src="/img/projects/<?php echo $request->cover; ?>"
                                 class="img-fluid rounded-3 mb-3" draggable="false">
                            <h4><b><?php echo $request->name; ?></b></h4>
                            <h5><?php echo $request->created_at; ?></h5>
                            <div class="row row-cols-auto mt-3">
                                <?php foreach ($request->tags as $tag): ?>
                                    <div class="col border border-2 rounded-3 px-3 py-1 mx-1 my-1"><?php echo $tag; ?></div>
                                <?php endforeach; ?>
                            </div>
                        </a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>
<div class="container">
    <h2 class="pageName">Create Request</h2>
    <div class="row">
        <div class="col-1"></div>
        <div class="col-10 project">
            <form method="post" action="/createRequest" class="needs-validation mb-5" novalidate>
                <?php if ($message !== ''): ?>
                    <p class="error"><?php echo $message; ?></p>
                <?php endif; ?>
                <div class="row mb-5">
                    <div class="col has-validation position-relative">
                        <div class="form-floating">
                            <input required id="name" type="text" class="form-control form-control-lg col me-4"
                                   placeholder="Project name" name="name" pattern="[A-Z][a-z]{1,29}">
                            <label for="name">Project name</label>
                            <div class="valid-tooltip">
                                OK
                            </div>
                            <div class="invalid-tooltip">
                                Length is 2-30 symbols. First letter is capital.
                            </div>
                        </div>
                    </div>
                    <div class="col has-validation position-relative">
                        <div class="form-floating">
                            <input required id="goal" type="text" class="form-control form-control-lg col"
                                   placeholder="Goal" name="surname" pattern="[1-9][0-9]{1,29}">
                            <label for="goal">Project goal</label>
                            <div class="valid-tooltip">
                                OK
                            </div>
                            <div class="invalid-tooltip">
                                Only numbers allowed.
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mb-5">
                    <div class="col has-validation position-relative">
                        <div class="form-floating">
                            <textarea required class="form-control mb-3 h-100" id="description-short" rows="2" minlength="100" maxlength="200"
                                      placeholder="Short description of the project" name="description_short"></textarea>
                            <label for="description-short">Short description of your project</label>
                            <div class="valid-tooltip">
                                OK
                            </div>
                            <div class="invalid-tooltip">
                               Short description should contain 100 - 200 symbols
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mb-5">
                    <div class="col has-validation position-relative">
                        <div class="form-floating">
                            <textarea required class="form-control mb-3 h-100" id="description-long" rows="8" minlength="500" maxlength="2000"
                                      placeholder="Short description of the project" name="description_long"></textarea>
                            <label for="description-long">Long description of your project</label>
                            <div class="valid-tooltip">
                                OK
                            </div>
                            <div class="invalid-tooltip">
                                Long description should contain 500 - 2000 symbols
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mb-5">
                    <div class="col has-validation position-relative">
                        <label for="cover" class="form-label">Project cover</label>
                        <input required id="cover" name="cover" type="file" class="form-control" accept=".jpg,.gif,.png">
                        <div class="valid-tooltip">
                            OK
                        </div>
                        <div class="invalid-tooltip">
                            Cover is required. JPEG, JPG, PNG are allowed.
                        </div>
                    </div>
                </div>
                <div class="row mb-5">
                    <div class="col has-validation position-relative">
                        <label for="cover" class="form-label">Carousel slides</label>
                        <input required id="cover" name="cover" type="file" class="form-control" accept=".jpeg,.jpg,.png" multiple>
                        <div class="valid-tooltip">
                            OK
                        </div>
                        <div class="invalid-tooltip">
                            Slides are required. JPEG, JPG, PNG are allowed.
                        </div>
                    </div>
                </div>
                <div class="row mb-5">
                    <div class="col has-validation position-relative">
                        <label for="tags" class="form-label">Related tags</label>
                        <select class="form-select" multiple required id="tags" name="tags[]" size="<?php echo sizeof($tags); ?>">
                            <?php foreach($tags as $tag): ?>
                                <option value="<?php echo $tag['id']; ?>"><?php echo $tag['name']; ?></option>
                            <?php endforeach; ?>
                        </select>
                        <div class="valid-tooltip">
                            OK
                        </div>
                        <div class="invalid-tooltip">
                            Slides are required. JPEG, JPG, PNG are allowed.
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col"></div>
                    <button type="submit" class="btn btn-primary btn-lg col">Create Request</button>
                    <div class="col"></div>
                </div>
            </form>
        </div>
        <div class="col-1"></div>
    </div>
</div>

<script type="text/javascript" src="js/formValidation.js"></script>
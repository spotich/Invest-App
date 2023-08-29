document.getElementById('add-slide').addEventListener('click', addSlide);
let slideCount = 0;

function addSlide() {
    slideCount++;
    let card = document.createElement('div');
    card.setAttribute("class", "col d-flex slide-card");
    card.setAttribute("id", `slide-${slideCount}`);
    card.innerHTML = `
        <div class="border border-2 rounded-3 p-4 mb-4 has-validation">
            <input class="form-control mb-2" type="file" name="slides[${slideCount}][cover]" accept=".jpeg,.jpg,.png" required>
            <input class="form-control mb-2" type="text" name="slides[${slideCount}][title]" placeholder="title" required>
            <input class="form-control mb-3" type="text" name="slides[${slideCount}][description]" placeholder="description" required>
            <button class="btn btn-danger w-100" type="button" onclick="removeSlide(${slideCount})">Remove</button>
        </div>
    `;
    document.getElementById('slide-cards').appendChild(card);
}

function removeSlide(id) {
    document.getElementById('slide-cards').removeChild(document.getElementById(`slide-${id}`));
    slideCount--;
}
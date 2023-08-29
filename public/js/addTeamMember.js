let availableMembers = document.getElementById('select-members');
availableMembers.addEventListener('change', () => {
    let selectedMembers = availableMembers.selectedOptions;
    let selectedMembersIds = Array.from(selectedMembers).map(({ value }) => value);

    const displayedMembers = document.getElementsByClassName('member-card');
    const displayedMembersIds = [];
    for (let i = 0; i < displayedMembers.length; i++) {
        displayedMembersIds.push(displayedMembers[i].id);
    }

    for (let i = 0; i < displayedMembersIds.length; i++) {
        if (!selectedMembersIds.includes(displayedMembersIds[i])) {
            removeCard(displayedMembersIds[i]);
        }
    }

    for (let i = 0; i < selectedMembersIds.length; i++) {
        if (!displayedMembersIds.includes(selectedMembersIds[i])) {
            addCard(selectedMembersIds[i]);
        }
    }
});

function addCard(id) {
    let card = document.createElement('div');
    card.setAttribute("class", "col d-flex member-card");
    card.setAttribute("id", `${id}`);
    card.innerHTML = `
        <div class="border border-2 rounded-3 p-4 mb-4 has-validation">
            <img src="/img/users/${teamMembers[id].avatar}" class="img-fluid rounded-3 mb-3">
            <h4 class="mb-3"><b>${teamMembers[id].name} ${teamMembers[id].surname}</b></h4>
            <input class="form-control mb-2" type="text" name="team_members[${id}][role]" placeholder="role" required>
            <input class="form-control" type="text" name="team_members[${id}][description]" placeholder="description" required>
        </div>
    `;
    document.getElementById('member-cards').appendChild(card);
}
function removeCard(id) {
    document.getElementById('member-cards').removeChild(document.getElementById(id));
}
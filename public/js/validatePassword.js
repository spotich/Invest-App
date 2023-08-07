let check = function() {
    if (document.getElementById('password').value !== '' && document.getElementById('repeatPassword').value !== '' && document.getElementById('password').value == document.getElementById('repeatPassword').value) {
        document.getElementById('message').innerHTML = 'Matching. OK.';
        document.getElementById('message').classList.remove('error');
        document.getElementById('message').classList.add('fine');
    } else {
        document.getElementById('message').innerHTML = 'Not matching';
        document.getElementById('message').classList.remove('fine');
        document.getElementById('message').classList.add('error')
    }
}
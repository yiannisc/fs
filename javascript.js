function buttonToggle($me){
    if ($me == 0) {
        document.getElementById('citizen').style.display='block';
        document.getElementById('organisation').style.display='none';
        document.getElementById('ctype').value=0;
        document.getElementById('but0').style.backgroundColor = '#0084bf';
        document.getElementById('but1').style.backgroundColor = '#20a4df';
        document.getElementById('but2').style.backgroundColor = '#20a4df';
    }
    if ($me == 1) {
        document.getElementById('citizen').style.display='none';
        document.getElementById('organisation').style.display='block';
        document.getElementById('ctype').value=1;
        document.getElementById('but0').style.backgroundColor = '#20a4df';
        document.getElementById('but1').style.backgroundColor = '#0084bf';
        document.getElementById('but2').style.backgroundColor = '#20a4df';
    }
    if ($me == 2) {
        document.getElementById('citizen').style.display='none';
        document.getElementById('organisation').style.display='none';
        document.getElementById('ctype').value=2;
        document.getElementById('but0').style.backgroundColor = '#20a4df';
        document.getElementById('but1').style.backgroundColor = '#20a4df';
        document.getElementById('but2').style.backgroundColor = '#0084bf';
    }
}

function validateForm(){
    var ctype = document.getElementById('ctype').value;
    var ok = 0;
    if (document.getElementById('ctype').value == 0) {
        if (document.getElementById('fname').value.length == 0) {
            ok = 0;
            alert('Please enter a First Name');
        } else if (document.getElementById('lname').value.length == 0) {
            ok = 0;
            alert('Please enter a Last Name');
        } else {
            ok = 1;
        }
    } else if (document.getElementById('ctype').value == 1) {
        if (document.getElementById('oname').value.length == 0) {
            ok = 0;
            alert('Please enter an Organisation Name');
        } else {
            ok = 1;
        }
    } else if (document.getElementById('ctype').value == 2) {
        ok = 1;
    }
    if (ok == 1) {
        return(true);
    } else {
        return false;
    }
}
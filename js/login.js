
    function login()
    {
        var user = document.getElementById('r1').value;
        var pass = document.getElementById('r2').value;
       
        var ab=/^A-Za-z0-9$/;
        var abc=/^A-Za-z0-9+{0-18}$/;
        if(!user.match(ab))
            {
            alert ("enter an valid username");
        }
        else if(!pass.match(abc))
    {
    alert ("Use Strong Password");
    }
    return false;
}

    alert("Login Successful! Redirecting to appointment page...");
    window.location.href = "appointbook.html"; 


function validate(){
    var email = document.getElementById("email").value;
    var password = document.getElementById("password").value;
    if ( email == "admin123" && password == "1234"){
        
        
        window.location ="index.html"
        return false;
    }
    else{
    alert ("Email atau Password tidak benar");
    return false;
    }
    }
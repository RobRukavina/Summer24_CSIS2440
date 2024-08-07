let pass = document.getElementById('password');
if(pass){
    pass.addEventListener('keyup', validate);
}
let passV = document.getElementById('passwordV');
if(passV){ 
    passV.addEventListener('keyup', validate);
}
let user = document.getElementById("userName");
if(user){
    user.addEventListener("keyup", validate);
}
let qty = document.getElementById("qty");
if(qty){
    qty.addEventListener("change", validate);
}
if(qty){
    qty.addEventListener("keyup", validate);
}

let pin = document.getElementById('pin');
let qValid = document.getElementById("qValid");

function validate(event){
    const pasex = /^(?=.*\d).{8,}/;
    const numb = /^(?=.*\d)/;
    const char = /^.{8,}/;
    let elm = event.target.id;
    let p,v,n;
    if(pass){
        p = pasex.test(pass.value);
    }
    if(pass && passV) {
        v = pass.value == passV.value;
    }
    if(user){
        n = document.getElementById('userName') != "" ? true : false;
    }
    let em = "";

    if(elm == "password" || elm == "passwordV" || elm == "userName"){
        if(elm == "password" || elm == "passwordV"){
            if(!pasex.test(pass.value)){
                em = "<li class='invalid list-unstyled'>Your password is not valid.</li>";
            }
            if(!numb.test(pass.value)){
                em = em + "<li class='invalid list-unstyled'>Your password must contain a number.</li>";
            }
            if(!char.test(pass.value)){
                em = em + "<li class='invalid list-unstyled'>Your password must be at least 8 characters.</li>";
            }
            if(!v){            
                em = em + "<li class='invalid list-unstyled'>Your password and password verify do not match</li>";
            }
            pin.innerHTML = em;
        }
        if(p && v && n ){
            document.getElementById("sbt").removeAttribute("disabled");
        } else {
            document.getElementById("sbt").setAttribute("disabled", "");
        }
    }
    
    

    if(elm == "qty"){
        if(qty.value < 1){
            qValid.innerText = "Please select a quantity greater than 0.";
            qValid.className = "invalid";            
            document.getElementById("addToCart").setAttribute("disabled", "");
        } else {
            qValid.innerText = "";
            qValid.className = "";
            document.getElementById("addToCart").removeAttribute("disabled");
        }
    }
}
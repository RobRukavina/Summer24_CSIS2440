let phone = document.getElementById('phone')
phone.addEventListener('keyup', validate);
// more fields obviously

function validate(event){
    let elm = event.target.id;
    const emex = /^(([^<>()\[\]\.,;:\s@\"]+(\.[^<>()\[\]\.,;:\s@\"]+)*)|(\".+\"))@(([^<>()[\]\.,;:\s@\"]+\.)+[^<>()[\]\.,;:\s@\"]{2,})$/i;
    const phex = /^[(]{0,1}[0-9]{3}[)]{0,1}[-\s\.]{0,1}[0-9]{3}[-\s\.]{0,1}[0-9]{4}$/;

    if(elm == "phone"){
        let pin = document.getElementById('pin');
        pin.innerText = "Your phone is " + phex.test(phone.value) ? "valid" : "not valid";
        pin.className = phex.test(phone.value) ? "valid" : "invalid";
    } else if(elm == "email"){
        // do it again for email
    }

    

}
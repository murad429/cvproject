//===== Cookies Plugin=====   //

//===== Cookies Plugin=====   //


let already= document.cookie.split(';');
console.log(already);
already.forEach(function(cooky) {
    console.log(cooky);
    let key_value = cooky.split('=');

    console.log(key_value)
    if (key_value[1].trim() =="true") {
        console.log(key_value[0].trim());
        console.log(key_value[1]);
        document.getElementById(key_value[0].trim()).click();
    }
});


function setCookie(c_name,value,exdays){
    let exdate=new Date();
    exdate.setDate(exdate.getDate() + exdays);
    let c_value=escape(value) + ((exdays==null) ? "" : "; expires="+exdate.toUTCString());
    document.cookie=c_name + "=" + c_value;
}

function set_check(me) {
    setCookie(me.id, me.checked, 60*60*1);
    let alreadySetCookies = document.cookie;
    console.log(alreadySetCookies);
}
function ajaxRequest(){
    var activexmodes=["Msxml2.XMLHTTP", "Microsoft.XMLHTTP"] //activeX versions to check for in IE
    if (window.ActiveXObject){ //Test for support for ActiveXObject in IE first (as XMLHttpRequest in IE7 is broken)
        for (var i=0; i<activexmodes.length; i++){
            try{
                return new ActiveXObject(activexmodes[i]);
            }
            catch(e){
                //suppress error
            }
        }
    }
    else if (window.XMLHttpRequest) // if Mozilla, Safari etc
        return new XMLHttpRequest();
    else
        return false;
}

function ajaxPost(target, parameters, callBackFn){

    var request = new ajaxRequest();
    request.onreadystatechange=function(){
        if (request.readyState==4){
            if (request.status==200 || window.location.href.indexOf("http")==-1){
                callBackFn(request.responseText);
            }
            else{
                alert("An error has occured");
            }
        }
    }

    request.open("POST", target, true);
    request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    request.send(parameters);
}

function ajaxGet(target, parameters, callBackFn){

    var request = new ajaxRequest();
    request.onreadystatechange=function(){
        if (request.readyState==4){
            if (request.status==200 || window.location.href.indexOf("http")==-1){
                callBackFn(request.responseText);
            }
            else{
                alert("An error has occured");
            }
        }
    }

    request.open("GET", target+"?"+parameters, true);
    request.send(null);
}
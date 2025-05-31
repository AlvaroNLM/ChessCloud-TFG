function edit(lapiz){
    var tr = lapiz.parentNode.parentNode;
    var inputs = tr.querySelectorAll("input");
    //id, email, name, pass, rol
    var form = document.getElementById("form");
    var form_inputs = form.querySelectorAll("input");
    for(var i = 0; i < inputs.length; i++){
        form_inputs[i].value = inputs[i].value;
    }
    var select = tr.querySelector("select");
    var rol = document.getElementById("rol");
    rol.value = select.value;
    var type = document.getElementById("type");
    type.value = "edit";
    form.submit();
}


function insert(add){
    var tr = add.parentNode.parentNode;
    var inputs = tr.querySelectorAll("input");
    //email, name, pass
    var form = document.getElementById("form");
    var form_inputs = form.querySelectorAll("input");
    //saltamos el 0 porque no necesitamos el id
    var j = 0;
    for(var i = 0; i < inputs.length; i++){
        if(inputs[i].value==""){
            alert("Faltan campos por rellenar");
            return;
        }
        j = i + 1;
        form_inputs[j].value = inputs[i].value;
    }
    var email = document.getElementById("correo_electronico");
    if(IsMail(email)==false){
        alert("El correo debe seguir el formato xxx@yyy.zzz");
        return;
    }
    var select = tr.querySelector("select");
    var rol = document.getElementById("rol");
    rol.value = select.value;
    var type = document.getElementById("type");
    type.value = "insert";
    form.submit();
}

function borrar(x){
    var tr = x.parentNode.parentNode;
    var inputs = tr.querySelectorAll("input");
    //id, email, name, pass, rol
    var form = document.getElementById("form");
    var form_inputs = form.querySelectorAll("input");
    //no importa nada más a que asigne bien el id, es el atributo que usaremos para borrar
    for(var i = 0; i < inputs.length; i++){
        form_inputs[i].value = inputs[i].value;
    }
    var type = document.getElementById("type");
    type.value = "delete";
    form.submit();
}

//auxiliares
function IsMail(email){
    var correo = email.value;
    var arroba = false, punto = false, dominio = false;
    var pos;
    if(correo[0]!='@'){
        for(var i = 1; i < correo.length; i++){
            if(punto){
                dominio = true;
            }
            if(arroba && correo[i]=='.'){
                punto = true;
                pos = i;
            }
            if(correo[i]=='@'){
                arroba = true;
                pos = i;
            }
        }
    }
    
    return arroba && punto && dominio;
}

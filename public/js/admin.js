function cambiarPagina(elemento){
    var ruta = elemento.getAttribute("ruta");
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function(){
        if(this.readyState == 4 && this.status == 200){
            document.getElementById("pagina").innerHTML = this.responseText;
            var antiguos = document.getElementsByClassName('activo');
            for(var i = 0; i < antiguos.length ;i++){
                antiguos[i].className = "";
            }
            elemento.className = "activo"; 
        }
    }
    xmlhttp.open("GET",ruta,true);
    xmlhttp.send();   
}

function borrar(element){
    var ruta = document.getElementsByClassName("activo")[0].getAttribute("ruta");
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function(){
        if(this.readyState == 4 && this.status == 200){
            document.getElementById("pagina").innerHTML = this.responseText;
        }
    }
    xmlhttp.open("GET",ruta+"/borrar?delete="+element.value,true);
    xmlhttp.send();
}

function add(){
        var ruta = document.getElementsByClassName("activo")[0].getAttribute("ruta");
        var name = document.getElementsByName("nameNew")[0].value;
        var email = document.getElementsByName("emailNew")[0].value;
        var pass = document.getElementsByName("passwordNew")[0].value;
        var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function(){
        if(this.readyState == 4 && this.status == 200){
            document.getElementById("pagina").innerHTML = this.responseText;
        }
    }
    xmlhttp.open("GET",ruta+"/add?name="+name+"&email="+email+"&password="+pass,true);
    xmlhttp.send();
}

function edit(id){
        var ruta = document.getElementsByClassName("activo")[0].getAttribute("ruta");
        var name = document.getElementsByName("name"+id.value)[0].value;
        var email = document.getElementsByName("email"+id.value)[0].value;
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function(){
        if(this.readyState == 4 && this.status == 200){
            document.getElementById("pagina").innerHTML = this.responseText;
        }
    }
    xmlhttp.open("GET",ruta+"/edit?name="+name+"&email="+email+"&id="+id.value,true);
    xmlhttp.send();
}

function editSerie(id){
        var ruta = document.getElementsByClassName("activo")[0].getAttribute("ruta");
        var activo = document.getElementsByClassName("activo")[0].getAttribute("algo");
        var name = document.getElementsByName("name"+id.value)[0].value;
        var descripcion = document.getElementsByName("descripcion"+id.value)[0].value;
        var genero = document.getElementsByName("genero"+id.value)[0].value;   
        var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function(){
        if(this.readyState == 4 && this.status == 200){
            document.getElementById("pagina").innerHTML = this.responseText;
        }
    }
    xmlhttp.open("GET",ruta+"/edit?name="+name+"&descripcion="+descripcion+"&genero="+genero+"&id="+id.value+"&activo="+activo,true);
    xmlhttp.send();
}


function addSerie(){
        var ruta = document.getElementsByClassName("activo")[0].getAttribute("ruta");
        var activo = document.getElementsByClassName("activo")[0].getAttribute("algo");
        var name = document.getElementsByName("name")[0].value;
        var descripcion = document.getElementsByName("descripcion")[0].value;
        var genero = document.getElementsByName("genero")[0].value;   
        var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function(){
        if(this.readyState == 4 && this.status == 200){
            document.getElementById("pagina").innerHTML = this.responseText;
        }
    }
    xmlhttp.open("GET",ruta+"/add?name="+name+"&descripcion="+descripcion+"&genero="+genero+"&activo="+activo,true);
    xmlhttp.send();
}

function editVideo(id){
    
        var ruta = document.getElementsByClassName("activo")[0].getAttribute("ruta");
        var activo = document.getElementsByClassName("activo")[0].getAttribute("algo");
        var url = document.getElementsByName("url"+id.value)[0].value;        
        var name = document.getElementsByName("name"+id.value)[0].value;
        var descripcion = document.getElementsByName("descripcion"+id.value)[0].value;
        var genero = document.getElementsByName("genero"+id.value)[0].value; 
        var serie = document.getElementsByName("serie"+id.value)[0].value; 
        var temporada = document.getElementsByName("temporada"+id.value)[0].value;   
        var capitulo = document.getElementsByName("capitulo"+id.value)[0].value;
        var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function(){
        if(this.readyState == 4 && this.status == 200){
            document.getElementById("pagina").innerHTML = this.responseText;
        }
    }
    xmlhttp.open("GET",ruta+"/edit?url="+url+"&name="+name+"&descripcion="+descripcion+"&genero="+genero+"&serie="+serie+"&temporada="+temporada+"&capitulo="+capitulo+"&id="+id.value+"&activo="+activo,true);
    xmlhttp.send();
}

function addVideo(){
        var ruta = document.getElementsByClassName("activo")[0].getAttribute("ruta");
        var activo = document.getElementsByClassName("activo")[0].getAttribute("algo");
        var url = document.getElementsByName("url")[0].value;        
        var name = document.getElementsByName("name")[0].value;
        var descripcion = document.getElementsByName("descripcion")[0].value;
        var genero = document.getElementsByName("genero")[0].value; 
        var serie = document.getElementsByName("serie")[0].value; 
        var temporada = document.getElementsByName("temporada")[0].value;   
        var capitulo = document.getElementsByName("capitulo")[0].value; 
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function(){
            if(this.readyState == 4 && this.status == 200){
                document.getElementById("pagina").innerHTML = this.responseText;
            }
        }
        xmlhttp.open("GET",ruta+"/add?url="+url+"&name="+name+"&descripcion="+descripcion+"&genero="+genero+"&serie="+serie+"&temporada="+temporada+"&capitulo="+capitulo+"&activo="+activo,true);
        xmlhttp.send();
}
function editar(element){
    var ruta = document.getElementsByClassName("activo")[0].getAttribute("ruta");
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function(){
        if(this.readyState == 4 && this.status == 200){
            document.getElementById("pagina").innerHTML = this.responseText;
        }
    }
    var cadena = "/admin/editar?delete="+element.value+inputs[0].name+"?="+inputs[0].value;
    xmlhttp.open("GET",cadena,true);
    xmlhttp.send();
}

$(document).ready(function() {
    $(document).on('click', '.pagination a', function (e) {
        var ruta = document.getElementsByClassName("activo")[0].getAttribute("ruta");
        paginado($(this).attr('href').split('page=')[1],ruta);
        e.preventDefault();
    });
    cambiarPagina(document.getElementsByClassName("activo")[0]);
});

function paginado(page,ruta){
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function(){
        if(this.readyState == 4 && this.status == 200){
            document.getElementById("pagina").innerHTML = this.responseText;
        }
    }
    xmlhttp.open("GET",ruta+"?page="+page,true);
    xmlhttp.send();
}
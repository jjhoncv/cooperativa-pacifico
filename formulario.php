
<body onload="myFunction()">
    <h3>¿Cuantos puntos Tsuru tienes?</h3>
<hr>
<form name="cuerpo" action="https://cooperativapacifico.online/tsuru.php" method="post"  onkeydown="return event.key != 'Enter';">

<input type="text" name="doi" autocomplete="off" placeholder="Ingrese su documento" size="30" minlength="8" maxlength="8" required pattern="[0-9]+"><br><br>
<input type="submit" value="Enviar" id="mySubmit">
<h1 id="mensaje"></h1>
<h3 id="fecha"></h3>

<h3 id="test"></h3>
</form>

<script>
 $(document).on("keydown", "form", function(event) { 
    return event.key != "Enter";
});
function myFunction() {
var queryString = window.location.search;
urlParams = new URLSearchParams(queryString);
var puntos = urlParams.get('puntos');
var nombres = urlParams.get('nombres');
var fecha = urlParams.get('fecha');

//document.getElementById("test").innerHTML=puntos;
document.getElementById("mensaje").innerHTML="";


if(queryString!="")
{   
    if(puntos!="")
    {
        document.getElementById("mensaje").innerHTML="Hola " + nombres + " cuenta con " + puntos + " Tsurus.";
        document.getElementById("fecha").innerHTML="Actualizado: " + fecha;
    }
    else
    {
        
        document.getElementById("mensaje").innerHTML="No cuenta con puntos Tsurus.";
    }
}

 
    
}

 </script>
    
</body>

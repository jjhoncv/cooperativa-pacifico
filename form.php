<html>
    
<head>
    
</head>
<body>
    

    <h3>Inicia tu solicitud de préstamo aquí</h3>
<hr>
<form name="cuerpo" action="https://cooperativapacifico.online/evalua1.php" method="post" onsubmit="myFunction()" onkeydown="return event.key != 'Enter';">
<input id="utm_source" name="utm_source" type="hidden" value="organico">
<input type="text" name="nombre" autocomplete="off" placeholder="Ingrese su nombre" size="30" minlength="10" required><br><br>
<input type="text" name="dni" autocomplete="off" placeholder="Ingrese su DNI" size="30" minlength="8" maxlength="8" required pattern="[0-9]+"><br><br>
<input type="text" name="celular" autocomplete="off" placeholder="Ingrese su celular" size="30" minlength="9" maxlength="9" required pattern="[0-9]+"><br><br>
<input type="email" name="correo" autocomplete="off" placeholder="Ingrese su correo electrónico" size="30" required pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$"><br><br>
<input type="text" name="sueldo" autocomplete="off" placeholder="Ingrese su sueldo neto" size="30" minlength="4" maxlength="4" required pattern="[0-9]+"><br><br>
<h3>¿Ud. reside actualmente en Lima Metropolitana (incluye Callao)?</h3>
  <input type="radio" id="lima1" name="lima" value="No" required>
  <label for="lima1">No</label><br>
  <input type="radio" id="lima2" name="lima" value="Si">
  <label for="lima2">Si</label><br>
  <h3>¿Es empleado dependiente de 5ta categoría?</h3>
  <input type="radio" id="quintacategoria1" name="quintacategoria" value="No" required>
  <label for="quintacategoria1">No</label><br>
  <input type="radio" id="quintacategoria2" name="quintacategoria" value="Si">
  <label for="quintacategoria2">Si</label><br><br>
<input type="submit" value="Enviar" id="mySubmit">

</form>

<script>
 $(document).on("keydown", "form", function(event) { 
    return event.key != "Enter";
});
function myFunction() {
var queryString = window.location.search;
urlParams = new URLSearchParams(queryString);
source = urlParams.get('utm_source');
document.getElementById("utm_source").value=source;

  document.getElementById("mySubmit").disabled = true;
}

 </script>
 </body>
</html>
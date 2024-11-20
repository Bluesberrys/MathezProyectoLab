<?php
    session_name("sesion_alumno");
    session_start();
    if(isset($_SESSION["alumno"]) and $_SESSION["alumno"]==1)
    {
      include_once "../solicitudes/conexion.php";
      $matricula = mysqli_real_escape_string($conexion, $_SESSION["matricula"]);
      $inscrito = mysqli_query($conexion, "SELECT * FROM inscripciones WHERE numCta = '$matricula'");
      if(mysqli_num_rows($inscrito) > 0)
      {
?>
<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Mathez - Características de la Gráfica</title>
    <link rel="icon" type="image/png" href="..img/M-titanone.png" />
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      rel="stylesheet"
      href="https://fonts.googleapis.com/css2?family=Comfortaa:wght@300..700&family=Titan+One&display=swap" />
    <link rel="stylesheet" href="../css/styles-home.css" />
    <link rel="stylesheet" href="../css/styles-content.css" />
    <link rel="stylesheet" href="../css/styles-dark.css" />
    <link rel="stylesheet" href="../css/fonts.css" />
  </head>

  <body>
    <header>
      <div class="navbar">
        <div class="title" style="margin-top: 15px; margin-bottom: 15px;">
          <a onclick="navigateToHome(); return false;" class="alt-font">Mathez</a>
        </div>
        <div class="navbar-menu">
          <div class="user-dropdown-container">
            <button id="userDropdownToggle" class="user-icon">
              <!-- <img src="./img/test_pfp.png" alt="" /> -->
              <i class="bi bi-person-circle"></i>
            </button>
            <div class="user-dropdown" id="userDropdown">
                <a href="../homepage.php" class="btn alt-font dropdown-item" style="text-decoration: none;">Inicio</a>
                <a href="../public/configPerfil.php" class="btn alt-font dropdown-item">Configuración</a>
                <a href="../solicitudes/cerrar.php" style="text-decoration: none;">
                    <button type="button" class="btn alt-font dropdown-item">Cerrar sesión</button>
                </a>
              <div class="darkmode-container dropdown-item">
                <h4>Modo oscuro</h4>
                <label class="switch">
                  <input type="checkbox" id="darkModeToggle" />
                  <span class="slider"></span>
                </label>
              </div>
            </div>
          </div>
        </div>
      </div>
    </header>

    <main>
      <div class="container">
        <div class="container-title">
          <h1 class="alt-font">
            <!-- Titulo general del tema -->
           Cuestionario
          </h1>
        </div>
        <section class="topic-section">
          <h2 class="topic-subtitle">
            <!-- subtitulo -->
          </h2>
          <!-- contenido -->
           <p>Ahora que ya entendiste y practicaste los temas vistos, es tiempo de realizar un pequeño cuestionario para poder pasar a la siguiente sección del curso.</p>
           <p>Si tienes una calificación superior a 6 podras avanzar al siguiente tema, si sacas una calificación menor a 6 estaras reprobado, pero no te preocupes, podras realizar otra vez el cuestionario. ¡Mucha suerte! ;3.</p>
           <p>Si obtienes una calificación mayor o igual a 6, podrás avanzar al siguiente tema.</p>
           <br>
           <hr>
           <!-- Cuestionario -->
           <!-- Pregunta 1 -->
            <label for="1grafica">1.- ¿Qué representa el eje X en una gráfica?</label>
            <form class="my-form">
            <div>
                <input id="check-1-1" type="checkbox" name="1grafica" value="incorrecto">
                <label for="check-1-1">La variable dependiente</label><br>
            </div>
            <div>
                <input id="check-1-2" type="checkbox" name="1grafica" value="incorrecto">
                <label for="check-1-2">La escala de la gráfica</label><br>
            </div>
            <div>
                <input id="check-1-3" type="checkbox" name="1grafica" value="correcto">
                <label for="check-1-3">La variable independiente</label><br>
            </div>
            <div>
                <input id="check-1-4" type="checkbox" name="1grafica" value="incorrecto">
                <label for="check-1-4">Los datos de la gráfica</label><br>
            </div> <hr>
            </form>

            <!-- Pregunta 2 -->
            <label for="2grafica">2.- ¿Qué es una gráfica creciente?</label>
            <form class="my-form">
            <div>
                <input id="check-2-3" type="checkbox" name="2grafica" value="correcto">
                <label for="check-2-3">Una gráfica donde al aumentar la variable independiente, la dependiente también aumenta</label><br>
            </div>
            <div>
                <input id="check-2-1" type="checkbox" name="2grafica" value="incorrecto">
                <label for="check-2-1">Una gráfica en la que los valores disminuyen de izquierda a derecha</label><br>
            </div>
            <div>
                <input id="check-2-2" type="checkbox" name="2grafica" value="incorrecto">
                <label for="check-2-2">Una gráfica con una línea horizontal</label><br>
            </div>
            <div>
                <input id="check-2-4" type="checkbox" name="2grafica" value="incorrecto">
                <label for="check-2-4">Una gráfica que no tiene variaciones</label><br>
            </div> <hr>
            </form>

            <!-- Pregunta 3 -->
            <label for="3grafica">3.- ¿Cuál de las siguientes características describe una gráfica constante?</label>
            <form class="my-form">
            <div>
                <input id="check-3-1" type="checkbox" name="3grafica" value="incorrecto">
                <label for="check-3-1">Pendiente positiva</label><br>
            </div>
            <div>
                <input id="check-3-2" type="checkbox" name="3grafica" value="incorrecto">
                <label for="check-3-2">Pendiente negativa</label><br>
            </div>
            <div>
                <input id="check-3-3" type="checkbox" name="3grafica" value="correcto">
                <label for="check-3-3">Pendiente nula</label><br>
            </div>
            <div>
                <input id="check-3-4" type="checkbox" name="3grafica" value="incorrecto">
                <label for="check-3-4">Pendiente cambiante</label><br>
            </div> <hr>
            </form>

            <!-- Pregunta 4 -->
            <label for="7grafica">4.- ¿Qué indica un intervalo de decrecimiento en una gráfica?</label>
            <form class="my-form">
            <div>
                <input id="check-4-1" type="checkbox" name="7grafica" value="incorrecto">
                <label for="check-4-1">Un aumento constante en la variable dependiente</label><br>
            </div>
            <div>
                <input id="check-4-2" type="checkbox" name="7grafica" value="correcto">
                <label for="check-4-2">Una disminución de los valores de la función</label><br>
            </div>
            <div>
                <input id="check-4-3" type="checkbox" name="7grafica" value="incorrecto">
                <label for="check-4-3">Que la gráfica es constante</label><br>
            </div>
            <div>
                <input id="check-4-4" type="checkbox" name="7grafica" value="incorrecto">
                <label for="check-4-4">Que no hay un cambio en la variable independiente</label><br>
            </div> <hr>
            </form>

            <!-- Pregunta 5 -->
            <label for="8grafica">5.- ¿Qué tipo de gráfica muestra una línea que desciende de arriba hacia abajo conforme se avanza de izquierda a derecha?</label>
            <form class="my-form">
            <div>
                <input id="check-5-1" type="checkbox" name="8grafica" value="incorrecto">
                <label for="check-5-1">Creciente</label><br>
            </div>
            <div>
                <input id="check-5-2" type="checkbox" name="8grafica" value="correcto">
                <label for="check-5-2">Decreciente</label><br>
            </div>
            <div>
                <input id="check-5-3" type="checkbox" name="8grafica" value="incorrecto">
                <label for="check-5-3">Constante</label><br>
            </div>
            <div>
                <input id="check-5-4" type="checkbox" name="8grafica" value="incorrecto">
                <label for="check-5-4">Exponencial</label><br>
            </div> <hr>
            </form>
            <!-- Pregunta 6 -->
            <label for="6grafica">6.- ¿La siguiente función es creciente, decreciente o constante? f(x) = 4x - 2 </label>
            <form class="my-form">
            <div>
                <input id="check-6-1" type="checkbox" name="6grafica" value="incorrecto">
                <label for="check-6-1">Creciente Exponencial</label><br>
            </div>
            <div>
                <input id="check-6-2" type="checkbox" name="6grafica" value="correcto">
                <label for="check-6-2">Creciente</label><br>
            </div>
            <div>
                <input id="check-6-3" type="checkbox" name="6grafica" value="incorrecto">
                <label for="check-6-3">Decreciente</label><br>
            </div>
            <div>
                <input id="check-6-4" type="checkbox" name="6grafica" value="incorrecto">
                <label for="check-6-4">Constante</label><br>
            </div> <hr>
            </form>

            <!-- Pregunta 7 -->
            <label for="7grafica">7.- ¿La siguiente función es creciente, decreciente o constante? f(x) = -3x + 5</label>
            <form class="my-form">
            <div>
                <input id="check-7-1" type="checkbox" name="7grafica" value="incorrecto">
                <label for="check-7-1">Creciente</label><br>
            </div>
            <div>
                <input id="check-7-2" type="checkbox" name="7grafica" value="correcto">
                <label for="check-7-2">Decreciente</label><br>
            </div>
            <div>
                <input id="check-7-3" type="checkbox" name="7grafica" value="incorrecto">
                <label for="check-7-3">Constante</label><br>
            </div>
            <div>
                <input id="check-7-4" type="checkbox" name="7grafica" value="incorrecto">
                <label for="check-7-4">Creciente Exponencial</label><br>
            </div> <hr>
            </form>

            <!-- Pregunta 8 -->
            <label for="8grafica">8.- ¿La siguiente función es creciente, decreciente o constante? f(x) = 7</label>
            <form class="my-form">
            <div>
                <input id="check-8-1" type="checkbox" name="8grafica" value="incorrecto">
                <label for="check-8-1">Creciente</label><br>
            </div>
            <div>
                <input id="check-8-2" type="checkbox" name="8grafica" value="incorrecto">
                <label for="check-8-2">Decreciente</label><br>
            </div>
            <div>
                <input id="check-8-3" type="checkbox" name="8grafica" value="correcto">
                <label for="check-8-3">Constante</label><br>
            </div>
            <div>
                <input id="check-8-4" type="checkbox" name="8grafica" value="incorrecto">
                <label for="check-8-4">Creciente Exponencial</label><br>
            </div> <hr>
            </form>

            <!-- Pregunta 9 -->
            <label for="9grafica">9.- ¿La siguiente función es creciente, decreciente o constante? f(x) = -x^2 + 6</label>
            <form class="my-form">
            <div>
                <input id="check-9-1" type="checkbox" name="9grafica" value="incorrecto">
                <label for="check-9-1">Creciente</label><br>
            </div>
            <div>
                <input id="check-9-2" type="checkbox" name="9grafica" value="correcto">
                <label for="check-9-2">Decreciente</label><br>
            </div>
            <div>
                <input id="check-9-3" type="checkbox" name="9grafica" value="incorrecto">
                <label for="check-9-3">Constante</label><br>
            </div>
            <div>
                <input id="check-9-4" type="checkbox" name="9grafica" value="incorrecto">
                <label for="check-9-4">Creciente Exponencial</label><br>
            </div> <hr>
            </form>

            <!-- Pregunta 10 -->
            <label for="10grafica">10.- ¿La siguiente función es creciente, decreciente o constante? f(x) = x </label>
            <form class="my-form">
            <div>
                <input id="check-10-1" type="checkbox" name="10grafica" value="correcto">
                <label for="check-10-1">Creciente</label><br>
            </div>
            <div>
                <input id="check-10-2" type="checkbox" name="10grafica" value="incorrecto">
                <label for="check-10-2">Decreciente</label><br>
            </div>
            <div>
                <input id="check-10-3" type="checkbox" name="10grafica" value="incorrecto">
                <label for="check-10-3">Constante</label><br>
            </div>
            <div>
                <input id="check-10-4" type="checkbox" name="10grafica" value="incorrecto">
                <label for="check-10-4">Decreciente Exponencial</label><br>
            </div> <hr>
            </form>
        </section>

        <button type="button" onclick="verificarResultados(); " class="cssbuttons-io-button">
          Finalizar Cuestionario
          <div class="icon">
            <svg height="24" width="24" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
              <path d="M0 0h24v24H0z" fill="none"></path>
              <path
                d="M16.172 11l-5.364-5.364 1.414-1.414L20 12l-7.778 7.778-1.414-1.414L16.172 13H4v-2z"
                fill="currentColor"></path>
            </svg>
          </div>
        </button>

      </div>
    </main>

    <footer>
      <div class="footer">
        <div class="">
          <p>©</p>
        </div>
        <a href="../sobreNos.html" class="btn">Sobre nosotros</a>
      </div>
    </footer>

    <script src="../js/app.js"></script>

    <script>
        // Función para hacer que solo se pueda seleccionar un checkbox por pregunta
        document.querySelectorAll('input[type="checkbox"]').forEach(checkbox => {
            checkbox.addEventListener('change', function() {
                const name = this.name;
                document.querySelectorAll(`input[name="${name}"]`).forEach(other => {
                    if (other !== this) other.checked = false;
                });
            });
        });

        // Función para verificar los resultados y hacer el conteo
        function verificarResultados() {
          const totalPreguntas = 10;
          const respuestas = document.querySelectorAll('input[type="checkbox"]:checked');
          let aciertos = 0;

          respuestas.forEach(respuesta => {
              if (respuesta.value === 'correcto') {
                  aciertos++;
              }
          });

          const promedio = (aciertos / totalPreguntas) * 10;

          if (promedio >= 6) {
              swal({
                  title: 'Tu promedio fue de:',
                  text: `${promedio.toFixed(1)} (equivalente a ${aciertos} aciertos)`,
                  icon: 'success',
                  buttons: true,
              }).then((willRedirect) => {
                  if (willRedirect) {
                      actTemaTerminado('grafica');
                  }
              });
          } else {
              swal({
                  title: 'Tu promedio fue de:',
                  text: `${promedio.toFixed(1)} (equivalente a ${aciertos} aciertos)`,
                  icon: 'error'
              });
          }
        }
    </script>

  </body>
</html>
<?php
      }
      else
      {
        header("Location: ../homepage.php"); 
      }
      mysqli_close($conexion);
    }
    else
    {
        header("Location: ../index.php"); 
    }
?>
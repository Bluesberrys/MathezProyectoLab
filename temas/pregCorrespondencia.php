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
    <title>Mathez - Regla de Correspondencia</title>
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
          <a href="#" onclick="navigateToHome(); return false;" class="alt-font">Mathez</a>
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
            <label for="1corresp">1.- ¿Qué es una regla de correspondencia?</label>
            <form class="my-form">
                <div>
                    <input id="check-1-2" type="checkbox" name="1corresp" value="correcto">
                    <label for="check-1-2">Una relación que asigna a cada elemento de un conjunto (dominio) exactamente un elemento de otro conjunto (codominio)</label><br>
                </div>
                <div>
                    <input id="check-1-1" type="checkbox" name="1corresp" value="incorrecto">
                    <label for="check-1-1">Una función que no tiene dominio ni rango</label><br>
                </div>
                <div>
                    <input id="check-1-3" type="checkbox" name="1corresp" value="incorrecto">
                    <label for="check-1-3">Una operación matemática sin un significado específico</label><br>
                </div>
                <div>
                    <input id="check-1-4" type="checkbox" name="1corresp" value="incorrecto">
                    <label for="check-1-4">Un método de sumar y restar números</label><br>
                </div>
                <hr>
            </form>
            <!-- Pregunta 2 -->
            <label for="2corresp">2.- En una correspondencia unívoca, ¿qué propiedad se cumple?</label>
            <form class="my-form">
                <div>
                    <input id="check-2-1" type="checkbox" name="2corresp" value="incorrecto">
                    <label for="check-2-1">Cada elemento del dominio se relaciona con más de un elemento del codominio</label><br>
                </div>
                <div>
                    <input id="check-2-2" type="checkbox" name="2corresp" value="incorrecto">
                    <label for="check-2-2">Un elemento del codominio se relaciona con más de un elemento del dominio</label><br>
                </div>
                <div>
                    <input id="check-2-3" type="checkbox" name="2corresp" value="correcto">
                    <label for="check-2-3">Cada elemento del dominio se relaciona con un único elemento del codominio</label><br>
                </div>
                <div>
                    <input id="check-2-4" type="checkbox" name="2corresp" value="incorrecto">
                    <label for="check-2-4">Todos los elementos del dominio tienen una imagen en el codominio y viceversa</label><br>
                </div>
                <hr>
            </form>
            <!-- Pregunta 3 -->
            <label for="3corresp">3.- ¿Cuál de las siguientes opciones describe una correspondencia biunívoca?</label>
            <form class="my-form">
                <div>
                    <input id="check-3-1" type="checkbox" name="3corresp" value="incorrecto">
                    <label for="check-3-1">Cada elemento del dominio tiene múltiples imágenes en el codominio</label><br>
                </div>
                <div>
                    <input id="check-3-2" type="checkbox" name="3corresp" value="correcto">
                    <label for="check-3-2">Cada elemento del dominio se relaciona con un único elemento del codominio y viceversa</label><br>
                </div>
                <div>
                    <input id="check-3-3" type="checkbox" name="3corresp" value="incorrecto">
                    <label for="check-3-3">No todos los elementos del codominio tienen una preimagen</label><br>
                </div>
                <div>
                    <input id="check-3-4" type="checkbox" name="3corresp" value="incorrecto">
                    <label for="check-3-4">Es una función que no puede invertirse</label><br>
                </div>
                <hr>
            </form>
            <!-- Pregunta 4 -->
            <label for="4corresp">4.- ¿Cuál es un ejemplo de una correspondencia no unívoca?</label>
            <form class="my-form">
                <div>
                    <input id="check-4-1" type="checkbox" name="4corresp" value="incorrecto">
                    <label for="check-4-1">La función lineal <code>f(x) = 3x + 2</code></label><br>
                </div>
                <div>
                    <input id="check-4-2" type="checkbox" name="4corresp" value="incorrecto">
                    <label for="check-4-2">La función cuadrática <code>f(x) = x^2</code></label><br>
                </div>
                <div>
                    <input id="check-4-3" type="checkbox" name="4corresp" value="correcto">
                    <label for="check-4-3">La función seno <code>f(x) = sin(x)</code></label><br>
                </div>
                <div>
                    <input id="check-4-4" type="checkbox" name="4corresp" value="incorrecto">
                    <label for="check-4-4">La función identidad <code>f(x) = x</code></label><br>
                </div>
                <hr>
            </form>
            <!-- Pregunta 5 -->
            <label for="5corresp">5.- ¿Qué conjunto se define como el dominio de una función?</label>
            <form class="my-form">
                <div>
                    <input id="check-5-1" type="checkbox" name="5corresp" value="incorrecto">
                    <label for="check-5-1">El conjunto de todos los posibles valores que puede tomar la variable dependiente (<code>y</code>)</label><br>
                </div>
                <div>
                    <input id="check-5-2" type="checkbox" name="5corresp" value="incorrecto">
                    <label for="check-5-2">El conjunto de todos los números negativos</label><br>
                </div>
                <div>
                    <input id="check-5-3" type="checkbox" name="5corresp" value="correcto">
                    <label for="check-5-3">El conjunto de todos los posibles valores que puede tomar la variable independiente (<code>x</code>)</label><br>
                </div>
                <div>
                    <input id="check-5-4" type="checkbox" name="5corresp" value="incorrecto">
                    <label for="check-5-4">El conjunto de imágenes posibles después de aplicar la función</label><br>
                </div>
                <hr>
            </form>
            <!-- Pregunta 6 -->
            <label for="6corresp">6.- ¿Qué es necesario para que una función sea invertible?</label>
            <form class="my-form">
                <div>
                    <input id="check-6-1" type="checkbox" name="6corresp" value="incorrecto">
                    <label for="check-6-1">Que la función sea constante</label><br>
                </div>
                <div>
                    <input id="check-6-2" type="checkbox" name="6corresp" value="incorrecto">
                    <label for="check-6-2">Que para cada elemento del codominio exista más de un valor en el dominio</label><br>
                </div>
                <div>
                    <input id="check-6-3" type="checkbox" name="6corresp" value="correcto">
                    <label for="check-6-3">Que exista otra función que deshaga la acción original</label><br>
                </div>
                <div>
                    <input id="check-6-4" type="checkbox" name="6corresp" value="incorrecto">
                    <label for="check-6-4">Que la función sea no unívoca</label><br>
                </div>
                <hr>
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
          const totalPreguntas = 6;
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
                      actTemaTerminado('regla-correspondencia');
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
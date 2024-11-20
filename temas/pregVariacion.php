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
    <title>Mathez - Variación</title>
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
            <label for="1variacion">1.- ¿Qué es la variación en matemáticas y ciencias?</label>
            <form class="my-form">
            <div>
                <input id="check-1-1" type="checkbox" name="1variacion" value="incorrecto">
                <label for="check-1-1">Un concepto que describe cantidades estáticas sin cambios</label><br>
            </div>
            <div>
                <input id="check-1-2" type="checkbox" name="1variacion" value="correcto">
                <label for="check-1-2">Un concepto que describe cómo cambian las cantidades en relación con otras</label><br>
            </div>
            <div>
                <input id="check-1-3" type="checkbox" name="1variacion" value="incorrecto">
                <label for="check-1-3">Una fórmula para calcular la media aritmética</label><br>
            </div>
            <div>
                <input id="check-1-4" type="checkbox" name="1variacion" value="incorrecto">
                <label for="check-1-4">Un método para hacer estimaciones precisas</label><br>
            </div>
            <hr>
            </form>
            <!-- Pregunta 2 -->
            <label for="2variacion">2.- ¿Cómo se expresa matemáticamente la variación directa?</label>
            <form class="my-form">
                <div>
                    <input id="check-2-1" type="checkbox" name="2variacion" value="incorrecto">
                    <label for="check-2-1"><code>y = k/x</code></label><br>
                </div>
                <div>
                    <input id="check-2-2" type="checkbox" name="2variacion" value="correcto">
                    <label for="check-2-2"><code>y = kx</code></label><br>
                </div>
                <div>
                    <input id="check-2-3" type="checkbox" name="2variacion" value="incorrecto">
                    <label for="check-2-3"><code>y = x^2 + k</code></label><br>
                </div>
                <div>
                    <input id="check-2-4" type="checkbox" name="2variacion" value="incorrecto">
                    <label for="check-2-4"><code>y = k - x</code></label><br>
                </div>
                <hr>
            </form>
            <!-- Pregunta 3 -->
            <label for="3variacion">3.- ¿Qué ocurre con las variables en una variación inversa?</label>
            <form class="my-form">
                <div>
                    <input id="check-3-1" type="checkbox" name="3variacion" value="incorrecto">
                    <label for="check-3-1">Ambas variables aumentan o disminuyen al mismo tiempo</label><br>
                </div>
                <div>
                    <input id="check-3-3" type="checkbox" name="3variacion" value="incorrecto">
                    <label for="check-3-3">Ambas variables permanecen constantes</label><br>
                </div>
                <div>
                    <input id="check-3-4" type="checkbox" name="3variacion" value="incorrecto">
                    <label for="check-3-4">Las variables no están relacionadas</label><br>
                </div>
                <div>
                    <input id="check-3-2" type="checkbox" name="3variacion" value="correcto">
                    <label for="check-3-2">Cuando una variable aumenta, la otra disminuye</label><br>
                </div>
                <hr>
            </form>
            <!-- Pregunta 4 -->
            <label for="4variacion">4.- ¿Cuál es un ejemplo de variación inversa?</label>
            <form class="my-form">
                <div>
                    <input id="check-4-1" type="checkbox" name="4variacion" value="incorrecto">
                    <label for="check-4-1">El aumento de la población y el crecimiento económico</label><br>
                </div>
                <div>
                    <input id="check-4-2" type="checkbox" name="4variacion" value="correcto">
                    <label for="check-4-2">A medida que la velocidad de un vehículo aumenta, el tiempo para llegar al destino disminuye</label><br>
                </div>
                <div>
                    <input id="check-4-3" type="checkbox" name="4variacion" value="incorrecto">
                    <label for="check-4-3">El precio de un producto y la cantidad demandada aumentan juntos</label><br>
                </div>
                <div>
                    <input id="check-4-4" type="checkbox" name="4variacion" value="incorrecto">
                    <label for="check-4-4">El aumento de la temperatura y el uso de ropa más ligera</label><br>
                </div>
                <hr>
            </form>
            <!-- Pregunta 5 -->
            <label for="5variacion">5.- ¿Qué se estudia en el análisis de casos para la variación?</label>
            <form class="my-form">
                <div>
                    <input id="check-5-1" type="checkbox" name="5variacion" value="incorrecto">
                    <label for="check-5-1">Solo datos sin patrones específicos</label><br>
                </div>
                <div>
                    <input id="check-5-2" type="checkbox" name="5variacion" value="correcto">
                    <label for="check-5-2">Cómo varían las cantidades bajo diferentes condiciones</label><br>
                </div>
                <div>
                    <input id="check-5-3" type="checkbox" name="5variacion" value="incorrecto">
                    <label for="check-5-3">La estructura de un polígono regular</label><br>
                </div>
                <div>
                    <input id="check-5-4" type="checkbox" name="5variacion" value="incorrecto">
                    <label for="check-5-4">El comportamiento estático de las variables</label><br>
                </div>
                <hr>
            </form>
            <!-- Pregunta 6 -->
            <label for="6variacion">6.- ¿Cómo se aplica la variación en la ingeniería?</label>
            <form class="my-form">
                <div>
                    <input id="check-6-2" type="checkbox" name="6variacion" value="correcto">
                    <label for="check-6-2">Para comprender cómo varían las fuerzas y tensiones en estructuras y prevenir fallas</label><br>
                </div>
                <div>
                    <input id="check-6-1" type="checkbox" name="6variacion" value="incorrecto">
                    <label for="check-6-1">Para diseñar obras de arte sin ninguna relación matemática</label><br>
                </div>
                <div>
                    <input id="check-6-3" type="checkbox" name="6variacion" value="incorrecto">
                    <label for="check-6-3">Para diseñar aplicaciones móviles sin considerar el hardware</label><br>
                </div>
                <div>
                    <input id="check-6-4" type="checkbox" name="6variacion" value="incorrecto">
                    <label for="check-6-4">Para elegir el color de los edificios</label><br>
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
                      actTemaTerminado('variacion');
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
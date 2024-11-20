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
    <title>Mathez - Polinomios</title>
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
            <label for="1poli">1.- ¿Cual es el grado de este polinomio: 4𝑥^3 + 6𝑥^3 - 𝑥 + 7?          
            </label> 
              <form class="my-form">
                <div>
                  <input id="check-1" type="checkbox" name="1poli" value="incorrecto">
                  <label for="check-1"> Grado 1 </label><br>
                </div>
                <div>
                  <input id="check-2" type="checkbox" name="1poli" value="incorrecto">
                  <label for="check-2">Grado 2</label><br>
                </div>
                <div>
                  <input id="check-3" type="checkbox" name="1poli" value="correcto">
                  <label for="check-3">Grado 3</label><br>
                </div>
                <div>
                  <input id="check-4" type="checkbox" name="1poli" value="incorrecto">
                  <label for="check-4">Grado 4</label><br>
                </div> <hr>
              </form>
            <!-- Pregunta 2 -->
            <label for="2poli">2.- ¿Una raíz de un polinomio es un valor de 𝑥 que hace que el poliniomio sea igual a?           
            </label> 
              <form class="my-form">
                <div>
                  <input id="check-1-2" type="checkbox" name="2poli" value="incorrecto">
                  <label for="check-1-2"> 1 </label><br>
                </div>
                <div>
                  <input id="check-2-2" type="checkbox" name="2poli" value="incorrecto">
                  <label for="check-2-2">2</label><br>
                </div>
                <div>
                  <input id="check-3-2" type="checkbox" name="2poli" value="incorrecto">
                  <label for="check-3-2">3</label><br>
                </div>
                <div>
                  <input id="check-4-2" type="checkbox" name="2poli" value="correcto">
                  <label for="check-4-2">0</label><br>
                </div> <hr>
              </form>
            <!-- Pregunta 3 -->
            <label for="3poli">3.- ¿Que es un polinomio?            
            </label> 
            <form class="my-form">
              <div>
                <input id="check-1-3" type="checkbox" name="3poli" value="incorrecto">
                <label for="check-1-3"> Una Ecuación algebraica sin variables </label><br>
              </div>
              <div>
                <input id="check-2-3" type="checkbox" name="3poli" value="correcto">
                <label for="check-2-3"> Una Expresión algebraica que contiene términos llamados monomios</label><br>
              </div>
              <div>
                <input id="check-3-3" type="checkbox" name="3poli" value="incorrecto">
                <label for="check-3-3"> Un número enero positivo</label><br>
              </div>
              <div>
                <input id="check-4-3" type="checkbox" name="3poli" value="incorrecto">
                <label for="check-4-3"> Un termino con solo variables</label><br>
              </div><hr>
            </form>
              <!-- Pregunta 4 -->
              <label for="4poli">4.- ¿Cómo se llama el coeficiente del término de mayor grado en un polinomio?            
              </label> 
              <form class="my-form">
                <div>
                  <input id="check-1-4" type="checkbox" name="4poli" value="incorrecto">
                  <label for="check-1-4"> Coeficiente primario </label><br>
                </div>
                <div>
                  <input id="check-2-4" type="checkbox" name="4poli" value="incorrecto">
                  <label for="check-2-4"> Coeficiente simple</label><br>
              </div>
              <div>
                <input id="check-3-4" type="checkbox" name="4poli" value="correcto">
                <label for="check-3-4"> Coeficiente principal</label><br>
              </div>
              <div>
                <input id="check-4-4" type="checkbox" name="4poli" value="incorrecto">
                <label for="check-4-4"> Coeficiente secundario</label><br>
              </div><hr>
            </form>
            <!-- Pregunta 5 -->
            <label for="5poli">5.- ¿Qué nombre recibe un polinomio con un solo término?
            </label>
            <form class="my-form">
              <div>
                <input id="check-1-5" type="checkbox" name="5poli" value="incorrecto">
                <label for="check-1-5"> binomio </label><br>
              </div>
              <div>
                <input id="check-2-5" type="checkbox" name="5poli" value="incorrecto">
                <label for="check-2-5"> trinomio </label><br>
              </div>
              <div>
                <input id="check-3-5" type="checkbox" name="5poli" value="correcto">
                <label for="check-3-5"> monomio </label><br>
              </div>
              <div>
                <input id="check-4-5" type="checkbox" name="5poli" value="incorrecto">
                <label for="check-4-5"> polinomio cuadrado </label><br>
              </div><hr>
            </form>
            <!-- Pregunta 6 -->
            <label for="6poli">6.- ¿Cómo se ordenan los términos en un polinomio en una variable por lo general?         
            </label> 
            <form class="my-form">
              <div>
                <input id="check-1-6" type="checkbox" name="6poli" value="incorrecto">
                <label for="check-1-6"> En orden ascendente según los exponentes </label><br>
              </div>
              <div>
                <input id="check-2-6" type="checkbox" name="6poli" value="correcto">
                <label for="check-2-6"> En orden descendente según los exponentes </label><br>
              </div>
              <div>
                <input id="check-3-6" type="checkbox" name="6poli" value="incorrecto">
                <label for="check-3-6"> En orden alfabético </label><br>            
              </div>
              <div>
                <input id="check-4-6" type="checkbox" name="6poli" value="incorrecto">
                <label for="check-4-6"> En orden aleatorio </label><br>
              </div><hr>
            </form>
            <!-- Pregunta 7 -->
            <label for="7poli">7.- ¿Cuál de las siguientes es una factorización de un trinomio cuadrado perfecto?         
            </label>
            <form class="my-form"> 
              <div>
                <input type="checkbox" id="check-1-7" name="7poli" value="correcto">
                <label for="check-1-7"> (𝑎−b)² </label><br>
              </div>
              <div>
                <input type="checkbox" id="check-2-7" name="7poli" value="incorrecto">
                <label for="check-2-7"> (𝑎²-b²)</label><br>
              </div>
              <div>
                <input type="checkbox" id="check-3-7" name="7poli" value="incorrecto">
                <label for="check-3-7"> (𝑎+b)(𝑎-b) </label><br>
              </div>
              <div>
                <input type="checkbox" id="check-4-7" name="7poli" value="incorrecto">
                <label for="check-4-7"> (a+b)³ </label><br>
              </div><hr>
            </form>     
            <!-- Pregunta 8 -->
            <label for="8poli">8.- ¿Cuál es el MCD (Máximo Común Divisor) de los términos 10𝑥² y 15𝑥³?
            </label>  
            <form class="my-form">
              <div>
                <input type="checkbox" id="check-1-8" name="8poli" value="correcto">
                <label for="check-1-8">  5𝑥</label><br>
              </div>
              <div>
                <input type="checkbox" id="check-2-8" name="8poli" value="incorrecto">
                <label for="check-2-8"> 10𝑥² </label><br>
              </div>
              <div>
                <input type="checkbox" id="check-3-8" name="8poli" value="incorrecto">
                <label for="check-3-8"> 15𝑥³ </label><br>
              </div>
              <div>
                <input type="checkbox" id="check-4-8" name="8poli" value="incorrecto">
                <label for="check-4-8">  5𝑥² </label><br>
              </div><hr>
            </form>     
            <!-- Pregunta 9 -->
            <label for="9poli">9.- ¿Cuál es el resultado de dividir un polinomio 𝑃(𝑥) entre 𝑥−𝑎 según el Teorema del Resto?         
            </label> 
            <form class="my-form">
              <div>
                <input id="check-1-9" type="checkbox" name="9poli" value="correcto">
                <label for="check-1-9"> 𝑃(𝑎) </label><br>
              </div>
              <div>
                <input id="check-2-9" type="checkbox" name="9poli" value="incorrecto">
                <label for="check-2-9">𝑎</label><br>
              </div>
              <div>
                <input id="check-3-9" type="checkbox" name="9poli" value="incorrecto">
                <label for="check-3-9">𝑥</label><br>
              </div>
              <div>
                <input id="check-4-9" type="checkbox" name="9poli" value="incorrecto">
                <label for="check-4-9"> 𝑃(𝑥) - 𝑎</label><br>
              </div><hr>
            </form>
            <!-- Pregunta 10 -->
            <label for="10poli">10.- ¿Qué se necesita para sumar o restar dos polinomios?         
            </label> 
            <form class="my-form">
              <div>
                <input id="check-1-10" type="checkbox" name="10poli" value="incorrecto">
                <label for="check-1-10"> Que tengan el mismo grado </label><br>
              </div>
              <div>
                <input id="check-2-10" type="checkbox" name="10poli" value="incorrecto">
                <label for="check-2-10"> Que tengan el mismo coeficiente principal </label><br>
              </div>
              <div>
                <input id="check-3-10" type="checkbox" name="10poli" value="correcto">
                <label for="check-3-10"> Que tengan términos con el mismo grado </label><br>
              </div>
              <div>
                <input id="check-4-10" type="checkbox" name="10poli" value="incorrecto">
                <label for="check-4-10"> Que tengan la misma cantidad de términos </label><br>
              </div><hr>
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
                      actTemaTerminado('polinomios');
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
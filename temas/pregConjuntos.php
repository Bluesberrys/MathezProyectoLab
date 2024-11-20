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
    <title>Mathez - Conjuntos</title>
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
            </h2>
            <p>Responde las siguientes preguntas. Si obtienes 6 o más aciertos, podrás avanzar al siguiente tema.</p>
            <br>
            <hr>
            <!-- Pregunta 1 -->
            <label for="1conjunto">1.- ¿Qué es un conjunto?</label>
            <form class="my-form">
                <div>
                    <input id="check-1" type="checkbox" name="1conjunto" value="correcto">
                    <label for="check-1">Una colección de objetos o elementos bien definidos.</label><br>
                </div>
                <div>
                    <input id="check-2" type="checkbox" name="1conjunto" value="incorrecto">
                    <label for="check-2">Un número entero.</label><br>
                </div>
                <div>
                    <input id="check-3" type="checkbox" name="1conjunto" value="incorrecto">
                    <label for="check-3">Un tipo de ecuación.</label><br>
                </div>
                <div>
                    <input id="check-4" type="checkbox" name="1conjunto" value="incorrecto">
                    <label for="check-4">Una figura geométrica.</label><br>
                </div><hr>
            </form>

            <!-- Pregunta 2 -->
            <label for="2conjunto">2.- ¿Cómo se representa un conjunto vacío?</label>
            <form class="my-form">
                <div>
                    <input id="check-5" type="checkbox" name="2conjunto" value="correcto">
                    <label for="check-5">∅ o { }</label><br>
                </div>
                <div>
                    <input id="check-6" type="checkbox" name="2conjunto" value="incorrecto">
                    <label for="check-6">{0}</label><br>
                </div>
                <div>
                    <input id="check-7" type="checkbox" name="2conjunto" value="incorrecto">
                    <label for="check-7">{a}</label><br>
                </div>
                <div>
                    <input id="check-8" type="checkbox" name="2conjunto" value="incorrecto">
                    <label for="check-8">{1, 2}</label><br>
                </div>
                <hr>
            </form>

            <!-- Pregunta 3 -->
            <label for="3conjunto">3.- ¿Qué es un subconjunto?</label>
            <form class="my-form">
                <div>
                    <input id="check-9" type="checkbox" name="3conjunto" value="correcto">
                    <label for="check-9">Un conjunto cuyos elementos están todos en otro conjunto.</label><br>
                </div>
                <div>
                    <input id="check-10" type="checkbox" name="3conjunto" value="incorrecto">
                    <label for="check-10">Un conjunto que no tiene elementos.</label><br>
                </div>
                <div>
                    <input id="check-11" type="checkbox" name="3conjunto" value="incorrecto">
                    <label for="check-11">Un conjunto con más elementos que otro.</label><br>
                </div>
                <div>
                    <input id="check-12" type="checkbox" name="3conjunto" value="incorrecto">
                    <label for="check-12">Un conjunto que es igual a otro.</label><br>
                </div>
                <hr>
            </form>

            <!-- Pregunta 4 -->
            <label for = "4conjunto">4.- ¿Cuál es la operación que representa la unión de dos conjuntos?</label> 
            <form class = "my-form"> 
                <div> 
                    <input id = "check-13" type= "checkbox" name= "4conjunto" value="incorrecto"> 
                    <label for = "check-13">(A ∩ B)</label><br> 
                </div> 
                <div> 
                    <input id = "check-14" type= "checkbox" name= "4conjunto" value="correcto"> 
                    <label for = "check-14">(A ∪ B)</label><br> 
                </div> 
                <div> 
                    <input id = "check-15" type= "checkbox" name= "4conjunto" value="incorrecto"> 
                    <label for = "check-15">(A − B)</label><br> 
                </div> 
                <div> 
                    <input id = "check-16" type= "checkbox" name= "4conjunto" value="incorrecto"> 
                    <label for = "check-16">(A') </label><br> 
                </div > 
                <hr> 
            </form>

            <!-- Pregunta 5 -->
            <label for="5conjunto">5.- ¿Qué significa A ⊆ B?</label>
            <form class="my-form"> 
                <div> 
                    <input id= "check-17" type="checkbox" name="5conjunto" value="correcto"> 
                    <label for= "check-17">A es un subconjunto de B.</label><br> 
                </div> 
                <div> 
                    <input id= "check-18" type="checkbox" name="5conjunto" value="incorrecto"> 
                    <label for= "check-18">A y B son iguales.</label><br> 
                </div> 
                <div> 
                    <input id= "check-19" type="checkbox" name="5conjunto" value="incorrecto"> 
                    <label for= "check-19">A tiene más elementos que B.</label><br> 
                </div> 
                <div> 
                    <input id= "check-20" type= "checkbox" name= "5conjunto" value= "incorrecto"> 
                    <label for= "check-20">B es un subconjunto de A.</label><br> 
                </div> 
                <hr> 
            </form>
            <!-- Pregunta 6 -->
            <label for= "6conjunto">6.- ¿Cuál es el resultado de A ∩ B si A = {1, 2, 3} y B = {2, 3, 4}?</ label >
            <form class= "my-form"> 
                <div> 
                    <input id= "check-21" type = "checkbox" name = "6conjunto" value = "correcto">
                    <label for = check-21>{2, 3}</label><br> 
                </div>
                <div >
                    <input id = "check-22" type = "checkbox" name = "6conjunto" value = "incorrecto">
                    <label for = "check-22">{1, 4}</label><br>
                </div>
                <div>
                    <input id = "check-23" type = "checkbox" name = "6conjunto" value = "incorrecto" >
                    <label for = "check-23">{1, 2, 3}</label><br>
                </div>
                    <div >
                    <input id = "check-24" type = "checkbox" name = "6conjunto" value = "incorrecto">
                    <label for = "check-24">{1, 2, 3, 4} </label><br>
                </div>
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
                        actTemaTerminado('conjuntos');
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
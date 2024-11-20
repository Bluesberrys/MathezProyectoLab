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
    <link rel="icon" type="image/png" href="../img/M-titanone.png" />
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

    <?php
        
      $matricula = mysqli_real_escape_string($conexion, $_SESSION["matricula"]);

      $Id_inscrip = mysqli_query($conexion, "SELECT id_inscrip FROM inscripciones WHERE numCta = '$matricula' AND id_curso = '1'");

      $contarID = mysqli_num_rows($Id_inscrip);

      if($contarID == 1)
      {
          $row = mysqli_fetch_array($Id_inscrip, MYSQLI_ASSOC);
          $idInscrip = $row['id_inscrip'];
      }

      $consultaEstatus = mysqli_query($conexion, "SELECT estatus FROM avances WHERE id_inscrip = '$idInscrip' AND id_tema = 3");

      $contarEstatus = mysqli_num_rows($consultaEstatus);

      if($contarEstatus == 1)
      {
        $row = mysqli_fetch_array($consultaEstatus, MYSQLI_ASSOC);
        $estatus = $row['estatus'];
      }

    ?>

    <main> 
        <br> 
        <?php 
        /*if($estatus == "En progreso") 
        { 
        ?> 
            <button class="btn-tema" type="submit" onclick="actTemaTerminado('regla-correspondencia')"> Marcar como visto </button> 
        <?php 
        }*/ 
        if($estatus == "Terminado") 
        { 
        ?> 
            <button class="btn-tema" type="submit" onclick="actTemaProgreso('regla-correspondencia')"> Tema visto </button> 
        <?php 
        } 
        ?> 

        <div class="container"> 
            <div class="container-title"> 
                <h1 class="alt-font"> Regla de Correspondencia </h1> 
            </div> 

            <section class="topic-section"> 
                <h2 class="topic-subtitle"> Definición Formal </h2> 
                <p>Una regla de correspondencia es una relación que asigna a cada elemento de un conjunto (denominado <strong>dominio</strong>) exactamente un elemento de otro conjunto (denominado <strong>codominio</strong>). Matemáticamente, se puede expresar como:</p>
                <p><code>y = f(x)</code></p>
                <ul>
                    <li><code>x</code> es un elemento del dominio.</li>
                    <li><code>y</code> es el resultado o imagen en el codominio.</li>
                    <li><code>f</code> es la función que define la regla de correspondencia.</li>
                </ul>
            </section>

            <section class="topic-section"> 
                <h2 class="topic-subtitle"> Tipos de Regla de Correspondencia </h2>

                <h3>Correspondencia Unívoca</h3>
                <p>En una correspondencia unívoca, cada elemento del dominio se relaciona con un único elemento del codominio. Por ejemplo, en una función lineal como:</p>
                <p><code>f(x) = mx + b</code></p>

                <h3>Correspondencia Biunívoca</h3>
                <p>Aquí, cada elemento del dominio se relaciona con un único elemento del codominio y viceversa. Por ejemplo, la función cuadrática restringida:</p>
                <p><code>f(x) = x^2</code>, donde se puede invertir para obtener:</p>
                <p><code>f^{-1}(y) = √y</code>.</p>

                <h3>Correspondencia No Unívoca</h3>
                <p>Aquí, al menos un elemento del dominio está relacionado con más de un elemento del codominio. Por ejemplo, la función seno:</p>
                <p><code>f(x) = sin(x)</code>.</p>

                <h3>Correspondencia No Biunívoca</h3>
                <p>Aquí, cada elemento del dominio tiene una sola imagen en el codominio, pero no todos los elementos del codominio tienen una preimagen en el dominio. Por ejemplo:</p>
                <p><code>f(x) = √x</code>, donde solo tiene imágenes para números no negativos.</p>
            </section>

            <section class="topic-section"> 
                <h2 class="topic-subtitle"> Propiedades de las Reglas de Correspondencia </h2>

                <h3>Dominio y Rango</h3>
                <ul>
                    <li><strong>Dominio:</strong> El conjunto de todos los valores posibles que puede tomar la variable independiente (<code>x</code>). Es crucial identificar el dominio para evitar errores al evaluar funciones.</li>
                    <li><strong>Rango:</strong> El conjunto de todos los valores posibles que puede tomar la variable dependiente (<code>y</code>) después de aplicar la función.</li>
                </ul>

                <h3>Composición de Funciones</h3>
                <p>La composición permite crear nuevas funciones a partir de funciones existentes. Si tenemos dos funciones f y g, podemos componerlas para formar h(x) = g(f(x)). Esto es útil en matemáticas avanzadas.</p>

                <h3>Inversibilidad</h3>
                <p>Una función es invertible si existe otra función que deshace la acción original:</p>
                <p><code>f^{-1}(f(x)) = x</code></p>
            </section>

            <section class="topic-section"> 
                <h2 class="topic-subtitle"> Ejemplos Ilustrativos </h2>

                <h3>Ejemplo 1: Función Lineal</h3>
                <pre><code>f(x) = 3x + 2
                Dominio: Todos los números reales (ℝ).
                Rango: Todos los números reales (ℝ).</code></pre>
                
            </section>
            <iframe width="350" height="250" src="https://www.youtube.com/embed/0k0Ry5PytJE" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>

            <button class="cssbuttons-io-button" onclick="window.location.href='../temas/pregCorrespondencia.php'">
              Realizar Cuestionario 
            <div class="icon"> 
                <svg height="24" width="24" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"> 
                    <path d="M0 0h24v24H0z" fill="none"></path> 
                    <path d="M16.172 11l-5.364-5.364 1.414-1.414L20 12l-7.778 7.778-1.414-1.414L16.172 13H4v-2z" fill="currentColor"></path> 
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
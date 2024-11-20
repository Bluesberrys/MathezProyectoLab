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
    <title>Mathez - Sucesiones y Series</title>
    <link rel="icon" type="image/png" href="../img/M-titanone.png" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/mathjax/2.7.7/MathJax.js?config=TeX-MML-AM_CHTML"></script>
    <script type="text/x-mathjax-config">
      MathJax.Hub.Config({
          tex2jax: {inlineMath: [['$','$'], ['\\(','\\)']]}
      });
    </script>
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

    <?php
        
      $matricula = mysqli_real_escape_string($conexion, $_SESSION["matricula"]);

      $Id_inscrip = mysqli_query($conexion, "SELECT id_inscrip FROM inscripciones WHERE numCta = '$matricula' AND id_curso = '1'");

      $contarID = mysqli_num_rows($Id_inscrip);

      if($contarID == 1)
      {
          $row = mysqli_fetch_array($Id_inscrip, MYSQLI_ASSOC);
          $idInscrip = $row['id_inscrip'];
      }

      $consultaEstatus = mysqli_query($conexion, "SELECT estatus FROM avances WHERE id_inscrip = '$idInscrip' AND id_tema = 10");

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
        if($estatus == "Terminado")
        {
        ?>
            <button class="btn-tema" type="submit" onclick="actTemaProgreso('sucesiones')">
            Tema visto
            </button>
        <?php
        }
        ?>
      <div class="container">
        <div class="container-title">
          <h1 class="alt-font">
            <!-- Titulo general del tema -->
            Sucesiones y Series
          </h1>
        </div>

        <section class="topic-section">
          <h2 class="topic-subtitle">
            <!-- subtitulo -->
            ¿Qué son las sucesiones?
          </h2>
          <!-- contenido -->
          <p>
            Una sucesion es un conjunto ordenado de elementos que responden a una regla o patron especifico. 
            Los elementos de la sucesion se denominan terminos, y suelen representarse como α1,α2,α3...,
            donde el subindice indica la posicion del termino en la sucesion.
          </p>
          <p>
            Estas sucesiones tienen aplicaciones en varios campos de estudio (fisica, economia, computacion, etc,)
            y dependiendo de las reglas que generen, estas pueden clasificarse de diferentes formas:
          </p>
          <h3>1. Aritmeticas:</h3>
          <p>
            En estas, la diferencia entre terminos consecutivos es constantes
            <p>
            Por ejemplo: 2,5,8,11,...
            <p>
            La regla general que seguiria es: \[α_n=α_1+(n−1)d\]
            <p>
            Donde "d" es la diferencia comun
            <p>
            </p>
              <h3>2. Geometicas:</h3>
          <p>
            En estas, el cociente entre terminos consecutivos es constantes
            <p>
            Por ejemplo: 3,6,12,24,...
            <p>
            La regla general que seguiria es: \[α_n=α_1*r^{n−1}\]
            <p>
            Donde "r" es la razon comun
            <p>
              <h3>3. cuadraticas:</h3>
          <p>
            Los terminos son resultados de una funcion cuadratica
            <p>
            Por ejemplo: 1,4,9,16,...
            <p>
            La regla general que seguiria es: \[α_n=n^2\]
            <p>
            </p>
              <h3>4. Armonicas:</h3>
          <p>
            Estas son reciprocas de los numeros naturales
            <p>
            Por ejemplo: 1,1/2,1/3,1/4,...
            <p>
            La regla general que seguiria es: \[α_n= \frac{1}{n}\]
            <p>
              <h2 class="topic-subtitle">
                ¿Qué son las series?
              </h2>
              <p>
                Las series numericas es la suma de los teminos de una sucesion, al considerar estas sumas se
                construye una serie numerica asociada a la sucesion, los numeros α1,α2,α3...son los terminos 
                de la serie y los numeros S1,S2,S3... son sus sumas parciales
              </p>
          <div style="padding: 20px">\[ S_1= α_1\]</div>
          <div style="padding: 20px">\[ S_2= α_1+α_2\]</div>
          <div style="padding: 20px">\[ S_3= α_1+α_2+α_3\]</div>
          <div style="padding: 20px">\[ S_n= α_1+α_2+α_3...+α_n\]</div>
          <p>El resultado de estas sumas puede ser finito o infinito dependiendo si hay un limite de terminos.</p>
          <p>Asi como hay diferentes tipos de sucesiones, tambien hay diferentes tipos de series numericas:</p>
          <h3>1. Aritmeticas:</h3>
          <p>
            Se obtienen al sumar los terminos de una sicesion aritmetica
            <p>
            Por ejemplo: 2+5+8+11+...+n
            <p>
            La suma de una serie aritmetica finita es: \[S_n=\frac{n}{2}*(α_1+a_n)\]
            <p>
            Donde "n" es numero de terminos
            <p>
            </p>
              <h3>2. Geometicas:</h3>
          <p>
            Provienen de sumar terminos de una sucesion geometrica.
            <p>
            Por ejemplo: 3+6+12+24+...
            <p>
            La suma de una serie gemetrica finita es: \[S_n=\frac{1-r^n}{1-r}\]
            si "r" no es igual a uno
            <p>
            Si la serie es infinita y "r" es menor a 1 la suma converge: \[S=\frac{α_1}{1-r}\]
            <p>
              <h3>3. Armonicas:</h3>
          <p>
            Derivan de la susecion Armonicas
            <p>
            Por ejemplo: 1+1/2+1/3+1/4,...
            <p>
            Estaserie diverge (S tiende a infinito) aunque crece muy lentamente
            <p>
            </p>
              <h3>Convergencia</h3>
          <p>
            Para las series infinitas, las sumas convergen si el limite de las sumas es finito
            <p>
              \[\lim_{n \to \infty} S_n = S\]
          <p>
            Si no tienen un limite finito, se dice que la serie "diverge"
            <p>
        </section>

        <button class="cssbuttons-io-button" onclick="window.location.href='../temas/pregSucesiones.php'">
            Realizar Cuestionario
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
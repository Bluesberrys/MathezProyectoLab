<?php
    session_name("sesion_alumno");
    session_start();
    if(isset($_SESSION["alumno"]) and $_SESSION["alumno"]==1)
    {
?>
<?php

    include_once "../solicitudes/conexion.php";

    $matricula = mysqli_real_escape_string($conexion, $_SESSION["matricula"]);
    $nombre = mysqli_real_escape_string($conexion, $_SESSION["nombre"]);
    $materno = mysqli_real_escape_string($conexion, $_SESSION["apellidoM"]);
    $paterno = mysqli_real_escape_string($conexion, $_SESSION["apellidoP"]);

    $datosAl = mysqli_query($conexion, "SELECT email, passwd FROM alumnos WHERE numCta = '$matricula'");

    $contarAl = mysqli_num_rows($datosAl);

    if($contarAl == 1)
    {
        $row = mysqli_fetch_array($datosAl, MYSQLI_ASSOC);
        $correo = $row["email"];
        $passwd = $row["passwd"];
    }
    mysqli_close($conexion);
?>
<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Mathez - Configuración</title>
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
    <link rel="stylesheet" href="../css/styles-settings.css" />
    <link rel="stylesheet" href="../css/styles-dark.css" />
    <link rel="stylesheet" href="../css/fonts.css" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  </head>

  <body>
    <!-- Header -->
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
                <a href="../homepage.php" style="text-decoration: none;">
                    <button type="button" class="btn alt-font dropdown-item">Inicio</button>
                </a>
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

    <!-- Content -->
    <div id="userSettings" class="settings-container">
      <aside class="settings-sidebar">
        <nav>
          <ul>
            <li><a href="#userInfo" class="active">Información Personal</a></li>
            <li><a href="#securitySettings">Seguridad</a></li>
            <!--<li><a href="#notificationSettings">Notificaciones</a></li>
            <li><a href="#privacySettings">Privacidad</a></li>-->
          </ul>
        </nav>
      </aside>

        <?php
            if(isset($_GET['editado']))
            {
        ?>
        <script>
            Swal.fire({
                position: "center",
                icon: "success",
                title: "Datos Actualizados",
                showConfirmButton: false,
                timer: 1200
            });
        </script>
        <?php
            }
        ?>

        <?php
            if(isset($_GET['contrasena']))
            {
        ?>
        <script>
            Swal.fire({
                position: "center",
                icon: "success",
                title: "Contraseña Actualizada",
                showConfirmButton: false,
                timer: 1300
            });
        </script>
        <?php
            }
        ?>

      <main class="settings-content">
        <section id="userInfo" class="settings-section active">
          <h2>Información Personal</h2>
          <form action="../solicitudes/actDatos.php" method="POST" id="updateUserForm">
            <div class="form-group">
              <label for="updateNumCta">Número de Cuenta:</label>
              <input class="base-font" type="text" id="updateNumCta" name="numCta" value="<?php echo $matricula ?>" readonly/>
            </div>
            <div class="form-group">
              <label for="updateNombres">Nombres:</label>
              <input class="base-font" type="text" id="updateNombres" name="nombres" value="<?php echo $nombre ?>" required />
            </div>
            <div class="form-group">
              <label for="updateApellidoP">Apellido Paterno:</label>
              <input class="base-font" type="text" id="updateApellidoP" name="apellidoP" value="<?php echo $paterno ?>" required />
            </div>
            <div class="form-group">
              <label for="updateApellidoM">Apellido Materno:</label>
              <input class="base-font" type="text" id="updateApellidoM" name="apellidoM" value="<?php echo $materno ?>" required />
            </div>
            <div class="form-group">
              <label for="updateEmail">Correo Electrónico:</label>
              <input class="base-font" type="email" id="updateEmail" name="email" value="<?php echo $correo ?>" required />
            </div>
            <button type="submit" class="btn btn-primary alt-font">Actualizar Información</button>
          </form>
        </section>

        <section id="securitySettings" class="settings-section">
            <h2>Configuración de Seguridad</h2>
            <form action="../solicitudes/actContra.php" method="POST" id="updateSecurityForm">
                <div class="form-group">
                    <label for="contraActual">Contraseña Actual:</label>
                    <input type="hidden" id="contraActual2" name="contraActual2" value="<?php echo htmlspecialchars($passwd); ?>">
                    <input class="base-font" type="password" id="contraActual" name="contraActual" required />
                </div>
                <div class="form-group">
                    <label for="updatePasswd">Nueva Contraseña:</label>
                    <input class="base-font" type="password" id="updatePasswd" name="passwd" required />
                </div>
                <div class="form-group">
                    <label for="confirmUpdatePasswd">Confirmar Nueva Contraseña:</label>
                    <input class="base-font" type="password" id="confirmUpdatePasswd" name="confirmPasswd" required />
                </div>
                <button type="submit" class="btn btn-primary alt-font">
                    Actualizar Configuración de Seguridad
                </button>
            </form>
        </section>

        <section id="notificationSettings" class="settings-section">
          <h2>Configuración de Notificaciones</h2>
          <form id="updateNotificationsForm">
            <div class="form-group">
              <label for="emailNotifications">
                <input type="checkbox" id="emailNotifications" name="emailNotifications" />
                Recibir notificaciones por correo electrónico
              </label>
            </div>
            <div class="form-group">
              <label for="smsNotifications">
                <input type="checkbox" id="smsNotifications" name="smsNotifications" />
                Recibir notificaciones por SMS
              </label>
            </div>
            <button type="submit" class="btn btn-primary alt-font">
              Actualizar Preferencias de Notificaciones
            </button>
          </form>
        </section>

        <section id="privacySettings" class="settings-section">
          <h2>Configuración de Privacidad</h2>
          <form id="updatePrivacyForm">
            <div class="form-group">
              <label for="profileVisibility">
                <input type="checkbox" id="profileVisibility" name="profileVisibility" />
                Hacer mi perfil visible para otros usuarios
              </label>
            </div>
            <div class="form-group">
              <label for="dataSharing">
                <input type="checkbox" id="dataSharing" name="dataSharing" />
                Permitir compartir datos para mejorar el servicio
              </label>
            </div>
            <button type="submit" class="btn btn-primary alt-font">
              Actualizar Configuración de Privacidad
            </button>
          </form>
        </section>
      </main>
    </div>

    <!-- Footer -->
    <footer>
      <div class="footer">
        <div class="">
          <p>©</p>
        </div>
        <a href="../sobreNos.html" class="btn">Sobre nosotros</a>
      </div>
    </footer>

    <script src="../js/app.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/3.1.9-1/crypto-js.js"></script>

    <script>
      document.getElementById('updateSecurityForm').addEventListener('submit', function(event) {
          const contraActual2 = document.getElementById("contraActual2").value; 
          const contraActual = document.getElementById("contraActual").value; 
          const nuevaContra = document.getElementById("updatePasswd").value;
          const confirmContra = document.getElementById("confirmUpdatePasswd").value; 

          if (contraActual.toString() !== contraActual2) {
              alert("La contraseña actual no es correcta.");
              event.preventDefault(); 
              return;
          }

          if (nuevaContra !== confirmContra) {
              alert("Las nuevas contraseñas no coinciden.");
              event.preventDefault();
          }
      });
    </script>
    
    <script>
        //Script para que al momento de refrescar la pagina, no aparezca el sweet alert
        setTimeout(() => {
            window.history.replaceState(null, null, window.location.pathname);
        }, 0);
    </script>

  </body>
</html>
<?php
    }
    else
    {
        header("Location:index.php"); 
    }
?>
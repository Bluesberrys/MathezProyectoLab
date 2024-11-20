document.addEventListener("DOMContentLoaded", initializeIndexPage);
initializeCourseRegistration();
initializeDropdown();
document.addEventListener("DOMContentLoaded", initializeSettingsNavigation);
enableDarkMode();

function logout() {
  window.location.href = "solicitudes/cerrar.php";
}

function initializeDropdown() {
  const userDropdownToggle = document.getElementById("userDropdownToggle");
  const userDropdown = document.getElementById("userDropdown");

  if (userDropdownToggle && userDropdown) {
    userDropdownToggle.addEventListener("click", function (e) {
      e.stopPropagation();
      userDropdown.classList.toggle("active");
    });

    // Close the dropdown when clicking outside of it
    document.addEventListener("click", function (e) {
      if (!userDropdown.contains(e.target) && !userDropdownToggle.contains(e.target)) {
        userDropdown.classList.remove("active");
      }
    });
  }
}

// Index page specific functions
function initializeIndexPage() {
  
  // Initialize dark mode
  initializeDarkMode();

  // View switching
  window.showView = function (viewId) {
    document.querySelectorAll(".view").forEach((view) => view.classList.remove("active"));
    document.getElementById(viewId + "View").classList.add("active");
  };

  // Registration form handling
  //const registroForm = document.getElementById("registroForm");
  const page1 = document.getElementById("page1");
  const page2 = document.getElementById("page2");
  const nextBtn = document.getElementById("nextBtn");
  const prevBtn = document.getElementById("prevBtn");

  if (nextBtn) {
    nextBtn.addEventListener("click", function () {
      if (validatePage1()) {
        page1.classList.remove("active");
        page2.classList.add("active");
      }
    });
  }

  if (prevBtn) {
    prevBtn.addEventListener("click", function () {
      page2.classList.remove("active");
      page1.classList.add("active");
    });
  }
}

function validatePage1() {
  const email = document.getElementById("email").value;
  const passwd = document.getElementById("passwd").value;
  const confirmPasswd = document.getElementById("confirmPasswd").value;

  if (!email || !passwd || !confirmPasswd) {
    alert("Por favor, completa todos los campos");
    return false;
  }

  if (passwd !== confirmPasswd) {
    alert("Las contraseñas no coinciden");
    return false;
  }

  return true;
}

document.getElementById("registroForm").addEventListener("submit", function (event) {
  event.preventDefault(); 

  const matricula = document.getElementById("matricula").value;
  const apellidoP = document.getElementById("apellidoP").value;
  const apellidoM = document.getElementById("apellidoM").value;
  const nombres = document.getElementById("nombres").value;
  const email = document.getElementById("email").value;
  const passwd = document.getElementById("passwd").value;

  fetch("registrarAl.php", {
      method: "POST",
      headers: {
          "Content-Type": "application/json"
      },
      body: JSON.stringify({ matricula, apellidoP, apellidoM, nombres, email, passwd })
  })
  .then((response) => {
      // Verificar si la respuesta es correcta
      if (!response.ok) {
          throw new Error('Error en la red: ' + response.statusText);
      }
      return response.json();
  })
  .then((data) => {
      // Procesar la respuesta del servidor
      if (data.success) {
          alert('Registro exitoso! Ya puedes iniciar sesión');
          showView("login");
      } else {
          alert("Ya existe ese No. de Cuenta");
      }
  })
  .catch((error) => {
    console.error("Error:", error);
    alert("Ocurrió un error. Por favor, intenta de nuevo: " + error.message);
  });
});

// Login form handling
document.addEventListener("DOMContentLoaded", function () {
  const loginForm = document.getElementById("loginForm");

  if (loginForm) {
      loginForm.addEventListener("submit", function (event) {
          event.preventDefault();

          const numCta = document.getElementById("loginNumCta").value;
          const passwd = document.getElementById("loginPasswd").value;

          fetch("solicitudes/verifAl.php", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
            },
            body: JSON.stringify({ numCta, passwd }),
        })
        .then((response) => {
            if (!response.ok) {
                throw new Error("Error en la red: " + response.status);
            }
            return response.json();
        })
        .then((data) => {
            console.log(data);
            if (data.success) {
                window.location.href = "./homepage.php";
            } else {
                alert(data.message);
            }
        })
        .catch((error) => {
            console.error(error);
            alert("Ocurrió un error. Por favor, intenta de nuevo.");
        });
        
      });
  } else {
      console.error("El formulario de login no se encontró.");
  }
});

// Homepage specific functions
function initializeHomePage() {
  // Initialize dark mode
  initializeDarkMode();

  // Initialize dropdown
  initializeDropdown();

  // Initialize course registration form
  initializeCourseRegistration();
}

function displayNotEnrolledMessage() {
  const mainContent = document.getElementById("mainContent");
  if (mainContent) {
    mainContent.innerHTML = `
            <h2>No estás inscrito en algún curso.</h2>
      `;
  } else {
    console.error("mainContent element not found");
  }
}

function initializeCourseRegistration() {
  const showCourseRegistrationButton = document.getElementById("showCourseRegistrationButton");
  const courseRegistrationContainer = document.getElementById("courseRegistrationContainer");
  
  if (showCourseRegistrationButton && courseRegistrationContainer) {
    showCourseRegistrationButton.addEventListener("click", () => {
      courseRegistrationContainer.classList.toggle("hidden");
    });
  }

}

// Initialize the appropriate page based on the current URL
document.addEventListener("DOMContentLoaded", function () {
  const currentPath = window.location.pathname;
  if (currentPath.includes("index.html") || currentPath === "/") {
    initializeIndexPage();
  } else if (currentPath.includes("homepage.html")) {
    initializeHomePage();
  } else if (currentPath.includes("configPerfil.html")) {
    initializeSettingsPage();
  } else {
    // For other pages (like sobreNos.html), just initialize dark mode and dropdown
    initializeDarkMode();
    initializeDropdown();
  }
});

// Settins page specific functions
function initializeSettingsPage() {
  // Initialize dark mode
  initializeDarkMode();

  // Initialize dropdown
  initializeDropdown();

  // Settings navigation
  const sidebarLinks = document.querySelectorAll(".settings-sidebar a");
  const settingsSections = document.querySelectorAll(".settings-section");

  sidebarLinks.forEach((link) => {
    link.addEventListener("click", function (e) {
      e.preventDefault();
      const targetId = this.getAttribute("href").slice(1);

      // Update active link
      sidebarLinks.forEach((l) => l.classList.remove("active"));
      this.classList.add("active");

      // Show target section, hide others
      settingsSections.forEach((section) => {
        if (section.id === targetId) {
          section.classList.add("active");
        } else {
          section.classList.remove("active");
        }
      });
    });
  });

  // Form submission handlers
  const forms = document.querySelectorAll("form");
  forms.forEach((form) => {
    form.addEventListener("submit", handleFormSubmit);
  });

  // Populate user info form
  populateUserForm();
}

function populateUserForm() {
  const token = localStorage.getItem("authToken");
  fetch("/api/user", {
    headers: {
      Authorization: `Bearer ${token}`,
    },
  })
    .then((response) => response.json())
    .then((userData) => {
      document.getElementById("updateNombres").value = userData.nombres;
      document.getElementById("updateApellidoP").value = userData.apellidoP;
      document.getElementById("updateApellidoM").value = userData.apellidoM;
      document.getElementById("updateEmail").value = userData.email;
      document.getElementById("updateNumCta").value = userData.numCta;
    })
    .catch((error) => console.error("Error fetching user data:", error));
}

function handleFormSubmit(event) {
  event.preventDefault();
  const formId = event.target.id;
  const formData = new FormData(event.target);
  const updateData = Object.fromEntries(formData.entries());

  // Handle specific form submissions
  switch (formId) {
    case "updateUserForm":
      updateUserInfo(updateData);
      break;
    case "updateSecurityForm":
      updateSecuritySettings(updateData);
      break;
    case "updateNotificationsForm":
      updateNotificationSettings(updateData);
      break;
    case "updatePrivacyForm":
      updatePrivacySettings(updateData);
      break;
    default:
      console.error("Unknown form submitted:", formId);
  }
}

function updateNotificationSettings(updateData) {
  alert("La actualización de preferencias de notificaciones estará disponible próximamente.");
  // You can still send the data to the server for logging purposes if you want
  console.log("Notification settings to be implemented:", updateData);
}

function updatePrivacySettings(updateData) {
  alert("La actualización de configuración de privacidad estará disponible próximamente.");
  // You can still send the data to the server for logging purposes if you want
  console.log("Privacy settings to be implemented:", updateData);
}

// Dark mode functions
function initializeDarkMode() {
  const darkModeToggle = document.getElementById("darkModeToggle");
  const body = document.body;

  // Check for saved dark mode preference
  if (localStorage.getItem("darkMode") === "enabled") {
    body.classList.add("dark-mode");
    if (darkModeToggle) {
      darkModeToggle.checked = true;
    }
  }

  // Toggle dark mode
  if (darkModeToggle) {
    darkModeToggle.addEventListener("change", function () {
      if (this.checked) {
        enableDarkMode();
      } else {
        disableDarkMode();
      }
    });
  }
}

function enableDarkMode() {
  document.body.classList.add("dark-mode");
  localStorage.setItem("darkMode", "enabled");
}

function disableDarkMode() {
  document.body.classList.remove("dark-mode");
  localStorage.setItem("darkMode", null);
}

function initializeSettingsNavigation() {
  const links = document.querySelectorAll('.settings-sidebar a');
  const sections = document.querySelectorAll('.settings-section');

  links.forEach(link => {
      link.addEventListener('click', function(e) {
          e.preventDefault(); // Prevenir el comportamiento por defecto del enlace
          const targetId = this.getAttribute('href'); // Obtener el ID del target

          // Desactivar todos los enlaces y secciones
          links.forEach(l => l.classList.remove('active'));
          sections.forEach(section => section.classList.remove('active'));

          // Activar el enlace y la sección correspondientes
          this.classList.add('active');
          document.querySelector(targetId).classList.add('active');
      });
  });
}

function validatePasswords() {
  const password = document.getElementById('updatePasswd').value;
  const confirmPassword = document.getElementById('confirmUpdatePasswd').value;

  if (password !== confirmPassword) {
      alert("Las contraseñas no coinciden");
      return false; 
  }
  return true; 
}

function actTemaTerminado(tema) {
  window.location.href = `../solicitudes/temaTerminado.php?tema=${tema}`;
}

function actTemaProgreso(tema) {
  window.location.href = `../solicitudes/temaProgreso.php?tema=${tema}`;
}
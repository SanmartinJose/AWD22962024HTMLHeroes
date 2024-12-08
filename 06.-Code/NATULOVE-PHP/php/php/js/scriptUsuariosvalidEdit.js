async function loadRolesEdit(defaultRoleId) {
    try {
        const response = await fetch("./crudPHP/backUsuarios.php", {
            method: "POST",
            headers: {
                "Content-Type": "application/x-www-form-urlencoded",
            },
            body: new URLSearchParams({
                action: "loadRols",
            }),
        });
        const roles = await response.json();
        const select = document.getElementById("edit-rol");
        select.innerHTML = '';

        const defaultOption = document.createElement("option");
        defaultOption.value = '';
        defaultOption.textContent = 'Seleccionar rol';
        defaultOption.disabled = true;
        select.appendChild(defaultOption);

        roles.forEach((role) => {
            const option = document.createElement("option");
            option.value = role.id_rol;
            option.textContent = role.nombre_rol;
            
            if (role.id_rol === defaultRoleId) {
                option.selected = true;
            }

            select.appendChild(option);
        });
    } catch (error) {
        console.error("Error:", error);
    }
}

  
  document.getElementById("edit-nombres").addEventListener("input", function () {
    const nombres = this.value;
    const regex = /^[a-zA-Z\s]*$/;
    if (!regex.test(nombres)) {
      this.setCustomValidity("Solo se permiten letras y espacios.");
      this.classList.add("is-invalid");
    } else {
      this.setCustomValidity("");
      this.classList.remove("is-invalid");
    }
  });
  
  document.getElementById("edit-apellidos").addEventListener("input", function () {
    const apellidos = this.value;
    const regex = /^[a-zA-Z\s]*$/;
    if (!regex.test(apellidos)) {
      this.setCustomValidity("Solo se permiten letras y espacios.");
      this.classList.add("is-invalid");
    } else {
      this.setCustomValidity("");
      this.classList.remove("is-invalid");
    }
  });
  
  // Validación en tiempo real para cédula
  document.getElementById("edit-cedula").addEventListener("input", function () {
    const cedula = this.value;
    const regex = /^\d{10,13}$/;
    if (!regex.test(cedula)) {
      this.setCustomValidity("Debe tener entre 10 y 13 dígitos y solo números.");
      this.classList.add("is-invalid");
    } else {
      this.setCustomValidity("");
      this.classList.remove("is-invalid");
    }
  });
  
  // Validación en tiempo real para email (Bootstrap lo maneja por defecto)
  document.getElementById("edit-email").addEventListener("input", function () {
    if (this.checkValidity()) {
      this.classList.remove("is-invalid");
    } else {
      this.classList.add("is-invalid");
    }
  });
  
  // Validación en tiempo real para teléfono
  document.getElementById("edit-telefono").addEventListener("input", function () {
    const telefono = this.value;
    const regex = /^\d{10}$/;
    if (!regex.test(telefono)) {
      this.setCustomValidity("El número de teléfono debe tener 10 dígitos.");
      this.classList.add("is-invalid");
    } else {
      this.setCustomValidity("");
      this.classList.remove("is-invalid");
    }
  });
  
  // Mostrar/Ocultar contraseña
  document.getElementById("toggleEditPassword").addEventListener("click", function () {
      const passwordField = document.getElementById("edit-password");
      const passwordFieldType = passwordField.getAttribute("type");
      const passwordToggleButton = this.querySelector("i");
  
      if (passwordFieldType === "password") {
        passwordField.setAttribute("type", "text");
        passwordToggleButton.classList.remove("bi-eye");
        passwordToggleButton.classList.add("bi-eye-slash");
      } else {
        passwordField.setAttribute("type", "password");
        passwordToggleButton.classList.remove("bi-eye-slash");
        passwordToggleButton.classList.add("bi-eye");
      }
    });
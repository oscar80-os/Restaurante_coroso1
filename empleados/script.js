document.getElementById("create-form").addEventListener("submit", crearEmpleado);

// Función para cargar la lista de empleados
function cargarEmpleados() {
  // Realizar una solicitud HTTP GET a api.php con la acción "getEmpleados"
  fetch("api.php?action=getEmpleados")
    .then(response => response.json())
    .then(data => {
      const empleadosTable = document.getElementById("empleados-table");
      // Limpiar la tabla
      empleadosTable.innerHTML = "";

      // Recorrer los empleados y agregarlos a la tabla
      data.forEach(empleado => {
        const row = empleadosTable.insertRow();

        row.innerHTML = `
          <td>${empleado.id}</td>
          <td>${empleado.nombre}</td>
          <td>${empleado.apellido}</td>
          <td>${empleado.puesto}</td>
          <td>
            <button onclick="editarEmpleado(${empleado.id})">Editar</button>
            <button onclick="eliminarEmpleado(${empleado.id})">Eliminar</button>
          </td>
        `;
      });
    });
}

// Función para crear un nuevo empleado
function crearEmpleado(event) {
  event.preventDefault();

  // Obtener los valores del formulario
  const nombre = document.querySelector("input[name=nombre]").value;
  const apellido = document.querySelector("input[name=apellido]").value;
  const puesto = document.querySelector("input[name=puesto]").value;

  // Realizar una solicitud HTTP POST a api.php con la acción "createEmpleado" y los datos del empleado
  fetch("api.php?action=createEmpleado", {
    method: "POST",
    headers: {
      "Content-Type": "application/json"
    },
    body: JSON.stringify({ nombre, apellido, puesto })
  })
    .then(() => {
      // Limpiar el formulario
      document.getElementById("create-form").reset();

      // Actualizar la lista de empleados
      cargarEmpleados();
    });
}

// Función para editar un empleado
function editarEmpleado(id) {
  // Obtener los valores del empleado a editar
  const nombre = prompt("Ingrese el nuevo nombre:");
  const apellido = prompt("Ingrese el nuevo apellido:");
  const puesto = prompt("Ingrese el nuevo puesto:");

  // Realizar una solicitud HTTP POST a api.php con la acción "updateEmpleado" y los datos actualizados del empleado
  fetch("api.php?action=updateEmpleado", {
    method: "POST",
    headers: {
      "Content-Type": "application/json"
    },
    body: JSON.stringify({ id, nombre, apellido, puesto })
  })
    .then(() => {
      // Actualizar la lista de empleados
      cargarEmpleados();
    });
}

// Función para eliminar un empleado
function eliminarEmpleado(id) {
  // Confirmar si el usuario desea eliminar el empleado
  if (confirm("¿Está seguro de que desea eliminar este empleado?")) {
    // Realizar una solicitud HTTP GET a api.php con la acción "deleteEmpleado" y el ID del empleado a eliminar
    fetch(`api.php?action=deleteEmpleado&id=${id}`)
      .then(() => {
        // Actualizar la lista de empleados
        cargarEmpleados();
      });
  }
}

// Cargar la lista de empleados al cargar la página
cargarEmpleados();

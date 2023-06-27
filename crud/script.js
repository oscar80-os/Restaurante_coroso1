// Función para cargar los datos desde el servidor
function loadData() {
    fetch('api.php')
        .then(response => response.json())
        .then(data => {
            const tableBody = document.getElementById('data-table-body');
            tableBody.innerHTML = '';
            
            data.forEach(item => {
                const row = document.createElement('tr');
                row.innerHTML = `
                    <td>${item.name}</td>
                    <td>${item.email}</td>
                    <td>
                        <button onclick="editData(${item.id})">Editar</button>
                        <button onclick="deleteData(${item.id})">Eliminar</button>
                    </td>
                `;
                
                tableBody.appendChild(row);
            });
        });
}

// Función para enviar los datos al servidor
function saveData(name, email) {
    const data = {
        name: name,
        email: email
    };
    
    fetch('api.php', {
        method: 'POST',
        body: JSON.stringify(data)
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Limpiar los campos de entrada después de guardar los datos exitosamente
            document.getElementById('name-input').value = '';
            document.getElementById('email-input').value = '';
            
            // Volver a cargar los datos actualizados
            loadData();
        }
    });
}

// Función para editar un registro
function editData(id) {
    // Aquí puedes implementar la lógica para editar un registro específico
    console.log('Editar registro con ID:', id);
}

// Función para eliminar un registro
function deleteData(id) {
    // Aquí puedes implementar la lógica para eliminar un registro específico
    console.log('Eliminar registro con ID:', id);
}

// Evento submit del formulario
document.getElementById('crud-form').addEventListener('submit', function(event) {
    event.preventDefault(); // Evitar la recarga de la página
    
    const name = document.getElementById('name-input').value;
    const email = document.getElementById('email-input').value;
    
    if (name && email) {
        saveData(name, email);
    }
});

// Cargar los datos iniciales
loadData();

// Definicion de constante
// Ubicacion de la API.


document.addEventListener('DOMContentLoaded', () => {

    alert("Pagina recargada");
    obtenerTodosLasMarca();

    document.getElementById('add-marca-form').addEventListener('submit', function(event) {
        event.preventDefault();
        const form = this;
        const data = {
            dsc_marca: form.dsc_marca.value,
            ide_estado: parseInt(form.ide_estado.value)
        };
        guardarMarca(data);
        form.reset();
    });

    document.getElementById('update-marca-form').addEventListener('submit', function(event) {

        event.preventDefault();
        const form = this;
        const data = {
            ide_marca: form.ide_marca.value,
            dsc_marca: form.dsc_marca.value,
            ide_estado: parseInt(form.ide_estado.value)
        };
        actualizarMarca(data);
        form.reset();
        form.style.display = 'none';
    });

    
});

function obtenerTodosLasMarca() {

    const xhr = new XMLHttpRequest();
    xhr.open('GET','http://localhost/api/libreria-api/public/index.php/marca', true);
    xhr.onload = function () {
        if (this.status === 200) {
            const cleanedText = this.responseText.replace(/^\uFEFF/, '').trim();
            try {
                const marcas = JSON.parse(cleanedText);
                document.querySelector('#marca-table tbody').innerHTML = ''; // Limpiar de la tabla previo

                marcas.forEach(marca => {
                    const tr = document.createElement('tr');
                    tr.innerHTML = `
                        <td>${marca.DSC_MARCA}</td>
                         <td>${((marca.IDE_ESTADO == 1) ? 'Activo' : 'Inactivo')}</td>
                        <td>
                         <button onclick="mostrarFormActualizarMarca(${marca.IDE_MARCA}, '${marca.DSC_MARCA}', ${marca.IDE_ESTADO})">Actualizar</button>
                         <button onclick="eliminarMarca(${marca.IDE_MARCA})">Eliminar</button>
                        </td>
                    `;
                    document.querySelector('#marca-table tbody').appendChild(tr);
                });
            } catch (e) {
                console.error('Error parsing JSON:', e);
            }
        } else {
            console.error('Error fetching books:', this.statusText);
        }
    };
    xhr.onerror = function () {
        console.error('Request error...');
    };
    xhr.send();
}

function guardarMarca(data) {
    const xhr = new XMLHttpRequest();
    xhr.open('POST', 'http://localhost/api/libreria-api/public/index.php/marca', true);
    xhr.setRequestHeader('Content-Type', 'application/json');
    xhr.onload = function () {
        if (xhr.status === 200) {
            console.log('Marca guardada exitosamente');
            obtenerTodosLasMarca(); // Actualizar lista de libros después de guardar
        } else {
            console.error('Error al guardar la marca:', xhr.statusText);
        }
    };
    xhr.onerror = function () {
        console.error('Error en la solicitud');
    };
    xhr.send(JSON.stringify(data));
}

function eliminarMarca(MarcaId) {
    const xhr = new XMLHttpRequest();
    xhr.open('DELETE', 'http://localhost/api/libreria-api/public/index.php/marca/'+ MarcaId, true);
    xhr.onload = function () {
        if (xhr.status === 200) {
            console.log('Marca eliminada exitosamente');
            obtenerTodosLasMarca(); 
        } else {
            console.error('Error al eliminar la marca:', xhr.statusText);
        }
    };
    xhr.onerror = function () {
        console.error('Error en la solicitud');
    };
    xhr.send();
}

function mostrarFormActualizarMarca(ide_marca, dsc_marca, ide_estado) {

    const form = document.getElementById('update-marca-form');
    form.querySelector('#update-ide_marca').value = ide_marca;
    form.querySelector('#update-dsc_marca').value = dsc_marca;
    form.querySelector('#update-ide_estado').value = ide_estado;
    form.style.display = 'block';
}

function actualizarMarca(data) {
    const xhr = new XMLHttpRequest();
    xhr.open('PUT', 'http://localhost/api/libreria-api/public/index.php/marca/'+data.ide_marca, true);
    xhr.setRequestHeader('Content-Type', 'application/json');
    xhr.onload = function () {
        if (xhr.status === 200) {
            console.log('Marca actualizada exitosamente');
            obtenerTodosLasMarca(); // Actualizar lista de libros después de actualizar
        } else {
            console.error('Error al actualizar la marca:', xhr.statusText);
        }
    };
    xhr.onerror = function () {
        console.error('Error en la solicitud');
    };
    xhr.send(JSON.stringify(data));
}
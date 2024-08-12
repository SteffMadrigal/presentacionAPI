function obtenerTodosLasMarca() {

    const xhr = new XMLHttpRequest();
    xhr.open('GET','http://localhost/api/libreria-api/public/index.php/marca', true);



    xhr.onload = function () {

        // Nos conectamos a la API por el endpoint usando get
        // si el status 200 significa que esta bien.
        // Leemos la respuesta de la api. 
        // Selecionas la tabla  #book-table
        // creamos logica para tomar todos esos datos y adjuntarlos(append) a #book-table
        if (this.status === 200) {

            const cleanedText = this.responseText.replace(/^\uFEFF/, '').trim();
            try {
                const marcas = JSON.parse(cleanedText);
                document.querySelector('#marca-table tbody').innerHTML = ''; // Limpiar de la tabla previo

                /*books.forEach(book => {
                    console.log("Autor: "+ book.autor
                    )
                });*/
                marcas.forEach(marca => {
                    const tr = document.createElement('tr');
                    tr.innerHTML = `
                        <td>${marca.dsc_marca}</td>
                         <td>${marca.ide_estado}</td>
                        <td>
                         <button onclick="mostrarFormActualizarMarca(${marca.ide_marca}, '${marca.dsc_marca}', ${marca.ide_estado})">Actualizar</button>
                         <button onclick="eliminarLibro(${marca.ide_marca})">Eliminar</button>
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
document.addEventListener('DOMContentLoaded', () => {
    Reportes1();
    Reportes2();
    Reportes3();
});


const API_URL = "http://localhost/api/libreria-api/public/index.php";
function Reportes1() {
    const xhr = new XMLHttpRequest();
    xhr.open('GET', 'http://localhost/api/libreria-api/public/index.php/marcasMasVendidas', true);
    xhr.onload = function () {
        if (this.status === 200) {
            const cleanedText = this.responseText.replace(/^\uFEFF/, '').trim();
            try {
                const masVendidas = JSON.parse(cleanedText);
                const tbody = document.querySelector('#marcaMasVendidas-table tbody');
                tbody.innerHTML = ''; // Limpiar contenido previo
                masVendidas.forEach(ventas => {
                    const tr = document.createElement('tr');
                    tr.innerHTML = `
                        <td>${ventas.DSC_MARCA}</td>
                        <td>${ventas.TOTAL}</td>
                    `;
                    tbody.appendChild(tr);
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

function Reportes2() {
    const xhr = new XMLHttpRequest();
    xhr.open('GET', 'http://localhost/api/libreria-api/public/index.php/marcasStock', true);
    xhr.onload = function () {
        if (this.status === 200) {
            const cleanedText = this.responseText.replace(/^\uFEFF/, '').trim();
            try {
                const masVendidas = JSON.parse(cleanedText);
                const tbody = document.querySelector('#prendas-table tbody');
                tbody.innerHTML = ''; // Limpiar contenido previo
                masVendidas.forEach(ventas => {
                    const tr = document.createElement('tr');
                    tr.innerHTML = `
                        <td>${ventas.DSC_PRENDA}</td>
                        <td>${ventas.MON_STOCK}</td>
                    `;
                    tbody.appendChild(tr);
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

function Reportes3() {
    const xhr = new XMLHttpRequest();
    xhr.open('GET', 'http://localhost/api/libreria-api/public/index.php/marcasVentas', true);
    xhr.onload = function () {
        if (this.status === 200) {
            const cleanedText = this.responseText.replace(/^\uFEFF/, '').trim();
            try {
                const masVendidas = JSON.parse(cleanedText);
                const tbody = document.querySelector('#marcas-table tbody');
                tbody.innerHTML = ''; // Limpiar contenido previo
                masVendidas.forEach(ventas => {
                    const tr = document.createElement('tr');
                    tr.innerHTML = `
                        <td>${ventas.DSC_MARCA}</td>
                    `;
                    tbody.appendChild(tr);
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



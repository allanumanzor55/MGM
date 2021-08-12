const URL_ORDENES = '../Backend/api/ordenes.php'

function mostrarCliente(btn) {
    btn.disabled = true
    refrescarCardClientes('Catalogo', -1)
    mostrarTab('tab-clientes', 'tab-ordenes')
    btn.disabled = false
}

async function obtenerOrdenes(permiso) {
    const datos = await obtener(URL_ORDENES, {})
    refrescarTableOrdenes(datos, permiso)
}

function refrescarTableOrdenes(datos, permiso) {
    console.log(datos)
    let content =
        `<thead>
            <tr>
                <th>Fecha</th>
                <th>Descripcion</th>
                <th>Estado</th>
            </tr>
        </thead>
        <tbody>`
    datos.forEach(ordenes => {
        content +=
            `<tr>
                <td>${ordenes.fecha}</td>
                <td>${ordenes.descripcion}</td>
                <td>${ordenes.estadoOrden}</td>
            </tr>`
    })
    content += `</tbody>`
    document.getElementById('tableOrdenes').innerHTML = content
}
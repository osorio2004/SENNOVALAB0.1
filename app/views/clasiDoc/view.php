<div class="container">

    
    <div class="filter-section">
        <input type="text" 
               id="searchInput" 
               placeholder="Buscar documento..." 
               oninput="aplicarFiltros()">

        <select id="tipoDocumento" onchange="aplicarFiltros()">
            <option value="">Todos los tipos</option>
            <option value="pdf">PDF</option>
            <option value="doc">Word</option>
            <option value="xls">Excel</option>
            <option value="jpg">Imágenes</option>
            <option value="txt">Texto</option>
        </select>

        <select id="clasificacionFilter" onchange="aplicarFiltros()">
            <option value="">Todas las clasificaciones</option>
            <option value="Gestion">Gestión</option>
            <option value="Administrativo">Administrativo</option>
            <option value="Personal">Personal</option>
            <option value="Financiero">Financiero</option>
            <option value="Legal">Legal</option>
            <option value="Tecnico">Técnico</option>
        </select>
    </div>
    <div class="padt"> 
    <?php if(isset($clasiDocs) && is_array($clasiDocs)): ?>
    <table class="data-table" id="documentosTable">
        <thead>
            <tr>
                <th>ID</th>
                <th>Creó</th>
                <th>Código</th>
                <th>Versión</th>
                <th>Nombre</th>
                <th>Elaborado Por</th>
                <th>Revisado Por</th>
                <th>Aprobado Por</th>
                <th>Proceso</th>
                <th>Subproceso</th>
                <th>Última Fecha Revisión</th>
                <th>Clasificación</th>
                <th>Fecha Subido</th>
                <th>Aprobación</th>
                <th>Editar</th>
                <th>Retención</th>
                <th>Documento Fuente</th>
                <th>Observaciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($clasiDocs as $clasiDoc): ?>
            <tr>
                <td><?php echo htmlspecialchars($clasiDoc->idDocumento ?? ''); ?></td>
                <td><?php echo htmlspecialchars($clasiDoc->idUsuarioCreador ?? ''); ?></td>
                <td><?php echo htmlspecialchars($clasiDoc->codigo ?? ''); ?></td>
                <td><?php echo htmlspecialchars($clasiDoc->version ?? ''); ?></td>
                <td><?php echo htmlspecialchars($clasiDoc->titulo ?? ''); ?></td>
                <td><?php echo htmlspecialchars($clasiDoc->idUsuarioElaboro ?? ''); ?></td>
                <td><?php echo htmlspecialchars($clasiDoc->revisado_por ?? ''); ?></td>
                <td><?php echo htmlspecialchars($clasiDoc->idUsuarioAprobo ?? ''); ?></td>
                <td><?php echo htmlspecialchars($clasiDoc->proceso ?? ''); ?></td>
                <td><?php echo htmlspecialchars($clasiDoc->subproceso ?? ''); ?></td>
                <td><?php echo htmlspecialchars($clasiDoc->fechaEdicion ?? ''); ?></td>
                <td><?php echo htmlspecialchars($clasiDoc->idCategoria ?? ''); ?></td>
                <td><?php echo htmlspecialchars($clasiDoc->fechaCreacion ?? ''); ?></td>
                <td><?php echo htmlspecialchars($clasiDoc->estado ?? ''); ?></td>
                <td>
                    <a href="<?php echo '/clasiDoc/edit/' . $clasiDoc->idDocumento; ?>" 
                       class="btn-edit"
                       title="Editar documento">
                        <i class="fas fa-edit"></i> Editar
                    </a>
                </td>
                <td><?php echo htmlspecialchars($clasiDoc->retencion ?? ''); ?></td>
                <td><?php echo htmlspecialchars($clasiDoc->documento_fuente ?? ''); ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <?php else: ?>
    <div class="message">
        <p>No hay clasificaciones disponibles. <a href="/clasiDoc/new">Crear nueva</a></p>
    </div>
    <?php endif; ?>
</div>
</div>

<script>
function aplicarFiltros() {
    const searchTerm = document.getElementById('searchInput').value.toLowerCase();
    const tipo = document.getElementById('tipoDocumento').value;
    const clasificacion = document.getElementById('clasificacionFilter').value;
    const tabla = document.getElementById('documentosTable');
    const filas = tabla.getElementsByTagName('tr');

    for (let i = 1; i < filas.length; i++) {
        const fila = filas[i];
        const texto = fila.textContent.toLowerCase();
        const nombreArchivo = fila.cells[2].textContent.toLowerCase();
        const clasificacionDoc = fila.cells[11].textContent.toLowerCase();

        const cumpleBusqueda = searchTerm === '' || texto.includes(searchTerm);
        const cumpleTipo = tipo === '' || nombreArchivo.endsWith(tipo);
        const cumpleClasificacion = clasificacion === '' || 
                                  clasificacionDoc === clasificacion.toLowerCase();

        if (cumpleBusqueda && cumpleTipo && cumpleClasificacion) {
            fila.style.display = '';
        } else {
            fila.style.display = 'none';
        }
    }
}

const style = document.createElement('style');
style.textContent = `
    .filter-section {
        margin: 20px 0;
        padding: 15px;
        background-color: #f5f5f5;
        border-radius: 8px;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        display: flex;
        gap: 15px;
        align-items: center;
    }

    .filter-section input[type="text"] {
        padding: 8px;
        border-radius: 4px;
        border: 1px solid #ddd;
        width: 300px;
        font-size: 14px;
    }

    .filter-section input[type="text"]:focus {
        outline: none;
        border-color: #4CAF50;
    }

    .filter-section select {
        padding: 8px;
        border-radius: 4px;
        border: 1px solid #ddd;
        width: 200px;
        font-size: 14px;
    }

    .filter-section select:focus {
        outline: none;
        border-color: #4CAF50;
    }
`;
document.head.appendChild(style);
</script>
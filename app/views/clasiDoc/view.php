<!-- Modificación del HTML para aplicar las nuevas clases -->
<div class="container">
    <div class="filter-section">
        <div class="search-box">
            <input type="text"
                id="searchInput"
                placeholder=""
                oninput="aplicarFiltros()">
            <span class="placeholder-icon"><i class="fas fa-search"></i></span>
        </div>

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
        <?php if (isset($clasiDocs) && is_array($clasiDocs)): ?>
            <div class="table-container">
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
                            <th>Proceso</th> <!-- Nueva columna -->
                            <th>Subproceso</th> <!-- Nueva columna -->
                            <th>Última Revisión</th>
                            <th>Clasificación</th>
                            <th>Fecha Subido</th>
                            <th>Aprobación</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($clasiDocs as $clasiDoc): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($clasiDoc->idDocumento ?? ''); ?></td>
                                <td><?php echo htmlspecialchars($clasiDoc->idUsuarioCreador ?? ''); ?></td>
                                <td><?php echo htmlspecialchars($clasiDoc->codigo ?? ''); ?></td>
                                <td><?php echo htmlspecialchars($clasiDoc->version ?? ''); ?></td>
                                <td><?php echo htmlspecialchars($clasiDoc->titulo ?? ''); ?></td>
                                <td><?php echo htmlspecialchars($clasiDoc->idUsuarioElaboro ?? ''); ?></td>
                                <td><?php echo htmlspecialchars($clasiDoc->revisado_por ?? ''); ?></td>
                                <td><?php echo htmlspecialchars($clasiDoc->idUsuarioAprobo ?? ''); ?></td>
                                <td><?php echo htmlspecialchars($clasiDoc->proceso ?? ''); ?></td> <!-- Nueva celda -->
                                <td><?php echo htmlspecialchars($clasiDoc->subproceso ?? ''); ?></td> <!-- Nueva celda -->
                                <td><?php echo htmlspecialchars($clasiDoc->fechaEdicion ?? ''); ?></td>
                                <td><?php echo htmlspecialchars($clasiDoc->idCategoria ?? ''); ?></td>
                                <td><?php echo htmlspecialchars($clasiDoc->fechaCreacion ?? ''); ?></td>
                                <td><?php echo htmlspecialchars($clasiDoc->estado ?? ''); ?></td>
                                <td>
                                    <a href="<?php echo '/clasiDoc/edit/' . $clasiDoc->idDocumento; ?>" class="btn-edit" title="Editar documento">
                                        <i class="fas fa-edit"></i> Editar
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php else: ?>
            <div class="message">
                <p>No hay clasificaciones disponibles. <a href="/clasiDoc/new">Crear nueva</a></p>
            </div>
        <?php endif; ?>
    </div>
</div>

<script>
    // Script mejorado para la funcionalidad de la tabla
    function aplicarFiltros() {
        const searchTerm = document.getElementById('searchInput').value.toLowerCase();
        const tipo = document.getElementById('tipoDocumento').value;
        const clasificacion = document.getElementById('clasificacionFilter').value;
        const tabla = document.getElementById('documentosTable');

        if (!tabla) return;

        const filas = tabla.getElementsByTagName('tr');
        let resultados = 0;

        // Agregar clase de animación al realizar filtro
        tabla.classList.add('filtering');

        for (let i = 1; i < filas.length; i++) {
            const fila = filas[i];
            const texto = fila.textContent.toLowerCase();
            const nombreArchivo = fila.cells[2] ? fila.cells[2].textContent.toLowerCase() : '';
            const clasificacionDoc = fila.cells[11] ? fila.cells[11].textContent.toLowerCase() : '';

            const cumpleBusqueda = searchTerm === '' || texto.includes(searchTerm);
            const cumpleTipo = tipo === '' || nombreArchivo.endsWith(tipo);
            const cumpleClasificacion = clasificacion === '' ||
                clasificacionDoc === clasificacion.toLowerCase();

            if (cumpleBusqueda && cumpleTipo && cumpleClasificacion) {
                fila.style.display = '';
                // Añadir un pequeño retraso para la animación de entrada
                setTimeout(() => {
                    fila.style.opacity = '1';
                    fila.style.transform = 'translateY(0)';
                }, i * 30);
                resultados++;
            } else {
                fila.style.display = 'none';
                fila.style.opacity = '0';
                fila.style.transform = 'translateY(10px)';
            }
        }

        // Quitar clase de animación después del filtrado
        setTimeout(() => {
            tabla.classList.remove('filtering');
        }, 300);

        // Mostrar mensaje cuando no hay resultados
        const mensajeNoResultados = document.getElementById('noResultados');
        if (resultados === 0) {
            if (!mensajeNoResultados) {
                const mensaje = document.createElement('div');
                mensaje.id = 'noResultados';
                mensaje.className = 'message';
                mensaje.innerHTML = '<p>No se encontraron documentos con los criterios seleccionados.</p>';
                tabla.parentNode.appendChild(mensaje);
            }
        } else if (mensajeNoResultados) {
            mensajeNoResultados.remove();
        }
    }

    // Agregar estilos adicionales dinámicamente
    const style = document.createElement('style');
    style.textContent = `
    .search-box {
        position: relative;
        display: inline-block;  
    }

    .placeholder-icon {
        position: absolute;
        left: 10px;
        top: 50%;
        transform: translateY(-50%);
        pointer-events: none;
        font-size: 14px;
        display: flex;
        align-items: center;
    }

    /* Ocultar el placeholder cuando el usuario escribe */
    .search-box input:focus + .placeholder-icon,
    .search-box input:not(:placeholder-shown) + .placeholder-icon {
        display: none;
    }
        
    /* Mejora de animaciones y transiciones */
    .data-table tbody tr {
        opacity: 1;
        transform: translateY(0);
        transition: opacity 0.3s ease, transform 0.3s ease, background-color 0.3s ease;
    }
    
    .data-table.filtering tbody tr {
        opacity: 0;
        transform: translateY(10px);
    }
    
    /* Estilos para el mensaje de no resultados */
    #noResultados {
        margin-top: 20px;
        padding: 15px;
        text-align: center;
        background-color: #f8f9fa;
        border-radius: 8px;
        box-shadow: 0 2px 4px rgba(0,0,0,0.05);
        animation: fadeIn 0.3s ease-in-out;
    }
    
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(-10px); }
        to { opacity: 1; transform: translateY(0); }
    }
    
    /* Mejora de los controles de filtro */
    .filter-section {
        transition: box-shadow 0.3s ease;
    }
    
    .filter-section:focus-within {
        box-shadow: 0 4px 12px rgba(0,0,0,0.08);
    }
    
    /* Indicador de filtrado activo */
    .filter-section input:not(:placeholder-shown),
    .filter-section select:not([value=""]) {
    }
    
    /* Mejora de responsividad */
    @media (max-width: 768px) {
        .filter-section {
            flex-direction: column;
            align-items: stretch;
        }
        
        .filter-section input,
        .filter-section select {
            width: 100%;
        }
    }
`;
    document.head.appendChild(style);

    // Inicializar tooltips para los botones de acción
    document.addEventListener('DOMContentLoaded', function() {
        // Detectar scroll horizontal en la tabla
        const tableContainer = document.querySelector('.padt');
        if (tableContainer) {
            tableContainer.addEventListener('scroll', function() {
                if (this.scrollLeft > 0) {
                    this.classList.add('scrolled');
                } else {
                    this.classList.remove('scrolled');
                }
            });
        }

        // Añadir indicadores de ordenación a las columnas
        const headers = document.querySelectorAll('.data-table th');
        headers.forEach(header => {
            header.addEventListener('click', function() {
                // Aquí se podría implementar la ordenación
                headers.forEach(h => h.classList.remove('sorted-asc', 'sorted-desc'));
                if (this.classList.contains('sorted-asc')) {
                    this.classList.remove('sorted-asc');
                    this.classList.add('sorted-desc');
                } else {
                    this.classList.remove('sorted-desc');
                    this.classList.add('sorted-asc');
                }
            });
        });
    });
</script>
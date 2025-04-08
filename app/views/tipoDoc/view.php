<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $titulo ?></title>
    <link rel="stylesheet" href="/css/doc_layout.css">
    <link rel="stylesheet" href="/css/reset.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>

<body>
    <div class="data-container">
        <div class="doc-container">
            <main class="doc-main">
                <header class="doc-top-header">
                    <div class="back">
                        <a href="/main"><img src="/img/back.svg"></a>
                    </div>
                    <h1><?php echo $titulo; ?></h1>
                    <div class="doc-actions">
                        <div class="doc-search">
                            <input type="text" id="searchInput" placeholder="Buscar documentos...">
                            <i class="fas fa-search"></i>
                        </div>
                    </div>
                </header>
                <div class="priv">
                    <a href="/clasiDoc/view" class="doc-content" data-search-term="Documentos de Texto">
                        <h2>Manual del sistema de gestion documental</h2>
                    </a>
                    <a href="../clasiDoc/view" class="doc-content" data-search-term="Imagenes">
                        <h2>Caracterizacion proceso de gestion de I+D+i</h2>
                    </a>
                    <a href="../clasiDoc/view" class="doc-content" data-search-term="Datos numéricos">
                        <h2>Guia para gestion documental</h2>
                    </a>
                    <a href="../clasiDoc/view" class="doc-content" data-search-term="Datos numéricos">
                        <h2>Guia para la gestion de riesgos en proyectos I+D+i</h2>
                    </a>
                    <a href="../clasiDoc/view" class="doc-content" data-search-term="Datos numéricos">
                        <h2>Guia de desarrollo de la creatividad</h2>
                    </a>
                    <a href="../clasiDoc/view" class="doc-content" data-search-term="Datos numéricos">
                        <h2>Guia de Formulacion de proyectos de I+D+i</h2>
                    </a>
                    <a href="../clasiDoc/view" class="doc-content" data-search-term="Datos numéricos">
                        <h2>Procedimineto gestion proyectos I+D+i</h2>
                    </a>
                    
                </div>
                <div class="info">
                    <?php if (isset($tiposDocs) && is_array($tiposDocs)): ?>
                        <table class="data-table">
                            <tbody>
                                <?php foreach ($tiposDocs as $tipoDoc): ?>
                                    <tr>
                                        <td><?php echo $tipoDoc->id_tipo_doc; ?></td>
                                        <td><?php echo $tipoDoc->nombre; ?></td>
                                        <td><?php echo $tipoDoc->descripcion; ?></td>
                                        <td class="actions">
                                            <a href="/tipoDoc/view/<?php echo $tipoDoc->id_tipo_doc; ?>" class="btn-view" title="Ver">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="/tipoDoc/edit/<?php echo $tipoDoc->id_tipo_doc; ?>" class="btn-edit" title="Editar">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <a href="/tipoDoc/delete/<?php echo $tipoDoc->id_tipo_doc; ?>" class="btn-delete" title="Eliminar" 
                                               onclick="return confirm('¿Está seguro de eliminar este registro?')">
                                                <i class="fas fa-trash-alt"></i>
                                            </a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    <?php else: ?>
                        <div class="message">
                            <p>No hay tipos de documentos disponibles. <a href="/tipoDoc/new">Crear nuevo</a></p>
                        </div>
                    <?php endif; ?>
                </div>
            </main>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const searchInput = document.getElementById('searchInput');
            const dataTable = document.querySelector('.data-table');
            const documentCards = dataTable.querySelectorAll('tbody tr');

            searchInput.addEventListener('input', function() {
                const searchTerm = this.value.toLowerCase().trim();

                documentCards.forEach(card => {
                    const cardText = card.textContent.toLowerCase();

                    if (searchTerm === '' || cardText.includes(searchTerm)) {
                        card.style.display = 'table-row';
                    } else {
                        card.style.display = 'none';
                    }
                });
            });
        });
    </script>
</body>

</html>
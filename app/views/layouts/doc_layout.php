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
    <div class="doc-container">
        <main class="doc-main">
            <header class="doc-top-header">
                <h1><?php echo $titulo; ?></h1>
                <div class="doc-actions">
                    <div class="doc-search">
                        <input type="text" id="searchInput" placeholder="Buscar documentos...">
                        <i class="fas fa-search"></i>
                    </div>
                </div>
            </header>
            
            <div class="priv" id="documentGrid">
                <a href="/clasiDoc/view" class="doc-content" data-search-term="Documentos de Texto">
                    <h2>Documentos de Texto</h2>
                </a>
                <a href="../clasiDoc/view" class="doc-content" data-search-term="Imagenes">
                    <h2>Imagenes</h2>
                </a>
                <a href="../clasiDoc/view" class="doc-content" data-search-term="Datos numéricos">
                    <h2>Datos numéricos</h2>
                </a>
                <a href="../clasiDoc/view" class="doc-content" data-search-term="Archivos multimedia">
                    <h2>Archivos multimedia</h2>
                </a>
                <a href="../clasiDoc/view" class="doc-content" data-search-term="Contratos">
                    <h2>Contratos</h2>
                </a>
                <a href="../clasiDoc/view" class="doc-content" data-search-term="Certificados">
                    <h2>Certificados</h2>
                </a>
                <a href="../clasiDoc/view" class="doc-content" data-search-term="Registros de actividad">
                    <h2>Registros de actividad</h2>
                </a>
                <a href="/clasiDoc/view" class="doc-content" data-search-term="Informes">
                    <h2>Informes</h2>
                </a>
                <a href="../clasiDoc/view" class="doc-content" data-search-term="Investigaciones y estudios">
                    <h2>Investigaciones y estudios</h2>
                </a>
                <a href="../clasiDoc/view" class="doc-content" data-search-term="Anexos">
                    <h2>Anexos</h2>
                </a>
                <a href="../clasiDoc/view" class="doc-content" data-search-term="Documentos">
                    <h2>Documentos</h2>
                </a>
                <a href="../clasiDoc/view" class="doc-content" data-search-term="Formularios">
                    <h2>Formularios</h2>
                </a>
                <a href="../clasiDoc/view" class="doc-content" data-search-term="Propuestas">
                    <h2>Propuestas</h2>
                </a>
                <a href="../clasiDoc/view" class="doc-content" data-search-term="Correspondencia">
                    <h2>Correspondencia</h2>
                </a>
                <a href="../clasiDoc/view" class="doc-content" data-search-term="Licencias">
                    <h2>Licencias</h2>
                </a>
                <a href="../clasiDoc/view" class="doc-content" data-search-term="Estudios de mercado">
                    <h2>Estudios de mercado</h2>
                </a>
            </div>
        </main>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const searchInput = document.getElementById('searchInput');
            const documentGrid = document.getElementById('documentGrid');
            const documentCards = documentGrid.querySelectorAll('.doc-content');

            searchInput.addEventListener('input', function() {
                const searchTerm = this.value.toLowerCase().trim();

                documentCards.forEach(card => {
                    const cardText = card.getAttribute('data-search-term').toLowerCase();
                    
                    if (searchTerm === '' || cardText.includes(searchTerm)) {
                        card.style.display = 'block';
                    } else {
                        card.style.display = 'none';
                    }
                });

                // If no results, show a message
                const visibleCards = Array.from(documentCards).filter(card => card.style.display !== 'none');
                
                // Remove existing no results message
                const existingNoResultsMessage = document.getElementById('no-results-message');
                if (existingNoResultsMessage) {
                    existingNoResultsMessage.remove();
                }

                if (visibleCards.length === 0 && searchTerm !== '') {
                    const noResultsMessage = document.createElement('div');
                    noResultsMessage.id = 'no-results-message';
                    noResultsMessage.className = 'doc-content';
                    noResultsMessage.innerHTML = `<h2>No se encontraron resultados para "${searchTerm}"</h2>`;
                    documentGrid.appendChild(noResultsMessage);
                }
            });
        });
    </script>
</body>
</html>
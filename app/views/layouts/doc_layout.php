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
        <!-- Barra lateral -->
        <aside class="doc-sidebar">
            <div class="doc-header">
                <a href="/" class="doc-logo">SENNOVALAB</a>
                <button class="doc-toggle" id="docToggle">
                    <i class="fas fa-bars"></i>
                </button>
            </div>
            <nav class="doc-nav">
                <a href="/tipoDoc/new" class="doc-nav-item">
                    <i class="fas fa-plus"></i> Nuevo Documento
                </a>
                <a href="/proyecto/view" class="doc-nav-item">
                    <i class="fas fa-home"></i> Volver al Inicio
                </a>
            </nav>
        </aside>

        <!-- Contenido principal -->
        <main class="doc-main">
            <header class="doc-top-header">
                <h1><?php echo $titulo; ?></h1>
                <div class="doc-actions">
                    <div class="doc-search">
                        <input type="text" placeholder="Buscar documentos...">
                        <i class="fas fa-search"></i>
                    </div>
                </div>
            </header>
            
            <div class="priv"> 
            <a href="/clasiDoc/view">
            <div class="doc-content">
             <h2>Documentos de Gestión</h2>
            </div>
            </a>
            <a href="../clasiDoc/view">
            <div class="doc-content">
             <h2>Documentos Administrativos</h2>
            </div>
            </a>
            <a href="../clasiDoc/view">
            <div class="doc-content">
             <h2>Documentos Personales</h2>
            </div>
            </a>
            <a href="../clasiDoc/view">
            <div class="doc-content">
             <h2>Documentos Financieros</h2>
            </div>
            </a>
            <a href="../clasiDoc/view">
            <div class="doc-content">
             <h2>Documentos Legales</h2>
            </div>
            </a>
            <a href="../clasiDoc/view">
            <div class="doc-content">
             <h2>Documentos Técnicos</h2>
            </div>
            </a>
            <a href="../clasiDoc/view">
            <div class="doc-content">
             <h2>Documentos de Calidad</h2>
            </div>
            </a>
            <a href="/clasiDoc/view">
            <div class="doc-content">
             <h2>Documentos de Metrologia</h2>
            </div>
            </a>
            <a href="../clasiDoc/view">
            <div class="doc-content">
             <h2>Documentos de Proyectos</h2>
            </div>
            </a>
            <a href="../clasiDoc/view">
            <div class="doc-content">
             <h2>Documentos de Marketing</h2>
            </div>
            </a>
            </div>

        </main>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const docToggle = document.getElementById('docToggle');
            const docContainer = document.querySelector('.doc-container');
            
            docToggle.addEventListener('click', function() {
                docContainer.classList.toggle('sidebar-collapsed');
            });
        });
    </script>
</body>
</html>
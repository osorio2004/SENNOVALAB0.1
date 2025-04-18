<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $titulo ?? 'Clasificación de Documentos'; ?></title>
    <link rel="stylesheet" href="/css/classification_layout.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>

<body>
    <div class="container">
        <main class="main-content">
            <header class="top-header">
                <div class="header-flex">
                    <div class="back">
                        <a href="/tipoDoc/view"><img src="/img/back.svg"></a>
                    </div>
                    <h1><?php echo $titulo ?? 'Clasificación de Documentos'; ?></h1>
                    <a href="/clasiDoc/new" class="btn-add">
                        <i class="mas">+</i>
                    </a>
                </div>
            </header>
            <?php include_once $content; ?>
        </main>
    </div>
    <script src="/js/document-management.js" defer></script>
</body>

</html>
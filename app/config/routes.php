<?php
return [
    // Rutas de Login
    "/login/init" => [
        "controller" => "App\Controllers\LoginController",
        "action" => "initLogin"
    ],
    "/login/logout" => [
        "controller" => "App\Controllers\LoginController",
        "action" => "logoutLogin"
    ],

    // Rutas de Categoría de Documentos
    "/categoriadocumento/view" => [
        "controller" => "App\Controllers\CategoriaDocumentoController",
        "action" => "view"
    ],
    "/categoriadocumento/new" => [
        "controller" => "App\Controllers\CategoriaDocumentoController",
        "action" => "new"
    ],
    "/categoriadocumento/create" => [
        "controller" => "App\Controllers\CategoriaDocumentoController",
        "action" => "create"
    ],
    "/categoriadocumento/edit/(\d+)" => [
        "controller" => "App\Controllers\CategoriaDocumentoController",
        "action" => "edit"
    ],
    "/categoriadocumento/update" => [
        "controller" => "App\Controllers\CategoriaDocumentoController",
        "action" => "update"
    ],
    "/categoriadocumento/delete/(\d+)" => [
        "controller" => "App\Controllers\CategoriaDocumentoController",
        "action" => "delete"
    ],
    "/categoriadocumento/remove" => [
        "controller" => "App\Controllers\CategoriaDocumentoController",
        "action" => "remove"
    ],

    // Rutas de Documentos
    "/documento/view" => [
        "controller" => "App\Controllers\DocumentosController",
        "action" => "view"
    ],
    "/documento/new" => [
        "controller" => "App\Controllers\DocumentosController",
        "action" => "new"
    ],
    "/documento/create" => [
        "controller" => "App\Controllers\DocumentosController",
        "action" => "create"
    ],
    "/documento/edit/(\d+)" => [
        "controller" => "App\Controllers\DocumentosController",
        "action" => "edit"
    ],
    "/documento/update" => [
        "controller" => "App\Controllers\DocumentosController",
        "action" => "update"
    ],
    "/documento/delete/(\d+)" => [
        "controller" => "App\Controllers\DocumentosController",
        "action" => "delete"
    ],
    "/documento/remove" => [
        "controller" => "App\Controllers\DocumentosController",
        "action" => "remove"
    ],

    // Rutas de Usuarios
    "/usuario/view" => [
        "controller" => "App\Controllers\UsuarioController",
        "action" => "view"
    ],
    "/usuario/view/(\d+)" => [
        "controller" => "App\Controllers\UsuarioController",
        "action" => "viewOne"
    ],
    "/usuario/new" => [
        "controller" => "App\Controllers\UsuarioController",
        "action" => "new"
    ],
    "/usuario/create" => [
        "controller" => "App\Controllers\UsuarioController",
        "action" => "create"
    ],
    "/usuario/edit/(\d+)" => [
        "controller" => "App\Controllers\UsuarioController",
        "action" => "edit"
    ],
    "/usuario/update" => [
        "controller" => "App\Controllers\UsuarioController",
        "action" => "update"
    ],
    "/usuario/delete/(\d+)" => [
        "controller" => "App\Controllers\UsuarioController",
        "action" => "delete"
    ],
    "/usuario/remove" => [
        "controller" => "App\Controllers\UsuarioController",
        "action" => "remove"
    ],

    //Rutas tipoDoc
    '/tipoDoc/index' => [
        "controller" => 'App\Controllers\TipoDocController',
        "action" => 'index'
    ],
    '/tipoDoc/view' => [
        "controller" => 'App\Controllers\TipoDocController',
        "action" => 'view'
    ],
    '/tipoDoc/new' => [
        "controller" => 'App\Controllers\TipoDocUseController',
        "action" => 'new'
    ],
    '/tipoDoc/create' => [
        "controller" => 'App\Controllers\TipoDocUseController',
        "action" => 'create'
    ],
    '/tipoDoc/view/(\d+)' => [
        "controller" => 'App\Controllers\TipoDocUseController',
        "action" => 'viewOne'
    ],
    '/tipoDoc/edit/(\d+)' => [
        "controller" => 'App\Controllers\TipoDocUseController',
        "action" => 'edit'
    ],
    '/tipoDoc/update' => [
        "controller" => 'App\Controllers\TipoDocUseController',
        "action" => 'update'
    ],
    '/tipoDoc/delete/(\d+)' => [
        "controller" => 'App\Controllers\TipoDocUseController',
        "action" => 'delete'
    ],

    //ClasiDoc
    '/clasiDoc/index' => [
        "controller" => 'App\Controllers\ClasiDocController',
        "action" => 'index'
    ],
    '/clasiDoc/view' => [
        "controller" => 'App\Controllers\ClasiDocController',
        "action" => 'view'
    ],
    '/clasiDoc/new' => [
        "controller" => 'App\Controllers\ClasiDocController',
        "action" => 'new'
    ],
    '/clasiDoc/create' => [
        "controller" => 'App\Controllers\ClasiDocController',
        "action" => 'create'
    ],
    '/clasiDoc/view/(\d+)' => [
        "controller" => 'App\Controllers\ClasiDocController',
        "action" => 'viewOne'
    ],
    '/clasiDoc/edit/(\d+)' => [
        "controller" => 'App\Controllers\ClasiDocController',
        "action" => 'edit',
        "params" => ['id']
    ],
    '/clasiDoc/update' => [
        "controller" => 'App\Controllers\ClasiDocController',
        "action" => 'update'
    ],
    '/clasiDoc/delete/(\d+)' => [
        "controller" => 'App\Controllers\ClasiDocController',
        "action" => 'delete'
    ],

    // Rutas de Procesos
    '/proceso/view' => [
        "controller" => 'App\Controllers\ProcesoController',
        "action" => 'view'
    ],
    '/proceso/new' => [
        "controller" => 'App\Controllers\ProcesoController',
        "action" => 'new'
    ],
    '/proceso/create' => [
        "controller" => 'App\Controllers\ProcesoController',
        "action" => 'create'
    ],
    '/proceso/view/(\d+)' => [
        "controller" => 'App\Controllers\ProcesoController',
        "action" => 'viewOne'
    ],
    '/proceso/edit/(\d+)' => [
        "controller" => 'App\Controllers\ProcesoController',
        "action" => 'edit'
    ],
    '/proceso/update' => [
        "controller" => 'App\Controllers\ProcesoController',
        "action" => 'update'
    ],
    '/proceso/delete/(\d+)' => [
        "controller" => 'App\Controllers\ProcesoController',
        "action" => 'delete'
    ],
    '/proceso/remove' => [
        "controller" => 'App\Controllers\ProcesoController',
        "action" => 'remove'
    ],

    // Rutas de DocumentoFormato
    '/documentoFormato/view' => [
        "controller" => 'App\Controllers\DocumentoFormatoController',
        "action" => 'view'
    ],
    '/documentoFormato/new' => [
        "controller" => 'App\Controllers\DocumentoFormatoController',
        "action" => 'new'
    ],
    '/documentoFormato/create' => [
        "controller" => 'App\Controllers\DocumentoFormatoController',
        "action" => 'create'
    ],
    '/documentoFormato/view/(\d+)' => [
        "controller" => 'App\Controllers\DocumentoFormatoController',
        "action" => 'viewOne'
    ],
    '/documentoFormato/edit/(\d+)' => [
        "controller" => 'App\Controllers\DocumentoFormatoController',
        "action" => 'edit'
    ],
    '/documentoFormato/update' => [
        "controller" => 'App\Controllers\DocumentoFormatoController',
        "action" => 'update'
    ],
    '/documentoFormato/delete/(\d+)' => [
        "controller" => 'App\Controllers\DocumentoFormatoController',
        "action" => 'delete'
    ],
    '/documentoFormato/remove' => [
        "controller" => 'App\Controllers\DocumentoFormatoController',
        "action" => 'remove'
    ],

    // Rutas de Tipo Documental
    "/tipoDocumental/view" => [
        "controller" => "App\Controllers\TipoDocumentalController",
        "action" => "view"
    ],
    "/tipoDocumental/new" => [
        "controller" => "App\Controllers\TipoDocumentalController",
        "action" => "new"
    ],
    "/tipoDocumental/create" => [
        "controller" => "App\Controllers\TipoDocumentalController",
        "action" => "create"
    ],
    "/tipoDocumental/edit/(\d+)" => [
        "controller" => "App\Controllers\TipoDocumentalController",
        "action" => "edit"
    ],
    "/tipoDocumental/update" => [
        "controller" => "App\Controllers\TipoDocumentalController",
        "action" => "update"
    ],
    "/tipoDocumental/delete/(\d+)" => [
        "controller" => "App\Controllers\TipoDocumentalController",
        "action" => "delete"
    ],
    "/tipoDocumental/remove" => [
        "controller" => "App\Controllers\TipoDocumentalController",
        "action" => "remove"
    ],
    "/tipoDocumental/view/(\d+)" => [
        "controller" => "App\Controllers\TipoDocumentalController",
        "action" => "viewOne"
    ],



    // Rutas de la Página Principal
    "/main" => [
        "controller" => "App\Controllers\MainController",
        "action" => "view"
    ],
];

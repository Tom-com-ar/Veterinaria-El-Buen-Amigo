<?php
/**
 * Configuración de componentes PHP
 * Este archivo permite personalizar el comportamiento de los componentes header y sidebar
 */

// Función para incluir el header con configuración personalizada
function include_header($config = []) {
    global $header_config;
    $header_config = $config;
    include __DIR__ . '/header.php';
}

// Función para incluir el sidebar con configuración personalizada
function include_sidebar($config = []) {
    global $sidebar_config;
    $sidebar_config = $config;
    include __DIR__ . '/sidebar.php';
}

// Función para incluir tanto header como sidebar (layout completo)
function include_admin_layout($header_config = [], $sidebar_config = []) {
    include_header($header_config);
    include_sidebar($sidebar_config);
}

// Configuraciones predefinidas para diferentes páginas
$page_configs = [
    'admin_dashboard' => [
        'header' => [
            'title' => 'INICIO',
            'show_search' => false
        ],
        'sidebar' => [
            'current_page' => 'dashboard'
        ]
    ],
    'sucursales' => [
        'header' => [
            'title' => 'SUCURSALES',
            'show_search' => false
        ],
        'sidebar' => [
            'current_page' => 'sucursales'
        ]
    ],
    'veterinarios' => [
        'header' => [
            'title' => 'VETERINARIOS',
            'show_search' => false
        ],
        'sidebar' => [
            'current_page' => 'veterinarios'
        ]
    ],
    'recepcionistas' => [
        'header' => [
            'title' => 'RECEPCIONISTAS',
            'show_search' => false
        ],
        'sidebar' => [
            'current_page' => 'recepcionistas'
        ]
    ],
    'productos' => [
        'header' => [
            'title' => 'PRODUCTOS',
            'show_search' => false
        ],
        'sidebar' => [
            'current_page' => 'productos'
        ]
    ]
];

// Definir submenús para cada sección
$sidebar_submenus = [
    'sucursales' => [
        ['text' => 'Agregar', 'href' => '../../pages/admin/sucursales-agregar.php', 'icon' => 'fas fa-plus'],
        ['text' => 'Modificar', 'href' => '../../pages/admin/sucursales-modificar.php', 'icon' => 'fas fa-edit'],
        ['text' => 'Servicios', 'href' => '../../pages/admin/sucursales-servicios.php', 'icon' => 'fas fa-tools'],
        ['text' => 'Administradores', 'href' => '../../pages/admin/sucursales-administradores.php', 'icon' => 'fas fa-user-shield'],
        ['text' => 'Caja Registradora', 'href' => '../../pages/admin/sucursales-caja.php', 'icon' => 'fas fa-cash-register'],
        ['text' => 'Estadísticas', 'href' => '../../pages/admin/sucursales-estadisticas.php', 'icon' => 'fas fa-chart-line']
    ],
    'veterinarios' => [
        ['text' => 'Agregar', 'href' => '../../pages/admin/veterinarios-agregar.php', 'icon' => 'fas fa-plus'],
        ['text' => 'Modificar', 'href' => '../../pages/admin/veterinarios-modificar.php', 'icon' => 'fas fa-edit']
    ],
    'recepcionistas' => [
        ['text' => 'Agregar', 'href' => '../../pages/admin/recepcionistas-agregar.php', 'icon' => 'fas fa-plus'],
        ['text' => 'Modificar', 'href' => '../../pages/admin/recepcionistas-modificar.php', 'icon' => 'fas fa-edit'],
        ['text' => 'Ver Acciones', 'href' => '../../pages/admin/recepcionistas-acciones.php', 'icon' => 'fas fa-eye']
    ],
    'productos' => [
        ['text' => 'Agregar Producto', 'href' => '../../pages/admin/productos-agregar.php', 'icon' => 'fas fa-plus'],
        ['text' => 'Modificar Producto', 'href' => '../../pages/admin/productos-modificar.php', 'icon' => 'fas fa-edit'],
        ['text' => 'Ajuste de Stock', 'href' => '../../pages/admin/productos-stock.php', 'icon' => 'fas fa-chart-bar'],
        // Los siguientes archivos aún no existen, puedes crearlos después
        ['text' => 'Agregar Proveedor', 'href' => '#', 'icon' => 'fas fa-truck'],
        ['text' => 'Modificar Proveedor', 'href' => '#', 'icon' => 'fas fa-user-edit'],
        ['text' => 'Compras', 'href' => '#', 'icon' => 'fas fa-shopping-cart']
    ]
];

// Función para obtener configuración de página
function get_page_config($page_name) {
    global $page_configs;
    return $page_configs[$page_name] ?? [
        'header' => ['title' => 'ADMINISTRACIÓN'],
        'sidebar' => ['current_page' => '']
    ];
}

// Función para obtener submenús
function get_sidebar_submenus() {
    global $sidebar_submenus;
    return $sidebar_submenus;
}
?>

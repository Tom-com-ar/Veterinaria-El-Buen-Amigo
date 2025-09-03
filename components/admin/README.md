# Componentes PHP - Sistema de Veterinaria El Buen Amigo

Este sistema de componentes permite reutilizar el header y sidebar en todas las páginas de administración del sistema.

## Estructura de Archivos

```
php/
├── components/
│   ├── header.php          # Componente del header
│   ├── sidebar.php         # Componente del sidebar
│   └── layout.php          # Configuraciones y funciones auxiliares
```

## Uso Básico

### 1. Incluir componentes individuales

```php
<?php
// Incluir la configuración
include_once '../../php/components/layout.php';

// Configuración personalizada del header
$header_config = [
    'title' => 'MI PÁGINA',
    'show_search' => true
];

// Configuración personalizada del sidebar
$sidebar_config = [
    'current_page' => 'mi_seccion'
];
?>

<!DOCTYPE html>
<html>
<head>
    <!-- Tu head aquí -->
</head>
<body>
    <?php 
    include_header($header_config);
    include_sidebar($sidebar_config);
    ?>
    
    <!-- Tu contenido aquí -->
</body>
</html>
```

### 2. Usar el layout completo (recomendado)

```php
<?php
include_once '../../php/components/layout.php';

$header_config = ['title' => 'MI PÁGINA'];
$sidebar_config = ['current_page' => 'mi_seccion'];
?>

<!DOCTYPE html>
<html>
<head>
    <!-- Tu head aquí -->
</head>
<body>
    <?php include_admin_layout($header_config, $sidebar_config); ?>
    
    <!-- Tu contenido aquí -->
</body>
</html>
```

### 3. Usar configuraciones predefinidas

```php
<?php
include_once '../../php/components/layout.php';

// Obtener configuración predefinida para sucursales
$config = get_page_config('sucursales');
?>

<!DOCTYPE html>
<html>
<head>
    <!-- Tu head aquí -->
</head>
<body>
    <?php include_admin_layout($config['header'], $config['sidebar']); ?>
    
    <!-- Tu contenido aquí -->
</body>
</html>
```

## Configuraciones Disponibles

### Header
- `title`: Título que aparece en el header
- `show_search`: Mostrar/ocultar barra de búsqueda (true/false)
- `css_path`: Ruta al archivo CSS (opcional)

### Sidebar
- `logo_path`: Ruta al logo (por defecto: '../../assets/Logo 4.png')
- `current_page`: ID de la página actual para resaltar en el menú
- `menu_items`: Array personalizado de elementos del menú

### Páginas Predefinidas

Las siguientes configuraciones están disponibles con `get_page_config()`:

- `admin_dashboard`: Página principal de administración
- `sucursales`: Gestión de sucursales
- `veterinarios`: Gestión de veterinarios
- `recepcionistas`: Gestión de recepcionistas
- `clientes`: Gestión de clientes
- `productos`: Gestión de productos

## Personalización del Menú

Para personalizar los elementos del menú del sidebar:

```php
$sidebar_config = [
    'current_page' => 'mi_seccion',
    'menu_items' => [
        [
            'icon' => 'fas fa-home',
            'text' => 'Mi Sección',
            'href' => '/mi-seccion.php',
            'id' => 'mi_seccion'
        ],
        // ... más elementos
    ]
];
```

## Ejemplo Completo

Consulta los archivos `inicio-admin.php` y `sucursales.php` en la carpeta `pages/admin/` para ver ejemplos completos de implementación.

## Notas Importantes

1. **Rutas**: Asegúrate de ajustar las rutas de los archivos CSS, JS e imágenes según la ubicación de tu archivo PHP.

2. **Servidor Web**: Los archivos PHP requieren un servidor web con soporte PHP (Apache, Nginx, etc.). No funcionarán abriendo directamente el archivo en el navegador.

3. **Estructura**: Mantén la estructura de carpetas para que las rutas relativas funcionen correctamente.

4. **Extensión de archivos**: Cambia la extensión de tus archivos de `.html` a `.php` para que puedan procesar el código PHP.

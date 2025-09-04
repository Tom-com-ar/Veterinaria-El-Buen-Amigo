<?php
// Incluir la configuración de layout
include_once '../../components/admin/layout.php';

// Obtener configuración para la página
$config = get_page_config('productos');
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Producto - El Buen Amigo</title>
    <link href="../../dist/output.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-gray-50 font-sans">
    <?php 
    // Incluir header y sidebar usando la configuración de la página
    include_admin_layout($config['header'], $config['sidebar']); 
    ?>

    <div class="flex min-h-screen">
        <!-- Contenido principal -->
        <main class="flex-1 p-6 ml-64 max-xl:ml-0 mt-30 pt-4">
            <div class="flex gap-6 max-xl:flex-col">
                <!-- Área principal del formulario -->
                <div class="flex-1">
                    <!-- Título -->
                    <h2 class="text-3xl font-light text-black mb-4 max-md:text-2xl">Agregar producto</h2>
                    
                    <!-- Descripción -->
                    <div class="bg-blue-50 border-l-4 border-vet-blue p-4 mb-8">
                        <p class="text-gray-700 text-sm">
                            Registrar un nuevo producto en el inventario. Los campos marcados son obligatorios.
                        </p>
                    </div>

                    <!-- Formulario -->
                    <div class="bg-white rounded-md shadow-md p-8 max-w-4xl">
                        <form id="producto-form" method="POST" action="../../php/procesar-producto.php">
                            <input type="hidden" name="action" value="crear">
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-12">
                                <!-- Código de barras -->
                                <div class="space-y-4">
                                    <label for="codigo_barras" class="block text-sm font-medium text-gray-700">Código de barras:</label>
                                    <input type="text" id="codigo_barras" name="codigo_barras" placeholder="Ej: 7891234567890"
                                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-vet-orange focus:border-transparent">
                                </div>

                                <!-- Nombre -->
                                <div class="space-y-4">
                                    <label for="nombre" class="block text-sm font-medium text-gray-700">Nombre del producto:</label>
                                    <input type="text" id="nombre" name="nombre" placeholder="Ej: Royal Canin Adult"
                                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-vet-orange focus:border-transparent">
                                </div>

                                <!-- Descripción - Span completo -->
                                <div class="md:col-span-2 space-y-4">
                                    <label for="descripcion" class="block text-sm font-medium text-gray-700">Descripción:</label>
                                    <textarea id="descripcion" name="descripcion" rows="3" placeholder="Descripción detallada del producto..."
                                              class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-vet-orange focus:border-transparent"></textarea>
                                </div>

                                <!-- Rubro -->
                                <div class="space-y-4">
                                    <label for="rubro" class="block text-sm font-medium text-gray-700">Rubro:</label>
                                    <select id="rubro" name="rubro"
                                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-vet-orange focus:border-transparent">
                                        <option value="">-- Seleccionar rubro --</option>
                                        <option value="comida">Comida</option>
                                        <option value="juguetes">Juguetes</option>
                                        <option value="muebles">Muebles</option>
                                        <option value="remedios">Remedios</option>
                                        <option value="accesorios">Accesorios</option>
                                        <option value="higiene">Higiene</option>
                                        <option value="vacunas">Vacunas</option>
                                    </select>
                                </div>

                                <!-- Stock mínimo -->
                                <div class="space-y-4">
                                    <label for="stock_minimo" class="block text-sm font-medium text-gray-700">Stock mínimo:</label>
                                    <input type="number" id="stock_minimo" name="stock_minimo" min="0" value="0" placeholder="Ej: 10"
                                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-vet-orange focus:border-transparent">
                                </div>

                                <!-- Precio costo -->
                                <div class="space-y-4">
                                    <label for="precio_costo" class="block text-sm font-medium text-gray-700">Precio de costo ($):</label>
                                    <input type="number" id="precio_costo" name="precio_costo" step="0.01" min="0" value="0" placeholder="Ej: 1500.00"
                                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-vet-orange focus:border-transparent">
                                </div>

                                <!-- Precio venta -->
                                <div class="space-y-4">
                                    <label for="precio_venta" class="block text-sm font-medium text-gray-700">Precio de venta ($):</label>
                                    <input type="number" id="precio_venta" name="precio_venta" step="0.01" min="0" placeholder="Ej: 2500.00"
                                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-vet-orange focus:border-transparent">
                                </div>

                                <!-- Proveedor principal -->
                                <div class="space-y-4">
                                    <label for="id_proveedor_principal" class="block text-sm font-medium text-gray-700">Proveedor principal:</label>
                                    <select id="id_proveedor_principal" name="id_proveedor_principal"
                                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-vet-orange focus:border-transparent">
                                        <option value="">-- Seleccionar proveedor --</option>
                                        <option value="1">Proveedor A</option>
                                        <option value="2">Proveedor B</option>
                                        <option value="3">Proveedor C</option>
                                    </select>
                                </div>

                                <!-- Sucursal -->
                                <div class="space-y-4">
                                    <label for="id_sucursal" class="block text-sm font-medium text-gray-700">Sucursal:</label>
                                    <select id="id_sucursal" name="id_sucursal"
                                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-vet-orange focus:border-transparent">
                                        <option value="">-- Seleccionar sucursal --</option>
                                        <option value="1">Sucursal Centro</option>
                                        <option value="2">Sucursal Norte</option>
                                        <option value="3">Sucursal Sur</option>
                                    </select>
                                </div>
                            </div>

                            <!-- Botones - Fuera del grid pero visibles -->
                            <div class="flex space-x-4 pt-8 mt-8 border-t border-gray-200" style="margin-top: 2rem !important;">
                                <button type="button" onclick="limpiarFormulario()"
                                        class="px-6 py-2 bg-red-500 text-white rounded-md hover:bg-red-600 transition-colors" style="display: inline-block !important;">
                                    Borrar formulario
                                </button>
                                <button type="submit"
                                        class="px-6 py-2 bg-green-500 text-white rounded-md hover:bg-green-600 transition-colors" style="display: inline-block !important;">
                                    Agregar producto
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
    </div>

    <script>
        // Función para limpiar el formulario
        function limpiarFormulario() {
            document.getElementById('producto-form').reset();
        }
    </script>
</body>
    <script src="../../js/admin/admin-dashboard.js"></script>
</html>

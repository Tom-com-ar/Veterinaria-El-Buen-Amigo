<?php
// Incluir la configuración de layout
include_once '../../components/admin/layout.php';

// Obtener configuración para la página
$config = get_page_config('sucursales');
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Servicio - El Buen Amigo</title>
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
                    <h2 class="text-3xl font-light text-black mb-4 max-md:text-2xl">Agregar servicio</h2>
                    
                    <!-- Descripción -->
                    <div class="bg-blue-50 border-l-4 border-vet-blue p-4 mb-8">
                        <p class="text-gray-700 text-sm">
                            Registrar un nuevo servicio disponible en la veterinaria. Los servicios pueden ser asignados posteriormente a diferentes veterinarios.
                        </p>
                    </div>

                    <!-- Formulario -->
                    <div class="bg-white rounded-md shadow-md p-8 max-w-4xl">
                        <form id="servicio-form" method="POST" action="../../php/procesar-servicio.php">
                            <input type="hidden" name="action" value="crear">
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-12">
                                <!-- Nombre del servicio -->
                                <div class="space-y-4">
                                    <label for="nombre" class="block text-sm font-medium text-gray-700">Nombre del servicio:</label>
                                    <input type="text" id="nombre" name="nombre" placeholder="Ej: Consulta General"
                                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-vet-orange focus:border-transparent">
                                </div>

                                <!-- Duración en minutos -->
                                <div class="space-y-4">
                                    <label for="duracion_min" class="block text-sm font-medium text-gray-700">Duración (minutos):</label>
                                    <input type="number" id="duracion_min" name="duracion_min" min="5" step="5" value="30" placeholder="Ej: 30"
                                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-vet-orange focus:border-transparent">
                                </div>

                                <!-- Precio -->
                                <div class="space-y-4">
                                    <label for="precio" class="block text-sm font-medium text-gray-700">Precio ($):</label>
                                    <input type="number" id="precio" name="precio" step="0.01" min="0" placeholder="Ej: 2500.00"
                                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-vet-orange focus:border-transparent">
                                </div>

                                <!-- Estado activo -->
                                <div class="space-y-4">
                                    <label class="block text-sm font-medium text-gray-700">Estado:</label>
                                    <div class="flex items-center">
                                        <input type="checkbox" id="activo" name="activo" value="1" checked
                                               class="rounded border-gray-300 text-vet-orange focus:ring-vet-orange">
                                        <label for="activo" class="ml-2 text-sm text-gray-700">Servicio activo</label>
                                    </div>
                                </div>

                                <!-- Descripción - Span completo -->
                                <div class="md:col-span-2 space-y-4">
                                    <label for="descripcion" class="block text-sm font-medium text-gray-700">Descripción del servicio:</label>
                                    <textarea id="descripcion" name="descripcion" rows="4" placeholder="Descripción detallada del servicio que se ofrece..."
                                              class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-vet-orange focus:border-transparent"></textarea>
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
                                    Agregar servicio
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </main>            
    <script>
        // Función para limpiar el formulario
        function limpiarFormulario() {
            document.getElementById('servicio-form').reset();
        }
    </script>
</body>
    <script src="../../js/admin/admin-dashboard.js"></script>
</html>

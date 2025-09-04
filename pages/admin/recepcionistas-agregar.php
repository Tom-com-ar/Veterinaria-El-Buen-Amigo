<?php
// Incluir la configuración de layout
include_once '../../components/admin/layout.php';

// Obtener configuración para la página
$config = get_page_config('recepcionistas');
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Recepcionista - El Buen Amigo</title>
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
                    <h2 class="text-3xl font-light text-black mb-4 max-md:text-2xl">Agregar recepcionista</h2>
                    
                    <!-- Descripción -->
                    <div class="bg-blue-50 border-l-4 border-vet-blue p-4 mb-8">
                        <p class="text-gray-700 text-sm">
                            Registrar una nueva recepcionista en el sistema. La recepcionista podrá acceder con el email y contraseña proporcionados.
                        </p>
                    </div>

                    <!-- Formulario -->
                    <div class="bg-white rounded-md shadow-md p-8 max-w-4xl">
                        <form id="recepcionista-form" method="POST" action="../../php/procesar-recepcionista.php">
                            <input type="hidden" name="action" value="crear">
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-12">
                                <!-- Nombre -->
                                <div class="space-y-4">
                                    <label for="nombre" class="block text-sm font-medium text-gray-700">Nombre:</label>
                                    <input type="text" id="nombre" name="nombre" placeholder="Ej: María"
                                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-vet-orange focus:border-transparent">
                                </div>

                                <!-- Apellido -->
                                <div class="space-y-4">
                                    <label for="apellido" class="block text-sm font-medium text-gray-700">Apellido:</label>
                                    <input type="text" id="apellido" name="apellido" placeholder="Ej: García"
                                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-vet-orange focus:border-transparent">
                                </div>

                                <!-- Email -->
                                <div class="space-y-4">
                                    <label for="email" class="block text-sm font-medium text-gray-700">Email:</label>
                                    <input type="email" id="email" name="email" placeholder="Ej: maria.garcia@veterinaria.com"
                                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-vet-orange focus:border-transparent">
                                </div>

                                <!-- Contraseña -->
                                <div class="space-y-4">
                                    <label for="hash_pass" class="block text-sm font-medium text-gray-700">Contraseña temporal:</label>
                                    <input type="password" id="hash_pass" name="hash_pass" placeholder="Contraseña inicial"
                                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-vet-orange focus:border-transparent">
                                </div>

                                <!-- Teléfono -->
                                <div class="space-y-4">
                                    <label for="telefono" class="block text-sm font-medium text-gray-700">Teléfono:</label>
                                    <input type="tel" id="telefono" name="telefono" placeholder="Ej: +54 11 1234-5678"
                                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-vet-orange focus:border-transparent">
                                </div>

                                <!-- Sucursal -->
                                <div class="space-y-4">
                                    <label for="id_sucursal" class="block text-sm font-medium text-gray-700">Sucursal asignada:</label>
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
                                    Agregar recepcionista
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <script>
        // Función para limpiar el formulario
        function limpiarFormulario() {
            document.getElementById('recepcionista-form').reset();
        }
    </script>
</body>
    <script src="../../js/admin/admin-dashboard.js"></script>
</html>

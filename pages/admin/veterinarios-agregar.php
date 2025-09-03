<?php
// Incluir la configuración de layout
include_once '../../components/admin/layout.php';

// Obtener configuración para la página
$config = get_page_config('veterinarios');
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Veterinario - El Buen Amigo</title>
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
                    <h2 class="text-3xl font-light text-black mb-4 max-md:text-2xl">Agregar veterinario</h2>
                    
                    <!-- Descripción -->
                    <div class="bg-blue-50 border-l-4 border-vet-blue p-4 mb-8">
                        <p class="text-gray-700 text-sm">
                            Registrar un nuevo veterinario en el sistema. Recuerda que el veterinario podrá acceder con el email y contraseña proporcionados.
                        </p>
                    </div>

                    <!-- Formulario -->
                    <div class="bg-white rounded-md shadow-md p-8 max-w-4xl">
                        <form id="veterinario-form" method="POST" action="../../php/procesar-veterinario.php" enctype="multipart/form-data">
                            <input type="hidden" name="action" value="crear">
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-12">
                                <!-- Foto del veterinario - Span completo -->
                                <div class="md:col-span-2 space-y-4 mb-4">
                                    <label class="block text-sm font-medium text-gray-700">Foto del veterinario:</label>
                                    <div class="flex items-start space-x-8">
                                        <div class="flex-1">
                                            <input type="file" id="url_foto" name="url_foto" accept="image/*" 
                                                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-vet-orange focus:border-transparent">
                                        </div>
                                        <div class="flex-shrink-0">
                                            <div id="preview-container" class="w-48 h-48 border-2 border-dashed border-gray-300 rounded-lg flex items-center justify-center bg-gray-50">
                                                <img id="preview-image" src="" alt="Vista previa" class="w-full h-full object-cover rounded-lg hidden">
                                                <div id="preview-placeholder" class="text-center text-gray-400">
                                                    <i class="fas fa-user-md text-4xl mb-3"></i>
                                                    <p class="text-sm">Vista previa</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Nombre -->
                                <div class="space-y-4">
                                    <label for="nombre" class="block text-sm font-medium text-gray-700">Nombre:</label>
                                    <input type="text" id="nombre" name="nombre" placeholder="Ej: Carlos"
                                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-vet-orange focus:border-transparent">
                                </div>

                                <!-- Apellido -->
                                <div class="space-y-4">
                                    <label for="apellido" class="block text-sm font-medium text-gray-700">Apellido:</label>
                                    <input type="text" id="apellido" name="apellido" placeholder="Ej: Martínez"
                                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-vet-orange focus:border-transparent">
                                </div>

                                <!-- Email -->
                                <div class="space-y-4">
                                    <label for="email" class="block text-sm font-medium text-gray-700">Email:</label>
                                    <input type="email" id="email" name="email" placeholder="Ej: carlos.martinez@veterinaria.com"
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

                                <!-- Salario -->
                                <div class="space-y-4">
                                    <label for="salario" class="block text-sm font-medium text-gray-700">Salario mensual ($):</label>
                                    <input type="number" id="salario" name="salario" step="0.01" min="0" placeholder="Ej: 150000"
                                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-vet-orange focus:border-transparent">
                                </div>

                                <!-- Sucursal -->
                                <div class="space-y-4">
                                    <label for="id_sucursal" class="block text-sm font-medium text-gray-700">Sucursal principal:</label>
                                    <select id="id_sucursal" name="id_sucursal"
                                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-vet-orange focus:border-transparent">
                                        <option value="">-- Seleccionar sucursal --</option>
                                        <option value="1">Sucursal Centro</option>
                                        <option value="2">Sucursal Norte</option>
                                        <option value="3">Sucursal Sur</option>
                                    </select>
                                </div>

                                <!-- Estado activo -->
                                <div class="space-y-4">
                                    <label class="block text-sm font-medium text-gray-700">Estado:</label>
                                    <div class="flex items-center">
                                        <input type="checkbox" id="activo" name="activo" value="1" checked
                                               class="rounded border-gray-300 text-vet-orange focus:ring-vet-orange">
                                        <label for="activo" class="ml-2 text-sm text-gray-700">Veterinario activo</label>
                                    </div>
                                </div>

                                <!-- Servicios que puede realizar - Span completo -->
                                <div class="md:col-span-2 space-y-4 mt-4">
                                    <label class="block text-sm font-medium text-gray-700">Servicios que puede realizar:</label>
                                    <div class="grid grid-cols-2 md:grid-cols-3 gap-3">
                                        <label class="flex items-center">
                                            <input type="checkbox" name="servicios[]" value="1" class="rounded border-gray-300 text-vet-orange focus:ring-vet-orange">
                                            <span class="ml-2 text-sm text-gray-700">Consulta General</span>
                                        </label>
                                        <label class="flex items-center">
                                            <input type="checkbox" name="servicios[]" value="2" class="rounded border-gray-300 text-vet-orange focus:ring-vet-orange">
                                            <span class="ml-2 text-sm text-gray-700">Vacunación</span>
                                        </label>
                                        <label class="flex items-center">
                                            <input type="checkbox" name="servicios[]" value="3" class="rounded border-gray-300 text-vet-orange focus:ring-vet-orange">
                                            <span class="ml-2 text-sm text-gray-700">Desparasitación</span>
                                        </label>
                                        <label class="flex items-center">
                                            <input type="checkbox" name="servicios[]" value="4" class="rounded border-gray-300 text-vet-orange focus:ring-vet-orange">
                                            <span class="ml-2 text-sm text-gray-700">Cirugía Menor</span>
                                        </label>
                                        <label class="flex items-center">
                                            <input type="checkbox" name="servicios[]" value="5" class="rounded border-gray-300 text-vet-orange focus:ring-vet-orange">
                                            <span class="ml-2 text-sm text-gray-700">Cirugía Mayor</span>
                                        </label>
                                        <label class="flex items-center">
                                            <input type="checkbox" name="servicios[]" value="6" class="rounded border-gray-300 text-vet-orange focus:ring-vet-orange">
                                            <span class="ml-2 text-sm text-gray-700">Emergencias</span>
                                        </label>
                                        <label class="flex items-center">
                                            <input type="checkbox" name="servicios[]" value="7" class="rounded border-gray-300 text-vet-orange focus:ring-vet-orange">
                                            <span class="ml-2 text-sm text-gray-700">Rayos X</span>
                                        </label>
                                        <label class="flex items-center">
                                            <input type="checkbox" name="servicios[]" value="8" class="rounded border-gray-300 text-vet-orange focus:ring-vet-orange">
                                            <span class="ml-2 text-sm text-gray-700">Ecografía</span>
                                        </label>
                                        <label class="flex items-center">
                                            <input type="checkbox" name="servicios[]" value="9" class="rounded border-gray-300 text-vet-orange focus:ring-vet-orange">
                                            <span class="ml-2 text-sm text-gray-700">Análisis Clínicos</span>
                                        </label>
                                        <label class="flex items-center">
                                            <input type="checkbox" name="servicios[]" value="10" class="rounded border-gray-300 text-vet-orange focus:ring-vet-orange">
                                            <span class="ml-2 text-sm text-gray-700">Odontología</span>
                                        </label>
                                        <label class="flex items-center">
                                            <input type="checkbox" name="servicios[]" value="11" class="rounded border-gray-300 text-vet-orange focus:ring-vet-orange">
                                            <span class="ml-2 text-sm text-gray-700">Peluquería</span>
                                        </label>
                                        <label class="flex items-center">
                                            <input type="checkbox" name="servicios[]" value="12" class="rounded border-gray-300 text-vet-orange focus:ring-vet-orange">
                                            <span class="ml-2 text-sm text-gray-700">Baño Medicinal</span>
                                        </label>
                                    </div>
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
                                    Agregar veterinario
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
            document.getElementById('veterinario-form').reset();
            document.getElementById('preview-image').classList.add('hidden');
            document.getElementById('preview-placeholder').classList.remove('hidden');
        }

        // Previsualización de imagen
        document.getElementById('url_foto').addEventListener('change', function(e) {
            const file = e.target.files[0];
            const previewImage = document.getElementById('preview-image');
            const previewPlaceholder = document.getElementById('preview-placeholder');

            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    previewImage.src = e.target.result;
                    previewImage.classList.remove('hidden');
                    previewPlaceholder.classList.add('hidden');
                };
                reader.readAsDataURL(file);
            } else {
                previewImage.classList.add('hidden');
                previewPlaceholder.classList.remove('hidden');
            }
        });
    </script>
</body>
    <script src="../../js/admin/admin-dashboard.js"></script>
</html>

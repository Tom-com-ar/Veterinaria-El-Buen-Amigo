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
    <title>Agregar Sucursal - El Buen Amigo</title>
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
                    <h2 class="text-3xl font-light text-black mb-4 max-md:text-2xl">Agregar sucursal</h2>
                    
                    <!-- Descripción -->
                    <div class="bg-blue-50 border-l-4 border-vet-blue p-4 mb-8">
                        <p class="text-gray-700 text-sm">
                            Agregar una sucursal implica muchas acciones posteriores a su creación, se recomienda que una vez se cree la sucursal, inicializar su caja y agregar las entidades correspondientes a la sucursal.
                        </p>
                    </div>

                    <!-- Formulario -->
                    <div class="bg-white rounded-md shadow-md p-8 max-w-4xl">
                        <form id="sucursal-form" method="POST" action="../../php/procesar-sucursal.php" enctype="multipart/form-data">
                            <input type="hidden" name="action" value="crear">
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-12">
                                <!-- Imagen de la sucursal - Span completo -->
                                <div class="md:col-span-2 space-y-4 mb-4">
                                    <label class="block text-sm font-medium text-gray-700">Preview de la imagen de la sucursal:</label>
                                    <div class="flex items-start space-x-8">
                                        <div class="flex-1">
                                            <input type="file" id="imagen" name="imagen" accept="image/*" 
                                                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-vet-orange focus:border-transparent">
                                        </div>
                                        <div class="flex-shrink-0">
                                            <div id="preview-container" class="w-48 h-48 border-2 border-dashed border-gray-300 rounded-lg flex items-center justify-center bg-gray-50">
                                                <img id="preview-image" src="" alt="Vista previa" class="w-full h-full object-cover rounded-lg hidden">
                                                <div id="preview-placeholder" class="text-center text-gray-400">
                                                    <i class="fas fa-image text-4xl mb-3"></i>
                                                    <p class="text-sm">Vista previa</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Primera columna -->
                                <!-- Nombre de la sucursal -->
                                <div class="space-y-4">
                                    <label for="nombre" class="block text-sm font-medium text-gray-700">Nombre de la sucursal:</label>
                                    <input type="text" id="nombre" name="nombre" placeholder="Ej: Veterinaria Centro"
                                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-vet-orange focus:border-transparent">
                                </div>

                                <!-- Dirección de la sucursal -->
                                <div class="space-y-4">
                                    <label for="direccion" class="block text-sm font-medium text-gray-700">Dirección de la sucursal:</label>
                                    <input type="text" id="direccion" name="direccion" placeholder="Ej: Av. Corrientes 1234"
                                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-vet-orange focus:border-transparent">
                                </div>

                                <!-- Localidad -->
                                <div class="space-y-4">
                                    <label for="localidad" class="block text-sm font-medium text-gray-700">Localidad:</label>
                                    <input type="text" id="localidad" name="localidad" placeholder="Ej: Villa Crespo"
                                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-vet-orange focus:border-transparent">
                                </div>

                                <!-- Partido -->
                                <div class="space-y-4">
                                    <label for="partido" class="block text-sm font-medium text-gray-700">Partido:</label>
                                    <input type="text" id="partido" name="partido" placeholder="Ej: Ciudad de Buenos Aires"
                                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-vet-orange focus:border-transparent">
                                </div>

                                <!-- Segunda columna -->
                                <!-- Correo electrónico -->
                                <div class="space-y-4">
                                    <label for="email" class="block text-sm font-medium text-gray-700">Correo electronico:</label>
                                    <input type="email" id="email" name="email" placeholder="Ej: centro@veterinaria.com"
                                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-vet-orange focus:border-transparent">
                                </div>

                                <!-- Teléfono -->
                                <div class="space-y-4">
                                    <label for="telefono" class="block text-sm font-medium text-gray-700">Telefono de la sucursal:</label>
                                    <input type="tel" id="telefono" name="telefono" placeholder="Ej: +54 11 1234-5678"
                                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-vet-orange focus:border-transparent">
                                </div>

                                <!-- Horario de apertura -->
                                <div class="space-y-4">
                                    <label for="horario_apertura" class="block text-sm font-medium text-gray-700">Horario de apertura:</label>
                                    <input type="time" id="horario_apertura" name="horario_apertura"
                                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-vet-orange focus:border-transparent">
                                </div>

                                <!-- Horario de cierre -->
                                <div class="space-y-4">
                                    <label for="horario_cierre" class="block text-sm font-medium text-gray-700">Horario de cierre:</label>
                                    <input type="time" id="horario_cierre" name="horario_cierre"
                                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-vet-orange focus:border-transparent">
                                </div>
                            </div>

                            <!-- Botones - Fuera del grid -->
                            <div class="flex space-x-4 pt-8 mt-8 border-t border-gray-200">
                                <button type="button" onclick="limpiarFormulario()"
                                        class="px-6 py-2 bg-red-500 text-white rounded-md hover:bg-red-600 transition-colors">
                                    Borrar formulario
                                </button>
                                <button type="submit"
                                        class="px-6 py-2 bg-green-500 text-white rounded-md hover:bg-green-600 transition-colors">
                                    Agregar sucursal
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <script>
        // Vista previa de imagen (solo visual)
        document.getElementById('imagen').addEventListener('change', function(e) {
            const file = e.target.files[0];
            const previewImage = document.getElementById('preview-image');
            const previewPlaceholder = document.getElementById('preview-placeholder');

            if (file) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    previewImage.src = e.target.result;
                    previewImage.classList.remove('hidden');
                    previewPlaceholder.classList.add('hidden');
                };
                reader.readAsDataURL(file);
            } else {
                previewImage.classList.add('hidden');
                previewPlaceholder.classList.remove('hidden');
                previewImage.src = '';
            }
        });

        // Función para limpiar el formulario (solo visual)
        function limpiarFormulario() {
            document.getElementById('sucursal-form').reset();
            document.getElementById('preview-image').classList.add('hidden');
            document.getElementById('preview-placeholder').classList.remove('hidden');
            document.getElementById('preview-image').src = '';
        }
    </script>
</body>
    <script src="../../js/admin/admin-dashboard.js"></script>
</html>

<?php
// Incluir la configuración de layout
include_once '../../components/admin/layout.php';

// Obtener configuración para la página de inicio admin
$config = get_page_config('admin_dashboard');
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Inicio - El Buen Amigo</title>
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
        <h2 class="text-3xl font-light text-black mb-8 max-md:text-2xl">Herramientas</h2>
            <div class="flex gap-6 max-xl:flex-col">
                <!-- Área de herramientas -->
                <div class="flex flex-col w-[100%] justify-center">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Turnos -->
                        <div class="bg-vet-green rounded-lg p-6 shadow-md flex flex-col justify-between min-h-[120px]">
                            <div>
                                <h3 class="text-lg font-semibold text-white mb-2">Turnos</h3>
                                <p class="text-sm text-white mb-4">turnos del día 25</p>
                            </div>
                            <div class="flex items-center justify-between">
                                <i class="fas fa-calendar-alt text-white text-xl"></i>
                                <a href="#" class="text-white text-sm font-semibold hover:underline">Ver detalles</a>
                            </div>
                        </div>
                        <!-- Realizar un turno -->
                        <div class="bg-vet-green rounded-lg p-6 shadow-md flex flex-col justify-center min-h-[120px]">
                            <h3 class="text-lg font-semibold text-white mb-2">Realizar un turno</h3>
                            <div class="flex items-center justify-center mt-2">
                                <i class="fas fa-list text-white text-xl"></i>
                            </div>
                        </div>
                        <!-- Pedidos -->
                        <div class="bg-vet-orange rounded-lg p-6 shadow-md flex flex-col justify-between min-h-[120px]">
                            <div>
                                <h3 class="text-lg font-semibold text-white mb-2">Pedidos</h3>
                                <p class="text-sm text-white mb-4">pedidos pendientes 25</p>
                            </div>
                            <div class="flex items-center justify-between">
                                <i class="fas fa-file-invoice text-white text-xl"></i>
                                <a href="#" class="text-white text-sm font-semibold hover:underline">Ver detalles</a>
                            </div>
                        </div>
                        <!-- Realizar una venta -->
                        <div class="bg-vet-orange rounded-lg p-6 shadow-md flex flex-col justify-center min-h-[120px]">
                            <h3 class="text-lg font-semibold text-white mb-2">Realizar una venta</h3>
                            <div class="flex items-center justify-center mt-2">
                                <i class="fas fa-shopping-cart text-white text-xl"></i>
                            </div>
                        </div>
                        <!-- Ingresos -->
                        <div class="bg-vet-taupe rounded-lg p-6 shadow-md flex flex-col justify-between min-h-[120px]">
                            <div>
                                <h3 class="text-lg font-semibold text-white mb-2">Ingresos</h3>
                                <p class="text-sm text-white mb-4">ingresos del día 25.000</p>
                            </div>
                            <div class="flex items-center justify-between">
                                <i class="fas fa-file-invoice-dollar text-white text-xl"></i>
                                <a href="#" class="text-white text-sm font-semibold hover:underline">Ver detalles</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="w-[20%] max-xl:w-full">
                    <div class="bg-white rounded-md shadow-md p-6 border border-gray-200">
                        <h3 class="text-lg font-light text-black mb-6">Información del perfil</h3>
                        <div class="space-y-4">
                            <div class="pb-4 border-b border-gray-300">
                                <p class="text-sm font-light text-gray-600 mb-1">Nombre de usuario</p>
                                <p class="text-base font-light text-black">Admin Usuario</p>
                            </div>
                            <div class="pb-4 border-b border-gray-300">
                                <p class="text-sm font-light text-gray-600 mb-1">Email registrado</p>
                                <p class="text-base font-light text-black">admin@elbuenamigo.com</p>
                            </div>
                            <div class="pb-4 border-b border-gray-300">
                                <p class="text-sm font-light text-gray-600 mb-1">Teléfono</p>
                                <p class="text-base font-light text-black">+54 11 1234-5678</p>
                            </div>
                            <div class="pb-4 border-b border-gray-300">
                                <p class="text-sm font-light text-gray-600 mb-1">Cuenta creada el</p>
                                <p class="text-base font-light text-black">15 de Enero, 2024</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <!-- Modal de validación de contraseña -->
    <div id="password-modal" class="hidden fixed inset-0 bg-black bg-opacity-50 z-40" style="background-color: rgba(107, 114, 128, 0.5);">
        <div class="flex items-center justify-center min-h-screen px-4">
            <div class="bg-white rounded-lg p-6 w-full max-w-md">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Validar Contraseña</h3>
                <p class="text-sm text-gray-600 mb-4">Por favor ingresa tu contraseña actual para continuar:</p>
                <form id="password-form">
                    <div class="mb-4">
                        <input type="password" id="current-password" placeholder="Contraseña actual" 
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-vet-blue">
                    </div>
                    <div class="flex justify-end space-x-3">
                        <button type="button" id="cancel-password" class="px-4 py-2 text-gray-600 bg-gray-200 rounded-md hover:bg-gray-300 transition-colors">
                            Cancelar
                        </button>
                        <button type="submit" class="px-4 py-2 bg-vet-blue text-white rounded-md hover:bg-vet-blue/90 transition-colors">
                            Validar
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal de edición de perfil -->
    <div id="profile-edit-modal" class="hidden fixed inset-0 bg-black bg-opacity-50 z-40" style="background-color: rgba(107, 114, 128, 0.5);">
        <div class="flex items-center justify-center min-h-screen px-4">
            <div class="bg-white rounded-lg p-6 w-full max-w-md max-h-[90vh] overflow-y-auto">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Editar Perfil</h3>
                <form id="profile-edit-form">
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Nombre de Usuario</label>
                            <input type="text" id="edit-username" value="Admin Usuario" 
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-vet-blue">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                            <input type="email" id="edit-email" value="admin@elbuenamigo.com" 
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-vet-blue">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Teléfono</label>
                            <input type="tel" id="edit-phone" value="+54 11 1234-5678" 
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-vet-blue">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Nueva Contraseña (opcional)</label>
                            <input type="password" id="new-password" placeholder="Dejar en blanco para mantener actual" 
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-vet-blue">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Confirmar Nueva Contraseña</label>
                            <input type="password" id="confirm-password" placeholder="Confirmar nueva contraseña" 
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-vet-blue">
                        </div>
                    </div>
                    <div class="flex justify-end space-x-3 mt-6">
                        <button type="button" id="cancel-edit" class="px-4 py-2 text-gray-600 bg-gray-200 rounded-md hover:bg-gray-300 transition-colors">
                            Cancelar
                        </button>
                        <button type="submit" class="px-4 py-2 bg-vet-blue text-white rounded-md hover:bg-vet-blue/90 transition-colors">
                            Guardar Cambios
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="../../js/admin/admin-dashboard.js"></script>
</body>
</html>

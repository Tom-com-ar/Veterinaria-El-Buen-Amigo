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
            <div class="flex gap-6 max-xl:flex-col">
                <!-- Área de herramientas -->
                <div class="flex-1">
                    <h2 class="text-3xl font-light text-black mb-8 max-md:text-2xl">Herramientas</h2>
                    
                    <!-- Sucursales Section -->
                    <div class="mb-8">
                        <div class="bg-white rounded-md shadow-md border border-gray-200">
                            <!-- Header de la tarjeta -->
                            <div class="flex items-center justify-between p-6 border-b border-gray-200">
                                <h3 class="text-xl font-light text-black">Sucursales</h3>
                                <button class="text-black hover:text-vet-blue card-toggle">
                                    <i class="fas fa-chevron-up"></i>
                                </button>
                            </div>
                            <!-- Contenido de acciones -->
                            <div class="p-6">
                                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                                    <button class="flex items-center space-x-4 p-6 rounded-lg hover:bg-gray-50 transition-all duration-200 text-left shadow-md hover:shadow-lg bg-white border border-gray-100">
                                        <i class="fas fa-plus text-vet-orange text-2xl"></i>
                                        <span class="font-light text-black">agregar</span>
                                    </button>
                                    <button class="flex items-center space-x-4 p-6 rounded-lg hover:bg-gray-50 transition-all duration-200 text-left shadow-md hover:shadow-lg bg-white border border-gray-100">
                                        <i class="fas fa-edit text-vet-orange text-2xl"></i>
                                        <span class="font-light text-black">modificar</span>
                                    </button>
                                    <button class="flex items-center space-x-4 p-6 rounded-lg hover:bg-gray-50 transition-all duration-200 text-left shadow-md hover:shadow-lg bg-white border border-gray-100">
                                        <i class="fas fa-tools text-vet-orange text-2xl"></i>
                                        <span class="font-light text-black">servicios</span>
                                    </button>
                                    <button class="flex items-center space-x-4 p-6 rounded-lg hover:bg-gray-50 transition-all duration-200 text-left shadow-md hover:shadow-lg bg-white border border-gray-100">
                                        <i class="fas fa-user-shield text-vet-orange text-2xl"></i>
                                        <span class="font-light text-black">administradores</span>
                                    </button>
                                    <button class="flex items-center space-x-4 p-6 rounded-lg hover:bg-gray-50 transition-all duration-200 text-left shadow-md hover:shadow-lg bg-white border border-gray-100">
                                        <i class="fas fa-cash-register text-vet-orange text-2xl"></i>
                                        <span class="font-light text-black">caja registradora</span>
                                    </button>
                                    <button class="flex items-center space-x-4 p-6 rounded-lg hover:bg-gray-50 transition-all duration-200 text-left shadow-md hover:shadow-lg bg-white border border-gray-100">
                                        <i class="fas fa-chart-line text-vet-orange text-2xl"></i>
                                        <span class="font-light text-black">estadísticas</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Veterinarios Section -->
                    <div class="mb-8">
                        <div class="bg-white rounded-md shadow-md border border-gray-200">
                            <!-- Header de la tarjeta -->
                            <div class="flex items-center justify-between p-6 border-b border-gray-200">
                                <h3 class="text-xl font-light text-black">Veterinarios</h3>
                                <button class="text-black hover:text-vet-blue card-toggle">
                                    <i class="fas fa-chevron-up"></i>
                                </button>
                            </div>
                            <!-- Contenido de acciones -->
                            <div class="p-6">
                                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                                    <button class="flex items-center space-x-4 p-6 rounded-lg hover:bg-gray-50 transition-all duration-200 text-left shadow-md hover:shadow-lg bg-white border border-gray-100">
                                        <i class="fas fa-plus text-vet-orange text-2xl"></i>
                                        <span class="font-light text-black">agregar</span>
                                    </button>
                                    <button class="flex items-center space-x-4 p-6 rounded-lg hover:bg-gray-50 transition-all duration-200 text-left shadow-md hover:shadow-lg bg-white border border-gray-100">
                                        <i class="fas fa-edit text-vet-orange text-2xl"></i>
                                        <span class="font-light text-black">modificar</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Recepcionistas Section -->
                    <div class="mb-8">
                        <div class="bg-white rounded-md shadow-md border border-gray-200">
                            <!-- Header de la tarjeta -->
                            <div class="flex items-center justify-between p-6 border-b border-gray-200">
                                <h3 class="text-xl font-light text-black">Recepcionistas</h3>
                                <button class="text-black hover:text-vet-blue card-toggle">
                                    <i class="fas fa-chevron-up"></i>
                                </button>
                            </div>
                            <!-- Contenido de acciones -->
                            <div class="p-6">
                                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                                    <button class="flex items-center space-x-4 p-6 rounded-lg hover:bg-gray-50 transition-all duration-200 text-left shadow-md hover:shadow-lg bg-white border border-gray-100">
                                        <i class="fas fa-plus text-vet-orange text-2xl"></i>
                                        <span class="font-light text-black">agregar</span>
                                    </button>
                                    <button class="flex items-center space-x-4 p-6 rounded-lg hover:bg-gray-50 transition-all duration-200 text-left shadow-md hover:shadow-lg bg-white border border-gray-100">
                                        <i class="fas fa-edit text-vet-orange text-2xl"></i>
                                        <span class="font-light text-black">modificar</span>
                                    </button>
                                    <button class="flex items-center space-x-4 p-6 rounded-lg hover:bg-gray-50 transition-all duration-200 text-left shadow-md hover:shadow-lg bg-white border border-gray-100">
                                        <i class="fas fa-eye text-vet-orange text-2xl"></i>
                                        <span class="font-light text-black">ver acciones</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Productos Section -->
                    <div class="mb-8">
                        <div class="bg-white rounded-md shadow-md border border-gray-200">
                            <!-- Header de la tarjeta -->
                            <div class="flex items-center justify-between p-6 border-b border-gray-200">
                                <h3 class="text-xl font-light text-black">Productos</h3>
                                <button class="text-black hover:text-vet-blue card-toggle">
                                    <i class="fas fa-chevron-up"></i>
                                </button>
                            </div>
                            <!-- Contenido de acciones -->
                            <div class="p-6">
                                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                                    <button class="flex items-center space-x-4 p-6 rounded-lg hover:bg-gray-50 transition-all duration-200 text-left shadow-md hover:shadow-lg bg-white border border-gray-100">
                                        <i class="fas fa-plus text-vet-orange text-2xl"></i>
                                        <span class="font-light text-black">agregar producto</span>
                                    </button>
                                    <button class="flex items-center space-x-4 p-6 rounded-lg hover:bg-gray-50 transition-all duration-200 text-left shadow-md hover:shadow-lg bg-white border border-gray-100">
                                        <i class="fas fa-edit text-vet-orange text-2xl"></i>
                                        <span class="font-light text-black">modificar producto</span>
                                    </button>
                                    <button class="flex items-center space-x-4 p-6 rounded-lg hover:bg-gray-50 transition-all duration-200 text-left shadow-md hover:shadow-lg bg-white border border-gray-100">
                                        <i class="fas fa-chart-bar text-vet-orange text-2xl"></i>
                                        <span class="font-light text-black">ajuste de stock</span>
                                    </button>
                                    <button class="flex items-center space-x-4 p-6 rounded-lg hover:bg-gray-50 transition-all duration-200 text-left shadow-md hover:shadow-lg bg-white border border-gray-100">
                                        <i class="fas fa-truck text-vet-orange text-2xl"></i>
                                        <span class="font-light text-black">agregar proveedor</span>
                                    </button>
                                    <button class="flex items-center space-x-4 p-6 rounded-lg hover:bg-gray-50 transition-all duration-200 text-left shadow-md hover:shadow-lg bg-white border border-gray-100">
                                        <i class="fas fa-user-edit text-vet-orange text-2xl"></i>
                                        <span class="font-light text-black">modificar proveedor</span>
                                    </button>
                                    <button class="flex items-center space-x-4 p-6 rounded-lg hover:bg-gray-50 transition-all duration-200 text-left shadow-md hover:shadow-lg bg-white border border-gray-100">
                                        <i class="fas fa-shopping-cart text-vet-orange text-2xl"></i>
                                        <span class="font-light text-black">compras</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Sidebar derecho - Información del perfil -->
                <div class="w-80 max-xl:w-full">
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

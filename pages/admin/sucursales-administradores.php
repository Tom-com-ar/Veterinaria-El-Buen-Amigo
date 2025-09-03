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
    <title>Administradores por Sucursal - El Buen Amigo</title>
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
            <div class="max-w-6xl mx-auto">
                <!-- Título -->
                <h1 class="text-3xl font-light text-black mb-8">Gestión de Administradores por Sucursal</h1>

                <!-- Selector de sucursal y botón agregar -->
                <div class="bg-white rounded-md shadow-md p-6 mb-6">
                    <div class="flex flex-col md:flex-row justify-between items-start md:items-center space-y-4 md:space-y-0">
                        <div class="flex items-center space-x-4">
                            <label for="sucursal-select" class="text-sm font-medium text-gray-700">Sucursal:</label>
                            <select id="sucursal-select" class="px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-vet-blue">
                                <option value="">-- Todas las sucursales --</option>
                                <option value="1">Sucursal Centro</option>
                                <option value="2">Sucursal Norte</option>
                                <option value="3">Sucursal Sur</option>
                            </select>
                        </div>
                        <button onclick="openAddAdminModal()" class="px-4 py-2 bg-vet-blue text-white rounded-md hover:bg-vet-blue/90 transition-colors">
                            <i class="fas fa-user-plus mr-2"></i>Agregar Administrador
                        </button>
                    </div>
                </div>

                <!-- Lista de administradores -->
                <div class="bg-white rounded-md shadow-md">
                    <div class="px-6 py-4 border-b border-gray-200">
                        <h2 class="text-xl font-medium text-gray-800">Administradores por Sucursal</h2>
                    </div>
                    
                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Administrador</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Sucursal</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Rol</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Estado</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Último Acceso</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Acciones</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0 h-10 w-10">
                                                <div class="h-10 w-10 rounded-full bg-vet-blue flex items-center justify-center">
                                                    <span class="text-sm font-medium text-white">JG</span>
                                                </div>
                                            </div>
                                            <div class="ml-4">
                                                <div class="text-sm font-medium text-gray-900">Juan García</div>
                                                <div class="text-sm text-gray-500">juan.garcia@elbuenamigo.com</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900">Sucursal Centro</div>
                                        <div class="text-sm text-gray-500">SUC001</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-blue-100 text-blue-800">
                                            Admin General
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">
                                            Activo
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        Hace 2 horas
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium space-x-2">
                                        <button class="text-vet-blue hover:text-vet-blue/70" onclick="editAdmin(1)">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button class="text-green-600 hover:text-green-500" onclick="viewAdminPermissions(1)">
                                            <i class="fas fa-key"></i>
                                        </button>
                                        <button class="text-yellow-600 hover:text-yellow-500" onclick="toggleAdminStatus(1)">
                                            <i class="fas fa-user-slash"></i>
                                        </button>
                                        <button class="text-red-600 hover:text-red-500" onclick="deleteAdmin(1)">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </td>
                                </tr>

                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0 h-10 w-10">
                                                <div class="h-10 w-10 rounded-full bg-purple-500 flex items-center justify-center">
                                                    <span class="text-sm font-medium text-white">ML</span>
                                                </div>
                                            </div>
                                            <div class="ml-4">
                                                <div class="text-sm font-medium text-gray-900">María López</div>
                                                <div class="text-sm text-gray-500">maria.lopez@elbuenamigo.com</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900">Sucursal Norte</div>
                                        <div class="text-sm text-gray-500">SUC002</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-purple-100 text-purple-800">
                                            Admin Sucursal
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">
                                            Activo
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        Ayer
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium space-x-2">
                                        <button class="text-vet-blue hover:text-vet-blue/70" onclick="editAdmin(2)">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button class="text-green-600 hover:text-green-500" onclick="viewAdminPermissions(2)">
                                            <i class="fas fa-key"></i>
                                        </button>
                                        <button class="text-yellow-600 hover:text-yellow-500" onclick="toggleAdminStatus(2)">
                                            <i class="fas fa-user-slash"></i>
                                        </button>
                                        <button class="text-red-600 hover:text-red-500" onclick="deleteAdmin(2)">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </td>
                                </tr>

                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0 h-10 w-10">
                                                <div class="h-10 w-10 rounded-full bg-red-500 flex items-center justify-center">
                                                    <span class="text-sm font-medium text-white">CR</span>
                                                </div>
                                            </div>
                                            <div class="ml-4">
                                                <div class="text-sm font-medium text-gray-900">Carlos Rodríguez</div>
                                                <div class="text-sm text-gray-500">carlos.rodriguez@elbuenamigo.com</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900">Sucursal Sur</div>
                                        <div class="text-sm text-gray-500">SUC003</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-gray-100 text-gray-800">
                                            Admin Limitado
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-red-100 text-red-800">
                                            Inactivo
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        Hace 1 semana
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium space-x-2">
                                        <button class="text-vet-blue hover:text-vet-blue/70" onclick="editAdmin(3)">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button class="text-green-600 hover:text-green-500" onclick="viewAdminPermissions(3)">
                                            <i class="fas fa-key"></i>
                                        </button>
                                        <button class="text-green-600 hover:text-green-500" onclick="toggleAdminStatus(3)">
                                            <i class="fas fa-user-check"></i>
                                        </button>
                                        <button class="text-red-600 hover:text-red-500" onclick="deleteAdmin(3)">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <!-- Modal para agregar administrador -->
    <div id="add-admin-modal" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50">
        <div class="relative top-10 mx-auto p-5 border w-11/12 max-w-2xl shadow-lg rounded-md bg-white">
            <div class="mt-3">
                <h3 class="text-lg font-medium text-gray-900 mb-4">Agregar Nuevo Administrador</h3>
                <form id="add-admin-form">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Nombre *</label>
                            <input type="text" id="add-nombre" name="nombre" required
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-vet-blue">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Apellido *</label>
                            <input type="text" id="add-apellido" name="apellido" required
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-vet-blue">
                        </div>
                        <div class="md:col-span-2">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Email *</label>
                            <input type="email" id="add-email" name="email" required
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-vet-blue">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Sucursal *</label>
                            <select id="add-sucursal" name="sucursal" required
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-vet-blue">
                                <option value="">-- Seleccionar sucursal --</option>
                                <option value="1">Sucursal Centro</option>
                                <option value="2">Sucursal Norte</option>
                                <option value="3">Sucursal Sur</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Rol *</label>
                            <select id="add-rol" name="rol" required
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-vet-blue">
                                <option value="">-- Seleccionar rol --</option>
                                <option value="admin_general">Administrador General</option>
                                <option value="admin_sucursal">Administrador Sucursal</option>
                                <option value="admin_limitado">Administrador Limitado</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Contraseña Temporal *</label>
                            <input type="password" id="add-password" name="password" required
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-vet-blue">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Confirmar Contraseña *</label>
                            <input type="password" id="add-confirm-password" name="confirm_password" required
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-vet-blue">
                        </div>
                    </div>
                    
                    <div class="mt-6">
                        <label class="flex items-center">
                            <input type="checkbox" id="send-email" name="send_email" checked
                                   class="rounded border-gray-300 text-vet-blue focus:ring-vet-blue">
                            <span class="ml-2 text-sm text-gray-700">Enviar credenciales por email</span>
                        </label>
                    </div>
                    
                    <div class="flex justify-end space-x-3 mt-6">
                        <button type="button" onclick="closeAddAdminModal()"
                                class="px-4 py-2 bg-gray-300 text-gray-700 rounded-md hover:bg-gray-400 transition-colors">
                            Cancelar
                        </button>
                        <button type="submit"
                                class="px-4 py-2 bg-vet-blue text-white rounded-md hover:bg-vet-blue/90 transition-colors">
                            <i class="fas fa-user-plus mr-2"></i>Crear Administrador
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal para ver permisos -->
    <div id="permissions-modal" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50">
        <div class="relative top-10 mx-auto p-5 border w-11/12 max-w-lg shadow-lg rounded-md bg-white">
            <div class="mt-3">
                <h3 class="text-lg font-medium text-gray-900 mb-4">Permisos del Administrador</h3>
                <div id="permissions-list" class="space-y-3">
                    <!-- Los permisos se cargarán dinámicamente -->
                </div>
                
                <div class="flex justify-end mt-6">
                    <button type="button" onclick="closePermissionsModal()"
                            class="px-4 py-2 bg-gray-300 text-gray-700 rounded-md hover:bg-gray-400 transition-colors">
                        Cerrar
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script>
        function openAddAdminModal() {
            document.getElementById('add-admin-modal').classList.remove('hidden');
        }

        function closeAddAdminModal() {
            document.getElementById('add-admin-modal').classList.add('hidden');
            document.getElementById('add-admin-form').reset();
        }

        function editAdmin(id) {
            alert('Editar administrador ' + id);
            // Aquí abrir modal de edición con datos cargados
        }

        function viewAdminPermissions(id) {
            // Simular permisos según el ID
            const permissions = {
                1: ['Gestión total', 'Acceso a reportes', 'Gestión de usuarios', 'Configuración del sistema'],
                2: ['Gestión de sucursal', 'Ver reportes básicos', 'Gestión de personal'],
                3: ['Solo lectura', 'Reportes básicos']
            };

            const permissionsList = document.getElementById('permissions-list');
            permissionsList.innerHTML = '';

            permissions[id].forEach(permission => {
                const div = document.createElement('div');
                div.className = 'flex items-center space-x-2';
                div.innerHTML = `
                    <i class="fas fa-check text-green-500"></i>
                    <span class="text-sm text-gray-700">${permission}</span>
                `;
                permissionsList.appendChild(div);
            });

            document.getElementById('permissions-modal').classList.remove('hidden');
        }

        function closePermissionsModal() {
            document.getElementById('permissions-modal').classList.add('hidden');
        }

        function toggleAdminStatus(id) {
            if (confirm('¿Cambiar el estado de este administrador?')) {
                alert('Estado cambiado correctamente');
                // Aquí harías el cambio por AJAX
            }
        }

        function deleteAdmin(id) {
            if (confirm('¿Está seguro de que desea eliminar este administrador?\nEsta acción no se puede deshacer.')) {
                alert('Administrador eliminado');
                // Aquí harías la eliminación por AJAX
            }
        }

        // Manejar el envío del formulario
        document.getElementById('add-admin-form').addEventListener('submit', function(e) {
            e.preventDefault();
            
            const password = document.getElementById('add-password').value;
            const confirmPassword = document.getElementById('add-confirm-password').value;
            
            if (password !== confirmPassword) {
                alert('Las contraseñas no coinciden');
                return;
            }

            alert('Administrador creado correctamente');
            closeAddAdminModal();
            // Aquí enviarías los datos por AJAX
        });
    </script>
</body>
    <script src="../../js/admin/admin-dashboard.js"></script>
</html>

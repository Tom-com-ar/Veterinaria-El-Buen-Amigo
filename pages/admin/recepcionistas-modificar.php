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
    <title>Modificar Recepcionistas - El Buen Amigo</title>
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
                <h1 class="text-3xl font-light text-black mb-8">Gestionar Recepcionistas</h1>

                <!-- Barra de búsqueda y filtros -->
                <div class="bg-white rounded-md shadow-md p-6 mb-6">
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                        <div>
                            <input type="text" id="search-recepcionista" placeholder="Buscar por nombre o DNI..."
                                   class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-vet-blue">
                        </div>
                        <div>
                            <select id="filter-sucursal" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-vet-blue">
                                <option value="">Todas las sucursales</option>
                                <option value="1">Sucursal Centro</option>
                                <option value="2">Sucursal Norte</option>
                                <option value="3">Sucursal Sur</option>
                            </select>
                        </div>
                        <div>
                            <select id="filter-estado" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-vet-blue">
                                <option value="">Todos los estados</option>
                                <option value="activo">Activas</option>
                                <option value="inactivo">Inactivas</option>
                            </select>
                        </div>
                        <div>
                            <button class="w-full px-4 py-2 bg-vet-blue text-white rounded-md hover:bg-vet-blue/90 transition-colors">
                                <i class="fas fa-search mr-2"></i>Buscar
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Lista de recepcionistas -->
                <div class="bg-white rounded-md shadow-md">
                    <div class="px-6 py-4 border-b border-gray-200">
                        <h2 class="text-xl font-medium text-gray-800">Recepcionistas Registradas</h2>
                    </div>
                    
                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Recepcionista</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">DNI</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Sucursal</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Horario</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Estado</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Acciones</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0 h-10 w-10">
                                                <img class="h-10 w-10 rounded-full" src="https://ui-avatars.com/api/?name=Ana+Martinez&background=3B82F6&color=fff" alt="Ana Martínez">
                                            </div>
                                            <div class="ml-4">
                                                <div class="text-sm font-medium text-gray-900">Ana Martínez</div>
                                                <div class="text-sm text-gray-500">ana.martinez@elbuenamigo.com</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900">12345678</div>
                                        <div class="text-sm text-gray-500">Tel: (011) 1234-5678</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900">Sucursal Centro</div>
                                        <div class="text-sm text-gray-500">Tiempo Completo</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900">L-V: 8:00-16:00</div>
                                        <div class="text-sm text-gray-500">Sáb: 8:00-12:00</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">
                                            Activa
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium space-x-2">
                                        <button class="text-vet-blue hover:text-vet-blue/70" onclick="editRecepcionista(1)">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button class="text-green-600 hover:text-green-500" onclick="viewRecepcionista(1)">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                        <button class="text-purple-600 hover:text-purple-500" onclick="viewSchedule(1)">
                                            <i class="fas fa-calendar"></i>
                                        </button>
                                        <button class="text-orange-600 hover:text-orange-500" onclick="viewPermissions(1)">
                                            <i class="fas fa-key"></i>
                                        </button>
                                        <button class="text-red-600 hover:text-red-500" onclick="deleteRecepcionista(1)">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </td>
                                </tr>

                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0 h-10 w-10">
                                                <img class="h-10 w-10 rounded-full" src="https://ui-avatars.com/api/?name=Carmen+Lopez&background=10B981&color=fff" alt="Carmen López">
                                            </div>
                                            <div class="ml-4">
                                                <div class="text-sm font-medium text-gray-900">Carmen López</div>
                                                <div class="text-sm text-gray-500">carmen.lopez@elbuenamigo.com</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900">87654321</div>
                                        <div class="text-sm text-gray-500">Tel: (011) 8765-4321</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900">Sucursal Norte</div>
                                        <div class="text-sm text-gray-500">Tiempo Completo</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900">L-V: 9:00-17:00</div>
                                        <div class="text-sm text-gray-500">Sáb: 9:00-13:00</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">
                                            Activa
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium space-x-2">
                                        <button class="text-vet-blue hover:text-vet-blue/70" onclick="editRecepcionista(2)">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button class="text-green-600 hover:text-green-500" onclick="viewRecepcionista(2)">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                        <button class="text-purple-600 hover:text-purple-500" onclick="viewSchedule(2)">
                                            <i class="fas fa-calendar"></i>
                                        </button>
                                        <button class="text-orange-600 hover:text-orange-500" onclick="viewPermissions(2)">
                                            <i class="fas fa-key"></i>
                                        </button>
                                        <button class="text-red-600 hover:text-red-500" onclick="deleteRecepcionista(2)">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </td>
                                </tr>

                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0 h-10 w-10">
                                                <img class="h-10 w-10 rounded-full" src="https://ui-avatars.com/api/?name=Sofia+Garcia&background=F59E0B&color=fff" alt="Sofía García">
                                            </div>
                                            <div class="ml-4">
                                                <div class="text-sm font-medium text-gray-900">Sofía García</div>
                                                <div class="text-sm text-gray-500">sofia.garcia@elbuenamigo.com</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900">11223344</div>
                                        <div class="text-sm text-gray-500">Tel: (011) 1122-3344</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900">Sucursal Sur</div>
                                        <div class="text-sm text-gray-500">Medio Tiempo</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900">L-V: 14:00-18:00</div>
                                        <div class="text-sm text-gray-500">-</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                            Licencia
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium space-x-2">
                                        <button class="text-vet-blue hover:text-vet-blue/70" onclick="editRecepcionista(3)">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button class="text-green-600 hover:text-green-500" onclick="viewRecepcionista(3)">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                        <button class="text-purple-600 hover:text-purple-500" onclick="viewSchedule(3)">
                                            <i class="fas fa-calendar"></i>
                                        </button>
                                        <button class="text-orange-600 hover:text-orange-500" onclick="viewPermissions(3)">
                                            <i class="fas fa-key"></i>
                                        </button>
                                        <button class="text-red-600 hover:text-red-500" onclick="deleteRecepcionista(3)">
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

    <!-- Modal de edición -->
    <div id="edit-modal" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50">
        <div class="relative top-10 mx-auto p-5 border w-11/12 max-w-2xl shadow-lg rounded-md bg-white">
            <div class="mt-3">
                <h3 class="text-lg font-medium text-gray-900 mb-4">Editar Recepcionista</h3>
                <form id="edit-form">
                    <input type="hidden" id="edit-id" name="id">
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Nombre</label>
                            <input type="text" id="edit-nombre" name="nombre" required
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-vet-blue">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Apellido</label>
                            <input type="text" id="edit-apellido" name="apellido" required
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-vet-blue">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                            <input type="email" id="edit-email" name="email" required
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-vet-blue">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Teléfono</label>
                            <input type="tel" id="edit-telefono" name="telefono"
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-vet-blue">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Sucursal</label>
                            <select id="edit-sucursal" name="sucursal"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-vet-blue">
                                <option value="1">Sucursal Centro</option>
                                <option value="2">Sucursal Norte</option>
                                <option value="3">Sucursal Sur</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Estado</label>
                            <select id="edit-estado" name="estado"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-vet-blue">
                                <option value="activo">Activa</option>
                                <option value="licencia">En Licencia</option>
                                <option value="inactivo">Inactiva</option>
                            </select>
                        </div>
                    </div>
                    
                    <div class="flex justify-end space-x-3 mt-6">
                        <button type="button" onclick="closeEditModal()"
                                class="px-4 py-2 bg-gray-300 text-gray-700 rounded-md hover:bg-gray-400 transition-colors">
                            Cancelar
                        </button>
                        <button type="submit"
                                class="px-4 py-2 bg-vet-blue text-white rounded-md hover:bg-vet-blue/90 transition-colors">
                            Guardar Cambios
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function editRecepcionista(id) {
            const recepcionistas = {
                1: { nombre: 'Ana', apellido: 'Martínez', email: 'ana.martinez@elbuenamigo.com', telefono: '1234567890', sucursal: '1', estado: 'activo' },
                2: { nombre: 'Carmen', apellido: 'López', email: 'carmen.lopez@elbuenamigo.com', telefono: '8765432111', sucursal: '2', estado: 'activo' },
                3: { nombre: 'Sofía', apellido: 'García', email: 'sofia.garcia@elbuenamigo.com', telefono: '1122334455', sucursal: '3', estado: 'licencia' }
            };
            
            const recep = recepcionistas[id];
            document.getElementById('edit-id').value = id;
            document.getElementById('edit-nombre').value = recep.nombre;
            document.getElementById('edit-apellido').value = recep.apellido;
            document.getElementById('edit-email').value = recep.email;
            document.getElementById('edit-telefono').value = recep.telefono;
            document.getElementById('edit-sucursal').value = recep.sucursal;
            document.getElementById('edit-estado').value = recep.estado;
            
            document.getElementById('edit-modal').classList.remove('hidden');
        }

        function viewRecepcionista(id) {
            alert('Ver detalles completos de la recepcionista ' + id);
        }

        function viewSchedule(id) {
            alert('Ver horarios de la recepcionista ' + id);
        }

        function viewPermissions(id) {
            alert('Ver permisos de la recepcionista ' + id);
        }

        function deleteRecepcionista(id) {
            if (confirm('¿Está seguro de que desea eliminar esta recepcionista?')) {
                alert('Recepcionista eliminada');
            }
        }

        function closeEditModal() {
            document.getElementById('edit-modal').classList.add('hidden');
        }

        document.getElementById('edit-form').addEventListener('submit', function(e) {
            e.preventDefault();
            alert('Cambios guardados correctamente');
            closeEditModal();
        });
    </script>
</body>
    <script src="../../js/admin/admin-dashboard.js"></script>
</html>

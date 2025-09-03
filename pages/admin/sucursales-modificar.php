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
    <title>Modificar Sucursal - El Buen Amigo</title>
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
                <h1 class="text-3xl font-light text-black mb-8">Gestionar Sucursales</h1>

                <!-- Barra de búsqueda y filtros -->
                <div class="bg-white rounded-md shadow-md p-6 mb-6">
                    <div class="flex flex-col md:flex-row gap-4">
                        <div class="flex-1">
                            <input type="text" id="search-sucursal" placeholder="Buscar por nombre, código o ciudad..."
                                   class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-vet-blue">
                        </div>
                        <div class="flex gap-2">
                            <select id="filter-estado" class="px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-vet-blue">
                                <option value="">Todos los estados</option>
                                <option value="activo">Activas</option>
                                <option value="inactivo">Inactivas</option>
                            </select>
                            <button class="px-6 py-2 bg-vet-blue text-white rounded-md hover:bg-vet-blue/90 transition-colors">
                                <i class="fas fa-search mr-2"></i>Buscar
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Lista de sucursales -->
                <div class="bg-white rounded-md shadow-md">
                    <div class="px-6 py-4 border-b border-gray-200">
                        <h2 class="text-xl font-medium text-gray-800">Sucursales Registradas</h2>
                    </div>
                    
                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Sucursal</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Dirección</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Contacto</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Estado</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Acciones</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                <!-- Ejemplo de sucursal -->
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div>
                                            <div class="text-sm font-medium text-gray-900">Sucursal Centro</div>
                                            <div class="text-sm text-gray-500">Código: SUC001</div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900">Av. Corrientes 1234</div>
                                        <div class="text-sm text-gray-500">CABA, Buenos Aires</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900">+54 11 1234-5678</div>
                                        <div class="text-sm text-gray-500">centro@elbuenamigo.com</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">
                                            Activa
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium space-x-2">
                                        <button class="text-vet-blue hover:text-vet-blue/70" onclick="editSucursal(1)">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button class="text-green-600 hover:text-green-500" onclick="viewSucursal(1)">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                        <button class="text-red-600 hover:text-red-500" onclick="deleteSucursal(1)">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                                
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div>
                                            <div class="text-sm font-medium text-gray-900">Sucursal Norte</div>
                                            <div class="text-sm text-gray-500">Código: SUC002</div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900">Av. Cabildo 2468</div>
                                        <div class="text-sm text-gray-500">Belgrano, CABA</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900">+54 11 8765-4321</div>
                                        <div class="text-sm text-gray-500">norte@elbuenamigo.com</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-red-100 text-red-800">
                                            Inactiva
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium space-x-2">
                                        <button class="text-vet-blue hover:text-vet-blue/70" onclick="editSucursal(2)">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button class="text-green-600 hover:text-green-500" onclick="viewSucursal(2)">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                        <button class="text-red-600 hover:text-red-500" onclick="deleteSucursal(2)">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    
                    <!-- Paginación -->
                    <div class="bg-white px-4 py-3 flex items-center justify-between border-t border-gray-200 sm:px-6">
                        <div class="flex-1 flex justify-between sm:hidden">
                            <button class="relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
                                Anterior
                            </button>
                            <button class="ml-3 relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
                                Siguiente
                            </button>
                        </div>
                        <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
                            <div>
                                <p class="text-sm text-gray-700">
                                    Mostrando <span class="font-medium">1</span> a <span class="font-medium">2</span> de <span class="font-medium">2</span> resultados
                                </p>
                            </div>
                            <div>
                                <nav class="relative z-0 inline-flex rounded-md shadow-sm -space-x-px">
                                    <button class="relative inline-flex items-center px-2 py-2 rounded-l-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50">
                                        <i class="fas fa-chevron-left"></i>
                                    </button>
                                    <button class="bg-vet-blue border-vet-blue text-white relative inline-flex items-center px-4 py-2 border text-sm font-medium">1</button>
                                    <button class="relative inline-flex items-center px-2 py-2 rounded-r-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50">
                                        <i class="fas fa-chevron-right"></i>
                                    </button>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <!-- Modal de edición -->
    <div id="edit-modal" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50">
        <div class="relative top-20 mx-auto p-5 border w-11/12 max-w-2xl shadow-lg rounded-md bg-white">
            <div class="mt-3">
                <h3 class="text-lg font-medium text-gray-900 mb-4">Editar Sucursal</h3>
                <form id="edit-form">
                    <input type="hidden" id="edit-id" name="id">
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Nombre</label>
                            <input type="text" id="edit-nombre" name="nombre" required
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-vet-blue">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Código</label>
                            <input type="text" id="edit-codigo" name="codigo" required
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-vet-blue">
                        </div>
                        <div class="md:col-span-2">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Dirección</label>
                            <input type="text" id="edit-direccion" name="direccion" required
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-vet-blue">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Teléfono</label>
                            <input type="tel" id="edit-telefono" name="telefono"
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-vet-blue">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Estado</label>
                            <select id="edit-estado" name="estado"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-vet-blue">
                                <option value="1">Activa</option>
                                <option value="0">Inactiva</option>
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
        function editSucursal(id) {
            
            document.getElementById('edit-id').value = id;
            document.getElementById('edit-nombre').value = id === 1 ? 'Sucursal Centro' : 'Sucursal Norte';
            document.getElementById('edit-codigo').value = id === 1 ? 'SUC001' : 'SUC002';
            document.getElementById('edit-direccion').value = id === 1 ? 'Av. Corrientes 1234' : 'Av. Cabildo 2468';
            document.getElementById('edit-telefono').value = id === 1 ? '+54 11 1234-5678' : '+54 11 8765-4321';
            document.getElementById('edit-estado').value = id === 1 ? '1' : '0';
            
            document.getElementById('edit-modal').classList.remove('hidden');
        }

        function viewSucursal(id) {
            alert('Ver detalles de la sucursal ' + id);
        }

        function deleteSucursal(id) {
            if (confirm('¿Está seguro de que desea eliminar esta sucursal?')) {
                alert('Sucursal ' + id + ' eliminada');
                
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

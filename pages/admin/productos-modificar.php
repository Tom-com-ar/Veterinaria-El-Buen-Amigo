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
    <title>Modificar Productos - El Buen Amigo</title>
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
                <!-- Título y filtros -->
                <div class="flex justify-between items-center mb-6">
                    <h1 class="text-3xl font-light text-black">Modificar Productos</h1>
                    <div class="flex space-x-4">
                        <div class="relative">
                            <input type="text" placeholder="Buscar productos..." class="w-80 pl-10 pr-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-vet-blue">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center">
                                <i class="fas fa-search text-gray-400"></i>
                            </div>
                        </div>
                        <select class="px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-vet-blue">
                            <option value="">Todas las categorías</option>
                            <option value="alimentos">Alimentos</option>
                            <option value="medicamentos">Medicamentos</option>
                            <option value="accesorios">Accesorios</option>
                            <option value="juguetes">Juguetes</option>
                            <option value="higiene">Higiene</option>
                        </select>
                    </div>
                </div>

                <!-- Tabla de productos -->
                <div class="bg-white rounded-md shadow-md">
                    <div class="px-6 py-4 border-b border-gray-200">
                        <div class="flex justify-between items-center">
                            <h2 class="text-xl font-medium text-gray-800">Lista de Productos</h2>
                            <div class="flex space-x-2">
                                <button class="px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700 transition-colors" onclick="exportarExcel()">
                                    <i class="fas fa-file-excel mr-2"></i>Excel
                                </button>
                                <button class="px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700 transition-colors" onclick="exportarPDF()">
                                    <i class="fas fa-file-pdf mr-2"></i>PDF
                                </button>
                            </div>
                        </div>
                    </div>
                    
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Producto</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Categoría</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Precio</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Stock</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Estado</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Acciones</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                <!-- Producto 1 -->
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0 h-10 w-10">
                                                <img class="h-10 w-10 rounded-md object-cover" src="../../assets/productos/royal-canin.jpg" alt="">
                                            </div>
                                            <div class="ml-4">
                                                <div class="text-sm font-medium text-gray-900">Royal Canin Adult</div>
                                                <div class="text-sm text-gray-500">Código: RC001</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">Alimentos</span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">$3,250</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        <div class="flex items-center">
                                            <span class="mr-2">45</span>
                                            <span class="px-2 py-1 text-xs bg-green-100 text-green-800 rounded">Disponible</span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Activo</span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        <button onclick="editarProducto(1)" class="text-vet-blue hover:text-vet-blue/80 mr-3">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button onclick="verDetalles(1)" class="text-blue-600 hover:text-blue-800 mr-3">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                        <button onclick="eliminarProducto(1)" class="text-red-600 hover:text-red-800">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </td>
                                </tr>

                                <!-- Producto 2 -->
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0 h-10 w-10">
                                                <div class="h-10 w-10 rounded-md bg-gray-300 flex items-center justify-center">
                                                    <i class="fas fa-pills text-gray-600"></i>
                                                </div>
                                            </div>
                                            <div class="ml-4">
                                                <div class="text-sm font-medium text-gray-900">Antibiótico Amoxicilina</div>
                                                <div class="text-sm text-gray-500">Código: MED001</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">Medicamentos</span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">$850</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        <div class="flex items-center">
                                            <span class="mr-2">8</span>
                                            <span class="px-2 py-1 text-xs bg-yellow-100 text-yellow-800 rounded">Bajo Stock</span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Activo</span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        <button onclick="editarProducto(2)" class="text-vet-blue hover:text-vet-blue/80 mr-3">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button onclick="verDetalles(2)" class="text-blue-600 hover:text-blue-800 mr-3">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                        <button onclick="eliminarProducto(2)" class="text-red-600 hover:text-red-800">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </td>
                                </tr>

                                <!-- Producto 3 -->
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0 h-10 w-10">
                                                <div class="h-10 w-10 rounded-md bg-gray-300 flex items-center justify-center">
                                                    <i class="fas fa-bone text-gray-600"></i>
                                                </div>
                                            </div>
                                            <div class="ml-4">
                                                <div class="text-sm font-medium text-gray-900">Collar Antipulgas</div>
                                                <div class="text-sm text-gray-500">Código: ACC001</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-purple-100 text-purple-800">Accesorios</span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">$1,200</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        <div class="flex items-center">
                                            <span class="mr-2">0</span>
                                            <span class="px-2 py-1 text-xs bg-red-100 text-red-800 rounded">Sin Stock</span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">Inactivo</span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        <button onclick="editarProducto(3)" class="text-vet-blue hover:text-vet-blue/80 mr-3">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button onclick="verDetalles(3)" class="text-blue-600 hover:text-blue-800 mr-3">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                        <button onclick="eliminarProducto(3)" class="text-red-600 hover:text-red-800">
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
                            <button class="relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">Anterior</button>
                            <button class="ml-3 relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">Siguiente</button>
                        </div>
                        <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
                            <div>
                                <p class="text-sm text-gray-700">Mostrando <span class="font-medium">1</span> a <span class="font-medium">3</span> de <span class="font-medium">27</span> productos</p>
                            </div>
                            <div>
                                <nav class="relative z-0 inline-flex rounded-md shadow-sm -space-x-px">
                                    <button class="relative inline-flex items-center px-2 py-2 rounded-l-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50">
                                        <i class="fas fa-chevron-left"></i>
                                    </button>
                                    <button class="bg-vet-blue border-vet-blue text-white relative inline-flex items-center px-4 py-2 border text-sm font-medium">1</button>
                                    <button class="bg-white border-gray-300 text-gray-500 hover:bg-gray-50 relative inline-flex items-center px-4 py-2 border text-sm font-medium">2</button>
                                    <button class="bg-white border-gray-300 text-gray-500 hover:bg-gray-50 relative inline-flex items-center px-4 py-2 border text-sm font-medium">3</button>
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

    <!-- Modal para editar producto -->
    <div id="modalEditarProducto" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden items-center justify-center z-50">
        <div class="bg-white rounded-lg shadow-xl max-w-2xl w-full mx-4 max-h-[90vh] overflow-y-auto">
            <div class="px-6 py-4 border-b border-gray-200">
                <div class="flex justify-between items-center">
                    <h3 class="text-lg font-medium text-gray-900">Editar Producto</h3>
                    <button onclick="cerrarModal()" class="text-gray-400 hover:text-gray-600">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            </div>
            
            <div class="p-6">
                <form id="formEditarProducto">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="md:col-span-2">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Nombre del producto</label>
                            <input type="text" id="edit-nombre" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-vet-blue">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Categoría</label>
                            <select id="edit-categoria" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-vet-blue">
                                <option value="alimentos">Alimentos</option>
                                <option value="medicamentos">Medicamentos</option>
                                <option value="accesorios">Accesorios</option>
                                <option value="juguetes">Juguetes</option>
                                <option value="higiene">Higiene</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Precio</label>
                            <input type="number" id="edit-precio" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-vet-blue">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Stock actual</label>
                            <input type="number" id="edit-stock" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-vet-blue">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Estado</label>
                            <select id="edit-estado" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-vet-blue">
                                <option value="activo">Activo</option>
                                <option value="inactivo">Inactivo</option>
                            </select>
                        </div>

                        <div class="md:col-span-2">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Descripción</label>
                            <textarea id="edit-descripcion" rows="3" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-vet-blue"></textarea>
                        </div>
                    </div>

                    <div class="mt-6 flex justify-end space-x-3">
                        <button type="button" onclick="cerrarModal()" class="px-4 py-2 border border-gray-300 rounded-md text-gray-700 hover:bg-gray-50">Cancelar</button>
                        <button type="submit" class="px-4 py-2 bg-vet-blue text-white rounded-md hover:bg-vet-blue/90">Guardar cambios</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function editarProducto(id) {
            document.getElementById('modalEditarProducto').classList.remove('hidden');
            document.getElementById('modalEditarProducto').classList.add('flex');
            // Aquí cargarías los datos del producto específico
        }

        function cerrarModal() {
            document.getElementById('modalEditarProducto').classList.add('hidden');
            document.getElementById('modalEditarProducto').classList.remove('flex');
        }

        function verDetalles(id) {
            // Implementar vista de detalles
            alert('Ver detalles del producto ID: ' + id);
        }

        function eliminarProducto(id) {
            if (confirm('¿Está seguro de que desea eliminar este producto?')) {
                // Implementar eliminación
                alert('Producto eliminado');
            }
        }

        function exportarExcel() {
            alert('Exportando a Excel...');
        }

        function exportarPDF() {
            alert('Exportando a PDF...');
        }

        // Manejar envío del formulario
        document.getElementById('formEditarProducto').addEventListener('submit', function(e) {
            e.preventDefault();
            // Aquí enviarías los datos al servidor
            alert('Producto actualizado correctamente');
            cerrarModal();
        });
    </script>
</body>
    <script src="../../js/admin/admin-dashboard.js"></script>
</html>

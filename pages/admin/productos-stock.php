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
    <title>Ajuste de Stock - El Buen Amigo</title>
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
                <div class="flex justify-between items-center mb-6">
                    <h1 class="text-3xl font-light text-black">Ajuste de Stock</h1>
                    <button onclick="mostrarHistorialAjustes()" class="px-4 py-2 bg-gray-600 text-white rounded-md hover:bg-gray-700 transition-colors">
                        <i class="fas fa-history mr-2"></i>Historial de Ajustes
                    </button>
                </div>

                <!-- Tarjetas de resumen -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                    <div class="bg-white p-6 rounded-md shadow-md">
                        <div class="flex items-center">
                            <div class="p-3 rounded-full bg-red-100 text-red-600">
                                <i class="fas fa-exclamation-triangle"></i>
                            </div>
                            <div class="ml-4">
                                <h3 class="text-lg font-semibold text-gray-800">Stock Crítico</h3>
                                <p class="text-2xl font-bold text-red-600">12</p>
                                <p class="text-sm text-gray-600">productos por debajo del mínimo</p>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white p-6 rounded-md shadow-md">
                        <div class="flex items-center">
                            <div class="p-3 rounded-full bg-yellow-100 text-yellow-600">
                                <i class="fas fa-exclamation"></i>
                            </div>
                            <div class="ml-4">
                                <h3 class="text-lg font-semibold text-gray-800">Stock Bajo</h3>
                                <p class="text-2xl font-bold text-yellow-600">27</p>
                                <p class="text-sm text-gray-600">productos con stock limitado</p>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white p-6 rounded-md shadow-md">
                        <div class="flex items-center">
                            <div class="p-3 rounded-full bg-green-100 text-green-600">
                                <i class="fas fa-check-circle"></i>
                            </div>
                            <div class="ml-4">
                                <h3 class="text-lg font-semibold text-gray-800">Stock Normal</h3>
                                <p class="text-2xl font-bold text-green-600">156</p>
                                <p class="text-sm text-gray-600">productos con stock suficiente</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Filtros y búsqueda -->
                <div class="bg-white rounded-md shadow-md p-6 mb-6">
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                        <div>
                            <input type="text" placeholder="Buscar producto..." class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-vet-blue">
                        </div>
                        <div>
                            <select class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-vet-blue">
                                <option value="">Todas las categorías</option>
                                <option value="alimentos">Alimentos</option>
                                <option value="medicamentos">Medicamentos</option>
                                <option value="accesorios">Accesorios</option>
                            </select>
                        </div>
                        <div>
                            <select class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-vet-blue">
                                <option value="">Todos los estados</option>
                                <option value="critico">Stock Crítico</option>
                                <option value="bajo">Stock Bajo</option>
                                <option value="normal">Stock Normal</option>
                            </select>
                        </div>
                        <div>
                            <button class="w-full px-4 py-2 bg-vet-blue text-white rounded-md hover:bg-vet-blue/90 transition-colors">
                                <i class="fas fa-search mr-2"></i>Filtrar
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Tabla de productos para ajuste -->
                <div class="bg-white rounded-md shadow-md">
                    <div class="px-6 py-4 border-b border-gray-200">
                        <div class="flex justify-between items-center">
                            <h2 class="text-xl font-medium text-gray-800">Productos - Control de Inventario</h2>
                            <button onclick="guardarTodosLosAjustes()" class="px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700 transition-colors">
                                <i class="fas fa-save mr-2"></i>Guardar Todos los Ajustes
                            </button>
                        </div>
                    </div>
                    
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Producto</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Stock Actual</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Stock Mínimo</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Ajuste</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nuevo Stock</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Motivo</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Acciones</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                <!-- Producto 1 - Stock crítico -->
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0 h-10 w-10">
                                                <div class="h-10 w-10 rounded-md bg-red-100 flex items-center justify-center">
                                                    <i class="fas fa-pills text-red-600"></i>
                                                </div>
                                            </div>
                                            <div class="ml-4">
                                                <div class="text-sm font-medium text-gray-900">Antibiótico Amoxicilina</div>
                                                <div class="text-sm text-gray-500">Código: MED001</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="px-2 py-1 text-xs bg-red-100 text-red-800 rounded font-medium">2 unidades</span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">10</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center space-x-2">
                                            <select class="px-2 py-1 text-sm border border-gray-300 rounded" onchange="calcularNuevoStock(this, 1)">
                                                <option value="add">Entrada (+)</option>
                                                <option value="subtract">Salida (-)</option>
                                            </select>
                                            <input type="number" id="ajuste-1" class="w-20 px-2 py-1 text-sm border border-gray-300 rounded" value="0" min="0" onchange="calcularNuevoStock(this, 1)">
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span id="nuevo-stock-1" class="text-sm font-medium text-gray-900">2</span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <select class="px-3 py-1 text-sm border border-gray-300 rounded">
                                            <option value="recepcion">Recepción de mercancía</option>
                                            <option value="devolucion">Devolución</option>
                                            <option value="perdida">Pérdida/Daño</option>
                                            <option value="vencimiento">Vencimiento</option>
                                            <option value="inventario">Ajuste de inventario</option>
                                        </select>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <button onclick="guardarAjuste(1)" class="px-3 py-1 bg-vet-blue text-white text-sm rounded hover:bg-vet-blue/90">
                                            <i class="fas fa-save mr-1"></i>Guardar
                                        </button>
                                    </td>
                                </tr>

                                <!-- Producto 2 - Stock bajo -->
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0 h-10 w-10">
                                                <div class="h-10 w-10 rounded-md bg-yellow-100 flex items-center justify-center">
                                                    <i class="fas fa-bone text-yellow-600"></i>
                                                </div>
                                            </div>
                                            <div class="ml-4">
                                                <div class="text-sm font-medium text-gray-900">Collar Antipulgas</div>
                                                <div class="text-sm text-gray-500">Código: ACC001</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="px-2 py-1 text-xs bg-yellow-100 text-yellow-800 rounded font-medium">8 unidades</span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">15</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center space-x-2">
                                            <select class="px-2 py-1 text-sm border border-gray-300 rounded" onchange="calcularNuevoStock(this, 2)">
                                                <option value="add">Entrada (+)</option>
                                                <option value="subtract">Salida (-)</option>
                                            </select>
                                            <input type="number" id="ajuste-2" class="w-20 px-2 py-1 text-sm border border-gray-300 rounded" value="0" min="0" onchange="calcularNuevoStock(this, 2)">
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span id="nuevo-stock-2" class="text-sm font-medium text-gray-900">8</span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <select class="px-3 py-1 text-sm border border-gray-300 rounded">
                                            <option value="recepcion">Recepción de mercancía</option>
                                            <option value="devolucion">Devolución</option>
                                            <option value="perdida">Pérdida/Daño</option>
                                            <option value="vencimiento">Vencimiento</option>
                                            <option value="inventario">Ajuste de inventario</option>
                                        </select>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <button onclick="guardarAjuste(2)" class="px-3 py-1 bg-vet-blue text-white text-sm rounded hover:bg-vet-blue/90">
                                            <i class="fas fa-save mr-1"></i>Guardar
                                        </button>
                                    </td>
                                </tr>

                                <!-- Producto 3 - Stock normal -->
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0 h-10 w-10">
                                                <div class="h-10 w-10 rounded-md bg-green-100 flex items-center justify-center">
                                                    <i class="fas fa-drumstick-bite text-green-600"></i>
                                                </div>
                                            </div>
                                            <div class="ml-4">
                                                <div class="text-sm font-medium text-gray-900">Royal Canin Adult</div>
                                                <div class="text-sm text-gray-500">Código: RC001</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="px-2 py-1 text-xs bg-green-100 text-green-800 rounded font-medium">45 unidades</span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">20</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center space-x-2">
                                            <select class="px-2 py-1 text-sm border border-gray-300 rounded" onchange="calcularNuevoStock(this, 3)">
                                                <option value="add">Entrada (+)</option>
                                                <option value="subtract">Salida (-)</option>
                                            </select>
                                            <input type="number" id="ajuste-3" class="w-20 px-2 py-1 text-sm border border-gray-300 rounded" value="0" min="0" onchange="calcularNuevoStock(this, 3)">
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span id="nuevo-stock-3" class="text-sm font-medium text-gray-900">45</span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <select class="px-3 py-1 text-sm border border-gray-300 rounded">
                                            <option value="recepcion">Recepción de mercancía</option>
                                            <option value="devolucion">Devolución</option>
                                            <option value="perdida">Pérdida/Daño</option>
                                            <option value="vencimiento">Vencimiento</option>
                                            <option value="inventario">Ajuste de inventario</option>
                                        </select>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <button onclick="guardarAjuste(3)" class="px-3 py-1 bg-vet-blue text-white text-sm rounded hover:bg-vet-blue/90">
                                            <i class="fas fa-save mr-1"></i>Guardar
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

    <script>
        // Datos de stock inicial para cálculos
        const stockActual = {
            1: 2,
            2: 8,
            3: 45
        };

        function calcularNuevoStock(element, productId) {
            const row = element.closest('tr');
            const tipoSelect = row.querySelector('select');
            const cantidadInput = row.querySelector(`#ajuste-${productId}`);
            const nuevoStockSpan = row.querySelector(`#nuevo-stock-${productId}`);
            
            const tipo = tipoSelect.value;
            const cantidad = parseInt(cantidadInput.value) || 0;
            let nuevoStock = stockActual[productId];
            
            if (tipo === 'add') {
                nuevoStock += cantidad;
            } else if (tipo === 'subtract') {
                nuevoStock = Math.max(0, nuevoStock - cantidad);
            }
            
            nuevoStockSpan.textContent = nuevoStock;
            
            // Cambiar color según el nivel de stock
            nuevoStockSpan.classList.remove('text-red-600', 'text-yellow-600', 'text-green-600');
            if (nuevoStock < 5) {
                nuevoStockSpan.classList.add('text-red-600');
            } else if (nuevoStock < 15) {
                nuevoStockSpan.classList.add('text-yellow-600');
            } else {
                nuevoStockSpan.classList.add('text-green-600');
            }
        }

        function guardarAjuste(productId) {
            const row = document.querySelector(`#ajuste-${productId}`).closest('tr');
            const tipo = row.querySelector('select').value;
            const cantidad = row.querySelector(`#ajuste-${productId}`).value;
            const motivo = row.querySelector('td:nth-child(6) select').value;
            const nuevoStock = row.querySelector(`#nuevo-stock-${productId}`).textContent;
            
            if (cantidad == 0) {
                alert('Debe ingresar una cantidad para el ajuste');
                return;
            }
            
            // Aquí harías la petición AJAX al servidor
            alert(`Ajuste guardado:\nProducto ID: ${productId}\nTipo: ${tipo}\nCantidad: ${cantidad}\nNuevo Stock: ${nuevoStock}\nMotivo: ${motivo}`);
            
            // Actualizar el stock actual para futuros cálculos
            stockActual[productId] = parseInt(nuevoStock);
            
            // Resetear el formulario de ajuste
            row.querySelector(`#ajuste-${productId}`).value = '0';
            calcularNuevoStock(row.querySelector(`#ajuste-${productId}`), productId);
        }

        function guardarTodosLosAjustes() {
            const filasConAjustes = [];
            
            // Buscar todas las filas que tienen ajustes pendientes
            for (let i = 1; i <= 3; i++) {
                const input = document.querySelector(`#ajuste-${i}`);
                if (input && input.value > 0) {
                    filasConAjustes.push(i);
                }
            }
            
            if (filasConAjustes.length === 0) {
                alert('No hay ajustes pendientes para guardar');
                return;
            }
            
            if (confirm(`¿Guardar ${filasConAjustes.length} ajuste(s) de stock?`)) {
                filasConAjustes.forEach(id => guardarAjuste(id));
            }
        }

        function mostrarHistorialAjustes() {
            // Aquí abrirías un modal o redirigirias a una página de historial
            alert('Mostrando historial de ajustes de stock...');
        }
    </script>
</body>
    <script src="../../js/admin/admin-dashboard.js"></script>
</html>

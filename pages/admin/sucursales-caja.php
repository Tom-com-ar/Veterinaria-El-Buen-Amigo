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
    <title>Caja Registradora por Sucursal - El Buen Amigo</title>
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
                <h1 class="text-3xl font-light text-black mb-8">Gestión de Cajas por Sucursal</h1>

                <!-- Filtros -->
                <div class="bg-white rounded-md shadow-md p-6 mb-6">
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                        <div>
                            <label for="sucursal-filter" class="block text-sm font-medium text-gray-700 mb-2">Sucursal</label>
                            <select id="sucursal-filter" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-vet-blue">
                                <option value="">Todas las sucursales</option>
                                <option value="1">Sucursal Centro</option>
                                <option value="2">Sucursal Norte</option>
                                <option value="3">Sucursal Sur</option>
                            </select>
                        </div>
                        <div>
                            <label for="fecha-desde" class="block text-sm font-medium text-gray-700 mb-2">Desde</label>
                            <input type="date" id="fecha-desde" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-vet-blue">
                        </div>
                        <div>
                            <label for="fecha-hasta" class="block text-sm font-medium text-gray-700 mb-2">Hasta</label>
                            <input type="date" id="fecha-hasta" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-vet-blue">
                        </div>
                        <div class="flex items-end">
                            <button onclick="filtrarCajas()" class="w-full px-4 py-2 bg-vet-blue text-white rounded-md hover:bg-vet-blue/90 transition-colors">
                                <i class="fas fa-search mr-2"></i>Filtrar
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Resumen general -->
                <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-6">
                    <div class="bg-white rounded-md shadow-md p-6">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm font-medium text-gray-600">Cajas Activas</p>
                                <p class="text-2xl font-bold text-green-600">3</p>
                            </div>
                            <div class="h-12 w-12 bg-green-100 rounded-lg flex items-center justify-center">
                                <i class="fas fa-cash-register text-green-600 text-xl"></i>
                            </div>
                        </div>
                    </div>
                    
                    <div class="bg-white rounded-md shadow-md p-6">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm font-medium text-gray-600">Ingresos del Día</p>
                                <p class="text-2xl font-bold text-blue-600">$45,230</p>
                            </div>
                            <div class="h-12 w-12 bg-blue-100 rounded-lg flex items-center justify-center">
                                <i class="fas fa-arrow-up text-blue-600 text-xl"></i>
                            </div>
                        </div>
                    </div>
                    
                    <div class="bg-white rounded-md shadow-md p-6">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm font-medium text-gray-600">Egresos del Día</p>
                                <p class="text-2xl font-bold text-red-600">$8,450</p>
                            </div>
                            <div class="h-12 w-12 bg-red-100 rounded-lg flex items-center justify-center">
                                <i class="fas fa-arrow-down text-red-600 text-xl"></i>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white rounded-md shadow-md p-6">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm font-medium text-gray-600">Balance Total</p>
                                <p class="text-2xl font-bold text-purple-600">$36,780</p>
                            </div>
                            <div class="h-12 w-12 bg-purple-100 rounded-lg flex items-center justify-center">
                                <i class="fas fa-balance-scale text-purple-600 text-xl"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Cajas por sucursal -->
                <div class="space-y-6">
                    <!-- Sucursal Centro -->
                    <div class="bg-white rounded-md shadow-md">
                        <div class="px-6 py-4 border-b border-gray-200">
                            <div class="flex justify-between items-center">
                                <h2 class="text-xl font-medium text-gray-800">Sucursal Centro</h2>
                                <div class="flex space-x-3">
                                    <button onclick="verMovimientos('centro')" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition-colors">
                                        <i class="fas fa-list mr-2"></i>Ver Movimientos
                                    </button>
                                    <button onclick="agregarMovimiento('centro')" class="px-4 py-2 bg-orange-600 text-white rounded-md hover:bg-orange-700 transition-colors">
                                        <i class="fas fa-plus mr-2"></i>Añadir Movimiento
                                    </button>
                                </div>
                            </div>
                        </div>
                        
                        <div class="p-6">
                            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-4">
                                <div class="text-center">
                                    <p class="text-sm text-gray-600">Estado</p>
                                    <span class="inline-flex px-3 py-1 text-sm font-semibold rounded-full bg-green-100 text-green-800">
                                        Activa
                                    </span>
                                </div>
                                <div class="text-center">
                                    <p class="text-sm text-gray-600">Monto Inicial</p>
                                    <p class="text-lg font-bold text-gray-900">$5,000</p>
                                </div>
                                <div class="text-center">
                                    <p class="text-sm text-gray-600">Ingresos</p>
                                    <p class="text-lg font-bold text-green-600">+$18,250</p>
                                </div>
                                <div class="text-center">
                                    <p class="text-sm text-gray-600">Egresos</p>
                                    <p class="text-lg font-bold text-red-600">-$2,500</p>
                                </div>
                            </div>
                            <div class="bg-gray-50 rounded-lg p-4">
                                <div class="flex justify-between items-center">
                                    <span class="text-sm font-medium text-gray-600">Saldo Actual:</span>
                                    <span class="text-xl font-bold text-blue-600">$20,750</span>
                                </div>
                            </div>
                            <div class="flex justify-end mt-4">
                                <button onclick="cerrarCaja('centro')" class="px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700 transition-colors">
                                    <i class="fas fa-lock mr-2"></i>Cerrar Caja
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Sucursal Norte -->
                    <div class="bg-white rounded-md shadow-md">
                        <div class="px-6 py-4 border-b border-gray-200">
                            <div class="flex justify-between items-center">
                                <h2 class="text-xl font-medium text-gray-800">Sucursal Norte</h2>
                                <div class="flex space-x-3">
                                    <button onclick="verMovimientos('norte')" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition-colors">
                                        <i class="fas fa-list mr-2"></i>Ver Movimientos
                                    </button>
                                    <button onclick="agregarMovimiento('norte')" class="px-4 py-2 bg-orange-600 text-white rounded-md hover:bg-orange-700 transition-colors">
                                        <i class="fas fa-plus mr-2"></i>Añadir Movimiento
                                    </button>
                                </div>
                            </div>
                        </div>
                        
                        <div class="p-6">
                            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-4">
                                <div class="text-center">
                                    <p class="text-sm text-gray-600">Estado</p>
                                    <span class="inline-flex px-3 py-1 text-sm font-semibold rounded-full bg-green-100 text-green-800">
                                        Activa
                                    </span>
                                </div>
                                <div class="text-center">
                                    <p class="text-sm text-gray-600">Monto Inicial</p>
                                    <p class="text-lg font-bold text-gray-900">$3,500</p>
                                </div>
                                <div class="text-center">
                                    <p class="text-sm text-gray-600">Ingresos</p>
                                    <p class="text-lg font-bold text-green-600">+$15,230</p>
                                </div>
                                <div class="text-center">
                                    <p class="text-sm text-gray-600">Egresos</p>
                                    <p class="text-lg font-bold text-red-600">-$1,200</p>
                                </div>
                            </div>
                            <div class="bg-gray-50 rounded-lg p-4">
                                <div class="flex justify-between items-center">
                                    <span class="text-sm font-medium text-gray-600">Saldo Actual:</span>
                                    <span class="text-xl font-bold text-blue-600">$17,530</span>
                                </div>
                            </div>
                            <div class="flex justify-end mt-4">
                                <button onclick="cerrarCaja('norte')" class="px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700 transition-colors">
                                    <i class="fas fa-lock mr-2"></i>Cerrar Caja
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Sucursal Sur -->
                    <div class="bg-white rounded-md shadow-md">
                        <div class="px-6 py-4 border-b border-gray-200">
                            <div class="flex justify-between items-center">
                                <h2 class="text-xl font-medium text-gray-800">Sucursal Sur</h2>
                                <div class="flex space-x-3">
                                    <button onclick="inicializarCaja('sur')" class="px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700 transition-colors">
                                        <i class="fas fa-power-off mr-2"></i>Inicializar Caja
                                    </button>
                                </div>
                            </div>
                        </div>
                        
                        <div class="p-6">
                            <div class="text-center py-8">
                                <div class="h-16 w-16 bg-gray-200 rounded-full mx-auto mb-4 flex items-center justify-center">
                                    <i class="fas fa-cash-register text-gray-400 text-2xl"></i>
                                </div>
                                <p class="text-gray-500">Caja no inicializada</p>
                                <p class="text-sm text-gray-400">Haga clic en "Inicializar Caja" para comenzar</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <!-- Modal para abrir caja -->
    <div id="abrir-caja-modal" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50">
        <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
            <div class="mt-3">
                <h3 class="text-lg font-medium text-gray-900 mb-4">Abrir Caja Registradora</h3>
                <form id="abrir-caja-form">
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Usuario Responsable</label>
                        <select id="usuario-caja" name="usuario" required
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-vet-blue">
                            <option value="">-- Seleccionar usuario --</option>
                            <option value="1">Ana Martínez</option>
                            <option value="2">Carlos López</option>
                            <option value="3">María García</option>
                        </select>
                    </div>
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Monto Inicial ($)</label>
                        <input type="number" id="monto-inicial" name="monto_inicial" step="0.01" min="0" value="5000"
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-vet-blue">
                    </div>
                    
                    <div class="flex justify-end space-x-3">
                        <button type="button" onclick="closeAbrirCajaModal()"
                                class="px-4 py-2 bg-gray-300 text-gray-700 rounded-md hover:bg-gray-400 transition-colors">
                            Cancelar
                        </button>
                        <button type="submit"
                                class="px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700 transition-colors">
                            <i class="fas fa-unlock mr-2"></i>Abrir Caja
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal para ver movimientos -->
    <div id="modalMovimientos" class="fixed inset-0 bg-gray-600 bg-opacity-50 z-50 hidden">
        <div class="flex items-center justify-center min-h-screen">
            <div class="bg-white rounded-lg shadow-xl max-w-6xl w-full mx-4 max-h-[90vh] overflow-y-auto">
            <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center">
                <h2 id="modalTituloMovimientos" class="text-xl font-medium text-gray-800">Movimientos de Caja</h2>
                <button onclick="cerrarModal('modalMovimientos')" class="text-gray-400 hover:text-gray-600">
                    <i class="fas fa-times text-xl"></i>
                </button>
            </div>
            <div class="p-6">
                <div class="mb-4 flex justify-between items-center">
                    <div class="flex space-x-4">
                        <select class="px-3 py-2 border border-gray-300 rounded-md">
                            <option>Todos los movimientos</option>
                            <option>Ingresos</option>
                            <option>Egresos</option>
                            <option>Ventas</option>
                            <option>Servicios</option>
                        </select>
                        <input type="date" class="px-3 py-2 border border-gray-300 rounded-md">
                    </div>
                    <div class="text-sm text-gray-500">
                        Showing 15 of 47 movimientos
                    </div>
                </div>
                
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Hora</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Tipo</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Descripción</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Monto</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Usuario</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">14:32</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">
                                        Venta
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-900">Venta de productos - Factura #001234</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-green-600">+$850.00</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Ana Martínez</td>
                            </tr>
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">13:45</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-blue-100 text-blue-800">
                                        Servicio
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-900">Consulta veterinaria - Dr. García</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-green-600">+$1,200.00</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Carlos López</td>
                            </tr>
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">12:30</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-red-100 text-red-800">
                                        Egreso
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-900">Retiro para gastos menores</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-red-600">-$500.00</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Admin Sistema</td>
                            </tr>
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">11:15</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-purple-100 text-purple-800">
                                        Depósito
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-900">Depósito adicional de efectivo</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-green-600">+$2,000.00</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Ana Martínez</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal para agregar movimiento -->
    <div id="modalAgregarMovimiento" class="fixed inset-0 bg-gray-600 bg-opacity-50 z-50 hidden">
        <div class="flex items-center justify-center min-h-screen">
            <div class="bg-white rounded-lg shadow-xl max-w-md w-full mx-4">
            <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center">
                <h2 class="text-xl font-medium text-gray-800">Agregar Movimiento</h2>
                <button onclick="cerrarModal('modalAgregarMovimiento')" class="text-gray-400 hover:text-gray-600">
                    <i class="fas fa-times text-xl"></i>
                </button>
            </div>
            <form class="p-6 space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Tipo de Movimiento</label>
                    <select class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent">
                        <option value="">Seleccionar tipo</option>
                        <option value="ingreso">Ingreso de Dinero</option>
                        <option value="egreso">Egreso de Dinero</option>
                        <option value="venta">Venta de Producto</option>
                        <option value="servicio">Pago de Servicio</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Monto</label>
                    <input type="number" step="0.01" placeholder="0.00" 
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Descripción</label>
                    <textarea rows="3" placeholder="Descripción del movimiento..."
                              class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent"></textarea>
                </div>
                <div class="flex justify-end space-x-3 pt-4">
                    <button type="button" onclick="cerrarModal('modalAgregarMovimiento')" 
                            class="px-4 py-2 text-gray-600 border border-gray-300 rounded-md hover:bg-gray-50 transition-colors">
                        Cancelar
                    </button>
                    <button type="submit" style="display: inline-block !important;"
                            class="px-4 py-2 bg-orange-600 text-white rounded-md hover:bg-orange-700 transition-colors">
                        Agregar Movimiento
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal para inicializar caja -->
    <div id="modalInicializarCaja" class="fixed inset-0 bg-gray-600 bg-opacity-50 z-50 hidden">
        <div class="flex items-center justify-center min-h-screen">
            <div class="bg-white rounded-lg shadow-xl max-w-md w-full mx-4">
            <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center">
                <h2 class="text-xl font-medium text-gray-800">Inicializar Caja</h2>
                <button onclick="cerrarModal('modalInicializarCaja')" class="text-gray-400 hover:text-gray-600">
                    <i class="fas fa-times text-xl"></i>
                </button>
            </div>
            <form class="p-6 space-y-4">
                <div class="text-center mb-4">
                    <div class="h-16 w-16 bg-green-100 rounded-full mx-auto mb-2 flex items-center justify-center">
                        <i class="fas fa-cash-register text-green-600 text-2xl"></i>
                    </div>
                    <p class="text-gray-600">Inicializar caja para <span id="sucursalNombre" class="font-semibold">Sucursal</span></p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Monto Inicial</label>
                    <input type="number" step="0.01" placeholder="5000.00" value="5000.00"
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Usuario Responsable</label>
                    <select class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent">
                        <option value="">Seleccionar usuario</option>
                        <option value="1">Ana Martínez - Recepcionista</option>
                        <option value="2">Carlos López - Recepcionista</option>
                        <option value="3">María García - Administradora</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Observaciones</label>
                    <textarea rows="2" placeholder="Observaciones adicionales (opcional)..."
                              class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent"></textarea>
                </div>
                <div class="flex justify-end space-x-3 pt-4">
                    <button type="button" onclick="cerrarModal('modalInicializarCaja')" 
                            class="px-4 py-2 text-gray-600 border border-gray-300 rounded-md hover:bg-gray-50 transition-colors">
                        Cancelar
                    </button>
                    <button type="submit" style="display: inline-block !important;"
                            class="px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700 transition-colors">
                        <i class="fas fa-power-off mr-2"></i>Inicializar Caja
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal para arqueo de caja (mantener el original también) -->
    <div id="arqueo-modal" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50">
        <div class="relative top-10 mx-auto p-5 border w-11/12 max-w-2xl shadow-lg rounded-md bg-white">
            <div class="mt-3">
                <h3 class="text-lg font-medium text-gray-900 mb-4">Arqueo de Caja</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <h4 class="font-medium text-gray-800 mb-3">Sistema</h4>
                        <div class="space-y-2 text-sm">
                            <div class="flex justify-between">
                                <span>Monto inicial:</span>
                                <span>$5,000.00</span>
                            </div>
                            <div class="flex justify-between">
                                <span>Ventas en efectivo:</span>
                                <span>$15,230.00</span>
                            </div>
                            <div class="flex justify-between">
                                <span>Ventas con tarjeta:</span>
                                <span>$8,450.00</span>
                            </div>
                            <div class="flex justify-between font-medium border-t pt-2">
                                <span>Total esperado:</span>
                                <span>$20,230.00</span>
                            </div>
                        </div>
                    </div>
                    
                    <div>
                        <h4 class="font-medium text-gray-800 mb-3">Conteo Real</h4>
                        <div class="space-y-2">
                            <input type="number" placeholder="Efectivo contado" step="0.01"
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md text-sm">
                            <div class="text-sm text-gray-600 mt-2">
                                <div class="flex justify-between">
                                    <span>Diferencia:</span>
                                    <span id="diferencia" class="font-medium">$0.00</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="flex justify-end space-x-3 mt-6">
                    <button type="button" onclick="closeArqueoModal()"
                            class="px-4 py-2 bg-gray-300 text-gray-700 rounded-md hover:bg-gray-400 transition-colors">
                        Cerrar
                    </button>
                    <button type="button" onclick="imprimirArqueo()"
                            class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition-colors">
                        <i class="fas fa-print mr-2"></i>Imprimir
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Funciones para el nuevo sistema
        function verMovimientos(sucursal) {
            document.getElementById('modalTituloMovimientos').textContent = `Movimientos - Sucursal ${sucursal.charAt(0).toUpperCase() + sucursal.slice(1)}`;
            const modal = document.getElementById('modalMovimientos');
            modal.classList.remove('hidden');
            // Mostrar el flex container
            if (modal.firstElementChild) {
                modal.firstElementChild.style.display = 'flex';
            }
        }

        function agregarMovimiento(sucursal) {
            const modal = document.getElementById('modalAgregarMovimiento');
            modal.classList.remove('hidden');
            // Mostrar el flex container
            if (modal.firstElementChild) {
                modal.firstElementChild.style.display = 'flex';
            }
        }

        function inicializarCaja(sucursal) {
            document.getElementById('sucursalNombre').textContent = `Sucursal ${sucursal.charAt(0).toUpperCase() + sucursal.slice(1)}`;
            const modal = document.getElementById('modalInicializarCaja');
            modal.classList.remove('hidden');
            // Mostrar el flex container
            if (modal.firstElementChild) {
                modal.firstElementChild.style.display = 'flex';
            }
        }

        function cerrarCaja(sucursal) {
            if (confirm(`¿Está seguro de que desea cerrar la caja de la Sucursal ${sucursal.charAt(0).toUpperCase() + sucursal.slice(1)}?`)) {
                alert('Procediendo con el cierre de caja...');
            }
        }

        function cerrarModal(modalId) {
            document.getElementById(modalId).classList.add('hidden');
            // Ocultar el flex container también
            const modal = document.getElementById(modalId);
            if (modal && modal.firstElementChild) {
                modal.firstElementChild.style.display = 'none';
            }
        }

        // Funciones legacy para el sistema anterior (si se necesitan)
        function abrirCaja(sucursal) {
            document.getElementById('abrir-caja-modal').classList.remove('hidden');
        }

        function abrirCajaEspecifica(cajaId) {
            document.getElementById('abrir-caja-modal').classList.remove('hidden');
        }

        function closeAbrirCajaModal() {
            document.getElementById('abrir-caja-modal').classList.add('hidden');
        }

        function verDetalleCaja(cajaId) {
            alert('Ver detalle de caja ' + cajaId);
        }

        function arquearCaja(cajaId) {
            document.getElementById('arqueo-modal').classList.remove('hidden');
        }

        function closeArqueoModal() {
            document.getElementById('arqueo-modal').classList.add('hidden');
        }

        function imprimirArqueo() {
            alert('Imprimiendo arqueo de caja...');
        }

        function filtrarCajas() {
            alert('Aplicando filtros...');
        }

        // Cerrar modales al hacer clic fuera de ellos
        document.addEventListener('click', function(event) {
            const modals = ['modalMovimientos', 'modalAgregarMovimiento', 'modalInicializarCaja'];
            modals.forEach(modalId => {
                const modal = document.getElementById(modalId);
                if (modal && event.target === modal) {
                    cerrarModal(modalId);
                }
            });
        });

        // Manejar formulario de apertura legacy
        const abrirCajaForm = document.getElementById('abrir-caja-form');
        if (abrirCajaForm) {
            abrirCajaForm.addEventListener('submit', function(e) {
                e.preventDefault();
                alert('Caja abierta correctamente');
                closeAbrirCajaModal();
            });
        }
    </script>
</body>
    <script src="../../js/admin/admin-dashboard.js"></script>
</html>

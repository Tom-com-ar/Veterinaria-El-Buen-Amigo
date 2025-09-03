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
    <title>Estadísticas por Sucursal - El Buen Amigo</title>
    <link href="../../dist/output.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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
                <h1 class="text-3xl font-light text-black mb-8">Estadísticas por Sucursal</h1>

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
                            <label for="periodo-filter" class="block text-sm font-medium text-gray-700 mb-2">Período</label>
                            <select id="periodo-filter" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-vet-blue">
                                <option value="hoy">Hoy</option>
                                <option value="semana">Esta semana</option>
                                <option value="mes" selected>Este mes</option>
                                <option value="trimestre">Este trimestre</option>
                                <option value="ano">Este año</option>
                                <option value="personalizado">Personalizado</option>
                            </select>
                        </div>
                        <div>
                            <label for="fecha-desde" class="block text-sm font-medium text-gray-700 mb-2">Desde</label>
                            <input type="date" id="fecha-desde" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-vet-blue" disabled>
                        </div>
                        <div class="flex items-end">
                            <button onclick="actualizarEstadisticas()" class="w-full px-4 py-2 bg-vet-blue text-white rounded-md hover:bg-vet-blue/90 transition-colors">
                                <i class="fas fa-chart-bar mr-2"></i>Actualizar
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Métricas generales -->
                <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-6">
                    <div class="bg-white rounded-md shadow-md p-6">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm font-medium text-gray-600">Ingresos Totales</p>
                                <p class="text-2xl font-bold text-green-600">$285,450</p>
                                <p class="text-xs text-green-500 flex items-center mt-1">
                                    <i class="fas fa-arrow-up mr-1"></i>+15.3% vs mes anterior
                                </p>
                            </div>
                            <div class="h-12 w-12 bg-green-100 rounded-lg flex items-center justify-center">
                                <i class="fas fa-dollar-sign text-green-600 text-xl"></i>
                            </div>
                        </div>
                    </div>
                    
                    <div class="bg-white rounded-md shadow-md p-6">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm font-medium text-gray-600">Consultas</p>
                                <p class="text-2xl font-bold text-blue-600">1,247</p>
                                <p class="text-xs text-blue-500 flex items-center mt-1">
                                    <i class="fas fa-arrow-up mr-1"></i>+8.7% vs mes anterior
                                </p>
                            </div>
                            <div class="h-12 w-12 bg-blue-100 rounded-lg flex items-center justify-center">
                                <i class="fas fa-stethoscope text-blue-600 text-xl"></i>
                            </div>
                        </div>
                    </div>
                    
                    <div class="bg-white rounded-md shadow-md p-6">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm font-medium text-gray-600">Nuevos Clientes</p>
                                <p class="text-2xl font-bold text-purple-600">156</p>
                                <p class="text-xs text-purple-500 flex items-center mt-1">
                                    <i class="fas fa-arrow-up mr-1"></i>+22.1% vs mes anterior
                                </p>
                            </div>
                            <div class="h-12 w-12 bg-purple-100 rounded-lg flex items-center justify-center">
                                <i class="fas fa-user-plus text-purple-600 text-xl"></i>
                            </div>
                        </div>
                    </div>
                    
                    <div class="bg-white rounded-md shadow-md p-6">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm font-medium text-gray-600">Satisfacción</p>
                                <p class="text-2xl font-bold text-yellow-600">4.8/5</p>
                                <p class="text-xs text-yellow-500 flex items-center mt-1">
                                    <i class="fas fa-arrow-up mr-1"></i>+0.2 vs mes anterior
                                </p>
                            </div>
                            <div class="h-12 w-12 bg-yellow-100 rounded-lg flex items-center justify-center">
                                <i class="fas fa-star text-yellow-600 text-xl"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Gráficos -->
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
                    <!-- Gráfico de ingresos por sucursal -->
                    <div class="bg-white rounded-md shadow-md p-6">
                        <h3 class="text-lg font-medium text-gray-800 mb-4">Ingresos por Sucursal</h3>
                        <canvas id="ingresos-chart" width="400" height="200"></canvas>
                    </div>

                    <!-- Gráfico de servicios más populares -->
                    <div class="bg-white rounded-md shadow-md p-6">
                        <h3 class="text-lg font-medium text-gray-800 mb-4">Servicios Más Populares</h3>
                        <canvas id="servicios-chart" width="400" height="200"></canvas>
                    </div>
                </div>

                <!-- Tabla comparativa por sucursal -->
                <div class="bg-white rounded-md shadow-md mb-6">
                    <div class="px-6 py-4 border-b border-gray-200">
                        <h2 class="text-xl font-medium text-gray-800">Comparativa por Sucursal</h2>
                    </div>
                    
                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Sucursal</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Ingresos</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Consultas</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Promedio/Consulta</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Crecimiento</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Satisfacción</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="h-3 w-3 bg-blue-500 rounded-full mr-3"></div>
                                            <div>
                                                <div class="text-sm font-medium text-gray-900">Sucursal Centro</div>
                                                <div class="text-sm text-gray-500">SUC001</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900">$125,680</div>
                                        <div class="text-sm text-gray-500">44.0% del total</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900">547</div>
                                        <div class="text-sm text-gray-500">43.9% del total</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        $229.8
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                            <i class="fas fa-arrow-up mr-1"></i>+18.2%
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="text-sm text-gray-900">4.9</div>
                                            <div class="ml-2">
                                                <div class="flex text-yellow-400">
                                                    <i class="fas fa-star text-xs"></i>
                                                    <i class="fas fa-star text-xs"></i>
                                                    <i class="fas fa-star text-xs"></i>
                                                    <i class="fas fa-star text-xs"></i>
                                                    <i class="fas fa-star text-xs"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>

                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="h-3 w-3 bg-green-500 rounded-full mr-3"></div>
                                            <div>
                                                <div class="text-sm font-medium text-gray-900">Sucursal Norte</div>
                                                <div class="text-sm text-gray-500">SUC002</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900">$98,230</div>
                                        <div class="text-sm text-gray-500">34.4% del total</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900">423</div>
                                        <div class="text-sm text-gray-500">33.9% del total</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        $232.1
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                            <i class="fas fa-arrow-up mr-1"></i>+12.5%
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="text-sm text-gray-900">4.7</div>
                                            <div class="ml-2">
                                                <div class="flex text-yellow-400">
                                                    <i class="fas fa-star text-xs"></i>
                                                    <i class="fas fa-star text-xs"></i>
                                                    <i class="fas fa-star text-xs"></i>
                                                    <i class="fas fa-star text-xs"></i>
                                                    <i class="far fa-star text-xs"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>

                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="h-3 w-3 bg-purple-500 rounded-full mr-3"></div>
                                            <div>
                                                <div class="text-sm font-medium text-gray-900">Sucursal Sur</div>
                                                <div class="text-sm text-gray-500">SUC003</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900">$61,540</div>
                                        <div class="text-sm text-gray-500">21.6% del total</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900">277</div>
                                        <div class="text-sm text-gray-500">22.2% del total</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        $222.2
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                            <i class="fas fa-arrow-up mr-1"></i>+8.9%
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="text-sm text-gray-900">4.6</div>
                                            <div class="ml-2">
                                                <div class="flex text-yellow-400">
                                                    <i class="fas fa-star text-xs"></i>
                                                    <i class="fas fa-star text-xs"></i>
                                                    <i class="fas fa-star text-xs"></i>
                                                    <i class="fas fa-star text-xs"></i>
                                                    <i class="far fa-star text-xs"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Botones de exportación -->
                <div class="flex justify-end space-x-3">
                    <button onclick="exportarPDF()" class="px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700 transition-colors">
                        <i class="fas fa-file-pdf mr-2"></i>Exportar PDF
                    </button>
                    <button onclick="exportarExcel()" class="px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700 transition-colors">
                        <i class="fas fa-file-excel mr-2"></i>Exportar Excel
                    </button>
                </div>
            </div>
        </main>
    </div>

    <script>
        // Configurar gráfico de ingresos
        const ingresosCtx = document.getElementById('ingresos-chart').getContext('2d');
        const ingresosChart = new Chart(ingresosCtx, {
            type: 'bar',
            data: {
                labels: ['Centro', 'Norte', 'Sur'],
                datasets: [{
                    label: 'Ingresos ($)',
                    data: [125680, 98230, 61540],
                    backgroundColor: [
                        '#3B82F6',
                        '#10B981',
                        '#8B5CF6'
                    ],
                    borderColor: [
                        '#2563EB',
                        '#059669',
                        '#7C3AED'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            callback: function(value) {
                                return '$' + value.toLocaleString();
                            }
                        }
                    }
                }
            }
        });

        // Configurar gráfico de servicios
        const serviciosCtx = document.getElementById('servicios-chart').getContext('2d');
        const serviciosChart = new Chart(serviciosCtx, {
            type: 'doughnut',
            data: {
                labels: ['Consulta General', 'Vacunación', 'Cirugía', 'Peluquería', 'Otros'],
                datasets: [{
                    data: [45, 25, 15, 10, 5],
                    backgroundColor: [
                        '#3B82F6',
                        '#10B981',
                        '#F59E0B',
                        '#EF4444',
                        '#8B5CF6'
                    ]
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'bottom'
                    }
                }
            }
        });

        function actualizarEstadisticas() {
            alert('Actualizando estadísticas...');
            // Aquí harías la consulta AJAX para actualizar los datos
        }

        function exportarPDF() {
            alert('Exportando a PDF...');
            // Aquí implementarías la exportación a PDF
        }

        function exportarExcel() {
            alert('Exportando a Excel...');
            // Aquí implementarías la exportación a Excel
        }

        // Manejar cambio de período
        document.getElementById('periodo-filter').addEventListener('change', function() {
            const fechaDesde = document.getElementById('fecha-desde');
            if (this.value === 'personalizado') {
                fechaDesde.disabled = false;
            } else {
                fechaDesde.disabled = true;
            }
        });
    </script>
</body>
    <script src="../../js/admin/admin-dashboard.js"></script>
</html>

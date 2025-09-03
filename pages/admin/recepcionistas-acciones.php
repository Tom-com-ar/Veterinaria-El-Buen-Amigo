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
    <title>Ver Acciones Recepcionistas - El Buen Amigo</title>
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
                <h1 class="text-3xl font-light text-black mb-8">Registro de Acciones - Recepcionistas</h1>

                <!-- Filtros -->
                <div class="bg-white rounded-md shadow-md p-6 mb-6">
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                        <div>
                            <select id="filter-recepcionista" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-vet-blue">
                                <option value="">Todas las recepcionistas</option>
                                <option value="1">Ana Martínez</option>
                                <option value="2">Carmen López</option>
                                <option value="3">Sofía García</option>
                            </select>
                        </div>
                        <div>
                            <input type="date" id="fecha-desde" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-vet-blue">
                        </div>
                        <div>
                            <input type="date" id="fecha-hasta" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-vet-blue">
                        </div>
                        <div>
                            <button class="w-full px-4 py-2 bg-vet-blue text-white rounded-md hover:bg-vet-blue/90 transition-colors">
                                <i class="fas fa-search mr-2"></i>Filtrar
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Log de acciones -->
                <div class="bg-white rounded-md shadow-md">
                    <div class="px-6 py-4 border-b border-gray-200">
                        <h2 class="text-xl font-medium text-gray-800">Registro de Actividades</h2>
                    </div>
                    
                    <div class="p-6">
                        <div class="space-y-4">
                            <!-- Acción 1 -->
                            <div class="flex items-start space-x-4 p-4 bg-blue-50 rounded-lg border-l-4 border-blue-400">
                                <div class="flex-shrink-0">
                                    <div class="h-8 w-8 bg-blue-500 rounded-full flex items-center justify-center">
                                        <i class="fas fa-calendar-plus text-white text-xs"></i>
                                    </div>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <div class="flex items-center justify-between">
                                        <p class="text-sm font-medium text-gray-900">Cita agendada</p>
                                        <p class="text-xs text-gray-500">10:30 AM</p>
                                    </div>
                                    <p class="text-sm text-gray-600">Ana Martínez agendó una consulta para Sr. Juan Pérez con su mascota "Max" para el 15/09/2024 a las 14:00</p>
                                    <p class="text-xs text-gray-400 mt-1">Cliente: Juan Pérez | Mascota: Max | Veterinario: Dr. Carlos Martínez</p>
                                </div>
                            </div>

                            <!-- Acción 2 -->
                            <div class="flex items-start space-x-4 p-4 bg-green-50 rounded-lg border-l-4 border-green-400">
                                <div class="flex-shrink-0">
                                    <div class="h-8 w-8 bg-green-500 rounded-full flex items-center justify-center">
                                        <i class="fas fa-dollar-sign text-white text-xs"></i>
                                    </div>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <div class="flex items-center justify-between">
                                        <p class="text-sm font-medium text-gray-900">Pago procesado</p>
                                        <p class="text-xs text-gray-500">09:45 AM</p>
                                    </div>
                                    <p class="text-sm text-gray-600">Carmen López procesó un pago de $2,500 por consulta general</p>
                                    <p class="text-xs text-gray-400 mt-1">Método: Efectivo | Cliente: María García</p>
                                </div>
                            </div>

                            <!-- Acción 3 -->
                            <div class="flex items-start space-x-4 p-4 bg-yellow-50 rounded-lg border-l-4 border-yellow-400">
                                <div class="flex-shrink-0">
                                    <div class="h-8 w-8 bg-yellow-500 rounded-full flex items-center justify-center">
                                        <i class="fas fa-calendar-times text-white text-xs"></i>
                                    </div>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <div class="flex items-center justify-between">
                                        <p class="text-sm font-medium text-gray-900">Cita cancelada</p>
                                        <p class="text-xs text-gray-500">09:15 AM</p>
                                    </div>
                                    <p class="text-sm text-gray-600">Ana Martínez canceló la cita del Sr. Roberto Silva programada para hoy a las 15:30</p>
                                    <p class="text-xs text-gray-400 mt-1">Motivo: Enfermedad del propietario</p>
                                </div>
                            </div>

                            <!-- Acción 4 -->
                            <div class="flex items-start space-x-4 p-4 bg-purple-50 rounded-lg border-l-4 border-purple-400">
                                <div class="flex-shrink-0">
                                    <div class="h-8 w-8 bg-purple-500 rounded-full flex items-center justify-center">
                                        <i class="fas fa-user-plus text-white text-xs"></i>
                                    </div>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <div class="flex items-center justify-between">
                                        <p class="text-sm font-medium text-gray-900">Cliente registrado</p>
                                        <p class="text-xs text-gray-500">08:30 AM</p>
                                    </div>
                                    <p class="text-sm text-gray-600">Sofía García registró un nuevo cliente: Patricia Morales con su gato "Whiskers"</p>
                                    <p class="text-xs text-gray-400 mt-1">Tel: (011) 9876-5432 | Email: patricia.morales@email.com</p>
                                </div>
                            </div>

                            <!-- Acción 5 -->
                            <div class="flex items-start space-x-4 p-4 bg-red-50 rounded-lg border-l-4 border-red-400">
                                <div class="flex-shrink-0">
                                    <div class="h-8 w-8 bg-red-500 rounded-full flex items-center justify-center">
                                        <i class="fas fa-exclamation-triangle text-white text-xs"></i>
                                    </div>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <div class="flex items-center justify-between">
                                        <p class="text-sm font-medium text-gray-900">Advertencia del sistema</p>
                                        <p class="text-xs text-gray-500">08:00 AM</p>
                                    </div>
                                    <p class="text-sm text-gray-600">Carmen López recibió una advertencia por intento de acceso a sección no autorizada</p>
                                    <p class="text-xs text-gray-400 mt-1">Sección: Reportes financieros avanzados</p>
                                </div>
                            </div>

                            <!-- Más acciones... -->
                            <div class="text-center py-4">
                                <button class="px-4 py-2 bg-gray-200 text-gray-600 rounded-md hover:bg-gray-300 transition-colors">
                                    <i class="fas fa-plus mr-2"></i>Cargar más actividades
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <script>
        // Configurar fechas por defecto (últimos 7 días)
        const hoy = new Date();
        const hace7dias = new Date();
        hace7dias.setDate(hoy.getDate() - 7);

        document.getElementById('fecha-desde').value = hace7dias.toISOString().split('T')[0];
        document.getElementById('fecha-hasta').value = hoy.toISOString().split('T')[0];

        // Función para aplicar filtros
        function aplicarFiltros() {
            const recepcionista = document.getElementById('filter-recepcionista').value;
            const fechaDesde = document.getElementById('fecha-desde').value;
            const fechaHasta = document.getElementById('fecha-hasta').value;

            // Aquí harías la petición AJAX para filtrar las acciones
            console.log('Filtros aplicados:', { recepcionista, fechaDesde, fechaHasta });
        }
    </script>
</body>
    <script src="../../js/admin/admin-dashboard.js"></script>
</html>

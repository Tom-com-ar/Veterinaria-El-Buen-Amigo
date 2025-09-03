<?php
// Incluir la configuración de layout
include_once '../../components/admin/layout.php';

// Obtener configuración para la página
$config = get_page_config('veterinarios');
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modificar Veterinarios - El Buen Amigo</title>
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
                <h1 class="text-3xl font-light text-black mb-8">Gestionar Veterinarios</h1>

                <!-- Barra de búsqueda y filtros -->
                <div class="bg-white rounded-md shadow-md p-6 mb-6">
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                        <div>
                            <input type="text" id="search-veterinario" placeholder="Buscar por nombre, DNI o matrícula..."
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
                            <select id="filter-especialidad" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-vet-blue">
                                <option value="">Todas las especialidades</option>
                                <option value="general">Medicina General</option>
                                <option value="cirugia">Cirugía</option>
                                <option value="dermatologia">Dermatología</option>
                                <option value="cardiologia">Cardiología</option>
                            </select>
                        </div>
                        <div>
                            <button class="w-full px-4 py-2 bg-vet-blue text-white rounded-md hover:bg-vet-blue/90 transition-colors">
                                <i class="fas fa-search mr-2"></i>Buscar
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Lista de veterinarios -->
                <div class="bg-white rounded-md shadow-md">
                    <div class="px-6 py-4 border-b border-gray-200">
                        <h2 class="text-xl font-medium text-gray-800">Veterinarios Registrados</h2>
                    </div>
                    
                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Veterinario</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Matrícula</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Especialidad</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Sucursal</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Estado</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Acciones</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0 h-10 w-10">
                                                <img class="h-10 w-10 rounded-full" src="https://ui-avatars.com/api/?name=Dr+Martinez&background=3B82F6&color=fff" alt="Dr. Martínez">
                                            </div>
                                            <div class="ml-4">
                                                <div class="text-sm font-medium text-gray-900">Dr. Carlos Martínez</div>
                                                <div class="text-sm text-gray-500">carlos.martinez@elbuenamigo.com</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900">MP 12345</div>
                                        <div class="text-sm text-gray-500">DNI: 12345678</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-blue-100 text-blue-800">
                                            Medicina General
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900">Sucursal Centro</div>
                                        <div class="text-sm text-gray-500">Tiempo Completo</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">
                                            Activo
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium space-x-2">
                                        <button class="text-vet-blue hover:text-vet-blue/70" onclick="editVeterinario(1)">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button class="text-green-600 hover:text-green-500" onclick="viewVeterinario(1)">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                        <button class="text-purple-600 hover:text-purple-500" onclick="viewSchedule(1)">
                                            <i class="fas fa-calendar"></i>
                                        </button>
                                        <button class="text-orange-600 hover:text-orange-500" onclick="changePassword(1)">
                                            <i class="fas fa-key"></i>
                                        </button>
                                        <button class="text-red-600 hover:text-red-500" onclick="deleteVeterinario(1)">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </td>
                                </tr>

                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0 h-10 w-10">
                                                <img class="h-10 w-10 rounded-full" src="https://ui-avatars.com/api/?name=Dra+Lopez&background=10B981&color=fff" alt="Dra. López">
                                            </div>
                                            <div class="ml-4">
                                                <div class="text-sm font-medium text-gray-900">Dra. Ana López</div>
                                                <div class="text-sm text-gray-500">ana.lopez@elbuenamigo.com</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900">MP 67890</div>
                                        <div class="text-sm text-gray-500">DNI: 87654321</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-purple-100 text-purple-800">
                                            Cirugía
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900">Sucursal Norte</div>
                                        <div class="text-sm text-gray-500">Tiempo Completo</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">
                                            Activo
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium space-x-2">
                                        <button class="text-vet-blue hover:text-vet-blue/70" onclick="editVeterinario(2)">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button class="text-green-600 hover:text-green-500" onclick="viewVeterinario(2)">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                        <button class="text-purple-600 hover:text-purple-500" onclick="viewSchedule(2)">
                                            <i class="fas fa-calendar"></i>
                                        </button>
                                        <button class="text-orange-600 hover:text-orange-500" onclick="changePassword(2)">
                                            <i class="fas fa-key"></i>
                                        </button>
                                        <button class="text-red-600 hover:text-red-500" onclick="deleteVeterinario(2)">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </td>
                                </tr>

                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0 h-10 w-10">
                                                <img class="h-10 w-10 rounded-full" src="https://ui-avatars.com/api/?name=Dr+Garcia&background=F59E0B&color=fff" alt="Dr. García">
                                            </div>
                                            <div class="ml-4">
                                                <div class="text-sm font-medium text-gray-900">Dr. Miguel García</div>
                                                <div class="text-sm text-gray-500">miguel.garcia@elbuenamigo.com</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900">MP 11111</div>
                                        <div class="text-sm text-gray-500">DNI: 11223344</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                            Dermatología
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900">Sucursal Sur</div>
                                        <div class="text-sm text-gray-500">Medio Tiempo</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-red-100 text-red-800">
                                            Inactivo
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium space-x-2">
                                        <button class="text-vet-blue hover:text-vet-blue/70" onclick="editVeterinario(3)">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button class="text-green-600 hover:text-green-500" onclick="viewVeterinario(3)">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                        <button class="text-purple-600 hover:text-purple-500" onclick="viewSchedule(3)">
                                            <i class="fas fa-calendar"></i>
                                        </button>
                                        <button class="text-orange-600 hover:text-orange-500" onclick="changePassword(3)">
                                            <i class="fas fa-key"></i>
                                        </button>
                                        <button class="text-red-600 hover:text-red-500" onclick="deleteVeterinario(3)">
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
                                    Mostrando <span class="font-medium">1</span> a <span class="font-medium">3</span> de <span class="font-medium">3</span> resultados
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
        <div class="relative top-10 mx-auto p-5 border w-11/12 max-w-3xl shadow-lg rounded-md bg-white max-h-[90vh] overflow-y-auto">
            <div class="mt-3">
                <h3 class="text-lg font-medium text-gray-900 mb-4">Editar Veterinario</h3>
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
                            <label class="block text-sm font-medium text-gray-700 mb-2">Especialidad</label>
                            <select id="edit-especialidad" name="especialidad"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-vet-blue">
                                <option value="general">Medicina General</option>
                                <option value="cirugia">Cirugía</option>
                                <option value="dermatologia">Dermatología</option>
                                <option value="cardiologia">Cardiología</option>
                            </select>
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
                                <option value="1">Activo</option>
                                <option value="0">Inactivo</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Tipo de Contrato</label>
                            <select id="edit-contrato" name="contrato"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-vet-blue">
                                <option value="tiempo_completo">Tiempo Completo</option>
                                <option value="medio_tiempo">Medio Tiempo</option>
                                <option value="por_horas">Por Horas</option>
                                <option value="freelance">Freelance</option>
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

    <!-- Modal de horarios -->
    <div id="schedule-modal" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50">
        <div class="relative top-10 mx-auto p-5 border w-11/12 max-w-2xl shadow-lg rounded-md bg-white">
            <div class="mt-3">
                <h3 class="text-lg font-medium text-gray-900 mb-4">Horarios del Veterinario</h3>
                <div id="schedule-content" class="space-y-4">
                    <!-- Los horarios se cargarán dinámicamente -->
                </div>
                
                <div class="flex justify-end mt-6">
                    <button type="button" onclick="closeScheduleModal()"
                            class="px-4 py-2 bg-gray-300 text-gray-700 rounded-md hover:bg-gray-400 transition-colors">
                        Cerrar
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script>
        function editVeterinario(id) {
            // Simular datos del veterinario
            const veterinarios = {
                1: { nombre: 'Carlos', apellido: 'Martínez', email: 'carlos.martinez@elbuenamigo.com', telefono: '1234567890', especialidad: 'general', sucursal: '1', estado: '1', contrato: 'tiempo_completo' },
                2: { nombre: 'Ana', apellido: 'López', email: 'ana.lopez@elbuenamigo.com', telefono: '0987654321', especialidad: 'cirugia', sucursal: '2', estado: '1', contrato: 'tiempo_completo' },
                3: { nombre: 'Miguel', apellido: 'García', email: 'miguel.garcia@elbuenamigo.com', telefono: '1122334455', especialidad: 'dermatologia', sucursal: '3', estado: '0', contrato: 'medio_tiempo' }
            };
            
            const vet = veterinarios[id];
            document.getElementById('edit-id').value = id;
            document.getElementById('edit-nombre').value = vet.nombre;
            document.getElementById('edit-apellido').value = vet.apellido;
            document.getElementById('edit-email').value = vet.email;
            document.getElementById('edit-telefono').value = vet.telefono;
            document.getElementById('edit-especialidad').value = vet.especialidad;
            document.getElementById('edit-sucursal').value = vet.sucursal;
            document.getElementById('edit-estado').value = vet.estado;
            document.getElementById('edit-contrato').value = vet.contrato;
            
            document.getElementById('edit-modal').classList.remove('hidden');
        }

        function viewVeterinario(id) {
            alert('Ver detalles completos del veterinario ' + id);
        }

        function viewSchedule(id) {
            const schedules = {
                1: ['Lunes: 8:00 - 16:00', 'Martes: 8:00 - 16:00', 'Miércoles: 8:00 - 16:00', 'Jueves: 8:00 - 16:00', 'Viernes: 8:00 - 16:00'],
                2: ['Lunes: 9:00 - 17:00', 'Martes: 9:00 - 17:00', 'Miércoles: 9:00 - 17:00', 'Jueves: 9:00 - 17:00', 'Viernes: 9:00 - 17:00'],
                3: ['Lunes: 14:00 - 18:00', 'Miércoles: 14:00 - 18:00', 'Viernes: 14:00 - 18:00']
            };

            const scheduleContent = document.getElementById('schedule-content');
            scheduleContent.innerHTML = '';

            schedules[id].forEach(schedule => {
                const div = document.createElement('div');
                div.className = 'flex items-center justify-between p-3 bg-gray-50 rounded-md';
                div.innerHTML = `
                    <span class="text-sm font-medium text-gray-700">${schedule}</span>
                    <button class="text-vet-blue hover:text-vet-blue/70 text-sm">
                        <i class="fas fa-edit"></i>
                    </button>
                `;
                scheduleContent.appendChild(div);
            });

            document.getElementById('schedule-modal').classList.remove('hidden');
        }

        function changePassword(id) {
            const newPassword = prompt('Ingrese la nueva contraseña para el veterinario:');
            if (newPassword) {
                alert('Contraseña cambiada correctamente');
                // Aquí enviarías la nueva contraseña por AJAX
            }
        }

        function deleteVeterinario(id) {
            if (confirm('¿Está seguro de que desea eliminar este veterinario?\nEsta acción no se puede deshacer.')) {
                alert('Veterinario eliminado');
                // Aquí harías la eliminación por AJAX
            }
        }

        function closeEditModal() {
            document.getElementById('edit-modal').classList.add('hidden');
        }

        function closeScheduleModal() {
            document.getElementById('schedule-modal').classList.add('hidden');
        }

        // Manejar el envío del formulario de edición
        document.getElementById('edit-form').addEventListener('submit', function(e) {
            e.preventDefault();
            alert('Cambios guardados correctamente');
            closeEditModal();
            // Aquí enviarías los datos por AJAX
        });
    </script>
</body>
    <script src="../../js/admin/admin-dashboard.js"></script>
</html>

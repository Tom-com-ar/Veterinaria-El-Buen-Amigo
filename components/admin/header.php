<?php
// Configuración predeterminada del header
$header_config = array_merge([
    'title' => 'INICIO',
    'show_search' => true,
    'css_path' => '../../dist/output.css'
], $header_config ?? []);
?>

<!-- Header -->
<header class="bg-vet-blue text-white shadow-lg fixed top-0 left-64 right-0 max-xl:left-0 z-30 h-20">
    <div class="px-6 py-4 h-full">
        <div class="flex items-center justify-between h-full">
            <!-- Lado izquierdo: INICIO y botón hamburguesa móvil -->
            <div class="flex items-center space-x-4">
                <!-- Botón hamburguesa para móvil y tablets -->
                <button id="mobile-menu-toggle-header" class="xl:hidden text-white">
                    <i class="fas fa-bars text-xl"></i>
                </button>
                <h1 class="text-2xl font-bold text-white max-md:text-xl"><?php echo htmlspecialchars($header_config['title']); ?></h1>
            </div>
            
            <!-- Lado derecho: Búsqueda y Usuario -->
            <div class="flex items-center space-x-4">
                <?php if ($header_config['show_search']): ?>
                <!-- Barra de búsqueda -->
                <div class="relative max-md:hidden">
                    <input type="text" placeholder="Buscar herramientas" 
                           class="px-4 py-2 bg-white rounded-md text-gray-800 focus:outline-none focus:ring-2 focus:ring-vet-orange w-64">
                    <button class="absolute right-3 top-1/2 transform -translate-y-1/2">
                        <i class="fas fa-search text-gray-500 text-sm"></i>
                    </button>
                </div>
                <?php endif; ?>
                
                <!-- Usuario -->
                <div class="relative">
                    <button id="profile-menu-toggle" class="w-10 h-10 bg-white rounded-full flex items-center justify-center hover:bg-gray-100 transition-colors duration-200">
                        <i class="fas fa-user text-vet-blue text-lg"></i>
                    </button>
                    
                    <!-- Menú desplegable del perfil -->
                    <div id="profile-menu" class="hidden absolute right-0 top-12 w-48 bg-white rounded-lg shadow-lg border border-gray-200 z-50">
                        <div class="py-2">
                            <button id="edit-profile-btn" class="w-full flex items-center px-4 py-2 text-gray-700 hover:bg-gray-50 transition-colors duration-200">
                                <i class="fas fa-user-edit text-vet-blue mr-3"></i>
                                <span>Editar Perfil</span>
                            </button>
                            <button id="logout-btn" class="w-full flex items-center px-4 py-2 text-gray-700 hover:bg-gray-50 transition-colors duration-200">
                                <i class="fas fa-sign-out-alt text-red-500 mr-3"></i>
                                <span>Cerrar Sesión</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>

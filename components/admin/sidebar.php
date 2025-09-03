<?php
// Configuración predeterminada del sidebar
$sidebar_config = array_merge([
    'logo_path' => '../../assets/Logo 4.png',
    'current_page' => '',
    'menu_items' => [
        [
            'icon' => 'fas fa-building',
            'text' => 'Sucursales',
            'href' => '#',
            'id' => 'sucursales',
            'has_submenu' => true
        ],
        [
            'icon' => 'fas fa-user-md',
            'text' => 'Veterinarios',
            'href' => '#',
            'id' => 'veterinarios',
            'has_submenu' => true
        ],
        [
            'icon' => 'fas fa-user-tie',
            'text' => 'Recepcionistas',
            'href' => '#',
            'id' => 'recepcionistas',
            'has_submenu' => true
        ],
        [
            'icon' => 'fas fa-box',
            'text' => 'Productos',
            'href' => '#',
            'id' => 'productos',
            'has_submenu' => true
        ]
    ]
], $sidebar_config ?? []);

// Obtener submenús si están disponibles
$submenus = [];
if (function_exists('get_sidebar_submenus')) {
    $submenus = get_sidebar_submenus();
}
?>

<!-- Sidebar -->
<aside class="w-64 bg-vet-dark text-white shadow-xl max-xl:hidden fixed top-0 bottom-0 left-0 z-40">
    <!-- Header del sidebar con logo y nombre -->
    <div class="bg-vet-darkblue h-20 flex items-center">
        <div class="flex items-center space-x-3">
            <img src="<?php echo htmlspecialchars($sidebar_config['logo_path']); ?>" alt="El Buen Amigo Logo" class="w-20 h-20 object-contain">
            <div class="text-center">
                <h2 class="text-base font-light text-white leading-tight">El Buen Amigo</h2>
                <p class="text-vet-orange text-sm font-light leading-tight">Veterinaria</p>
            </div>
        </div>
    </div>
    
    <nav class="mt-4">
        <ul class="space-y-0">
                <!-- Botón Volver al Inicio -->
                <li>
                    <a href="../../pages/admin/inicio-admin.php" class="flex items-center px-6 py-3 text-white hover:bg-vet-blue transition-colors duration-200 sidebar-item">
                        <i class="fas fa-home text-xl mr-3"></i>
                        <span>Inicio</span>
                    </a>
                </li>
            <?php foreach ($sidebar_config['menu_items'] as $item): ?>
            <li>
                <a href="<?php echo $item['has_submenu'] ? 'javascript:void(0)' : htmlspecialchars($item['href']); ?>" 
                   class="flex items-center justify-between px-6 py-3 text-white hover:bg-vet-blue transition-colors duration-200 sidebar-item <?php echo ($sidebar_config['current_page'] === $item['id']) ? 'bg-vet-blue' : ''; ?> <?php echo $item['has_submenu'] ? 'submenu-toggle' : ''; ?>"
                   data-submenu="<?php echo $item['id']; ?>">
                    <div class="flex items-center">
                        <i class="<?php echo htmlspecialchars($item['icon']); ?> text-xl mr-3"></i>
                        <span><?php echo htmlspecialchars($item['text']); ?></span>
                    </div>
                    <?php if ($item['has_submenu']): ?>
                        <i class="fas fa-chevron-down transition-transform duration-200 submenu-arrow" data-target="<?php echo $item['id']; ?>"></i>
                    <?php endif; ?>
                </a>
                
                <?php if ($item['has_submenu'] && isset($submenus[$item['id']])): ?>
                <ul class="submenu hidden bg-vet-darkblue space-y-0" id="submenu-<?php echo $item['id']; ?>">
                    <?php foreach ($submenus[$item['id']] as $subitem): ?>
                    <li>
                        <a href="<?php echo htmlspecialchars($subitem['href']); ?>" 
                           class="flex items-center px-10 py-2 text-gray-300 hover:text-white hover:bg-vet-blue transition-colors duration-200 text-sm submenu-item">
                            <i class="<?php echo htmlspecialchars($subitem['icon']); ?> text-sm mr-3"></i>
                            <span><?php echo htmlspecialchars($subitem['text']); ?></span>
                        </a>
                    </li>
                    <?php endforeach; ?>
                </ul>
                <?php endif; ?>
            </li>
            <?php endforeach; ?>
        </ul>
    </nav>
</aside>

<!-- Menu móvil overlay -->
<div id="mobile-menu-overlay" class="hidden xl:hidden fixed inset-0 bg-black bg-opacity-50 z-40" style="background-color: rgba(107, 114, 128, 0.5);">
    <div class="fixed left-0 top-0 bottom-0 w-80 bg-vet-dark text-white shadow-xl transform -translate-x-full transition-transform duration-300 overflow-y-auto" id="mobile-sidebar">
        <div class="bg-vet-darkblue p-4 h-20 flex items-center justify-between sticky top-0 z-50">
            <div class="flex items-center space-x-3">
                <img src="<?php echo htmlspecialchars($sidebar_config['logo_path']); ?>" alt="El Buen Amigo Logo" class="w-12 h-12 object-contain">
                <div class="text-center">
                    <h2 class="text-base font-light text-white leading-tight">El Buen Amigo</h2>
                    <p class="text-vet-orange text-sm font-light leading-tight">Veterinaria</p>
                </div>
            </div>
            <button id="close-mobile-menu" class="text-white">
                <i class="fas fa-times"></i>
            </button>
        </div>
        
        <nav class="pb-6">
            <!-- Botón Volver al Inicio móvil -->
            <ul class="space-y-0">
                <li>
                    <a href="../../pages/admin/inicio-admin.php" class="flex items-center px-6 py-3 text-white hover:bg-vet-blue transition-colors duration-200 sidebar-item">
                        <i class="fas fa-home text-xl mr-3"></i>
                        <span>Inicio</span>
                    </a>
                </li>
                <?php foreach ($sidebar_config['menu_items'] as $item): ?>
                <li>
                    <a href="<?php echo $item['has_submenu'] ? 'javascript:void(0)' : htmlspecialchars($item['href']); ?>" 
                       class="flex items-center justify-between px-6 py-3 text-white hover:bg-vet-blue transition-colors duration-200 sidebar-item <?php echo ($sidebar_config['current_page'] === $item['id']) ? 'bg-vet-blue' : ''; ?> <?php echo $item['has_submenu'] ? 'submenu-toggle mobile-submenu-toggle' : ''; ?>"
                       data-submenu="<?php echo $item['id']; ?>">
                        <div class="flex items-center">
                            <i class="<?php echo htmlspecialchars($item['icon']); ?> text-xl mr-3"></i>
                            <span><?php echo htmlspecialchars($item['text']); ?></span>
                        </div>
                        <?php if ($item['has_submenu']): ?>
                            <i class="fas fa-chevron-down transition-transform duration-200 submenu-arrow mobile-submenu-arrow" data-target="<?php echo $item['id']; ?>"></i>
                        <?php endif; ?>
                    </a>
                    
                    <?php if ($item['has_submenu'] && isset($submenus[$item['id']])): ?>
                    <ul class="submenu hidden bg-vet-darkblue space-y-0" id="mobile-submenu-<?php echo $item['id']; ?>">
                        <?php foreach ($submenus[$item['id']] as $subitem): ?>
                        <li>
                            <a href="<?php echo htmlspecialchars($subitem['href']); ?>" 
                               class="flex items-center px-10 py-2 text-gray-300 hover:text-white hover:bg-vet-blue transition-colors duration-200 text-sm submenu-item">
                                <i class="<?php echo htmlspecialchars($subitem['icon']); ?> text-sm mr-3"></i>
                                <span><?php echo htmlspecialchars($subitem['text']); ?></span>
                            </a>
                        </li>
                        <?php endforeach; ?>
                    </ul>
                    <?php endif; ?>
                </li>
                <?php endforeach; ?>
            </ul>
        </nav>
    </div>
</div>

// Admin Dashboard JavaScript
document.addEventListener('DOMContentLoaded', function() {
    // Funcionalidad del menú móvil
    const mobileMenuToggle = document.getElementById('mobile-menu-toggle');
    const mobileMenuToggleHeader = document.getElementById('mobile-menu-toggle-header');
    const mobileMenuOverlay = document.getElementById('mobile-menu-overlay');
    const mobileSidebar = document.getElementById('mobile-sidebar');
    const closeMobileMenu = document.getElementById('close-mobile-menu');

    function openMobileMenu() {
        mobileMenuOverlay.classList.remove('hidden');
        setTimeout(() => {
            mobileSidebar.classList.remove('-translate-x-full');
        }, 10);
    }

    function closeMobileMenuFunction() {
        mobileSidebar.classList.add('-translate-x-full');
        setTimeout(() => {
            mobileMenuOverlay.classList.add('hidden');
        }, 300);
    }

    if (mobileMenuToggle) {
        mobileMenuToggle.addEventListener('click', openMobileMenu);
    }

    if (mobileMenuToggleHeader) {
        mobileMenuToggleHeader.addEventListener('click', openMobileMenu);
    }
    
    if (closeMobileMenu) {
        closeMobileMenu.addEventListener('click', closeMobileMenuFunction);
    }
    
    if (mobileMenuOverlay) {
        mobileMenuOverlay.addEventListener('click', (e) => {
            if (e.target === mobileMenuOverlay) {
                closeMobileMenuFunction();
            }
        });
    }

    // Funcionalidad de acordeón para las secciones
    document.querySelectorAll('.card-toggle').forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            
            const chevron = this.querySelector('i');
            const card = this.closest('.bg-white');
            const content = card.querySelector('div.p-6:nth-child(2)'); // El segundo div con p-6 es el contenido
            
            // Verificar si está cerrado (display: none)
            const isClosed = content.style.display === 'none';
            
            if (isClosed) {
                // Abrir instantáneo (sin animación)
                content.style.display = 'block';
                content.style.maxHeight = 'none';
                content.style.paddingTop = '1.5rem';
                content.style.paddingBottom = '1.5rem';
                content.style.opacity = '1';
                content.style.overflow = 'visible';
                
                chevron.className = 'fas fa-chevron-up';
                
            } else {
                // Cerrar con animación
                content.style.transition = 'all 0.3s ease-out';
                content.style.maxHeight = content.scrollHeight + 'px';
                content.style.overflow = 'hidden';
                
                requestAnimationFrame(() => {
                    content.style.maxHeight = '0px';
                    content.style.paddingTop = '0px';
                    content.style.paddingBottom = '0px';
                    content.style.opacity = '0';
                });
                
                setTimeout(() => {
                    content.style.display = 'none';
                }, 300);
                
                chevron.className = 'fas fa-chevron-down';
            }
        });
    });
});

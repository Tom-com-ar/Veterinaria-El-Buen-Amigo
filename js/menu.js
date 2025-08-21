document.addEventListener('DOMContentLoaded', () => {
    const menuToggle = document.getElementById('menu-toggle');
    const mobileMenu = document.getElementById('mobile-menu');
    let isMenuOpen = false;

    // Función para alternar el menú
    const toggleMenu = () => {
        isMenuOpen = !isMenuOpen;
        mobileMenu.classList.toggle('hidden');
    };

    // Event listeners
    menuToggle.addEventListener('click', toggleMenu);

    // Cerrar el menú cuando se hace clic fuera de él
    document.addEventListener('click', (e) => {
        const isClickInside = menuToggle.contains(e.target) || mobileMenu.contains(e.target);
        if (!isClickInside && isMenuOpen) {
            toggleMenu();
        }
    });

    // Cerrar el menú cuando se presiona la tecla Escape
    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape' && isMenuOpen) {
            toggleMenu();
        }
    });
});

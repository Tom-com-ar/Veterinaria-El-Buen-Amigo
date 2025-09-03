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

    // Funcionalidad de submenús del sidebar mejorada
    document.querySelectorAll('.submenu-toggle').forEach(toggle => {
        toggle.addEventListener('click', function(e) {
            e.preventDefault();
            
            const submenuId = this.getAttribute('data-submenu');
            const isDesktop = !this.classList.contains('mobile-submenu-toggle');
            const submenu = document.getElementById((isDesktop ? 'submenu-' : 'mobile-submenu-') + submenuId);
            const arrow = this.querySelector('.submenu-arrow');
            
            if (submenu) {
                const isHidden = submenu.classList.contains('hidden');
                
                // Cerrar todos los otros submenús del mismo contexto (desktop o mobile)
                const prefix = isDesktop ? 'submenu-' : 'mobile-submenu-';
                document.querySelectorAll(`[id^="${prefix}"]`).forEach(menu => {
                    if (menu !== submenu) {
                        menu.classList.add('hidden');
                    }
                });
                
                // Resetear todas las flechas del mismo contexto
                const arrowClass = isDesktop ? '.submenu-arrow:not(.mobile-submenu-arrow)' : '.mobile-submenu-arrow';
                document.querySelectorAll(arrowClass).forEach(arr => {
                    if (arr !== arrow) {
                        arr.classList.remove('rotate-180');
                    }
                });
                
                // Toggle del submenu actual
                if (isHidden) {
                    submenu.classList.remove('hidden');
                    if (arrow) {
                        arrow.classList.add('rotate-180');
                        // Forzar el repaint para asegurar que la rotación se mantenga
                        arrow.style.transform = 'rotate(180deg)';
                    }
                } else {
                    submenu.classList.add('hidden');
                    if (arrow) {
                        arrow.classList.remove('rotate-180');
                        arrow.style.transform = '';
                    }
                }
            }
        });
    });

    // Cerrar submenús cuando se hace clic fuera del sidebar
    document.addEventListener('click', function(e) {
        if (!e.target.closest('aside') && !e.target.closest('#mobile-sidebar')) {
            // Cerrar submenús de desktop
            document.querySelectorAll('[id^="submenu-"]').forEach(menu => {
                menu.classList.add('hidden');
            });
            document.querySelectorAll('.submenu-arrow:not(.mobile-submenu-arrow)').forEach(arrow => {
                arrow.classList.remove('rotate-180');
                arrow.style.transform = '';
            });
            
            // Cerrar submenús de móvil
            document.querySelectorAll('[id^="mobile-submenu-"]').forEach(menu => {
                menu.classList.add('hidden');
            });
            document.querySelectorAll('.mobile-submenu-arrow').forEach(arrow => {
                arrow.classList.remove('rotate-180');
                arrow.style.transform = '';
            });
        }
    });

    // Funcionalidad del menú de perfil
    const profileMenuToggle = document.getElementById('profile-menu-toggle');
    const profileMenu = document.getElementById('profile-menu');
    const editProfileBtn = document.getElementById('edit-profile-btn');
    const logoutBtn = document.getElementById('logout-btn');

    // Toggle del menú de perfil
    if (profileMenuToggle && profileMenu) {
        profileMenuToggle.addEventListener('click', function(e) {
            e.stopPropagation();
            profileMenu.classList.toggle('hidden');
        });

        // Cerrar menú al hacer clic fuera
        document.addEventListener('click', function(e) {
            if (!e.target.closest('#profile-menu-toggle') && !e.target.closest('#profile-menu')) {
                profileMenu.classList.add('hidden');
            }
        });
    }

    // Funcionalidad de modales
    const passwordModal = document.getElementById('password-modal');
    const profileEditModal = document.getElementById('profile-edit-modal');
    const passwordForm = document.getElementById('password-form');
    const profileEditForm = document.getElementById('profile-edit-form');
    const cancelPasswordBtn = document.getElementById('cancel-password');
    const cancelEditBtn = document.getElementById('cancel-edit');

    // Mostrar modal de validación de contraseña
    if (editProfileBtn) {
        editProfileBtn.addEventListener('click', function() {
            profileMenu.classList.add('hidden');
            showModal(passwordModal);
        });
    }

    // Validación de contraseña
    if (passwordForm) {
        passwordForm.addEventListener('submit', function(e) {
            e.preventDefault();
            const password = document.getElementById('current-password').value;
            
            // Simulación de validación (en un entorno real, esto sería una petición al servidor)
            if (password === 'admin123') { // Contraseña de ejemplo
                hideModal(passwordModal);
                showModal(profileEditModal);
                document.getElementById('current-password').value = '';
            } else {
                alert('Contraseña incorrecta. Inténtalo de nuevo.');
                document.getElementById('current-password').focus();
            }
        });
    }

    // Guardar cambios de perfil
    if (profileEditForm) {
        profileEditForm.addEventListener('submit', function(e) {
            e.preventDefault();
            
            const newPassword = document.getElementById('new-password').value;
            const confirmPassword = document.getElementById('confirm-password').value;
            
            // Validar contraseñas si se ingresaron
            if (newPassword && newPassword !== confirmPassword) {
                alert('Las contraseñas no coinciden.');
                return;
            }
            
            // Simular guardado (en un entorno real, esto sería una petición al servidor)
            alert('Perfil actualizado correctamente.');
            hideModal(profileEditModal);
            
            // Limpiar campos de contraseña
            document.getElementById('new-password').value = '';
            document.getElementById('confirm-password').value = '';
        });
    }

    // Cerrar sesión
    if (logoutBtn) {
        logoutBtn.addEventListener('click', function() {
            if (confirm('¿Estás seguro de que deseas cerrar sesión?')) {
                // Simular cierre de sesión (en un entorno real, esto sería una petición al servidor)
                alert('Cerrando sesión...');
                // window.location.href = '/login.html';
            }
        });
    }

    // Botones de cancelar
    if (cancelPasswordBtn) {
        cancelPasswordBtn.addEventListener('click', () => hideModal(passwordModal));
    }
    
    if (cancelEditBtn) {
        cancelEditBtn.addEventListener('click', () => hideModal(profileEditModal));
    }

    // Funciones auxiliares para modales
    function showModal(modal) {
        if (modal) {
            modal.classList.remove('hidden');
            // Enfocar el primer input
            const firstInput = modal.querySelector('input');
            if (firstInput) {
                setTimeout(() => firstInput.focus(), 100);
            }
        }
    }

    function hideModal(modal) {
        if (modal) {
            modal.classList.add('hidden');
        }
    }

    // Cerrar modales con Escape
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            hideModal(passwordModal);
            hideModal(profileEditModal);
            profileMenu.classList.add('hidden');
        }
    });

    // Cerrar modales al hacer clic en el overlay
    [passwordModal, profileEditModal].forEach(modal => {
        if (modal) {
            modal.addEventListener('click', function(e) {
                if (e.target === modal) {
                    hideModal(modal);
                }
            });
        }
    });
});

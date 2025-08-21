document.addEventListener('DOMContentLoaded', () => {
    // Elementos DOM
    const paso1 = document.getElementById('paso1');
    const paso2 = document.getElementById('paso2');
    const paso3 = document.getElementById('paso3');
    const servicioSelect = document.getElementById('servicioSelect');
    const btnReservar = document.getElementById('btnReservar');

    // Función para mostrar un elemento con animación
    function mostrarElemento(elemento) {
        elemento.classList.remove('hidden');
        // Forzar un reflow para que la animación funcione
        void elemento.offsetWidth;
        elemento.classList.remove('opacity-0', 'translate-y-4');
    }

    // Datos de ejemplo para los profesionales
    const profesionales = [
        {
            id: 1,
            nombre: 'Leslie Alexander',
            foto: 'https://randomuser.me/api/portraits/women/45.jpg',
            horario: '1:00 PM - 2:30 PM'
        },
        {
            id: 2,
            nombre: 'Michael Foster',
            foto: 'https://randomuser.me/api/portraits/men/35.jpg',
            horario: '3:00 PM - 4:30 PM'
        },
        {
            id: 3,
            nombre: 'Lindsay Walton',
            foto: 'https://randomuser.me/api/portraits/women/32.jpg',
            horario: '7:00 PM - 8:30 PM'
        }
    ];

    // Función para mostrar el paso 2 con animación
    function mostrarPaso2() {
        console.log('Mostrando paso 2'); // Debug
        const contenedorProfesionales = paso2.querySelector('.space-y-4');
        contenedorProfesionales.innerHTML = ''; // Limpiar contenedor

        profesionales.forEach(prof => {
            const elemento = document.createElement('div');
            elemento.className = 'professional-card';
            elemento.innerHTML = `
                <div class="flex items-center gap-3">
                    <img src="${prof.foto}" alt="${prof.nombre}" class="w-10 h-10 rounded-full object-cover">
                    <div class="flex flex-col">
                        <h3 class="font-medium text-gray-900">${prof.nombre}</h3>
                        <p class="text-gray-500 text-sm">${prof.horario}</p>
                    </div>
                </div>
                <button class="btn-seleccionar bg-sky-400 text-white px-4 py-1.5 rounded-lg hover:bg-sky-500 transition-colors duration-300 text-sm"
                        data-id="${prof.id}">
                    Seleccionar
                </button>
            `;
            contenedorProfesionales.appendChild(elemento);
        });

        mostrarElemento(paso2);
    }

    // Función para mostrar el paso 3 con animación
    function mostrarPaso3() {
        mostrarElemento(paso3);
        
        // Inicializar el calendario
        const calendario = flatpickr("#calendario", {
            inline: true,
            locale: "es",
            minDate: "today",
            dateFormat: "Y-m-d",
            onChange: function(selectedDates, dateStr) {
                actualizarHorarios(dateStr);
            }
        });

        btnReservar.classList.remove('hidden');
    }

    // Función para actualizar los horarios disponibles
    function actualizarHorarios(fecha) {
        const horariosContainer = document.getElementById('horarios').querySelector('.space-y-2');
        const horarios = [
            "09:00 AM - 10:00 AM",
            "10:00 AM - 11:00 AM",
            "11:00 AM - 12:00 PM",
            "02:00 PM - 03:00 PM",
            "03:00 PM - 04:00 PM",
            "04:00 PM - 05:00 PM"
        ];

        horariosContainer.innerHTML = horarios.map(horario => `
            <button class="w-full text-left px-4 py-3 rounded-lg hover:bg-gray-700 transition-colors duration-300">
                ${horario}
            </button>
        `).join('');
    }

    // Event Listeners
    servicioSelect.addEventListener('change', (e) => {
        if (e.target.value) {
            mostrarPaso2();
        }
    });

    // Event delegation para los botones de seleccionar profesional
    paso2.addEventListener('click', (e) => {
        if (e.target.classList.contains('btn-seleccionar')) {
            mostrarPaso3();
        }
    });

    // CSS para las animaciones
    const style = document.createElement('style');
    style.textContent = `
        .animate-fade-in {
            animation: fadeIn 0.5s ease-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    `;
    document.head.appendChild(style);
});

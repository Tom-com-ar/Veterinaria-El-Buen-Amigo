// --- Calendario visual dinámico con cambio de mes ---
document.addEventListener('DOMContentLoaded', function () {
    const diasGrid = document.getElementById('dias-grid');
    const veterinarioSelect = document.getElementById('veterinario');
    const horariosDiv = document.getElementById('horarios');
    const calendarioHeader = document.querySelector('#calendario .flex');
    let fechaSeleccionada = null;
    let mesActual = 7; // Agosto (0=Enero)
    let anioActual = 2025;

    // Meses en español
    const meses = ['enero','febrero','marzo','abril','mayo','junio','julio','agosto','septiembre','octubre','noviembre','diciembre'];

    // Veterinarios y sus días disponibles
    const veterinarios = {
        dr_gomez: {
            dias: ['2025-08-25', '2025-08-26', '2025-08-28'],
            horarios: ['09:00', '10:00', '11:00', '12:00', '13:00']
        },
        dra_perez: {
            dias: ['2025-08-26', '2025-08-27', '2025-08-29'],
            horarios: ['14:00', '15:00', '16:00', '17:00']
        },
        dr_lopez: {
            dias: ['2025-08-25', '2025-08-27', '2025-08-30'],
            horarios: ['08:00', '09:00', '10:00', '11:00']
        }
    };

    function getDiasMes(mes, anio) {
        const primerDia = new Date(anio, mes, 1);
        const primerDiaSemana = primerDia.getDay();
        const diasEnMes = new Date(anio, mes+1, 0).getDate();
        const dias = [];
        for (let i=0; i<primerDiaSemana; i++) dias.push('');
        for (let d=1; d<=diasEnMes; d++) dias.push(d);
        return dias;
    }

    function renderCalendario() {
        // Actualizar header
        if (calendarioHeader) {
            calendarioHeader.innerHTML = `
                <button id="prevMes" class="px-2 py-1 rounded hover:bg-gray-700 text-white">&#8592;</button>
                <span class="text-lg font-semibold">${meses[mesActual]} ${anioActual}</span>
                <button id="nextMes" class="px-2 py-1 rounded hover:bg-gray-700 text-white">&#8594;</button>
            `;
            calendarioHeader.querySelector('#prevMes').onclick = () => {
                mesActual--;
                if (mesActual < 0) { mesActual = 11; anioActual--; }
                fechaSeleccionada = null;
                renderCalendario();
                horariosDiv.innerHTML = '';
            };
            calendarioHeader.querySelector('#nextMes').onclick = () => {
                mesActual++;
                if (mesActual > 11) { mesActual = 0; anioActual++; }
                fechaSeleccionada = null;
                renderCalendario();
                horariosDiv.innerHTML = '';
            };
        }
        diasGrid.innerHTML = '';
        const vet = veterinarioSelect.value;
        let diasDisponibles = [];
        if (vet && veterinarios[vet]) {
            diasDisponibles = veterinarios[vet].dias.filter(d => {
                const [y,m,day] = d.split('-');
                return parseInt(y) === anioActual && parseInt(m)-1 === mesActual;
            }).map(d => parseInt(d.split('-')[2]));
        }
        const diasMes = getDiasMes(mesActual, anioActual);
        diasMes.forEach((dia, idx) => {
            const div = document.createElement('div');
            if (dia === '') {
                div.className = 'h-10';
            } else {
                // Calcular el día de la semana (0=domingo, 6=sábado)
                const weekDay = ((idx % 7));
                const esLaboral = weekDay >= 1 && weekDay <= 6; // lunes a sábado
                const disponible = diasDisponibles.includes(dia) && esLaboral;
                div.textContent = dia;
                div.className = `h-10 flex items-center justify-center rounded-lg cursor-pointer transition-all ${disponible ? 'bg-white text-black font-bold shadow-lg' : 'bg-gray-800 text-gray-400'} ${esLaboral ? '' : 'opacity-50 cursor-not-allowed'}`;
                if (disponible) {
                    div.addEventListener('click', () => {
                        fechaSeleccionada = `${anioActual}-${(mesActual+1).toString().padStart(2,'0')}-${dia.toString().padStart(2,'0')}`;
                        renderHorarios();
                        // Resalta el seleccionado
                        Array.from(diasGrid.children).forEach(c => c.classList.remove('ring-2','ring-vet-orange'));
                        div.classList.add('ring-2','ring-vet-orange');
                    });
                }
            }
            diasGrid.appendChild(div);
        });
    }

    function renderHorarios() {
        horariosDiv.innerHTML = '';
        const vet = veterinarioSelect.value;
        if (vet && fechaSeleccionada && veterinarios[vet]) {
            if (veterinarios[vet].dias.includes(fechaSeleccionada)) {
                veterinarios[vet].horarios.forEach(horario => {
                    const btn = document.createElement('button');
                    btn.textContent = horario;
                    btn.className = 'bg-vet-orange text-white px-4 py-2 rounded mb-2 hover:bg-orange-500';
                    horariosDiv.appendChild(btn);
                });
            } else {
                horariosDiv.innerHTML = '<span class="text-red-400">No hay horarios disponibles para este día.</span>';
            }
        }
    }

    if (veterinarioSelect) {
        veterinarioSelect.addEventListener('change', () => {
            fechaSeleccionada = null;
            renderCalendario();
            horariosDiv.innerHTML = '';
        });
        renderCalendario();
    }
});
// --- Calendario visual tipo grid ---
document.addEventListener('DOMContentLoaded', function () {
    const diasGrid = document.getElementById('dias-grid');
    const veterinarioSelect = document.getElementById('veterinario');
    const horariosDiv = document.getElementById('horarios');
    let fechaSeleccionada = null;

    // Días de agosto 2025
    const diasMes = [
        '', '', '', '', '', '', '', // 1-2-3-4-5-6-7 (vacío para que el 1 caiga jueves)
        1,2,3,4,5,6,7,
        8,9,10,11,12,13,14,
        15,16,17,18,19,20,21,
        22,23,24,25,26,27,28,
        29,30,31
    ];

    // Veterinarios y sus días disponibles
    const veterinarios = {
        dr_gomez: {
            dias: ['2025-08-25', '2025-08-26', '2025-08-28'],
            horarios: ['09:00', '10:00', '11:00', '12:00', '13:00']
        },
        dra_perez: {
            dias: ['2025-08-26', '2025-08-27', '2025-08-29'],
            horarios: ['14:00', '15:00', '16:00', '17:00']
        },
        dr_lopez: {
            dias: ['2025-08-25', '2025-08-27', '2025-08-30'],
            horarios: ['08:00', '09:00', '10:00', '11:00']
        }
    };

    function renderCalendario() {
        diasGrid.innerHTML = '';
        const vet = veterinarioSelect.value;
        let diasDisponibles = [];
        if (vet && veterinarios[vet]) {
            diasDisponibles = veterinarios[vet].dias.map(d => parseInt(d.split('-')[2]));
        }
        diasMes.forEach((dia, idx) => {
            const div = document.createElement('div');
            if (dia === '') {
                div.className = 'h-10';
            } else {
                // Calcular el día de la semana (0=domingo, 6=sábado)
                const weekDay = ((idx % 7));
                const esLaboral = weekDay >= 1 && weekDay <= 6; // lunes a sábado
                const disponible = diasDisponibles.includes(dia) && esLaboral;
                div.textContent = dia;
                div.className = `h-10 flex items-center justify-center rounded-lg cursor-pointer transition-all ${disponible ? 'bg-white text-black font-bold shadow-lg' : 'bg-gray-800 text-gray-400'} ${esLaboral ? '' : 'opacity-50 cursor-not-allowed'}`;
                if (disponible) {
                    div.addEventListener('click', () => {
                        fechaSeleccionada = `2025-08-${dia.toString().padStart(2,'0')}`;
                        renderHorarios();
                        // Resalta el seleccionado
                        Array.from(diasGrid.children).forEach(c => c.classList.remove('ring-2','ring-vet-orange'));
                        div.classList.add('ring-2','ring-vet-orange');
                    });
                }
            }
            diasGrid.appendChild(div);
        });
    }

    function renderHorarios() {
        horariosDiv.innerHTML = '';
        const vet = veterinarioSelect.value;
        if (vet && fechaSeleccionada && veterinarios[vet]) {
            if (veterinarios[vet].dias.includes(fechaSeleccionada)) {
                veterinarios[vet].horarios.forEach(horario => {
                    const btn = document.createElement('button');
                    btn.textContent = horario;
                    btn.className = 'bg-vet-orange text-white px-4 py-2 rounded mb-2 hover:bg-orange-500';
                    horariosDiv.appendChild(btn);
                });
            } else {
                horariosDiv.innerHTML = '<span class="text-red-400">No hay horarios disponibles para este día.</span>';
            }
        }
    }

    if (veterinarioSelect) {
        veterinarioSelect.addEventListener('change', () => {
            fechaSeleccionada = null;
            renderCalendario();
            horariosDiv.innerHTML = '';
        });
        renderCalendario();
    }
});
// Cambiar dirección según sucursal seleccionada
document.addEventListener('DOMContentLoaded', function () {
    const sucursalSelect = document.getElementById('sucursal');
    const direccionSpan = document.getElementById('direccion');
    if (sucursalSelect && direccionSpan) {
        sucursalSelect.addEventListener('change', function () {
            if (sucursalSelect.value === 'caballito') {
                direccionSpan.textContent = 'Humboldt 1967, Piso 2, Caballito';
            } else if (sucursalSelect.value === 'flores') {
                direccionSpan.textContent = 'Av. Rivadavia 6500, Flores';
            }
        });
    }
});
// --- Nueva lógica para la UI de 4 columnas ---
document.addEventListener('DOMContentLoaded', function () {
    // Mostrar campos de vacuna si se elige "Vacuna"
    const servicioSelectCol = document.getElementById('servicio');
    const vacunaFields = document.getElementById('vacuna-fields');
    if (servicioSelectCol) {
        servicioSelectCol.addEventListener('change', function () {
            if (servicioSelectCol.value === 'vacuna') {
                vacunaFields.classList.remove('hidden');
            } else {
                vacunaFields.classList.add('hidden');
            }
        });
    }

    // Veterinarios y sus horarios laborales (ejemplo)
    const veterinarios = {
        dr_gomez: {
            dias: ['2025-08-25', '2025-08-26', '2025-08-28'],
            horarios: ['09:00', '10:00', '11:00', '12:00', '13:00']
        },
        dra_perez: {
            dias: ['2025-08-26', '2025-08-27', '2025-08-29'],
            horarios: ['14:00', '15:00', '16:00', '17:00']
        },
        dr_lopez: {
            dias: ['2025-08-25', '2025-08-27', '2025-08-30'],
            horarios: ['08:00', '09:00', '10:00', '11:00']
        }
    };

    const veterinarioSelect = document.getElementById('veterinario');
    const fechaInput = document.getElementById('fecha');
    const horariosDiv = document.getElementById('horarios');

    function actualizarHorarios() {
        if (!horariosDiv) return;
        horariosDiv.innerHTML = '';
        const vet = veterinarioSelect ? veterinarioSelect.value : null;
        const fecha = fechaInput ? fechaInput.value : null;
        if (vet && fecha && veterinarios[vet]) {
            if (veterinarios[vet].dias.includes(fecha)) {
                veterinarios[vet].horarios.forEach(horario => {
                    const btn = document.createElement('button');
                    btn.textContent = horario;
                    btn.className = 'bg-vet-orange text-white px-4 py-2 rounded mb-2 hover:bg-orange-500';
                    horariosDiv.appendChild(btn);
                });
            } else {
                horariosDiv.innerHTML = '<span class="text-red-400">No hay horarios disponibles para este día.</span>';
            }
        }
    }

    if (veterinarioSelect) veterinarioSelect.addEventListener('change', actualizarHorarios);
    if (fechaInput) fechaInput.addEventListener('change', actualizarHorarios);
});
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

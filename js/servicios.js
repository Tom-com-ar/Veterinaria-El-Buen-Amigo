const style = document.createElement('style');
style.textContent = `
    .flatpickr-calendar {
        max-width: 100% !important;
        width: 100% !important;
    }
    
    @media (min-width: 768px) {
        .flatpickr-calendar {
            max-width: 300px !important;
            width: 350px !important;
        }
    }

    .flatpickr-day {
        height: 40px !important;
        line-height: 40px !important;
    }
`;
document.head.appendChild(style);

document.addEventListener('DOMContentLoaded', function() {
    // Elementos del DOM
    const servicioSelect = document.getElementById('servicio-form');
    const veterinariosContainer = document.getElementById('veterinarios');
    const horariosContainer = document.getElementById('horarios');
    const confirmarBtn = document.getElementById('confirmar-reserva');

    // Configuración del calendario
    flatpickr("#calendario", {
        locale: {
            ...flatpickr.l10ns.es, // Mantener la configuración en español
            firstDayOfWeek: 1 // Comenzar la semana en lunes
        },
        minDate: "today",
        dateFormat: "Y-m-d",
        inline: true,
        static: true,
        monthSelectorType: 'static',
        enable: [
            function(date) {
                // Habilitar solo de lunes (1) a sábado (6)
                return date.getDay() !== 0;
            }
        ],
        onChange: function(selectedDates, dateStr) {
            if (selectedDates.length > 0) {
                mostrarHorarios(dateStr);
            }
        }
    });

    // Función para cargar los servicios
    function cargarServicios() {
        const servicios = [
            { id: 'consulta', nombre: 'Consulta General' },
            { id: 'vacuna', nombre: 'Vacunación' },
            { id: 'cirugia', nombre: 'Cirugía' },
            { id: 'peluqueria', nombre: 'Peluquería' }
        ];

        const select = document.createElement('select');
        select.id = 'servicio';
        select.className = 'w-full p-3 rounded-lg border border-gray-300';
        
        const defaultOption = document.createElement('option');
        defaultOption.value = '';
        defaultOption.textContent = 'Selecciona un servicio';
        select.appendChild(defaultOption);

        servicios.forEach(servicio => {
            const option = document.createElement('option');
            option.value = servicio.id;
            option.textContent = servicio.nombre;
            select.appendChild(option);
        });

        select.addEventListener('change', (e) => {
            cargarVeterinarios(e.target.value);
            resetearSelecciones(['veterinario', 'fecha', 'hora']);
        });

        servicioForm.appendChild(select);
    }

    // Función para cargar veterinarios según el servicio
    function cargarVeterinarios(servicioId) {
        veterinariosContainer.innerHTML = '';
        
        if (!servicioId) return;

        const veterinarios = obtenerVeterinariosPorServicio(servicioId);
        
        veterinarios.forEach(vet => {
            const button = document.createElement('button');
            button.className = 'w-full p-4 text-left rounded-lg bg-gray-100 hover:bg-vet-orange hover:text-white transition-colors';
            button.innerHTML = `
                <div class="font-medium">${vet.nombre}</div>
            `;

            button.addEventListener('click', () => seleccionarVeterinario(vet, button));
            veterinariosContainer.appendChild(button);
        });
    }

    // Función para mostrar horarios disponibles
    function mostrarHorarios(fecha) {
        const horarios = [
            '09:00', '09:30', '10:00', '10:30', '11:00', '11:30',
            '12:00', '12:30', '15:00', '15:30', '16:00', '16:30',
            '17:00', '17:30', '18:00'
        ];

        const horariosContainer = document.getElementById('horarios');
        horariosContainer.classList.remove('hidden');

        // Crear estructura del dropdown
        horariosContainer.innerHTML = `
            <h3 class="text-lg font-medium mb-2">Horarios Disponibles</h3>
            <div class="relative">
                <button id="horario-dropdown" type="button" 
                    class="w-full bg-white border border-gray-300 rounded-lg px-4 py-2.5 text-left flex justify-between items-center">
                    <span id="horario-seleccionado">Seleccionar horario</span>
                    <svg class="w-4 h-4 transition-transform duration-200" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"/>
                    </svg>
                </button>
                <div id="horario-opciones" 
                    class="hidden absolute z-10 w-full mt-1 bg-white border border-gray-300 rounded-lg shadow-lg max-h-60 overflow-auto">
                    <div class="py-1" role="menu">
                        ${horarios.map(hora => `
                            <button type="button" 
                                class="w-full px-4 py-2 text-left hover:bg-gray-100 focus:bg-gray-100 transition-colors" 
                                role="menuitem"
                                data-hora="${hora}">
                                ${hora}
                            </button>
                        `).join('')}
                    </div>
                </div>
            </div>
        `;

        // Obtener referencias a los elementos
        const dropdown = document.getElementById('horario-dropdown');
        const opciones = document.getElementById('horario-opciones');
        const flecha = dropdown.querySelector('svg');

        // Event listener para el botón del dropdown
        dropdown.addEventListener('click', (e) => {
            e.stopPropagation();
            const estaOculto = opciones.classList.contains('hidden');
            
            // Toggle del menú
            opciones.classList.toggle('hidden');
            
            // Rotar flecha
            flecha.style.transform = estaOculto ? 'rotate(180deg)' : '';
        });

        // Event listeners para las opciones
        opciones.querySelectorAll('button').forEach(opcion => {
            opcion.addEventListener('click', (e) => {
                const horaSeleccionada = e.target.dataset.hora;
                document.getElementById('horario-seleccionado').textContent = horaSeleccionada;
                opciones.classList.add('hidden');
                flecha.style.transform = '';
                confirmarBtn.disabled = false;
            });
        });

        // Cerrar al hacer clic fuera
        document.addEventListener('click', (e) => {
            if (!horariosContainer.contains(e.target)) {
                opciones.classList.add('hidden');
                flecha.style.transform = '';
            }
        });
    }

    // Función para seleccionar veterinario
    function seleccionarVeterinario(veterinario, buttonElement) {
        // Resetear selección previa
        document.querySelectorAll('#veterinarios button').forEach(btn => {
            btn.classList.remove('bg-vet-orange', 'text-white');
        });
        
        buttonElement.classList.add('bg-vet-orange', 'text-white');
    }

    // Función para seleccionar horario
    function seleccionarHorario(hora, buttonElement) {
        document.querySelectorAll('#horarios button').forEach(btn => {
            btn.classList.remove('bg-vet-orange', 'text-white');
        });
        
        buttonElement.classList.add('bg-vet-orange', 'text-white');
        confirmarBtn.disabled = false;
    }

    // Función para resetear selecciones
    function resetearSelecciones(elementos) {
        elementos.forEach(elemento => {
            switch(elemento) {
                case 'veterinario':
                    document.querySelectorAll('#veterinarios button').forEach(btn => {
                        btn.classList.remove('bg-vet-orange', 'text-white');
                    });
                    break;
                case 'fecha':
                    // El calendario se resetea automáticamente
                    break;
                case 'hora':
                    horariosContainer.classList.add('hidden');
                    confirmarBtn.disabled = true;
                    break;
            }
        });
    }

    // Evento para el botón de confirmar
    confirmarBtn.addEventListener('click', () => {
        const servicio = document.getElementById('servicio').value;
        const veterinario = document.querySelector('#veterinarios button.bg-vet-orange')?.textContent;
        const fecha = document.querySelector('.flatpickr-input').value;
        const hora = document.querySelector('#horarios button.bg-vet-orange')?.textContent;

        if (servicio && veterinario && fecha && hora) {
            // Aquí puedes agregar la lógica para procesar la reserva
            console.log('Reserva confirmada:', { servicio, veterinario, fecha, hora });
        }
    });

    // Funciones del control del calendario
    const calendarControl = {
        // Inicializa el calendario
        init: function () {
            this.attachEvents();
            this.plotDates();
        },
        plotDates: function () {
            document.querySelector(".calendar .calendar-body").innerHTML = "";
            calendarControl.plotDayNames();
            calendarControl.displayMonth();
            calendarControl.displayYear();
            let count = 1;
            let prevDateCount = 0;

            calendarControl.prevMonthLastDate = calendarControl.getPreviousMonthLastDate();
            let prevMonthDatesArray = [];
            let calendarDays = calendarControl.daysInMonth(
                calendar.getMonth() + 1,
                calendar.getFullYear()
            );
            // dates of current month
            for (let i = 1; i < calendarDays; i++) {
                if (i < calendarControl.firstDayNumber()) {
                    prevDateCount += 1;
                    document.querySelector(
                        ".calendar .calendar-body"
                    ).innerHTML += `<div class="prev-dates"></div>`;
                    prevMonthDatesArray.push(calendarControl.prevMonthLastDate--);
                } else {
                    // Calcular el día de la semana (0=Domingo, 1=Lunes, ..., 6=Sábado)
                    let dateObj = new Date(calendar.getFullYear(), calendar.getMonth(), count);
                    let dayOfWeek = dateObj.getDay();
                    if (dayOfWeek === 0) { // Domingo
                        document.querySelector(
                            ".calendar .calendar-body"
                        ).innerHTML += `<div class="number-item disabled" data-num=${count}><span class="dateNumber">${count++}</span></div>`;
                    } else {
                        document.querySelector(
                            ".calendar .calendar-body"
                        ).innerHTML += `<div class="number-item" data-num=${count}><a class="dateNumber" href="#">${count++}</a></div>`;
                    }
                }
            }
            //remaining dates after month dates
            for (let j = 0; j < prevDateCount + 1; j++) {
                document.querySelector(
                    ".calendar .calendar-body"
                ).innerHTML += `<div class="number-item" data-num=${count}><a class="dateNumber" href="#">${count++}</a></div>`;
            }
            calendarControl.highlightToday();
            calendarControl.plotPrevMonthDates(prevMonthDatesArray);
            calendarControl.plotNextMonthDates();
        },
        attachEvents: function () {
            let prevBtn = document.querySelector(".calendar .calendar-prev a");
            let nextBtn = document.querySelector(".calendar .calendar-next a");
            let todayDate = document.querySelector(".calendar .calendar-today-date");
            let dateNumber = document.querySelectorAll(".calendar .dateNumber");
            prevBtn.addEventListener(
                "click",
                calendarControl.navigateToPreviousMonth
            );
            nextBtn.addEventListener("click", calendarControl.navigateToNextMonth);
            todayDate.addEventListener(
                "click",
                calendarControl.navigateToCurrentMonth
            );
            for (var i = 0; i < dateNumber.length; i++) {
                // Solo agregar evento si el padre no tiene la clase 'disabled'
                if (!dateNumber[i].parentElement.classList.contains('disabled')) {
                    dateNumber[i].addEventListener(
                        "click",
                        calendarControl.selectDate,
                        false
                    );
                }
            }
        }
    };

})

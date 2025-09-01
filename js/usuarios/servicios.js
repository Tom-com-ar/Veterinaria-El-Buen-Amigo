document.addEventListener('DOMContentLoaded', function() {
    let currentStep = 1;
    const totalSteps = 6;
    let selectedData = {
        mascota: null,
        sucursal: null,
        servicio: null,
        vacuna: null,
        veterinario: null,
        fecha: null,
        hora: null
    };

    // Datos de ejemplo
    const veterinariosPorServicio = {
        consulta: [
            { id: 1, nombre: 'Dr. Juan Pérez', especialidad: 'Medicina General', foto: '../../assets/Ellipse 10.png' },
            { id: 2, nombre: 'Dra. María García', especialidad: 'Medicina General', foto: '../../assets/Ellipse 10.png' }
        ],
        vacuna: [
            { id: 3, nombre: 'Dr. Carlos López', especialidad: 'Inmunología Veterinaria', foto: '../../assets/Ellipse 10.png' },
            { id: 4, nombre: 'Dra. Ana Martínez', especialidad: 'Inmunología Veterinaria', foto: '../../assets/Ellipse 10.png' }
        ],
        cirugia: [
            { id: 5, nombre: 'Dr. Roberto Silva', especialidad: 'Cirugía Veterinaria', foto: '../../assets/Ellipse 10.png' },
            { id: 6, nombre: 'Dra. Laura Fernández', especialidad: 'Cirugía Veterinaria', foto: '../../assets/Ellipse 10.png' }
        ],
        baño: [
            { id: 7, nombre: 'María Rodríguez', especialidad: 'Peluquería Canina', foto: '../../assets/Ellipse 10.png' },
            { id: 8, nombre: 'Pedro Gómez', especialidad: 'Peluquería Canina', foto: '../../assets/Ellipse 10.png' }
        ]
    };

    const horarios = ['09:00', '09:30', '10:00', '10:30', '11:00', '11:30', '12:00', '12:30', '14:00', '14:30', '15:00', '15:30', '16:00', '16:30', '17:00', '17:30', '18:00'];

    // Elementos DOM
    const btnAnterior = document.getElementById('btn-anterior');
    const btnSiguiente = document.getElementById('btn-siguiente');
    const btnConfirmar = document.getElementById('confirmar-reserva');

    // Inicializar
    init();

    function init() {
        setupEventListeners();
        showStep(1);
        initCalendar();
    }

    function setupEventListeners() {
        // Botones de navegación
        btnAnterior.addEventListener('click', previousStep);
        btnSiguiente.addEventListener('click', nextStep);
        btnConfirmar.addEventListener('click', confirmarReserva);

        // Paso 1: Mascotas
        document.querySelectorAll('.mascota-option').forEach(option => {
            option.addEventListener('click', () => selectMascota(option));
        });

        // Paso 2: Sucursales
        document.querySelectorAll('.sucursal-option').forEach(option => {
            option.addEventListener('click', () => selectSucursal(option));
        });

        // Paso 3: Servicios
        document.querySelectorAll('.servicio-option').forEach(option => {
            option.addEventListener('click', () => selectServicio(option));
        });

        // Paso 3: Vacunas
        document.querySelectorAll('.vacuna-option').forEach(option => {
            option.addEventListener('click', () => selectVacuna(option));
        });
    }

    function showStep(step) {
        currentStep = step;
        
        // Ocultar todos los pasos
        document.querySelectorAll('.step-content').forEach(content => {
            content.classList.add('hidden');
        });
        
        // Mostrar paso actual
        document.getElementById(`paso-${step}`).classList.remove('hidden');
        
        // Actualizar indicadores
        updateStepIndicators();
        
        // Actualizar botones
        updateNavigationButtons();
        
        // Cargar contenido específico del paso
        loadStepContent(step);
    }

    function updateStepIndicators() {
        for (let i = 1; i <= totalSteps; i++) {
            const indicator = document.getElementById(`step-${i}`);
            const stepNumber = indicator.querySelector('.step-number');
            const stepText = indicator.querySelector('.step-text');
            
            // Reset all classes
            indicator.classList.remove('opacity-50', 'opacity-100');
            stepNumber.classList.remove('bg-vet-orange', 'bg-green-600', 'bg-gray-300', 'text-white', 'text-gray-500');
            stepText.classList.remove('text-gray-800', 'text-gray-500', 'font-semibold', 'font-medium');
            
            if (i < currentStep) {
                // Completed step
                indicator.classList.add('opacity-100');
                stepNumber.classList.add('bg-green-600', 'text-white');
                stepText.classList.add('text-gray-800', 'font-semibold');
            } else if (i === currentStep) {
                // Active step
                indicator.classList.add('opacity-100');
                stepNumber.classList.add('bg-vet-orange', 'text-white');
                stepText.classList.add('text-gray-800', 'font-semibold');
            } else {
                // Future step
                indicator.classList.add('opacity-50');
                stepNumber.classList.add('bg-gray-300', 'text-gray-500');
                stepText.classList.add('text-gray-500', 'font-medium');
            }
        }
    }

    function updateNavigationButtons() {
        btnAnterior.disabled = currentStep === 1;
        
        if (currentStep === totalSteps) {
            btnSiguiente.classList.add('hidden');
            btnConfirmar.classList.remove('hidden');
            btnConfirmar.disabled = !isCurrentStepCompleted();
        } else {
            btnSiguiente.classList.remove('hidden');
            btnConfirmar.classList.add('hidden');
            btnSiguiente.disabled = !isCurrentStepCompleted();
        }
    }

    function isCurrentStepCompleted() {
        switch (currentStep) {
            case 1: return selectedData.mascota !== null;
            case 2: return selectedData.sucursal !== null;
            case 3: return selectedData.servicio !== null && (selectedData.servicio !== 'vacuna' || selectedData.vacuna !== null);
            case 4: return selectedData.veterinario !== null;
            case 5: return selectedData.fecha !== null;
            case 6: return selectedData.hora !== null;
            default: return false;
        }
    }

    function loadStepContent(step) {
        switch (step) {
            case 4:
                loadVeterinarios();
                break;
            case 6:
                loadHorarios();
                break;
        }
    }

    function selectMascota(option) {
        // Limpiar selección previa
        document.querySelectorAll('.mascota-option').forEach(opt => {
            opt.classList.remove('border-vet-orange', 'bg-vet-orange/10');
        });
        
        // Marcar como seleccionado
        option.classList.add('border-vet-orange', 'bg-vet-orange/10');
        selectedData.mascota = option.dataset.mascota;
        updateNavigationButtons();
    }

    function selectSucursal(option) {
        document.querySelectorAll('.sucursal-option').forEach(opt => {
            opt.classList.remove('border-vet-orange', 'bg-vet-orange/10');
        });
        
        option.classList.add('border-vet-orange', 'bg-vet-orange/10');
        selectedData.sucursal = option.dataset.sucursal;
        updateNavigationButtons();
    }

    function selectServicio(option) {
        document.querySelectorAll('.servicio-option').forEach(opt => {
            opt.classList.remove('border-vet-orange', 'bg-vet-orange/10');
        });
        
        option.classList.add('border-vet-orange', 'bg-vet-orange/10');
        selectedData.servicio = option.dataset.servicio;
        
        // Mostrar/ocultar campos de vacuna
        const vacunaFields = document.getElementById('vacuna-fields');
        if (selectedData.servicio === 'vacuna') {
            vacunaFields.classList.remove('hidden');
            selectedData.vacuna = null; // Reset vacuna selection
        } else {
            vacunaFields.classList.add('hidden');
            selectedData.vacuna = null;
        }
        
        updateNavigationButtons();
    }

    function selectVacuna(option) {
        document.querySelectorAll('.vacuna-option').forEach(opt => {
            opt.classList.remove('border-vet-orange', 'bg-white');
        });
        
        option.classList.add('border-vet-orange', 'bg-white');
        selectedData.vacuna = option.dataset.vacuna;
        updateNavigationButtons();
    }

    function loadVeterinarios() {
        const container = document.getElementById('veterinarios');
        container.innerHTML = '';
        
        const veterinarios = veterinariosPorServicio[selectedData.servicio] || [];
        
        veterinarios.forEach(vet => {
            const vetElement = document.createElement('div');
            vetElement.className = 'veterinario-option p-6 border-2 border-gray-200 rounded-xl hover:border-vet-orange hover:bg-vet-cream/50 cursor-pointer transition-all duration-300';
            vetElement.dataset.veterinario = vet.id;
            
            vetElement.innerHTML = `
                <div class="flex items-center space-x-4">
                    <img src="${vet.foto}" alt="${vet.nombre}" class="w-16 h-16 rounded-full object-cover">
                    <div>
                        <h3 class="text-lg font-semibold text-vet-dark">${vet.nombre}</h3>
                        <p class="text-sm text-gray-600">${vet.especialidad}</p>
                        <div class="flex items-center mt-2">
                            <div class="flex text-yellow-400">
                                ${'★'.repeat(5)}
                            </div>
                            <span class="text-xs text-gray-500 ml-2">4.8 (127 reseñas)</span>
                        </div>
                    </div>
                </div>
            `;
            
            vetElement.addEventListener('click', () => selectVeterinario(vetElement, vet));
            container.appendChild(vetElement);
        });
    }

    function selectVeterinario(element, vet) {
        document.querySelectorAll('.veterinario-option').forEach(opt => {
            opt.classList.remove('border-vet-orange', 'bg-vet-orange/10');
        });
        
        element.classList.add('border-vet-orange', 'bg-vet-orange/10');
        selectedData.veterinario = vet.id;
        updateNavigationButtons();
    }

    function initCalendar() {
        const fechaInput = document.getElementById('fecha-input');
        const calendarioHidden = document.getElementById('calendario');
        
        // Configurar Flatpickr igual que en el sistema PHP
        const calendar = flatpickr(calendarioHidden, {
            locale: {
                ...flatpickr.l10ns.es,
                firstDayOfWeek: 1
            },
            minDate: "today",
            dateFormat: "d-m-Y", // Formato día-mes-año como en el PHP
            allowInput: false,
            clickOpens: true,
            enable: [
                function(date) {
                    // Habilitar solo de lunes (1) a sábado (6)
                    return date.getDay() !== 0;
                }
            ],
            onChange: function(selectedDates, dateStr) {
                if (selectedDates.length > 0) {
                    selectedData.fecha = dateStr;
                    // Mostrar formato amigable en el input visible
                    const fecha = selectedDates[0];
                    const opciones = { 
                        weekday: 'long', 
                        year: 'numeric', 
                        month: 'long', 
                        day: 'numeric' 
                    };
                    fechaInput.value = fecha.toLocaleDateString('es-ES', opciones);
                    updateNavigationButtons();
                }
            },
            onReady: function() {
                // Configurar responsive después de inicializar
                this.calendarContainer.classList.add('flatpickr-calendar-responsive');
            },
            // Configuración para popup responsive
            static: false,
            appendTo: document.body,
            positionElement: fechaInput
        });
        
        // Event listener para abrir calendario al hacer clic en el input visible
        fechaInput.addEventListener('click', function() {
            calendar.open();
        });
        
        // Prevenir que el input oculto interfiera
        calendarioHidden.style.display = 'none';
        calendarioHidden.style.position = 'absolute';
        calendarioHidden.style.left = '-9999px';
    }

    function loadHorarios() {
        const container = document.getElementById('horarios');
        container.innerHTML = '';
        
        horarios.forEach(hora => {
            const horaElement = document.createElement('div');
            horaElement.className = 'horario-option p-3 border-2 border-gray-200 rounded-lg hover:border-vet-orange hover:bg-vet-cream cursor-pointer transition-all duration-300 text-center';
            horaElement.dataset.hora = hora;
            horaElement.innerHTML = `
                <span class="font-medium text-vet-dark">${hora}</span>
            `;
            
            horaElement.addEventListener('click', () => selectHorario(horaElement, hora));
            container.appendChild(horaElement);
        });
    }

    function selectHorario(element, hora) {
        document.querySelectorAll('.horario-option').forEach(opt => {
            opt.classList.remove('border-vet-orange', 'bg-vet-orange', 'text-white');
            opt.classList.add('border-gray-200');
            opt.querySelector('span').classList.remove('text-white');
            opt.querySelector('span').classList.add('text-vet-dark');
        });
        
        element.classList.remove('border-gray-200');
        element.classList.add('border-vet-orange', 'bg-vet-orange');
        element.querySelector('span').classList.remove('text-vet-dark');
        element.querySelector('span').classList.add('text-white');
        
        selectedData.hora = hora;
        updateNavigationButtons();
    }

    function nextStep() {
        if (currentStep < totalSteps && isCurrentStepCompleted()) {
            showStep(currentStep + 1);
        }
    }

    function previousStep() {
        if (currentStep > 1) {
            showStep(currentStep - 1);
        }
    }

    function confirmarReserva() {
        if (isCurrentStepCompleted()) {
            // Aquí puedes agregar la lógica para enviar los datos al servidor
            console.log('Reserva confirmada:', selectedData);
            
            // Mostrar mensaje de confirmación
            alert('¡Reserva confirmada con éxito!\n\n' +
                  `Mascota: ${getMascotaName(selectedData.mascota)}\n` +
                  `Sucursal: ${getSucursalName(selectedData.sucursal)}\n` +
                  `Servicio: ${getServicioName(selectedData.servicio)}\n` +
                  (selectedData.vacuna ? `Vacuna: ${getVacunaName(selectedData.vacuna)}\n` : '') +
                  `Veterinario: ${getVeterinarioName(selectedData.veterinario)}\n` +
                  `Fecha: ${selectedData.fecha}\n` +
                  `Hora: ${selectedData.hora}`);
        }
    }

    // Funciones auxiliares para obtener nombres
    function getMascotaName(id) {
        const names = { '1': 'Max', '2': 'Luna', 'new': 'Nueva Mascota' };
        return names[id] || id;
    }

    function getSucursalName(id) {
        const names = { 'centro': 'Sucursal Centro', 'palermo': 'Sucursal Palermo' };
        return names[id] || id;
    }

    function getServicioName(id) {
        const names = { 
            'consulta': 'Consulta General', 
            'vacuna': 'Vacunación', 
            'cirugia': 'Cirugía', 
            'baño': 'Baño y Aseo' 
        };
        return names[id] || id;
    }

    function getVacunaName(id) {
        const names = { 'rabia': 'Rabia', 'parvovirus': 'Parvovirus', 'moquillo': 'Moquillo' };
        return names[id] || id;
    }

    function getVeterinarioName(id) {
        for (let servicio in veterinariosPorServicio) {
            const vet = veterinariosPorServicio[servicio].find(v => v.id == id);
            if (vet) return vet.nombre;
        }
        return id;
    }
});

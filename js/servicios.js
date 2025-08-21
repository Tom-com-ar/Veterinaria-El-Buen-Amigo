/*Funcionamiento del Calendario*/

const monthYear = document.getElementById("month-year");
const daysContainer = document.getElementById("days");
const prevBtn = document.getElementById("prev");
const nextBtn = document.getElementById("next");

const months = [
    "Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio",
    "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"
];

let date = new Date();

function renderCalendar() {
    const year = date.getFullYear();
    const month = date.getMonth();

    monthYear.textContent = `${months[month]} ${year}`;

    const firstDay = new Date(year, month, 1).getDay();
    const lastDate = new Date(year, month + 1, 0).getDate();
    const prevLastDate = new Date(year, month, 0).getDate();

    daysContainer.innerHTML = "";

    let startDay = firstDay === 0 ? 6 : firstDay - 1;

    // Días del mes anterior (en gris suave)
    for (let x = startDay; x > 0; x--) {
        const div = document.createElement("div");
        div.className = "text-vet-dark/40";
        div.textContent = prevLastDate - x + 1;
        daysContainer.appendChild(div);
    }

    // Días del mes actual
    for (let i = 1; i <= lastDate; i++) {
        const div = document.createElement("div");

        if (
            i === new Date().getDate() &&
            year === new Date().getFullYear() &&
            month === new Date().getMonth()
        ) {
            // Día actual resaltado
            div.innerHTML = `<span class="bg-vet-orange text-white font-bold rounded-full w-8 h-8 flex items-center justify-center mx-auto">${i}</span>`;
        } else {
            div.textContent = i;
            div.className =
                "hover:bg-vet-orange/70 hover:text-white transition-colors duration-200 rounded-full cursor-pointer";
        }

        daysContainer.appendChild(div);
    }

    // Días del mes siguiente (gris suave)
    const totalCells = startDay + lastDate;
    const nextDays = 7 - (totalCells % 7);
    if (nextDays < 7) {
        for (let j = 1; j <= nextDays; j++) {
            const div = document.createElement("div");
            div.className = "text-vet-dark/40";
            div.textContent = j;
            daysContainer.appendChild(div);
        }
    }
}

prevBtn.addEventListener("click", () => {
    date.setMonth(date.getMonth() - 1);
    renderCalendar();
});

nextBtn.addEventListener("click", () => {
    date.setMonth(date.getMonth() + 1);
    renderCalendar();
});

renderCalendar();

export function initLessonsTableAdmin() {
const tabla = document.getElementById("tablaClasesAdmin");

    if (!tabla) return;

    new DataTable('#tablaClasesAdmin');
}
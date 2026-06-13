export function initCoachesTable() {
const tabla = document.getElementById("tablaClases");

    if (!tabla) return;

    new DataTable('#tablaClases');
}
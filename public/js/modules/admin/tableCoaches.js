export function initCoachesTable() {

    const selector = '#tablaClases';

    const tabla = document.getElementById("tablaClases");
    if (!tabla) return;

  
    if ($.fn.DataTable.isDataTable(selector)) {
        return;
    }

    $(selector).DataTable({
        language: {
            url: '//cdn.datatables.net/plug-ins/1.13.8/i18n/es-ES.json'
        }
    });
}
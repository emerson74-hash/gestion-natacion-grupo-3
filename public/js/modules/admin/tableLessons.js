export function initLessonsTableAdmin() {

    const tabla = document.getElementById("tablaClasesAdmin");
    if (!tabla) return;

    if (!$.fn.DataTable.isDataTable('#tablaClasesAdmin')) {

        $('#tablaClasesAdmin').DataTable({
            language: {
                url: '//cdn.datatables.net/plug-ins/1.13.8/i18n/es-ES.json'
            },
            // Sin re-orden automático: respeta el orden cronológico del SQL (FIELD por día)
            order: []
        });

    }
}

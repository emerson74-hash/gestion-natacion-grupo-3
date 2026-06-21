export function initDeleteLesson() {
    const table = document.getElementById("tablaClasesAdmin");
    if (!table) return;

    table.addEventListener("click", (e) => {
        const btn = e.target.closest(".btn-delete");
        if (!btn) return;

        e.preventDefault();

        const url = btn.getAttribute("href");

        Swal.fire({
            title: '¿Eliminar clase?',
            text: 'Esta acción no se puede deshacer',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: 'rgb(104, 164, 168)',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Sí, eliminar',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = url;
            }
        });
    });
}
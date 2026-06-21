
export function initDeleteCoach() {
   

    const table = document.getElementById("tablaClases");

    if (!table) return;

    document.querySelectorAll('.btn-delete').forEach(button => {

        button.addEventListener('click', function (e) {

            e.preventDefault();

            const url = this.href;

            Swal.fire({
                title: '¿Eliminar entrenador?',
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

    });

}
export function initLessonsTableCoach() {

    const tabla = document.getElementById("swimmers_table");

    if (!tabla) return;

    new DataTable('#swimmers_table');

    const modal = new bootstrap.Modal(
        document.getElementById('studentsModal')
    );

    document.addEventListener('click', async (e) => {

        const btn = e.target.closest('.btn-students');

        if (!btn) return;

        const lessonId = btn.dataset.lessonId;

        const container =
            document.getElementById('studentsContainer');

        container.innerHTML = "Cargando...";

        modal.show();

        try {

            const response = await fetch(
                `?url=coach/getStudents&lesson_id=${lessonId}`
            );

            const students = await response.json();

            if (students.length === 0) {

                container.innerHTML =
                    '<div class="alert alert-info">No hay alumnos.</div>';

                return;
            }

            let html = `
                <table class="table table-sm">
                    <thead>
                        <tr>
                            <th>Apellido</th>
                            <th>Nombre</th>
                        </tr>
                    </thead>
                    <tbody>
            `;

            students.forEach(student => {

                html += `
                    <tr>
                        <td>${student.last_name}</td>
                        <td>${student.first_name}</td>
                    </tr>
                `;
            });

            html += `
                    </tbody>
                </table>
            `;

            container.innerHTML = html;

        } catch (error) {

            container.innerHTML =
                '<div class="alert alert-danger">Error al cargar alumnos.</div>';

            console.error(error);
        }
    });
}
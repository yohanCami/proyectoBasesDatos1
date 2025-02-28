<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Encabezado del modal -->
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Título del Modal</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <!-- Cuerpo del modal -->
            <div class="modal-body">
                Aquí va el contenido de tu modal.
            </div>
            <!-- Pie del modal -->
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    Cerrar
                </button>
                <button type="button" class="btn btn-primary">
                    Guardar cambios
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap JS (incluye Popper) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        <?php if ($mostrarModal): ?>
            // Crear instancia del modal y mostrarlo
            const myModal = new bootstrap.Modal(document.getElementById('exampleModal'));
            myModal.show();
        <?php endif; ?>
    });
</script>
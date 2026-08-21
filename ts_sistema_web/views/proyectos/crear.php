<div class="row mb-4">
    <div class="col-md-6">
        <h2 class="fw-bold text-dark m-0">🆕 Registrar Nuevo Proyecto</h2>
        <p class="text-muted small">TecnoSoluciones S.A. - Formulario de Alta</p>
    </div>
    <div class="col-md-6 text-md-end">
        <a href="index.php?action=proyectos" class="btn btn-outline-secondary fw-bold shadow-sm">⬅️ Volver al Panel</a>
    </div>
</div>

<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow-sm border-0 bg-white rounded-3 p-4">
            <form action="index.php?action=crear_proyecto" method="POST">
                
                <div class="mb-3">
                    <label class="form-label small fw-bold text-secondary">Nombre del Proyecto</label>
                    <input type="text" name="nombre" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label small fw-bold text-secondary">Descripción Detallada</label>
                    <textarea name="descripcion" class="form-control" rows="4" required></textarea>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label small fw-bold text-secondary">Fecha de Inicio</label>
                        <input type="date" name="fecha_inicio" class="form-control" value="<?= date('Y-m-d') ?>" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label small fw-bold text-secondary">Estado Inicial</label>
                        <select name="estado" class="form-select">
                            <option value="Activo">Activo (En Desarrollo)</option>
                            <option value="Pendiente">Pendiente (Por iniciar)</option>
                        </select>
                    </div>
                </div>

                <hr class="text-muted my-4">

                <div class="text-end">
                    <button type="reset" class="btn btn-light fw-semibold me-2">Limpiar Campos</button>
                    <button type="submit" class="btn btn-primary fw-bold px-4 shadow-sm">Guardar Proyecto</button>
                </div>

            </form>
        </div>
    </div>
</div>

</div> </body>
</html>
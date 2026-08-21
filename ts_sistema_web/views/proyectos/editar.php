<div class="row mb-4">
    <div class="col-md-6">
        <h2 class="fw-bold text-dark m-0">✏️ Modificar Proyecto</h2>
        <p class="text-muted small">TecnoSoluciones S.A. - Actualización de Datos</p>
    </div>
    <div class="col-md-6 text-md-end">
        <a href="index.php?action=proyectos" class="btn btn-outline-secondary fw-bold shadow-sm">⬅️ Volver al Panel</a>
    </div>
</div>

<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow-sm border-0 bg-white rounded-3 p-4">
            
            <form action="index.php?action=editar_proyecto&id=<?= $proyecto_actual['id'] ?>" method="POST">
                
                <div class="mb-3">
                    <label class="form-label small fw-bold text-secondary">Nombre del Proyecto</label>
                    <input type="text" name="nombre" class="form-control" value="<?= htmlspecialchars($proyecto_actual['nombre']) ?>" required>
                </div>

                <div class="mb-3">
                    <label class="form-label small fw-bold text-secondary">Descripción Detallada</label>
                    <textarea name="descripcion" class="form-control" rows="4" required><?= htmlspecialchars($proyecto_actual['descripcion']) ?></textarea>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label small fw-bold text-secondary">Fecha de Inicio</label>
                        <input type="date" name="fecha_inicio" class="form-control" value="<?= $proyecto_actual['fecha_inicio'] ?>" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label small fw-bold text-secondary">Estado del Proyecto</label>
                        <select name="estado" class="form-select">
                            <option value="Activo" <?= $proyecto_actual['estado'] === 'Activo' ? 'selected' : '' ?>>Activo (En Desarrollo)</option>
                            <option value="Pendiente" <?= $proyecto_actual['estado'] === 'Pendiente' ? 'selected' : '' ?>>Pendiente (Por iniciar)</option>
                        </select>
                    </div>
                </div>

                <hr class="text-muted my-4">

                <div class="text-end">
                    <a href="index.php?action=proyectos" class="btn btn-light fw-semibold me-2">Cancelar</a>
                    <button type="submit" class="btn btn-primary fw-bold px-4 shadow-sm">Actualizar Cambios</button>
                </div>

            </form>
        </div>
    </div>
</div>

</div> </body>
</html>
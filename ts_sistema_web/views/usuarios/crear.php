<div class="row mb-4">
    <div class="col-md-6">
        <h2 class="fw-bold text-dark m-0">👤 Registrar Nuevo Usuario</h2>
        <p class="text-muted small">Crea credenciales para un nuevo empleado</p>
    </div>
    <div class="col-md-6 text-md-end">
        <a href="index.php?action=usuarios" class="btn btn-outline-secondary fw-bold shadow-sm">⬅️ Volver</a>
    </div>
</div>

<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card shadow-sm border-0 bg-white rounded-3 p-4">
            <form action="index.php?action=crear_usuario" method="POST">
                
                <div class="mb-3">
                    <label class="form-label small fw-bold text-secondary">Nombre de Usuario</label>
                    <input type="text" name="username" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label small fw-bold text-secondary">Contraseña de Acceso</label>
                    <input type="password" name="password" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label small fw-bold text-secondary">Asignar Rol</label>
                    <select name="rol" class="form-select">
                        <option value="empleado">Empleado (Solo gestionar proyectos)</option>
                        <option value="administrador">Administrador (Control total del sistema)</option>
                    </select>
                </div>

                <hr class="text-muted my-4">

                <div class="text-end">
                    <button type="submit" class="btn btn-primary fw-bold px-4 shadow-sm">Guardar Empleado</button>
                </div>

            </form>
        </div>
    </div>
</div>
</div>
</body>
</html>
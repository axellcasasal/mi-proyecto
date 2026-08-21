<div class="row mb-4 align-items-center">
    <div class="col-md-6">
        <h2 class="fw-bold text-dark m-0">👥 Gestión de Empleados</h2>
        <p class="text-muted small mb-0">Control de acceso de usuarios al sistema</p>
    </div>
    <div class="col-md-6 text-md-end">
        <a href="index.php?action=crear_usuario" class="btn btn-primary fw-bold shadow-sm">+ Nuevo Empleado</a>
    </div>
</div>

<div class="card shadow-sm border-0 bg-white rounded-3">
    <div class="card-body p-4">
        <div class="table-responsive">
            <table class="table table-hover align-middle m-0">
                <thead class="table-light">
                    <tr>
                        <th class="text-secondary small fw-bold text-uppercase">ID</th>
                        <th class="text-secondary small fw-bold text-uppercase">Nombre de Usuario (Login)</th>
                        <th class="text-secondary small fw-bold text-uppercase">Rol / Permisos</th>
                        <th class="text-secondary small fw-bold text-uppercase text-end">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($usuarios)): ?>
                        <?php foreach ($usuarios as $u): ?>
                            <tr>
                                <td class="fw-bold text-secondary"><?= $u['id'] ?></td>
                                <td class="fw-bold text-dark">👤 <?= htmlspecialchars($u['username']) ?></td>
                                <td>
                                    <?php $badgeColor = ($u['rol'] === 'administrador') ? 'bg-danger' : 'bg-info text-dark'; ?>
                                    <span class="badge <?= $badgeColor ?> text-uppercase px-2 py-1 small"><?= htmlspecialchars($u['rol']) ?></span>
                                </td>
                                <td class="text-end">
                                    <?php 
           
                                    $usuarioLogueado = isset($_SESSION['usuario']['username']) ? $_SESSION['usuario']['username'] : 'admin';
                                    
                                    if ($u['username'] !== $usuarioLogueado): 
                                    ?>
                                        <a href="index.php?action=eliminar_usuario&id=<?= $u['id'] ?>" 
                                           class="btn btn-sm btn-outline-danger fw-semibold" 
                                           onclick="return confirm('¿Seguro que deseas eliminar a este usuario?')">
                                            Borrar
                                        </a>
                                    <?php else: ?>
                                        <span class="text-muted small fw-bold bg-light px-2 py-1 rounded">Tú (Activo)</span>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="4" class="text-center py-4 text-muted">No hay usuarios registrados.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
</div>
</body>
</html>
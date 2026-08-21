<div class="row mb-4 align-items-center">
    <div class="col-md-6">
        <h2 class="fw-bold text-dark m-0">💼 Gestión de Proyectos</h2>
        <p class="text-muted small mb-0">TecnoSoluciones S.A. - Panel de Control Operativo</p>
    </div>
    <div class="col-md-6 text-md-end mt-3 mt-md-0">
        <a href="index.php?action=crear_proyecto" class="btn btn-primary fw-bold shadow-sm">+ Nuevo Proyecto</a>
        <a href="index.php?action=reporte_pdf" target="_blank" class="btn btn-danger fw-bold shadow-sm">📊 Generar PDF</a>
    </div>
</div>

<div class="card shadow-sm border-0 bg-white rounded-3">
    <div class="card-body p-4">
        <div class="table-responsive">
            <table class="table table-hover align-middle m-0">
                <thead class="table-light">
                    <tr>
                        <th class="text-secondary small fw-bold text-uppercase">#</th>
                        <th class="text-secondary small fw-bold text-uppercase">Proyecto / Cliente</th>
                        <th class="text-secondary small fw-bold text-uppercase">Descripción</th>
                        <th class="text-secondary small fw-bold text-uppercase">Fecha Inicio</th>
                        <th class="text-secondary small fw-bold text-uppercase">Estado</th>
                        <th class="text-secondary small fw-bold text-uppercase text-end">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($proyectos)): ?>
                        <?php 
                        $item = 1; 
                        foreach ($proyectos as $p): 
                        ?>
                            <tr>
                                <td class="fw-bold text-secondary"><?= $item++ ?></td>
                                <td>
                                    <span class="fw-bold text-dark d-block"><?= htmlspecialchars($p['nombre']) ?></span>
                                    <small class="text-muted">🏢 <?= htmlspecialchars($p['cliente_nombre'] ?? 'Sin cliente') ?></small>
                                </td>
                                <td class="text-muted small"><?= htmlspecialchars($p['descripcion']) ?></td>
                                <td class="text-dark small"><?= date('d/m/Y', strtotime($p['fecha_inicio'])) ?></td>
                                <td>
                                    <?php 
                                        $statusClass = 'bg-secondary';
                                        if($p['estado'] == 'Activo') $statusClass = 'bg-success';
                                        if($p['estado'] == 'Pendiente') $statusClass = 'bg-warning text-dark';
                                    ?>
                                    <span class="badge <?= $statusClass ?> text-uppercase px-2 py-1 small"><?= $p['estado'] ?></span>
                                </td>
                                <td class="text-end">
                                    <a href="index.php?action=editar_proyecto&id=<?= $p['id'] ?>" class="btn btn-sm btn-outline-primary fw-semibold me-1">Editar</a>
                                    <a href="index.php?action=eliminar_proyecto&id=<?= $p['id'] ?>" class="btn btn-sm btn-outline-danger fw-semibold" onclick="return confirm('¿Seguro que deseas eliminar este proyecto?')">Borrar</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="6" class="text-center py-4 text-muted">
                                <span class="d-block fs-4">📂</span>
                                No se encontraron proyectos registrados actualmente.
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

</div> <footer class="footer mt-auto py-3 bg-white border-top text-center text-muted small w-100 mt-5">
    <div class="container">
        <span>&copy; <?= date('Y') ?> TecnoSoluciones S.A. - Todos los derechos reservados.</span>
    </div>
</footer>
</body>
</html>
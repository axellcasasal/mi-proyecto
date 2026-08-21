<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Acceso - TecnoSoluciones S.A.</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #f8f9fa; color: #333; }
        .card-custom {
            background: #ffffff;
            border: 1px solid #e3e6f0;
            border-top: 5px solid #0d6efd; /* Azul corporativo */
        }
        .btn-custom { background-color: #0d6efd; color: white; font-weight: bold; }
        .btn-custom:hover { background-color: #0b5ed7; }
    </style>
</head>
<body class="d-flex align-items-center justify-content-center vh-100">

<div class="container" style="max-width: 400px;">
    <div class="card card-custom p-4 shadow-sm rounded-3">
        <div class="text-center mb-4">
            <h3 class="fw-bold text-dark m-0">TecnoSoluciones</h3>
            <small class="text-muted fw-semibold">Sistema de Gestión de Proyectos</small>
        </div>

        <?php if (!empty($error)): ?>
            <div class="alert alert-danger py-2 text-center small"><?= $error ?></div>
        <?php endif; ?>

        <form action="index.php?action=login" method="POST">
            <div class="mb-3">
                <label class="form-label small fw-bold text-secondary">Identificador de Usuario</label>
                <input type="text" name="username" class="form-control" placeholder="Nombre de usuario" required>
            </div>
            
            <div class="mb-4">
                <label class="form-label small fw-bold text-secondary">Contraseña de Seguridad</label>
                <input type="password" name="password" class="form-control" placeholder="••••••••" required>
            </div>

            <button type="submit" class="btn btn-custom w-100 py-2 text-uppercase shadow-sm">Ingresar al Sistema</button>
        </form>
    </div>
</div>

</body>
</html>
<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>TecnoSoluciones S.A.</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<nav class="navbar navbar-expand-lg navbar-white bg-white border-bottom shadow-sm mb-4 py-3">
    <div class="container">
        <a class="navbar-brand fw-bold text-dark d-flex align-items-center" href="index.php?action=proyectos">
            🖥️ TecnoSoluciones
        </a>

        <div class="collapse navbar-collapse ms-4">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link text-secondary fw-semibold" href="index.php?action=proyectos">Proyectos</a>
                </li>
                <?php if (isset($_SESSION['usuario']) && $_SESSION['usuario']['rol'] === 'administrador'): ?>
                    <li class="nav-item">
                        <a class="nav-link text-secondary fw-semibold" href="index.php?action=usuarios">Usuarios</a>
                    </li>
                <?php endif; ?>
            </ul>
        </div>

        <div class="d-flex align-items-center">
            <?php if (isset($_SESSION['usuario'])): ?>
                <span class="text-secondary small me-1">Usuario:</span>
                <span class="text-primary fw-bold me-2">
                    <?= htmlspecialchars($_SESSION['usuario']['username']) ?>
                </span>
                
                <?php 
                $badgeRol = ($_SESSION['usuario']['rol'] === 'administrador') ? 'bg-danger' : 'bg-secondary'; 
                ?>
                <span class="badge <?= $badgeRol ?> text-uppercase px-2 py-1 small me-3">
                    <?= htmlspecialchars($_SESSION['usuario']['rol']) ?>
                </span>

                <a href="index.php?action=logout" class="btn btn-sm btn-outline-danger fw-semibold shadow-sm">Cerrar Sesión</a>
            <?php else: ?>
                <a href="index.php?action=login" class="btn btn-sm btn-primary fw-semibold">Iniciar Sesión</a>
            <?php endif; ?>
        </div>
    </div>
</nav>

<div class="container mb-5">
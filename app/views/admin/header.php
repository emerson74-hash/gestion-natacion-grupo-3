<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">

    <title><?= $titulo ?? 'Panel Administrativo' ?></title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Estilos globales -->
    <link rel="stylesheet" href="<?= Env::get('ASSET_URL') ?>/assets/css/style.css">

    <!-- Estilos admin -->
    <link rel="stylesheet" href="<?= Env::get('ASSET_URL') ?>/assets/css/admin.css">

</head>

<body>
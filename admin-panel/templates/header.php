<?php
$url_base="http://localhost/proyect-api/admin-panel/";
?>

<!doctype html>
<html lang="en">
    <head>
        <title>Title</title>
        <!-- Required meta tags -->
        <meta charset="utf-8" />
        <meta
            name="viewport"
            content="width=device-width, initial-scale=1, shrink-to-fit=no"
        />

        <!-- Bootstrap CSS v5.2.1 -->
        <link
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
            rel="stylesheet"
            integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
            crossorigin="anonymous"
        />
    </head>

    <body>
        <header>
            <!-- place navbar here -->

            <nav class="navbar navbar-expand navbar-light bg-light">
                <div class="nav navbar-nav">
                    <a class="nav-item nav-link active" href="#" aria-current="page">Administrador <span class="visually-hidden">(current)</span></a>
                    <!-- <a class="nav-item nav-link" href="secciones/">Inicio</a> -->
                    <a class="nav-item nav-link" href="<?=$url_base?>secciones/comercio">Comercio</a>
                    <a class="nav-item nav-link" href="<?=$url_base?>secciones/detallesdelatienda">Detalles de la tienda</a>
                    <a class="nav-item nav-link" href="<?=$url_base?>secciones/paginas">Paginas</a>
                    <a class="nav-item nav-link" href="<?=$url_base?>secciones/contacto">Contacto</a>
                    <a class="nav-item nav-link" href="<?=$url_base?>secciones/configuraciones">Configuraciones</a>
                    <a class="nav-item nav-link" href="<?=$url_base?>secciones/usuarios">Usuarios</a>
                </div>
            </nav>
            
        </header>
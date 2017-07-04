<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>jQuery - CRUD AJAX</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/pnotify/3.2.0/pnotify.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/pnotify/3.2.0/pnotify.brighttheme.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/pnotify/3.2.0/pnotify.buttons.css">
    <link rel="stylesheet" href="/css/jquery-ui.min.css">
    <link rel="stylesheet" href="/css/bootstrap.min.css">
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-md-2">
            <ul id="menu" style="display: none">
                <li class="ui-state-disabled"><div>Cadastros</div></li>
                <li>
                    <div>
                        <span class="ui-icon ui-icon-person"></span>
                        <a href="/clients/list">Clientes</a>
                    </div>
                </li>
            </ul>
        </div>
        <div class="col-md-10">
            <!-- CONTEUDO -->
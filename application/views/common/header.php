<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/css/style.css">
</head>
<body>
<div class="wrapper">
    <header>
        <div class="container">
            <nav class="navbar navbar-toggleable-md navbar-light bg-faded">
                <div id="navbarNav">
                    <?php if(isset($_SESSION['logged_in']) && $_SESSION['logged_in']) : ?>
                    <ul class="list-inline">
                        <li class="list-inline-item">
                            <a class="nav-link" href="<?php echo base_url()?>dashboard">List</a>
                        </li>
                        <li class="list-inline-item">
                            <a class="nav-link" href="<?php echo base_url()?>dashboard/phone_form">Add phone</a>
                        </li>
                        <li class="list-inline-item">
                            <a class="nav-link" href="<?php echo base_url()?>user/logout_action">Logout</a>
                        </li>
                    </ul>
                    <?php endif; ?>
                </div>
            </nav>
        </div>
    </header>
    <div class="content">


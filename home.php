<?php
// Initialize the session
session_start();

// Check if the user is logged in, if not then redirect him to login page
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: login.php");
    exit;
}
?>


<html>

<body>
    <?php

    require "config.php";
    include "navbar.php";
    include "bootstrap.html";
    ?>
    <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner ">
            <div class="carousel-item active">
                <img src="images/fundal2.jpg" class="d-block w-100 dimensiune" alt="...">
                <div class="carousel-caption d-none d-md-block clasa1">
                    <h5 class="text-dark h1">Welcome to Smart Design!</h5>
                    <p class="text-dark h4">Find the best architects and designers for your dream home</p>
                </div>
            </div>
            <div class="carousel-item">
                <img src="images/fundal4.jpg" class="d-block w-100 dimensiune" alt="...">
                <div class="carousel-caption d-none d-md-block">
                    <h5>Are you an architect or designer?</h5>
                    <p>Upload here your portfolio</p>
                </div>
            </div>
            <div class="carousel-item">
                <img src="images/fundal5.jpg" class="d-block w-100 dimensiune" alt="...">
                <div class="carousel-caption d-none d-md-block">
                    <h5 class="text-dark h1">Third slide label</h5>
                    <p class="text-dark h4">Some representative placeholder content for the third slide.</p>
                </div>
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
</body>

</html>

<style>
    .dimensiune {
        width: 100%;
        height: 90vh;
        object-fit: cover;
    }

    .clasa1 {
        position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%,-50%);}
</style>
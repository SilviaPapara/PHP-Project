<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body class="background">
    <?php
    session_start();
    include "config.php";
    include "navbar.php";
    include "upload1.php";
    include "bootstrap.html";
    ?>
    <div class="pozitionare">
        <h1 class="my-2 text-center"> <b><?php  ?></b> My Portofolio</h1>
        <h1 class="my-1 text-center"> <b> </b> Incarca aici o poza in portofoliul tau</h1>
        <form class="" method="post" enctype="multipart/form-data">
            <div class="container">
                <div class="m-auto fix my-5">
                    <label class="btn btn-dark inputLabel mb-2" for=" uploadFile"><svg class="mb-1 marginFix" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-up-square" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M15 2a1 1 0 0 0-1-1H2a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V2zM0 2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2zm8.5 9.5a.5.5 0 0 1-1 0V5.707L5.354 7.854a.5.5 0 1 1-.708-.708l3-3a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1-.708.708L8.5 5.707V11.5z" />
                        </svg>Choose File</label>
                    <input class="inputFile d-block m-auto" accept="image/* " type="file" name="uploadFile" value="" class="inputFile" />
                    <textarea class="titlePost d-block m-auto" type="text" name="description" placeholder="Description" autocomplete="off"></textarea>
                    <select class="form-select mt-2 d-block m-auto border border-dark" name="gallerySelector">
                        <option value="1"> Interior Design</option>
                        <option value="0">Exterior Design</option>
                    </select>
                    <button class="btn btn-dark my-2 w-100" type="submit" name="upload">Upload</button>
                </div>

                <div class='grid'>
                    <?php
                    $sql = "SELECT * FROM gallery WHERE id_user='$id' ORDER BY data_time DESC";
                    $result = mysqli_query($link, $sql);
                    if ($result) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            $name = $row['name'];
                            $data_time = $row['data_time'];
                            $filepath = $row['picture_name'];
                    ?>
                            <div class="m-auto my-3 border border-secondary">
                                <img class="imgTest img-fluid mb-2" src="gallery/<?php echo $filepath;  ?>">
                                <p class="px-2">
                                    <?php echo $name; ?>
                                </p>
                                <p class="px-2">
                                    <?php echo $data_time; ?>
                                </p>
                            </div>
                    <?php
                        }
                    }
                    ?>
                </div>
        </form>
        <?php
        $sql = " SELECT * FROM gallery";
        $result = mysqli_query($link, $sql);
        if ($result) {
            while ($row = mysqli_fetch_assoc($result)) {
                $title = $row['name'];
                $id_user = $row['id_user'];
                $data_time = $row['data_time'];
                $picture_name = $row['picture_name'];
            }
        }
        ?>
    </div>
    </div>
    <?php include "footer.html"; ?>
</body>

</html>

<style>
    body {
        background: rgb(245, 246, 246);
    }

    .fix {
        width: 200px;
    }

    .imgTest {
        height: 500px;
        width: 350px;
        object-fit: cover;
    }

    .dimension {
        width: 200px;
        display: block;
        line-height: 70px;
    }

    .inputLabel {
        text-align: center;
        display: block;
    }

    .marginFix {
        margin-right: 10px;
    }

    .inputFile {
        width: 0.1px;
        height: 0.1px;
        opacity: 0;
        overflow: hidden;
        position: absolute;
        z-index: -1;
    }

    .inputFile:focus+label {
        outline: 1px dotted #000;
        outline: -webkit-focus-ring-color auto 5px;
    }

    .titlePost {
        min-height: 100px;
    }

    .imgTest {
        height: 500px;
        width: 350px;
        object-fit: cover;
    }

    .imgTest:hover {
        opacity: 0.8;
    }

    .fixForm {
        display: block;
        margin: auto;
    }

    .titlePost {
        resize: none;
        width: 100%;
    }

    .grid {
        display: grid;
        grid-template-columns: 1fr 1fr 1fr;
    }

    @media screen and (max-width: 992px) {
        .grid {
            grid-template-columns: 1fr;
        }
    }
</style>
<script>
    let input = document.querySelector('.inputFile');
    let label = document.querySelector('.inputLabel');
    label.addEventListener('click', () => {
        input.click();
    })
</script>
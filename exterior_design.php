<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>


    <?php
    session_start();
    require "config.php";
    include "navbar.php";
    include "bootstrap.html";
    ?>
    <div class="container">
        <h1 class="text-center mt-4">
            Exterior Design
        </h1>
        <div class="grid">

            <?php
            $sql = "SELECT * FROM gallery JOIN users ON users.id_ = id_user WHERE gallery_name = 0 ORDER BY data_time DESC";
            $result = mysqli_query($link, $sql);
            if ($result) {
                $user_id = $_SESSION['id'];
                while ($row = mysqli_fetch_assoc($result)) {
                    $current_user_id = $row['id_'];
                    $name = $row['name'];
                    $user = $row['username'];
                    $data_time = $row['data_time'];
                    $picture_name = $row['picture_name'];
                    $id_picture = $row['id'];

                    $sql_ = "SELECT * FROM users WHERE id_ = '$user_id'";
                    $result_ = mysqli_query($link, $sql_);
                    if ($result_) {
                        while ($row_ = mysqli_fetch_assoc($result_)) {
                            $admin = $row_['admin'];
                        }
                    }
            ?>
                    <div class="m-auto d my-3 border border-secondary">
                        <img class="imgTest img-fluid mb-2" src="gallery/<?php echo $picture_name; ?>" alt="">
                        <p class="px-2 mb-0"><b>
                                <?php echo $user; ?> </b>
                            <span class="r"><?php echo $data_time; ?></span>
                        </p>
                        <hr class m-0>
                        <p class="px-2 mb-1 mt-1 "><?php echo $name ?>
                            <?php if ($user_id == $current_user_id || $admin) {
                            ?>

                                <a data-idpicture=<?php echo $id_picture; ?> class='del-photo text-danger btn float-end'>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
                                        <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 
                                2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 
                                0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z" />

                                    </svg>
                                </a>
                            <?php } ?>
                        </p>
                    </div>
            <?php
                }
            }
            ?>
        </div>
    </div>
    <?php include "footer.html"; ?>
</body>
<script src="script.js"></script>

</html>
<style>
    body {
        background: rgb(245, 246, 246);
    }

    .imgTest {
        height: 500px;
        width: 350px;
        object-fit: cover;
    }
</style>

<script>
    $(".del-photo").click(function() {
        $.post('delete_picture.php', {
            id: $(this)[0].dataset.idpicture
        }).done(function() {
            window.location.reload();
        })
    })
</script>
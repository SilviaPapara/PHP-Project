<?php
session_start();
require "config.php";
include "navbar.php";
include "bootstrap.html";
?>

<div class=container>
    <table class="table table-success table-striped mt-5 ">
        <thead>
            <tr>
                <th scope="col">User Name</th>
                <th scope="col">Joined On</th>
                <th scope="col">Delete User</th>
            </tr>
        </thead>
        <tbody>

            <?php
            $sql = "SELECT * FROM users";
            $result =  mysqli_query($link, $sql);
            if ($result) {
                while ($row = mysqli_fetch_assoc($result)) {
                    $id = $row['id_'];
                    $user = $row['username'];
                    $timeCreated = $row['created_at'];
            ?>
                    <tr>
                        <th><?php echo $user; ?></th>
                        <td><?php echo $timeCreated; ?></td>
                        <td>
                            <a data-iduser=<?php echo $id; ?> class='del-user'>
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
                                    <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 
                                2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 
                                0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z" />

                                </svg>
                            </a>
                        </td>
                    </tr>
            <?php
                }
            }
            ?>
        </tbody>
    </table>

</div>

<style>
    .del-user{
        cursor: pointer;
    }
</style>

<script>
    $(".del-user").click(function() {
        $.post('delete_user_admin.php', {
            id: $(this)[0].dataset.iduser
        }).done(function() {
            window.location.reload();
        })
    })
</script>
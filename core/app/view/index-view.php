<?php 

    $user = UserData::getByID($_SESSION['user_id']);

?>

<div class="container text-center mt-5">
    <div class="col-md-12">
        <h1 class="display-4">¡Bienvenido, <?php echo $user->nombre; ?>!</h1>
    </div>
    

</div>
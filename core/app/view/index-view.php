<?php 

    $user = UserData::getByID($_SESSION['user_id']);

?>

<div class="container">
    <div class ="col-md-12">
        <H2> Hola,  <?php echo $user->nombre; ?> </H2>
    </div>
</div>
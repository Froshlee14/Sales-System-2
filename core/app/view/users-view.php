<?php

	if(!isset($_SESSION["user_id"])){
		Core::redir("./");
	}

	if(isset($_GET["opt"]) && $_GET["opt"] == "all"){
		
		$listaUsuarios = UserData::getUsers();
		//var_dump($listaUsuarios);

?>
	
	<?php
		if(count($listaUsuarios)>0){
	?>

		<div  class="bd-cheatsheet container-fluid bg-trasprent" style="height: 100vh; margin: 15px;">
            <div class=" table-responsive">

                <div class="iq-side-content sticky-xl-top d-flex justify-content-between align-items-center">
                    <h2><?php echo "Usuarios"; ?></h2>
                    <a class="btn btn-primary" href="./?view=users&opt=add"> Nuevo </a>
                </div>

                <br>
                
                <div class= "card iq-document-card">
                    <div class="table-responsive">
                    <table  class="table table-striped">
                        <thead>
                        <tr>
                            <th scope="col"> #</th>
                            <th scope="col">Nombre</th>
                            <th scope="col">Username</th>
                            <th scope="col"> Acción </th>
                        </tr>
                        </thead>
                        <tbody>
                        

                            <?php
                                foreach($listaUsuarios as $key => $row){
                            ?>
                                <tr>
                                    <th scope="row"> <?php echo $row->id;?> </th>
                                    <td> <?php echo $row->nombre;?> </td>
                                    <td> <?php echo $row->username;?> </td>
                                    <td> <a href="./?view=users&opt=edit&id= <?php echo $row->id;?> "> Ver/Editar </a></td>
                                    <!-- <td> <a href="./?action=users&opt=delete&id= <?php echo $row->id;?> " class"btn btn-warning"> Eliminar </a></td> -->
                                </tr>
                            
                            <?php
                                }
                            ?>
                        
                        </tbody>
                    </table>
                    </div>
                </div>
            </div>
        </div>


		
	<?php
		}
		else{
	?>
        <div class="alert alert-bottom alert-danger alert-dismissible fade show " role="alert">
            <span> No hay registros</span>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
	<?php
		}
	}
	if(isset($_GET["opt"]) && $_GET["opt"] == "add"){
	?>


        <div  class="bd-cheatsheet container-fluid bg-trasprent" style="height: 100vh; margin: 15px;">
            <div class=" table-responsive">
                <div class="iq-side-content sticky-xl-top d-flex justify-content-between align-items-center">
                    <h2> Nuevo Usuario</h2>
                </div>
                <br>			
					<form method="post" action="./?action=users&opt=add">
						<div class="mb-3 form-floating">
							<input type="text" class="form-control" id="name" placeholder="Name" name="nombre">
							<label for="floatingInput1">Nombre</label>
						</div>
						<div class="mb-3 form-floating">
							<input type="password" class="form-control" id="pass" placeholder="Password" name="password">
							<label for="floatingPassword">Contraseña</label>
						</div>
						<div class="mb-3 form-floating">
							<input type="tetx" class="form-control" id="username" placeholder="Username"name="username">
							<label for="floatingInput1">Username</label>
						</div>
						<div class="mb-3 form-floating">
		    				<button type="submit" class="btn btn-primary">Agregar</button>
						</div>	
					</form>
            </div>
        </div>

	
	<?php
	}
	if(isset($_GET["opt"]) && $_GET["opt"] == "edit"){
		if(!isset($_GET["id"]) or $_GET["id"] == ""){
			Core::addToastr('info','Error');
			Core::redir("../?view=users&opt=all");
		}
		
		$user = UserData::getByID($_GET["id"]);
		$found = False;
		if($user!=Null){
			$found = True;
		}
		if($found){
	?>
	

        <div  class="bd-cheatsheet container-fluid bg-trasprent" style="height: 100vh; margin: 15px;">
            <div class=" table-responsive">
                <div class="iq-side-content sticky-xl-top d-flex justify-content-between align-items-center">
                    <h2> Editar usuario > <?php  echo $user->nombre; ?> </h2>
                    <a href="./?action=users&opt=delete&id=<?php echo $user->id; ?>" class="btn btn-danger">Dar de baja</a>
                </div>
            <br>
			<form method="post" action="./?action=users&opt=update">
				<input type="hidden" class="form-control" id="nombre" value="<?php  echo $user->id; ?>" name="user_id">
							
				<div class="mb-3 form-floating">
					<input type="text" class="form-control" id="nombre" value="<?php  echo $user->nombre; ?>" name="nombre">
					<label for="floatingInput1">Nombre</label>
				</div>
				<div class="mb-3 form-floating">
					<input type="tetx" class="form-control" id="username" value="<?php  echo $user->username; ?>" name="username">
					<label for="floatingInput1">Username</label>
				</div>
                <div class="d-flex justify-content-between">
                <div class="mb-3 form-floating">
                    <button type="submit" class="btn btn-primary">Actualizar</button>
                </div>
            </form>
            </div>
            </div>
        </div>

<?php
		}
	}
?>
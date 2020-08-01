<?php
require 'db.php';
include_once 'db2.php';
$message = '';
include 'dbtext.php';

//consulta para el label de opciones
//$query=mysqli_query($mysqli,"SELECT id_user,username, privilegios_user from usuarios");


if (isset ($_POST['username']) && isset($_POST['privilegios']) && isset($_POST['email']) && isset($_POST['password'])) {
  $username = $_POST['username'];
  $privilegios = $_POST['privilegios'];
  $email = $_POST['email'];
  $password = $_POST['password'];
  $password=md5($password);
  //$sql = 'INSERT INTO producto(nombre,color,marca,precio,existencias,tipo,status) VALUES(:name, :email,:marca,:precio,:existencias,:tipo,1)';
  $sql = 'INSERT INTO usuarios (username,correo_user,pass_user,privilegios_user,status_user) VALUES(:username, :email, :password,:privilegios,1)';
  $statement = $connection->prepare($sql);
  if ($statement->execute([':username' => $username, ':email' => $email, ':privilegios'=> $privilegios, ':password'=>$password])) {
    $message = 'data inserted successfully';
  }else{
    $message = 'No se pudieron insertar los datos';
    echo $privilegios;
    echo $username;
    echo $email;
    echo $password;
  }

}

 ?>
<?php require 'header.php'; ?>
<div class="container">
  <div class="card mt-5">
    <div class="card-header">
      <h2>Agregar Usuario</h2>
    </div>
    <div class="card-body">
      <?php if(!empty($message)): ?>
        <div class="alert alert-success">
          <?= $message; ?>
        </div>
      <?php endif; ?>
      <form method="post">

        <div class="form-group">
          <label for="username">username</label>
          <input type="text" name="username" id="usernmae" class="form-control"required>
        </div>

        <div class="form-group">
          <label for="email">correo</label>
          <input type="email" name="email" id="email" class="form-control"required>
        </div>

        <div class="form-group">
          <label for="privilegios">Privilegios</label>
          <br>
          <select name="privilegios" id="privilegios">
          <option value="Administrador">Administrador</option>
          <option value="Usuario">Usuario</option>
          </select>
        </div>
          
          <?php 
        ?>
        <div class="form-group">
          <label for="password">Contraseña</label>
          <input type="text" name="password" id="password" class="form-control" required>
        </div>
        </div>
        
        <div class="form-group">
          <button type="submit" class="btn btn-info">Crear Usuario</button>
        </div>
      </form>
    </div>
  </div>
</div>
<?php require 'footer.php'; ?>

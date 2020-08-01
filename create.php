<?php
require 'db.php';
$message = '';
include 'dbtext.php';
$query=mysqli_query($mysqli,"SELECT id, nombre_color from color");
$query_marca=mysqli_query($mysqli,"SELECT id, nombre_marca from marca");
$query_tipo=mysqli_query($mysqli,"SELECT id, tipo_producto from tipo");
if (isset ($_POST['nombre'])  && isset($_POST['test']) && isset($_POST['test1']) && isset($_POST['precio']) && isset($_POST['existencias'])&& isset($_POST['test2'])) {
  $name = $_POST['nombre'];
  $email = $_POST['test'];
  $marca = $_POST['test1'];
  $precio = $_POST['precio'];
  $existencias = $_POST['existencias'];
  $tipo = $_POST['test2'];

$nuevo_usuario=mysqli_query($mysqli,"SELECT nombre from producto where nombre='$name' AND status=1");
if(mysqli_num_rows($nuevo_usuario)>0)
{
  echo "<script>alert('Este producto ya existe');</script>";
}else{
  $sql = 'INSERT INTO producto(nombre,color,marca,precio,existencias,tipo,status) VALUES(:name, :email,:marca,:precio,:existencias,:tipo,1)';
  $statement = $connection->prepare($sql);
  if ($statement->execute([':name' => $name, ':email' => $email, ':marca'=> $marca, ':precio'=>$precio,':existencias'=>$existencias, ':tipo'=>$tipo])) {
    $message = 'Producto insertado';
  }else{
    $message = 'No se pudieron insertar los datos';
  }

}
  
  

}

 ?>
<?php require 'header.php'; ?>
<div class="container">
  <div class="card mt-5">
    <div class="card-header">
      <h2>Crear producto</h2>
    </div>
    <div class="card-body">
      <?php if(!empty($message)): ?>
        <div class="alert alert-success">
          <?= $message; ?>
        </div>
      <?php endif; ?>
      <form method="post">

        <div class="form-group">
          <label for="nombre">Nombre</label>
          <input type="text" name="nombre" id="nombre" class="form-control" required>
        </div>

        <div class="form-group">
          <label for="color">Color</label>
          <br>
          <select name="test" id="test">
          <?php while ($datos=mysqli_fetch_array($query))
          {
          ?>
          <option value="<?php echo $datos['id'] ?>"> <?php echo $datos['nombre_color']?></option>
          <?php
          }
          ?>
          </select>
        </div>

        <div class="form-group">
          <label for="marca">Marca</label>
          <br>
          <select name="test1" id="test1">
          <?php while ($datos1=mysqli_fetch_array($query_marca))
          {
          ?>
          <option value="<?php echo $datos1['id'] ?>"> <?php echo $datos1['nombre_marca']?></option>
          <?php
          }
          ?>
          </select>
          
        </div>
        <div class="form-group">
          <label for="precio">Precio</label>
          <input type="number" name="precio" id="precio" min="1" pattern="^[0-9]+" class="form-control" required>
        </div>
        <div class="form-group">
          <label for="existencias">Existencias</label>
          <input type="number" name="existencias" id="existencias" min="1" pattern="^[0-9]+" class="form-control" required>
        </div>
        <div class="form-group">
          <label for="tipo">Tipo</label>
          <br>
          <select name="test2" id="test2">
          <?php while ($datos2=mysqli_fetch_array($query_tipo))
          {
          ?>
          <option value="<?php echo $datos2['id'] ?>"> <?php echo $datos2['tipo_producto']?></option>
          <?php
          }
          ?>
          </select>

          
        </div>
        

        <div class="form-group">
          <button type="submit" class="btn btn-info">Crear!</button>
        </div>
      </form>
    </div>
  </div>
</div>
<?php require 'footer.php'; ?>

<?php
require 'db.php';
$id = $_GET['id'];
$sql = 'SELECT nombre, color, marca, precio, existencias FROM producto WHERE id=:id';
include 'dbtext.php';
$query=mysqli_query($mysqli,"SELECT id, nombre_color from color");
$query_marca=mysqli_query($mysqli,"SELECT id, nombre_marca from marca");
$query_tipo=mysqli_query($mysqli,"SELECT id, tipo_producto from tipo");
$statement = $connection->prepare($sql);
$statement->execute([':id' => $id ]);
$person = $statement->fetch(PDO::FETCH_OBJ);
if (isset ($_POST['nombre'])  && isset($_POST['color']) && isset($_POST['marca']) && isset($_POST['precio']) && isset($_POST['existencias'])&& isset($_POST['pina']) ) {
  $name = $_POST['nombre'];
  $email = $_POST['color'];
  $marca = $_POST['marca'];
  $precio = $_POST['precio'];
  $existencias = $_POST['existencias'];
  $pina=$_POST['pina'];
  $sql = 'UPDATE producto SET nombre=:name, color=:email, marca=:marca, precio=:precio, existencias=:existencias-:pina WHERE id=:id';
  
  if($_POST['pina']>$_POST['existencias']){
    echo "<script>alert('La cantidad que quieres llevarte es mayor a la existente');</script>";
    $sql = 'UPDATE producto SET nombre=:name, color=:email, marca=:marca, precio=:precio, existencias=:existencias WHERE id=:id';
    
  }else{
    $statement = $connection->prepare($sql);
  if ($statement->execute([':name' => $name, ':email' => $email,':marca'=>$marca, ':precio'=>$precio,'existencias'=>$existencias, 'pina'=>$pina, ':id' => $id])) {
    header("Location: /index_ventas.php");
  }

  }

  
  



}


 ?>
<?php require 'header_ventas.php'; ?>
<div class="container">
  <div class="card mt-5">
    <div class="card-header">
      <h2>Ventas</h2>
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
          <input value="<?= $person->nombre; ?>" type="text" name="nombre" id="nombre" class="form-control" readonly>
        </div>
        <div style="display: none" class="form-group">
          <label for="color">Color</label>
          <br>
          <select name="color" id="color">
          <?php while ($datos=mysqli_fetch_array($query))
          {
          ?>
          <option value="<?php echo $datos['id'] ?>"> <?php echo $datos['nombre_color']?></option>
          
          <?php
          }
          ?>
          </select>
        </div>
        <div style="display: none" class="form-group">
          <label for="marca">Marca</label>
          <br>
          <select value="<?=$person->marca; ?>" name="marca" id="marca">
          <?php while ($datos=mysqli_fetch_array($query_marca))
          {
          ?>
          <option  value="<?php echo $datos['id'] ?>"> <?php echo $datos['nombre_marca']?></option>
          <?php
          }
          ?>
          </select>
        </div>
        <div class="form-group">
          <label for="precio">Precio</label>
          <input value="<?= $person->precio; ?>" type="number" name="precio" id="precio" min="1" pattern="^[0-9]+" class="form-control" readonly>
        </div>
        <div class="form-group">
          <label for="existencias">Existencias</label>
          <input value="<?= $person->existencias; ?>" type="number" name="existencias" id="existencias" min="1" pattern="^[0-9]+" class="form-control" readonly>
        </div>
        <div class="form-group">
          <label for="pina">Cuantas te quieres llevar</label>
          <input type="number" name="pina" id="pina" min="1" pattern="^[0-9]+" class="form-control" required>
        </div>

        <div class="form-group">
          <button type="submit" class="btn btn-info">Comprar!</button>
        </div>
      </form>
    </div>
  </div>
</div>
<?php require 'footer.php'; ?>
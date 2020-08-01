<?php
require 'db.php';
$sql = 'SELECT p.id, p.nombre, c.nombre_color,m.nombre_marca, p.precio, p.existencias, t.tipo_producto FROM producto p
INNER join color c on c.id=p.color
inner join marca m on m.id=p.marca
inner join tipo t on t.id=p.tipo
WHERE p.status=1 AND p.existencias>0';
$statement = $connection->prepare($sql);
$statement->execute();
$producto = $statement->fetchAll(PDO::FETCH_OBJ);
 ?>
<?php require 'header_ventas.php'; ?>
<div class="container">
  <div class="card mt-5">
    <div class="card-header">
      <h2>Inventario</h2>
    </div>
    <div class="card-body">
      <table class="table table-bordered">
        <tr>
          <th>ID</th>
          <th>Nombre</th>
          <th>Color</th>
          <th>Marca</th>
          <th>Precio</th>
          <th>Existencias</th>
          <th>Tipo</th>
          <th>Opciones</th>
        </tr>
        <?php foreach($producto as $person): ?>
          <tr>
            <td><?= $person->id; ?></td>
            <td><?= $person->nombre; ?></td>
            <td><?= $person->nombre_color; ?></td>
            <td><?= $person->nombre_marca; ?></td>
            <td><?= $person->precio; ?></td>
            <td><?= $person->existencias; ?></td>
            <td><?= $person->tipo_producto; ?></td>
            
            <td>
              <a href="ventas.php?id=<?= $person->id ?>" class="btn btn-info">Comprar</a>
              
            </td>
          </tr>
        <?php endforeach; ?>
      </table>
    </div>
  </div>
</div>
<?php require 'footer.php'; ?>
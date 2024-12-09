<?php
require "crud.php";

// Recibe los datos de búsqueda desde el cliente
$data = $_POST['busqueda'] ?? '';

// Inicializa la consulta SQL
$sql = "SELECT * FROM productos WHERE 1";

// Si hay un término de búsqueda, agrega condiciones para los diferentes campos
if ($data != "") {
    $sql .= " AND (id_producto LIKE :busqueda 
                OR nombre_producto LIKE :busqueda 
                OR estado LIKE :busqueda 
                OR estado LIKE :busqueda 
				OR stock LIKE :busqueda 
				OR categoria LIKE :busqueda 
                OR producto_iva_rise LIKE :busqueda)";
}

// Ordena los resultados por id_producto de forma descendente
$sql .= " ORDER BY id_producto DESC";

$consulta = $pdo->prepare($sql);

// Asocia el parámetro de búsqueda si se ha especificado
if ($data != "") {
    $consulta->bindValue(':busqueda', "%$data%");
}

$consulta->execute();
$resultado = $consulta->fetchAll(PDO::FETCH_ASSOC);

// Genera el HTML para la tabla de resultados
foreach ($resultado as $data) {
    $pv = $data['precio_unitario'] * $data['valor_iva_risa'] / 100;
    $pvp = $data['precio_unitario'] + $pv;

    $estado = $data['estado'] == 'activo' ? 'Desactivar' : 'Activar';
    $buttonClass = $data['estado'] == 'activo' ? 'btn btn-danger' : 'btn btn-success';
    $buttonText = htmlspecialchars($estado, ENT_QUOTES, 'UTF-8');

    echo "<tr>
            <td>".htmlspecialchars($data['id_producto'], ENT_QUOTES, 'UTF-8')."</td>
            <td>".htmlspecialchars($data['nombre_producto'], ENT_QUOTES, 'UTF-8')."</td>
            <td>".htmlspecialchars($data['descripcion'], ENT_QUOTES, 'UTF-8')."</td>
            <td>".htmlspecialchars($data['precio_unitario'], ENT_QUOTES, 'UTF-8')."</td>
            <td>".htmlspecialchars($data['stock'], ENT_QUOTES, 'UTF-8')."</td>
            <td>".htmlspecialchars($data['estado'], ENT_QUOTES, 'UTF-8')."</td>
            <td>".htmlspecialchars($data['categoria'], ENT_QUOTES, 'UTF-8')."</td>
            <td>".htmlspecialchars($data['producto_iva_rise'], ENT_QUOTES, 'UTF-8')."</td>
            <td>".htmlspecialchars($data['valor_iva_risa'], ENT_QUOTES, 'UTF-8')."</td>
            <td>".htmlspecialchars($pvp, ENT_QUOTES, 'UTF-8')."</td>
            <td>
                <button type='button' class='btn btn-primary' onclick=Editar('".$data['id_producto']."')>Editar</button>
                <button type='button' class='".$buttonClass."' onclick='Eliminar(".$data['id_producto'].", \"".$data['estado']."\")'>".$buttonText."</button>
            </td>
          </tr>";
}
?>








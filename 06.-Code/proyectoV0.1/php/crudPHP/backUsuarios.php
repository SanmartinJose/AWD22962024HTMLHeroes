<?php
$action = $_POST['action'];
$crud = new Crud();

if ($action == 'create') {
	$nombres = $_POST['nombres'];
    $apellidos = $_POST['apellidos'];
    $cedula = $_POST['cedula'];
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $telefono = $_POST['telefono'];
    $direccion = $_POST['direccion'];
    $rol = $_POST['rol'];
	
	$data = $crud->create($id_usuario
	, $nombres, $apellidos, $cedula, $email, $username, $password, $telefono, $direccion, $rol);
	echo $data;
}elseif ($action == 'read') {
	$data = $crud->read();
	echo $data;
}elseif ($action == 'edit') {
	$id = $_POST['id'];
	$data = $crud->edit($id);
	echo $data;
}elseif ($action == 'desactive') {
	$id_usuario = $_POST['id_usuario'];
	$data = $crud->desactive($id_usuario);
	echo $data;
}elseif($action == 'active'){
	$id_usuario = $_POST['id_usuario'];
	$data = $crud->active($id_usuario);
	echo $data;
}elseif ($action == 'updateUser') {
	$id_usuario = $_POST['id_usuario'];
	$nombres = $_POST['nombres'];
    $apellidos = $_POST['apellidos'];
    $cedula = $_POST['cedula'];
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $telefono = $_POST['telefono'];
    $direccion = $_POST['direccion'];
    $rol = $_POST['rol'];
	$data = $crud->update($id_usuario, $nombres, $apellidos, $cedula, $email, $username, $password, $telefono, $direccion, $rol);
	echo $data;
}elseif($action == 'loadRols'){
	$data = $crud->loadRols();
	echo $data;
}elseif($action == 'createRol'){
	$nombre_rol = $_POST['nombre_rol'];
    $descripcion = $_POST['descripcion'];
    $accesos = $_POST['accesos'];
	$data = $crud->createRol($nombre_rol, $descripcion, $accesos);
	echo $data;
}elseif ($action == 'getUserById') {
    $id_usuario = $_POST['id_usuario'];
    $data = $crud->getUsuariosById($id_usuario);
	echo $data;
    
}

class Crud{
	 public $conn = null;
	 function __construct(){
	 	$this->conn = new mysqli('localhost','admin','admin','sistema_inventario');
		 if ($this->conn->connect_error) {
			die('Connection failed: ' . $this->conn->connect_error);
		}
	 }
	
	function create($nombres, $apellidos, $cedula, $email, $username, $password, $telefono, $direccion, $rol) {
		$passphrase = 'Password';
		$encryptedPassword = openssl_encrypt($password, 'aes-256-cbc', $passphrase, 0, substr(hash('sha256', $passphrase, true), 0, 16));
	
		$stmt = $this->conn->prepare("INSERT INTO usuarios (nombre, apellido, cedula, email, username, passwordLogin, telefono, direccion, id_rol) 
									  VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
	
		$stmt->bind_param("ssssssssi", $nombres, $apellidos, $cedula, $email, $username, $encryptedPassword, $telefono, $direccion, $rol);
	
		// Ejecutamos la consulta
		if ($stmt->execute()) {
			return json_encode(['status' => 'success', 'message' => 'User registered successfully.']);
		} else {
			return json_encode(['status' => 'error', 'message' => 'Execution failed: ' . $stmt->error]);
		}
		$stmt->close();
	}

	function createRol($nombre_rol, $descripcion, $accesos) {
		$stmt = $this->conn->prepare("INSERT INTO roles (nombre_rol, descripcion, accesos) VALUES (?, ?, ?)");
	
		$stmt->bind_param("sss", $nombre_rol, $descripcion, $accesos);
	
		// Ejecutamos la consulta
		if ($stmt->execute()) {
			return json_encode(['status' => 'success', 'message' => 'Rol registered successfully.']);
		} else {
			return json_encode(['status' => 'error', 'message' => 'Execution failed: ' . $stmt->error.$nombre_rol]);
		}
		$stmt->close();
	}
	
	function loadRols(){
		$con = $this->conn->query("SELECT id_rol, nombre_rol FROM roles");
		$roles = [];

		if ($con->num_rows > 0) {
			while ($row = $con->fetch_assoc()) {
				$roles[] = $row;
			}
		}
		echo json_encode($roles);
	}

	function read(){
		$table = " ";
		$res = $this->conn->query("SELECT u.id_usuario, u.nombre, u.apellido, u.cedula, u.email, u.username, u.telefono, r.nombre_rol AS rol, r.accesos, u.estado FROM usuarios u JOIN roles r ON u.id_rol = r.id_rol");
		if ($res->num_rows > 0) {
			while ($row = $res->fetch_array()) {
				$table .= "<tr>";
				$table .= "<td>".$row['id_usuario']."</td>";
				$table .= "<td>".$row['nombre']."</td>";
				$table .= "<td>".$row['apellido']."</td>";
				$table .= "<td>".$row['cedula']."</td>";
				$table .= "<td>".$row['email']."</td>";
                $table .= "<td>".$row['username']."</td>";
                $table .= "<td>".$row['telefono']."</td>";
                $table .= "<td>".$row['rol']."</td>";
                $table .= "<td>".$row['accesos']."</td>";
                $table .= "<td>".$row['estado']."</td>";
				$table .= "<td>
							<button type='button' class='btn btn-primary' onclick='editarUsuario(".$row['id_usuario'].")'>Editar</button>";
                if($row['estado'] == 'activo'){
                    $table .="<button type='button' class='btn btn-danger' onclick='desactivarUsuario(".$row['id_usuario'].")'>Desactivar</button></td>";
                }else{
                    $table .="<button type='button' class='btn btn-success' onclick='activarUsuario(".$row['id_usuario'].")'>Activar</button></td>";
                }
				$table .= "</tr>";
			}
			$table.="</table>";
			return $table;
		}else{
			$table.="</table>";
			return $table;
		}
	}

	function edit($id){
		$jsondata = array();
		$res = $this->conn->query("SELECT * FROM persona WHERE id=".$id);
		while ($row = $res->fetch_array()){
			$jsondata['id'] = $row['id'];
			$jsondata['name'] = $row['nombre'];
			$jsondata['lastname'] = $row['apellido'];
			$jsondata['email'] = $row['email'];
			$jsondata['age'] = $row['edad'];
			$jsondata['birthday'] = $row['fnac'];
			header('Content-type: application/json; charset=utf-8');
    		return json_encode($jsondata);
    		exit();
		}
	}
	function desactive($id_usuario) {
		$stmt = $this->conn->prepare("UPDATE usuarios SET estado = 'desactivo' WHERE id_usuario = ?");

		$stmt->bind_param("i", $id_usuario);
		
		if ($stmt->execute()) {
			return json_encode(['status' => 'success', 'message' => 'Rol registered successfully.']);
		} else {
			return json_encode(['status' => 'error', 'message' => 'Execution failed: ' . $stmt->error]);
		}
		$stmt->close();
	}
	function active($id_usuario){
		$stmt = $this->conn->prepare("UPDATE usuarios SET estado = 'activo' WHERE id_usuario = ?");

		$stmt->bind_param("i", $id_usuario);
		
		if ($stmt->execute()) {
			return json_encode(['status' => 'success', 'message' => 'Rol registered successfully.']);
		} else {
			return json_encode(['status' => 'error', 'message' => 'Execution failed: ' . $stmt->error]);
		}
		$stmt->close();
	}
	function getUsuariosById($id_usuario) {
		$query = "SELECT id_usuario,nombre, apellido, cedula, email, username, passwordLogin, telefono, direccion, id_rol FROM usuarios WHERE id_usuario = ?";
		$stmt = $this->conn->prepare($query);
		$stmt->bind_param("i", $id_usuario);  // Usa $id_usuario en lugar de $id
		$stmt->execute();
		$result = $stmt->get_result();
		
		if ($result->num_rows > 0) {
			$user = $result->fetch_assoc();
			$passphrase = 'Password';
			$decryptedPassword = openssl_decrypt($user['passwordLogin'], 'aes-256-cbc', $passphrase, 0, substr(hash('sha256', $passphrase, true), 0, 16));
			
			$user['passwordLogin'] = $decryptedPassword;
			$data = json_encode($user);
		} else {
			$data = json_encode(['status' => 'error', 'message' => 'No user found with the given ID']);
		}
	
		$stmt->close();  // Cierra la declaración después de procesar los datos
		return $data;
	}
	
	function update($id_usuario, $nombres, $apellidos, $cedula, $email, $username, $password, $telefono, $direccion, $rol) {
		$passphrase = 'Password';
		$encryptedPassword = openssl_encrypt($password, 'aes-256-cbc', $passphrase, 0, substr(hash('sha256', $passphrase, true), 0, 16));
	
		// Consulta para actualizar los datos del usuario existente
		$stmt = $this->conn->prepare("UPDATE usuarios 
									  SET nombre = ?, apellido = ?, cedula = ?, email = ?, username = ?, passwordLogin = ?, telefono = ?, direccion = ?, id_rol = ?
									  WHERE id_usuario = ?");
	
		$stmt->bind_param("ssssssssii", $nombres, $apellidos, $cedula, $email, $username, $encryptedPassword, $telefono, $direccion, $rol, $id_usuario);
	
		// Ejecutamos la consulta
		if ($stmt->execute()) {
			return json_encode(['status' => 'success', 'message' => 'User updated successfully.']);
		} else {
			return json_encode(['status' => 'error', 'message' => 'Execution failed: ' . $stmt->error]);
		}
		$stmt->close();
	}
	
	
}

?>
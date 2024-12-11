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
	, $nombres, $apellidos, $cedula, $email, $username, $password, $telefono, $direccion);
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
	 	$this->conn = new mysqli('bshfoyw8lhufkszxhddq-mysql.services.clever-cloud.com','utoyqieuqvce4tua','OqTJFQWHhe9FNxgfYdni','bshfoyw8lhufkszxhddq');
		 if ($this->conn->connect_error) {
			die('Connection failed: ' . $this->conn->connect_error);
		}
	 }
	
	function create($first_name, $last_name, $cedula, $email, $username, $hashed_password, $phone, $address) {
		$passphrase = 'Password';
		$encryptedPassword = openssl_encrypt($hashed_password, 'aes-256-cbc', $passphrase, 0, substr(hash('sha256', $passphrase, true), 0, 16));
		$creation_date = date('Y-m-d H:i:s');
        $status = 'activo';

        $stmt = $this->conn->prepare("INSERT INTO `users` ( `first_name`, `last_name`, `cedula`, `email`, `username`, `passwordLogin`, `phone`, `adress`, `creation_date`, `status`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param('ssssssssss', $first_name, $last_name, $cedula, $email, $username, $encryptedPassword, $phone, $address, $creation_date, $status);

        if ($stmt->execute()) {
            $success = true;
        } else {
            $errors['database'] = "Error en la base de datos: " . $stmt->error;
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
		$res = $this->conn->query("SELECT u.id_user, u.first_name, u.last_name, u.cedula, u.email, u.username, u.phone, r.nombre_rol AS rol, r.accesos, u.status FROM users u JOIN roles r ON u.id_rol = r.id_rol");
		if ($res->num_rows > 0) {
			while ($row = $res->fetch_array()) {
				$table .= "<tr>";
				$table .= "<td>".$row['id_user']."</td>";
				$table .= "<td>".$row['first_name']."</td>";
				$table .= "<td>".$row['last_name']."</td>";
				$table .= "<td>".$row['cedula']."</td>";
				$table .= "<td>".$row['email']."</td>";
                $table .= "<td>".$row['username']."</td>";
                $table .= "<td>".$row['phone']."</td>";
                $table .= "<td>".$row['rol']."</td>";
                $table .= "<td>".$row['accesos']."</td>";
                $table .= "<td>".$row['status']."</td>";
				$table .= "<td>
							<button type='button' class='btn btn-primary' onclick='editarUsuario(".$row['id_user'].")'>Editar</button>";
                if($row['status'] == 'activo'){
                    $table .="<button type='button' class='btn btn-danger' onclick='desactivarUsuario(".$row['id_user'].")'>Desactivar</button></td>";
                }else{
                    $table .="<button type='button' class='btn btn-success' onclick='activarUsuario(".$row['id_user'].")'>Activar</button></td>";
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
		$res = $this->conn->query("SELECT * FROM users WHERE id=".$id);
		while ($row = $res->fetch_array()){
			$jsondata['id'] = $row['id_user'];
			$jsondata['name'] = $row['first_name'];
			$jsondata['lastname'] = $row['last_name'];
			$jsondata['email'] = $row['email'];
			header('Content-type: application/json; charset=utf-8');
    		return json_encode($jsondata);
    		exit();
		}
	}
	function desactive($id_usuario) {
		$stmt = $this->conn->prepare("UPDATE users SET status = 'desactivo' WHERE id_user = ?");

		$stmt->bind_param("i", $id_usuario);
		
		if ($stmt->execute()) {
			return json_encode(['status' => 'success', 'message' => 'Rol registered successfully.']);
		} else {
			return json_encode(['status' => 'error', 'message' => 'Execution failed: ' . $stmt->error]);
		}
		$stmt->close();
	}
	function active($id_usuario){
		$stmt = $this->conn->prepare("UPDATE users SET status = 'activo' WHERE id_user = ?");

		$stmt->bind_param("i", $id_usuario);
		
		if ($stmt->execute()) {
			return json_encode(['status' => 'success', 'message' => 'Rol registered successfully.']);
		} else {
			return json_encode(['status' => 'error', 'message' => 'Execution failed: ' . $stmt->error]);
		}
		$stmt->close();
	}
	function getUsuariosById($id_usuario) {
		$query = "SELECT id_user, first_name, last_name, cedula, email, username, passwordLogin, phone, adress, id_rol FROM users WHERE id_user = ?";
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
		$stmt = $this->conn->prepare("UPDATE users 
									  SET first_name = ?, last_name = ?, cedula = ?, email = ?, username = ?, passwordLogin = ?, phone = ?, adress = ?, id_rol = ?
									  WHERE id_user = ?");
	
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
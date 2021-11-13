<?php
//API INSEGURIDAD Y DELINCUENCIA
    include 'conexion.php';
	function permisos() {  
	  if (isset($_SERVER['HTTP_ORIGIN'])){
		  header("Access-Control-Allow-Origin: *");
		  header("Access-Control-Allow-Methods: GET, POST, PATCH, PUT, DELETE, OPTIONS");
		  header("Access-Control-Allow-Headers: Origin, Authorization, X-Requested-With, Content-Type, Accept");
		  header('Access-Control-Allow-Credentials: true');      
	  }  
	  if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS'){
		if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD']))          
			header("Access-Control-Allow-Methods: GET, POST, PATCH, PUT, DELETE, OPTIONS");
		if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']))
			header("Access-Control-Allow-Headers: Origin, Authorization, X-Requested-With, Content-Type, Accept");
		exit(0);
	  }
	}
	permisos();
    $pdo = new Conexion();
    //Metodo obtener
    if($_SERVER['REQUEST_METHOD']== 'GET'){
        if(isset($_GET['id']))
        {
            $sql=$pdo->prepare("SELECT * FROM datainde WHERE Correo=:id");
            $sql->bindValue(':id',$_GET['id']);
            $sql->execute();
            $sql->setFetchMode(PDO::FETCH_ASSOC);
            header("HTTP/1.1 200 OK");
            echo json_encode($sql->fetchAll());
            exit;
        }else{
            $sql=$pdo->prepare("SELECT * FROM datainde ORDER BY Hecho");
            $sql->execute();
            $sql->setFetchMode(PDO::FETCH_ASSOC);
            header("HTTP/1.1 200 OK");
            echo json_encode($sql->fetchAll());
            exit;
        }
        
    }
    //Metodo crear
    if($_SERVER['REQUEST_METHOD']== 'POST'){
        $sql="INSERT INTO datainde (Correo, Telefono, Hecho, Descripcion)
        VALUES(:correo,:telefono,:hecho,:descripcion)";
        $query=$pdo->prepare($sql);
        $query->bindValue(':correo',$_POST['correo']);
        $query->bindValue(':telefono',$_POST['telefono']);
        $query->bindValue(':hecho',$_POST['hecho']);
        $query->bindValue(':descripcion',$_POST['descripcion']);
        $query->execute();
        header("HTTP/1.1 200 OK");
        $msg='Datos Insertados Correctamente...';
        echo json_encode($msg);
    }
     //Metodo modificar
     if($_SERVER['REQUEST_METHOD']=='PUT'){
        $sql= "UPDATE datainde SET Correo=:correo, Telefono=:telefono, Hecho=:hecho, Descripcion=:descripcion WHERE Dataid=:id";
        $query=$pdo->prepare($sql);
        $query->bindValue(':id',$_GET['id']);
        $query->bindValue(':correo',$_GET['correo']);
        $query->bindValue(':telefono',$_GET['telefono']);
        $query->bindValue(':hecho',$_GET['hecho']);
        $query->bindValue(':descripcion',$_GET['descripcion']);
        $query->execute();
        header("HTTP/1.1 200 OK");
        $msg='Datos Actualizados Correctamente...';
        echo json_encode($msg);
        exit;
    }
     //Metodo eliminar
     if($_SERVER['REQUEST_METHOD']=='DELETE'){
        $sql= "DELETE FROM datainde WHERE Dataid=:id";
        $query=$pdo->prepare($sql);
        $query->bindValue(':id',$_GET['id']);
        $query->execute();
        header("HTTP/1.1 200 OK");
        $msg='Datos Eliminados Correctamente...';
        echo json_encode($msg);
        exit;
    }
?>
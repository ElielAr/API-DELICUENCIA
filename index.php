<?php
//API INSEGURIDAD Y DELINCUENCIA
    include 'conexion.php';
    $pdo = new Conexion();
    //Metodo obtener
    if($_SERVER['REQUEST_METHOD']=='GET'){
        if(isset($_GET['id']))
        {
            $sql=$pdo->prepare("SELECT * FROM datainde WHERE Dataid=:id");
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
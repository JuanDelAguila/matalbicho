<?php
include 'connexion.php';
$nombre_del_objeto = $_POST['nombre_del_objeto'];
$usuario = $_POST['usuario'];
$fecha = $_POST['fecha'];
$id_proveedor = 0;
$cantidad = intval($_POST['cantidad']);

//$nombre_del_objeto = "Mascarilla";
//$usuario = "test1";
//$fecha = "fecha";
//$id_proveedor = 1;
//$cantidad = intval("50");


// Query to obtain the id of the object
$queryObjetos = "SELECT id FROM objetos WHERE nombre = '$nombre_del_objeto'";

$resultadoObjetos = $conexion ->query($queryObjetos);

if(mysqli_num_rows($resultadoObjetos)){
    $id_objeto = $resultadoObjetos ->fetch_assoc()["id"];
    //echo $id_objeto;
}
else{
    throw new Exception("Object not in our database");
}

// Query to obtain the id of the hospital
$queryHospital = "SELECT id FROM hospitales WHERE usuario = '$usuario'";

$resultadoHospital = $conexion ->query($queryHospital);

if(mysqli_num_rows($resultadoHospital)){
    $id_hospital = $resultadoHospital ->fetch_assoc()["id"];
    //echo $id_hospital;
}
else{
    throw new Exception("FATAL ERROR: Hospital not in our database");
}

// Query to obtain the direction to the hospital

$queryDireccion = "SELECT direccion FROM hospitales WHERE id = '$id_hospital'";
$resultadoDireccion = $conexion ->query($queryDireccion);
if(mysqli_num_rows($resultadoDireccion)){
    $direccion_hospital = $resultadoDireccion ->fetch_assoc()["direccion"];
    //echo $direccion_hospital;
}
else{
    throw new Exception("FATAL ERROR: Hospital not in our database");
}

// Insertion of the order data

$consulta = "INSERT INTO pedidos (id_objeto, cantidad, id_proveedor, id_hospital, fecha, direccion_envio) VALUES ('".$id_objeto."', '".$cantidad."', '".$id_proveedor."', '".$id_hospital."', '".$fecha."', '".$direccion_hospital."')";

$res = mysqli_query($conexion,$consulta);

if ($res){
    $result = Array();
    $result["success"] = true;
    echo json_encode($result);

}
else {
    $result = Array();
    $result["success"] = false;
    echo json_encode($result);

}


$conexion->close();
?>
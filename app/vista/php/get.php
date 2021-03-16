
<?php

$mvcDatos = new GetDatos();


switch ($_POST["op"]) {

    case '1':
        $resultado = $mvcDatos->consultaGen("SELECT * from registros");
        $info      = array('success' => true, 'data' => $resultado);
        break;
    case '2':
        $cod = $mvcDatos->insertar("insert into 
                registros set 
                carnet='{$_POST['carnet']}',  
                apellidos='{$_POST['apellidos']}', 
                nombres='{$_POST['nombres']}', 
                carrera='{$_POST['carrera']}',
                fecha='{$_POST["fecha"]}'");

        $info = array('success' => true);
        break;
    case '3':
        $resultado = $mvcDatos->consultaGen("SELECT * FROM registros WHERE id_registro = '{$_POST['id']}' ");
        $info      = array('success' => true, 'data' => $resultado);
        break;
    case '4':
        $cod = $mvcDatos->insertar("update 
                    registros set 
                    carnet='{$_POST['carnet']}',  
                    apellidos='{$_POST['apellidos']}', 
                    nombres='{$_POST['nombres']}', 
                    carrera='{$_POST['carrera']}',
                    fecha='{$_POST["fecha"]}'  WHERE id_registro = '{$_POST['id']}' ");

        $info = array('success' => true);
        break;
    case '5':
        $resultado = $mvcDatos->borrar("DELETE FROM registros WHERE id_registro = '{$_POST['id']}'");
        $info      = array('success' => true);
        break;
}
echo json_encode($info);

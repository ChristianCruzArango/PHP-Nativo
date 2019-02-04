<?php 
require_once "../modelos/Gastos.php";

$gastos=new Gastos();

$idgasto=isset($_POST["idgasto"])? limpiarCadena($_POST["idgasto"]):"";
$cuenta=isset($_POST["cuenta"])? limpiarCadena($_POST["cuenta"]):"";
$fecha_hora=isset($_POST["fecha_hora"])? limpiarCadena($_POST["fecha_hora"]):"";
$descripcion=isset($_POST["descripcion"])? limpiarCadena($_POST["descripcion"]):"";
$total=isset($_POST["total"])? limpiarCadena($_POST["total"]):"";

switch ($_GET["op"]){
	case 'guardaryeditar':
		if (empty($idgasto)){
			$rspta=$gastos->insertar($cuenta,$fecha_hora,$descripcion,$total);
			echo $rspta ? "Cuenta registrada" : "Cuenta no se pudo registrar";
		}
		else {
			$rspta=$gastos->editar($idgasto,$cuenta,$fecha_hora,$descripcion,$total);
			echo $rspta ? "Cuenta actualizada" : "Cuenta no se pudo actualizar";
		}
	break;

	case 'desactivar':
		$rspta=$gastos->desactivar($idgasto);
 		echo $rspta ? "Gasto Eliminada" : "El gasto no se puede Eliminar";
	break;

	case 'activar':
		$rspta=$gastos->activar($idcuenta);
 		echo $rspta ? "Categoría activada" : "Categoría no se puede activar";
	break;	

	case 'listar':
		$rspta=$gastos->listar();		
 		//Vamos a declarar un array
 		$data= Array();
 		while ($reg=$rspta->fetch_object()){
 			$data[]=array(
 				"0"=>($reg->estado)?'<button class="btn btn-primary btn-sm" onclick="mostrar('.$reg->idgasto.')"><i class="fa fa-pencil-square-o"></i></button>'.
 					' <button class="btn btn-danger btn-sm" onclick="desactivar('.$reg->idgasto.')"><i class="fa fa-thumbs-o-up"></i></button>':
 					'<button class="btn btn-primary btn-sm" onclick="mostrar('.$reg->idgasto.')"><i class="fa fa-pencil-square-o"></i></button>'.
 					' <button class="btn btn-primary btn-sm" onclick="activar('.$reg->idgasto.')"><i class="fa fa-thumbs-o-down"></i></button>',
 				"1"=>$reg->fecha,                
				"2"=>$reg->des,
				"3"=>$reg->cuenta,
                "4"=>$reg->descripcion,	
                "5"=>$reg->naturaleza,	
                "6"=>$reg->total,				
 				"7"=>($reg->estado)?'<span class="label bg-red">Activado</span>':
 				'<span class="label bg-blue">Desactivado</span>'
 				);
 		}
 		$results = array(
 			"sEcho"=>1, //Información para el datatables
 			"iTotalRecords"=>count($data), //enviamos el total registros al datatable
 			"iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
 			"aaData"=>$data);
 		echo json_encode($results);
	break;

    case 'gastosCuentas':
		require_once "../modelos/Cuenta.php";
		$cuenta=new Cuenta();
		$rspta=$cuenta->listarCuentas();
 		//Vamos a declarar un array
 		$data= Array();
 		while ($reg=$rspta->fetch_object()){
 			$data[]=array(	
				"0"=>$reg->idcuenta,			
 				"1"=>$reg->descripcion,
 				"2"=>$reg->cuenta,
 				"3"=>$reg->nivel,
 				"4"=>$reg->naturaleza		
 			);
 		}
 		$results = array(
 			"sEcho"=>1, //Información para el datatables
 			"iTotalRecords"=>count($data), //enviamos el total registros al datatable
 			"iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
 			"aaData"=>$data);
 		echo json_encode($results);
    break;
    
    case 'mostrar':
        $rspta=$gastos->mostrar($idgasto);
        //Codificar el resultado utilizando json
        echo json_encode($rspta);
    break;
}
?>
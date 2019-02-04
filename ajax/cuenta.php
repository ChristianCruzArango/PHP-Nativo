<?php 
require_once "../modelos/Cuenta.php";

$cuenta=new Cuenta();

$idcuenta=isset($_POST["idcuenta"])? limpiarCadena($_POST["idcuenta"]):"";
$descripcion=isset($_POST["descripcion"])? limpiarCadena($_POST["descripcion"]):"";
$cuen=isset($_POST["cuenta"])? limpiarCadena($_POST["cuenta"]):"";
$nivel=isset($_POST["nivel"])? limpiarCadena($_POST["nivel"]):"";
$naturaleza=isset($_POST["naturaleza"])? limpiarCadena($_POST["naturaleza"]):"";


switch ($_GET["op"]){
	case 'guardaryeditar':
		if (empty($idcuenta)){
			$rspta=$cuenta->insertar($descripcion,$cuen,$nivel,$naturaleza);
			echo $rspta ? "Cuenta registrada" : "Cuenta no se pudo registrar";
		}
		else {
			$rspta=$cuenta->editar($idcuenta,$descripcion,$cuen,$nivel,$naturaleza);
			echo $rspta ? "Cuenta actualizada" : "Cuenta no se pudo actualizar";
		}
	break;

	case 'desactivar':
		$rspta=$cuenta->desactivar($idcuenta);
 		echo $rspta ? "Cuenta Eliminada" : "Cuenta no se puede Eliminar";
	break;

	case 'activar':
		$rspta=$cuenta->activar($idcuenta);
 		echo $rspta ? "Categoría activada" : "Categoría no se puede activar";
	break;

	case 'mostrar':
		$rspta=$cuenta->mostrar($idcuenta);
 		//Codificar el resultado utilizando json
 		echo json_encode($rspta);
	break;

	case 'listar':
		$rspta=$cuenta->listar();		
 		//Vamos a declarar un array
 		$data= Array();
 		while ($reg=$rspta->fetch_object()){
 			$data[]=array(
 				"0"=>($reg->estado)?'<button class="btn btn-primary btn-sm" onclick="mostrar('.$reg->idcuenta.')"><i class="fa fa-pencil-square-o"></i></button>'.
 					' <button class="btn btn-danger btn-sm" onclick="desactivar('.$reg->idcuenta.')"><i class="fa fa-thumbs-o-up"></i></button>':
 					'<button class="btn btn-primary btn-sm" onclick="mostrar('.$reg->idcuenta.')"><i class="fa fa-pencil-square-o"></i></button>'.
 					' <button class="btn btn-primary btn-sm" onclick="activar('.$reg->idcuenta.')"><i class="fa fa-thumbs-o-down"></i></button>',
 				"1"=>$reg->descripcion,                
				"2"=>$reg->cuenta,
				"3"=>$reg->nivel,
				"4"=>$reg->naturaleza,				
 				"5"=>($reg->estado)?'<span class="label bg-red">Activado</span>':
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

	case "selectnivel":
		$rspta = $cuenta->selectNivel();

		while ($reg = $rspta->fetch_object())
				{
					echo '<option value=' . $reg->nivel . '>' . $reg->nivel . '</option>';
				}
	break;

	case "selectnaturaleza":
		$rspta = $cuenta->selectNaturaleza();

		while ($reg = $rspta->fetch_object())
				{
					echo '<option value=' . $reg->naturaleza . '>' . $reg->naturaleza . '</option>';
				}
	break;
}
?>
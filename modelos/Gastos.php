<?php 
//Incluímos inicialmente la conexión a la base de datos
require "../config/Conexion.php";

Class Gastos
{
	//Implementamos nuestro constructor
	public function __construct()
	{

	}

	//Implementamos un método para insertar registros
	public function insertar($cuenta,$fecha_hora,$descripcion,$total)
	{
		$sql="INSERT INTO gasto (fecha,descripcion,idcuenta,total,estado)
		VALUES ('$fecha_hora','$descripcion','$cuenta',$total,1)";
		return ejecutarConsulta($sql);
	}

	//Implementamos un método para editar registros
	public function editar($idgasto,$cuenta,$fecha_hora,$descripcion,$total)
	{
		$sql="UPDATE cuentas SET descripcion='$descripcion',cuenta='$cuen',nivel='$nivel',naturaleza='$naturaleza'
              WHERE idcuenta='$idcuenta'";
		return ejecutarConsulta($sql);
	}

	//Implementamos un método para desactivar categorías
	public function desactivar($idgasto)
	{
		$sql="UPDATE gasto SET estado='0' WHERE idgasto='$idgasto'";
		return ejecutarConsulta($sql);
	}

	//Implementamos un método para activar categorías
	public function activar($idcuenta)
	{
		$sql="UPDATE cuentas SET estado='1' WHERE idcuenta='$idcuenta'";
		return ejecutarConsulta($sql);
	}

	//Implementar un método para mostrar los datos de un registro a modificar
	public function mostrar($idgasto)
	{
		$sql="SELECT * FROM gasto WHERE idgasto=$idgasto";
		return ejecutarConsultaSimpleFila($sql);
	}

	//Implementar un método para listar los registros
	public function listar()
	{
		$sql="SELECT g.idgasto,g.fecha,g.descripcion as des,c.cuenta,c.descripcion,c.naturaleza,g.total,g.estado FROM gasto as g INNER JOIN cuentas as c ON g.idcuenta=c.idcuenta WHERE g.estado=1";		
		return ejecutarConsulta($sql);		
	}
	


}

?>
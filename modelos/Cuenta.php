<?php 
//Incluímos inicialmente la conexión a la base de datos
require "../config/Conexion.php";

Class Cuenta
{
	//Implementamos nuestro constructor
	public function __construct()
	{

	}

	//Implementamos un método para insertar registros
	public function insertar($descripcion,$cuen,$nivel,$naturaleza)
	{
		$sql="INSERT INTO cuentas (descripcion,cuenta,nivel,naturaleza,estado)
		VALUES ('$descripcion',$cuen,'$nivel','$naturaleza',1)";
		return ejecutarConsulta($sql);
	}

	//Implementamos un método para editar registros
	public function editar($idcuenta,$descripcion,$cuen,$nivel,$naturaleza)
	{
		$sql="UPDATE cuentas SET descripcion='$descripcion',cuenta='$cuen',nivel='$nivel',naturaleza='$naturaleza'
              WHERE idcuenta='$idcuenta'";
		return ejecutarConsulta($sql);
	}

	//Implementamos un método para desactivar categorías
	public function desactivar($idcuenta)
	{
		$sql="UPDATE cuentas SET estado='0' WHERE idcuenta='$idcuenta'";
		return ejecutarConsulta($sql);
	}

	//Implementamos un método para activar categorías
	public function activar($idcuenta)
	{
		$sql="UPDATE cuentas SET estado='1' WHERE idcuenta='$idcuenta'";
		return ejecutarConsulta($sql);
	}

	//Implementar un método para mostrar los datos de un registro a modificar
	public function mostrar($idcuenta)
	{
		$sql="SELECT * FROM cuentas WHERE idcuenta='$idcuenta'";
		return ejecutarConsultaSimpleFila($sql);
	}

	//Implementar un método para listar los registros
	public function listar()
	{
		$sql="SELECT * FROM cuentas where estado=1";		
		return ejecutarConsulta($sql);		
	}
	//Implementar un método para listar los registros y mostrar en el select
	public function selectNivel()
	{
		$sql="SELECT DISTINCT nivel FROM cuentas ";
		return ejecutarConsulta($sql);		
	}

	public function selectNaturaleza()
	{
		$sql="SELECT DISTINCT naturaleza FROM cuentas ";
		return ejecutarConsulta($sql);		
	}

	public function listarCuentas()
	{
		$sql="SELECT idcuenta,descripcion,cuenta,nivel,naturaleza FROM cuentas where estado=1";		
		return ejecutarConsulta($sql);		
	}
}

?>
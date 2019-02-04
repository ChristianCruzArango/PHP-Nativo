<?php 
//Incluímos inicialmente la conexión a la base de datos
require "../config/Conexion.php";

Class Movimientos
{
	//Implementamos nuestro constructor
	public function __construct()
	{

	}

	//Implementamos un método para insertar registros
	public function insertar($nombre,$descripcion,$naturaleza,$fecha_hora)
	{
		$sql="INSERT INTO movimientos (nombre,descripcion,naturaleza,fecha,estado)
        VALUES ('$nombre','$descripcion','$naturaleza','$fecha_hora','1')";
        var_dump($sql);
		return ejecutarConsulta($sql);
	}

	//Implementamos un método para editar registros
	public function editar($idcategoria,$nombre,$descripcion)
	{
		$sql="UPDATE categoria SET nombre='$nombre',descripcion='$descripcion' WHERE idcategoria='$idcategoria'";
		return ejecutarConsulta($sql);
	}

	//Implementamos un método para desactivar categorías
	public function desactivar($idcategoria)
	{
		$sql="UPDATE categoria SET condicion='0' WHERE idcategoria='$idcategoria'";
		return ejecutarConsulta($sql);
	}

	//Implementamos un método para activar categorías
	public function activar($idcategoria)
	{
		$sql="UPDATE categoria SET condicion='1' WHERE idcategoria='$idcategoria'";
		return ejecutarConsulta($sql);
	}

	//Implementar un método para mostrar los datos de un registro a modificar
	public function mostrar($idmovimiento)
	{
		$sql="SELECT * FROM movimientos WHERE idmovimiento='$idmovimiento'";
		return ejecutarConsultaSimpleFila($sql);
	}

	//Implementar un método para listar los registros
	public function listar()
	{
		$sql="SELECT * FROM movimientos";
		return ejecutarConsulta($sql);		
	}
}

?>
var tabla;

//Función que se ejecuta al inicio
function inicio(){
	mostrarform(false);
	listar();

	$("#formulario").on("submit",function(e)
	{
		guardaryeditar(e);	
	})

	$.post("../ajax/cuenta.php?op=selectnivel", function(r){
		$("#nivel").html(r);
		$('#nivel').selectpicker('refresh');
	});

	$.post("../ajax/cuenta.php?op=selectnaturaleza", function(r){
		$("#naturaleza").html(r);
		$('#naturaleza').selectpicker('refresh');
	});
}

//Función limpiar
function limpiar()
{
	$("#idcuenta").val("");
    $("#nombre").val("");
    $("#numero").val("");
	$("#descripcion").val("");
}

//Función mostrar formulario
function mostrarform(bandera)
{
	limpiar();
	if (bandera)
	{
		$("#listadoregistros").hide();
		$("#formularioregistros").show();
		$("#btnGuardar").prop("disabled",false);
		$("#btnagregar").hide();
	}
	else
	{
		$("#listadoregistros").show();
		$("#formularioregistros").hide();
		$("#btnagregar").show();
	}
}

//Función cancelarform
function cancelarformulario()
{
	limpiar();
	mostrarform(false);
}

//Función Listar
function listar()
{
	tabla=$('#tbllistado').dataTable(
	{
		"aProcessing": true,//Activamos el procesamiento del datatables
	    "aServerSide": true,//Paginación y filtrado realizados por el servidor
	    dom: 'Bfrtip',//Definimos los elementos del control de tabla
	    buttons: [		          
		            'copyHtml5',
		            'excelHtml5',
		            'csvHtml5',
		            'pdf'
		        ],
		"ajax":
				{
					url: '../ajax/cuenta.php?op=listar',
					type : "get",
					dataType : "json",						
					error: function(e){
						console.log(e.responseText);	
					}
				},
		"bDestroy": true,
		"iDisplayLength": 5,//Paginación
	    "order": [[ 0, "desc" ]]//Ordenar (columna,orden)
	}).DataTable();
}
//Función para guardar o editar

function guardaryeditar(e)
{
	e.preventDefault(); //No se activará la acción predeterminada del evento
	$("#btnGuardar").prop("disabled",true);
	var formData = new FormData($("#formulario")[0]);

	$.ajax({
		url: "../ajax/cuenta.php?op=guardaryeditar",
	    type: "POST",
	    data: formData,
	    contentType: false,
	    processData: false,

	    success: function(datos)
	    {                    
	          bootbox.alert(datos);	          
	          mostrarform(false);
	          tabla.ajax.reload();
	    }

	});
	limpiar();
}

function mostrar(idcuenta)
{
	$.post("../ajax/cuenta.php?op=mostrar",{idcuenta : idcuenta}, function(data, status)
	{
		data = JSON.parse(data);		
		mostrarform(true);

		$("#idcuenta").val(data.idcuenta);
		$("#descripcion").val(data.descripcion);
		$("#cuenta").val(data.cuenta);
		$("#nivel").val(data.nivel);
		$("#nivel").selectpicker('refresh');
		$("#naturaleza").val(data.naturaleza);
		$("#naturaleza").selectpicker('refresh');
 		

 	})
}


function desactivar(idcuenta)
{
	bootbox.confirm("¿Está Seguro de Eliminar la Cuenta Contable?", function(result){
		if(result)
        {
        	$.post("../ajax/cuenta.php?op=desactivar", {idcuenta : idcuenta}, function(e){
        		bootbox.alert(e);
	            tabla.ajax.reload();
        	});	
        }
	})
}


function activar(idcuenta)
{
	bootbox.confirm("¿Está Seguro de activar la Cuenta Contable?", function(result){
		if(result)
        {
        	$.post("../ajax/cuenta.php?op=activar", {idcuenta : idcuenta}, function(e){
        		bootbox.alert(e);
	            tabla.ajax.reload();
        	});	
        }
	})
}

inicio();
Pasos para la instalación:
	1º En PhpMyAdmin hay que tener una base de datos llamada "logrocho"
	2º Seleccionamos esa BD e importamos logrocho.sql
	3º Hay que modificar el config.txt y poner tu ruta absoluta al directorio de imágenes(resources)
	   Debería ser algo así -> X:\Ruta\Ruta\xampp\htdocs\logrocho\resources
		En mi caso: D:\Clase\xampp\htdocs\logrocho\resources
	   La carpeta del proyecto (logrocho) debería mantener ese nombre.
	
Para iniciar sesión en el BACKEND -> 
	usuario: admin
	pass: admin
Para iniciar sesión en la parte pública (solo esta la home con un slider) ->
	usuario: invitado
	pass: 1234

***NOTAS***

- En los listados, Eliminar seleccionados no está todavía implementado
- En la ficha de los bares y pinchos, se pueden eliminar las imágenes haciendo click sobre ellas,
  te saldrá un alert de confirmación. Por algún motivo es necesario actualizar la página para que dejen de salir las fotos.


<!doctype html>
<html lang="es">

<head>
	<title>Docentes</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">
	<link rel="icon" href="/registro01/images/leones.png">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="/home01/css/style.css">
	<link rel="stylesheet" href="/home01/css/registro.css">
	<script src="/home01/js/maestrochido.js"></script>
</head>

<body>
	@if ($searchSubject and $searchSubject->consultaRealizada)
	<script>
		visible_mat()
	</script>
	@endif
	@if ($searchStudent and $searchStudent->consultaRealizada)
	<script>
		visible_alum()
	</script>
	@endif
    @if ($searchStudent and $searchStudent->consultaRealizada)
	<script>
		visible_trabajos()
	</script>
	@endif
	<div class="container d-flex align-items-stretch">
		<nav id="sidebar">
			<div class="p-4">
				<a href="/home" class="logo"><img src="/registro01/images/leones.png" alt="logo Leones" style="width: 80px; height: 80px;"> <span>MyUniversity</span></a>
				<ul class="list-unstyled components mb-5">
					<br><br><br>
					<li class="active">
						<span class="fa fa-user mr-3" id="alum"></span><button class="btn-transparent" onclick="visible_alum()">Calificacion</button>
					</li>
					<li>
						<span class="fa fa-sticky-note mr-3"></span><button class="btn-transparent" onclick="visible_mat()">Materias</button>
					</li>
                    <li>
						<span class="fa fa-sticky-note mr-3"></span><button class="btn-transparent" onclick="visible_trabajos()">Trabajos</button>
					</li>
					<li>
						<span class="fa fa-paper-plane mr-3"></span><button class="btn-transparent" onclick="visible_contact()">Contacto</button>
					</li><br><br><br><br><br><br>
					<li>
						<br><br><br><a href="/logout"><span class="fa fa-cogs mr-3"></span> Cerrar sesión</a>
					</li>
				</ul>


				<div class="footer">
					<p style="font-size: small;">
						MyUniversity es un sistema de uso académico creado por Robinson Ian Cabrera Hernandez, Perez Garcia Cristian Rolando, Hernandez Michel Jose Luis
					</p>
				</div>

			</div>
		</nav>

		<div class="cont-am">
			<div id="contenido" class="p-4 p-md-5 pt-5">
				<h1 class="mb-4">Docentes</h1>
				<h3>Sistema de gestión para el docente</h3> <br><br>
				<p style="color: black;">Los Docentes está encargada de la administración del cuerpo estudiantil y docente, además del manejo de las materias impartidas en MyUniversity. Esta institución se toma muy en serio la educación y el bienestar de los alumnos,
					tomando en cuenta el desempeño y preparación de los docentes.
				</p>
			</div>
			<div id="sec_alum" class="p-4 p-md-5 pt-5" style="display: none;">
				<h1 class="mb-4">Gestión de Alumnos</h1>
				<h2>Alta de alumnos</h2>
				<form action="/home/studentRegistration" method="POST" name="prueba01">
					@csrf
					@if ($errors->has('students'))

					<script>
						visible_alum()
					</script>
					@endif
					<div>
						<br><label for="Nombre" style="color: black; font-size: large;">Nombre de alumno</label> <br>
						<input type="text" placeholder="Nombre Alumno" class="input_bus" name="name" @if ($errors->has('students')) value="{{old('name') ?? ''}}" @endif required><br>
						@if ($errors->has('students') and $errors->has('name'))
						<i>Ingrese un nombre</i><br>
						@endif
					    <br><label for="Calificacion" style="color: black; font-size: large;">Calificacion de alumno</label> <br>
						<input type="text" placeholder="Calificacion Alumno" class="input_bus" name="score" @if ($errors->has('students')) value="{{old('score') ?? ''}}" @endif required><br>
						@if ($errors->has('students') and $errors->has('score'))
						<i>Ingrese la Calificacion</i><br>
						@endif
					</div>

					<br><br><button class="btn btn-success">Enviar</button><br><br>
				</form>
				<h2>Búsqueda de alumno</h2>
				<form action="/home/studentSearch" method="post">
					@csrf
					<div class="input-group mb-3">
						<input class="input_bus" type="text" placeholder="Nombre del alumno" style="color: black;" name="name">
						<button class="btn btn-outline-secondary" id="button-addon2">Buscar</button>

					</div>
				</form>

				<br><br>
				<table class="table table-dark">
					<tr class="table-active">
						<th>Código del Alumno</th>
						<th>Nombre del Alumno</th>
                        <th>Calificacion del Alumno</th>
						<th>Dar de baja</th>
					</tr>

					@if ($searchStudent)
					<script>
						visible_alum()
					</script>
					@foreach ($searchStudent as $student )
					<tr class="table-active">
						<th>{{$student->id}}</th>
						<th>{{$student->name}}</th>
                        <th>{{$student->score}}</th>
						<th><a href="/home/eliminarStudent/{{$student->id}}">Eliminar</a></th>
					</tr>
					@endforeach
					@endif
				</table>
			</div>
			<div id="sec_mat" class="p-4 p-md pt-5" style="display: none;">
				<h1 class="mb-4">Gestión de Materias</h1>
				<h2>Alta de Materias</h2>
				<form method="POST" action="/home/subjectRegistration">
					@csrf
					@if ($errors->has('subjects'))

					<script>
						visible_mat()
					</script>
					@endif
					<div class="select">
					<br><label id="firstname" for="Nombre de la materia">Materias:</label></br>
                    <select name="Nombre de la materia" id="identified">
                    <option value="Algoritmia">Algoritmia</option>
                    <option value="Sem. Algoritmia">Sem. Algoritmia</option>
                    <option value="Estructura de Datos II">Estructura de Datos II</option>
                    <option value="Sem. Estructura de Datos II">Sem. Estructura de Datos II</option>
					<option value="Bases de datos">Bases de datos</option>
					<option value="Sem. Bases de datos">Sem. Bases de datos</option>
					<option value="Bases de datos">Bases de datos</option>
					<option value="Sem. Bases de datos">Sem. Bases de datos</option>
					<option value="Ingenieria de Software 1">Ingenieria de Software 1</option>
					<option value="Hipermedia">Hipermedia</option>
					<option value="Administracion de Redes">Administracion de Redes</option>
					<option value="Administracion de Servidores">Administracion de Servidores</option>
                    </select>
					</div>
					<br><br><button class="btn btn-success">Enviar</button><br><br>
				</form>
				<h2>Búsqueda de Materias</h2>
				<form action="/home/subjectSearch" method="post">
					@csrf
					<div class="input-group mb-3">
						<input class="input_bus" type="text" placeholder="Nombre de la materia" style="color: black;" name="name" required>
						<button class="btn btn-outline-secondary" id="button-addon2">Buscar</button>
					</div>
				</form>

				<br><br>
				<table class="table table-dark">
					<tr class="table-active">
						<th>ID</th>				
						<th>Nombre de la materia</th>
						<th>Eliminar</th>
					</tr>
					@if ($searchSubject)
					<script>
						visible_mat()
					</script>
					@foreach ($searchSubject as $subject )
					<tr class="table-active">
						<th>{{$subject->id}}</th>				
						<th>{{$subject->name}}</th>
						<th><a href="/home/eliminarSubject/{{$subject->id}}">Eliminar</a></th>
					</tr>
					@endforeach
					@endif
				</table>
			</div>
			<div id="sec_cont" class="p-4 p-md pt-5" style="display: none;">
				<span class="fa fa-teacher mr-2"></span>
				<h4>Robinson Ian Cabrera Hernandez</h4><br>
				<span class="fa fa-phone mr-2"></span>
				<h4>3312456587</h4><br>
				<span class="fa fa-teacher mr-2"></span>
				<h4>Perez Garcia Cristian Rolando</h4><br>
				<span class="fa fa-phone mr-2"></span>
				<h4>3313546891</h4><br>
				<span class="fa fa-teacher mr-2"></span>
				<h4>Hernandez Michel Jose Luis</h4><br>
				<span class="fa fa-phone mr-2"></span>
				<h4>3313206548</h4><br>
				<span class="fa fa-at"></span>
				<h4>my.university.pagina@gmail.com</h4>
			</div>
		</div>

	</div>



</body>

</html>
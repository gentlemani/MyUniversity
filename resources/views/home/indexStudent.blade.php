<!doctype html>
<html lang="es">

<head>
    <title>Estudiantes</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">
    <link rel="icon" href="/registro01/images/leones.png">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="/home01/css/style.css">
    <link rel="stylesheet" href="/home01/css/registro.css">
    <script src="/home01/js/teacherFunctions.js"></script>
</head>

<body>
    <h1>Alumno</h1>
    <form action="/alumno/subjectRegistration" method="post">
        @csrf
        <select name="subject_id" id="subject_id">
            <option value="" selected>Seleccione una Materia</option>
            @foreach($subjects as $subject)
            <option value="{{$subject->id}}">{{$subject->name}}</option>
            @endforeach
        </select>
        <div id="resultadoP">
            <!--Se pone el horario de la materia-->
        </div>
        <input type="submit" value="Enviar">
    </form>
</body>

</html>
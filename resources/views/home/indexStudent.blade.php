<!doctype html>
<html lang="es">

<head>
    <title>Alumnos</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">
    <link rel="icon" href="/registro01/images/leones.png">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="/home01/css/style.css">
    <link rel="stylesheet" href="/home01/css/registro.css">
</head>

<body>

    <div class="container d-flex align-items-stretch">
        <nav id="sidebar">
            <div class="p-4">
                <a href="/home" class="logo"><img src="/registro01/images/leones.png" alt="logo Leones"
                        style="width: 80px; height: 80px;"> <span>MyUniversity</span></a>
                <ul class="list-unstyled components mb-5">
                    <br><br><br>
                    <li>
                        <span class="fa fa-user mr-3"></span><button class="btn-transparent"
                            onclick="visible_becas_alumnos()">Becas</button>
                    </li>
                    <li>
                        <span class="fa fa-sticky-note mr-3"></span><button class="btn-transparent"
                            onclick="visible_mat_alumnos()">Materias</button>
                    </li>
                    <li>
                        <span class="fa fa-sticky-note mr-3"></span><button class="btn-transparent"
                            onclick="visible_trabajos_alumnos()">Trabajos</button>
                    </li>
                    <li>
                        <span class="fa fa-paper-plane mr-3"></span><button class="btn-transparent"
                            onclick="visible_contact_alumnos()">Contacto</button>
                    </li><br><br><br><br><br><br>
                    <li>
                        <br><br><br><a href="/logout"><span class="fa fa-cogs mr-3"></span> Cerrar sesión</a>
                    </li>
                </ul>
                <div class="footer">
                    <p style="font-size: small;">
                        MyUniversity es un sistema de uso académico creado por Robinson Ian Cabrera Hernandez, Perez
                        Garcia Cristian Rolando, Hernandez Michel Jose Luis
                    </p>
                </div>
            </div>
        </nav>

        <div class="cont-am">
            <div id="contenido" class="p-4 p-md-5 pt-5">
                <h1 class="mb-4">Alumnos</h1>
                <h3>Sistema de gestión para el alumno</h3> <br><br>
                <p style="color: black;">Inserte frase mamadora acá
                </p>
            </div>
            <div id="sec_beca" class="p-4 p-md pt-5" style="display: none;">
                <h1 class="mb-4">Becas</h1>
                <h2>Listas de Becas</h2>
                <div>
                    <table class="table table-dark">
                        <tr class="table-active">
                            <th>Nombre de la beca</th>
                            <th>Descripción de la beca</th>
                            <th>Cantidad de dinero por alumno</th>
                            <th>Cantidad de cupos diponibles</th>
                            <th>Fecha en que termina la beca</th>
                        </tr>

                        @foreach ($becas as $beca)
                            <tr class="table-active">
                                <td>{{ $beca->name }}</td>
                                <td>{{ $beca->description }}</td>
                                <td>{{ $beca->amount }}</td>
                                <td>
                                    {{ $beca->capacity - $beca->students()->count() }}
                                </td>
                                <td>{{ $beca->endDate }}</td>
                            </tr>
                        @endforeach

                    </table>
                </div>
                <form method="POST" action="/alumno/becaRegistration">
                    @csrf
                    <div>
                        <br><label for="schoolarship_id">Becas disponibles</label><br>
                        <select name="schoolarship_id" id="schoolarship_id" required>
                            <option value="" selected>Seleccione una Beca</option>
                            @foreach ($becas as $beca)
                                @if ($beca->students()->count() < $beca->capacity)
                                    <option value="{{ $beca->id }}">{{ $beca->name }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                    <br><br><button class="btn btn-success">Agregar beca</button><br><br>
                </form>
                <h2>Beca activa</h2>
                <table class="table table-dark">
                    <tr class="table-active">
                        <th>Nombre del alumno</th>
                        <th>Nombre de la beca</th>
                        <th>Descripción de la beca</th>
                        <th>Cantidad de dinero por alumno</th>
                        <th>Fecha en que termina la beca</th>
                        <th>Quitar beca</th>
                    </tr>

                    <tr class="table-active">
                        <td>{{ $student->name }}</td>

                        @if ($student->schoolarship)
                            <td>
                                {{ $student->schoolarship->name }}
                            </td>
                            <td>
                                {{ $student->schoolarship->description }}
                            </td>
                            <td>
                                {{ $student->schoolarship->amount }}
                            </td>
                            <td>{{ $student->schoolarship->endDate }}</td>
                            <td>
                                <a href="/alumno/shoolarshipDelete">Eliminar</a>
                            </td>
                        @else
                            <th>No hay beca activa</th>
                            <th>No hay beca activa</th>
                            <th>No hay beca activa</th>
                            <th>No hay beca activa</th>
                            <th>No hay beca activa</th>
                        @endif


                    </tr>

                </table>
            </div>
            <div id="sec_mat" class="p-4 p-md pt-5" style="display: none;">
                <h1 class="mb-4">Gestión de Materias</h1>
                <h2>Alta de Materias</h2>
                <form method="POST" action="/alumno/subjectRegistration">
                    @csrf
                    <div class="select">
                        <br><label for="subjectTeacherId">Materias:</label><br>
                        <select name="subject_id" id="subjectTeacherId" required>
                            <option value="" selected>Seleccione una Materia</option>
                            @foreach ($subjects as $subject)
                                <option value="{{ $subject->id }}">{{ $subject->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    @if ($errors->has('subjects') and $errors->has('subject_id'))
                        <i>Seleccione una Materia</i><br>
                    @endif
                    <div id="scheduleSubjectTeacher">
                        <!--Se pone el horario de la materia-->
                    </div>
                    <br><br><button class="btn btn-success">Agregar materia</button><br><br>
                </form>
                <h2>Búsqueda de Materias</h2>
                <form action="/alumno/subjectShow" method="post">
                    @csrf
                    <div class="input-group mb-3">
                        <input class="input_bus" type="text" placeholder="Nombre de la materia" style="color: black;"
                            name="name">
                        <button class="btn btn-outline-secondary" id="button-addon2">Buscar</button>
                    </div>
                </form>
                <br><br>
                <table class="table table-dark">
                    <tr class="table-active">
                        <th>Nombre de la materia</th>
                        <th>Sección</th>
                        <th>Horario</th>
                        <th>Clave</th>
                        <th>Profesor</th>
                        <th>Dar de baja</th>
                    </tr>
                    @if (session('subjects'))
                        @foreach (session('subjects') as $subject)
                            <tr class="table-active">
                                <td>{{ $subject->name }}</td>
                                <td>{{ $subject->section }}</td>
                                <td>{{ $subject->schedule }}</td>
                                <td>{{ $subject->clave }}</td>
                                <td>
                                    {{-- {{ $subjectsEnrolled }} --}}

                                    @foreach ($subject->teachers as $teacher)
                                        {{ $teacher->name }}
                                    @endforeach
                                </td>
                                <td><a href="/alumno/subjectDelete/{{ $subject->id }}">Eliminar</a></td>
                            </tr>
                        @endforeach
                    @endif
                </table>
            </div>
            <div id="sec_trabajos" class="p-4 p-md pt-5" style="display: none;">
                <h1 class="mb-4">Gestión de Trabajos</h1>
                <h2>Trabajos disponibles</h2>
                <form method="POST" action="/alumno/taskShow">
                    @csrf
                    <div>
                        <div class="select">
                            <br><label for="subjectStudentId">Materias:</label><br>
                            <select name="subject_id" id="subjectStudentId" required>
                                <option value="" selected>Seleccione materia para ver trabajos</option>
                                @foreach ($subjectEnrolled as $subject)
                                    <option value="{{ $subject->id }}">{{ $subject->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <br><br><button class="btn btn-success">Mostrar</button><br><br>
                </form>
                <div>
                    <table class="table table-dark">
                        <tr class="table-active">
                            <th>Nombre del Trabajo</th>
                            <th>Descripción del trabajo</th>
                            <th>Fecha del Trabajo</th>
                            <th>Materia</th>
                            <th>Estatus</th>
                            <th>Trabajo</th>
                            <th>Eliminar Trabajo</th>
                        </tr>
                        @if (session('tasks'))
                            @foreach (session('tasks') as $task)
                                <tr class="table-active">
                                    <td>{{ $task->name }}</td>
                                    <td>{{ $task->description }}</td>
                                    <td>{{ $task->date }}</td>
                                    <td>
                                        {{ $task->subject->name }}
                                    </td>
                                    <td>
                                        {{ $task->pivot->fileUploaded != null ? 'Trabajo entregado' : 'Pendiente de entrega' }}
                                    </td>
                                    <td>
                                        <div>
                                            @if ($task->pivot->fileUploaded != null)
                                                <a href="/{{ $task->pivot->fileUploaded }}">Descargar</a>
                                            @else
                                                <form action="/alumno/fileAdd" method="POST"
                                                    enctype="multipart/form-data">
                                                    @csrf
                                                    <input type="hidden" name="task_id" value="{{ $task->id }}"
                                                        id="">
                                                    <input type="hidden" name="subject_id"
                                                        @if (session('subject_id')) value="{{ session('subject_id') }}"@else value="nada" @endif
                                                        id="">
                                                    <div class="file-select" id="src-file1">
                                                        <input type="file" name="archivo">
                                                    </div>
                                                    <br>
                                                    @if ($errors->has('file'))
                                                        <i>Agregue un archivo primero</i><br>
                                                    @endif
                                                    <br>
                                                    <button class="btn btn-info text-light">Enviar</button>
                                                </form>
                                            @endif
                                        </div>
                                    </td>
                                    <td><a href="/alumno/fileDelete/{{ $task->id }}">Eliminar</a></td>
                                </tr>
                            @endforeach
                        @endif

                    </table>
                </div>
                <h2>Búsqueda de Trabajos</h2>
                <form action="/alumno/taskSearch" method="post">
                    @csrf
                    <div class="input-group mb-3">
                        <input class="input_bus" type="text" placeholder="Nombre del trabajo"
                            style="color: black;" name="name">
                        <button class="btn btn-outline-secondary" id="button-addon2">Buscar</button>
                    </div>
                </form>
                <br><br>
                <table class="table table-dark">
                    <tr class="table-active">
                        <th>Nombre del Trabajo</th>
                        <th>Descripción del trabajo</th>
                        <th>Fecha del Trabajo</th>
                        <th>Materia</th>
                        <th>Estatus</th>
                        <th>Trabajo</th>
                        <th>Eliminar Trabajo</th>
                    </tr>
                    @if (session('taskSearch'))
                        @foreach (session('taskSearch') as $task)
                            <tr class="table-active">
                                <td>{{ $task->name }}</td>
                                <td>{{ $task->description }}</td>
                                <td>{{ $task->date }}</td>
                                <td>
                                    {{ $task->subject->name }}
                                </td>
                                <td>
                                    {{ $task->pivot->fileUploaded != null ? 'Trabajo entregado' : 'Pendiente de entrega' }}
                                </td>
                                <td>
                                    <div>
                                        @if ($task->pivot->fileUploaded != null)
                                            <a href="/{{ $task->pivot->fileUploaded }}">Descargar</a>
                                        @else
                                            <form action="/alumno/fileAdd" method="POST"
                                                enctype="multipart/form-data">
                                                @csrf
                                                <input type="hidden" name="task_id" value="{{ $task->id }}"
                                                    id="">
                                                <input type="hidden" name="subject_id"
                                                    @if (session('subject_id')) value="{{ session('subject_id') }}"@else value="nada" @endif
                                                    id="">
                                                <div class="file-select" id="src-file1">
                                                    <input type="file" name="archivo">
                                                </div>
                                                <br>
                                                @if ($errors->has('file'))
                                                    <i>Agregue un archivo primero</i><br>
                                                @endif
                                                <br>
                                                <button class="btn btn-info text-light">Enviar</button>
                                            </form>
                                        @endif
                                    </div>
                                </td>
                                <td><a href="/alumno/fileDelete/{{ $task->id }}">Eliminar</a></td>
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
                <span class="fa fa-at"></span>
                <h4>my.university.pagina@gmail.com</h4>
            </div>
        </div>

    </div>

    </div>
    <script src="/home01/js/funciones.js">
        actualizarInputFile()
    </script>
    <script>
        var subjects = <?php echo json_encode($subjects); ?>;
    </script>
    <script src="/home01/js/selectForm.js"></script>
    @if (session('subjects') || $errors->has('subjects'))
        <script>
            visible_mat_alumnos()
        </script>
    @endif
    @if (session('tasks') || $errors->has('tasks') || session('taskSearch'))
        <script>
            visible_trabajos_alumnos()
        </script>
    @endif

</body>

</html>

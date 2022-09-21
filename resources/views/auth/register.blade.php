<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="/registro01/images/leones.png">
    <link rel="stylesheet" type="text/css" href="/registro01/css/style.css">
    <link rel="stylesheet" type="text/css" href="/login01/css/style.css">
    <title>Registro Coordinadores</title>
</head>

<body>

    <div class="cont-regi-max">
        <a href="/login">
            <p class="titulo">MyUniversity</p>
            <img class="logo-cent" src="/registro01/images/leones.png" alt="logo">
        </a>
        <div class="cont-neg">
            <div class="form-regi">
                <form method="POST" action="">
                    @csrf
                    <table>
                        <tr>
                            <th>
                                <div class="regi">
                                    <input style="margin-top: 20px;" class="input" type="email" name="email" placeholder="Correo electronico" required>
                                    @error('correo')
                                    <i>Ingrese un Correo institucional válido</i>
                                    @enderror
                                </div>
                            </th>
                            <th>
                                <div class="regi">
                                    <select style="background-color: black; " class="input" name="genero">
                                        <option value="">Género</option>
                                        <option value="masculino">Masculino</option>
                                        <option value="femenino">Femenino</option>
                                    </select>
                                    @error('genero')
                                    <i>Ingrese su género</i>
                                    @enderror
                                </div>
                            </th>
                        </tr>
                        <tr>
                            <th>
                                <div class="regi">
                                    <input class="input" type="text" name="carrera" placeholder="Carrera">
                                    @error('carrera')
                                    <i>Ingrese Carrera a la que pertenece</i>
                                    @enderror
                                </div>
                            </th>
                            <th>
                                <div class="regi">
                                    <input class="input" type="text" name="nombre" placeholder="Nombre">
                                    @error('nombre')
                                    <i>Ingrese un Nombre</i>
                                    @enderror
                                </div>
                            </th>
                        </tr>
                        <tr>
                            <th>
                                <div class="regi">
                                    <input class="input" type="text" name="codigo" placeholder="Codigo">
                                    @error('codigo')
                                    <i>Ingrese un nuevo código de coordinador</i>
                                    @enderror
                                </div>
                            </th>
                        </tr>
                        <tr>
                            <th>
                                <div class="regi">
                                    <input class="input" type="text" name="password" placeholder="Contraseña" required>
                                    @error('password')
                                    <i>Ingrese una Contraseña con mínimo 8 caracteres</i>
                                    @enderror
                                </div>
                            </th>
                            <th>
                                <div class="regi">
                                    <input class="input" type="password" name="password_confirmation" placeholder="Confirmar contraseña" required>
                                    @error('password_confirmation')
                                    <i>Ambas contraseñas deben ser iguales</i>
                                    @enderror
                                </div>
                            </th>
                        </tr>
                    </table>
                    <div class="cent-btn">
                        <button class="button">
                            Registrar
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</body>

</html>
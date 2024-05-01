<!DOCTYPE html>
<html>

<!-- Cabecera con enlaces y definición del html -->

<head>
    <meta charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1">
    <!-- Enlaces a hojas de estilo y scripts -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="./css/index.css">
    <link rel="stylesheet" href="./css/estilos.css">
    <link rel="stylesheet" href="./css/footer.css">
    <script src="js/funciones.js"></script>
    <script src="js/login-logout.js"></script>
</head>

<!-- Cuerpo del html -->

<body>
    <!-- Contenedor del login -->
    <div id="loginDiv">
        <label for="usuario">Usuario:</label>
        <input type="text" id="usuario">
        <label for="password">Contraseña:</label>
        <input type="password" id="password">
        <button id="loginButton" type="button" onclick="login()">Iniciar sesión</button>
    </div>

    <!-- Contenedor y opciones de la barra de navegación -->
    <div class="navbar">
        <!-- Enlaces a diferentes secciones -->
        <a href="#" onclick="mostrarNavbar()">Inicio</a>
        <a href="#" onclick="listarCasas('searchForm')">Casas</a>
        <a href="#" onclick="listarAsignaturas()">Asignaturas</a>
        <a href="#" onclick="listarAlumnos('searchForm2')">Alumnos</a>
        <a href="#" onclick="showForm('addForm')">Añadir alumno</a>
        <a href="#" onclick="logout()">Cerrar sesión</a>
    </div>

    <!-- Contenedor "imagen" -->
    <div id="imagen">
    </div>

    <!-- Contenedor para mostrar resultados -->
    <div id="resultado">
    </div>

    <!-- Contenedor para añadir un alumno nuevo -->
    <div id="addForm" class="form-container">
        <h3>Añadir Nuevo Alumno</h3>
        <form>
            <label for="nombre">Nombre:</label><br>
            <input type="text" id="nombre" name="nombre" placeholder="Nombre del alumno" size="50" required /><br><br>

            <label for="apellidos">Apellidos:</label><br>
            <input type="text" id="apellidos" name="apellidos" placeholder="Apellidos del alumno" size="50"
                required /><br><br>

            <label for="casa">Casa:</label><br>
            <select id="casa" name="casa" required>
                <option value="1">Gryffindor</option>
                <option value="2">Hufflepuff</option>
                <option value="3">Ravenclaw</option>
                <option value="4">Slytherin</option>
            </select><br><br>

            <label for="edad">Edad:</label><br>
            <input type="number" id="edad" name="edad" min="11" placeholder="Edad del alumno" required /><br><br>

            <label for="curso">Curso:</label><br>
            <input type="number" id="curso" name="curso" min="1" max="7" placeholder="Curso del alumno"
                required /><br><br>

            <br><br><button type="button" onclick="registrarAlumno()">Añadir alumno</button>
        </form>
    </div>

    <!-- HTML para el formulario de edición de un alumno -->
    <div id="editFormAlumno" class="form-container">
        <h3>Editar Alumno</h3>
        <form>
            <label for="editNombre">Nombre:</label><br>
            <input type="text" id="editNombre" name="editNombre" placeholder="Nombre del alumno" size="50"
                required /><br><br>

            <label for="editApellidos">Apellidos:</label><br>
            <input type="text" id="editApellidos" name="editApellidos" placeholder="Apellidos del alumno" size="50"
                required /><br><br>

            <label for="editCasa">Casa:</label><br>
            <select id="editCasa" name="editCasa" required>
                <option value="1">Gryffindor</option>
                <option value="2">Hufflepuff</option>
                <option value="3">Ravenclaw</option>
                <option value="4">Slytherin</option>
            </select><br><br>

            <label for="editEdad">Edad:</label><br>
            <input type="number" id="editEdad" name="editEdad" min="11" placeholder="Edad del alumno"
                required /><br><br>

            <label for="editCurso">Curso:</label><br>
            <input type="number" id="editCurso" name="editCurso" min="1" max="7" placeholder="Curso del alumno"
                required /><br><br>

            <br><br><button type="button" onclick="editarAlumno()">Editar Alumno</button>
        </form>
    </div>

    <!-- Scripts añadidos para mostrar formularios -->
    <script>
        function showForm(formId) {
            var resultados = document.getElementById('resultado');
            resultados.style.display = 'none';

            var forms = document.querySelectorAll('.form-container');
            forms.forEach(function (form) {
                if (form.id === formId) {
                    form.style.display = 'block';
                } else {
                    form.style.display = 'none';
                }
            });
        }
    </script>

    <!-- Redirección en caso de que JavaScript esté deshabilitado -->
    <noscript>
        <META http-equiv="REFRESH" content="0;URL=noscript.html">
    </noscript>

</body>

<!-- Pie de página -->
<footer>
    <p>&copy; 2024 Alison Nicole Robles Heredia</p>
</footer>

</html>
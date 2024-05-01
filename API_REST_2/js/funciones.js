function mostrarNavbar() {
    // Mostrar la barra de navegación y ocultar otros elementos
    var navbar = document.querySelector('.navbar');
    navbar.style.display = 'block';

    var loginDiv = document.getElementById('loginDiv');
    loginDiv.style.display = 'none';

    var addForm = document.getElementById('addForm');
    addForm.style.display = 'none';

    var editAlumn = document.getElementById('editFormAlumno');
    editAlumn.style.display = 'none';

    // Mostrar el título y la imagen de la página de inicio
    var resultadoDiv = document.getElementById('resultado');
    resultadoDiv.style.display = 'block';
    resultadoDiv.style.textAlign = 'center';

    var titulo = document.createElement('h1');
    titulo.textContent = 'Hogwarts';
    titulo.style.color = 'white';

    var titulo2 = document.createElement('h2');
    titulo2.textContent = 'Escuela de Magia y Hechicería';
    titulo2.style.color = 'white';

    var imagen = document.createElement('img');
    imagen.src = './img/1.jpg';
    imagen.alt = 'Imagen de inicio';
    imagen.style.width = '1000px';
    imagen.style.height = '500px';

    // Limpiar el contenido anterior y agregar los nuevos elementos
    resultadoDiv.innerHTML = '';
    resultadoDiv.appendChild(titulo);
    resultadoDiv.appendChild(titulo2);
    resultadoDiv.appendChild(imagen);
}

function listarCasas() {
    // Realizar una solicitud GET para obtener la lista de casas
    var apiUrl = 'http://localhost/API_REST_2/controladores/casas';
    var resultados = document.getElementById("resultado");

    // Ocultar otros elementos y mostrar el contenedor de resultados
    var addForm = document.getElementById('addForm');
    addForm.style.display = 'none';
    var loginDiv = document.getElementById('loginDiv');
    loginDiv.style.display = 'none';
    var editAlumn = document.getElementById('editFormAlumno');
    editAlumn.style.display = 'none';

    var resultadoDiv = document.getElementById('resultado');
    resultadoDiv.style.display = 'block';
    resultadoDiv.style.textAlign = 'center';

    // Realizar la solicitud GET para obtener las casas
    var xhr = new XMLHttpRequest();
    xhr.onload = () => {
        if (xhr.status === 200) {
            var casas = JSON.parse(xhr.responseText);
            mostrarCasas(casas);
        } else {
            console.log('Error en la respuesta del servidor:', xhr.status);
        }
    };
    xhr.open('GET', apiUrl, true);
    xhr.send();
}

function mostrarCasas(casas) {
    var resultadoDiv = document.getElementById('resultado');
    resultadoDiv.innerHTML = '';

    var tabla = document.createElement('table');
    tabla.classList.add('casas-table');

    var encabezados = ['Nombre', 'Fundador', 'Color', 'Lema', 'Emblema', 'Ilustración'];
    var encabezadoRow = document.createElement('tr');
    encabezados.forEach(function (encabezado) {
        var th = document.createElement('th');
        th.textContent = encabezado;
        encabezadoRow.appendChild(th);
    });
    tabla.appendChild(encabezadoRow);

    casas.forEach(function (casa) {
        var fila = document.createElement('tr');

        var nombreCell = document.createElement('td');
        nombreCell.textContent = casa.nombre;
        fila.appendChild(nombreCell);

        var fundadorCell = document.createElement('td');
        fundadorCell.textContent = casa.fundador;
        fila.appendChild(fundadorCell);

        var colorCell = document.createElement('td');
        colorCell.textContent = casa.color;
        fila.appendChild(colorCell);

        var lemaCell = document.createElement('td');
        lemaCell.textContent = casa.lema;
        fila.appendChild(lemaCell);

        var emblemaCell = document.createElement('td');
        var emblemaImg = document.createElement('img');
        emblemaImg.src = casa.emblema;
        emblemaImg.alt = 'Emblema de ' + casa.nombre;
        emblemaCell.appendChild(emblemaImg);
        fila.appendChild(emblemaCell);

        var imagenCell = document.createElement('td');
        var imagen = document.createElement('img');
        imagen.src = 'img/' + casa.nombre.toLowerCase() + '.jpg';
        imagen.alt = casa.nombre;
        imagen.style.maxWidth = '200px';
        imagen.style.maxHeight = '150px';
        imagenCell.appendChild(imagen);
        fila.appendChild(imagenCell);

        tabla.appendChild(fila);
    });

    resultadoDiv.appendChild(tabla);
}

function listarAlumnos() {
    // Realizar una solicitud GET para obtener la lista de alumnos
    var apiUrl = 'http://localhost/API_REST_2/controladores/alumnos?page=1';
    var resultados = document.getElementById("resultado");

    // Ocultar otros elementos y mostrar el contenedor de resultados
    var addForm = document.getElementById('addForm');
    addForm.style.display = 'none';
    var loginDiv = document.getElementById('loginDiv');
    loginDiv.style.display = 'none';
    var editAlumn = document.getElementById('editFormAlumno');
    editAlumn.style.display = 'none';
    var resultadoDiv = document.getElementById('resultado');
    resultadoDiv.style.display = 'block';
    resultadoDiv.style.textAlign = 'center';

    // Realizar la solicitud GET para obtener los alumnos
    var xhr = new XMLHttpRequest();
    xhr.onload = () => {
        if (xhr.status === 200) {
            var contentType = xhr.getResponseHeader("Content-Type");
            if (contentType && contentType.indexOf("application/json") !== -1) {
                var alumnos = JSON.parse(xhr.responseText);
                mostrarAlumnos(alumnos);
            } else {
                resultados.innerHTML = xhr.responseText;
            }
        } else {
            console.log('Error en la respuesta del servidor:', xhr.status);
        }
    };
    xhr.open('GET', apiUrl, true);
    xhr.send();
    return false;

}

function mostrarAlumnos(alumnosJSON) {
    var resultadoDiv = document.getElementById('resultado');
    resultadoDiv.innerHTML = '';

    var tabla = document.createElement('table');
    tabla.classList.add('alumnos-table');

    var encabezados = ['Nombre', 'Apellidos', 'Casa', 'Edad', 'Curso', 'Acciones'];
    var encabezadoRow = document.createElement('tr');
    encabezados.forEach(function (encabezado) {
        var th = document.createElement('th');
        th.textContent = encabezado;
        encabezadoRow.appendChild(th);
    });
    tabla.appendChild(encabezadoRow);

    alumnosJSON.forEach(function (alumno) {
        var fila = document.createElement('tr');

        var nombreCell = document.createElement('td');
        nombreCell.textContent = alumno.nombre;
        fila.appendChild(nombreCell);

        var apellidosCell = document.createElement('td');
        apellidosCell.textContent = alumno.apellidos;
        fila.appendChild(apellidosCell);

        var casaCell = document.createElement('td');
        casaCell.textContent = obtenerNombreCasa(alumno.codigoCasa);
        fila.appendChild(casaCell);

        var edadCell = document.createElement('td');
        edadCell.textContent = alumno.edad;
        fila.appendChild(edadCell);

        var cursoCell = document.createElement('td');
        cursoCell.textContent = alumno.curso;
        fila.appendChild(cursoCell);

        var accionesCell = document.createElement('td');
        var editarBtn = document.createElement('button');
        editarBtn.textContent = 'Editar';
        editarBtn.classList.add('editar-btn');
        editarBtn.addEventListener('click', function () {
            mostrarFormularioEdicion(alumno.codigoAlumno, alumno.nombre, alumno.apellidos, alumno.codigoCasa, alumno.edad, alumno.curso);
        });
        var eliminarBtn = document.createElement('button');
        eliminarBtn.textContent = 'Eliminar';
        eliminarBtn.classList.add('eliminar-btn');
        eliminarBtn.addEventListener('click', function () {
            eliminarAlumno(alumno.codigoAlumno);
        });
        accionesCell.appendChild(editarBtn);
        accionesCell.appendChild(eliminarBtn);
        fila.appendChild(accionesCell);

        tabla.appendChild(fila);
    });

    resultadoDiv.appendChild(tabla);
}

function obtenerNombreCasa(codigoCasa) {
    switch (codigoCasa) {
        case '1':
            return 'Gryffindor';
        case '2':
            return 'Hufflepuff';
        case '3':
            return 'Ravenclaw';
        case '4':
            return 'Slytherin';
        default:
            return 'Desconocida';
    }
}

function eliminarAlumno(codigoAlumno) {
    var datos = {
        codigoAlumno: codigoAlumno
    };

    var json = JSON.stringify(datos);

    var xhr = new XMLHttpRequest();
    xhr.onload = function () {
        if (xhr.status === 200) {
            alert('Se ha eliminado al alumno exitósamente.');
            listarAlumnos();
        } else {
            alert('Error al eliminar al alumno. Código de estado: ' + xhr.status);
        }
    };

    var apiUrl = 'http://localhost/API_REST_2/controladores/alumnos';

    xhr.open('DELETE', apiUrl, true);
    xhr.setRequestHeader('Content-Type', 'application/json');
    xhr.send(json);

    return false;
}

function registrarAlumno() {
    var nombre = document.getElementById("nombre").value;
    var apellidos = document.getElementById("apellidos").value;
    var casa = document.getElementById("casa").value;
    var edad = document.getElementById("edad").value;
    var curso = document.getElementById("curso").value;

    if (nombre === "" || apellidos === "" || casa === "" || edad === "" || curso === "") {
        alert("Por favor, complete todos los campos.");
        return false;
    } else if (parseInt(edad) < 11 || parseInt(edad) > 17) {
        alert("La edad debe estar entre 11 y 17 años.");
        return false;
    } else if (parseInt(curso) < 1 || parseInt(curso) > 7) {
        alert("El curso debe estar entre 1 y 7.");
        return false;
    } else {
        var nuevoAlumno = {
            nombre: nombre,
            apellidos: apellidos,
            codigoCasa: casa,
            edad: edad,
            curso: curso
        };

        var jsonData = JSON.stringify(nuevoAlumno);

        var xhr = new XMLHttpRequest();

        var apiUrl = 'http://localhost/API_REST_2/controladores/alumnos';

        xhr.open('POST', apiUrl, true);
        xhr.setRequestHeader('Content-Type', 'application/json');

        xhr.onload = function () {
            if (xhr.status === 200) {
                alert('Alumno agregado exitosamente.');
                limpiarFormulario();
                listarAlumnos();
            } else {
                console.error('Error al agregar alumno. Estado:', xhr.status);
                alert('Error al agregar alumno. Por favor, inténtelo de nuevo.');
            }
        };

        xhr.send(jsonData);
        return false;
    }
}


function limpiarFormulario() {
    var nombre = document.getElementById("nombre").value = "";
    var apellidos = document.getElementById("apellidos").value = "";
    var casa = document.getElementById("casa").value = "";
    var edad = document.getElementById("edad").value = "";
    var curso = document.getElementById("curso").value = "";
}

function mostrarFormularioEdicion(codigoAlumno, nombre, apellidos, codigoCasa, edad, curso) {

    document.getElementById("editNombre").value = nombre;
    document.getElementById("editApellidos").value = apellidos;
    document.getElementById("editCasa").value = codigoCasa;
    document.getElementById("editEdad").value = edad;
    document.getElementById("editCurso").value = curso;

    alumnoEditandoId = codigoAlumno;

    showForm('editFormAlumno');
}

function editarAlumno() {
    var nuevoNombre = document.getElementById("editNombre").value;
    var nuevosApellidos = document.getElementById("editApellidos").value;
    var nuevaCasa = document.getElementById("editCasa").value;
    var nuevaEdad = parseInt(document.getElementById("editEdad").value);
    var nuevoCurso = parseInt(document.getElementById("editCurso").value);

    if (nuevoNombre === "" || nuevosApellidos === "" || nuevaCasa === "" || isNaN(nuevaEdad) || nuevaEdad === 0 || isNaN(nuevoCurso) || nuevoCurso === 0) {
        alert("Por favor, complete todos los campos.");
        return false;
    } else if (nuevaEdad < 11 || nuevaEdad > 18) {
        alert("La edad debe estar entre 11 y 18 años.");
        return false;
    } else if (nuevoCurso < 1 || nuevoCurso > 7) {
        alert("El curso debe estar entre 1 y 7.");
        return false;
    } else {
        var datosAlumno = {
            codigoAlumno: alumnoEditandoId,
            nombre: nuevoNombre,
            apellidos: nuevosApellidos,
            codigoCasa: nuevaCasa,
            edad: nuevaEdad,
            curso: nuevoCurso
        };

        var xhr = new XMLHttpRequest();
        var apiUrl = 'http://localhost/API_REST_2/controladores/alumnos';

        xhr.onload = function () {
            if (xhr.status === 200) {
                alert('Alumno actualizado exitosamente.');
                listarAlumnos();
            } else {
                alert('Error al actualizar el alumno. Código de estado: ' + xhr.status);
            }
        };

        xhr.onerror = function () {
            alert('Error en la solicitud AJAX.');
        };

        xhr.open('PUT', apiUrl, true);
        xhr.setRequestHeader('Content-Type', 'application/json');
        xhr.send(JSON.stringify(datosAlumno));

        return false;
    }
}


function listarAsignaturas(formId) {
    // Realizar una solicitud GET para obtener la lista de asignaturas
    var apiUrl = 'http://localhost/API_REST_2/controladores/asignaturas';
    var resultados = document.getElementById("resultado");

    // Ocultar otros elementos y mostrar el contenedor de resultados
    var addForm = document.getElementById('addForm');
    addForm.style.display = 'none';
    var loginDiv = document.getElementById('loginDiv');
    loginDiv.style.display = 'none';
    var editAlumn = document.getElementById('editFormAlumno');
    editAlumn.style.display = 'none';
    var resultadoDiv = document.getElementById('resultado');
    resultadoDiv.style.display = 'block';
    resultadoDiv.style.textAlign = 'center';

    // Realizar la solicitud GET para obtener las asignaturas
    var xhr = new XMLHttpRequest();
    xhr.onload = function () {
        if (xhr.status === 200) {
            var asignaturas = JSON.parse(xhr.responseText);
            mostrarAsignaturas(asignaturas);
        } else {
            console.error('Error en la respuesta del servidor:', xhr.status);
        }
    };
    xhr.open('GET', apiUrl, true);
    xhr.send();
    return false;

}

function mostrarAsignaturas(asignaturas) {
    var resultadoDiv = document.getElementById('resultado');
    resultadoDiv.innerHTML = '';

    var profesores = {
        1: 'Albus Dumbledore',
        2: 'Minerva McGonagall',
        3: 'Severus Snape',
        4: 'Remus Lupin',
        5: 'Horace Slughorn',
        6: 'Pomona Sprout',
        7: 'Filius Flitwick',
        8: 'Cuthbert Binns',
        9: 'Aurora Sinistra',
        10: 'Rolanda Hooch',
        11: 'Charity Burbage',
        12: 'Rubeus Hagrid',
        13: 'Sybill Trelawney',
        14: 'Bathsheda Babbling',
        15: 'Séptima Vector'
    };

    var tabla = document.createElement('table');
    tabla.classList.add('asignaturas-table');

    var encabezados = ['Nombre', 'Profesor', 'Curso', 'Tipo', 'Ilustración'];
    var encabezadoRow = document.createElement('tr');
    encabezados.forEach(function (encabezado) {
        var th = document.createElement('th');
        th.textContent = encabezado;
        encabezadoRow.appendChild(th);
    });
    tabla.appendChild(encabezadoRow);

    asignaturas.forEach(function (asignatura) {
        var fila = document.createElement('tr');

        var nombreCell = document.createElement('td');
        nombreCell.textContent = asignatura.nombre;
        fila.appendChild(nombreCell);

        var profesorCell = document.createElement('td');
        profesorCell.textContent = profesores[asignatura.codigoProfesor];
        fila.appendChild(profesorCell);

        var cursoCell = document.createElement('td');
        cursoCell.textContent = asignatura.curso;
        fila.appendChild(cursoCell);

        var tipoCell = document.createElement('td');
        tipoCell.textContent = asignatura.tipo;
        fila.appendChild(tipoCell);

        var ilustracionCell = document.createElement('td');
        var imagen = document.createElement('img');
        imagen.src = 'img/' + asignatura.nombre.toLowerCase() + '.jpg';
        imagen.alt = asignatura.nombre;
        imagen.style.maxWidth = '200px';
        imagen.style.maxHeight = '150px';
        ilustracionCell.appendChild(imagen);
        fila.appendChild(ilustracionCell);

        tabla.appendChild(fila);
    });

    resultadoDiv.appendChild(tabla);
}

function busquedaToken($usuarioID) {
    // Realizar una solicitud GET para buscar el token de usuario
    var apiUrl = 'http://localhost/API_REST_2/controladores/token/buscartoken?=' + $usuarioID;
    var resultados = document.getElementById("resultado");

    // Ocultar otros elementos y mostrar el contenedor de resultados
    var addForm = document.getElementById('addForm');
    addForm.style.display = 'none';
    var loginDiv = document.getElementById('loginDiv');
    loginDiv.style.display = 'none';
    var editAlumn = document.getElementById('editFormAlumno');
    editAlumn.style.display = 'none';
    var resultadoDiv = document.getElementById('resultado');
    resultadoDiv.style.display = 'block';
    resultadoDiv.style.textAlign = 'center';

    // Realizar la solicitud GET para buscar el token
    var xhr = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            var response = JSON.parse(this.responseText);
            alert(response);
        } else {
            alert('Error interno del servidor.');
        }
    };

    xhr.open('GET', apiUrl, true);
    xhr.send();

    return false;
}
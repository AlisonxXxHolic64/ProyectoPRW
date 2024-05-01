function login() {
    // Obtiene el usuario y la contraseña ingresados por el usuario
    var usuario = document.getElementById("usuario").value;
    var password = document.getElementById("password").value;

    // Crea una nueva solicitud XMLHttpRequest
    var xhttp = new XMLHttpRequest();

    // Define la función de devolución de llamada para manejar la respuesta del servidor
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            // Analiza la respuesta JSON del servidor
            var response = JSON.parse(this.responseText);
            // Verifica si el inicio de sesión fue exitoso
            if (response.status === "OK") {
                // Extrae el token y el ID de usuario de la respuesta
                var token = {
                    tokenID: response.result.token
                };
                var usuarioID = {
                    usuarioID: response.result.usuarioID
                };

                // Almacena el token y el ID de usuario en sessionStorage
                sessionStorage.setItem('token', JSON.stringify(token));
                sessionStorage.setItem('usuarioID', JSON.stringify(usuarioID));

                // Muestra un mensaje de bienvenida y actualizar la barra de navegación
                alert("Inicio de sesión exitoso. Bienvenido/a, " + usuario + ".");
                mostrarNavbar();

            } else {
                // Muestra un mensaje de error si el inicio de sesión falla
                alert("Inicio de sesión fallido. Por favor, inténtalo de nuevo.");
            }
        }
    };

    // Especifica la URL de la API y el método de solicitud
    var apiUrl = 'http://localhost/API_REST_2/controladores/auth';
    xhttp.open("POST", apiUrl, true);
    // Establece el encabezado Content-Type para la solicitud
    xhttp.setRequestHeader("Content-Type", "application/json;charset=UTF-8");

    // Convierte los datos del usuario a formato JSON y enviar la solicitud
    var data = JSON.stringify({ usuario: usuario, password: password });
    xhttp.send(data);

    return false;
}


function logout() {
    // Obtiene el nombre de usuario actual
    var usuario = document.getElementById("usuario").value;

    // Muestra un mensaje de despedida
    alert("Sesión cerrada exitósamente. Hasta pronto, " + usuario + ".");

    // Redirigire al usuario a la página de inicio
    window.location.href = "index.php";

    // Limpia los campos de usuario y contraseña
    document.getElementById("usuario").value = '';
    document.getElementById("password").value = '';
}

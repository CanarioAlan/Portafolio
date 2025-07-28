<?php
header('Content-Type: application/json');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos del formulario
    $nombre = htmlspecialchars($_POST['nombre']);
    $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
    $mensaje = htmlspecialchars($_POST['mensaje']);

    // Validar campos obligatorios
    // if (!$nombre || !$apellido || !$telefono || !$email || !$mensaje) {
    //     echo json_encode([
    //         'success' => false,
    //         'message' => 'Por favor, complete todos los campos correctamente.'
    //     ]);
    //     exit;
    // }

    // Configuración del correo
    $to = "alan.union.1999@gmail.com"; // Cambiar al correo destino
    $subject = "Nuevo mensaje desde el portafolio";
    $headers = "From: $email\r\n";
    $headers .= "Reply-To: $email\r\n";
    $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

    $body = "Nombre: $nombre\n";
    $body .= "Email: $email\n\n";
    $body .= "Mensaje:\n$mensaje\n";

    // Enviar el correo
    if (mail($to, $subject, $body, $headers)) {
        echo json_encode([
            'success' => true,
            'message' => 'Mensaje enviado correctamente'
        ]);
    } else {
        echo json_encode([
            'success' => false,
            'message' => 'Hubo un problema al enviar el mensaje. Inténtelo más tarde.'
        ]);
    }
} else {
    echo json_encode([
        'success' => false,
        'message' => 'Acceso no permitido.'
    ]);
}
error_log("Error al enviar correo: " . print_r(error_get_last(), true));

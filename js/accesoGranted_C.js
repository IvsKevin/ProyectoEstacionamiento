// Solicita permiso al usuario para enviar notificaciones
Notification.requestPermission().then(permission => {
    if(permission === "granted") {
        // El usuario ha dado permiso
        new Notification("Bienvenido a Parking Manager " + nickname, {
            body: "Haz iniciado sesion como cliente"
        });
    } else {
        // El usuario ha denegado el permiso o no ha respondido
        console.log("Permiso de notificación denegado");
    }
});

setTimeout(function() {
    window.location.href = '../view/client/parking.php';
}, 2); // espera 5 segundos antes de redirigir


// // Asegura de que este código se ejecuta después de que la página haya cargado completamente
// document.addEventListener('DOMContentLoaded', () => {
//     setTimeout(function() {
//         window.location.href = '../view/client/empleados.php';
//     }, 0); // espera 5 segundos antes de redirigir
// });

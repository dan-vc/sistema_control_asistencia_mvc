function showNotification(title, body) {
  // Verificamos si tenemos permiso para mostrar notificaciones
  if (Notification.permission === 'granted') {

    // Instanciamos notificacion (title, object)
    new Notification(title, {
      body: body,
      icon: '../../public/img/logo-square.png'
    })
  } else {
    // Informamos al usuario
    console.log('Permiso para notificaciones denegado.')
  }
}

// Solicitamos permisos para mostrar notificaciones
function requestNotificationPermission() {
  // Verificamos si el navegador soporta notificaciones
  if ('Notification' in window) {
    // Solicitamos el permiso
    Notification.requestPermission().then(permission => {
      // Si obtenemos permiso informamos por consola y mostramos notificacion
      if (permission === 'granted') {
        console.log('Permiso concedido para notificaciones.');
      } else {
        console.log('Permiso denegado para notificaciones.');
      }

    }).catch(error => {
      console.error('Error al solicitar permisos para notificaciones:', error);

    });
  } else {
    console.log('Las notificaciones no están soportadas en este navegador.');
    
  }
}

requestNotificationPermission()
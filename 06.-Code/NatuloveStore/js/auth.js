let timeout;

function resetTimer() {
  clearTimeout(timeout);
  timeout = setTimeout(logout, 60000); // 20000ms = 3 minutos
}

function logout() {
  firebase.auth().signOut().then(() => {
    alert('Has sido desconectado debido a inactividad');
    window.location.href = 'login.php'; // Redirigir al login
  });
}

// Inicia el temporizador de inactividad cuando se carga la página
window.onload = resetTimer;
// Resetea el temporizador cuando el usuario mueve el ratón o presiona una tecla
window.onmousemove = resetTimer;
window.onkeydown = resetTimer;

document.addEventListener("DOMContentLoaded", () => {
    const form = document.querySelector("form");
    const username = document.getElementById("username");
    const password = document.getElementById("passwordLogin");

    form.addEventListener("submit", (event) => {
        if (!username.value || !password.value) {
            event.preventDefault();
            alert("Por favor, completa todos los campos.");
        }
    });
});

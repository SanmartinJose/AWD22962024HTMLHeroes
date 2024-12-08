<?php include_once './includes/header.php';?>
<div class="container mt-5">
    <div class="card text-center shadow-lg">
        <div class="card-header bg-dark text-white">
            <h1>Bienvenido :v</h1>
        </div>
        <div class="card-body">
            <blockquote class="blockquote mb-0">
                <p id="fraseMotivadora" class="font-italic"></p> <!-- Aquí se mostrará la frase motivadora -->
                <footer class="blockquote-footer">Una frase para inspirar tu día</footer>
            </blockquote>
        </div>
    </div>
</div>

<script>
   
    function mostrarFraseMotivadora() {
        const frases = [
            "El éxito es la suma de pequeños esfuerzos repetidos día tras día.",
            "Tu trabajo es una parte importante de tu vida, así que disfrútalo y hazlo con pasión.",
            "No es sobre tener tiempo, es sobre hacer tiempo.",
            "La perseverancia es la clave del éxito.",
            "Cada día es una nueva oportunidad para ser mejor que ayer.",
            "El esfuerzo de hoy es el éxito de mañana.",
            "Con cada desafío, viene una oportunidad de aprender y crecer.",
            "El talento gana juegos, pero el trabajo en equipo y la inteligencia ganan campeonatos.",
            "Lo que hagas hoy puede mejorar todos tus mañanas.",
            "No cuentes los días, haz que los días cuenten."
        ];

    
        const fraseSeleccionada = frases[Math.floor(Math.random() * frases.length)];

      
        document.getElementById('fraseMotivadora').textContent = fraseSeleccionada;
    }

 
    document.addEventListener("DOMContentLoaded", mostrarFraseMotivadora);
</script>

<script src="funciones.js"></script>

<?php include_once './includes/footer.php';?>

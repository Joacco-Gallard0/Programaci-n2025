// script.js
// Archivo simple de JavaScript para darle dinamismo a la página

// Espera que todo el contenido del sitio cargue
document.addEventListener("DOMContentLoaded", function () {

    // Muestra un pequeño mensaje al entrar
    console.log("Página cargada correctamente 🎬");

    const btnToggle = document.getElementById("btn-toggle");
    const form = document.getElementById("form-pelicula");

    // Mostrar/ocultar el formulario al hacer clic en el botón
    btnToggle.addEventListener("click", function () {
        if (form.style.display === "none") {
            form.style.display = "block";
            btnToggle.textContent = "Ocultar formulario";
        } else {
            form.style.display = "none";
            btnToggle.textContent = "Mostrar formulario";
        }
    });

    // Validación simple antes de enviar el formulario
    form.addEventListener("submit", function (e) {
        const inputs = form.querySelectorAll("input, textarea");
        let vacio = false;

        inputs.forEach(campo => {
            if (campo.value.trim() === "") {
                campo.style.border = "2px solid red";
                vacio = true;
            } else {
                campo.style.border = "1px solid #ccc";
            }
        });

        if (vacio) {
            e.preventDefault();
            alert("⚠️ Completá todos los campos antes de enviar.");
        }
    });
});

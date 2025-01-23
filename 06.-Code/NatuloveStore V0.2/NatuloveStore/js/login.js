document.getElementById('registerForm').addEventListener('submit', async function (e) {
    e.preventDefault();

    const form = e.target;
    const formData = new FormData(form);
    const response = await fetch(form.action, { method: 'POST', body: formData });
    const result = await response.json();

    document.querySelectorAll('.invalid-feedback').forEach(div => div.textContent = '');

    if (result.success) {
        alert('Registro Exitoso');
        form.reset();
    } else {
        for (const [key, message] of Object.entries(result.errors)) {
            const field = form.querySelector(`[name="${key}"]`);
            const feedback = field.parentElement.querySelector('.invalid-feedback');
            if (feedback) feedback.textContent = message;
        }
    }
});

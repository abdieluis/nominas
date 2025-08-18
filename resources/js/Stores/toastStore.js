import { reactive } from 'vue';

let timeoutId = null; // Variable para almacenar la referencia del temporizador

export const toastStore = reactive({
    show: false,
    message: '',
    type: '',

    showSuccess(message = 'Proceso completado correctamente.') {
        this.show = true;
        this.message = message;
        this.type = 'success';
        this.startHideTimer();
    },

    showError(message = 'El proceso tuvo un error.') {
        this.show = true;
        this.message = message;
        this.type = 'error';
        this.startHideTimer();
    },

    startHideTimer() {
        // Limpia el temporizador anterior si existe
        if (timeoutId) {
            clearTimeout(timeoutId);
        }

        // Inicia un nuevo temporizador
        timeoutId = setTimeout(() => {
            this.show = false;
        }, 3000); // Oculta después de 3 segundos
    }
});
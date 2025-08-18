import { reactive } from 'vue';

export const toastStore = reactive({
    show: false,
    message: '',
    type: '',

    showSuccess(message = 'Proceso completado correctamente.') {
        this.show = true;
        this.message = message;
        this.type = 'success';
        this.hideToastAfterDelay();
    },

    showError(message = 'El proceso tuvo un error.') {
        this.show = true;
        this.message = message;
        this.type = 'error';
        this.hideToastAfterDelay();
    },

    hideToastAfterDelay() {
        setTimeout(() => {
            this.show = false;
        }, 3000); // Ocultar después de 3 segundos
    }
});
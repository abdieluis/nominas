<script setup>
import { reactive, watch } from 'vue';
import { toastStore } from '@/Stores/toastStore.js';

// Esto es lo que reacciona a los cambios en el store
const toastClass = reactive({
    'bg-green-500': false,
    'bg-red-500': false
});


watch(() => toastStore.type, (newType) => {
    toastClass['bg-green-500'] = newType === 'success';
    toastClass['bg-red-500'] = newType === 'error';

    toast.add({ severity: 'info', summary: 'Exito', detail: 'Message Content', life: 3000 });
}, { immediate: true });

const showInfo = () => {
    
};
</script>
<template>
    <transition>
        <div v-if="toastStore.show" class="fixed bottom-5 right-5 z-50 p-4 rounded-md shadow-lg" :class="toastClass">
            <p class="text-white">{{ toastStore.message }}</p>
            <Toast />
            <Button label="Success" severity="success" @click="showSuccess" />
        </div>
    </transition>
</template>


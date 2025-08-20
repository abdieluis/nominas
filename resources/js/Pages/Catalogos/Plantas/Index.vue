<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import { ref, onMounted } from "vue";

const props = defineProps({
    plantas: Array,
});

onMounted(() => {
    console.log(props.plantas);
    // initFilters();
    // loading.value = false;
});
</script>

<template>
    <AppLayout :title="'Prestaciones'">
        <div class="card flex flex-row items-center justify-between">
            <h3 class="mb-0">Plantas</h3>
            <Button icon="pi pi-plus" label="Crear Planta"></Button>
        </div>
        
        <div class="flex flex-wrap gap-4 mt-4">
            <div v-for="planta in props.plantas" :key="planta.id" class="card">
                <Card style="width: 25rem; overflow: hidden">
                    <template #title>
                        {{ planta.planta }}
                    </template>
                    <template #subtitle>
                        <Tag severity="success" class="mr-2" :value="`CLAVE: ${planta.codigo}`"></Tag>
                        <Tag severity="success" class="mr-2" :value="`EMPRESA: ${planta.empresa}`"></Tag>
                        <Tag severity="success" class="mr-2" :value="`RFC: ${planta.rfc}`"></Tag>
                        <Tag severity="success" class="mr-2" :value="`CLAVE NETSUITE: ${planta.clave_netsuite}`"></Tag>
                        <Tag severity="success" class="mr-2" :value="`CLAVE UBICACIÓN NETSUITE: ${planta.clave_ubicacion_netsuite}`"></Tag>
                        <template v-if="planta.certificado_fiscal">
                            <Tag severity="success" class="mr-2">
                                <i class="pi pi-check mr-1"></i> 
                                <span>CUENTA CERTIFICADO FISCAL</span>
                            </Tag>
                        </template>

                        <template v-else>
                            <Tag severity="danger" class="mr-2">
                                <i class="pi pi-times mr-1"></i>
                                <span>NO CUENTA CON CERTIFICADO FISCAL</span>
                            </Tag>
                        </template>
                        <template v-if="planta.expiracion_clave">
                            <Tag severity="success" class="mr-2">
                                <i class="pi pi-calendar"></i> 
                                <span>planta.expiracion_clave</span>
                            </Tag>
                        </template>

                        <template v-else>
                            <Tag severity="danger" class="mr-2">
                                <i class="pi pi-calendar-times"></i>
                                <span>SIN FECHA</span>
                            </Tag>
                        </template>
                    </template>
                    <template #content>
                        <p class="m-0">
                            {{ planta.descripcion }}
                        </p>
                    </template>
                    <template #footer>
                        <div class="flex gap-4 mt-1">
                            <Button label="Cancel" severity="secondary" variant="outlined" class="w-full" />
                            <Button label="Save" class="w-full" />
                        </div>
                    </template>
                </Card>
            </div>
        </div>

    </AppLayout>
</template>

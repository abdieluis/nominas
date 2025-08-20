<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import { useForm } from "@inertiajs/vue3";
import { ref } from "vue";

const props = defineProps({
    prestaciones: Array,
});

const visible = ref(false);
const tipoOptions = ref([
    { label: "Días", value: "days" },
    { label: "Meses", value: "months" },
]);
const prestacion = useForm({
    id: null,
    name: "",
    description: "",
    type: "days",
    each: 1,
    efficiency_rules: JSON.stringify([]),
    conditioned: 0,
    conditioned_seniority: 0,
    conditioned_efficiency: 0,
});

const lengthEficiencyRules = (prestacion) => {
    const prestacionArray = JSON.parse(prestacion.efficiency_rules);
    if (prestacionArray.length === 0 || !prestacionArray) {
        return "No hay reglas de eficiencia";
    }
    return `${prestacionArray.length} regla (s) de eficiencia`;
};

const setEach = (prestacion) => {
    switch (prestacion.type) {
        case "days":
            return `Cada ${prestacion.each} día (s)`;
        case "months":
            return `Cada ${prestacion.each} mes (es)`;
    }
};
</script>

<template>
    <AppLayout :title="'Prestaciones'">
        <div class="card flex flex-row items-center justify-between">
            <h3 class="mb-0">Prestaciones</h3>
            <Button
                icon="pi pi-plus"
                @click="visible = true"
                label="Crear Prestación"
            ></Button>
        </div>
        <div
            class="grid grid-cols-3 gap-4 max-md:grid-cols-2 max-lg:grid-cols-2 max-sm:grid-cols-1"
        >
            <template
                v-for="prestacion in props.prestaciones"
                :key="prestacion.id"
            >
                <Card style="width: 25rem; overflow: hidden">
                    <template #title
                        >{{ prestacion.name }}
                        <Tag
                            class="mb-2 ml-2"
                            severity="danger"
                            :value="setEach(prestacion)"
                        ></Tag
                    ></template>
                    <template #subtitle class="">
                        <Tag
                            v-if="prestacion.conditioned === 1"
                            severity="info"
                            v-tooltip.top="'Condicionado Faltas'"
                            class="mr-2 my-2"
                            icon="pi pi-calendar"
                            value="Faltas"
                        ></Tag>
                        <Tag
                            v-if="prestacion.conditioned_seniority === 1"
                            severity="warn"
                            class="mr-2"
                            icon="pi pi-clock"
                            v-tooltip.top="'Condicionado Antiguedad'"
                            value="Antiguedad"
                        ></Tag>
                        <Tag
                            v-if="prestacion.conditioned_efficiency === 1"
                            severity="success"
                            class="mr-2"
                            icon="pi pi-check"
                            v-tooltip.top="'Condicionado Eficiencia'"
                            value="Eficiencia"
                        ></Tag>
                    </template>
                    <template #content>
                        <Tag
                            class="my-2"
                            severity="secondary"
                            :value="lengthEficiencyRules(prestacion)"
                        ></Tag>
                        <p class="m-0 text-gray-500">
                            Descripción: {{ prestacion.description }}
                        </p>
                    </template>
                    <template #footer>
                        <div class="flex gap-4 mt-1">
                            <Button
                                label="Eliminar"
                                severity="danger"
                                class="w-full"
                                icon="pi pi-trash"
                            />
                            <Button
                                label="Editar"
                                severity="warn"
                                icon="pi pi-pencil"
                                class="w-full"
                            />
                        </div>
                    </template>
                </Card>
            </template>
        </div>
        <Dialog
            v-model:visible="visible"
            modal
            header="Añadir o editar prestación"
            :style="{ width: '35rem' }"
        >
            <div class="flex flex-col gap-4 mb-4">
                <label for="prestacion" class="font-semibold w-24"
                    >Prestacion</label
                >
                <InputText
                    id="prestacion"
                    class="flex-auto"
                    autocomplete="off"
                    v-model="prestacion.name"
                />
            </div>
            <div class="flex flex-col gap-4 mb-4">
                <label for="descripcion" class="font-semibold w-24"
                    >Descripción</label
                >
                <Textarea
                    v-model="prestacion.description"
                    rows="5"
                    cols="30"
                    class="resize-none"
                    maxlength="250"
                    id="descripcion"
                    name="descripcion"
                />
            </div>
            <div class="flex flex-col gap-4 mb-4">
                <label for="tipo" class="font-semibold w-24">Tipo</label>
                <Dropdown
                    v-model="prestacion.type"
                    :options="tipoOptions"
                    id="tipo"
                    name="tipo"
                    option-label="label"
                    option-value="value"
                />
            </div>

            <div class="flex justify-end gap-2">
                <Button
                    type="button"
                    label="Cancel"
                    severity="secondary"
                    @click="visible = false"
                ></Button>
                <Button
                    type="button"
                    label="Save"
                    @click="visible = false"
                ></Button>
            </div>
        </Dialog>
    </AppLayout>
</template>

<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import { useForm } from "@inertiajs/vue3";
import { ref } from "vue";
import { router } from "@inertiajs/vue3";

const props = defineProps({
    prestaciones: Array,
});

const visible = ref(false);
const tipoOptions = ref([
    { label: "Días", value: "days" },
    { label: "Meses", value: "months" },
]);

const operadores = ref([
    { label: "<", value: "<" },
    { label: "<=", value: "<=" },
    { label: "=", value: "=" },
    { label: ">=", value: ">=" },
    { label: ">", value: ">" },
]);

const prestacion = useForm({
    id: null,
    name: "",
    description: "",
    type: "days",
    each: 1,
    efficiency_rules: [],
    conditioned: false,
    conditioned_seniority: false,
    conditioned_efficiency: false,
    day_cutoff: 1,
});

const openNew = () => {
    prestacion.reset();
    visible.value = true;
};

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

const editPrestacion = (data) => {
    prestacion.id = data.id;
    prestacion.name = data.name;
    prestacion.description = data.description;
    prestacion.type = data.type;
    prestacion.each = data.each;
    prestacion.efficiency_rules = data.efficiency_rules;
    prestacion.conditioned = data.conditioned === 1 ? true : false;
    prestacion.conditioned_seniority =
        data.conditioned_seniority === 1 ? true : false;
    prestacion.conditioned_efficiency =
        data.conditioned_efficiency === 1 ? true : false;
    prestacion.day_cutoff = data.day_cutoff;
    visible.value = true;
};

const savePrestacion = () => {
    for (const regla of prestacion.efficiency_rules) {
        if (
            regla.amount === 0 ||
            regla.amount === null ||
            regla.operator === "" ||
            regla.operator === null ||
            regla.percent === 0 ||
            regla.percent === null
        ) {
            prestacion.setError(
                "efficiency_rules",
                "Todas las reglas deben estar completas.",
            );
            return;
        }
    }
    prestacion.clearErrors("efficiency_rules");

    prestacion.post("prestaciones/store", {
        onSuccess: () => {
            visible.value = false;
        },
    });
};
</script>

<template>
    <AppLayout :title="'Prestaciones'">
        <div class="card flex flex-row items-center justify-between">
            <h3 class="mb-0">Prestaciones</h3>
            <Button
                icon="pi pi-plus"
                @click="openNew"
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
                                @click="editPrestacion(prestacion)"
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
                <small v-if="prestacion.errors.name" class="text-red-500"
                    >Este campo es obligatorio.</small
                >
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
                    class="py-1"
                />
            </div>
            <div class="flex flex-col gap-4 mb-4">
                <label for="cada" class="font-semibold w-24">Cada</label>
                <InputNumber
                    v-model="prestacion.each"
                    inputId="cada"
                    prefix="Cada "
                    :suffix="
                        prestacion.type === 'days' ? ' día (s)' : ' mes (es)'
                    "
                    fluid
                />
                <small v-if="prestacion.errors.each" class="text-red-500"
                    >Este campo es obligatorio.</small
                >
            </div>
            <div class="flex flex-col gap-4 mb-4">
                <label for="cada" class="font-semibold w-24"
                    >Dia de corte</label
                >
                <InputNumber v-model="prestacion.day_cutoff" min="1" max="31" />
                <small v-if="prestacion.errors.day_cutoff" class="text-red-500"
                    >Este campo es obligatorio.</small
                >
            </div>

            <div class="flex flex-col gap-4 mb-4 w-full">
                <label for="cada" class="font-semibold w-24"
                    >Condicionado</label
                >
                <div class="flex justify-center">
                    <ToggleButton
                        v-model="prestacion.conditioned"
                        onLabel="Faltas"
                        offLabel="Faltas"
                    />
                    <ToggleButton
                        v-model="prestacion.conditioned_seniority"
                        onLabel="Antigüedad"
                        offLabel="Antigüedad"
                    />
                    <ToggleButton
                        v-model="prestacion.conditioned_efficiency"
                        onLabel="Eficiencia"
                        offLabel="Eficiencia"
                    />
                </div>
                <small v-if="prestacion.errors.conditioned" class="text-red-500"
                    >El campo "Condicionado por Faltas" es obligatorio.</small
                >
                <small
                    v-if="prestacion.errors.conditioned_seniority"
                    class="text-red-500"
                    >El campo "Condicionado por Antigüedad" es
                    obligatorio.</small
                >
                <small
                    v-if="prestacion.errors.conditioned_efficiency"
                    class="text-red-500"
                    >El campo "Condicionado por Eficiencia" es
                    obligatorio.</small
                >
            </div>
            <div class="flex flex-col gap-4 mb-4 w-full">
                <label for="cada" class="font-semibold"
                    >Reglas de eficiencia</label
                >
                <div
                    v-for="(regla, i) in prestacion.efficiency_rules"
                    :key="i"
                    class="flex justify-center gap-4 mb-4"
                >
                    <InputText
                        v-model="regla.amount"
                        placeholder="Monto"
                        class="w-1/4"
                    />
                    <Dropdown
                        v-model="regla.operator"
                        :options="operadores"
                        placeholder="Operador"
                        option-label="label"
                        option-value="value"
                    />
                    <InputText
                        v-model="regla.percent"
                        placeholder="Porcentaje"
                        class="w-1/4"
                    />
                    <Button
                        icon="pi pi-trash"
                        severity="danger"
                        class="w-1/12"
                        @click="prestacion.efficiency_rules.splice(i, 1)"
                    />
                </div>

                <small
                    v-if="prestacion.errors.efficiency_rules"
                    class="text-red-500"
                    >Todas las reglas deben estar completas.</small
                >

                <div
                    v-if="prestacion.efficiency_rules.length === 0"
                    class="text-sm text-gray-500 flex flex-col text-center"
                >
                    No hay reglas.
                </div>
                <Button
                    label="Agregar"
                    icon="pi pi-plus"
                    severity="success"
                    @click="
                        prestacion.efficiency_rules.push({
                            amount: 0,
                            operator: '',
                            percent: 0,
                        })
                    "
                />
            </div>

            <div class="flex justify-end gap-2">
                <Button
                    type="button"
                    label="Cancelar"
                    severity="secondary"
                    @click="visible = false"
                ></Button>
                <Button
                    type="button"
                    label="Guardar"
                    @click="savePrestacion"
                ></Button>
            </div>
        </Dialog>
    </AppLayout>
</template>

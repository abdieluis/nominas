<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import { ref, onMounted } from "vue";
import DataTable from 'primevue/datatable';
import Column from 'primevue/column';
import Button from 'primevue/button';
import IconField from 'primevue/iconfield';
import InputIcon from 'primevue/inputicon';
import InputText from 'primevue/inputtext';
import { FilterMatchMode, FilterOperator } from '@primevue/core/api';

// 1. Declarar las props primero
const props = defineProps({
    asistencias: Array,
});

// 2. Declarar las variables reactivas
const layout = ref('grid');
const options = ref(['list', 'grid']);

const filters = ref({
    global: { value: null, matchMode: FilterMatchMode.CONTAINS },
    employee_name: { operator: FilterOperator.AND, constraints: [{ value: null, matchMode: FilterMatchMode.STARTS_WITH }] },
    incidence_code: { value: null, matchMode: FilterMatchMode.EQUALS },
    observation_date: { operator: FilterOperator.AND, constraints: [{ value: null, matchMode: FilterMatchMode.DATE_IS }] },
});
const loading = ref(false);

// 3. Definir las funciones del ciclo de vida y otras lógicas
onMounted(() => {
    console.log(props.asistencias);
    // initFilters();
    // loading.value = false;
});

const clearFilter = () => {
    // Puedes redefinir la función para resetear los valores
    filters.value.global.value = null;
    filters.value.employee_name.constraints[0].value = null;
    filters.value.incidence_code.value = null;
    filters.value.observation_date.constraints[0].value = null;
};
</script>

<template>
    <AppLayout title="Dashboard">
        <!-- <div class="card">
            <DataView :value="props.asistencias" :layout="layout">
                <template #header>
                    <div class="flex justify-end">
                        <SelectButton v-model="layout" :options="options" :allowEmpty="false">
                            <template #option="{ option }">
                                <i :class="[option === 'list' ? 'pi pi-bars' : 'pi pi-table']" />
                            </template>
</SelectButton>
</div>
</template>

<template #list="slotProps">
                    <div class="flex flex-col">
                        <div v-for="(item, index) in slotProps.items" :key="index">
                            <div class="flex flex-col sm:flex-row sm:items-center p-6 gap-4"
                                :class="{ 'border-t border-surface-200 dark:border-surface-700': index !== 0 }">
                                <div class="flex flex-col md:flex-row justify-between md:items-center flex-1 gap-6">
                                    <div class="flex flex-row md:flex-col justify-between items-start gap-2">
                                        <div>
                                            <span class="font-medium text-surface-500 dark:text-surface-400 text-sm">{{
                                                item.employee_name }}</span>
                                            <div class="text-lg font-medium mt-2">{{ item.employee_name }}</div>
                                        </div>
                                        <div class="bg-surface-100 p-1" style="border-radius: 30px">
                                            <div class="bg-surface-0 flex items-center gap-2 justify-center py-1 px-2"
                                                style="border-radius: 30px; box-shadow: 0px 1px 2px 0px rgba(0, 0, 0, 0.04), 0px 1px 2px 0px rgba(0, 0, 0, 0.06)">
                                                <span class="text-surface-900 font-medium text-sm">{{ item.employee_name
                                                }}</span>
                                                <i class="pi pi-star-fill text-yellow-500"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="flex flex-col md:items-end gap-8">
                                        <span class="text-xl font-semibold">${{ item.employee_name }}</span>
                                        <div class="flex flex-row-reverse md:flex-row gap-2">
                                            <Button icon="pi pi-heart" variant="outlined"></Button>
                                            <Button icon="pi pi-shopping-cart" label="Buy Now"
                                                :disabled="item.employee_name === 'OUTOFSTOCK'"
                                                class="flex-auto md:flex-initial whitespace-nowrap"></Button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </template>

<template #grid="slotProps">
                    <div class="grid grid-cols-12 gap-4">
                        <div v-for="(item, index) in slotProps.items" :key="index"
                            class="col-span-12 sm:col-span-6 md:col-span-4 xl:col-span-6 p-2">
                            <div
                                class="p-6 border border-surface-200 dark:border-surface-700 bg-surface-0 dark:bg-surface-900 rounded flex flex-col">
                                <div class="pt-6">
                                    <div class="flex flex-row justify-between items-start gap-2">
                                        <div>
                                            <span class="font-medium text-surface-500 dark:text-surface-400 text-sm">{{
                                                item.employee_name }}</span>
                                            <div class="text-lg font-medium mt-1">{{ item.employee_name }}</div>
                                        </div>
                                        <div class="bg-surface-100 p-1" style="border-radius: 30px">
                                            <div class="bg-surface-0 flex items-center gap-2 justify-center py-1 px-2"
                                                style="border-radius: 30px; box-shadow: 0px 1px 2px 0px rgba(0, 0, 0, 0.04), 0px 1px 2px 0px rgba(0, 0, 0, 0.06)">
                                                <span class="text-surface-900 font-medium text-sm">{{ item.employee_name
                                                }}</span>
                                                <i class="pi pi-star-fill text-yellow-500"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="flex flex-col gap-6 mt-6">
                                        <span class="text-2xl font-semibold">${{ item.employee_name }}</span>
                                        <div class="flex gap-2">
                                            <Button icon="pi pi-shopping-cart" label="Buy Now"
                                                :disabled="item.employee_name === 'OUTOFSTOCK'"
                                                class="flex-auto whitespace-nowrap"></Button>
                                            <Button icon="pi pi-heart" variant="outlined"></Button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </template>
</DataView>
</div> -->
        <div class="card">
            <DataTable v-model:filters="filters" :value="props.asistencias" paginator showGridlines :rows="10"
                dataKey="id" filterDisplay="menu" :loading="loading"
                :globalFilterFields="['employee_name', 'incidence_code', 'observation_date']">
                <template #header>
                    <div class="flex justify-between">
                        <Button type="button" icon="pi pi-filter-slash" label="Clear" variant="outlined"
                            @click="clearFilter()" />
                        <IconField>
                            <InputIcon>
                                <i class="pi pi-search" />
                            </InputIcon>
                            <InputText v-model="filters['global'].value" placeholder="Búsqueda Global" />
                        </IconField>
                    </div>
                </template>

                <template #empty> No se encontraron asistencias. </template>

                <Column field="employee_name" header="Nombre del Empleado">
                    <template #body="{ data }">
                        {{ data.employee_name }}
                    </template>
                    <template #filter="{ filterModel }">
                        <InputText v-model="filterModel.value" type="text" placeholder="Buscar por nombre" />
                    </template>
                </Column>

                <Column field="incidence_code" header="Código de Incidencia">
                    <template #body="{ data }">
                        <span>{{ data.incidence_code }}</span>
                    </template>
                    <template #filter="{ filterModel }">
                        <InputText v-model="filterModel.value" type="text" placeholder="Buscar por código" />
                    </template>
                </Column>

                <Column field="observation_date" header="Fecha de Observación" dataType="date">
                    <template #body="{ data }">
                        {{ data.observation_date }}
                    </template>
                    <template #filter="{ filterModel }">
                        <InputText v-model="filterModel.value" type="text" placeholder="Buscar por fecha" />
                    </template>
                </Column>
            </DataTable>
        </div>
    </AppLayout>

</template>
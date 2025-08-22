<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import { useToastService } from "@/Stores/toastService";
import { useForm } from "@inertiajs/vue3";
import { ref } from "vue";
const { showSuccess, showError } = useToastService();

const props = defineProps({
    categorias: Array,
});

const categoria = useForm({
    id: null,
    name: "",
    code: null,
});

const visible = ref(false);
const submitted = ref(false);
const deleteCategoriaDialog = ref(false);

const openNew = () => {
    categoria.reset();
    visible.value = true;
};

const submit = () => {
    submitted.value = true;
    categoria.post("categorias-incidencias/store", {
        onSuccess: () => {
            visible.value = false;
            categoria.reset();
            showSuccess();
            submitted.value = false;
        },
        onError: () => {
            showError();
            submitted.value = false;
        },
    });
};

const showDelete = (id) => {
    // Show confirmation dialog
    deleteCategoriaDialog.value = true;
    categoria.id = id;
};

const deleteCategoria = () => {
    submitted.value = true;
    categoria.delete(`categorias-incidencias/${categoria.id}`, {
        onSuccess: () => {
            deleteCategoriaDialog.value = false;
            showSuccess();
            categoria.reset();
            submitted.value = false;
        },
        onError: () => {
            showError();
            submitted.value = false;
        },
    });
};

console.log(props.categorias);
</script>
<template>
    <AppLayout :title="'Categorias de Incidencias'">
        <div class="card flex flex-row items-center justify-between">
            <h3 class="mb-0">Categorias de Incidencias</h3>
            <Button
                icon="pi pi-plus"
                @click="openNew"
                label="Crear Categoria"
            ></Button>
        </div>
        <div
            class="grid grid-cols-3 gap-4 max-md:grid-cols-2 max-lg:grid-cols-2 max-sm:grid-cols-1"
        >
            <template v-for="categoria in props.categorias" :key="categoria.id">
                <Card style="width: 25rem; overflow: hidden">
                    <template #title>{{ categoria.name }}</template>
                    <template #subtitle class=""> </template>
                    <template #content>
                        <Tag
                            class="my-2"
                            severity="success"
                            :value="'Codigo: ' + categoria.code"
                        ></Tag>
                    </template>
                    <template #footer>
                        <div class="flex gap-4 mt-1">
                            <Button
                                label="Eliminar"
                                severity="danger"
                                class="w-full"
                                icon="pi pi-trash"
                                @click="showDelete(categoria.id)"
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
            header="Añadir categoria"
            :style="{ width: '35rem' }"
        >
            <div class="flex flex-col gap-4 mb-4">
                <label for="categoria" class="font-semibold w-24"
                    >Categoria</label
                >
                <InputText
                    id="categoria"
                    class="flex-auto"
                    autocomplete="off"
                    v-model="categoria.name"
                />
                <small v-if="categoria.errors.name" class="text-red-500"
                    >Este campo es obligatorio.</small
                >
            </div>
            <div class="flex flex-col gap-4 mb-4">
                <label for="code" class="font-semibold w-24">Codigo</label>
                <InputNumber
                    name="code"
                    autocomplete="off"
                    v-model="categoria.code"
                    fluid
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
                    @click="submit"
                    :loading="submitted"
                ></Button>
            </div>
        </Dialog>
        <Dialog
            v-model:visible="deleteCategoriaDialog"
            :style="{ width: '450px' }"
            header="Confirmar"
            :modal="true"
        >
            <div class="flex items-center gap-4">
                <i class="pi pi-exclamation-triangle !text-3xl" />
                <span
                    >¿Estás seguro de que deseas eliminar esta categoría?</span
                >
            </div>
            <template #footer>
                <Button
                    label="No"
                    icon="pi pi-times"
                    text
                    @click="deleteCategoriaDialog = false"
                    severity="secondary"
                    variant="text"
                />
                <Button
                    label="Si"
                    icon="pi pi-check"
                    @click="deleteCategoria"
                    severity="danger"
                    :loading="submitted"
                />
            </template>
        </Dialog>
    </AppLayout>
</template>

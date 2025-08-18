<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
</script>

<template>
    <AppLayout :title="'Prestaciones'">
        <div class="card flex flex-row items-center justify-between">
            <h3 class="mb-0">Prestaciones</h3>
            <Button icon="pi pi-plus" label="Crear Prestación"></Button>
        </div>
        <Card style="width: 25rem; overflow: hidden">
            <template #title>Prestacion 1</template>
            <template #subtitle>
                <Tag severity="info" class="mr-2" value="Cond. Faltas"></Tag>
                <Tag
                    severity="warn"
                    class="mr-2"
                    value="Cond. Antiguedad"
                ></Tag>
                <Tag
                    severity="success"
                    class="mr-2"
                    value="Cond. Eficiencia"
                ></Tag>
            </template>
            <template #content>
                <p class="m-0">
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                    Inventore sed consequuntur error repudiandae numquam
                    deserunt quisquam repellat libero asperiores earum nam
                    nobis, culpa ratione quam perferendis esse, cupiditate neque
                    quas!
                </p>
            </template>
            <template #footer>
                <div class="flex gap-4 mt-1">
                    <Button
                        label="Cancel"
                        severity="secondary"
                        variant="outlined"
                        class="w-full"
                    />
                    <Button label="Save" class="w-full" />
                </div>
            </template>
        </Card>
    </AppLayout>
</template>

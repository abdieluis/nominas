<script setup>
import { ref } from "vue";

import AppMenuItem from "./AppMenuItem.vue";

const model = ref([
    {
        label: "Inicio",
        items: [
            {
                label: "Pagina de inicio",
                icon: "pi pi-fw pi-home",
                to: "/dashboard",
            },
        ],
    },
    {
        label: "Nominas",
        items: [
            {
                label: "Asistencias",
                icon: "pi pi-fw pi-calendar",
                items: [
                    {
                        label: "Reporte de Ausentismos",
                        icon: "pi pi-circle",
                        to: "/catalogo/departamentos",
                    },
                    {
                        label: "Asistencia Semanal",
                        icon: "pi pi-circle",
                        to: "/catalogo/categorias-gastos",
                    },
                    {
                        label: "Registros de Asistencias",
                        icon: "pi pi-circle",
                        to: "/catalogo/ubicaciones",
                    },
                    {
                        label: "Registros de AsistenciasV",
                        icon: "pi pi-circle",
                        to: "/catalogo/cuentas-contables",
                    },
                    {
                        label: "Registros H.E.",
                        icon: "pi pi-circle",
                        to: "/catalogo/clases",
                    },
                ],
            },
            {
                label: "Catalogos",
                icon: "pi pi-fw pi-calendar",
                items: [
                    {
                        label: "Prestaciones",
                        icon: "pi pi-circle",
                        to: "/catalogos/prestaciones",
                    },
                ],
            },
            // {
            //     label: "Seguridad",
            //     icon: "pi pi-fw pi-shield",
            //     items: [
            //         {
            //             label: "Usuarios",
            //             icon: "pi pi-users",
            //             to: "/seguridad/usuarios",
            //         },
            //         {
            //             label: "Roles",
            //             icon: "pi pi-briefcase",
            //             to: "/seguridad/roles",
            //         },
            //         {
            //             label: "Permisos",
            //             icon: "pi pi-lock",
            //             to: "/seguridad/permisos",
            //         },
            //         {
            //             label: "Vistas",
            //             icon: "pi pi-eye",
            //             to: "/seguridad/vistas",
            //         },
            //     ],
            // },
        ],
    },
    // {
    //     label: "Portales",
    // },
]);
</script>

<template>
    <ul class="layout-menu">
        <template v-for="(item, i) in model" :key="item">
            <app-menu-item
                v-if="!item.separator"
                :item="item"
                :index="i"
            ></app-menu-item>
            <li v-if="item.separator" class="menu-separator"></li>
        </template>
        <!-- <a
            class="layout-menuitem-text"
            target="_blank"
            href="https://nominas.grupo-ortiz.site/"
        >
            <i class="pi pi-address-book mr-2"></i>
            <span class="layout-menuitem-text">Nominas</span>
        </a> -->
    </ul>
</template>

<style lang="scss" scoped></style>

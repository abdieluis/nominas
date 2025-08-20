<script setup>
import { ref } from "vue";
import { router } from "@inertiajs/vue3";
import AppMenuItem from "./AppMenuItem.vue";

const logout = () => {
    router.post(route("logout"));
};

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
                        to: "/assistence/absent",
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
                    {
                        label: "Plantas",
                        icon: "pi pi-circle",
                        to: "/catalogos/plantas",
                    },
                ],
            },
            {
                label: "Nominas",
                icon: "pi pi-money-bill",
                items: [
                    {
                        label: "Persepciones y Deducciones por Empleado",
                        icon: "pi pi-circle",
                        to: "/seguridad/usuarios",
                    },
                    {
                        label: "Clases de Empleado",
                        icon: "pi pi-circle",
                        to: "/seguridad/roles",
                    },
                    {
                        label: "Credito",
                        icon: "pi pi-circle",
                        to: "/seguridad/permisos",
                    },
                    {
                        label: "Movimientos de Credito",
                        icon: "pi pi-circle",
                        to: "/seguridad/vistas",
                    },
                    {
                        label: "Nominas Empleado",
                        icon: "pi pi-circle",
                        to: "/seguridad/roles",
                    },
                    {
                        label: "Recibos",
                        icon: "pi pi-circle",
                        to: "/seguridad/permisos",
                    },
                    {
                        label: "Tipos de Recibos",
                        icon: "pi pi-circle",
                        to: "/seguridad/vistas",
                    },
                    {
                        label: "Tipos de Asiento",
                        icon: "pi pi-circle",
                        to: "/seguridad/vistas",
                    },
                    {
                        label: "Cuentas",
                        icon: "pi pi-circle",
                        to: "/seguridad/roles",
                    },
                    {
                        label: "Fila Virtual",
                        icon: "pi pi-circle",
                        to: "/seguridad/permisos",
                    },
                    {
                        label: "Correos por Enviar",
                        icon: "pi pi-circle",
                        to: "/seguridad/vistas",
                    },
                ],
            },
        ],
    },
    // {
    //     label: "Portales",
    // },
    {
        label: 'Sesión',
        items: [
            {
                label: 'Cerrar sesión',
                icon: 'pi pi-fw pi-sign-out',
                command: () => {
                    logout();
                }
            }
        ]
    },
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

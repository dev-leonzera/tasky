<template>
    <Head title="Dados do cliente" />
    <AuthenticatedLayout>
        <template #header>
           Dados do Cliente
        </template>
        <label class="block text-sm">
            <span class="text-gray-700 dark:text-gray-400">Nome:</span>
            {{ cliente.nome }}             
        </label>

        <div class="mt-4 text-sm">
            <span class="text-gray-700 dark:text-gray-400">
                Tipo de cliente: 
            </span>
            {{ cliente.tipo }}
        </div>
        <div class="mt-4 text-sm">
            <span class="text-gray-700 dark:text-gray-400">
                Status:
            </span>
            {{ cliente.ativo }}
        </div>
        <div class="mt-4 text-sm">
            <span class="text-gray-700 dark:text-gray-400">
                Cliente Desde: 
            </span>
            {{ new Date(cliente.data_contrato).toLocaleDateString() }}
        </div>
    </AuthenticatedLayout>
</template>

<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import Pagination from '@/Components/Pagination.vue';
import { Head, Link } from '@inertiajs/vue3';

const props = defineProps({
  cliente: Object
});


</script>
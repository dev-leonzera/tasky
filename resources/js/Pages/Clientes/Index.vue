<template>
  <Head title="Clientes" />

  <AuthenticatedLayout>
    <template #header>
      Clientes
    </template>

    <div>
      <Link :href="route('dashboard')">
      <CustomButton>
        Cadastrar Cliente
      </CustomButton>
      </Link>

    </div>
    <div class="p-4 bg-white rounded-lg shadow-xs">
      <div class="inline-flex overflow-hidden mb-4 bg-white rounded-lg shadow-md">
      </div>

      <div class="w-full overflow-hidden rounded-lg shadow-xs">
        <div class="w-full overflow-x-auto">
          <table class="w-full whitespace-no-wrap">
            <thead>
              <tr
                class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                <th class="px-4 py-3">Nome</th>
                <th class="px-4 py-3">Tipo</th>
                <th class="px-4 py-3">Status</th>
                <th class="px-4 py-3">Cliente desde</th>
                <th class="px-4 py-3">Ações</th>
              </tr>
            </thead>
            <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
              <tr v-for="cliente in clientes" :key="cliente.id" class="text-gray-700 dark:text-gray-400 text-left">
                <td class="px-4 py-3">
                  <div class="flex items-center text-sm">
                    <div>
                      <p class="font-semibold">{{ cliente.nome }}</p>
                    </div>
                  </div>
                </td>
                <td class="px-4 py-3 text-sm">
                  {{ cliente.tipo }}
                </td>
                <td class="px-4 py-3 text-xs">
                  <span class="px-2 py-1 font-semibold leading-tight rounded-full"
                    :class="{ 'text-red-700 bg-red-100': cliente.ativo === 'Inativo', 'text-green-700 bg-green-100': cliente.ativo === 'Ativo' }">
                    {{ cliente.ativo }}
                  </span>
                </td>
                <td class="px-4 py-3 text-sm">
                  {{ new Date(cliente.data_contrato).toLocaleDateString() }}
                </td>
                <td class="px-4 py-3 text-left">
                  <div class="flex items-center space-x-4 text-sm">
                    <CustomReadButton :href="route('clientes.show', cliente.id)"></CustomReadButton>
                    <CustomEditButton :href="route('clientes.edit', cliente.id)"></CustomEditButton>
                    <CustomDeactivateButton></CustomDeactivateButton>
                    <CustomDeleteButton></CustomDeleteButton>
                  </div>
                  <!-- <CustomButton @click="deleteProject(cliente)">Delete</CustomButton> -->
                </td>
              </tr>
            </tbody>
          </table>
        </div>
        <!-- <div
          class="px-4 py-3 text-xs font-semibold tracking-wide text-gray-500 uppercase bg-gray-50 border-t sm:grid-cols-9">
        <pagination :links="users.links" />
        </div> -->
      </div>
    </div>
  </AuthenticatedLayout>
</template>
  
<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import Pagination from '@/Components/Pagination.vue';
import { Head, Link } from '@inertiajs/vue3';
import CustomButton from '@/Components/Buttons/CustomButton.vue';
import CustomReadButton from '@/Components/Buttons/CustomReadButton.vue';
import CustomEditButton from '@/Components/Buttons/CustomEditButton.vue';
import CustomDeactivateButton from '@/Components/Buttons/CustomDeactivateButton.vue';
import CustomDeleteButton from '@/Components/Buttons/CustomDeleteButton.vue';

const props = defineProps({
  clientes: Object
});


</script>
  
<template>
  <Head title="Dados do projeto" />
  <AuthenticatedLayout>
    <template #header>
      Dados do Projeto
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
    <div class="p-4 bg-white rounded-lg shadow-xs">
      <div class="inline-flex overflow-hidden mb-4 bg-white rounded-lg shadow-md">
      </div>

      <h1>Mensalidades</h1>
      <div class="w-full overflow-hidden rounded-lg shadow-xs">
        <div class="w-full overflow-x-auto">
          <table class="w-full whitespace-no-wrap">
            <thead>
              <tr
                class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                <th class="px-4 py-3">Mensalidade</th>
                <th class="px-4 py-3">Valor</th>
                <th class="px-4 py-3">Data do Vencimento</th>
                <th class="px-4 py-3">Pago?</th>
                <th class="px-4 py-3">Data de Pagamento</th>
                <th class="px-4 py-3">Ações</th>
              </tr>
            </thead>
            <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
              <tr v-for="mensalidade in cliente.mensalidades" :key="cliente.id"
                class="text-gray-700 dark:text-gray-400 text-left">
                <td class="px-4 py-3">
                  <div class="flex items-center text-sm">
                    <div>
                      <p class="font-semibold">{{ mensalidade.id }}</p>
                    </div>
                  </div>
                </td>
                <td class="px-4 py-3">
                  <div class="flex items-center text-sm">
                    <div>
                      <p class="font-semibold">{{ formatCurrency(mensalidade.valor) }}</p>
                    </div>
                  </div>
                </td>
                <td class="px-4 py-3">
                  <div class="flex items-center text-sm">
                    <div>
                      <p class="font-semibold">{{ new Date(mensalidade.data_vencimento).toLocaleDateString() }}</p>
                    </div>
                  </div>
                </td>
                <td class="px-4 py-3 text-xs">
                  <span class="px-2 py-1 font-semibold leading-tight rounded-full"
                    :class="{ 'text-red-700 bg-red-100': mensalidade.pago === 'Não', 'text-green-700 bg-green-100': mensalidade.pago === 'Sim' }">
                    {{ mensalidade.pago }}
                  </span>
                </td>
                <td class="px-4 py-3 text-sm">
                  <div v-if="mensalidade.data_pagamento != null">
                    {{ new Date(mensalidade.data_pagamento).toLocaleDateString() }}
                  </div>
                </td>
                <td class="px-4 py-3 text-left">
                  <div class="flex items-center space-x-4 text-sm">
                    <CustomPayButton></CustomPayButton>
                  </div>
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

<script>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import Pagination from '@/Components/Pagination.vue';
import CustomPayButton from '@/Components/Buttons/CustomPayButton.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';



export default {
  components: {
    Head,
    AuthenticatedLayout,
    CustomPayButton
  },
  props: {
    cliente: Object
  },
  methods: {
    formatCurrency(value) {
      if (typeof value === 'number') {
        return value.toLocaleString('pt-BR', {
          style: 'currency',
          currency: 'BRL',
        });
      }
      return value; // Caso o valor não seja um número, retorne sem formatação.
    },
  }
}


</script>
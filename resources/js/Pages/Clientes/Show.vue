<template>
  <Head title="Dados do cliente" />
  <AuthenticatedLayout>
    <template #header>

    </template>
    <div class="flex divide-x">
      <div class="px-20 py-3 bg-white rounded-lg dark:bg-gray-800 flex flex-col justify-around">
        <img src="https://upload.wikimedia.org/wikipedia/commons/4/41/Profile-720.png" alt="" srcset="" width="100">        
        <div class="text-lg font-bold w-max text-center">
          {{ cliente.nome }}
        </div>
      </div>
      <div class="flex-col w-full divide-y">
        <div class="px-5 py-3 bg-white rounded-lg dark:bg-gray-800">
          <h1 class="text-2xl font-semibold">Dados do Cliente</h1>
          <div class="mt-5 flex flex-wrap gap-9">        
            <div class="text-base">
              <span class="text-gray-700 dark:text-gray-400">
                Email:
              </span>
              {{ cliente.email }}
            </div>
            <div class="text-base">
              <span class="text-gray-700 dark:text-gray-400">
                Telefone:
              </span>
              (84) 99999-9999
            </div>
            
          </div>
        </div>
        <div class="px-5 py-3 bg-white rounded-lg dark:bg-gray-800">
          <h1 class="text-2xl font-semibold">Dados do Contrato</h1>
          <div class="flex mt-5 gap-9">
            <div class="text-base">
              <span class="text-gray-700 dark:text-gray-400">
                Status:
              </span>
              {{ cliente.ativo }}
            </div>
            <div class="text-base">
              <span class="text-gray-700 dark:text-gray-400">
                Cliente desde:
              </span>
              {{ new Date(cliente.data_contrato).toLocaleDateString() }}
            </div>
            <div class="text-base">
              <span class="text-gray-700 dark:text-gray-400">
                Tipo de cliente:
              </span>
              {{ cliente.tipo }}
            </div>
          </div>
        </div>
      </div>


    </div>
    <div class="p-1 rounded-lg shadow-xs mt-5">
      <div v-show="cliente.mensalidades.length != 0">
          <h1 class="text-2xl">Mensalidades</h1>
          <div class="w-full overflow-hidden rounded-lg shadow-xs mt-5">
            <div class="w-full overflow-x-auto">
              <table class="w-full whitespace-no-wrap">
                <thead>
                  <tr
                    class="text-xs font-semibold tracking-wide text-left bg-white  uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
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
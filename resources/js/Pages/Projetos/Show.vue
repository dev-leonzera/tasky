<template>
  <Head title="Dados do projeto" />
  <AuthenticatedLayout>
    <template #header>
      <div class="mb-4">
        <CustomBackButton :href="route('projetos.index')"></CustomBackButton>
      </div>
    </template>
    <div class="flex divide-x">
      <div class="px-20 py-3 bg-white rounded-lg dark:bg-gray-800 flex flex-col justify-around">
        <!-- <img src="https://upload.wikimedia.org/wikipedia/commons/4/41/Profile-720.png" alt="" srcset="" width="100"> -->
        <div class="text-lg font-bold w-max text-center">
          {{ projeto.titulo }}
        </div>
      </div>
      <div class="flex-col w-full divide-y">
        <div class="px-5 py-3 bg-white rounded-lg dark:bg-gray-800">
          <h1 class="text-2xl font-semibold">Dados do Projeto</h1>
          <div class="mt-5 flex flex-wrap gap-9">
            <div class="text-base">
              <span class="text-gray-700 dark:text-gray-400">
                Nome do cliente:
              </span>
              {{ projeto.clientes.nome }}
            </div>
            <div class="text-base">
              <span class="text-gray-700 dark:text-gray-400">
                Orçamento:
              </span>
              {{ formatCurrency(projeto.orcamento) }}
            </div>
            <div class="text-base">
              <span class="text-gray-700 dark:text-gray-400">
                Data de Início:
              </span>
              {{ new Date(projeto.data_inicio).toLocaleDateString() }}
            </div>
            <div class="text-base">
              <span class="text-gray-700 dark:text-gray-400">
                Data de Entrega:
              </span>
              {{ new Date(projeto.data_entrega).toLocaleDateString() }}
            </div>

          </div>
        </div>
        <div class="px-5 py-3 bg-white rounded-lg dark:bg-gray-800">
          <h1 class="text-2xl font-semibold">Descrição do Projeto</h1>
          <div class="flex mt-5 gap-9">
            <div class="text-base">
              <p>
                {{ projeto.descricao }}
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>    
  </AuthenticatedLayout>
</template>

<script>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import CustomPayButton from '@/Components/Buttons/CustomPayButton.vue';
import CustomBackButton from '@/Components/Buttons/CustomBackButton.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';



export default {
  components: {
    Head,
    AuthenticatedLayout,
    CustomPayButton,
    CustomBackButton,
  },
  props: {
    projeto: Object
  },
  methods: {
    formatCurrency(value) {
      if (typeof value === 'number') {
        return value.toLocaleString('pt-BR', {
          style: 'currency',
          currency: 'BRL',
        });
      }
      return value;
    },
  }
}


</script>
<template>
  <Head title="Projetos" />

  <AuthenticatedLayout>
    <template #header>
      Projetos
    </template>

    <div>
      <Link :href="route('projetos.create')">
      <CustomButton>
        Cadastrar Projeto
      </CustomButton>
      </Link>

    </div>
    <div class="p-1 rounded-lg shadow-xs">
      <div class="inline-flex overflow-hidden mb-4 rounded-lg shadow-md">
      </div>

      <div class="w-full overflow-hidden rounded-lg shadow-xs">
        <div class="w-full overflow-x-auto">
          <table class="w-full whitespace-no-wrap">
            <thead>
              <tr
                class="bg-white text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                <th class="px-4 py-3">Título</th>
                <th class="px-4 py-3">Nome do Cliente</th>
                <th class="px-4 py-3">Orçamento</th>
                <th class="px-4 py-3">Início</th>
                <th class="px-4 py-3">Data de Entrega</th>
                <th class="px-4 py-3">Ações</th>
              </tr>
            </thead>
            <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
              <tr v-for="projeto in projetos.data" :key="projeto.id" class="text-gray-700 dark:text-gray-400 text-left">
                <td class="px-4 py-3">
                  <div class="flex items-center text-sm">
                    <div>
                      <p class="font-semibold">{{ projeto.titulo }}</p>                      
                    </div>
                  </div>
                </td>
                <td class="px-4 py-3">
                  <div class="flex items-center text-sm">
                    <div>
                      <p>{{ projeto.cliente }}</p>
                    </div>
                  </div>
                </td>
                <td class="px-4 py-3 text-sm">
                  {{ formatCurrency(projeto.orcamento) }}
                </td>
                <td class="px-4 py-3 text-sm">
                  {{ new Date(projeto.data_inicio).toLocaleDateString() }}
                </td>
                <td class="px-4 py-3 text-sm">
                  {{ new Date(projeto.data_entrega).toLocaleDateString() }}
                </td>
                
                
                <td class="px-4 py-3 text-left">
                  <div class="flex items-center space-x-4 text-sm">
                    <CustomReadButton :href="route('projetos.show', projeto.id)"></CustomReadButton>
                    <CustomEditButton :href="route('projetos.edit', projeto.id)"></CustomEditButton>                    
                    <CustomDeleteButton @click="deleteClient(projeto)"></CustomDeleteButton>
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
import { Head, Link, useForm } from '@inertiajs/vue3';
import CustomButton from '@/Components/Buttons/CustomButton.vue';
import CustomReadButton from '@/Components/Buttons/CustomReadButton.vue';
import CustomEditButton from '@/Components/Buttons/CustomEditButton.vue';
import CustomDeactivateButton from '@/Components/Buttons/CustomDeactivateButton.vue';
import CustomDeleteButton from '@/Components/Buttons/CustomDeleteButton.vue';

const loadPage = (pageUrl) => {
  if (pageUrl) {
    // Use o URL da página anterior ou seguinte para navegar
    axios.get(pageUrl).then(response => {
      // Atualize os dados do projeto e informações de paginação
      $page.projetos = response.data;      
    }).catch(error => {
      console.error('Erro ao buscar dados:', error);
    });
  }
};

 export default {
  components: {
    AuthenticatedLayout,
    Head,
    Link,
    CustomDeleteButton,
    CustomDeactivateButton,
    CustomReadButton,
    CustomEditButton,
    CustomButton
  },
  props: {
    projetos: Object
  },
  data(){
    return{
      form: useForm({}),
      formD: useForm({
        method: '_patch'
      }),
    };
  },
  methods: {
    deleteClient(item){
      this.form.delete(route('projetos.destroy', item.id),{
        preserveScroll: true,
        onSuccess: () => {},
        onError: () => {},
        onFinish: () => {},
      });
    },

    formatCurrency(value) {
      if (typeof value === 'number') {
        return value.toLocaleString('pt-BR', {
          style: 'currency',
          currency: 'BRL',
        });
      }
      return value; // Caso o valor não seja um número, retorne sem formatação.
    },
  },
 };

</script>
  
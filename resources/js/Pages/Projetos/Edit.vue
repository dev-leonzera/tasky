<template>
    <Head title="Editar projeto" />
    <AuthenticatedLayout>
        <template #header>
            Editar projeto
        </template>
        <form @submit.prevent="submit">
            <div class="mt-4">
                <label class="block text-sm">
                    <span class="text-gray-700 dark:text-gray-400">Título do projeto</span>
                    <input
                        class="block mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                        placeholder="Jane Doe" v-model="form.titulo">
                </label>
            </div>


            <div class="mt-4">
                <label class="block mt-4 text-sm">
                    <span class="text-gray-700 dark:text-gray-400">
                        Descrição
                    </span>
                </label>
                <textarea name="descricao" id="descricao" v-model="form.descricao"></textarea>
            </div>

            <div class="mt-4">
                <label class="block mt-4 text-sm">
                    <span class="text-gray-700 dark:text-gray-400">
                        Valor do orçamento
                    </span>
                </label>
                <input type="number" name="orcamento" id="orcamento" v-model="form.orcamento">
            </div>

            <div class="mt-4">
                <label class="block mt-4 text-sm">
                    <span class="text-gray-700 dark:text-gray-400">
                        Data de início
                    </span>
                </label>
                <input type="date" name="data_inicio" id="data_inicio" v-model="form.data_inicio">
            </div>

            <div class="mt-4">
                <label class="block mt-4 text-sm">
                    <span class="text-gray-700 dark:text-gray-400">
                        Data de entrega
                    </span>
                </label>
                <input type="date" name="data_entrega" id="data_entrega" v-model="form.data_entrega">
            </div>

            <div class="flex mt-6 text-sm">
                <CustomButton :type="submit">Salvar</CustomButton>
            </div>
        </form>
    </AuthenticatedLayout>
</template>

<script>
import { Head, useForm } from '@inertiajs/vue3';
//
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import CustomButton from '@/Components/Buttons/CustomButton.vue';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';

export default {
    components: {
        AuthenticatedLayout,
        Head,
        CustomButton
    },
    props: {
        projeto: Object
    },
    data() {
        return {
            form: useForm({
                titulo: this.projeto.titulo,
                descricao: this.projeto.descricao,
                orcamento: this.projeto.orcamento,
                data_inicio: this.projeto.data_inicio,
                data_entrega: this.projeto.data_entrega,
                _method: 'put',
            })
        }
    },
    methods: {
        submit() {
            this.form.post(route('projetos.update', this.projeto.id), this.form, {
                preserveScroll: true,
                forceFormData: true,
                onSuccess: () => this.form.reset(),
                onError: () => { }
            })
        }
    }
}
</script>
<template>
    <Head title="Cadastrar novo cliente" />
    <AuthenticatedLayout>
        <template #header>
           Cadastrar Novo Cliente
        </template>
        <form @submit.prevent="submit">
            <label class="block text-sm">
                <span class="text-gray-700 dark:text-gray-400">Nome</span>
                <input
                    class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                    placeholder="Jane Doe" v-model="form.nome">                
            </label>
            <label class="block text-sm mt-4">
                <span class="text-gray-700 dark:text-gray-400">Email</span>
                <input
                    class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                    placeholder="Jane Doe" v-model="form.email">                
            </label>
    
            <div class="mt-4 text-sm">
                <span class="text-gray-700 dark:text-gray-400">
                    Tipo de cliente
                </span>
                <div class="mt-2">
                    <label class="inline-flex items-center text-gray-600 dark:text-gray-400">
                        <input type="radio"
                            class="text-purple-600 form-radio focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"
                            name="accountType" value="pf" v-model="form.tipo">
                        <span class="ml-2">Pessoa Física</span>
                    </label>
                    <label class="inline-flex items-center ml-6 text-gray-600 dark:text-gray-400">
                        <input type="radio"
                            class="text-purple-600 form-radio focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"
                            name="accountType" value="pj" v-model="form.tipo">
                        <span class="ml-2">Pessoa Jurídica</span>
                    </label>
                </div>
            </div>
            <div class="mt-4 text-sm">
                <span class="text-gray-700 dark:text-gray-400">
                    Cliente vai ser mensalista?
                </span>
                <div class="mt-2">
                    <label class="inline-flex items-center text-gray-600 dark:text-gray-400">
                        <input type="radio"
                            class="text-purple-600 form-radio focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"
                            name="mensalista" value="s" v-model="form.mensalista">
                        <span class="ml-2">Sim</span>
                    </label>
                    <label class="inline-flex items-center ml-6 text-gray-600 dark:text-gray-400">
                        <input type="radio"
                            class="text-purple-600 form-radio focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"
                            name="mensalista" value="n" v-model="form.mensalista">
                        <span class="ml-2">Não</span>
                    </label>
                </div>
            </div>
    
            <label class="block mt-4 text-sm">
                <span class="text-gray-700 dark:text-gray-400">
                    Dia do Vencimento
                </span>
                <input type="number" name="diaVencimento" id="diaVencimento" class="ml-6" v-model="form.dia_vencimento">
            </label>
    
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

export default{
    components: {
        AuthenticatedLayout,
        Head,
        CustomButton
    },
    data(){
        return {
            form: useForm({
                nome: "",
                email: "",
                tipo: "",
                mensalista: "",
                dia_vencimento: 0,
            })
        }
    },
    methods: {
        submit(){
            this.form.post(route('clientes.store'), {
                preserveScroll: true,
                onSuccess: () => this.form.reset(),
                onError: () => {}
            })
        }
    }
}
</script>
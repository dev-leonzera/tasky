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
                    placeholder="Jane Doe">
            </label>
    
            <div class="mt-4 text-sm">
                <span class="text-gray-700 dark:text-gray-400">
                    Tipo de cliente
                </span>
                <div class="mt-2">
                    <label class="inline-flex items-center text-gray-600 dark:text-gray-400">
                        <input type="radio"
                            class="text-purple-600 form-radio focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"
                            name="accountType" value="personal">
                        <span class="ml-2">Pessoa Física</span>
                    </label>
                    <label class="inline-flex items-center ml-6 text-gray-600 dark:text-gray-400">
                        <input type="radio"
                            class="text-purple-600 form-radio focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"
                            name="accountType" value="busines">
                        <span class="ml-2">Pessoa Jurídica</span>
                    </label>
                </div>
            </div>
    
            <label class="block mt-4 text-sm">
                <span class="text-gray-700 dark:text-gray-400">
                    Contrato
                </span>
                <input type="file" name="documento" id="documento" class="ml-6">
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
                tipo: "",
                documento: "",
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
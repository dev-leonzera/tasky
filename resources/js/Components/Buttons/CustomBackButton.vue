<template>
    <Link :href="href">
        <button class="rounded-lg border border-transparent bg-blue-600 px-4 py-2 text-center text-sm font-medium leading-5 text-white transition-colors duration-150 hover:bg-blue-700 focus:outline-none focus:ring active:bg-blue-600"
            aria-label="Edit">
            Voltar
            <slot />
        </button>
    </Link>
</template>
  
<script setup>
import { Link } from '@inertiajs/vue3';
defineProps(['href']);
</script>
  
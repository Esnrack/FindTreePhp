<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, router } from '@inertiajs/vue3';

const props = defineProps({
    arvores: {
        type: Array,
    },
    ifArvores: {
        type: Boolean,
    },
});

const renderArvore = (arvore) => {
    router.visit(`/arvores/${arvore.id}`);
};
</script>

<template>
    <Head title="Árvores" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Arvores</h2>
        </template>

        <div class="py-12">
            <div v-if="ifArvores" class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div v-for="a in arvores" class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg m-4">
                    <div class="p-6 text-gray-900 dark:text-gray-100 cursor-pointer" @click="renderArvore(a)">
                        {{ a.nome_arvore }}
                    </div>
                </div>
            </div>
            <div v-else class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg m-4">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        Nenhuma árvore cadastrada.
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<style>
    .uploading-image{
        display:flex;
   }
</style>
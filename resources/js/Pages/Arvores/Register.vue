<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

const form = useForm({
    name: '',
    description: '',
    image: '',
});

const submit = () => {
    form.post(route('campaigns.store'), {
        onFinish: () => form.reset(),
    });
};
</script>

<template>
    <GuestLayout>
        <Head title="Cadastrar árvore" />

        <form @submit.prevent="submit">
            <div>
                <InputLabel for="nome_arvore" value="Nome" />

                <TextInput
                    id="nome_arvore"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.nome_arvore"
                    required
                    autofocus
                    autocomplete="nome_arvore"
                />

                <InputError class="mt-2" :message="form.errors.nome_arvore" />
            </div>

            <div class="mt-4">
                <InputLabel for="descricao_botanica" value="Descriçãõ Botânica" />

                <TextInput
                    id="descricao_botanica"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.descricao_botanica"
                    autocomplete="descricao_botanica"
                />

                <InputError class="mt-2" :message="form.errors.descricao_botanica" />
            </div>

            <div class="mt-4">
                <InputLabel for="biologia_reprodutiva" value="Biologia Reprodutiva" />

                <TextInput
                    id="biologia_reprodutiva"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.biologia_reprodutiva"
                    autocomplete="biologia_reprodutiva"
                />

                <InputError class="mt-2" :message="form.errors.biologia_reprodutiva" />
            </div>

            <div class="flex items-center justify-end mt-4">
                <Link
                    :href="route('campaigns.list')"
                    class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800"
                >
                    Back to Campaigns
                </Link>

                <PrimaryButton class="ms-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    Register Campaign
                </PrimaryButton>
            </div>
        </form>
    </GuestLayout>
</template>

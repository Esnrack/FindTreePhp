<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import { ref } from 'vue';

const props = defineProps({
    arvore: {
        type: Object,
    }
});

const form = useForm({
    nome_arvore: props.arvore.nome_arvore,
    descricao_botanica: props.arvore.descricao_botanica,
    biologia_reprodutiva: props.arvore.biologia_reprodutiva,
    frutificacao: props.arvore.frutificacao,
    dispersao: props.arvore.dispersao,
    ocorrencia_natural: props.arvore.ocorrencia_natural,
    mapa: props.arvore.mapa,
    aspectos_ecologicos: props.arvore.aspectos_ecologicos,
    regeneracao_natural: props.arvore.regeneracao_natural,
    aproveitamento: props.arvore.aproveitamento,
    alimentacao: props.arvore.alimentacao,
    dados_nutricionais: props.arvore.dados_nutricionais,
    formas_consumo: props.arvore.formas_consumo,
    biotec_energ: props.arvore.biotec_energ,
    composicao: props.arvore.composicao,
    poten_bioprodutos: props.arvore.poten_bioprodutos,
    bioatividade: props.arvore.bioatividade,
    paisagismo: props.arvore.paisagismo,
    cultivo_viveiro: props.arvore.cultivo_viveiro,
    colheita_benef_semente: props.arvore.colheita_benef_semente,
    producao_mudas: props.arvore.producao_mudas,
    transplante: props.arvore.transplante,
    cuidados_especiais: props.arvore.cuidados_especiais,
    agua: props.arvore.agua,
    solos: props.arvore.solos,
    imagens: props.arvore.imagens,
    id: props.arvore.id
});

const deleteArvore = (id) => {
      if (confirm('Tem certeza que deseja remover a árvore?')) {
        axios.delete(`/arvores/destroy/${id}`)
          .then(response => {
            window.location.href = '/arvores/show';
          })
          .catch(error => {
            console.error('Erro ao excluir a árvore:', error);
          });
      }
    };

const imageFile = ref();

const uploadImage = (e) => {
    const image = e.target.files[0];
    if (image) {
        const reader = new FileReader();
        reader.readAsDataURL(image);
        reader.onload = (event) => {
            form.mapa = event.target.result;
            imageFile.value = image;
        };
    }
};

const imageFiles = ref([]);

const uploadImages = (e) => {
    const files = Array.from(e.target.files);
    const imagePromises = files.map((file) => {
        return new Promise((resolve) => {
            const reader = new FileReader();
            reader.readAsDataURL(file);
            reader.onload = (event) => {
                resolve({
                    base64: event.target.result,
                    file: file,
                });
            };
        });
    });

    Promise.all(imagePromises).then((images) => {
        form.imagens = [
            ...form.imagens,
            ...images.map((img) => ({
                imagem: img.base64,
                descricao: img.file.name,
            })),
        ];

        imageFiles.value = [
            ...imageFiles.value,
            ...images.map((img) => img.file),
        ];
    });
};

const submit = () => {
    form.post(route('arvores.update'), {
        onFinish: () => {
            form.reset();
            imageFile.value = null;
        },
    });
};
</script>

<template>
    <GuestLayout>
        <Head title="Editar árvore" />

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
                <InputLabel for="descricao_botanica" value="Descrição Botânica" />

                <TextInput
                    id="descricao_botanica"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.descricao_botanica"
                    required
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
                    required
                    autocomplete="biologia_reprodutiva"
                />

                <InputError class="mt-2" :message="form.errors.biologia_reprodutiva" />
            </div>

            <div class="mt-4">
                <InputLabel for="frutificacao" value="Frutificação" />

                <TextInput
                    id="frutificacao"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.frutificacao"
                    required
                    autocomplete="frutificacao"
                />

                <InputError class="mt-2" :message="form.errors.frutificacao" />
            </div>

            <div class="mt-4">
                <InputLabel for="dispersao" value="Dispersão" />

                <TextInput
                    id="dispersao"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.dispersao"
                    required
                    autocomplete="dispersao"
                />

                <InputError class="mt-2" :message="form.errors.dispersao" />
            </div>

            <div class="mt-4">
                <InputLabel for="ocorrencia_natural" value="Ocorrência Natural" />

                <TextInput
                    id="ocorrencia_natural"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.ocorrencia_natural"
                    required
                    autocomplete="ocorrencia_natural"
                />

                <InputError class="mt-2" :message="form.errors.ocorrencia_natural" />
            </div>

            <div class="mt-4">
                <InputLabel for="mapa" value="Mapa" />

                <input
                    id="mapa"
                    type="file"
                    class="mt-1 block w-full"
                    @change="uploadImage"
                    :required="form.imagens.length == 0"
                    accept="image/*"
                />

                <img v-if="form.mapa"
                    :src="form.mapa" 
                    alt="Preview" 
                    class="w-20 h-20 p-4 object-cover rounded"
                />

                <InputError class="mt-2" :message="form.errors.mapa" />
            </div>

            <div class="mt-4">
                <InputLabel for="aspectos_ecologicos" value="Aspectos Ecológicos" />

                <TextInput
                    id="aspectos_ecologicos"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.aspectos_ecologicos"
                    required
                    autocomplete="aspectos_ecologicos"
                />

                <InputError class="mt-2" :message="form.errors.aspectos_ecologicos" />
            </div>

            <div class="mt-4">
                <InputLabel for="regeneracao_natural" value="Regeneração Natural" />

                <TextInput
                    id="regeneracao_natural"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.regeneracao_natural"
                    required
                    autocomplete="regeneracao_natural"
                />

                <InputError class="mt-2" :message="form.errors.regeneracao_natural" />
            </div>

            <div class="mt-4">
                <InputLabel for="aproveitamento" value="Aproveitamento" />

                <TextInput
                    id="aproveitamento"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.aproveitamento"
                    required
                    autocomplete="aproveitamento"
                />

                <InputError class="mt-2" :message="form.errors.aproveitamento" />
            </div>

            <div class="mt-4">
                <InputLabel for="alimentacao" value="Alimentação" />

                <TextInput
                    id="alimentacao"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.alimentacao"
                    required
                    autocomplete="alimentacao"
                />

                <InputError class="mt-2" :message="form.errors.alimentacao" />
            </div>

            <div class="mt-4">
                <InputLabel for="dados_nutricionais" value="Dados Nutricionais" />

                <TextInput
                    id="dados_nutricionais"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.dados_nutricionais"
                    required
                    autocomplete="dados_nutricionais"
                />

                <InputError class="mt-2" :message="form.errors.dados_nutricionais" />
            </div>

            <div class="mt-4">
                <InputLabel for="formas_consumo" value="Formas de consumo" />

                <TextInput
                    id="formas_consumo"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.formas_consumo"
                    required
                    autocomplete="formas_consumo"
                />

                <InputError class="mt-2" :message="form.errors.formas_consumo" />
            </div>

            <div class="mt-4">
                <InputLabel for="biotec_energ" value="Biotecnológico energético" />

                <TextInput
                    id="biotec_energ"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.biotec_energ"
                    required
                    autocomplete="biotec_energ"
                />

                <InputError class="mt-2" :message="form.errors.biotec_energ" />
            </div>

            <div class="mt-4">
                <InputLabel for="composicao" value="Composição" />

                <TextInput
                    id="composicao"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.composicao"
                    required
                    autocomplete="composicao"
                />

                <InputError class="mt-2" :message="form.errors.composicao" />
            </div>

            <div class="mt-4">
                <InputLabel for="poten_bioprodutos" value="Potencias bioprodutos" />

                <TextInput
                    id="poten_bioprodutos"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.poten_bioprodutos"
                    required
                    autocomplete="poten_bioprodutos"
                />

                <InputError class="mt-2" :message="form.errors.poten_bioprodutos" />
            </div>

            <div class="mt-4">
                <InputLabel for="bioatividade" value="Bioatividade" />

                <TextInput
                    id="bioatividade"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.bioatividade"
                    required
                    autocomplete="bioatividade"
                />

                <InputError class="mt-2" :message="form.errors.bioatividade" />
            </div>

            <div class="mt-4">
                <InputLabel for="paisagismo" value="Paisagismo" />

                <TextInput
                    id="paisagismo"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.paisagismo"
                    required
                    autocomplete="paisagismo"
                />

                <InputError class="mt-2" :message="form.errors.paisagismo" />
            </div>

            <div class="mt-4">
                <InputLabel for="cultivo_viveiro" value="Cultivo em viveiros" />

                <TextInput
                    id="cultivo_viveiro"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.cultivo_viveiro"
                    required
                    autocomplete="cultivo_viveiro"
                />

                <InputError class="mt-2" :message="form.errors.cultivo_viveiro" />
            </div>

            <div class="mt-4">
                <InputLabel for="colheita_benef_semente" value="Colheita e beneficiamento de sementes" />

                <TextInput
                    id="colheita_benef_semente"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.colheita_benef_semente"
                    required
                    autocomplete="colheita_benef_semente"
                />

                <InputError class="mt-2" :message="form.errors.colheita_benef_semente" />
            </div>

            <div class="mt-4">
                <InputLabel for="producao_mudas" value="Produção de mudas" />

                <TextInput
                    id="producao_mudas"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.producao_mudas"
                    required
                    autocomplete="producao_mudas"
                />

                <InputError class="mt-2" :message="form.errors.producao_mudas" />
            </div>

            <div class="mt-4">
                <InputLabel for="transplante" value="Transplante" />

                <TextInput
                    id="transplante"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.transplante"
                    required
                    autocomplete="transplante"
                />

                <InputError class="mt-2" :message="form.errors.transplante" />
            </div>

            <div class="mt-4">
                <InputLabel for="cuidados_especiais" value="Cuidados Especiais" />

                <TextInput
                    id="cuidados_especiais"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.cuidados_especiais"
                    required
                    autocomplete="cuidados_especiais"
                />

                <InputError class="mt-2" :message="form.errors.cuidados_especiais" />
            </div>

            <div class="mt-4">
                <InputLabel for="agua" value="Água" />

                <TextInput
                    id="agua"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.agua"
                    required
                    autocomplete="agua"
                />

                <InputError class="mt-2" :message="form.errors.agua" />
            </div>

            <div class="mt-4">
                <InputLabel for="solos" value="Solos" />

                <TextInput
                    id="solos"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.solos"
                    required
                    autocomplete="solos"
                />

                <InputError class="mt-2" :message="form.errors.solos" />
            </div>

            <div class="mt-4">
                <InputLabel for="imagens" value="Imagens" />

                <input
                    ref="imageInput"
                    id="imagens"
                    type="file"
                    class="mt-1 block w-full"
                    @change="uploadImages"
                    accept="image/*"
                    multiple
                />

                <div v-if="form.imagens.length > 0" class="mt-2">
                    <p>Imagens selecionadas: {{ form.imagens.length }}</p>
                    <button 
                        type="button" 
                        @click="clearImages" 
                        class="text-red-500 hover:underline"
                    >
                        Limpar Imagens
                    </button>

                    <!-- Listando imagens -->
                    <ul class="mt-4">
                        <li 
                            v-for="(imagem, index) in form.imagens" 
                            :key="index" 
                            class="flex items-center gap-4 py-2"
                        >
                            <!-- Visualização da imagem -->
                            <img 
                                :src="imagem.imagem" 
                                alt="Preview" 
                                class="w-16 h-16 object-cover rounded"
                            />

                            <!-- Campo para editar a descrição -->
                            <div>
                                <input 
                                    v-model="form.imagens[index].descricao" 
                                    type="text" 
                                    class="border rounded px-2 py-1 w-full"
                                    placeholder="Descrição da imagem"
                                />
                            </div>

                            <!-- Botão para remover a imagem -->
                            <button 
                                @click="removeImage(index)" 
                                class="text-red-500 hover:underline"
                            >
                                Remover
                            </button>
                        </li>
                    </ul>
                </div>

                <InputError class="mt-2" :message="form.errors.imagens" />
            </div>

            <div class="flex items-center justify-end mt-4">
                <Link
                    :href="route('arvores.list')"
                    class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800"
                >
                    Listar árvores
                </Link>

                <button @click="deleteArvore(arvore.id)" class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">
                    Remover árvore
                </button>

                <PrimaryButton 
                    class="ms-4" 
                    :class="{ 'opacity-25': form.processing }" 
                    :disabled="form.processing"
                >
                    Atualizar Árvore
                </PrimaryButton>
            </div>
        </form>
    </GuestLayout>
</template>
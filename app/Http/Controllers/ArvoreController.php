<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Arvore;
use App\Models\ImagensArvore;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\Rules;
use Inertia\Inertia;
use Inertia\Response;

class ArvoreController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): Response
    {
        return Inertia::render('Arvore/Register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $arvore = Arvore::create([
            'nome_arvore' => $request->nome_arvore,
            'descricao_botanica' => $request->descricao_botanica,
            'biologia_reprodutiva' => $request->biologia_reprodutiva,
            'frutificacao' => $request->frutificacao,
            'dispersao' => $request->dispersao,
            'ocorrencia_natural' => $request->ocorrencia_natural,
            'mapa' => $request->mapa,
            'aspectos_ecologicos' => $request->aspectos_ecologicos,
            'regeneracao_natural' => $request->regeneracao_natural,
            'aproveitamento' => $request->aproveitamento,
            'alimentacao' => $request->alimentacao,
            'dados_nutricionais' => $request->dados_nutricionais,
            'formas_consumo' => $request->formas_consumo,
            'biotec_energ' => $request->biotec_energ,
            'composicao' => $request->composicao,
            'poten_bioprodutos' => $request->poten_bioprodutos,
            'bioatividade' => $request->bioatividade,
            'paisagismo' => $request->paisagismo,
            'cultivo_viveiro' => $request->cultivo_viveiro,
            'colheita_benef_semente' => $request->colheita_benef_semente,
            'producao_mudas' => $request->producao_mudas,
            'transplante' => $request->transplante,
            'cuidados_especiais' => $request->cuidados_especiais,
            'agua' => $request->agua,
            'solos' => $request->solos
        ]);

        if ($request->has('imagens') && is_array($request->imagens)) {
            foreach ($request->imagens as $imagemData) {
                ImagensArvore::create([
                    'arvore_id' => $arvore->id,
                    'imagem' => $imagemData['imagem'],
                    'descricao' => $imagemData['descricao'] ?? $arvore->nome_arvore
                ]);
            }
        }

        return redirect(route('arvores.list', absolute: false));
    }

    public function update(Request $request): RedirectResponse
    {
        $arvore = Arvore::where('id', '=', $request->id)->update([
            'nome_arvore' => $request->nome_arvore,
            'descricao_botanica' => $request->descricao_botanica,
            'biologia_reprodutiva' => $request->biologia_reprodutiva,
            'frutificacao' => $request->frutificacao,
            'dispersao' => $request->dispersao,
            'ocorrencia_natural' => $request->ocorrencia_natural,
            'mapa' => $request->mapa,
            'aspectos_ecologicos' => $request->aspectos_ecologicos,
            'regeneracao_natural' => $request->regeneracao_natural,
            'aproveitamento' => $request->aproveitamento,
            'alimentacao' => $request->alimentacao,
            'dados_nutricionais' => $request->dados_nutricionais,
            'formas_consumo' => $request->formas_consumo,
            'biotec_energ' => $request->biotec_energ,
            'composicao' => $request->composicao,
            'poten_bioprodutos' => $request->poten_bioprodutos,
            'bioatividade' => $request->bioatividade,
            'paisagismo' => $request->paisagismo,
            'cultivo_viveiro' => $request->cultivo_viveiro,
            'colheita_benef_semente' => $request->colheita_benef_semente,
            'producao_mudas' => $request->producao_mudas,
            'transplante' => $request->transplante,
            'cuidados_especiais' => $request->cuidados_especiais,
            'agua' => $request->agua,
            'solos' => $request->solos
        ]);

        if ($request->has('imagens') && is_array($request->imagens)) {
            foreach ($request->imagens as $imagemData) {
                $imagem = ImagensArvore::where('arvore_id', $request->id)
                           ->where('id', $imagemData['id'])
                           ->first();
                if ($imagem) {
                    $imagem->update([
                        'imagem' => $imagemData['imagem'],
                        'descricao' => $imagemData['descricao']
                    ]);
                } else {
                    ImagensArvore::create([
                        'arvore_id' => $request->id,
                        'imagem' => $imagemData['imagem'],
                        'descricao' => $imagemData['descricao']
                    ]);
                }
            }
        }

        return redirect(route('arvores.list', absolute: false));
    }
}

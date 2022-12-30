<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use View;
use File;
use DirectoryIterator;
use DateTime;

use App\Models\FolhaObservacao;
use App\Models\FolhaElemento;
use App\Models\processo;
use App\Models\maquina;
use App\Models\Operador;
use App\Models\MateriaPrima;
use App\Models\setor;
use App\Models\Tarefa;
use App\Models\Procedimento;
use App\Models\Pop;

class FerramentasController extends Controller
{
    
    public function _matrizbcg(){
        $pagina = 'Matriz BCG';
        $title = 'Ponto de Controle';
        $texto = 'A Matriz BCG, como o próprio nome diz, é uma matriz 
                                    2 por 2 para análises de portifólio de produtos e unidades 
                                    de negócios, tendo como base o ciclo de vida do produto. 
                                    Foi criada nos anos 70 por Bruce Henderson para a empresa americana 
                                    Boston Consulting Group, e tem como principal objetivo auxiliar o 
                                    processo de tomada de decis&atilde;o dos gestores de marketing e vendas.';

        View::share('title', $title);
        View::share('pagina', $pagina);
        View::share('texto', $texto); 

        return view('ferramentas.matrizbcg');
    }

    public function _fluxograma(){
        $pagina = 'Fluxograma';
        $title = 'Ponto de Controle';
        $texto = 'O Fluxograma pode ser entendido como uma representação esquemática de um processo ou algoritmo, muitas vezes feito através de gráficos que ilustram de forma descomplicada a transição de informações entre os elementos que o compõem, ou seja, é a sequência operacional do desenvolvimento de um processo, o qual caracteriza: o trabalho que está sendo realizado, o tempo necessário para sua realização, a distãncia percorrida pelos documentos, quem está realizando o trabalho e como ele flui entre os participantes deste processo.(Wikipedia)';

        $dir_path = public_path() . '/fluxos';
        
        $files = File::files($dir_path);

        $dir = new DirectoryIterator($dir_path);
        $layouts = array();
        foreach ($files as $file) {           
            array_push($layouts,basename($file));                 
        }

        View::share('title', $title);
        View::share('pagina', $pagina);
        View::share('texto', $texto);
        View::share('files', $layouts);
 

        return view('ferramentas.fluxograma');
    }

    public function _fluxo_delete($arquivo){
        $dir_path = public_path() . '/fluxos';
        File::delete($dir_path.'/'.$arquivo);
        return redirect('fluxograma');
    }

    public function _folhas_observacoes(){
        $pagina = 'Folhas de Observações';
        $title = 'Ponto de Controle';
        $texto = '';

        $folhas = FolhaObservacao::all();
        $processos = processo::all();
        $maquinas = maquina::all();

        View::share('title', $title);
        View::share('pagina', $pagina);
        View::share('texto', $texto); 
        View::share('folhas', $folhas); 
        View::share('processos', $processos); 
        View::share('maquinas', $maquinas); 
        

        return view('ferramentas.folhas_observacoes');
    }

    public function _folha_observacoes($id,$alteracao){
        $pagina = 'Folhas de Observações';
        $title = 'Ponto de Controle';
        $texto = '';

        $objeto = FolhaObservacao::find($id);  
        $processos = processo::all();
        $maquinas = maquina::all();
        $operadores = Operador::all();
        $materiais = MateriaPrima::all();
        $elementos = FolhaElemento::where('idfolhaobservacao', $id)->orderby('ordinal')->get();

        $inicio = new DateTime($objeto->inicio);
        $fim = new DateTime($objeto->fim);
        $diff = $inicio->diff($fim, true);  
        $tempo_percorrido = (($diff->format( '%h' )*60)+$diff->format( '%i' )); 
        $tempo_efetivo = 0;
        $tempo_normal_operacao = 0;
        $fator_tolerancia = 0;
        $tempo_padrao_operacao = 0;
        $tempo_padrao_operacao_setup = 0;
        $numero_pecas = 0;
        $tempo_normal_peca = 0;
        $tempo_padrao_peca = 0;
        $tempos_coletados = 0;
        foreach ($elementos as $elemento) {
            $acumula = 0;
            $acumula += $elemento->tempo1;
            $acumula += $elemento->tempo2;
            $acumula += $elemento->tempo3;
            $acumula += $elemento->tempo4;
            $acumula += $elemento->tempo5;
            $acumula += $elemento->tempo6;
            $acumula += $elemento->tempo7;
            $acumula += $elemento->tempo8;
            $acumula += $elemento->tempo9;
            $acumula += $elemento->tempo10;
            $tempo_efetivo +=($acumula*($elemento->velocidade/100));
            
            if($elemento->tempo1>0)
            {
                $tempos_coletados++;
            }else if($elemento->tempo2>0)
            {
                $tempos_coletados++;
            }else if($elemento->tempo3>0)
            {
                $tempos_coletados++;
            }else if($elemento->tempo4>0)
            {
                $tempos_coletados++;
            }else if($elemento->tempo5>0)
            {
                $tempos_coletados++;
            }else if($elemento->tempo6>0)
            {
                $tempos_coletados++;
            }else if($elemento->tempo7>0)
            {
                $tempos_coletados++;
            }else if($elemento->tempo8>0)
            {
                $tempos_coletados++;
            }else if($elemento->tempo9>0)
            {
                $tempos_coletados++;
            }else if($elemento->tempo10>0)
            {
                $tempos_coletados++;
            }
        }

        if($elementos->count() >0)
        {
            $tempo_normal_operacao = $tempo_efetivo/$tempos_coletados;
            $fator_tolerancia = $objeto->jornada/($objeto->jornada - $objeto->fadiga);
            $tempo_padrao_operacao = $tempo_normal_operacao * $fator_tolerancia;
            $tempo_padrao_operacao_setup = ($objeto->setup/$objeto->unidades_acabadas) + $tempo_padrao_operacao;
            $numero_pecas = $objeto->jornada/$tempo_padrao_operacao;
            $tempo_normal_peca = $tempo_normal_operacao/$objeto->unidades_acabadas;
			$tempo_padrao_peca = $tempo_padrao_operacao/$objeto->unidades_acabadas;
        }
        
        View::share('title', $title);
        View::share('pagina', $pagina);
        View::share('texto', $texto); 
        View::share('objeto', $objeto); 
        View::share('processos', $processos); 
        View::share('maquinas', $maquinas); 
        View::share('alteracao', $alteracao);        
        View::share('operadores', $operadores);
        View::share('materiais', $materiais);         
        View::share('tempo_percorrido', $tempo_percorrido);         
        View::share('tempo_efetivo', $tempo_efetivo);   
        View::share('elementos', $elementos);       
        View::share('tempo_normal_operacao', $tempo_normal_operacao);       
        View::share('fator_tolerancia', $fator_tolerancia);       
        View::share('tempo_padrao_operacao', $tempo_padrao_operacao);       
        View::share('tempo_padrao_operacao_setup', $tempo_padrao_operacao_setup);
        View::share('numero_pecas', $numero_pecas);              
        View::share('tempo_normal_peca', $tempo_normal_peca);              
        View::share('tempo_padrao_peca', $tempo_padrao_peca);              
        View::share('tempos_coletados', $tempos_coletados);              

        return view('ferramentas.folha_observacoes');
    }
    public function _pops(){
        $pagina = 'Procedimentos Operacionais Padrão';
        $title = 'Ponto de Controle';
        $texto = '';

        $objetos = Pop::all();
        $setores = setor::all();

        View::share('title', $title);
        View::share('pagina', $pagina);
        View::share('texto', $texto);

        View::share('objetos', $objetos);
        View::share('setores', $setores);
        return view('ferramentas.pops');
    }

    public function _pop($id,$alteracao){
        $pagina = 'Procedimento Operacional Padrão';
        $title = 'Ponto de Controle';
        $texto = '';
        $arquivos = array();

        $objeto = Pop::find($id);  
        $setores = setor::all();
        $tarefas = Tarefa::where('idpop', $id)->orderby('ordinal')->get();
        $procedimentos = Procedimento::orderby('ordinal')->get();

        $dir_path = public_path() . '/pop';
        
        $files = File::files($dir_path);

        $dir = new DirectoryIterator($dir_path);
        foreach ($files as $file) {           
            array_push($arquivos,basename($file));                 
        }
        $setor = '';
        if ($alteracao != 'N' && $alteracao != 'S') {
            $setor = setor::find($alteracao);
        }



        View::share('title', $title);
        View::share('pagina', $pagina);
        View::share('texto', $texto);
        View::share('alteracao', $alteracao);        

        View::share('objeto', $objeto);
        View::share('setores', $setores);
        View::share('tarefas', $tarefas);
        View::share('procedimentos', $procedimentos);
        View::share('arquivos', $arquivos);
        View::share('setor', $setor);
        
        return view('ferramentas.pop');
    }
}

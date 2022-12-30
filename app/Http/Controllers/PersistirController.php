<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

use View;
use DB;
use File;
use Storage;
use DirectoryIterator;
use Carbon\Carbon;

use App\Models\Empresa;
use App\Models\linhaProducao;
use App\Models\MateriaPrima;
use App\Models\motivoReprogramacao;
use App\Models\Operador;
use App\Models\setor;
use App\Models\processo;
use App\Models\produto;
use App\Models\Carteira;
use App\Models\Devolucao;
use App\Models\Faturamento;
use App\Models\PrazoEntrega;
use App\Models\ProducaoGeral;
use App\Models\ReprogramacaoRetrabalho;
use App\Models\maquina;
use App\Models\FolhaObservacao;
use App\Models\FolhaElemento;
use App\Models\Tarefa;
use App\Models\Procedimento;
use App\Models\Pop;
use App\Models\PontoControle;
use App\Models\PontoControleDados;

class PersistirController extends Controller
{

    public function _store(Request $request){
        $tipo = $request->input('tipo');
        $rdata = Carbon::now()->format('Y-M-d');
       if($tipo == 'empresa'){
            $encaminhar = 'admin/'.$tipo;
            if($request->input('id') == null){
                $empresa = new Empresa();
            }else{
                $empresa = Empresa::find($request->input('id'));
            }
           
           $empresa->cnpj = $request->input('cnpj');
           $empresa->nome = ucwords($request->input('nome'));
           $empresa->apelido = ucwords($request->input('apelido'));
           $empresa->codigo1 = $request->input('codigo1');
           $teste = $request->input('codigo2');        
           if($teste == Null)
           {
               $teste = '';
           }
           $empresa->codigo2 = $teste;
           $empresa->save();
       } else if($tipo == 'linhaproducao'){
            $encaminhar = 'admin/'.$tipo;
            if($request->input('id') == null){
                $linhaProducao = new linhaProducao();
            }else{
                $linhaProducao = linhaProducao::find($request->input('id'));
            }
           
            $linhaProducao->descricao = ucwords($request->input('descricao'));           
            $linhaProducao->codigo1 = $request->input('codigo1');
            $teste = $request->input('codigo2');        
            if($teste == Null)
            {
                $teste = '';
            }
            $linhaProducao->codigo2 = $teste;
            $linhaProducao->save();
       } else if($tipo == 'materiaprima'){
           $encaminhar = 'admin/'.$tipo;
            if($request->input('id') == null){
                $materiaPrima = new MateriaPrima();
            }else{
                $materiaPrima = MateriaPrima::find($request->input('id'));
            }
           
            $materiaPrima->descricao = ucwords($request->input('descricao'));           
            $materiaPrima->codigo1 = $request->input('codigo1');
            $teste = $request->input('codigo2');        
            if($teste == Null)
            {
               $teste = '';
            }
            $materiaPrima->codigo2 = $teste;
            $materiaPrima->save();
       } else if($tipo == 'motivoreprogramacao'){
           $encaminhar = 'admin/'.$tipo;
            if($request->input('id') == null){
                $motivoReprogramacao = new motivoReprogramacao();
            }else{
                $motivoReprogramacao = motivoReprogramacao::find($request->input('id'));
            }
           
            $motivoReprogramacao->descricao = ucwords($request->input('descricao'));                                 
            $motivoReprogramacao->save();
       } else if($tipo == 'operador'){
           $encaminhar = 'admin/'.$tipo;
            if($request->input('id') == null){
                $operador = new Operador();
            }else{
                $operador = Operador::find($request->input('id'));
            }
           
            $operador->codigo = $request->input('codigo');
            $operador->nome = ucwords($request->input('nome'));                                 
            $operador->save();
       } else if($tipo == 'processo'){
           $encaminhar = 'admin/'.$tipo;
            if($request->input('id') == null){
                $processo = new processo();
            }else{
                $processo = processo::find($request->input('id'));
            }
           
            $processo->codigo = $request->input('codigo');
            $processo->descricao = ucwords($request->input('descricao'));                                 
            $processo->idsetor = $request->input('idsetor');
            $processo->save();
       } else if($tipo == 'produto'){
           $encaminhar = 'admin/'.$tipo;
           if($request->input('id') == null){
                $produto = new produto();
            }else{
                $produto = produto::find($request->input('id'));
            }

            $produto->descricao = ucwords($request->input('descricao'));
            $produto->idlinhaproducao = $request->input('idlinhaproducao');
            $produto->save();
       }else if($tipo == 'setor'){
           $encaminhar = 'admin/'.$tipo;
           if($request->input('id') == null){
                $setor = new setor();
            }else{
                $setor = setor::find($request->input('id'));
            }
           
            $setor->codigo = $request->input('codigo');
            $setor->descricao = ucwords($request->input('descricao'));                                            
            $setor->save();
        }else if($tipo == 'maquina'){
           $encaminhar = 'admin/'.$tipo;
           if($request->input('id') == null){
                $maquina = new maquina();
            }else{
                $maquina = maquina::find($request->input('id'));
            }
           
            $maquina->serial = $request->input('serial');
            $maquina->ano = $request->input('ano');
            $maquina->descricao = ucwords($request->input('descricao'));                                            
            $maquina->save();
       }else if($tipo == 'carteira'){
           $encaminhar = 'global/'.$tipo.'/'.$rdata;
           if($request->input('id') == null){
                $carteira = new Carteira();
            }else{
                $carteira = Carteira::find($request->input('id'));
            }
           
            $carteira->idempresa = $request->input('idempresa');
            $carteira->valor = $request->input('valor');
            $carteira->data = $request->input('data');
            $carteira->save();
       }else if($tipo == 'devolucao'){
            $encaminhar = 'global/'.$tipo.'/'.$rdata;
            if($request->input('id') == null){
                $devolucao = new Devolucao();
            }else{
                $devolucao = Devolucao::find($request->input('id'));
            }
           
            $devolucao->idempresa = $request->input('idempresa');
            $devolucao->codpedido = $request->input('codpedido');
            $devolucao->produto = $request->input('produto');
            $devolucao->valor = $request->input('valor');
            $devolucao->quantidade = $request->input('quantidade');
            $devolucao->unidade = $request->input('unidade');
            $devolucao->data_faturada = $request->input('data_faturada');
            $devolucao->data_devolucao = $request->input('data_devolucao');
            $devolucao->tipo = $request->input('tipot');
            $devolucao->motivo = $request->input('motivo');
            $devolucao->representante = $request->input('representante');
            $devolucao->cliente = $request->input('cliente');            
            $devolucao->origem_erro = $request->input('origem_erro');

            $devolucao->save();
       }else if($tipo == 'faturamento'){
           $encaminhar = 'global/'.$tipo.'/'.$rdata;
           if($request->input('id') == null){
                $faturamento = new Faturamento();
            }else{
                $faturamento = Faturamento::find($request->input('id'));
            }
           
            $faturamento->idempresa = $request->input('idempresa');
            $faturamento->valor = $request->input('valor');
            $faturamento->data = $request->input('data');
            $faturamento->save();
       }else if($tipo == 'prazo_entrega'){
            $encaminhar = 'global/'.$tipo.'/'.$rdata;         
            
            $tdate = Carbon::createFromDate($request->input('data'));
            $dtreg = $tdate->format('Y-m-').'01';
            PrazoEntrega::whereRaw("(data = ? )",[$dtreg])->delete();

            $prazo_entrega = new PrazoEntrega();            
            $prazo_entrega->idlinhaproducao = $request->input('idlinhaproducao');            
            $prazo_entrega->data = $request->input('data');
            $prazo_entrega->prazo_minimo = rand(1, 10);
            $prazo_entrega->prazo_maximo = rand(20, 30);
            $prazo_entrega->prazo_medio = rand($prazo_entrega->prazo_minimo, $prazo_entrega->prazo_maximo);
            $prazo_entrega->save();
       }else if($tipo == 'reprogramacao_retrabalho'){
           $encaminhar = 'global/'.$tipo.'/'.$rdata;
           if($request->input('id') == null){
                $reprogramacao_retrabalho = new ReprogramacaoRetrabalho();
            }else{
                $reprogramacao_retrabalho = ReprogramacaoRetrabalho::find($request->input('id'));
            }
            
            $reprogramacao_retrabalho->data = $request->input('data');
            $reprogramacao_retrabalho->idempresa = $request->input('idempresa');            
            $reprogramacao_retrabalho->idsetor = $request->input('idsetor');
            $reprogramacao_retrabalho->idproduto = $request->input('idproduto');
            $reprogramacao_retrabalho->retrabalho = $request->input('retrabalho');
            $reprogramacao_retrabalho->quantidade = $request->input('quantidade');
            $reprogramacao_retrabalho->custo = $request->input('custo');
            $reprogramacao_retrabalho->idmotivo = $request->input('idmotivo');
            $reprogramacao_retrabalho->save();
        }else if($tipo == 'folha_observacoes'){
           $encaminhar = 'folhas_observacoes';
           if($request->input('id') == null){
                $folha_observacoes = new FolhaObservacao();
            }else{
                $folha_observacoes = FolhaObservacao::find($request->input('id'));
                $encaminhar = 'folha_observacoes/'.$folha_observacoes->id.'/S';
            }

            $folha_observacoes->folha = ucwords($request->input('folha'));
            $folha_observacoes->idprocesso = $request->input('idprocesso');
	        $folha_observacoes->nome_peca = ucwords($request->input('nome_peca'));
	        $folha_observacoes->idmaquina = $request->input('idmaquina');
	        $folha_observacoes->idoperador = $request->input('idoperador');
	        $folha_observacoes->experiencia_servico = $request->input('experiencia_servico');
	        $folha_observacoes->idmestre = $request->input('idmestre');
	        $folha_observacoes->data = $request->input('data');
	        $folha_observacoes->numero_operacao = $request->input('numero_operacao');
            $folha_observacoes->operacao = ucwords($request->input('operacao'));
	        $folha_observacoes->numero_peca = ucwords($request->input('numero_peca'));
	        $folha_observacoes->numero_maquina = $request->input('numero_maquina');
	        $folha_observacoes->sexo = $request->input('sexo');
	        $folha_observacoes->idmateraprima = $request->input('idmateraprima');
	        $folha_observacoes->numero_secao = $request->input('numero_secao');
	        $folha_observacoes->inicio = $request->input('inicio');
	        $folha_observacoes->fim = $request->input('fim');
	        $folha_observacoes->numero_maquinas = $request->input('numero_maquinas');
	        $folha_observacoes->unidades_acabadas = $request->input('unidades_acabadas');
	        $folha_observacoes->fadiga = $request->input('fadiga');
	        $folha_observacoes->setup = $request->input('setup');
	        $folha_observacoes->jornada = $request->input('jornada');
            $folha_observacoes->save();
        }else if($tipo == 'elemento_folha'){
            $idfolha = $request->input('idfolha');
            $encaminhar = 'folha_observacoes/'.$idfolha.'/S';           
            
            if($request->input('id') == null){
                $elemento_folha = new FolhaElemento();
            }else{
                $elemento_folha = FolhaElemento::find($request->input('id'));
            }            

            $elemento_folha->idfolhaobservacao = $idfolha;            
	        $elemento_folha->ordinal= $request->input('ordinal');
	        $elemento_folha->elemento= $request->input('elemento');
	        
            $elemento_folha->velocidade= (empty($request->input('velocidade'))) ? 100 : $request->input('velocidade');
	        $elemento_folha->avanco = (empty($request->input('avanco'))) ? 0 : $request->input('avanco');
            $elemento_folha->tempo1 = (empty($request->input('t1'))) ? 0 : $request->input('t1');
            $elemento_folha->tempo2 = (empty($request->input('t2'))) ? 0 : $request->input('t2');
            $elemento_folha->tempo3 = (empty($request->input('t3'))) ? 0 : $request->input('t3');
            $elemento_folha->tempo4 = (empty($request->input('t4'))) ? 0 : $request->input('t4');
            $elemento_folha->tempo5 = (empty($request->input('t5'))) ? 0 : $request->input('t5');
            $elemento_folha->tempo6 = (empty($request->input('t6'))) ? 0 : $request->input('t6');
            $elemento_folha->tempo7 = (empty($request->input('t7'))) ? 0 : $request->input('t7');
            $elemento_folha->tempo8 = (empty($request->input('t8'))) ? 0 : $request->input('t8');
            $elemento_folha->tempo9 = (empty($request->input('t9'))) ? 0 : $request->input('t9');
            $elemento_folha->tempo10=(empty($request->input('t10'))) ? 0 : $request->input('t10'); 
            $elemento_folha->save();

        } else if($tipo == 'procedimento'){
            $idtarefa = $request->input('idtarefa');
            $idpop = $request->input('idpop');

            $encaminhar = 'pop/'.$idpop.'/S';
           if($request->input('id') == null){
                $procedimento = new Procedimento();
            }else{
                $procedimento = Procedimento::find($request->input('id'));
            }
            
            $procedimento->idtarefa = $idtarefa;
            $procedimento->ordinal = $request->input('ordinal');
            $procedimento->descricao = ucwords($request->input('descricao'));
            $procedimento->observacao = $request->input('observacao');
            $procedimento->save();
        } else if($tipo == 'tarefa'){
            $idpop = $request->input('idpop');

            $encaminhar = 'pop/'.$idpop.'/S';
           if($request->input('id') == null){
                $tarefa = new Tarefa();
            }else{
                $tarefa = Tarefa::find($request->input('id'));
            }
            
            $tarefa->idpop = $idpop;
            $tarefa->ordinal = $request->input('ordinal');
            $tarefa->descricao = ucwords($request->input('descricao'));
            $tarefa->save();
        } else if($tipo == 'pop'){
            $encaminhar = 'pops';
           if($request->input('id') == null){
                $pop = new Pop();
            }else{
                $pop = Pop::find($request->input('id'));
            }
            
            $pop->codigo = $request->input('codigo');
	        $pop->idsetor = $request->input('idsetor');
	        $pop->revisao = $request->input('revisao');
	        $pop->data = $request->input('data');
	        $pop->responsavel = ucwords($request->input('responsavel'));
	        $pop->revisor = ucwords($request->input('revisor'));
	        $pop->tarefa = ucwords($request->input('tarefa'));
	        $pop->resultado = $request->input('resultado');
	        $pop->equipamentos = $request->input('equipamentos');
	        $pop->epi = $request->input('epi');
	        $pop->epc = $request->input('epc');
	        $pop->recomendacao = $request->input('recomendacao');
	        $pop->observacao = $request->input('observacao');            
            $pop->save();
        } else if($tipo == 'pontocontrole'){
            $encaminhar = 'admin/pontocontrole';
            if($request->input('id') == null){
                $pontocontrole = new PontoControle();
            }else{
                $pontocontrole = PontoControle::find($request->input('id'));
            }
            $pontocontrole->descricao = ucwords($request->input('descricao'));
            $pontocontrole->idsetor = $request->input('idsetor');

            $pontocontrole->produto_componente = ($request->input('produto_componente') == '' ? 0 : 1);            
            $pontocontrole->quantidade = ($request->input('quantidade') == '' ? 0 : 1);            
            $pontocontrole->peso = ($request->input('peso') == '' ? 0 : 1);
            $pontocontrole->volume = ($request->input('volume') == '' ? 0 : 1);
            $pontocontrole->valor = ($request->input('valor') == '' ? 0 : 1);
	        $pontocontrole->observacao = ($request->input('observacao') == '' ? 0 : 1);
	        $pontocontrole->extra1 = ($request->input('extra1') == '' ? 0 : 1);
	        $pontocontrole->extra2 = ($request->input('extra2') == '' ? 0 : 1);
	        $pontocontrole->extra3 = ($request->input('extra3') == '' ? 0 : 1);
            $pontocontrole->save();
        } else if($tipo == 'pontocontrole_dados'){
            
            if($request->input('id') == null){
                $pontocontrole_dados = new PontoControleDados();
                $encaminhar = 'pontocontrole/'.$pontocontrole->idsetor.'/'.$pontocontrole->id.'/'.$date->format('Y-m-d');
            }else{
                $pontocontrole_dados = PontoControleDados::find($request->input('id'));
                $datep = Carbon::createFromDate($pontocontrole_dados->data_hora);
                $encaminhar = 'pontocontrole_lista/'.$pontocontrole_dados->idponto_controle.'/'.$datep->format('Y-m-d');
            }
            $idpontocontrole = $request->input('idponto');
            $pontocontrole = PontoControle::find($idpontocontrole);
            $date = Carbon::now();
            

            $pontocontrole_dados->idponto_controle = $idpontocontrole;
            $pontocontrole_dados->data_hora = $request->input('data_hora');
            $pontocontrole_dados->produto_componente = ($request->input('produto_componente') == '' ? '-' : $request->input('produto_componente'));            
            $pontocontrole_dados->quantidade = ($request->input('quantidade') == '' ? 0 : $request->input('quantidade'));            
            $pontocontrole_dados->peso = ($request->input('peso') == '' ? 0 : $request->input('peso'));
            $pontocontrole_dados->volume = ($request->input('volume') == '' ? 0 : $request->input('volume'));
            $pontocontrole_dados->valor = ($request->input('valor') == '' ? 0 : $request->input('valor'));
	        $pontocontrole_dados->observacao = ($request->input('observacao') == '' ? '-' : $request->input('observacao'));
	        $pontocontrole_dados->extra1 = ($request->input('extra1') == '' ? '0' : $request->input('extra1'));
	        $pontocontrole_dados->extra2 = ($request->input('extra2') == '' ? '0' : $request->input('extra2'));
	        $pontocontrole_dados->extra3 = ($request->input('extra3') == '' ? '0' : $request->input('extra3'));
            $pontocontrole_dados->save();
        }

       return redirect($encaminhar);
    }

    public function _delete($tipo, $id){
        if($tipo == 'empresa'){
            $encaminhar = 'admin/'.$tipo;
            $empresa = Empresa::find($id);           
            $empresa->delete();
        } else if($tipo == 'linhaproducao'){
            $encaminhar = 'admin/'.$tipo;
           $linhaProducao = linhaProducao::find($id);           
           $linhaProducao->delete();
        } else if($tipo == 'materiaprima'){
            $encaminhar = 'admin/'.$tipo;
           $materiaPrima = MateriaPrima::find($id);           
           $materiaPrima->delete();
        } else if($tipo == 'admin/'.'motivoreprogramacao'){
            $encaminhar = $tipo;
            $motivoReprogramacao = motivoReprogramacao::find($id);                                           
            $motivoReprogramacao->delete();
        } else if($tipo == 'operador'){
            $encaminhar = 'admin/'.$tipo;
            $operador = Operador::find($id);                                         
            $operador->delete();
        } else if($tipo == 'processo'){
            $encaminhar = 'admin/'.$tipo;
            $processo = processo::find($id);           
            $processo->delete();
        } else if($tipo == 'produto'){
            $encaminhar = 'admin/'.$tipo;
            $produto = produto::find($id);                                                  
            $produto->delete();
        }else if($tipo == 'setor'){
            $encaminhar = 'admin/'.$tipo;
            $setor = setor::find($id);                                                  
            $setor->delete();
        }else if($tipo == 'maquina'){
            $encaminhar = 'admin/'.$tipo;
            $maquina = maquina::find($id);                                                  
            $maquina->delete();
        }else if($tipo == 'carteira'){
            $encaminhar = 'global/'.$tipo;
            $carteira = Carteira::find($id);
            $carteira->delete();
        }else if($tipo == 'devolucao'){
            $encaminhar = 'global/'.$tipo;
            $devolucao = Devolucao::find($id);
            $devolucao->delete();
        }else if($tipo == 'faturamento'){
            $encaminhar = 'global/'.$tipo;
            $faturamento = Faturamento::find($id);
            $faturamento->delete();
        }else if($tipo == 'prazo_entrega'){
            $encaminhar = 'global/'.$tipo;
            $prazo_entrega = PrazoEntrega::find($id);
            $prazo_entrega->delete();
        }else if($tipo == 'reprogramacao_retrabalho'){
            $encaminhar = 'global/'.$tipo;
            $reprogramacao_retrabalho = ReprogramacaoRetrabalho::find($id);
            $reprogramacao_retrabalho->delete();
        }else if($tipo == 'folha_observacoes'){
            $encaminhar = 'folhas_observacoes';
            $folha_observacoes = FolhaObservacao::find($id);
            DB::table('folha_elementos')->where('idfolhaobservacao', $id)->delete();
            $folha_observacoes->delete();
        
        }else if($tipo == 'elemento_folha'){
            $elemento_folha = FolhaElemento::find($id);
            $idfolha = $elemento_folha->idfolhaobservacao;            
            $encaminhar = 'folha_observacoes/'.$idfolha.'/S';
            $elemento_folha->delete(); 
        }else if($tipo == 'pop'){
            $pop = POP::find($id);
            $tarefas = Tarefa::where('idpop', $id)->get();
            foreach ($tarefas as $tarefa) {
                $procedimentos = DB::table('procedimentos')->where('idtarefa', $tarefa->id)->get();

                foreach ($procedimentos as $procedimento) {
                    $dir_path = public_path() . '/pop';
                    if (file_exists($dir_path.'/'.$procedimento->id.'.jpg')) {
                        File::delete($dir_path.'/'.$procedimento->id.'.jpg');
                    }elseif (file_exists($dir_path.'/'.$procedimento->id.'.jpeg')) {
                        File::delete($dir_path.'/'.$procedimento->id.'.jpeg');
                    }elseif (file_exists($dir_path.'/'.$procedimento->id.'.png')) {
                        File::delete($dir_path.'/'.$procedimento->id.'.png');
                    }
                }
                DB::table('procedimentos')->where('idtarefa', $tarefa->id)->delete();
            }            
            DB::table('tarefas')->where('idpop', $id)->delete();
            $encaminhar = 'pops';
            $pop->delete();           
            
        }else if($tipo == 'tarefa'){
            $tarefa = Tarefa::find($id);
            $idpop = $tarefa->idpop;   
            $procedimentos = DB::table('procedimentos')->where('idtarefa', $tarefa->id)->get();

            foreach ($procedimentos as $procedimento) {
                $dir_path = public_path() . '/pop';
                if (file_exists($dir_path.'/'.$procedimento->id.'.jpg')) {
                    File::delete($dir_path.'/'.$procedimento->id.'.jpg');
                }elseif (file_exists($dir_path.'/'.$procedimento->id.'.jpeg')) {
                    File::delete($dir_path.'/'.$procedimento->id.'.jpeg');
                }elseif (file_exists($dir_path.'/'.$procedimento->id.'.png')) {
                    File::delete($dir_path.'/'.$procedimento->id.'.png');
                }
            }
            DB::table('procedimentos')->where('idtarefa', $tarefa->id)->delete();         

            $encaminhar = 'pop/'.$idpop.'/S';
            $tarefa->delete(); 
        }else if($tipo == 'procedimento'){
            $procedimento = Procedimento::find($id);
            $tarefa = Tarefa::find($procedimento->idtarefa);
            $encaminhar = 'pop/'.$tarefa->idpop.'/S';
            $dir_path = public_path() . '/pop';
            if (file_exists($dir_path.'/'.$procedimento->id.'.jpg')) {
                File::delete($dir_path.'/'.$procedimento->id.'.jpg');
            }elseif (file_exists($dir_path.'/'.$procedimento->id.'.jpeg')) {
                File::delete($dir_path.'/'.$procedimento->id.'.jpeg');
            }elseif (file_exists($dir_path.'/'.$procedimento->id.'.png')) {
                File::delete($dir_path.'/'.$procedimento->id.'.png');
            }
            $procedimento->delete();
        } else if($tipo == 'pontocontrole'){
            $pontocontrole = PontoControle::find($id);  
            $dados = PontoControleDados::where('idponto_controle', $pontocontrole->id)->delete(); 
            $encaminhar = 'admin/pontocontrole';
            $pontocontrole->delete();
        } else if($tipo == 'pontocontrole_dados'){
            $pontocontrole_dados = PontoControleDados::find($id);
            $datep = Carbon::createFromDate($pontocontrole_dados->data_hora);
            $encaminhar = 'pontocontrole_lista/'.$pontocontrole_dados->idponto_controle.'/'.$datep->format('Y-m-d');
            $pontocontrole_dados->delete();
        }
        return redirect($encaminhar);
    }

    public function _cargaBruta($tipo){    
        $empresas = Empresa::all();
        $setores = setor::all();
        if($tipo == 'carteira'){
            DB::table('carteiras')->delete();
            DB::table('sqlite_sequence')->where('name', 'carteiras')->update(['seq' => 0]);

            for ($ano=2020; $ano <2022; $ano++) { 
                for ($mes=1; $mes<=12; $mes++) { 
                   
                    $ultimoDia = date("t", mktime(0,0,0, $mes,'01', $ano));
                    for ($dia=1; $dia<=$ultimoDia; $dia++) { 
                        foreach ($empresas as $empresa) {
                            $objeto = new Carteira();           
                            $objeto->idempresa = $empresa->id;
                            $objeto->valor = rand(100, 300);
                            $date = mktime(0,0,0, $mes,$dia, $ano);
                            $objeto->data = date("Y-m-d", $date);
                            $objeto->save();
                        }
                    }
                }
            }
        }else if($tipo == 'faturamento'){
            DB::table('faturamentos')->delete();
            DB::table('sqlite_sequence')->where('name', 'faturamentos')->update(['seq' => 0]);
            for ($ano=2020; $ano <2022; $ano++) { 
                for ($mes=1; $mes<=12; $mes++) { 
                   
                    $ultimoDia = date("t", mktime(0,0,0, $mes,'01', $ano));
                    for ($dia=1; $dia<=$ultimoDia; $dia++) { 
                        foreach ($empresas as $empresa) {
                            $objeto = new Faturamento();           
                            $objeto->idempresa = $empresa->id;
                            $objeto->valor = rand(100, 300);
                            $date = mktime(0,0,0, $mes,$dia, $ano);
                            $objeto->data = date("Y-m-d", $date);
                            $objeto->save();
                        }
                    }
                }
            }            
        }else if($tipo == 'prazo_entrega'){
            DB::table('prazo_entregas')->delete();
            DB::table('sqlite_sequence')->where('name', 'prazo_entrega')->update(['seq' => 0]);
            $linhas = linhaProducao::all();
            for ($ano=2020; $ano <2022; $ano++) { 
                for ($mes=1; $mes<=12; $mes++) {                   
                    $ultimoDia = date("t", mktime(0,0,0, $mes,'01', $ano));
                    foreach ($linhas as $linha) {
                        $objeto = new PrazoEntrega();           
                        $objeto->idlinhaproducao = $linha->id;                            
                        $date = mktime(0,0,0, $mes,'01', $ano);
                        $objeto->data = date("Y-m-d", $date);
                        $objeto->registros = rand(100, 300);
                        $objeto->prazo_minimo = rand(1, 10);
                        $objeto->prazo_maximo = rand(20, 30);
                        $objeto->prazo_medio = rand($objeto->prazo_minimo, $objeto->prazo_maximo);
                        $objeto->save();
                    }                    
                }
            }
        }else if($tipo == 'devolucao'){
            DB::table('devolucaos')->delete();
            DB::table('sqlite_sequence')->where('name', 'devolucaos')->update(['seq' => 0]);

            for ($ano=2020; $ano <2022; $ano++) { 
                for ($mes=1; $mes<=12; $mes++) {  
                    $registros = rand(0, 20); 
                    $tipoant = '1';
                    for ($i=0; $i <= $registros; $i++) { 
                        
                            $objeto = new Devolucao(); 
                            $objeto->idempresa = rand(1,$empresas->count());
                            $objeto->codpedido = 'P000'.($i*2);
                            $objeto->produto = $i;
                            $objeto->valor = rand(45, 150);
                            $objeto->quantidade = ($objeto->valor/10);
                            $objeto->unidade = 'und';
                            $dataf = mktime(0,0,0, $mes,$i, $ano);
                            $objeto->data_faturada =  date("Y-m-d", $dataf);
                            $objeto->data_devolucao = date('Y-m-d', strtotime('+'.rand(6,30).' days', strtotime($i.'-'.$mes.'-'.$ano)));
                            if($tipoant == '1')
                            {
                                $tipoant = '2';
                                $objeto->tipo = 'CONSERTO';
                                $objeto->origem_erro = 'FABRICA';
                            }else{
                                $tipoant = '1';
                                $objeto->tipo = 'DEVOLUÇÃO';
                                $objeto->origem_erro = 'REPRESENTANTE';
                            }
                            $objeto->motivo = 'Teste motivo';
                            $objeto->representante = 'Teste representante';
                            $objeto->cliente = 'Teste cliente';   
                            $objeto->save();                        
                        
                    }
                }
            }
        }else if($tipo == 'reprogramacao_retrabalho'){
            DB::table('reprogramacao_retrabalhos')->delete();
            DB::table('sqlite_sequence')->where('name', 'reprogramacao_retrebalhos')->update(['seq' => 0]);
            $motivos = motivoReprogramacao::all();
            $produtos = produto::all();
            for ($ano=2020; $ano <2022; $ano++) { 
                for ($mes=1; $mes<=12; $mes++) {  
                    $registros = rand(1, 4); 
                    $ultimoDia = date("t", mktime(0,0,0, $mes,'01', $ano));
                    for ($dia=1; $dia<=$ultimoDia; $dia++) { 
                        for ($i=0; $i <= $registros; $i++) {                                                    
                            $tipoant = 1;
                            $objeto = new ReprogramacaoRetrabalho(); 
                            $objeto->idempresa = rand(1,$empresas->count());
                            $date = mktime(0,0,0, $mes,$dia, $ano);
                            $objeto->data = date("Y-m-d", $date);;            
                            $objeto->idsetor = rand(1, $setores->count());
                            $objeto->idproduto = rand(1, $produtos->count());                            
                            $objeto-> retrabalho = rand(0, 1);                            
                            $objeto->quantidade = rand(200, 1500);
                            $objeto->custo= rand(2, 3)*$objeto->quantidade ;
                            $objeto->idmotivo = rand(1, $motivos->count());
                            $objeto->save();   
                        }                      
                    }
                
                }
            }
        }else if($tipo == 'producao_geral'){
            DB::table('producao_gerals')->delete();
            DB::table('sqlite_sequence')->where('name', 'producao_gerals')->update(['seq' => 0]);
            $maquinas =  maquina::all();
            $maquina = rand(1, $maquinas->count());
            for ($ano=2020; $ano <2022; $ano++) { 
                for ($mes=1; $mes<13; $mes++) {  
                    $ultimoDia = date("t", mktime(0,0,0, $mes,'01', $ano));
                    for ($dia=1; $dia<=$ultimoDia; $dia++) { 
                        $date = mktime(0,0,0, $mes,$dia, $ano);
                        foreach ($setores as $setor) {                        
                            $objeto = new ProducaoGeral();                            
                            $objeto->data = date("Y-m-d", $date);
                            $objeto->componente = 'c00'.$setor->idsetor;
                            $objeto->quantidade = rand(5000, 8000);
                            $objeto->peso = ($objeto->quantidade)*0.09;
                            $objeto->idsetor = $setor->id;
                            $objeto->idmaquina = $maquina;
                            $objeto->idprocesso = $setor->id;
                            $objeto->controlado = 1;
                            $objeto->save(); 
                        }
                    }
                }
            }
        }
        return redirect('cargadados');
    }
    
}

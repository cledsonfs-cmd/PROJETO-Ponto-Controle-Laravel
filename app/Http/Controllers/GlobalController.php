<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use View;
use DB;

use Illuminate\Http\Request;
use App\Http\Requests;

use App\Models\Empresa;
use App\Models\Carteira;
use App\Models\ReprogramacaoRetrabalho;
use App\Models\ProducaoGeral;
use App\Models\PrazoEntrega;
use App\Models\Faturamento;
use App\Models\Devolucao;
use App\Models\linhaProducao;
use App\Models\produto;
use App\Models\setor;
use App\Models\processo;
use App\Models\maquina;

class GlobalController extends Controller
{
    public function _index($tipo,$data){
        if($data == '')
        {   
            $date = Carbon::now();
        }else{
            $date = Carbon::createFromDate($data);
        }

        $data = $date->format('l, d M Y');
        
        $form = 'sim';
        $title = 'Ponto de Controle';
        $empresas = Empresa::all();
        $anos = array();
        $dados = "";
        $links = "";
        $atual = "";
        $manutencao = 'sim';
        $grafico = array();
       if ($tipo == 'carteira') {
            $pagina = 'Carteira';      
            $inicio = $date->format('Y-m-').'01';    
            if($date->format('Y-m') == Carbon::now()->format('Y-m'))
            {
                $fim = Carbon::now()->format('Y-m-d');
            }
            else {
                $fim = $date->format('Y-m-').$date->format('t');    
            }
            
            $atual = DB::table('carteiras')->select('idempresa,valor', DB::raw('idempresa,valor'))->where('data',$date->toDateString())->get();            
            $atualf = DB::table('faturamentos')->select('idempresa,valor', DB::raw('idempresa,sum(valor) as valor'))->whereRaw("(data >= ? AND data <= ?)",[$inicio, $fim])->groupby('idempresa')->get();            
            $dados = Carteira::whereRaw("(data >= ? AND data <= ?)",[$inicio, $fim])->get();
            $links = DB::table('carteiras')->select('v1,v2,v3', DB::raw('strftime(\'%Y\',data) as v1,strftime(\'%m\',data) as v2,strftime(\'%Y-%m\',data) as v3'))->groupBy('v3')->get();            
            foreach ($links as $link) {
                $dateObj = Carbon::createFromDate($date->format('Y'),$link->v2,'01');
                $link->v2 = $dateObj->format('F');
                
                if(in_array($link->v1,$anos) == false)
                {
                    array_push($anos, $link->v1);
                }
            }
            $anos = array_reverse($anos, true);

            $linha = '';
            for ($dia=1; $dia <=$date->format('t') ; $dia++) { 
                foreach ($empresas as $empresa) {
                    foreach ($dados as $dado) {
                        if($empresa->id == $dado->idempresa && Carbon::createFromDate($dado->data)->format('d') == $dia)
                        {                            
                            $linha = '{x:'.$dia.','.$empresa->id.':'.$dado->valor.'},';
                        }
                    }
                    if($linha ==  '{x:'.$dia.','.$empresa->id.':0},'){
                        array_push($grafico, $linha);    
                    }
                    else {
                        array_push($grafico, $linha);    
                        $linha = '';
                    }
                    
                }
            }
            View::share('atualf', $atualf);
        } else if ($tipo == 'devolucao') {
            $pagina = 'Devolução';
            $inicio = $date->format('Y-m-').'01';    
            if($date->format('Y-m') == Carbon::now()->format('Y-m'))
            {
                $fim = Carbon::now()->format('Y-m-d');
            }
            else {
                $fim = $date->format('Y-m-').$date->format('t');    
            }
            
            $atual = DB::table('devolucaos')->select('idempresa,valor', DB::raw('idempresa,sum(valor) as valor'))->whereRaw("(data_devolucao >= ? AND data_devolucao <= ?)",[$inicio, $fim])->groupby('idempresa')->get();            
            $dados = DB::table('devolucaos')->select('*,dias', DB::raw('*,cast(JulianDay(data_devolucao||\' 00:00\') - JulianDay(data_faturada||\' 23:59\') AS INTEGER) as dias'))->whereRaw("(data_devolucao >= ? AND data_devolucao <= ?)",[$inicio, $fim])->get();
            $links = DB::table('devolucaos')->select('v1,v2,v3', DB::raw('strftime(\'%Y\',data_devolucao) as v1,strftime(\'%m\',data_devolucao) as v2,strftime(\'%Y-%m\',data_devolucao) as v3'))->groupBy('v3')->get();            
            foreach ($links as $link) {
                $dateObj = Carbon::createFromDate($date->format('Y'),$link->v2,'01');
                $link->v2 = $dateObj->format('F');
                
                if(in_array($link->v1,$anos) == false)
                {
                    array_push($anos, $link->v1);
                }
            }
            $anos = array_reverse($anos, true);

            $linha = '';
            for ($dia=1; $dia <=$date->format('t') ; $dia++) { 
                foreach ($empresas as $empresa) {
                    foreach ($dados as $dado) {
                        if($empresa->id == $dado->idempresa && Carbon::createFromDate($dado->data_devolucao)->format('d') == $dia)
                        {                            
                            $linha = '{x:'.$dia.','.$empresa->id.':'.$dado->valor.'},';
                        }
                    }
                    if($linha ==  '{x:'.$dia.','.$empresa->id.':0},'){
                        array_push($grafico, $linha);    
                    }
                    else {
                        array_push($grafico, $linha);    
                        $linha = '';
                    }
                    
                }
            }
        } else if ($tipo == 'faturamento') {
            $pagina = 'Faturamento';
            $inicio = $date->format('Y-m-').'01';    
            if($date->format('Y-m') == Carbon::now()->format('Y-m'))
            {
                $fim = Carbon::now()->format('Y-m-d');
            }
            else {
                $fim = $date->format('Y-m-').$date->format('t');    
            }
            
            $atual = DB::table('faturamentos')->select('idempresa,valor', DB::raw('idempresa,sum(valor) as valor'))->whereRaw("(data >= ? AND data <= ?)",[$inicio, $fim])->groupby('idempresa')->get();            
            $dados = Faturamento::whereRaw("(data >= ? AND data <= ?)",[$inicio, $fim])->get();
            $links = DB::table('faturamentos')->select('v1,v2,v3', DB::raw('strftime(\'%Y\',data) as v1,strftime(\'%m\',data) as v2,strftime(\'%Y-%m\',data) as v3'))->groupBy('v3')->get();            
            foreach ($links as $link) {
                $dateObj = Carbon::createFromDate($date->format('Y'),$link->v2,'01');
                $link->v2 = $dateObj->format('F');
                
                if(in_array($link->v1,$anos) == false)
                {
                    array_push($anos, $link->v1);
                }
            }
            $anos = array_reverse($anos, true);

            $linha = '';
            for ($dia=1; $dia <=$date->format('t') ; $dia++) { 
                foreach ($empresas as $empresa) {
                    foreach ($dados as $dado) {
                        if($empresa->id == $dado->idempresa && Carbon::createFromDate($dado->data)->format('d') == $dia)
                        {                            
                            $linha = '{x:'.$dia.','.$empresa->id.':'.$dado->valor.'},';
                        }
                    }
                    if($linha !=  ''){                      
                        array_push($grafico, $linha);    
                        $linha = '';
                    }
                    
                }
            }
        } else if ($tipo == 'prazo_entrega') {
            $pagina = 'Prazo de Entrega';
            $periodo = $date->format('Y-m-').'01'; 
            $dados = PrazoEntrega::whereRaw("(data = ?)",[$periodo])->get();

            $links = DB::table('prazo_entregas')->select('v1,v2,v3', DB::raw('strftime(\'%Y\',data) as v1,strftime(\'%m\',data) as v2,strftime(\'%Y-%m\',data) as v3'))->groupBy('v3')->get();            
            foreach ($links as $link) {
                $dateObj = Carbon::createFromDate($date->format('Y'),$link->v2,'01');
                $link->v2 = $dateObj->format('F');
                
                if(in_array($link->v1,$anos) == false)
                {
                    array_push($anos, $link->v1);
                }
            }
            $anos = array_reverse($anos, true);
            $linhas = linhaProducao::all();
            $empresas = '';         
            View::share('linhas', $linhas);
            View::share('dataprazo', $date->format('M/Y'));
        } else if ($tipo == 'reprogramacao_retrabalho') {
            $pagina = 'Reprogramação & Retrabalho';
            $inicio = $date->format('Y-m-').'01';    
            if($date->format('Y-m') == Carbon::now()->format('Y-m'))
            {
                $fim = Carbon::now()->format('Y-m-d');
            }
            else {
                $fim = $date->format('Y-m-').$date->format('t');    
            }
            $dados = ReprogramacaoRetrabalho::whereRaw("(data >= ? AND data <= ?) and retrabalho=0",[$inicio, $fim])->select(DB::raw('idempresa,data,retrabalho'), DB::raw('sum(quantidade) as quantidade'), DB::raw('sum(custo) as custo'))->groupby('idempresa')->groupby('data')->get();
            $dados1 = ReprogramacaoRetrabalho::whereRaw("(data >= ? AND data <= ?) and retrabalho=1",[$inicio, $fim])->select(DB::raw('idempresa,data,retrabalho'), DB::raw('sum(quantidade) as quantidade'), DB::raw('sum(custo) as custo'))->groupby('idempresa')->groupby('data')->get();
            $graficorep = array();
            $graficoret = array();
            $linha = '';
            $linha1 = '';
            for ($dia=1; $dia <=$date->format('t') ; $dia++) { 
                foreach ($empresas as $empresa) {
                    foreach ($dados as $dado) {
                        if($empresa->id == $dado->idempresa && Carbon::createFromDate($dado->data)->format('d') == $dia && $dado->retrabalho == 0)
                        {                            
                            $linha = '{x:'.$dia.','.$empresa->id.':'.$dado->quantidade.'},';
                        }                        
                    }

                    foreach ($dados1 as $dado) {                        
                        if($empresa->id == $dado->idempresa && Carbon::createFromDate($dado->data)->format('d') == $dia && $dado->retrabalho == 1)
                        {                            
                            $linha1 = '{x:'.$dia.','.$empresa->id.':'.$dado->quantidade.'},';
                        }
                    }

                    if($linha !=  ''){                   
                        array_push($graficorep, $linha);    
                        $linha = '';
                    } 
                    
                    if($linha1 !=  ''){                     
                        array_push($graficoret, $linha1);    
                        $linha1 = '';
                    } 
                }
            }

            $links = DB::table('carteiras')->select('v1,v2,v3', DB::raw('strftime(\'%Y\',data) as v1,strftime(\'%m\',data) as v2,strftime(\'%Y-%m\',data) as v3'))->groupBy('v3')->get();            
            foreach ($links as $link) {
                $dateObj = Carbon::createFromDate($date->format('Y'),$link->v2,'01');
                $link->v2 = $dateObj->format('F');
                
                if(in_array($link->v1,$anos) == false)
                {
                    array_push($anos, $link->v1);
                }
            }
            $anos = array_reverse($anos, true);

            View::share('graficorep', $graficorep);
            View::share('graficoret', $graficoret);
            View::share('dados1', $dados1);
            
        } else if ($tipo == 'producao_geral') {
            $pagina = 'Produção Geral';
            $inicio = $date->format('Y-m-').'01';  
            $ultimo_dia = 0;
            if($date->format('Y-m') == Carbon::now()->format('Y-m'))
            {
                $fim = Carbon::now()->format('Y-m-d');
                $ultimo_dia = Carbon::now()->format('d');
            }
            else {
                $fim = $date->format('Y-m-').$date->format('t');    
                $ultimo_dia = $date->format('t');
            }
            $setores = setor::all();
            $dados = ProducaoGeral::whereRaw("(data >= ? AND data <= ?)",[$inicio, $fim])->get();
            $grafico = DB::table('producao_gerals')->select('idsetor,total', DB::raw('idsetor,sum(quantidade) as total'))->whereRaw("(data >= ? AND data <= ?)",[$inicio, $fim])->groupby('idsetor')->get();            

            $pecaproduzidas = 0;
            foreach ($dados as $dado) {
                $pecaproduzidas += $dado->quantidade;
            }
            $manutencao = 'não';


            $links = DB::table('producao_gerals')->select('v1,v2,v3', DB::raw('strftime(\'%Y\',data) as v1,strftime(\'%m\',data) as v2,strftime(\'%Y-%m\',data) as v3'))->groupBy('v3')->get();            
            foreach ($links as $link) {
                $dateObj = Carbon::createFromDate($date->format('Y'),$link->v2,'01');
                $link->v2 = $dateObj->format('F');
                
                if(in_array($link->v1,$anos) == false)
                {
                    array_push($anos, $link->v1);
                }
            }
            $anos = array_reverse($anos, true);

            View::share('pecaproduzidas', $pecaproduzidas);
            View::share('setores', $setores);
            View::share('ultimo_dia', $ultimo_dia);

        }       

        View::share('tipo', $tipo);
        View::share('form', $form);
        View::share('title', $title);
        View::share('pagina', $pagina);
        View::share('paginanome', $pagina.' ('.$date->format('M/Y').')');
        View::share('dados', $dados);
        View::share('data', $data);
        View::share('atual', $atual);
        View::share('anos', $anos);
        View::share('links', $links);
        View::share('empresas', $empresas);
        View::share('manutencao', $manutencao);
        View::share('grafico', $grafico);
        
        return view('global.'.$tipo);
    }

    public function _listagem($tipo,$pagina,$idempresa){
        $manutencao = 'sim';
        $form = 'sim';

        $date = Carbon::now();          
        $anos = array();
        $links = "";

        if ($tipo == 'carteira') {
            $links = DB::table('carteiras')->select('v1,v2,v3', DB::raw('strftime(\'%Y\',data) as v1,strftime(\'%m\',data) as v2,strftime(\'%Y-%m\',data) as v3'))->groupBy('v3')->get();            
            foreach ($links as $link) {
                $dateObj = Carbon::createFromDate($date->format('Y'),$link->v2,'01');
                $link->v2 = $dateObj->format('F');
                
                if(in_array($link->v1,$anos) == false)
                {
                    array_push($anos, $link->v1);
                }
            }
            $anos = array_reverse($anos, true);

            $dados = Carteira::where('idempresa',$idempresa)->orderby('data','DESC')->get();
        } else if ($tipo == 'devolucao') {
            $dados = Devolucao::where('idempresa',$idempresa)->get();
            $links = DB::table('devolucaos')->select('v1,v2,v3', DB::raw('strftime(\'%Y\',data_devolucao) as v1,strftime(\'%m\',data_devolucao) as v2,strftime(\'%Y-%m\',data_devolucao) as v3'))->groupBy('v3')->get();            
            foreach ($links as $link) {
                $dateObj = Carbon::createFromDate($date->format('Y'),$link->v2,'01');
                $link->v2 = $dateObj->format('F');
                
                if(in_array($link->v1,$anos) == false)
                {
                    array_push($anos, $link->v1);
                }
            }
            $anos = array_reverse($anos, true);
        } else if ($tipo == 'faturamento') {
            $dados = Faturamento::where('idempresa',$idempresa)->get();
            $links = DB::table('carteiras')->select('v1,v2,v3', DB::raw('strftime(\'%Y\',data) as v1,strftime(\'%m\',data) as v2,strftime(\'%Y-%m\',data) as v3'))->groupBy('v3')->get();            
            foreach ($links as $link) {
                $dateObj = Carbon::createFromDate($date->format('Y'),$link->v2,'01');
                $link->v2 = $dateObj->format('F');
                
                if(in_array($link->v1,$anos) == false)
                {
                    array_push($anos, $link->v1);
                }
            }
            $anos = array_reverse($anos, true);
        } else if ($tipo == 'prazo_entrega') {
            $dados = PrazoEntrega::orderby('data')->get();
            $empresa = '';
            $links = DB::table('carteiras')->select('v1,v2,v3', DB::raw('strftime(\'%Y\',data) as v1,strftime(\'%m\',data) as v2,strftime(\'%Y-%m\',data) as v3'))->groupBy('v3')->get();            
            foreach ($links as $link) {
                $dateObj = Carbon::createFromDate($date->format('Y'),$link->v2,'01');
                $link->v2 = $dateObj->format('F');
                
                if(in_array($link->v1,$anos) == false)
                {
                    array_push($anos, $link->v1);
                }
            }
            $anos = array_reverse($anos, true);
            $empresas = 'lista';
        } else if ($tipo == 'reprogramacao_retrabalho') {            
            $dados = ReprogramacaoRetrabalho::where('idempresa',$idempresa)->get();
            $links = DB::table('carteiras')->select('v1,v2,v3', DB::raw('strftime(\'%Y\',data) as v1,strftime(\'%m\',data) as v2,strftime(\'%Y-%m\',data) as v3'))->groupBy('v3')->get();            
            foreach ($links as $link) {
                $dateObj = Carbon::createFromDate($date->format('Y'),$link->v2,'01');
                $link->v2 = $dateObj->format('F');
                
                if(in_array($link->v1,$anos) == false)
                {
                    array_push($anos, $link->v1);
                }
            }
            $anos = array_reverse($anos, true);
        } else if ($tipo == 'producao_geral') {   
            $anosel =  $idempresa; 
            $dados = ProducaoGeral::whereRaw("(data >= ? AND data <= ?)",[$anosel.'-01-01', $anosel.'-12-31'])->get();
            $links = DB::table('producao_gerals')->select('v1,v2,v3', DB::raw('strftime(\'%Y\',data) as v1,strftime(\'%m\',data) as v2,strftime(\'%Y-%m\',data) as v3'))->groupBy('v3')->get();            
            $idsetor = $pagina;
            $setor = setor::find($idsetor);
            $pagina = 'Listagem Dados '.$setor->descricao.' do ano de '.$anosel;
            $idempresa='';
            foreach ($links as $link) {
                $dateObj = Carbon::createFromDate($date->format('Y'),$link->v2,'01');
                $link->v2 = $dateObj->format('F');
                
                if(in_array($link->v1,$anos) == false)
                {
                    array_push($anos, $link->v1);
                }
            }
            $anos = array_reverse($anos, true);
            $manutencao = 'não';
        }

        $title = 'Ponto de Controle';
        
        $linhas = linhaProducao::all();
        $setores = setor::all();
        $produtos = produto::all();
        $maquinas = maquina::all();
        $processos = processo::all();

        $data = date('l, d \d\e M \d\e Y');
        if($idempresa > 0){
            $empresas = Empresa::all();
            $empresaSel = Empresa::find($idempresa);
            $listagem = $empresaSel->codigo1.' - '.$empresaSel->nome;
        }else{
            $empresas = '';
            $listagem = 'Dados';
        }
        
        View::share('tipo', $tipo);
        View::share('title', $title);        
        View::share('pagina', $pagina);
        View::share('empresas', $empresas);
        View::share('dados', $dados);
        View::share('data', $data);
        View::share('listagem', $listagem);
        View::share('linhas', $linhas);
        View::share('setores', $setores);
        View::share('produtos', $produtos);
        View::share('maquinas', $maquinas);
        View::share('processos', $processos);
        View::share('manutencao', $manutencao);
        View::share('form', $form);
        View::share('links', $links);
        View::share('anos', $anos);

        return view('global.lista.'.$tipo);
    }
}

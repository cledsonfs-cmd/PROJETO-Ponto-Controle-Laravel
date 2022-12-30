<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

use View;
use DB;
use Carbon\Carbon;
use File;
use Storage;
use DirectoryIterator;

use App\Models\setor;
use App\Models\ProducaoGeral;
use App\Models\ReprogramacaoRetrabalho;
use App\Models\Pop;
use App\Models\PontoControle;
use App\Models\PontoControleDados;

class SetorController extends Controller
{
    public function _setor($id,$data){
        if($data == '')
        {   
            $date = Carbon::now();
        }else{
            $date = Carbon::createFromDate($data);
        }

        $data = $date->format('l, d M Y');

        $anos = array();
        $grafico = array();

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

        
        $producaos = ProducaoGeral::whereRaw("(data >= ? AND data <= ?) and idsetor=? ",[$inicio, $fim, $id])->get();
        $reprogramacaos = ReprogramacaoRetrabalho::select('data,quantidade', DB::raw('data,sum(quantidade) as quantidade'))->whereRaw("(data >= ? AND data <= ?) and idsetor=? and retrabalho=0 ",[$inicio, $fim,$id])->groupby('data')->get();        
        $retrabalhos = ReprogramacaoRetrabalho::select('data,quantidade', DB::raw('data,sum(quantidade) as quantidade'))->whereRaw("(data >= ? AND data <= ?) and idsetor=? and retrabalho=1 ",[$inicio, $fim,$id])->groupby('data')->get();        

        $links = DB::table('producao_gerals')->select('v1,v2,v3', DB::raw('strftime(\'%Y\',data) as v1,strftime(\'%m\',data) as v2,strftime(\'%Y-%m\',data) as v3'))->whereRaw("idsetor = ? ",[$id])->groupBy('v3')->get();            
        foreach ($links as $link) {
            $dateObj = Carbon::createFromDate($date->format('Y'),$link->v2,'01');
            $link->v2 = $dateObj->format('F');
                
            if(in_array($link->v1,$anos) == false)
            {
                array_push($anos, $link->v1);
            }
        }
        $anos = array_reverse($anos, true);
        
        $setor = setor::find($id);
        $pops = Pop::where('idsetor', $id)->get();
        $pontos = PontoControle::where('idsetor', $id)->get();

        $pecas_produzidas = 0;
        $pecas_reprogramadas = 0;
        $pecas_retrabalhadas = 0;

        foreach ($producaos as $dado) {
            $pecas_produzidas += $dado->quantidade;
        }

        foreach ($reprogramacaos as $dado) {
            $pecas_reprogramadas += $dado->quantidade;                       
        }

        foreach ($retrabalhos as $dado) {
            $pecas_retrabalhadas += $dado->quantidade;
        }
        for ($dia=1; $dia <=$ultimo_dia ; $dia++) { 
            $prod =0;
            $ret=0;
            $rep=0;
            foreach ($producaos as $dado) {
                if ($dia == Carbon::createFromDate($dado->data)->format('d')) {
                    $prod += $dado->quantidade;
                }                
            }

            foreach ($reprogramacaos as $dado) {
                if ($dia == Carbon::createFromDate($dado->data)->format('d')) {
                    $rep += $dado->quantidade;
                }                
            }

            foreach ($retrabalhos as $dado) {
                if ($dia == Carbon::createFromDate($dado->data)->format('d')) {
                    $ret += $dado->quantidade;
                }                
            }
            array_push($grafico, ('{x: '.$dia.', y: '.$prod.', z: '.$ret.', w: '.$rep.'}'));
        }        

        View::share('setor', $setor);
        View::share('title', $setor->descricao);
        View::share('pagina', $setor->descricao.' ('.$date->format('M/Y').')');
        View::share('data', $data);
        View::share('data1', $date->format('M/Y'));
        View::share('data2', $date->format('Y-m-d'));
        View::share('anos', $anos);
        View::share('links', $links);
        View::share('pecas_produzidas', $pecas_produzidas);
        View::share('pecas_reprogramadas', $pecas_reprogramadas);
        View::share('pecas_retrabalhadas', $pecas_retrabalhadas);
        View::share('reprogramadas', $reprogramacaos);
        View::share('retrabalhadas', $retrabalhos);
        View::share('retrabalhadas', $retrabalhos);
        View::share('producaos', $producaos);
        View::share('grafico', $grafico);
        View::share('ultimo_dia', $ultimo_dia);
        View::share('pops', $pops);
        View::share('pontos', $pontos);

        return view('setor.base');
    }

    public function _layout($id){
        $setor = setor::find($id);
        $pops = Pop::where('idsetor', $id)->get();
        $pontos = PontoControle::where('idsetor', $id)->get();

        $anos = array();

        $date = Carbon::now();
        $data = $date->format('l, d M Y');

        $links = DB::table('producao_gerals')->select('v1,v2,v3', DB::raw('strftime(\'%Y\',data) as v1,strftime(\'%m\',data) as v2,strftime(\'%Y-%m\',data) as v3'))->whereRaw("idsetor = ? ",[$id])->groupBy('v3')->get();            
        foreach ($links as $link) {
            $dateObj = Carbon::createFromDate($date->format('Y'),$link->v2,'01');
            $link->v2 = $dateObj->format('F');
                
            if(in_array($link->v1,$anos) == false)
            {
                array_push($anos, $link->v1);
            }
        }
        $anos = array_reverse($anos, true);


        $dir_path = public_path() . '/layouts';
        
        $files = File::files($dir_path);

        $dir = new DirectoryIterator($dir_path);
        $layouts = array();
        foreach ($files as $file) {
           if (str_starts_with(basename($file),($id.'-'))) {
                array_push($layouts,basename($file));
            }            
        }

        
        
        View::share('data', $data);
        View::share('data1', $date->format('M/Y'));
        View::share('data2', $date->format('Y-m-d'));
        View::share('setor', $setor);
        View::share('title', $setor->descricao);
        View::share('pagina', 'Layouts: '.$setor->descricao);
        View::share('anos', $anos);
        View::share('links', $links);
        View::share('files', $layouts);
        View::share('pops', $pops);
        View::share('pontos', $pontos);

        return view('setor.layout');
    }

    public function _layout_delete($arquivo,$id){
        $dir_path = public_path() . '/layouts';
        File::delete($dir_path.'/'.$arquivo);
        return redirect('setor_layout/'.$id);
    }

    public function _pontocontrole($id, $idponto, $data){
        $tipo = 'pontocontrole_dados';
        $setor = setor::find($id);
        $pontocontrole = PontoControle::find($idponto);
        $dados = PontoControleDados::where('idponto_controle', $pontocontrole->id)->get();

        $date = Carbon::createFromDate($data);
        $data = $date->format('l, d M Y');

        
        $anos = array();       

        $links = DB::table('ponto_controle_dados')->select('v1,v2,v3', DB::raw('strftime(\'%Y\',data_hora) as v1,strftime(\'%m\',data_hora) as v2,strftime(\'%Y-%m\',data_hora) as v3'))->whereRaw("idponto_controle = ? ",[$pontocontrole->id])->groupBy('v3')->get();            
        foreach ($links as $link) {
            $dateObj = Carbon::createFromDate($date->format('Y'),$link->v2,'01');
            $link->v2 = $dateObj->format('F');
                
            if(in_array($link->v1,$anos) == false)
            {
                array_push($anos, $link->v1);
            }
        }
        $anos = array_reverse($anos, true);

        $title = $setor->descricao.' - '.$pontocontrole->descricao.' ('.$date->format('M/Y').')';

        $total_quantidade = 0;
        $total_peso = 0;
        $total_valor = 0;
        foreach ($dados as $dado) {
            $total_quantidade += $dado->quantidade;
            $total_peso += $dado->peso;
            $total_valor += $dado->valor;
        }
        

        View::share('title', $title);
        View::share('tipo', $tipo);
        View::share('pagina', $title);
        View::share('pontocontrole', $pontocontrole);
        View::share('total_quantidade', $total_quantidade);
        View::share('total_peso', $total_peso);
        View::share('total_valor', $total_valor);
        View::share('data1', $date->format('M/Y'));
        View::share('data2', $date->format('Y-m-d'));
        View::share('dados', $dados);
        View::share('anos', $anos);
        View::share('links', $links);
        View::share('setor', $setor);
        

        return view('setor.pontocontrole');
    }

    public function _listagem($id,$data){
        $date = Carbon::createFromDate($data);
        $tipo = 'pontocontrole_dados';     
        $pagina = 'pontocontrole_dados';

        $pontocontrole = PontoControle::find($id);
        $setor = setor::find($pontocontrole->idsetor);
        
        $title = $setor->descricao.' - '.$pontocontrole->descricao.' ('.$date->format('M/Y').')';
        $dados = PontoControleDados::whereRaw('idponto_controle=? and strftime(\'%Y-%m\',data_hora)=?',[$pontocontrole->id,$date->format('Y-m')])->get();

        $anos = array();       

        $links = DB::table('ponto_controle_dados')->select('v1,v2,v3', DB::raw('strftime(\'%Y\',data_hora) as v1,strftime(\'%m\',data_hora) as v2,strftime(\'%Y-%m\',data_hora) as v3'))->whereRaw("idponto_controle = ? ",[$pontocontrole->id])->groupBy('v3')->get();            
        foreach ($links as $link) {
            $dateObj = Carbon::createFromDate($date->format('Y'),$link->v2,'01');
            $link->v2 = $dateObj->format('F');
                
            if(in_array($link->v1,$anos) == false)
            {
                array_push($anos, $link->v1);
            }
        }
        $anos = array_reverse($anos, true);

        View::share('title', $title);
        View::share('tipo', $tipo);
        View::share('pagina', $pagina);
        View::share('pontocontrole', $pontocontrole);
        View::share('setor', $setor);
        View::share('data1', $date->format('M/Y'));
        View::share('data2', $date->format('Y-m-d'));
        View::share('dados', $dados);
        View::share('anos', $anos);
        View::share('links', $links);

        return view('setor.lista.pontocontrole');
    }

    public function _listagem_pesquisa(Request $request){
        $date = Carbon::createFromDate($request->input('data'));
        $tipo = 'pontocontrole_dados';    
        $pagina = 'pontocontrole_dados';
        

        $pontocontrole = PontoControle::find($request->input('id'));
        $setor = setor::find($pontocontrole->idsetor);
        
        $title = $setor->descricao.' - '.$pontocontrole->descricao.' ('.$date->format('M/Y').')';
        $dados = PontoControleDados::whereRaw('idponto_controle=? and strftime(\'%Y-%m\',data_hora)=?',[$pontocontrole->id,$date->format('Y-m')])->get();

        $anos = array();       

        $links = DB::table('ponto_controle_dados')->select('v1,v2,v3', DB::raw('strftime(\'%Y\',data_hora) as v1,strftime(\'%m\',data_hora) as v2,strftime(\'%Y-%m\',data_hora) as v3'))->whereRaw("idponto_controle = ? ",[$pontocontrole->id])->groupBy('v3')->get();            
        foreach ($links as $link) {
            $dateObj = Carbon::createFromDate($date->format('Y'),$link->v2,'01');
            $link->v2 = $dateObj->format('F');
                
            if(in_array($link->v1,$anos) == false)
            {
                array_push($anos, $link->v1);
            }
        }
        $anos = array_reverse($anos, true);

        View::share('title', $title);
        View::share('tipo', $tipo);
        View::share('pagina', $pagina);
        View::share('pontocontrole', $pontocontrole);
        View::share('setor', $setor);
        View::share('data1', $date->format('M/Y'));
        View::share('data2', $date->format('Y-m-d'));
        View::share('dados', $dados);
        View::share('anos', $anos);
        View::share('links', $links);

        return view('setor.lista.pontocontrole');
    }
}

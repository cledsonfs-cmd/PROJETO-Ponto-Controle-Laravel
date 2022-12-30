<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use View;
use DB;

use Illuminate\Http\Request;
use App\Http\Requests;

use App\Models\Empresa;
use App\Models\Carteira;
use App\Models\Faturamento;
use App\Models\Devolucao;
use App\Models\setor;

class IndexController extends Controller
{
    
    public function index(){

        $date = Carbon::now();

        $pagina = "Início";
        $title = 'Ponto de Controle';
        $graficofat = array();
        $graficodev = array();
        $graficorep = array();
        $date = Carbon::now();
        $inicio = $date->format('Y-m-').'01';
        $fim = Carbon::now()->format('Y-m-d');
        
        $empresas = Empresa::all();
        $setores = setor::all();

        //carteira        
        $carteiras = DB::table('carteiras')->select('idempresa,valor,data', DB::raw('idempresa,valor,data'))->where('data',$date->toDateString())->get();            
        $atualf = DB::table('faturamentos')->select('idempresa,valor', DB::raw('idempresa,sum(valor) as valor'))->whereRaw("(data >= ? AND data <= ?)",[$inicio, $fim])->groupby('idempresa')->get();            
        
        //faturamento
        $dadosfat = Faturamento::whereRaw("(data >= ? AND data <= ?)",[$inicio, $fim])->get();
        $linhaf = '';
            for ($dia=1; $dia <=$date->format('t') ; $dia++) { 
                foreach ($empresas as $empresa) {
                    foreach ($dadosfat as $dado) {
                        if($empresa->id == $dado->idempresa && Carbon::createFromDate($dado->data)->format('d') == $dia)
                        {                            
                            $linhaf = '{x:'.$dia.','.$empresa->id.':'.$dado->valor.'},';
                        }
                    }
                    if($linhaf ==  '{x:'.$dia.','.$empresa->id.':0},'){
                        array_push($graficofat, $linhaf);    
                    }
                    else {
                        array_push($graficofat, $linhaf);    
                        $linhaf = '';
                    }
                    
                }
            }

        //devolucao
        $graficodev = DB::table('devolucaos')->select('tipo,valor', DB::raw('tipo,sum(valor) as valor'))->whereRaw("(data_devolucao >= ? AND data_devolucao <= ?)",[$inicio, $fim])->groupby('tipo')->get();

        //reprogramacao_retrabalho
        $graficorep = DB::table('reprogramacao_retrabalhos')->select('retrabalho,valor', DB::raw('retrabalho,sum(custo) as valor'))->whereRaw("(data >= ? AND data <= ?)",[$inicio, $fim])->groupby('retrabalho')->get();

        View::share('title', $title);
        View::share('pagina', $pagina);
        View::share('empresas', $empresas);
        View::share('carteiras', $carteiras);
        View::share('setores', $setores);        
        View::share('atualf', $atualf);
        View::share('graficofat', $graficofat);
        View::share('graficodev', $graficodev);
        View::share('graficorep', $graficorep);
        
        return view('index');
        
    }
}

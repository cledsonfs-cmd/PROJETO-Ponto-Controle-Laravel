<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use View;
use DB;
use App\Models\Empresa;
use App\Models\linhaProducao;
use App\Models\MateriaPrima;
use App\Models\motivoReprogramacao;
use App\Models\Operador;
use App\Models\setor;
use App\Models\processo;
use App\Models\produto;
use App\Models\Carteira;
use App\Models\Faturamento;
use App\Models\PrazoEntrega;
use App\Models\Devolucao;
use App\Models\ReprogramacaoRetrabalho;
use App\Models\ProducaoGeral;
use App\Models\maquina;
use App\Models\PontoControle;

class AdminController extends Controller
{
    public function _index(){
        $pagina = 'Admin';
        $title = 'Ponto de Controle';        
        View::share('title', $title);
        View::share('pagina', $pagina);        
        return view('admin');        
    }

    public function _pagina($tipo){
        if($tipo == 'empresa'){
            $pagina = 'Empresa';            
            $form = 'empresa';
            $objetos = Empresa::all();             
        }else if($tipo == 'linhaproducao'){
            $pagina = 'Linha de Produção';            
            $form = 'linhaproducao';
            $objetos = linhaProducao::all();            
        }else if($tipo == 'operador'){
            $pagina = 'Operador';            
            $form = 'operador';  
            $objetos = Operador::all();
        }else if($tipo == 'materiaprima'){
            $pagina = 'Materia Prima';
            $form = 'materiaprima';
            $objetos = MateriaPrima::all();
        }else if($tipo == 'motivoreprogramacao'){
            $pagina = 'Motivo Reprogramacao';  
            $form = 'motivoreprogramacao';
            $objetos = motivoReprogramacao::all();
        }else if($tipo == 'processo'){
            $pagina = 'Processo';
            $form = 'processo';
            $objetos = Processo::all();
            $setores = Setor::all();        
            View::share('setores', $setores);
        }else if($tipo == 'setor'){
            $pagina = 'Setor';        
            $form = 'setor';
            $objetos = Setor::all();
        }else if($tipo == 'maquina'){
            $pagina = 'Maquina';        
            $form = 'maquina';
            $objetos = maquina::all();            
        }else if($tipo == 'produto'){
            $pagina = 'Produto';
            $form = 'produto';
            $objetos = produto::all();
            $linhas = linhaProducao::all();        
            View::share('linhas', $linhas);
        }else if($tipo == 'pontocontrole'){
            $pagina = 'Pontos de Controle';
            $title = 'Ponto de Controle';  
            $objetos = PontoControle::all();
            $setores = setor::all();
            View::share('title', $title);
            View::share('pagina', $pagina);        
            View::share('setores', $setores);        
        }
        $title = 'Ponto de Controle'; 
        
        View::share('title', $title);
        View::share('pagina', $pagina); 
        View::share('form', $tipo);
        View::share('objetos', $objetos);  

        return view('admin.'.$tipo);        
    }

    public function _cargadados(){
        
            $regcarteira = Carteira::all()->count();
            $regfaturamento = Faturamento::all()->count();
            $regprazo_entrega = PrazoEntrega::all()->count();
            $regprazo_devolucao = Devolucao::all()->count();
            $regreprogramacao_retrabalho = ReprogramacaoRetrabalho::all()->count();
            $regproducao_geral = ProducaoGeral::all()->count();

            $pagina = "Carga Dados";
            $title = 'Ponto de Controle';
            $empresas = Empresa::all();
            $setores = setor::all();
            
            
            View::share('title', $title);
            View::share('pagina', $pagina);
            View::share('empresas', $empresas);
            View::share('registroscarteira', $regcarteira);
            View::share('registrosfaturamento', $regfaturamento);
            View::share('registrosprazo_entrega', $regprazo_entrega);
            View::share('registrosdevolucao', $regprazo_devolucao);
            View::share('registrosreprogramacao_retrabalho', $regreprogramacao_retrabalho);
            View::share('registrosproducao_geral', $regproducao_geral);
            View::share('setores', $setores);
            
            return view('admin.cargadados'); 
        
    }
    
}

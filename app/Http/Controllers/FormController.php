<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;

use Carbon\Carbon;
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
use App\Models\Devolucao;
use App\Models\Faturamento;
use App\Models\PrazoEntrega;
use App\Models\ProducaoGeral;
use App\Models\ReprogramacaoRetrabalho;
use App\Models\FolhaObservacao;
use App\Models\maquina;
use App\Models\FolhaElemento;
use App\Models\Tarefa;
use App\Models\Procedimento;
use App\Models\Pop;
use App\Models\PontoControle;
use App\Models\PontoControleDados;

class FormController extends Controller
{
    public function _novo($tipo, $pagina){
          $manutencao = 'sim';
          $form = 'sim';
          $title = 'Ponto de Controle';        
          $data = date('l, d \d\e M \d\e Y'); 
          $date = Carbon::now();          
          $anos = array();
          $links = "";
          $dados = "";

          if($tipo == 'empresa'){
            $obj = new Empresa();          
          } else if($tipo == 'linhaproducao'){
            $obj = new linhaProducao();           
          } else if($tipo == 'materiaprima'){
            $obj = new MateriaPrima();          
          } else if($tipo == 'motivoreprogramacao'){
            $obj = new motivoReprogramacao();                                           
          } else if($tipo == 'operador'){
            $obj = new Operador();                                         
          } else if($tipo == 'processo'){
            $obj = new processo();  
            $setores = setor::all();     
            View::share('setores', $setores);  
          } else if($tipo == 'produto'){
            $obj = new produto();     
            $linhas = linhaProducao::all();  
            View::share('linhas', $linhas);        
          } else if($tipo == 'setor'){
            $obj = new setor();                                                  
          } else if($tipo == 'carteira'){
            $obj = new Carteira();   
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

          } else if($tipo == 'devolucao'){
            $obj = new Devolucao();
            $produtos = produto::all();     
            View::share('produtos', $produtos);                                                 
          } else if($tipo == 'faturamento'){
            $obj = new Faturamento();    
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
          } else if($tipo == 'prazo_entrega'){
            $obj = new PrazoEntrega();    
            $linhas = linhaProducao::all();              
            View::share('linhas', $linhas); 
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
          } else if($tipo == 'producao_geral'){
            $obj = new ProducaoGeral();                                                  
          } else if($tipo == 'reprogramacao_retrabalho'){
            $obj = new ReprogramacaoRetrabalho();  
            $setores = setor::all();     
            View::share('setores', $setores);                                                   
            $motivos = motivoReprogramacao::all();     
            View::share('motivos', $motivos);
            $produtos = produto::all();     
            View::share('produtos', $produtos);
          } else if($tipo == 'maquina'){
            $obj = new maquina();
          } else if($tipo == 'elemento_folha'){
            $obj = new FolhaElemento();
            $id = $pagina;            
            $pagina = 'Elemento Folha';
            $folha = FolhaObservacao::find($id);
            $texto = '';

            View::share('folha', $folha);
            View::share('texto', $texto);           
          } else if($tipo == 'folha_observacoes'){
            $tipo = 'folha_observacao';
            $pagina = 'Folha de Observações';
            $texto = '';
            
            $obj = new FolhaObservacao();  
            $processos = processo::all();
            $maquinas = maquina::all();
            $operadores = Operador::all();
            $materiais = MateriaPrima::all();
            
            View::share('processos', $processos);
            View::share('maquinas', $maquinas);
            View::share('texto', $texto);
            View::share('operadores', $operadores);             
            View::share('materiais', $materiais);  
          } else if($tipo == 'pop'){
            $tipo = 'pop';
            $pagina = 'Procedimentos Operacionais Padrão';
            $texto = '';
            
            $obj = new Pop();  
            $setores = setor::all();           
            
            View::share('setores', $setores);
            View::share('texto', $texto);
          } else if($tipo == 'tarefa'){
            $obj = new Tarefa();
            $tipo = 'tarefa';
            $idpop = $pagina;
            $pop = Pop::find($idpop);

            $pagina = 'Tarefa para: '.$pop->codigo;
            $texto = '';

            View::share('texto', $texto);
            View::share('idpop', $pop->id);
          } else if($tipo == 'procedimento'){
            $obj = new Procedimento();
            $tipo = 'procedimento';
            $idtarefa = $pagina;
            $tarefa = Tarefa::find($idtarefa);
            $pagina = 'Procedimento para: '.$tarefa->descricao;
            $texto = '';

            View::share('texto', $texto);   
            View::share('idtarefa', $tarefa->id);
            View::share('idpop', $tarefa->idpop);
          } else if($tipo == 'pontocontrole'){
            $obj = new PontoControle();
            $tipo = 'pontocontrole';
            $pagina = 'Pronto de Controle';
            $texto = '';
            $setores = setor::all();

            
            View::share('setores', $setores);
          } else if($tipo == 'pontocontrole_dados'){
            $obj = new PontoControleDados();
            $tipo = 'pontocontrole_dados';
            $pontocontrole = PontoControle::find($pagina);
            $setor = setor::find($pontocontrole->idsetor);
            $pagina = 'Pronto de Controle';
            $texto = '';
            $setores = setor::all();

            
            View::share('pontocontrole', $pontocontrole);
            View::share('setor', $setor);
            View::share('data2', $date->format('Y-m-d'));
          }
        
          $empresas = Empresa::all();

          View::share('title', $title);
          View::share('pagina', $pagina);
          View::share('objeto', 'Novo');
          View::share('obj', $obj);
          View::share('data', $data);
          View::share('tipo', $tipo);
          View::share('empresas', $empresas); 
          View::share('manutencao', $manutencao);
          View::share('form', $form);
          View::share('anos', $anos);
          View::share('links', $links);          

        return view('forms.'.$tipo);        
    }

    public function _update($tipo, $pagina,$id){
        $title = 'Ponto de Controle';
        $data = date('l, d \d\e M \d\e Y'); 
        $manutencao = 'sim';
        $form = 'sim';
        $date = Carbon::now();          
        $anos = array();
        $links = "";
        $dados = "";
        
        if($tipo == 'empresa'){
            $obj = Empresa::find($id);           
        } else if($tipo == 'linhaproducao'){
            $obj = linhaProducao::find($id);           
        } else if($tipo == 'materiaprima'){
            $obj = MateriaPrima::find($id);           
        } else if($tipo == 'motivoreprogramacao'){
            $obj = motivoReprogramacao::find($id);                                           
        } else if($tipo == 'operador'){
            $obj = Operador::find($id);                                         
        } else if($tipo == 'processo'){
            $obj = processo::find($id);  
            $setores = setor::all();     
            View::share('setores', $setores);           
        } else if($tipo == 'setor'){
            $obj = setor::find($id);                                                  
        } else if($tipo == 'produto'){
            $obj = produto::find($id);  
            $linhas = linhaProducao::all();  
            View::share('linhas', $linhas);                                                
        } else if($tipo == 'carteira'){
            $obj = Carteira::find($id);  
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
        } else if($tipo == 'devolucao'){
            $obj = Devolucao::find($id);  
        } else if($tipo == 'faturamento'){
            $obj = Faturamento::find($id);  
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
        } else if($tipo == 'prazo_entrega'){
            $obj = PrazoEntrega::find($id);  
            $linhas = linhaProducao::all();  
            View::share('linhas', $linhas);        
        } else if($tipo == 'reprogramacao_retrabalho'){
            $obj = ReprogramacaoRetrabalho::find($id);  
            $setores = setor::all();     
            View::share('setores', $setores);                                                   
            $motivos = motivoReprogramacao::all();     
            View::share('motivos', $motivos);
            $produtos = produto::all();     
            View::share('produtos', $produtos);      
        } else if($tipo == 'maquina'){
            $obj = maquina::find($id);
        } else if($tipo == 'folha_observacoes'){
            $tipo = 'folha_observacao';
            $pagina = 'Folha de Observações';
            $texto = '';
            
            $obj = FolhaObservacao::find($id);   
            $processos = processo::all();
            $maquinas = maquina::all();
            $operadores = Operador::all();
            $materiais = MateriaPrima::all();
            
            View::share('processos', $processos);
            View::share('maquinas', $maquinas);
            View::share('texto', $texto);
            View::share('operadores', $operadores);             
            View::share('materiais', $materiais); 

        } else if($tipo == 'elemento_folha'){
            $obj = FolhaElemento::find($id);
            $pagina = 'Elemento Folha';
            $folha = FolhaObservacao::find($obj->idfolhaobservacao);
            $texto = '';

            View::share('folha', $folha);
            View::share('texto', $texto);
        } else if($tipo == 'pop'){            
            $pagina = 'Procedimentos Operacionais Padrão';
            $texto = '';
            
            $obj = Pop::find($id);  
            $setores = setor::all();           
            
            View::share('setores', $setores);  
            View::share('texto', $texto);
        
        } else if($tipo == 'tarefa'){
            $obj = Tarefa()::find($id);
            $tipo = 'tarefa';
            $idpop = $pagina;
            $pop = Pop::find($idpop);

            $pagina = 'Tarefa para: '.$pop->codigo;
            $texto = '';

            View::share('texto', $texto);
            View::share('pop', $pop);
          } else if($tipo == 'procedimento'){
            $obj = Procedimento::find($id);
            $tipo = 'procedimento';
            $tarefa = Tarefa::find($obj->idtarefa);
            $pagina = 'Procedimento para: '.$tarefa->descricao;
            $texto = '';

            View::share('texto', $texto);   
            View::share('tarefa', $tarefa);    
        } else if($tipo == 'pontocontrole'){
            $obj = PontoControle::find($id);
            $tipo = 'pontocontrole';
            $pagina = 'Pronto de Controle';
            $texto = '';
            $setores = setor::all();

            
            View::share('setores', $setores);
        
        } else if($tipo == 'pontocontrole_dados'){
            $obj = PontoControleDados::find($id);
            $tipo = 'pontocontrole_dados';
            $pontocontrole = PontoControle::find($obj->idponto_controle);
            $setor = setor::find($pontocontrole->idsetor);
            $pagina = 'Pronto de Controle';
            $texto = '';
            $setores = setor::all();

            
            View::share('pontocontrole', $pontocontrole);
            View::share('setor', $setor);
            View::share('data2', $date->format('Y-m-d'));
        }

        $empresas = Empresa::all();

        View::share('title', $title);
        View::share('tipo', $tipo);
        View::share('objeto', 'Atualizar');
        View::share('obj', $obj);
        View::share('data', $data);
        View::share('pagina', $pagina);
        View::share('empresas', $empresas); 
        View::share('manutencao', $manutencao);
        View::share('form', $form);
        View::share('anos', $anos);
        View::share('links', $links);          

        return view('forms.'.$tipo);
    }
}

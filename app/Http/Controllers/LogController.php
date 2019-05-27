<?php

namespace App\Http\Controllers;

use App\Entities\log;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LogController extends Controller
{

    private $log;

    public function __construct(Log $log)
    {
      $this->log = $log;
    }

    public function index(Request $request)
    {

        $datainicial = $request->query('datainicial');
        $datafinal = $request->query('datafinal');

        if($datainicial && $datafinal) {
            $data = $this->log->where('data_hora', '>=', $datainicial)->where('data_hora', '<=', $datafinal)->get();

        } elseif (!$datainicial && $datafinal) {
            $data = $this->log->whereDate('data_hora', '<=', $datafinal)->get();

        } elseif (!$datafinal && $datainicial) {
            $data = $this->log->whereDate('data_hora', '>=', $datainicial)->get();

        } else {
            $data = $this->log->all();
        }

        return response()->json($data, 200);

    }

    public function store(Request $request)
    {
      try {

         if ( !$request->tipo || ( $request->tipo !== "INFO" &&  $request->tipo !== "WARNING" &&  $request->tipo !== "DEBUG" &&  $request->tipo !== "ERROR" ) ) {
           $codigo = 500;
           $return = ['msg' => 'Campo tipo com valor =' . $request->tipo . ' invalido'];
         } elseif ( !$request->usuario ) {
           $codigo = 500;
           $return = ['msg' => 'Campo usuario nao foi informado'];
         } elseif ( !$request->aplicacao ) {
           $codigo = 500;
           $return = ['msg' => 'Campo aplicacao nao foi informado'];
         } elseif ( !$request->mensagem ) {
           $codigo = 500;
           $return = ['msg' => 'Campo mensagem nao informado'];
         } elseif ( !$request->data_hora ) {
           $codigo = 500;
           $return = ['msg' => 'Campo data_hora nao informado'];
         } else {
            $codigo = 200;
            $return = ['msg' =>'Sucesso!'];
            $productData = $request->all();
            $this->log->create($productData);
         }

         return response()->json($return, $codigo);

  		} catch (\Exception $e) {
  			 return response()->json($e->getMessage(), 500);
      }
    }
}

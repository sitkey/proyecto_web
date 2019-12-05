<?php

namespace App\Http\Controllers;
use App\Trainer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;

class pokeController extends Controller
{
    public function comparar(Request $request)
    {
        if($request->ajax()){
            $aux='no';
            $users = DB::table('trainers')->get();
            
            foreach ($users as $user) {
                if($request->name==$user->name && $request->password==$user->password){
                    $aux='si';
                }
            }
            return $aux;
        }
        
    }
    public function editar(Request $request)
    {
        if($request->ajax()){
            DB::table('pokemons')
            ->join('trainers', 'pokemons.id_trainer', '=', 'trainers.id')
            ->where('name', $request->name)
            ->update(['p1' => $request->equipo[0], 'p2' => $request->equipo[1],
            'p3' => $request->equipo[2], 'p4' => $request->equipo[3], 'p5' => $request->equipo[4]
            ,'p6' => $request->equipo[5]]);
            return $request->equipo;
        }
        
    }
    public function cargar(Request $request)
    {
        if($request->ajax()){
            $users = DB::table('pokemons')
            ->select('p1','p2','p3','p4','p5','p6')
            ->join('trainers', 'pokemons.id_trainer', '=', 'trainers.id')
            ->where('name', $request->name)
            ->get();
            foreach ($users as $user) {
            }
            return (json_encode($user));
        }
        
    }
}

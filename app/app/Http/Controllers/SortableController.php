<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sortable;

class SortableController extends Controller
{
    public function index(){
        $sortable = Sortable::orderBy('id', 'asc')->get();
        return view('sortable', [
          'sortables' => $sortable
        ]);
      }
    public function register(Request $request){
        $sortable=new Sortable;
        $sortable->name=$request->inputName;
        $sortable->save();
        return redirect('/sortable');
    }
    public function update(Request $request){
        $inputs   = $request->all();
        $s        = new Sortable;
        $sortable = $s->find($inputs['id']);
        $sortable->left_x = $inputs['left'];
        $sortable->top_y  = $inputs['top'];
        $sortable->save();

        return redirect('/sortable');
      }
}
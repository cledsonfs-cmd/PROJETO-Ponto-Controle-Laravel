<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ImageUploadController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function imageUpload()
    {
        return view('imageUpload');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function imageUploadPost(Request $request)
    {
        $request->validate(['image' => 'required|image|mimes:jpeg,png,jpg|max:2048',]);    
        if ($request->tipo == 'layout') {            
            $imageName = $request->id.'-'.$request->image->getClientOriginalName();       
            $request->image->move(public_path('layouts'), $imageName);
        }elseif ($request->tipo == 'fluxo') {        
            $imageName = $request->image->getClientOriginalName();       
            $request->image->move(public_path('fluxos'), $imageName);
        }elseif ($request->tipo == 'pop') {
            $imageName = $request->id.'.'.$request->image->extension();       
            $request->image->move(public_path('pop'), $imageName);
        }
        
  
        /* Store $imageName name in DATABASE from HERE */
    
        return back()
            ->with('success','You have successfully upload image.')
            ->with('image',$imageName); 
    }
}

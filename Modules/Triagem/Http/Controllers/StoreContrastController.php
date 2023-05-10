<?php

namespace Modules\Triagem\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Triagem\Entities\Term;
use Modules\Triagem\Entities\TermFile;
use Illuminate\Support\Facades\Storage;

class StoreContrastController extends Controller
{

    public function storeContrastRessonancia($id, Request $request)
    {
        $hoje = date('d-m-Y');

        $term = Term::find($id);

        $term->contrast = 1;
        $term->save();


        #SALVA PRINT
        if ($request->dataurl) {
            $img = $request->dataurl;
            $image_parts = explode(";base64,", $img);
            $image_type_aux = explode("image/", $image_parts[0]);
            $image_type = $image_type_aux[1];

            $bin = base64_decode($image_parts[1]);
            Storage::disk('my_files')->put("storage/termos/$term->patient_name/RM/$hoje/contraste-$term->patient_name.jpeg", $bin);
            $path = "storage/termos/$term->patient_name/RM/$hoje/contraste-$term->patient_name.jpeg";

            $termfile = TermFile::updateOrInsert([
                'url' => $path,
                'term_id' => $term->id,
                'file_type_id' => 4
            ]);
        }

        if($termfile)
        return redirect('triagem/realizadas/ressonancia')->with('success', 'Formulário de contraste salvo com sucesso!');
        else
        return redirect()->back()->withErrors(['Ocorreu um erro ao salvar o formulário!']);
    }
}

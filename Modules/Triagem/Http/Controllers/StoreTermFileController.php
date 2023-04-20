<?php

namespace Modules\Triagem\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Triagem\Entities\Term;
use Modules\Triagem\Entities\TermFile;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class StoreTermFileController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function storeTermoRessonancia(Request $request, $id)
    {
        $hoje = date('d-m-Y');
        $term = Term::find($id);

        #ARMAZENA PRINT DO TERMO DE CONSTRASTE
        if ($request->dataurl) {
            $img = $request->dataurl;
            $image_parts = explode(";base64,", $img);
            $image_type_aux = explode("image/", $image_parts[0]);
            $image_type = $image_type_aux[1];

            $bin = base64_decode($image_parts[1]);
            Storage::disk('my_files')->put("storage/termos/$term->patient_name/RM/$hoje/termo-$term->patient_name.jpeg", $bin);
            $path = "storage/termos/$term->patient_name/RM/$hoje/termo-$term->patient_name.jpeg";

            TermFile::create([
                'url' => $path,
                'term_id' => $term->id,
                'file_type_id' => 3
            ]);
        }

        return view('triagem::ressonancia.tele-laudo', compact('term'));
    }

    public function storeTermoTeleLaudo(Request $request, $id)
    {
        $hoje = date('d-m-Y');
        $term = Term::find($id);

        #ARMAZENA PRINT DO TERMO DE CONSTRASTE
        if ($request->dataurl) {
            $img = $request->dataurl;
            $image_parts = explode(";base64,", $img);
            $image_type_aux = explode("image/", $image_parts[0]);
            $image_type = $image_type_aux[1];

            $bin = base64_decode($image_parts[1]);
            Storage::disk('my_files')->put("storage/termos/$term->patient_name/RM/$hoje/telelaudo-$term->patient_name.jpeg", $bin);
            $path = "storage/termos/$term->patient_name/RM/$hoje/telelaudo-$term->patient_name.jpeg";

            $termfile = TermFile::create([
                'url' => $path,
                'term_id' => $term->id,
                'file_type_id' => 2
            ]);
        }

        if($termfile)
        return redirect('triagem')->with('success','Triagem realizada com sucesso!');
        else
        return redirect()->back()->withErrors(['Ocorreu um erro ao salvar o arquivo.']);
    }
}

<?php

namespace Modules\Triagem\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Triagem\Entities\Term;
use Modules\Triagem\Entities\TermFile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class StoreContrasteController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function __invoke(Request $request, $id)
    {
        $hoje = date('d-m-Y');
        $term = Term::find($id);
        $update = DB::table('terms')
            ->where('id', $term->id)
            ->update([
                'contrast' => 1,
                'observation' => $request->observacao
            ]);

        #ARMAZENA PRINT DO FORMULARIO DE CONSTRASTE
        if ($request->dataurlcontraste) {
            $img = $request->dataurlcontraste;
            $image_parts = explode(";base64,", $img);
            $image_type_aux = explode("image/", $image_parts[0]);
            $image_type = $image_type_aux[1];

            $bin = base64_decode($image_parts[1]);
            Storage::disk('my_files')->put("storage/termos/$term->patient_name/RM/$hoje/contraste-$term->patient_name.jpeg", $bin);
            $path = "storage/termos/$term->patient_name/RM/$hoje/contraste-$term->patient_name.jpeg";

            TermFile::create([
                'url' => $path,
                'term_id' => $term->id,
                'file_type_id' => 4
            ]);
        }

        if ($update)
            return redirect('triagem/terms/realizadas')->with('success', 'Contraste aplicado com sucesso!');
        else
            return redirect()->back()->withErrors(['Ocorreu um erro ao salvar']);
    }
}

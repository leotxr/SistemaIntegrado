<?php

namespace Modules\Triagem\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Triagem\Entities\Term;
use Modules\Triagem\Entities\TermFile;
use Modules\Triagem\Entities\Sector;
use Illuminate\Support\Facades\Storage;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\User;

class StoreContrastController extends Controller
{

    public function storeContrast($id, Request $request)
    {
        $hoje = date('d-m-Y');

        $term = Term::find($id);

        $term->contrast = 1;
        $term->save();

        $setor = Sector::find($term->sector_id);

/*
        #SALVA PRINT
        if ($request->dataurl) {
            $img = $request->dataurl;
            $image_parts = explode(";base64,", $img);
            $image_type_aux = explode("image/", $image_parts[0]);
            $image_type = $image_type_aux[1];

            $bin = base64_decode($image_parts[1]);
            Storage::disk('my_files')->put("storage/termos/$term->patient_name/$setor->name/$hoje/contraste-$term->patient_name.jpg", $bin);
            //$path = "storage/termos/$term->patient_name/$setor->name/$hoje/contraste-$term->patient_name.jpg";

            $termfile = TermFile::updateOrInsert([
                'url' => $path,
                'term_id' => $term->id,
                'file_type_id' => 4
            ]);
        }

*/

        for ($i = 1; $i <= count($request->pergunta); $i++) {

            //$teste[$i] = ['id' => $i, 'pergunta' => $request->pergunta[$i], 'resposta' => $request->resposta[$i]];
            $collection[$i] = collect(['pergunta' => $request->pergunta[$i], 'quant' => $request->quant[$i], 'disp' => $request->disp[$i], 'membro' => $request->membro[$i], 'via' => $request->via[$i], 'lote' => $request->lote[$i], 'validade' => $request->validade[$i]]);
            
        };

        for($j = 1; $j <= count($request->pergunta2); $j++)
        {
            $collection2[$j] = collect(['pergunta' => $request->pergunta2[$j], 'radio' => $request->radio[$j], 'observacao' => $request->observacao[$j]]);
        };
    
        
        $pdf = PDF::loadView('triagem::PDF.pdf-contraste', ['collection' => $collection, 'collection2' => $collection2, 'title' => "Formulário de contraste para realização de $setor->name", 'term' => $term, 'medico' => User::find($request->medico)]);
        $save = Storage::disk('my_files')->put("storage/termos/$term->patient_name/$setor->name/$hoje/contraste-$term->patient_name.pdf", $pdf->output());
        $path = "storage/termos/$term->patient_name/$setor->name/$hoje/contraste-$term->patient_name.pdf";

        if($path)
        {
           $termfile = TermFile::updateOrInsert([
                'url' => $path,
                'term_id' => $term->id,
                'file_type_id' => 4
            ]);
        }else return redirect()->back()->with('error', 'Ocorreu um erro!');

        if($save && $termfile)
        return redirect('triagem')->with('success', 'Formulário de contraste salvo com sucesso!');
        else
        return redirect()->back()->withErrors(['Ocorreu um erro ao salvar o formulário!']);
        
    }




    public function storeContrastTomografia($id, Request $request)
    {
        $hoje = date('d-m-Y');

        $term = Term::find($id);

        $term->contrast = 1;
        $term->save();

        $setor = Sector::find($term->sector_id);

        #SALVA PRINT
        if ($request->dataurl) {
            $img = $request->dataurl;
            $image_parts = explode(";base64,", $img);
            $image_type_aux = explode("image/", $image_parts[0]);
            $image_type = $image_type_aux[1];

            $bin = base64_decode($image_parts[1]);
            Storage::disk('my_files')->put("storage/termos/$term->patient_name/$setor->name/$hoje/contraste-$term->patient_name.jpg", $bin);
            $path = "storage/termos/$term->patient_name/$setor->name/$hoje/contraste-$term->patient_name.jpg";

            $termfile = TermFile::updateOrInsert([
                'url' => $path,
                'term_id' => $term->id,
                'file_type_id' => 4
            ]);
        }

        if($termfile)
        return redirect('triagem/realizadas/tomografia')->with('success', 'Formulário de contraste salvo com sucesso!');
        else
        return redirect()->back()->withErrors(['Ocorreu um erro ao salvar o formulário!']);
    }
}

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
use Modules\Triagem\Entities\FileType;

class StoreTermController extends Controller
{
    public function storeRM(Request $request)
    {
        $hoje = date('d-m-Y');
        $nascimento = $request->nascimento;

        $start = strtotime($request->start);
        $end = date('H:i:s');
        $end_convert = strtotime($end);

        $tempo = gmdate('H:i:s', $end_convert - $start);

        $user_id = Auth::user()->id;



        $term = Term::create([
            'patient_name' => $request->nome ?? NULL,
            'patient_id' => $request->pacienteid ?? NULL,
            'user_id' => $user_id ?? NULL,
            'patient_age' => $request->patient_age ?? NULL,
            'proced' => $request->procedimento ?? NULL,
            'start_hour' => $request->start,
            'final_hour' => $end,
            'time_spent' => $tempo,
            'exam_date' => $request->exam_date,
            'observation' => $request->observacao

        ]);

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

        #ARMAZENA PRINT DO TERMO TELELAUDO
        if ($request->dataurltele) {
            $img = $request->dataurltele;
            $image_parts = explode(";base64,", $img);
            $image_type_aux = explode("image/", $image_parts[0]);
            $image_type = $image_type_aux[1];

            $bin = base64_decode($image_parts[1]);
            Storage::disk('my_files')->put("storage/termos/$term->patient_name/RM/$hoje/telelaudo-$term->patient_name.jpeg", $bin);
            $path = "storage/termos/$term->patient_name/RM/$hoje/telelaudo-$term->patient_name.jpeg";

            TermFile::create([
                'url' => $path,
                'term_id' => $term->id,
                'file_type_id' => 2
            ]);
        }


        if ($term)
            return redirect('triagem/terms/realizadas')->with('success', 'Triagem salva com sucesso!');
        else
            return redirect('triagem/terms/realizadas')->with('error', 'Ocorreu um erro!');

    }

    public function storeTC(Request $request)
    {

    }
}

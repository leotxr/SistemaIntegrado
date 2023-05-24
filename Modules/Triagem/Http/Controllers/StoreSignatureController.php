<?php

namespace Modules\Triagem\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Triagem\Entities\Term;
use Modules\Triagem\Entities\TermFile;
use Modules\Triagem\Entities\Sector;


class StoreSignatureController extends Controller
{
    public function storeSignature($id, Request $request)
    {
        $hoje = date('d-m-Y');
        $term = Term::find($id);
        $setor = Sector::find($term->sector_id);

        $file = $request->file('signature_file');
        $image = imagecreatefromjpeg($file);
        $percent = 0.1;
        list($width, $height) = getimagesize($file);
        $new_width = $width * $percent;
        $new_height = $height * $percent;

        if ($image && imagefilter($image, IMG_FILTER_CONTRAST, -100)) {
            //imagefilter($image, IMG_FILTER_BRIGHTNESS, 10);

            $image_p = imagecreatetruecolor($new_width, $new_height);

            $white = imagecolorallocate($image_p, 255, 255, 255);

            imagecopyresampled($image_p, $image, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
            imagecolortransparent($image_p, $white);
            $path = "storage/termos/$term->patient_name/$setor->name/$hoje/assinatura-$term->patient_name.png";

            imagepng($image_p, $path);

            TermFile::updateOrInsert([
                'url' => $path,
                'term_id' => $term->id,
                'file_type_id' => 5
            ]);

            
            $term->signed = 1;
            $term->save();


            return redirect()->route('create.term-signature', ['id' => $term->id, 'path' => $path])->with('success', 'Assinatura inserida com sucesso!');
        } else {
            echo 'Grayscale conversion of image failed.';
        }
    }
}

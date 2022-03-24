<?php 

namespace App\Common;

use App\Models\Pdf;
use Illuminate\Support\Facades\File;

trait HasPdf
{
    public function pdfable()
    {
        return $this->morphTo();
    }

    public function pdf()
    {
        return $this->morphOne(Pdf::class, 'pdfable');
    }
    
    public function hasPdf()
    {
        return (bool) $this->pdf()->count();
    }

    public function savePdf($request)
    {
        $path = public_path('tmp/pdf');

        if ( ! File::exists($path) ) {
            mkdir($path, 0777, true);
        }

        return $this->createOrUpdatePdf($request,$path);
    }

    private function createOrUpdatePdf($request,$path)
    {   
        if(! $request->has('pdf') ) {
           return $this;
        }

        $file = $request->file('pdf');
        $fileName = uniqid() . '_' . trim($file->getClientOriginalName());

        if($this->hasPdf()) {
           
            if(File::exists(public_path('tmp/pdf/'. $this->pdf->pdf))){
                File::delete(public_path('tmp/pdf/'. $this->pdf->pdf));
            }

            $file->move($path, $fileName);

            return $this->pdf()->update([
                'pdf' => $fileName
            ]);
        }
        
        $file->move($path, $fileName);

        return $this->pdf()->create([
            'pdf' => $fileName
        ]);
    }
}
<?php

namespace App\Models;

use App\Common\HasPdf;
use App\Common\HasImage;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Support\Facades\URL;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Book extends Model
{
    use HasFactory, HasImage, HasPdf;

    protected $guarded = [];

    public function author() : BelongsTo
    {
        return $this->belongsTo(Author::class);
    }

    public function publisher() : BelongsTo
    {
        return $this->belongsTo(Publisher::class);
    }

    public function category() : BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
    
    public function storeBook($request) : Book
    {
        $this->title = $request->title;
        $this->author_id = $request->author_id;
        $this->publisher_id = $request->publisher_id;
        $this->category_id = $request->category_id;
        $this->short_description = $request->short_description;
        $this->save();

        if($request->has('image')) {
            $this->saveImage($request);
        }
        
        return $this;
    }

    public function bookLists()
    {  
        return self::with(['image','pdf'])
                ->orderBy('title','asc')
                ->paginate(10);
    }

    public function url()
    {
        return URL::route('book.show', [
            'author_name' => $this->author->author_name,
            'title'   => $this->title,
        ]);
    }

    public function scopeSearch(Builder $query)
    {
        return $query->when(request()->get('query'),function(Builder $q) {
            $q->whereLike([
              'title', 
              'category.category_name',
              'author.author_name',
              'publisher.publisher_name',
            ], request()->get('query'));
          });
    }

    public function bookSearch()
    {
        $data = $this::orderBy('title','asc')
                    ->search()
                    ->paginate(5);

        $output = '';

        if (count($data) > 0) {
            $output = '<ul class="list-group" style="display: block; position: relative; z-index: 1">';
            
            foreach ($data as $row) {
                $output .= '<li class="list-group-item" style="cursor: pointer;"><img src="'.image_path().''.$row->image->image.'" style="border-radius:50%;height:50px;width:50px;"> <a href="'.$row->url().'">'.$row->title . ' '.'</a></li>';
            }
            $output .= '</ul>';
            return response()->json(['output'=> $output]);
        }
        return response()->json(['output'=> '']);
    }

    public function show($request)
    {
        return $this::where('title',$request->title)
            ->with([
                'author:id,author_name',
                'publisher:id,publisher_name',
                'category:id,category_name',
                'image',
                'pdf'
            ])
            ->first();
    }

    public function downloadBookPdf($book)
    {
        $file = public_path('tmp/pdf/' . $book->pdf->pdf);
        return response()->download($file);
    }
}

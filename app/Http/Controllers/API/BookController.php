<?php

namespace App\Http\Controllers\API;

use App\Models\Book;
use App\Common\HasApiResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Http\Requests\BookStoreRequest as BookRequest;
use App\Http\Resources\BookResource;

class BookController extends Controller
{   
    use HasApiResponse;

    public function store(BookRequest $request, Book $book)
    {
        DB::beginTransaction();
        try {
            $book = $book->storeBook($request)
                    ->savePdf($request);
        } catch (\Exception $e) {
            DB::rollback();
            Log::error('Book create request failed :: ' . $e->getMessage());
            return $this->httpInternalServerError($e->getMessage());
        }
        DB::commit();
        return $this->httpCreated('Book created successfully!');
    }
}

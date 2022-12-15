<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\Book;
use Maize\Markable\Models\Like;
use Validator;
use DB;
use App\Http\Resources\BookResource;
   
class BookController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // return $request->header('Authorization');
        // $books = Book::all();
        $books = Book::paginate(request()->all());
    
        return $this->sendResponse(BookResource::collection($books), 'Books retrieved successfully.');
    }

    public function popularBook()
    {
        // $getBook = Book::get();
        // foreach($getBook as $book){
        //     $book = Book::where('id', $book->id)->firstOrFail();
        //     $bookMostLike_old = Like::count($book);
        // }

        $bookMostLike = DB::table('markable_likes')->selectRaw('markable_id, count(*) as number_of_likes')
                        ->where('markable_type', 'App\Models\Book')
                        ->groupBy('markable_id')
                        ->orderBy('number_of_likes', 'DESC')
                        ->get();


        // dd($bookMostLike);
     
        if($bookMostLike)
        {
         return response()->json(['responseCode' => '200','responseMessage' => 'Success', 'Popular Books' => $bookMostLike]);   
        }
        else
        {
            return response()->json(['responseCode' => '101','responseMessage' => 'No data', 'Popular Books' => 'NULL']);
        }
        
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();
   
        $validator = Validator::make($input, [
            'name' => 'required',
            'author_name' => 'required'
        ]);
   
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }
   
        $book = Book::create($input);
   
        return $this->sendResponse(new BookResource($book), 'Book created successfully.');
    } 
   
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $book = Book::find($id);
  
        if (is_null($product)) {
            return $this->sendError('Book not found.');
        }
   
        return $this->sendResponse(new BookResource($book), 'Book retrieved successfully.');
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $input = $request->all();
   
        $validator = Validator::make($input, [
            'name' => 'required',
            'author_name' => 'required'
        ]);
   
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }
   
        $book->name = $input['name'];
        $book->author_name = $input['author_name'];
        $book->save();
   
        return $this->sendResponse(new BookResource($book), 'Book updated successfully.');
    }
   
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $book)
    {
        $book->delete();
   
        return $this->sendResponse([], 'Book deleted successfully.');
    }
}
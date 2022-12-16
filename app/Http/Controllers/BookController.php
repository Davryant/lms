<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use Maize\Markable\Models\Like;
use Maize\Markable\Models\Favorite;
use Illuminate\Support\Facades\Auth;

class BookController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:book-list|book-create|book-edit|book-delete', ['only' => ['index','show']]);
         $this->middleware('permission:book-view', ['only' => ['index','show']]);
         $this->middleware('permission:book-create', ['only' => ['create','store']]);
         $this->middleware('permission:book-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:book-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $books = Book::latest()->paginate(5);
        return view('books.index',compact('books'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('books.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate([
            'name' => 'required',
            'author_name' => 'required',
        ]);
    
        Book::create($request->all());
    
        return redirect()->route('books.index')->with('success','Book created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Book $book)
    {
        $like = Book::where('id',$book->id)->whereHasLike(
            auth()->user()
        )->get(); // returns the book model with a like from the given user

        $likeCount = Book::where('id',$book->id)->firstOrFail()->likes; // returns the collection of like marks related to the book

        $favorite = Book::where('id',$book->id)->whereHasFavorite(
            auth()->user()
        )->get(); // returns the book model with a favorite from the given user

        $favoriteCount = Book::where('id',$book->id)->firstOrFail()->favorites; // returns the collection of favorite marks related to the book

        return view('books.show',compact('book', 'like','favorite','likeCount','favoriteCount'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Book $book)
    {
        return view('books.edit',compact('book'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Book $book)
    {
        request()->validate([
            'name' => 'required',
            'author_name' => 'required',
        ]);
    
        $book->update($request->all());
    
        return redirect()->route('books.index')->with('success','Book updated successfully');
    }


    public function likeBook(Request $request, $id)
    {
        $book = Book::where('id', $id)->firstOrFail();
        $user = Auth::user();
        
        $liked = Like::add($book, $user); // marks the book liked by specific user

        if($liked){
          return response()->json(['message' => 'book liked', 'code' => '200', 'data' => $liked]);
        }
        else
        {
          return response()->json(['message' => 'Liking a book failed', 'code' => '201']);
        }

    }

    public function favoriteBook(Request $request, $id)
    {
        $book = Book::where('id', $id)->firstOrFail();
        $user = Auth::user();
        
        $favorited = Favorite::add($book, $user); // marks the book favorited by specific user


        if($favorited){
          return response()->json(['message' => 'book added as favorite', 'code' => '200', 'data' => $favorited]);
        }
        else
        {
          return response()->json(['message' => 'favoriting a book failed', 'code' => '201']);
        }

    }

    public function favoriteRemove(Request $request, $id)
    {
        $book = Book::where('id', $id)->firstOrFail();
        $user = Auth::user();
        
        $unfavorited = Favorite::remove($book, $user); // marks the book removed as a favorite by specific user


        if($unfavorited){
          return response()->json(['message' => 'book removed as favorite', 'code' => '200', 'data' => $unfavorited]);
        }
        else
        {
          return response()->json(['message' => 'unfavoriting a book failed', 'code' => '201']);
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Book $book)
    {
        $book->delete();
    
        return redirect()->route('books.index')->with('success','Book deleted successfully');
    }
}

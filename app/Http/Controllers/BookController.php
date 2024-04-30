<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use Faker\Factory as Faker;
use Illuminate\Support\Str;

class BookController extends Controller
{
    public function index(Request $request)
    {
        $request->validate([
            'limit' => 'integer|min:1',
            'offset' => 'integer|min:0',
        ]);

        $limit = $request->input('limit', 10); 
        $offset = $request->input('offset', 0);

        $books = Book::skip($offset)->take($limit)->get();

        return response()->json(['books' => $books], 200);
    }

    public function show($id)
    {
        $book = Book::findOrFail($id);
        return response()->json(['book' => $book], 200);
    }

    public function store(Request $request)
    {
        $faker = Faker::create();
        $title = $faker->words(rand(1, 3), true);
    
        $cover_image = 'https://images-na.ssl-images-amazon.com/images/I/51Ga5GuElyL._AC_SX184_.jpg';
        $writer = $faker->name();
        $point = $faker->randomNumber(2);
        $tags = ['fiction', 'science'];
        $tagsJson = json_encode($tags);
        $book = Book::create([
            'title' => $title,
            'writer' => $writer,
            'cover_image' => $cover_image,
            'point' => $point,
            'tags' => $tagsJson, 
        ]);
        return response()->json(['message' => 'Book created successfully', 'book' => $book], 201);
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string',
            'writer' => 'required|string',
            'cover_image' => 'required|string',
            'point' => 'required|numeric',
            'tags' => 'array',
        ]);

        $book = Book::findOrFail($id);
        $book->update([
            'title' => $request->title,
            'writer' => $request->writer,
            'cover_image' => $request->cover_image,
            'point' => $request->point,
            'tags' => $request->tags,
        ]);

        return response()->json(['message' => 'Book updated successfully', 'book' => $book], 200);
    }
    public function destroy($id)
    {
        $book = Book::findOrFail($id);
        $book->delete();
        return response()->json(['message' => 'Book deleted successfully'], 200);
    }

}

<?php

namespace App\Http\Controllers;

use App\Book;
use App\Rating;
use Illuminate\Http\Request;

class BookController extends Controller
{
    /**
     * Show a list of all books.
     *
     * @return illuminate\Http\Response
     */
    public function showAllBooks()
    {
        return response()->json(Book::all());
    }

    /**
     * Show a specific book and average rating.
     *
     * @param int $id
     *
     * @return illuminate\Http\Response
     */
    public function showOneBook($id)
    {
        // Return list of books
        $book = Book::find($id);

        // Return related rating and round it to the nearest whole number
        $rating = round(Book::find($id)->rating->avg('value'));

        return response()->json(['books' => $book, 'rating' => $rating]);
    }

    /**
     * Store a newly created book to the database.
     *
     * @param illuminate\Http\Request $request
     *
     * @return illuminate\Http\Response
     */
    public function create(Request $request)
    {

        //Validate incoming request
        $this->validate($request, [
            'author_firstname' => 'required',
            'author_lastname'  => 'required',
            'year_published'   => 'required',
            'isbn'             => 'required',
            'book_title'       => 'required',
        ]);

        // Save the book to database
        $book = Book::create($request->all());

        return response()->json($book, 201);
    }

    /**
     * Update a specified book.
     *
     * @param illuminate\Http\Request $request
     * @param int                     $id
     *
     * @return illuminate\Http\Response
     */
    public function update($id, Request $request)
    {
        $this->validate($request, [
            'author_firstname' => 'required',
            'author_lastname'  => 'required',
            'year_published'   => 'required',
            'isbn'             => 'required',
            'book_title'       => 'required',
        ]);

        /**
         * Return specified book with the given id.
         *
         * @param int $id
         */
        $book = Book::findOrFail($id);

        // Update the specified book
        $book->update($request->all());

        return response()->json($book, 200);
    }

    /**
     * Delete a specified book from database.
     *
     * @param int $id
     *
     * @return illuminate\Http\Response
     */
    public function delete($id)
    {
        Book::findOrFail($id)->delete();

        return response('Book deleted Successfully', 200);
    }

    /**
     * Rate a book.
     *
     * @param illuminate\Http\Request $request
     * @param int                     $id
     *
     * @return illuminate\Http\Response
     */
    public function rateABook(Request $request, $id)
    {
        // Validate incoming request
        $this->validate($request, [
            'value' => 'required',
        ]);

        // Store new rating
        $rate = new Rating();
        $rate->value = $request->value;
        $rate->book_id = $id;
        $rate->save();

        return response('Book rated', 200);
    }
}

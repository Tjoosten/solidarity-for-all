<?php

namespace App\Http\Controllers\Categories;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;

/**
 * Class CategoryController
 *
 * @package App\Http\Controllers\Categories
 */
class CategoryController extends Controller
{
    /**
     * CategoryController constructor.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth', 'role:admin,webmaster']);
    }

    /**
     * Method for displaying all the item categories in the application.
     *
     * @param  Category $categories Database model for the categories in the application.
     * @return Renderable
     */
    public function index(Category $categories): Renderable
    {
        return view('categories.index', ['categories' => $categories->paginate()]);
    }
}

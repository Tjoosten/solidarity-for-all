<?php

namespace App\Http\Controllers\Categories;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryFormRequest;
use App\Models\Category;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
        $this->middleware(['auth', 'role:admin|webmaster', 'forbid-banned-user']);
    }

    /**
     * Method for displaying all the item categories in the application.
     *
     * @param  Category $categories Database model for the categories in the application.
     * @return Renderable
     */
    public function index(Category $categories): Renderable
    {
        return view('categories.index', ['categories' => $categories->withCount('items')->paginate()]);
    }

    /**
     * Method for displaying the information about the category in the application.
     *
     * @param  Category $category The unique identifier from the given resource.
     * @return Renderable
     */
    public function show(Category $category): Renderable
    {
        return view('categories.show', compact('category'));
    }

    /**
     * Method for updating the category information in the application.
     *
     * @param  CategoryFormRequest  $request    The request instance that holds all the request information.
     * @param  Category             $category   The resource entity form the given category.
     * @return RedirectResponse
     */
    public function update(CategoryFormRequest $request, Category $category): RedirectResponse
    {
        DB::transaction(static function () use ($request, $category): void {
            $category->update($request->all());
            flash($category->name . ' Is gewijzigd in de applicatie.');
        });

        return back(); // Redirect the user back to the previous page.
    }

    /**
     * Method for displaying the category create view.
     *
     * @return Renderable
     */
    public function create(): Renderable
    {
        return view('categories.create');
    }

    /**
     * Method for storing the category in the application.
     *
     * @param  CategoryFormRequest  $request    The form request class that handles the validation.
     * @param  Category             $category   The database model class for the categories.
     * @return RedirectResponse
     */
    public function store(CategoryFormRequest $request, Category $category): RedirectResponse
    {
        DB::transaction(static function () use ($request, $category): void {
            $category = $category->create($request->all())->setCreator($request->user());
            flash($category->name . ' is toegevoegd als item categorie in de applicatie.');
        });

        return back(); // Redirect the user back to the previous page.
    }

    /**
     * Method for deleting a category in the application.
     *
     * @param  Request  $request    The request instance that contains all the request information.
     * @param  Category $category   The database storage entity form the given category.
     * @return Renderable|RedirectResponse
     */
    public function delete(Request $request, Category $category)
    {
        if ($request->isMethod('GET')) {
            return view('categories.delete', compact('category'));
        }

        // Method is determined as a DELETE request so perform the delete logic.

        DB::transaction(static function () use ($category): void {
            $category->delete();
            flash(ucfirst($category->name) . ' is verwijderd als category in de applicatie');
        });

        return redirect()->route('tags.overview');
    }
}

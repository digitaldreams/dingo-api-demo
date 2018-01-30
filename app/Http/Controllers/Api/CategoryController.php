<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Api\ApiController;
use \App\Models\Category;
use App\Transformers\CategoryTransformer;


/**
 * Category
 *
 * @Resource("Category", uri="/categories")
 */
class CategoryController extends ApiController
{
    /**
     * List of Category
     *
     * @Get("/")
     *
     * @Versions({"v1"})
     *
     * @Response(200, body={
    "data": {}
    })
     */
    public function index(Request $request)
    {
        return $this->response->paginator(Category::paginate(10), new CategoryTransformer());
    }

    /**
     * Show details about a Category
     *
     * @Get("/{id}")
     *
     * @Versions({"v1"})
     *
     * @Response(200, body={
    "data": {}
    })
     * @Response(404, body={"message": "No query results for model [\App\Models\Category]."})
     */
    public function show(Request $request, $category)
    {
        $category = Category::findOrFail($category);
        return $this->response->item($category, new CategoryTransformer());
    }

    /**
     * Create a Category
     *
     *
     * @Post("/store")
     *
     * @Versions({"v1"})
     *
     * @Request("{"key":"value"}", contentType="application/x-www-form-urlencoded")
     *
     * @Response(200, body={})
     */
    public function store(Request $request)
    {
        $model = new Category;
        $model->fill($request->all());

        if ($model->save()) {
            session()->flash('app_message', 'Category saved successfully');
            return $this->response->item($model, new CategoryTransformer());
        } else {
            return $this->response->errorInternal('Error occurred while saving Category');
        }
    }

    /**
     * Update a existing Category
     *
     * @Put("/{id}")
     *
     * @Versions({"v1"})
     *
     * @Request("{"key:"value"}", contentType="application/x-www-form-urlencoded")
     *
     * @Response(200, body={
    })
     * @Response(404, body={"message": "No query results for model [\App\Models\Category]."})
     */
    public function update(Request $request, $category)
    {
        $category = Category::findOrFail($category);
        $category->fill($request->all());

        if ($category->save()) {
            return $this->response->item($category, new CategoryTransformer());
        } else {
            return $this->response->errorInternal('Error occurred while saving Category');
        }
    }

    /**
     * Delete an existing Category
     *
     * @Delete("/{id}")
     *
     * @Versions({"v1"})
     *
     * @Response(200, body={
    "status": 200,
    "message": "Category successfully deleted"
    })
     * @Response(404, body={"message": "No query results for model [\App\Models\Category]."})
     */
    public function destroy(Request $request, $category)
    {
        $category = Category::findOrFail($category);

        if ($category->delete()) {
            return $this->response->array(['status' => 200, 'message' => 'Category successfully deleted']);
        } else {
            return $this->response->errorInternal('Error occurred while deleting Category');
        }
    }

}

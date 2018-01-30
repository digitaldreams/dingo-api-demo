<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Api\ApiController;
use \App\Models\Post;
use App\Transformers\PostTransformer;
use App\Models\User;
use App\Models\Category;
use App\Http\Requests\Api\Posts\Index;
use App\Http\Requests\Api\Posts\Show;
use App\Http\Requests\Api\Posts\Store;
use App\Http\Requests\Api\Posts\Update;
use App\Http\Requests\Api\Posts\Destroy;


/**
 * Post
 *
 * @Resource("Post", uri="/posts")
 */

class PostController extends ApiController
{
        /**
     * List of Post
     *
     * @Get("/")
     *
     * @Versions({"v1"})
     *
     * @Response(200, body={
       "data": {}
    })
     */
    public function index(Index $request)
    {
       return $this->response->paginator(Post::paginate(10), new PostTransformer());
    }
     /**
     * Show details about a Post
     *
     * @Get("/{id}")
     *
     * @Versions({"v1"})
     *
     * @Response(200, body={
        "data": {}
        })
     */
    public function show(Show $request,$post)
    {
      return $this->response->item($post, new PostTransformer());
    }
    /**
     * Create a Post
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
    public function store(Store $request)
    {
        $model=new Post;
        $model->fill($request->all());

        if ($model->save()) {
            session()->flash('app_message', 'Post saved successfully');
            return $this->response->item($model, new PostTransformer());
        } else {
              return $this->response->errorInternal('Error occurred while saving Post');
        }
    }
    /**
     * Update a existing Post
     *
     * @Put("/{id}")
     *
     * @Versions({"v1"})
     *
     * @Request("{"key:"value"}", contentType="application/x-www-form-urlencoded")
     *
     * @Response(200, body={
     })
     * @Response(404, body={"message": "No query results for model [App\\Post]."})
     */
    public function update(Update $request,Post $post)
    {
        $post->fill($request->all());

        if ($post->save()) {
            return $this->response->item($post, new PostTransformer());
        } else {
             return $this->response->errorInternal('Error occurred while saving Post');
        }
    }
    /**
     * Delete an existing Post
     *
     * @Delete("/{id}")
     *
     * @Versions({"v1"})
     *
     * @Response(200, body={
       "status": 200,
       "message": "Post successfully deleted"
    })
     * @Response(404, body={"message": "No query results for model [App\\Post]."})
     */
    public function destroy(Destroy $request, Post $post)
    {
        if ($post->delete()) {
            return $this->response->array(['status' => 200, 'message' => 'Post successfully deleted']);
        } else {
             return $this->response->errorInternal('Error occurred while deleting Post');
        }
    }

}

<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
/**
   @property int $user_id user id
@property varchar $title title
@property varchar $slug slug
@property varchar $status status
@property longtext $body body
@property int $category_id category id
@property varchar $image image
@property datetime $published_at published at
@property timestamp $created_at created at
@property timestamp $updated_at updated at
@property Category $category belongsTo
@property User $user belongsTo
@property \Illuminate\Database\Eloquent\Collection $comment hasMany
   
 */
class Post extends Model 
{
    
    /**
    * Database table name
    */
    protected $table = 'posts';
    /**
    * Protected columns from mass assignment
    */
    protected $guarded=['id'];


    /**
    * Date time columns.
    */
    protected $dates=['published_at'];

    /**
    * category
    *
    * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
    */
    public function category()
    {
        return $this->belongsTo(Category::class,'category_id');
    }

    /**
    * user
    *
    * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
    */
    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }

    /**
    * comments
    *
    * @return \Illuminate\Database\Eloquent\Relations\HasMany
    */
    public function comments()
    {
        return $this->hasMany(Comment::class,'post_id');
    }



}
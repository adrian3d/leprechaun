<?php

namespace App\Http\Controllers\Api;

use App\Exceptions\Api\PostNotFound;
use App\Post;

class PostController extends AbstractApiController
{
    public function index()
    {
        try {
            $posts = Post::all();
        } catch (\Exception $e) {
            throw $e;
        }

        return $this->sendResponse($posts);
    }

    public function get(int $id)
    {
        try {
            $post = Post::find($id);
        } catch (\Exception $e) {
            throw $e;
        }

        if (!$post) {
            throw new PostNotFound();
        }

        return $this->sendResponse($post);
    }
}

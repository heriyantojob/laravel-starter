<?php

namespace App\Http\Controllers\Api;
use App\Models\Product;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\ProductResource;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
class ProductController extends Controller
{
    //

    public function index()
    {
        //get all posts
        $posts = Product::latest()->paginate(5);

        //return collection of posts as a resource
        return new ProductResource(true, 'List Data Posts', $posts);
    }

    public function show($id)
    {
        //find post by ID
        $post = Product::find($id);

        //return single post as a resource
        return new ProductResource(true, 'Detail Data Post!', $post);
    }

    public function store(Request $request)
    { 
       // return new PostResource(true, 'List Data Posts', null);
        
        //define validation rules
        $validator = Validator::make($request->all(), [
            'image'         => 'required|image|mimes:jpeg,jpg,png|max:2048',
            'title'         => 'required|min:5',
            'description'   => 'required|min:10',
            'price'         => 'required|numeric',
            'stock'         => 'required|numeric'
        ]);

        //check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        //upload image
        $image = $request->file('image');
        $image->storeAs('public/products', $image->hashName());

        //create post
        $product = Product::create([
            'image'         => $image->hashName(),
            'title'         => $request->title,
            'description'   => $request->description,
            'price'         => $request->price,
            'stock'         => $request->stock
        ]);

        //return response
        return new ProductResource(true, 'Data Product Berhasil Ditambahkan!', $product);
    }


    public function update(Request $request, $id)
    {
        //define validation rules
        $validator = Validator::make($request->all(), [
           // 'image'         => 'required|image|mimes:jpeg,jpg,png|max:2048',
            'title'         => 'required|min:5',
            'description'   => 'required|min:10',
            'price'         => 'required|numeric',
            'stock'         => 'required|numeric'
        ]);

        //check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        //find post by ID
        $post = Product::find($id);

        //check if image is not empty
        if ($request->hasFile('image')) {

            //upload image
            $image = $request->file('image');
            $image->storeAs('public/products', $image->hashName());

            //delete old image
            Storage::delete('public/products/' . basename($post->image));

            //update post with new image
            $post->update([
                "update"=>"have images",
                'image'         => $image->hashName(),
                'title'         => $request->title,
                'description'   => $request->description,
                'price'         => $request->price,
                'stock'         => $request->stock
            ]);
        } else {

            //update post without image
            $post->update([
               
                "update"=>"no images",
                'title'         => $request->title,
                'description'   => $request->description,
                'price'         => $request->price,
                'stock'         => $request->stock
            ]);
        }

        //return response
        return new ProductResource(true, 'Data Product Berhasil Diubah!', $post);
    }

    public function destroy($id)
    {
      
        //find post by ID
        $product = Product::find($id);
        $message = array("message"=>"gagal");
        // return response()->json(
        //   $product, 
        //     404);
        //delete image
        Storage::delete('public/products/'.basename($product->image));

        //delete post
        $product->delete();

        //return response
        return new ProductResource(true, 'Data Product Berhasil Dihapus!', null);
    }

}

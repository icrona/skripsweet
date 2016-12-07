<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cake;
use App\File;
use App\Http\Requests;
use Validator;
use Response;
use Illuminate\Support\Facades\Input;
use Image;
use Storage;


class CakeController extends Controller
{

    public function index(){
      return view('admin.signatures');
    }
    
    public function birthday()
    {
        $cakes = Cake::where('category','=','birthday')->latest()->paginate(8);
        $response = [
          'pagination' => [
            'total' => $cakes->total(),
            'per_page' => $cakes->perPage(),
            'current_page' => $cakes->currentPage(),
            'last_page' => $cakes->lastPage(),
            'from' => $cakes->firstItem(),
            'to' => $cakes->lastItem()
          ],
          'data' => $cakes
        ];
        return response()->json($response);
    }

    public function birthdaySearch(Request $request)
    {
      $search=$request->input('search');
        $cakes = Cake::where([
            ['category','=','birthday'],
            ['name','like','%'.$search.'%']
          ])->latest()->paginate(8);

        $response = [
          'pagination' => [
            'total' => $cakes->total(),
            'per_page' => $cakes->perPage(),
            'current_page' => $cakes->currentPage(),
            'last_page' => $cakes->lastPage(),
            'from' => $cakes->firstItem(),
            'to' => $cakes->lastItem()
          ],
          'data' => $cakes
        ];
        return response()->json($response);
    }

    public function anniversarySearch(Request $request)
    {
      $search=$request->input('search');
        $cakes = Cake::where([
            ['category','=','anniversary'],
            ['name','like','%'.$search.'%']
          ])->latest()->paginate(8);
        
        $response = [
          'pagination' => [
            'total' => $cakes->total(),
            'per_page' => $cakes->perPage(),
            'current_page' => $cakes->currentPage(),
            'last_page' => $cakes->lastPage(),
            'from' => $cakes->firstItem(),
            'to' => $cakes->lastItem()
          ],
          'data' => $cakes
        ];
        return response()->json($response);
    }

    public function seasonalSearch(Request $request)
    {
      $search=$request->input('search');
        $cakes = Cake::where([
            ['category','=','seasonal'],
            ['name','like','%'.$search.'%']
          ])->latest()->paginate(8);
        
        $response = [
          'pagination' => [
            'total' => $cakes->total(),
            'per_page' => $cakes->perPage(),
            'current_page' => $cakes->currentPage(),
            'last_page' => $cakes->lastPage(),
            'from' => $cakes->firstItem(),
            'to' => $cakes->lastItem()
          ],
          'data' => $cakes
        ];
        return response()->json($response);
    }

    public function anniversary()
    {
        $cakes = Cake::where('category','=','anniversary')->latest()->paginate(8);
        $response = [
          'pagination' => [
            'total' => $cakes->total(),
            'per_page' => $cakes->perPage(),
            'current_page' => $cakes->currentPage(),
            'last_page' => $cakes->lastPage(),
            'from' => $cakes->firstItem(),
            'to' => $cakes->lastItem()
          ],
          'data' => $cakes
        ];
        return response()->json($response);
    }

    public function seasonal()
    {
        $cakes = Cake::where('category','=','seasonal')->latest()->paginate(8);
        $response = [
          'pagination' => [
            'total' => $cakes->total(),
            'per_page' => $cakes->perPage(),
            'current_page' => $cakes->currentPage(),
            'last_page' => $cakes->lastPage(),
            'from' => $cakes->firstItem(),
            'to' => $cakes->lastItem()
          ],
          'data' => $cakes
        ];
        return response()->json($response);
    }


 public function store(Request $request)
    {
        $this->validate($request,[
          'name' => 'required|max:255',
          'description' => 'required',
          'category'=>'required|max:255',
          'size'=>'required',
          'price'=>'required',
          'image'=>'required|max:255'
        ]);

        $cake = Cake::create($request->all());
        $cake->save();
        return response()->json($cake);
    }

    public function upload(Request $request){
      $image=$request->file;
      $filename='cake/'.time().'.'.$image->getClientOriginalExtension();
      $location=public_path('images/'.$filename);
      Image::make($image)->resize(400,400)->save($location);
      return response()->json($filename);
    }


    public function uploadEdit(Request $request, $id){
      $image=$request->file;
      $filename='cake/'.time().'.'.$image->getClientOriginalExtension();
      $location=public_path('images/'.$filename);
      Image::make($image)->resize(400,400)->save($location);

      $delete=Cake::find($id);
      $deletedImage=$delete->image;
      Storage::delete($deletedImage);

      return response()->json($filename);
    }

    public function update(Request $request, $id)
    {
      $this->validate($request,[
        'name' => 'required|max:255',
          'description' => 'required',
          'category'=>'required|max:255',
          'size'=>'required',
          'price'=>'required',
          'image'=>'sometimes|max:255'
      ]);
      $cake = Cake::find($id)->update($request->all());


      return response()->json($cake);
    }
    
    public function destroy($id)
    {

        Cake::find($id)->delete();
        return response()->json(['done']);
    }

}
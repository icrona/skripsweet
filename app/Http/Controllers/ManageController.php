<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Response;
use Validator;
use Illuminate\Support\Facades\Input;
use App\Flavour;
use App\Size;
use App\Shape;
use App\Frosting;
use App\TopPipe;
use App\EdgePipe;
use App\Sprinkle;
use App\Decoration;
use App\Version;
use App\Profile;
use Image;
use Storage;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class ManageController extends Controller
{
	public function showFlavour()
	{
        DB::table('flavours')->truncate();
		$flavours = Flavour::paginate(10);
		$response = [
          'pagination' => [
            'total' => $flavours->total(),
            'per_page' => $flavours->perPage(),
            'current_page' => $flavours->currentPage(),
            'last_page' => $flavours->lastPage(),
            'from' => $flavours->firstItem(),
            'to' => $flavours->lastItem()
          ],
          'data' => $flavours
        ];
        return response()->json($response);
	}

	public function addFlavour(Request $request){
		$this->validate($request,array(
            'name' => 'required|max:255',
            'price' => 'required|max:255',
        ));
        $flavour = Flavour::create($request->all());
        $flavour->save();
        return response()->json($flavour);

	}

	public function editFlavour(Request $request,$id)
    {
        $this->validate($request,array(
            'name' => 'required|max:255',
            'price' => 'required|max:255',
        ));
        $edit = Flavour::find($id)->update($request->all());
        return response()->json($edit);
    }

    public function deleteFlavour($id)
    {
        Flavour::find($id)->delete();
        return response()->json(['done']);
    }

    public function showSize()
    {
        $sizes = Size::orderBy('size','asc')->paginate(10);
        $response = [
          'pagination' => [
            'total' => $sizes->total(),
            'per_page' => $sizes->perPage(),
            'current_page' => $sizes->currentPage(),
            'last_page' => $sizes->lastPage(),
            'from' => $sizes->firstItem(),
            'to' => $sizes->lastItem()
          ],
          'data' => $sizes
        ];
        return response()->json($response);
    }

    public function addSize(Request $request){
        $this->validate($request,array(
            'size' => 'required',
            'rate' => 'required',
        ));
        $size = Size::create($request->all());
        $size->save();
        return response()->json($size);

    }

    public function editSize(Request $request,$id)
    {
        $this->validate($request,array(
            'size' => 'required',
            'rate' => 'required',
        ));
        $edit = Size::find($id)->update($request->all());
        return response()->json($edit);
    }

    public function deleteSize($id)
    {
        Size::find($id)->delete();
        return response()->json(['done']);
    }

    public function showShape()
    {
        $shapes = Shape::all();
        $response = [
          'data' => $shapes
        ];
        return response()->json($response);
    }

    public function editShape(Request $request,$id)
    {
        $this->validate($request,array(
            'name' => 'required',
            'availability' => 'required',
        ));
        $edit = Shape::find($id)->update($request->all());
        return response()->json($edit);
    }

    public function showFrosting()
    {
        $frostings = Frosting::all();
        $response = [
          'data' => $frostings
        ];
        return response()->json($response);
    }

    public function editFrosting(Request $request,$id)
    {
        $this->validate($request,array(
            'one' => 'required',
            'availability'=>'required',
        ));
        $edit = Frosting::find($id)->update($request->all());
        return response()->json($edit);
    }

    public function showPipeTop()
    {
        $pipes = TopPipe::all();
        $response = [
          'data' => $pipes
        ];
        return response()->json($response);
    }

    public function editPipeTop(Request $request,$id)
    {
        $this->validate($request,array(
            'price' => 'required',
            'availability'=>'required',
        ));
        $edit = TopPipe::find($id)->update($request->all());
        return response()->json($edit);
    }

    public function showPipeEdge()
    {
        $pipes = EdgePipe::all();
        $response = [
          'data' => $pipes
        ];
        return response()->json($response);
    }

    public function editPipeEdge(Request $request,$id)
    {
        $this->validate($request,array(
            'price' => 'required',
            'availability'=>'required',
        ));
        $edit = EdgePipe::find($id)->update($request->all());
        return response()->json($edit);
    }

    public function showSprinkle()
    {
        $sprinkles = Sprinkle::all();
        $response = [
          'data' => $sprinkles
        ];
        return response()->json($response);
    }

    public function editSprinkle(Request $request,$id)
    {
        $this->validate($request,array(
            'price' => 'required',
            'availability'=>'required',
        ));
        $edit = Sprinkle::find($id)->update($request->all());
        return response()->json($edit);
    }

    public function showDecoration()
    {
        $decorations = Decoration::latest()->paginate(8);
        $response = [
          'pagination' => [
            'total' => $decorations->total(),
            'per_page' => $decorations->perPage(),
            'current_page' => $decorations->currentPage(),
            'last_page' => $decorations->lastPage(),
            'from' => $decorations->firstItem(),
            'to' => $decorations->lastItem()
          ],
          'data' => $decorations
        ];
        return response()->json($response);
    }

    public function decorationSearch(Request $request)
    {
        $search=$request->input('search');
        $decorations = Decoration::where('name','like','%'.$search.'%')->latest()->paginate(8);
        $response = [
          'pagination' => [
            'total' => $decorations->total(),
            'per_page' => $decorations->perPage(),
            'current_page' => $decorations->currentPage(),
            'last_page' => $decorations->lastPage(),
            'from' => $decorations->firstItem(),
            'to' => $decorations->lastItem()
          ],
          'data' => $decorations
        ];
        return response()->json($response);
    }

    public function editDecoration(Request $request,$id)
    {
        $this->validate($request,array(
            'price' => 'required',
            'availability'=>'required',
        ));
        $edit = Decoration::find($id)->update($request->all());
        return response()->json($edit);
    }

    public function deploy(){
        $version=Carbon::now()->toDateTimeString();
        $edit=Version::find(1);
        $edit->version=$version;
        $edit->save();
        $response = [
          'version' => $version
        ];
        return response()->json($response);
    }

    public function getConfig(){
        $get=Version::find(1);
        $get_version=$get->version;

        $flavour=DB::table('flavours')->select('name','price')->get();
        $size=DB::table('sizes')->select('size','rate')->orderBy('size','asc')->get();
        $shape=DB::table('shapes')->select('name','availability')->get();
        $frosting=DB::table('frostings')->select('name','one','two','three','four','availability')->orderBy('name','asc')->get();
        $pipe_top=DB::table('top_pipes')->select('id','price','availability')->get();
        $pipe_edge=DB::table('edge_pipes')->select('id','price','availability')->get();
        $sprinkle=DB::table('sprinkles')->select('id','price','availability')->get();
        $candle=DB::table('decorations')->select('id','price','availability')->where('id','<=','11')->get();
        $figure=DB::table('decorations')->select('id','price','availability')->where([
            ['id','>=','12'],
            ['id','<=','25']    
        ])->get();

        $response = [
          'version' => $get_version,
          'flavour' => $flavour,
          'size'    => $size,
          'shape'   => $shape,
          'frosting'=> $frosting,
          'pipe_top'=> $pipe_top,
          'pipe_edge'=>$pipe_edge,
          'sprinkle'=>$sprinkle,
          'candle'=>$candle,
          'figure'=>$figure,
        ];
        return response()->json($response);
    }

}

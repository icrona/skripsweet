<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Faq;
use App\Http\Requests;
use Validator;
use Response;
use Illuminate\Support\Facades\Input;

class FaqController extends Controller
{
    
    public function index()
    {
        $faqs = Faq::latest()->paginate(5);
        $response = [
          'pagination' => [
            'total' => $faqs->total(),
            'per_page' => $faqs->perPage(),
            'current_page' => $faqs->currentPage(),
            'last_page' => $faqs->lastPage(),
            'from' => $faqs->firstItem(),
            'to' => $faqs->lastItem()
          ],
          'data' => $faqs
        ];
        return response()->json($response);
    }

    public function searchFaq(Request $request){
      $search=$request->input('search');
      $faqs = Faq::where('question','like','%'.$search.'%')->latest()->paginate(5);
      $response = [
          'pagination' => [
            'total' => $faqs->total(),
            'per_page' => $faqs->perPage(),
            'current_page' => $faqs->currentPage(),
            'last_page' => $faqs->lastPage(),
            'from' => $faqs->firstItem(),
            'to' => $faqs->lastItem()
          ],
          'data' => $faqs
        ];
      return response()->json($response);

    }

 public function store(Request $request)
    {
        $this->validate($request,[
          'question' => 'required',
          'answer' => 'required',
        ]);
        $add = Faq::create($request->all());
        $add->save();
        return response()->json($add);
    }

    public function update(Request $request, $id)
    {
      $this->validate($request,[
        'question' => 'required',
        'answer' => 'required',
      ]);
      $edit = Faq::find($id)->update($request->all());
      return response()->json($edit);
    }
    
    public function destroy($id)
    {
        Faq::find($id)->delete();
        return response()->json(['done']);
    }
}
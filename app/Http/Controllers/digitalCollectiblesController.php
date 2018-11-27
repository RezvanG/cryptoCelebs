<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DigitalCollectible;
use DB;

CONST STATUS_NEW = 1;
CONST STATUS_SOLD = 2;

CONST status_mapping = [
    'newly_added' => STATUS_NEW,
    'sold' => STATUS_SOLD,
];

class digitalCollectiblesController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $newly_added = DigitalCollectible::orderBy('id', 'desc')->take(3)->get();
        $recently_sold = DigitalCollectible::where('status', 2)->orderBy('sold_at', 'desc')->take(3)->get();
        $best_sellers = DigitalCollectible::orderBy('created_at', 'desc')->take(3)->get();

        $data = array(
            'recently_sold' => $recently_sold,
            'newly_added' => $newly_added,
            'best_sellers' => $best_sellers
        );
        return view('digitalCollectibles.index')->with($data);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function showAll()
    {
        $digitalCollectibles = DigitalCollectible::orderBy('created_at', 'desc')->paginate(10);
        return view('digitalCollectibles.showAll')->with('digitalCollectibles', $digitalCollectibles);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('digitalCollectibles.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'title'=>'required',
            'status'=>'required',
            'cover_image'=>'image|max:1999'
        ]);

        //Handle File Upload
        if($request->hasFile('cover_image')){
            //Get filename with the extension
            $fileNameWithExt = $request->file('cover_image')->getClientOriginalName();
            //Get just filename
            $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
            //Get just ext
            $fileExtension = $request->file('cover_image')->getClientOriginalExtension();
            //Filename to store
            $fileNameToStore = $fileName.'_'.time().'.'.$fileExtension;
            //return $fileNameToStore;
            $path = $request->file('cover_image')->storeAs('public/cover_images', $fileNameToStore);
        } else {
            $fileNameToStore = 'noimage.jpg';
        }

        // Create DigitalCollectible
        $digitalCollectible = new DigitalCollectible;
        $digitalCollectible->title = $request->input('title');
        $digitalCollectible->body = $request->input('body');
        $digitalCollectible->image_path = $fileNameToStore;
        $digitalCollectible->status = $request->input('status');
        $digitalCollectible->price = $request->input('price');
        $digitalCollectible->save();

        return redirect('/digitalCollectibles/showAll')->with('success', 'DigitalCollectible Created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $digitalCollectible = DigitalCollectible::find($id);
        return view('digitalCollectibles.show')->with('item', $digitalCollectible);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $digitalCollectible = DigitalCollectible::find($id);
        return view('digitalCollectibles.edit')->with('item', $digitalCollectible);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'title'=>'required',
            'status'=>'required',
            'cover_image'=>'image|max:1999'
        ]);

        //Handle File Upload
        if($request->hasFile('cover_image')){
            //Get filename with the extension
            $fileNameWithExt = $request->file('cover_image')->getClientOriginalName();
            //Get just filename
            $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
            //Get just ext
            $fileExtension = $request->file('cover_image')->getClientOriginalExtension();
            //Filename to store
            $fileNameToStore = $fileName.'_'.time().'.'.$fileExtension;
            //return $fileNameToStore;
            $path = $request->file('cover_image')->storeAs('public/cover_images', $fileNameToStore);
        }

        // Update DigitalCollectible
        $digitalCollectible = DigitalCollectible::find($id);
        $digitalCollectible->title = $request->input('title');
        $digitalCollectible->body = $request->input('body');
        if($request->hasFile('cover_image')) $digitalCollectible->image_path = $fileNameToStore;
        if($request->input('status') == 2)  $digitalCollectible->sold_at = date("Y-m-d H:i:s");
        $digitalCollectible->status = $request->input('status');
        $digitalCollectible->price = $request->input('price');
        $digitalCollectible->save();

        return redirect('/digitalCollectibles/showAll')->with('success', 'DigitalCollectible Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Delete DigitalCollectible
        $digitalCollectible = DigitalCollectible::find($id);

        /*if($digitalCollectible->image_path != 'noimage.jpg'){
            //Delete Image
            Storage::delete('public/celeb_images/'.$digitalCollectible->image_path);
        }*/

        $digitalCollectible->delete();
        return redirect('/digitalCollectibles/showAll')->with('success', 'DigitalCollectible Removed');
    }
}

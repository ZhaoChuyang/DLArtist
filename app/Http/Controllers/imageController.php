<?php

namespace DLArtist\Http\Controllers;

use DLArtist\image;
use Illuminate\Http\Request;


class imageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        /*
        $input=$request->all();
        $location=$input['location'];
        $fileData=$request->file('image');
        $fileName=$_FILES['image']['name'];
        $targetPath='images/';
        $request->file('image')->move($targetPath, $fileName);
        $completePath=url('/'.$targetPath.$fileName);
        $fileUpLoad=new FileUpload;
        $fileUpLoad->title = $fileName;
        $fileUpLoad->path = $completePath;
        $fileUpLoad->save();
         */
        $this->validate($request, [
            'image'=>'required|image|max:10240'
        ]);
        $image=$request->file('image');
        $inputImageName=time().'.'.$image->getClientOriginalExtension();
        $destinatonPath='images/';
        $image->move($destinatonPath, $inputImageName);

        $img = new image;

        $img->image_url=url("/images/$inputImageName");

        $user_id=auth()->user()->id;

        $img->user_id=$user_id;

        $img->save();

        return stripslashes(response()->json(['link' => url("/images/$inputImageName")])->content());

    }

    /**
     * Display the specified resource.
     *
     * @param  \DLArtist\image  $image
     * @return \Illuminate\Http\Response
     */
    public function show(image $image)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \DLArtist\image  $image
     * @return \Illuminate\Http\Response
     */
    public function edit(image $image)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \DLArtist\image  $image
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, image $image)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \DLArtist\image  $image
     * @return \Illuminate\Http\Response
     */
    public function destroy(image $image)
    {
        //
    }
}

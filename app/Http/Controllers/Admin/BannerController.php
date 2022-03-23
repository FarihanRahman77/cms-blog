<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Banner;
use Image;


class BannerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $banners=Banner::where('deleted','=','No')->get();
        return view('admin.backend.banner.bannerList',['banners'=>$banners]);
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
        $this->validate($request,[
            'title'=>'required'
        ]);
        
        //---Image resize And upload in public        
        $imageName = '';
        if($request->hasFile('banner_image')){
            
        $Bannerimage = $request->file('banner_image'); 
        $name = $Bannerimage->getClientOriginalName();
        $uploadPath = 'images/bannerImage/';
        $uploadPathOriginal = 'images/banner_original_images/';
		$imageName = time().$name;
        $imageUrl = $uploadPath.$imageName;
        $imageOriginalUrl = $uploadPathOriginal.time().$name;
        //--resize image upload in public--//
        Image::make($Bannerimage)->resize(1600,500)->save($imageUrl);

        //--original image upload in public--//
       // $request->Bannerimage->move(public_path($uploadPathOriginal), $imageName);

        } else{
            $imageName = "no_image.png";
        }
        //---End-Image resize And upload in public


        /*Eloquent ORM process*/
        $banner= new Banner();
        $banner->banner_image = $imageName;
        /* $banner->sorting =$request->Bannersorting; */
        $banner->title =$request->title;
        $banner->description=$request->description;
        $banner->status = 'Active';
        $banner->created_by = auth()->user()->id;
        $banner->deleted ='No';
        $banner->save();
        return redirect('banner/view')->with('message','Banner saved sucessfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
       //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $banners=Banner::find($id);
        $banners->status="Inactive";
        $banners->deleted="Yes";
        $banners->deleted_by = auth()->user()->id;
        $banners->deleted_date=date('Y-m-d H:i:s');
        $banners->save();
        return redirect('banner/view')->with('message','Banner deleted sucessfully');
    }



    public function changeStatus($id){
        $banners=Banner::find($id);

        if($banners->status=="Active"){
            $banners->status="Inactive";
        }else{
            $banners->status="Active";
        }
        $banners->last_updated_by=auth()->user()->id;
        $banners->save();
        return back()->with('message', 'Banner Status updated successfully!');
    }
}

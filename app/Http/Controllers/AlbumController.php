<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class AlbumController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(){
    }

    public function index(){
        $tbl_records = array();
        $lists = \App\Models\fbalbum::paginate(50);
        return view('app.album_list', [
              'tbl_records'=>$lists
            ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('app.album_form', []);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {
        //
        $validator = \Validator::make($request->all(), [
            'album_id' => 'required',
            'album_name' => 'required',
        ]);
        if ($validator->fails()) {
            return redirect('album/create')
                        ->withErrors($validator)
                        ->withInput();
        }else{
            $post = \App\Models\fbalbum::create(array(
      				'album_name' => $request->input('album_name'),
      				'album_id'=> $request->input('album_id'),
      			));

            if($post->save()){
                return \Redirect::to('album');
            }

        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $post = \App\Models\fbalbum::find($id);
        return view('app.album_view', ['post'=>$post]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        //
        $post = \App\Models\fbalbum::find($id);
        return view('app.album_form', ['post'=>$post]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id, Request $request)
    {
        //
        $validator = \Validator::make($request->all(), [
          'album_id' => 'required',
          'album_name' => 'required',
        ]);
        if ($validator->fails()) {
            return redirect('album/'.$id.'/edit')
                        ->withErrors($validator)
                        ->withInput();
        }else{
            $post = \App\Models\fbalbum::find($id);
            $post->album_id = $request->input('album_id');
            $post->album_name = $request->input('album_name');
            $post->save();

            if($post->save()){
                return \Redirect::to('album');
            }

        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
        $post = \App\Models\fbalbum::find($id);
        $post->delete();
        return \Redirect::to('album');
    }

}

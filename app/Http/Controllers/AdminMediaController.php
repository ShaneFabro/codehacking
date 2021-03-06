<?php

namespace App\Http\Controllers;

use App\Photo;

use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AdminMediaController extends Controller
{
    //
    public function index() {

        $photos = Photo::all();

        return view('admin.media.index', compact('photos'));

    }

    public function create() {

        return view('admin.media.create');

    }

    public function store(Request $request) {

        $file = $request->file('file');

        $name = time(). $file->getClientOriginalName();

        $file->move('images', $name);

        Photo::create(['file'=>$name]);

        return redirect('/admin/media');

    }

    public function destroy($id) {

        $photo = Photo::findOrFail($id);

        $path = public_path() . $photo->file;

        unlink($path);

        $photo->delete();  

        // $photo->delete();

        // return redirect('/admin/media');

    }

    public function deleteMedia(Request $request) {

        // if(isset($request->delete_single)){

        //     $this->destroy($request->destroy_single_id);

        //     return redirect()->back();

        // }

        if(isset($request->delete_all) && !empty($request->checkBoxArray)){

            $photos = Photo::findOrFail($request->checkBoxArray);

            foreach($photos as $photo){

                if(file_exists(public_path() . $photo->file)){

                    unlink(public_path() . $photo->file);

                    $photo->delete();

                } else {

                    $photo->delete();

                }
               

            }

            return redirect()->back();

        } else {

            $request->session()->flash('no_selected', 'Please select the photo/s you want to delete.');

            return redirect()->back();

        }

        

    }
}

<?php

namespace App\Http\Controllers;

use App\Models\RequestType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class RequestTypeController extends Controller
{
    public function index()
    {
        if(session('userType') != null || session('userType') != '' ){
            if(session('userType') == 'admin'){
                $datas = RequestType::orderBy('id', 'DESC')->get();
                return view('requestmaster.index', compact('datas'));
            }else{
                return Redirect::back();
            }
        }else{
          return redirect()->route('login');
        }
        
    }
    
    public function create()
    {
        if(session('userType') != null || session('userType') != '' ){
            if(session('userType') == 'admin'){
                return view('requestmaster.create');
            }else{
                return Redirect::back();
            }
        }else{
            return redirect()->route('login');
        }    
    }

    public function store(Request $request)
    {
        if(session('userType') != null || session('userType') != ''){
            if(session('userType') == 'admin'){
                $this->validate($request, [
                    'name' => 'required|unique:request_types',
                    'status' => 'required|in:1,0',
                ]);
                $data = new RequestType;
                $data->name = $request->name;
                $data->status = $request->status;
                $data->save();
                return redirect()->route('reqtype.index')->with('success','Requst Type Created Successfully');
            }else{
                return redirect()->route('dashboard');
            }
        }else{
            return redirect()->route('login');
        }
    }

    public function edit(Request $request, $id)
    {  
        if(session('userType') != null || session('userType') != ''){
            $editData = RequestType::find(Crypt::decrypt($id));
            return view('requestmaster.edit', compact('editData'));
        }else{
            return redirect()->route('/');
        }
    }

    public function update(Request $request, $id)
    {
        if(session('userType') != null || session('userType') != ''){
            if(session('userType') == 'admin'){
                $this->validate($request, [
                    'name' => 'integer|unique:request_types', 
                    'status' => 'required|in:1,0',
                ]);
                $dataUp = RequestType::find(Crypt::decrypt($id));
                $dataUp->name = $request->name;
                $dataUp->status = $request->status;
                $dataUp->update();
                return redirect()->route('reqtype.index')->with('success','Requst Type Updated Successfully'); 
            }else{
                return redirect()->route('dashboard');
            }
        }else{
            return redirect()->route('login');
        }
    }

}

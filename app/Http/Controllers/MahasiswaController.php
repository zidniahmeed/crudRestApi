<?php

namespace App\Http\Controllers;

use App\helpers\ApiFormatter;
use App\Models\Mahasiswa;
use Exception;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\TryCatch;

class MahasiswaController extends Controller
{
    public function index(){
        $data = Mahasiswa::all();

        if ($data) {
            return ApiFormatter::createApi(200, 'success', $data);
        }else{
            return ApiFormatter::createApi(400,'failed');
        }
    }

    public function store(Request $request){
        try {
            $request->validate([
                'username' => 'required',
                'address' => 'required'
            ]);            
            $mahasiswa = Mahasiswa::create([
                'username' => $request->username,
                'address' => $request->address
            ]);
            $data = Mahasiswa::where('id','=',$mahasiswa->id)->get();
            if ($data) {
                return ApiFormatter::createApi(200, 'success ', $data);
            }else{
                return ApiFormatter::createApi(400,'failed');
            }
        } catch (Exception $error) {
            return ApiFormatter::createApi(400,'failed');
        }
    }

    public function show($id){
        $data = Mahasiswa::where('id','=',$id)->get();
            if ($data) {
                return ApiFormatter::createApi(200, 'success', $data);
            }else{
                return ApiFormatter::createApi(400,'failed');
            }
    }

    public function update(Request $request, $id){
        try {
            $request->validate([
                'username' => 'required',
                'address' => 'required'
            ]);
            $mahasiswa = Mahasiswa::findOrFail($id);            

            $mahasiswa->update([
                'username' => $request->username,
                'address' => $request->address
            ]);
            $data = Mahasiswa::where('id','=',$mahasiswa->id)->get();
            if ($data) {
                return ApiFormatter::createApi(200, 'success', $data);
            }else{
                return ApiFormatter::createApi(400,'failed');
            }
        } catch (Exception $error) {
            return ApiFormatter::createApi(400,'failed');
        }
    }

    public function destroy($id){
        try {
            
        $mahasiswa = Mahasiswa::findOrFail($id);

        $data = $mahasiswa->delete();
        if ($data) {
            return ApiFormatter::createApi(200, 'success delete data', $data);
        }else{
            return ApiFormatter::createApi(400,'failed');
        }
        } catch (Exception $error) {
            return ApiFormatter::createApi(400,'failed');
        }


    }
}

<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Models\Classdemo;


class ClassdemoController extends Controller
{
    public function create(Request $request)
    {
        $classdemo = new Classdemo();
        $classdemo->name = $request->name;
        $classdemo->gioitinh = $request->gioitinh;
        $classdemo->birthday = $request->birthday;
        $classdemo->user_id = $request->user()->id;
        $classdemo->save();

        return response()->json([
            'success' => true,
            'classdemo' => $classdemo
        ]);
    }
}
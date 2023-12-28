<?php

namespace App\Http\Controllers;

use App\Http\Requests\OnlineorderEditRequest;
use App\Http\Requests\OnlineorderRequest;
use App\Models\Onlineorder;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class OnlineorderController extends Controller
{
    public function index()
    {
        return view('book.onlineorderview')->with('data', Onlineorder::all());
    }

    public function create()
    {
        return view('book.order')->with('editMode', false);
    }

    public function store(OnlineorderRequest $request)
    {


//        if ($request->package != '')
//        {
//            $request->validate([
//                'package'          => 'required',
//                'address'          => 'required',
//                'city'             => 'required',
//                'state'            => 'required',
//                'zipcode'          => 'required',
//                'appointment_time' => 'required',
//
//            ]);
//        }
//        elseif ($request->categories || $request->categories != '')
//        {
//            $request->validate([
//                'categories'       => 'required',
//                'service'          => 'required',
//                'address'          => 'required',
//                'city'             => 'required',
//                'state'            => 'required',
//                'zipcode'          => 'required',
//                'appointment_time' => 'required',
//            ]);
//        }
//        else
//        {
//            $request->validate([
//                'package'          => 'required',
//                'categories'       => 'required',
//                'service'          => 'required',
//                'address'          => 'required',
//                'city'             => 'required',
//                'state'            => 'required',
//                'zipcode'          => 'required',
//                'appointment_time' => 'required',
//            ]);
//
//        }


        if ($request->package != '')
        {
            $str1 = implode(',', $request->package);
        }

        if ($request->categories != '')
        {
            $str2 = implode(',', $request->categories);
        }

        if ($request->service != '')
        {
            $str3 = implode(',', $request->service);
        }

        $carbonDateTime = Carbon::createFromFormat('m/d/Y g:i A', $request->appointment_time);

        Onlineorder::create([
            'package'          => isset($str1) ? $str1 : '',
            'categories'       => isset($str2) ? $str2 : '',
            'service'          => isset($str3) ? $str3 : '',
            'address'          => $request->address,
            'city'             => $request->city,
            'state'            => $request->state,
            'zipcode'          => $request->zipcode,
            'appointment_time' => $carbonDateTime->format('Y-m-d H:i:s'),
            'updated_at'       => now(),
            'created_at'       => Carbon::now(),
        ]);

        return redirect(route('online.create'));

    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $online   = Onlineorder::find($id);
        $dateTime = Carbon::create($online->appointment_time)->format('m-d-y H:i:s');

//        dd($dateTime);
        return view('book.order')
            ->with('online', $online)
            ->with('package', explode(',', $online->package))
            ->with('categories', explode(',', $online->categories))
            ->with('service', explode(',', $online->service))
            ->with('appointment_time', ($dateTime))
            ->with('editMode', true);
    }

    public function update(OnlineorderEditRequest $request, $id)
    {

        if ($request->package != '')
        {
            $str1 = implode(',', $request->package);
        }

        if ($request->categories != '')
        {
            $str2 = implode(',', $request->categories);
        }

        if ($request->service != '')
        {
            $str3 = implode(',', $request->service);
        }

        $dateTime                 = Carbon::create($request->appointment_time)->format('Y-m-d H:i:s');
        $online                   = Onlineorder::find($id);
        $online->package          = isset($str1) ? $str1 : '';
        $online->categories       = isset($str2) ? $str2 : '';
        $online->service          = isset($str3) ? $str3 : '';
        $online->address          = $request->input('address');
        $online->city             = $request->input('city');
        $online->state            = $request->input('state');
        $online->zipcode          = $request->input('zipcode');
        $online->appointment_time = $dateTime;
        $online->update();
        return redirect(route('online.index'));
    }

    public function destroy($id)
    {
        $online = Onlineorder::find($id);
        if ($online)
        {
            $online->delete();
        }
        return redirect(route('online.index'));
    }
}

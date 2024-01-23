<?php

namespace App\Http\Controllers\Backend;

use App\Http\Requests\Backend\AppointmentStoreRequest;
use App\Http\Requests\Backend\AppointmentUpdateRequest;
use App\Models\Category;
use App\Models\Onlineorders;
use App\Models\Service;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    public function index(Request $request)
    {
        $search       = $request->input('search', '');
        $status       = $request->input('status', '');
        $appointments = Onlineorders::when($search, function ($query) use ($search)
        {
            return $query->where(function ($query) use ($search)
            {
                $query->orWhere('type', 'LIKE', '%' . $search . '%');
            });
        })->when($status, function ($query) use ($status)
        {
            return $query->where('status', $status);
        })->sortable(['service' => 'asc'])->paginate(5);
        return view('Backend.appointment.index')->with('appointments', $appointments);
    }

    public function create()
    {
        $category = Category::pluck('type', 'id')->toArray();
        $service  = Service::pluck('name', 'id')->toArray();
        return view('Backend.appointment.appointment_form')->with('editMode', false)
            ->with('status', ['' => 'Select one', 'Active' => 'Active', 'Inactive' => 'Inactive'])
            ->with('category', $category)
            ->with('service', $service);
    }

    public function store(AppointmentStoreRequest $request)
    {



        foreach (request('service_id') as $serviceId)
        {
            Onlineorders::create([
                'service_id' => $serviceId,
                'type'       => $request->type,
                'date'       => Carbon::createFromFormat('m/d/Y g:i A', $request->date)->format('Y-m-d H:i:s'),
                'user_id'    => auth()->user()->id,
                'status'     => 'Active',
                'updated_at' => now(),
                'created_at' => Carbon::now(),
            ]);
        }

        session()->put('add', 'data add');
        return redirect(route('admin.appointment.index'));

    }

    public function show($id)
    {
        $appointment = Onlineorders::find($id);
        return view('Backend.appointment.show', ['appointment' => $appointment]);
    }

    public function edit($id)
    {
        $category = Category::pluck('type', 'id')->toArray();
        $service = Service::pluck('name', 'id')->toArray();
        $appointment = Onlineorders::find($id);

        return view('Backend.appointment.appointment_form')
            ->with('appointment', $appointment)
            ->with('type', $appointment->type)
            ->with('date', Carbon::create($appointment->date)->format('m-d-y H:i:s'))
            ->with('status', ['' => 'Select one', 'Active' => 'Active', 'Inactive' => 'Inactive'])
            ->with('editMode', true)
            ->with('category', $category)
            ->with('service', $service);
    }

    public function update(AppointmentUpdateRequest $request, $id)
    {
        $dateTime                = Carbon::create($request->date)->format('Y-m-d H:i:s');
        $appointment             = Onlineorders::find($id);
        $appointment->categories = $request->input('categories');
        $appointment->service_id = $request->input('service_id');
        $appointment->type       = $request->input('type');
        $appointment->date       = $dateTime;
        $appointment->status     = $request->input('status');
        $appointment->update();

        session()->put('update', 'data update');
        return redirect(route('admin.appointment.index'));
    }

    public function destroy($id)
    {
        try
        {
            $appointment = Onlineorders::find($id);
            if ($appointment)
            {
                $appointment->delete();
            }
            return response()->json(['status' => true, 'message' => 'Record deleted successfully'], 200);
        }
        catch (\Exception $e)
        {
            return response()->json(['status' => false, 'message' => 'Record was not deleted'], 400);
        }
    }

    public function fetchServices()
    {
        $service= Service::whereIn('category_id',request()->get('id'))->pluck('name','id')->toArray();
        $view = view('Backend.appointment.fetch_service')->with('service',$service)->render();
        return response()->json(['status' => true, 'view' => $view], 200);
    }
}

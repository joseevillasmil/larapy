<?php

namespace App\Http\Controllers;

use App\Device;
use Illuminate\Http\Request;

class DeviceController extends Controller
{
    function index() {
        $devices = Device::get();
        return response()->json($devices);
    }

    function show($id) {
        $device = Device::find($id);
        return response()->json($device);
    }

    function store(Request $request, $id) {
        $device = new Device();
        $device->fill($request);
        $device->save();
        return response()->json('ok');
    }

    function update(Request $request, $id) {
        $device = Device::find($id);
        $device->fill($request);
        $device->save();
        return response()->json('ok');
    }

    function execute(Request $request) {
        $return = shell_exec(base_path('send_command_serial.py') . env('device_id') . ' ' . env('serial_port') . ' ' . $request->device_id . ' ' . $request->command . ' ' . $request->value);
        if($return) {
            return response()->json([
                'error' => 0,
                'value' => $return
            ]);
        } else {
            return response()->json([
                'error' => 1,
                'value' => ''
            ], 401);
        }
    }
}

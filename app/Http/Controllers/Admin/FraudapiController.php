<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Fraudapi;

class FraudapiController extends Controller
{
    // Show all fraud APIs with edit form in one blade
    public function fraudapi_manage()
    {
        $fraudapis = Fraudapi::all();
        return view('backEnd.apiintegration.fraudapis', compact('fraudapis'));
    }

    // Save/Update APIs from the single form
    public function fraudapi_update(Request $request)
    {
        $apis = $request->input('apis', []);

        // Step 1: Validate all inputs
        foreach ($apis as $id => $data) {
            validator($data, [
                'url' => 'required|url',
                'api_key' => 'required|string',
            ])->validate();
        }

        // Step 2: Set all APIs to inactive
        Fraudapi::query()->update(['active_status' => 0]);

        // Step 3: Update each API with url and api_key (type is readonly, so not updated)
        foreach ($apis as $id => $data) {
            Fraudapi::where('id', $id)->update([
                'url' => $data['url'],
                'api_key' => $data['api_key'],
            ]);
        }

        // Step 4: Set selected active API
        if ($request->has('active_api_id')) {
            Fraudapi::where('id', $request->active_api_id)->update([
                'active_status' => 1
            ]);
        }

        return redirect()->route('fraudapi.manage')->with('success', 'Fraud APIs updated successfully.');
    }

    public function frontendHome()
        {
         $activeApi = Fraudapi::where('active_status', 1)->first();
            return view('backEnd.order.index', compact('activeApi'));
        }


}
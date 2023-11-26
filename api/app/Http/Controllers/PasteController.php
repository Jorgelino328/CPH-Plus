<?php
namespace App\Http\Controllers;

use App\Http\Requests\PasteRequest;
use App\Models\Paste;
use Illuminate\Support\Facades\Hash;

class PasteController extends Controller
{
    public function create(PasteRequest $request)
    {
        $data = $request->validated();

        $data['tags']       = $request->tags ? implode(',', $request->tags) : null;
        $data['user_id']    = auth()->guard('sanctum')->id();
        $data['password']   = $request->password ? Hash::make($request->password) : null;
        $data['expiration'] = $request->seconds_to_expire
            ? \Carbon\Carbon::now()->addSeconds($request->seconds_to_expire)
            : null;

        Paste::create($data);

        return response()->json([
            'message' => 'Paste has been successfully created.'
        ], 201);
    }

    public function update(Paste $paste, PasteRequest $request)
    {
        if ($paste->user_id != auth()->id())
        {
            return response()->json([
                'message' => 'You can only update your own pastes.'
            ], 401);
        }

        $data = $request->validated();

        $data['tags']       = $request->tags ? implode(',', $request->tags) : null;
        $data['password']   = $request->password ? Hash::make($request->password) : null;
        $data['expiration'] = $request->seconds_to_expire
            ? \Carbon\Carbon::now()->addSeconds($request->seconds_to_expire)
            : null;

        $paste->update($data);

        return response()->json([
            'message' => 'Paste has been successfully updated.'
        ]);
    }

    public function destroy(Paste $paste)
    {
        if ($paste->user_id != auth()->id())
        {
            return response()->json([
                'message' => 'You can only delete your own pastes.'
            ], 401);
        }

        return response()->json([
            'message' => 'Paste has been successfully deleted.'
        ]);
    }
}

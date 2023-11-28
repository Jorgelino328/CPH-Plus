<?php
namespace App\Http\Controllers;

use App\Http\Requests\PasteRequest;
use App\Models\Paste;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PasteController extends Controller
{
    public function show(Paste $paste, Request $request)
    {
        if ($paste->password && !Hash::check($request->password, $paste->password))
        {
            return response()->json([
                'message' => 'Wrong paste password.'
            ], 401);
        }

        $paste->tags = $paste->tags
            ? explode(',', $paste->tags)
            : null;

        $paste->access_logs()->create([
            'user_id'    => auth()->guard('sanctum')->id(),
            'ip'         => $request->ip(),
            'user_agent' => $request->header('User-Agent')
        ]);

        return response()->json($paste);
    }

    public function create(PasteRequest $request)
    {
        $data = $request->validated();

        $data['tags']       = $request->tags ? implode(',', $request->tags) : null;
        $data['user_id']    = auth()->guard('sanctum')->id();
        $data['password']   = $request->password ? Hash::make($request->password) : null;
        $data['expiration'] = $request->seconds_to_expire
            ? \Carbon\Carbon::now()->addSeconds($request->seconds_to_expire)
            : null;

        $paste = Paste::create($data);

        return response()->json([
            'message'   => 'Paste has been successfully created.',
            'id'        => $paste->id
        ], 201);
    }

    public function like(Paste $paste)
    {
        $paste->likes()->firstOrCreate([
            'paste_id'  => $paste->id,
            'user_id'   => auth()->id()
        ]);

        return response()->json([
            'message' => 'Paste liked successfully.'
        ]);
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

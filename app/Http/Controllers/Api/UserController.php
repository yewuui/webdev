<?php
namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Models\User; // <-- 1. Tambahkan ini
use Illuminate\Http\Request;
class UserController extends Controller
{
    public function getUsers(){ // <-- 2. Samakan dengan route (pakai 's')
        $user = User::all();
        return response()->json([
            'status' => 200,
            'user' => $user
        ]);
    }
    public function PutUser(Request $request, $id){
        $user = User::find($id);

        if (!$user) {
            return response()->json([
                'status' => 404,
                'message' => 'User not found'
            ], 404);
        }
        // 2. Jika user ADA, lakukan update
        if ($request->has('name')) {
            $user->name = $request->input('name');
        }
        if ($request->has('email')) {
            $user->email = $request->input('email');
        }
        $user->save();
        return response()->json([
            'status' => 200,
            'message' => 'User updated successfully',
            'user' => $user
        ]);
    }
    
    public function DeleteUser($id){
        $user = User::find($id);
        if (!$user) {
            return response()->json([
                'status' => 404,
                'message' => 'User not found'
            ]);
        }
        $user->delete();
        return response()->json([
            'status' => 200,
            'message' => 'User deleted'
        ]);
    }
}

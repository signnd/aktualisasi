<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Kabupaten;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RegisteredUsersController extends Controller
{
    /**
     * Display a listing of registered users.
     */
    public function index()
    {
        // Hanya admin yang bisa melihat semua user
        if (Auth::user()->user_role !== 'admin') {
            abort(403, 'Anda tidak memiliki akses untuk melihat daftar pengguna.');
        }

        $users = User::with('kabupaten')
            ->orderBy('created_at', 'desc')
            ->paginate(20);
    
        $kabupatens = Kabupaten::orderBy('kabupaten')->get();
        
        return view('users.registered', compact('users', 'kabupatens'));    }

    /**
     * Update user role
     */
    /**
     * Update user data
     */
    public function update(Request $request, User $user)
    {
        if (Auth::user()->user_role !== 'admin') {
            abort(403, 'Anda tidak memiliki akses untuk mengubah data pengguna.');
        }

        $request->validate([
            'user_role' => 'required|in:admin,user',
            'kabupaten_id' => 'nullable|exists:kabupaten,id',
            'satuan_kerja' => 'nullable|string|max:255'
        ]);

        $user->update([
            'user_role' => $request->user_role,
            'kabupaten_id' => $request->kabupaten_id,
            'satuan_kerja' => $request->satuan_kerja
        ]);

        return redirect()->route('registered-users.index')
            ->with('success', 'Data pengguna berhasil diperbarui.');
    }
    /**
     * Delete user
     */
    public function destroy(User $user)
    {
        if (Auth::user()->user_role !== 'admin') {
            abort(403, 'Anda tidak memiliki akses untuk menghapus pengguna.');
        }

        // Prevent deleting own account
        if ($user->id === Auth::id()) {
            return redirect()->route('registered-users.index')
                ->with('error', 'Anda tidak dapat menghapus akun Anda sendiri.');
        }

        $user->delete();

        return redirect()->route('registered-users.index')
            ->with('success', 'Pengguna berhasil dihapus.');
    }
}
<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\TryCatch;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {

            $data = User::query();

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btnEdit = '<a href="'.route('users.edit', $row->id).'" class="edit btn btn-warning btn-sm">Edit</a>';
                    $btnDelete = '<a data-url="'. route('users.destroy', $row->id) .'" class="delete btn btn-danger btn-sm">Delete</a>';
                    return $btnEdit . $btnDelete;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('admin.user.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = User::findOrFail($id);
        return view('admin.user.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $data = User::findOrFail($id);
            $requestData['name'] = $request->name;
            $requestData['email'] = $request->email;
            if($request->filled('password')){
                $requestData['password'] = Hash::make($request->password);
            }
            $data->update($requestData);
            return redirect()->route('users.index')->with('success', 'Data berhasil diperbarui.');
        } catch (\Exception $e) {
            // Jika terjadi error lain
            return redirect()->back()->with('error', 'Terjadi kesalahan saat mengupdate data.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $data = User::findOrFail($id);
            $data->delete();
            return response()->json([
                'message' => 'Data berhasil dihapus.',
            ], 200);
        } catch (\Exception $e) {
            // Jika terjadi error lain
            return response()->json([
                'message' => 'Terjadi kesalahan saat menghapus data.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}

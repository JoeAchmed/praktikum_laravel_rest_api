<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Check if the 'sort' and 'order' parameters are present in the URL
        if (request()->has('sort') && request()->has('order')) {
            // Get the values of 'sort' and 'order' parameters from the URL
            $sort = request('sort');
            $order = request('order');

            // Validate the 'order' parameter to prevent SQL injection
            $validOrders = ['asc', 'desc'];
            $order = in_array(strtolower($order), $validOrders) ? strtolower($order) : 'asc';

            // Apply sorting based on 'sort' and 'order' parameters
            $students = Student::orderBy($sort, $order)->get();
        } else if (request()->has('name')) {
            // Get the value of 'name' parameter from the URL
            $name = request('name');

            // Filter students by name
            $students = Student::where('nama', 'LIKE', "%$name%")->get();
        } else if (request()->has('major')) {
            // Get the value of 'major' parameter from the URL
            $major = request('major');

            // Filter students by name
            $students = Student::where('jurusan', 'LIKE', "%$major%")->get();
        } else {
            $students = Student::all();
        }

        $result = [
            'message' => 'Success',
            'data' => $students
        ];

        return response()->json($result, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'nama' => 'required',
            'nim' => 'numeric|required',
            'email' => 'email|required',
            'jurusan' => 'required'
        ]);

        $student = Student::create($validateData);

        $data = [
            'message' => 'Student is created successfully',
            'data' => $student
        ];

        return response()->json($data, 201);
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $student = Student::find($id);

        if (!$student) {
            return response()->json(['message' => "Data student dengan id $id tidak ditemukan"], 404);
        }

        $result = [
            'message' => 'Success',
            'data' => $student
        ];

        return response()->json($result, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $student = Student::find($id);

        if (!$student) {
            return response()->json(['message' => "Data student dengan id $id tidak ditemukan"], 404);
        }

        $student->update([
            'nama' => $request->nama ?? $student->nama,
            'nim' => $request->nim ?? $student->nim,
            'email' => $request->email ?? $student->email,
            'jurusan' => $request->jurusan ?? $student->jurusan
        ]);

        $student->save();

        $result = [
            'message' => "Data student dengan id $id berhasil diperbarui",
            'data' => $student
        ];

        return response()->json($result, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $student = Student::find($id);

        if (!$student) {
            return response()->json(['message' => "Data student dengan id $id tidak ditemukan"], 404);
        }

        $student->delete();

        $result = [
            'message' => "Data student dengan id $id berhasil dihapus",
        ];

        return response()->json($result, 200);
    }
}

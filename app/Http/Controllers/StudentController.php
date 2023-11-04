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
        // yang telah di provide laravel
        $students = Student::all();

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
        $input = [
            'nama' => $request->nama ?? "",
            'nim' => $request->nim ?? "",
            'email' => $request->email ?? "",
            'jurusan' => $request->jurusan ?? ""
        ];

        $student = Student::create($input);

        $result = [
            'message' => 'Data berhasil dibuat',
            'data' => $student
        ];

        return response()->json($result, 201);
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

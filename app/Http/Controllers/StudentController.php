<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // yang telah di provide laravel
        $students = Student::all();
        return response()->json($students, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $input = [
            'nama' => $request->nama,
            'nim' => $request->nim,
            'email' => $request->email,
            'jurusan' => $request->jurusan
        ];

        $students = Student::create($input);

        $result = [
            'message' => 'Data berhasil dibuat',
            'data' => $students
        ];

        return response()->json($result, 201);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $student = Student::find($id);

        if (!$student) {
            return response()->json(['message' => 'Data student tidak ditemukan'], 404);
        }

        $student->nama = $request->nama;
        $student->nim = $request->nim;
        $student->email = $request->email;
        $student->jurusan = $request->jurusan;
        $student->save();

        $result = [
            'message' => 'Data student berhasil diperbarui',
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
            return response()->json(['message' => 'Data student tidak ditemukan'], 404);
        }

        $student->delete();

        $result = [
            'message' => 'Data student berhasil dihapus',
            'data' => $student
        ];

        return response()->json($result, 200);
    }
}

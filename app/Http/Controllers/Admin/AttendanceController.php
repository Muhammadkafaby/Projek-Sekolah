<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\Classes;
use App\Models\Student;
use Illuminate\Http\Request;
use Inertia\Inertia;

class AttendanceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Inertia::render('Admin/Attendance/Index', [
            'attendances' => Attendance::with(['student', 'class'])->paginate(10),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Admin/Attendance/Create', [
            'classes' => Classes::all(),
            'students' => Student::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'date' => 'required|date',
            'class_id' => 'required|exists:classes,id',
            'attendances' => 'required|array',
        ]);

        foreach ($request->attendances as $student_id => $status) {
            Attendance::updateOrCreate(
                [
                    'date' => $request->date,
                    'student_id' => $student_id,
                ],
                [
                    'class_id' => $request->class_id,
                    'status' => $status,
                ]
            );
        }

        return redirect()->route('admin.attendances.index')->with('success', 'Absensi berhasil diinput.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Attendance $attendance)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Attendance $attendance)
    {
        return Inertia::render('Admin/Attendance/Edit', [
            'attendance' => $attendance,
            'classes' => Classes::all(),
            'students' => Student::all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Attendance $attendance)
    {
        $request->validate([
            'date' => 'required|date',
            'class_id' => 'required|exists:classes,id',
            'student_id' => 'required|exists:students,id',
            'status' => 'required',
        ]);

        $attendance->update($request->all());

        return redirect()->route('admin.attendances.index')->with('success', 'Absensi berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Attendance $attendance)
    {
        $attendance->delete();

        return redirect()->route('admin.attendances.index')->with('success', 'Absensi berhasil dihapus.');
    }
}

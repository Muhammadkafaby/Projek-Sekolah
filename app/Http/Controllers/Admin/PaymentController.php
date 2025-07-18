<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Billing;
use App\Models\Student;
use App\Models\PaymentType;
use Illuminate\Http\Request;
use Inertia\Inertia;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Inertia::render('Admin/Payment/Index', [
            'billings' => Billing::with(['student', 'paymentType'])->paginate(10),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Admin/Payment/Create', [
            'students' => Student::all(),
            'paymentTypes' => PaymentType::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'student_id' => 'required|exists:students,id',
            'payment_type_id' => 'required|exists:payment_types,id',
            'amount' => 'required|numeric',
            'due_date' => 'required|date',
        ]);

        Billing::create($request->all());

        return redirect()->route('admin.payments.index')->with('success', 'Tagihan berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Billing $billing)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Billing $billing)
    {
        return Inertia::render('Admin/Payment/Edit', [
            'billing' => $billing,
            'students' => Student::all(),
            'paymentTypes' => PaymentType::all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Billing $billing)
    {
        $request->validate([
            'student_id' => 'required|exists:students,id',
            'payment_type_id' => 'required|exists:payment_types,id',
            'amount' => 'required|numeric',
            'due_date' => 'required|date',
            'status' => 'required',
        ]);

        $billing->update($request->all());

        return redirect()->route('admin.payments.index')->with('success', 'Tagihan berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Billing $billing)
    {
        $billing->delete();

        return redirect()->route('admin.payments.index')->with('success', 'Tagihan berhasil dihapus.');
    }
}

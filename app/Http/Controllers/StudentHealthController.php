<?php

namespace App\Http\Controllers;

use App\Models\StudentHealthAppointment;
use App\Models\StudentHealthDocument;
use App\Models\StudentHealthProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class StudentHealthController extends Controller
{
    public function index()
    {
        $student = Auth::user()?->students;

        if (!$student) {
            return view('StudentPanel.health.index', ['student' => null]);
        }

        $profile = StudentHealthProfile::firstOrCreate(['student_id' => $student->id]);

        $appointments = StudentHealthAppointment::where('student_id', $student->id)
            ->orderByDesc('appointment_date')->get();
        $documents = StudentHealthDocument::where('student_id', $student->id)
            ->orderByDesc('record_date')->get();

        return view('StudentPanel.health.index', compact('student', 'profile', 'appointments', 'documents'));
    }

    public function updateProfile(Request $request)
    {
        $student = $this->studentOrAbort();

        $data = $request->validate([
            'blood_group' => 'nullable|string|max:10',
            'allergies' => 'nullable|string|max:2000',
            'chronic_conditions' => 'nullable|string|max:2000',
            'medications' => 'nullable|string|max:2000',
            'insurance_provider' => 'nullable|string|max:255',
            'insurance_number' => 'nullable|string|max:255',
            'emergency_notes' => 'nullable|string|max:2000',
        ]);

        StudentHealthProfile::updateOrCreate(['student_id' => $student->id], $data);

        return back()->with('success', 'Medical profile updated.');
    }

    public function storeAppointment(Request $request)
    {
        $student = $this->studentOrAbort();

        $data = $request->validate([
            'provider_name' => 'required|string|max:255',
            'appointment_date' => 'required|date',
            'reason' => 'nullable|string|max:1000',
            'status' => 'required|in:upcoming,completed,cancelled',
        ]);

        StudentHealthAppointment::create(array_merge($data, ['student_id' => $student->id]));

        return back()->with('success', 'Appointment added.');
    }

    public function destroyAppointment(StudentHealthAppointment $appointment)
    {
        $this->authorizeStudent($appointment->student_id);
        $appointment->delete();

        return back()->with('success', 'Appointment removed.');
    }

    public function storeDocument(Request $request)
    {
        $student = $this->studentOrAbort();

        $data = $request->validate([
            'title' => 'required|string|max:255',
            'record_type' => 'required|in:discharge,lab,prescription,other',
            'record_date' => 'nullable|date',
            'file' => 'required|file|max:10240|mimes:pdf,jpg,jpeg,png',
        ]);

        $path = $request->file('file')->store('health-documents', 'public');

        StudentHealthDocument::create([
            'student_id' => $student->id,
            'title' => $data['title'],
            'record_type' => $data['record_type'],
            'record_date' => $data['record_date'] ?? null,
            'file_path' => $path,
        ]);

        return back()->with('success', 'Document uploaded.');
    }

    public function destroyDocument(StudentHealthDocument $document)
    {
        $this->authorizeStudent($document->student_id);
        Storage::disk('public')->delete($document->file_path);
        $document->delete();

        return back()->with('success', 'Document removed.');
    }

    private function studentOrAbort()
    {
        $student = Auth::user()?->students;
        abort_if(!$student, 403);

        return $student;
    }

    private function authorizeStudent(int $studentId): void
    {
        abort_if(Auth::user()?->students?->id !== $studentId, 403);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\studentEnrollDetails;
use App\Services\TeacherContextService;
use Illuminate\Http\Request;

class StudentApplicants extends Controller
{
    public function __construct(private TeacherContextService $teacherContext)
    {
    }

    public function ViewStudentApplicants()
    {
        return view('TeacherPanel.studentenrollment.applicants', [
            'pendingapplicants' => $this->applicantsByStatus('pending'),
            'approvedapplicants' => $this->applicantsByStatus('approved'),
            'rejectedapplicants' => $this->applicantsByStatus('rejected'),
        ]);
    }

    public function RejectApplicant(Request $request, int $id)
    {
        $applicant = $this->findForSchool($id);

        if (!$applicant) {
            return redirect()->back()->with('error', 'Applicant not found.');
        }

        $applicant->update(['status' => 'rejected']);

        return redirect()->back()->with('success', 'Applicant rejected successfully.');
    }

    public function ApproveApplicant(Request $request, int $id)
    {
        $applicant = $this->findForSchool($id);

        if (!$applicant) {
            return redirect()->back()->with('error', 'Applicant not found.');
        }

        $applicant->update(['status' => 'approved']);

        return redirect()->back()->with('success', 'Applicant approved for entrance exam.');
    }

    public function GetApplicantsCounts(Request $request)
    {
        $schoolId = $this->teacherContext->schoolId();

        if (!$schoolId) {
            return response()->json(['pending' => 0, 'approved' => 0, 'rejected' => 0]);
        }

        return response()->json([
            'pending' => $this->countApplicants($schoolId, 'pending'),
            'approved' => $this->countApplicants($schoolId, 'approved'),
            'rejected' => $this->countApplicants($schoolId, 'rejected'),
        ]);
    }

    private function findForSchool(int $id): ?studentEnrollDetails
    {
        $schoolId = $this->teacherContext->schoolId();

        if (!$schoolId) {
            return null;
        }

        return studentEnrollDetails::where('id', $id)
            ->whereHas('studentEnrollment', fn ($q) => $q->where('school_id', $schoolId))
            ->first();
    }

    private function applicantsByStatus(string $status)
    {
        $schoolId = $this->teacherContext->schoolId();

        if (!$schoolId) {
            return collect();
        }

        return studentEnrollDetails::with('studentEnrollment')
            ->whereHas('studentEnrollment', fn ($q) => $q->where('school_id', $schoolId))
            ->where('status', $status)
            ->get();
    }

    private function countApplicants(int $schoolId, string $status): int
    {
        return studentEnrollDetails::whereHas('studentEnrollment', fn ($q) => $q->where('school_id', $schoolId))
            ->where('status', $status)
            ->count();
    }
}

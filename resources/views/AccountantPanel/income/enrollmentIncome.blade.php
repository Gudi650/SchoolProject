@php
  $stats = $stats ?? ['pending' => 0, 'approved' => 0, 'rejected' => 0, 'total' => 0];
  $pending = $pending ?? collect();
  $byGrade = $byGrade ?? collect();
  $gradeMax = max(1, (int) ($byGrade->max() ?: 0));
@endphp

<x-Account-sidebar>
  <x-slot name="title">Enrollment Income</x-slot>

  <main class="p-4 sm:p-6 bg-slate-50 min-h-screen">
    <div class="mb-6 rounded-lg border border-indigo-100 bg-indigo-50 px-4 sm:px-6 py-4">
      <div class="flex flex-col lg:flex-row lg:items-start lg:justify-between gap-4">
        <div>
          <h1 class="text-xl sm:text-2xl font-bold text-slate-900">Enrollment Income</h1>
          <p class="text-xs sm:text-sm text-slate-700 mt-1">Read-only view of enrollment applications for this school</p>
        </div>
        <a href="{{ route('accounting.incomeManagement') }}" class="px-3 sm:px-4 py-2 text-xs sm:text-sm font-medium text-slate-700 bg-white border border-slate-200 rounded-lg hover:bg-slate-100 transition-colors flex items-center gap-2 justify-center w-full sm:w-auto">
          <i data-lucide="arrow-left" class="w-4 h-4"></i>
          Back to income
        </a>
      </div>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-4 mb-6">
      <div class="bg-white rounded-xl p-4 border border-amber-100 shadow-sm">
        <p class="text-xs sm:text-sm text-slate-600">Pending</p>
        <p class="text-xl sm:text-2xl font-bold text-slate-900 mt-2">{{ number_format($stats['pending']) }}</p>
        <p class="text-xs text-amber-700 mt-2">Waiting for a decision</p>
      </div>
      <div class="bg-white rounded-xl p-4 border border-green-100 shadow-sm">
        <p class="text-xs sm:text-sm text-slate-600">Approved</p>
        <p class="text-xl sm:text-2xl font-bold text-slate-900 mt-2">{{ number_format($stats['approved']) }}</p>
      </div>
      <div class="bg-white rounded-xl p-4 border border-red-100 shadow-sm">
        <p class="text-xs sm:text-sm text-slate-600">Rejected</p>
        <p class="text-xl sm:text-2xl font-bold text-slate-900 mt-2">{{ number_format($stats['rejected']) }}</p>
      </div>
      <div class="bg-white rounded-xl p-4 border border-indigo-100 shadow-sm">
        <p class="text-xs sm:text-sm text-slate-600">All applications</p>
        <p class="text-xl sm:text-2xl font-bold text-slate-900 mt-2">{{ number_format($stats['total']) }}</p>
      </div>
    </div>

    @if ($byGrade->isNotEmpty())
      <div class="bg-white rounded-xl border border-slate-200 shadow-sm p-4 sm:p-5 mb-6">
        <h2 class="text-base sm:text-lg font-semibold text-slate-900 mb-4">Pending by grade</h2>
        <div class="space-y-4 text-sm">
          @foreach ($byGrade as $grade => $count)
            @php $width = round(($count / $gradeMax) * 100); @endphp
            <div>
              <div class="flex items-center justify-between mb-1">
                <span class="text-slate-600">{{ $grade }}</span>
                <span class="font-semibold text-slate-900">{{ number_format($count) }}</span>
              </div>
              <div class="w-full h-2 bg-slate-100 rounded-full"><div class="h-2 bg-indigo-500 rounded-full" style="width: {{ $width }}%"></div></div>
            </div>
          @endforeach
        </div>
      </div>
    @endif

    <div>
      <h2 class="text-base sm:text-lg font-semibold text-slate-900 mb-4">Pending applicants</h2>
      <div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-x-auto">
        <table class="w-full text-left text-sm">
          <thead class="bg-indigo-50 border-b border-indigo-100">
            <tr>
              <th class="px-4 py-3 font-medium text-indigo-900">Applicant</th>
              <th class="px-4 py-3 font-medium text-indigo-900">Grade</th>
              <th class="px-4 py-3 font-medium text-indigo-900">Admission date</th>
              <th class="px-4 py-3 font-medium text-indigo-900">Previous school</th>
              <th class="px-4 py-3 font-medium text-indigo-900">Status</th>
            </tr>
          </thead>
          <tbody class="divide-y divide-slate-100">
            @forelse ($pending as $detail)
              @php
                $student = $detail->studentEnrollment;
                $name = trim(implode(' ', array_filter([
                    $student->fname ?? null,
                    $student->mname ?? null,
                    $student->lname ?? null,
                ])));
              @endphp
              <tr class="hover:bg-indigo-50 transition-colors">
                <td class="px-4 py-3">{{ $name !== '' ? $name : '—' }}</td>
                <td class="px-4 py-3">{{ $detail->grade_applied_for ?: '—' }}</td>
                <td class="px-4 py-3">{{ $detail->admission_date ?: '—' }}</td>
                <td class="px-4 py-3">{{ $detail->previous_school_name ?: ($student->previous_school ?? '—') }}</td>
                <td class="px-4 py-3"><span class="px-2 py-1 text-xs font-medium rounded-full bg-amber-100 text-amber-700">Pending</span></td>
              </tr>
            @empty
              <tr>
                <td colspan="5" class="px-4 py-8 text-center text-slate-500">No pending enrollment applications.</td>
              </tr>
            @endforelse
          </tbody>
        </table>
      </div>
    </div>
  </main>
</x-Account-sidebar>

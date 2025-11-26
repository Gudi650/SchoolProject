<div>
    {{-- Do your work, then step back. --}}

    <table id="recordsTable" class="records-table w-full text-left table-auto min-w-full divide-y divide-gray-100">
        <thead class="bg-indigo-50">

            <tr>
                <th class="p-3 text-xs font-semibold text-indigo-700 uppercase tracking-wider">Date</th>
                <th class="p-3 text-xs font-semibold text-indigo-700 uppercase tracking-wider">Time</th>
                <th class="p-3 text-xs font-semibold text-indigo-700 uppercase tracking-wider">Name</th>
                <th class="p-3 text-xs font-semibold text-indigo-700 uppercase tracking-wider">Adm</th>
                <th class="p-3 text-xs font-semibold text-indigo-700 uppercase tracking-wider">Status</th>
                <th class="p-3 text-xs font-semibold text-indigo-700 uppercase tracking-wider">Note</th>
                <th class="p-3 text-xs font-semibold text-indigo-700 uppercase tracking-wider">Actions</th>
            </tr>
        </thead>
        <tbody>

            <!--check for the student records and loop through them-->
            @if (isset($students) && $students->isNotEmpty())
                
                <!--loop through the students-->
                @foreach ($students as $student)

                <tr class="border-b even:bg-gray-50 hover:bg-indigo-50 transition-colors" data-status="present">

                    <td class="p-3 align-top">
                        {{ $student->date }}
                    </td>
                    <td class="p-3 align-top">
                        {{ $student->created_at->format('H:i') }}
                    </td>
                    <td class="p-3 align-top">
                        {{ $student->student->fname }}
                        {{ $student->student->mname }}
                        {{ $student->student->lname }}
                    </td>

                    <!--admission number-->
                    <td class="p-3 align-top text-sm adm-muted">
                        {{ $student->student->id }}
                    </td>

                    <td class="p-3 align-top">
                        <span
                            class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium
                            <?php echo $student->status == 1 ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800'; ?> 
                            text-green-800">
                                @if ($student->status == 1)
                                    <P>Present</P>

                                @elseif ($student->status == 0)
                                    <P>Absent</P>
                                @endif
                        </span>
                    </td>
                    <td class="p-3 align-top">On time</td>
                    <td class="p-3 align-top">
                    <button
                        class="edit-btn inline-flex items-center gap-2 px-3 py-1 border rounded-full text-sm text-indigo-600 hover:bg-indigo-50"
                        data-record="1">
                        <i class="bi bi-pencil-fill"></i>
                        <span class="hidden md:inline">Edit</span>
                    </button>
                </td>
                @endforeach

            @elseif (isset($studentz) && $studentz->count() > 0)

                @foreach ( $studentz as $student) 
                    
                    <tr class="border-b even:bg-gray-50 hover:bg-indigo-50 transition-colors" data-status="present">

                    <td class="p-3 align-top">
                        {{ $student->date }}
                    </td>
                    <td class="p-3 align-top">
                        {{ $student->created_at->format('H:i') }}
                    </td>
                    <td class="p-3 align-top">
                        {{ $student->student->fname }}
                        {{ $student->student->mname }}
                        {{ $student->student->lname }}
                    </td>

                    <!--admission number-->
                    <td class="p-3 align-top text-sm adm-muted">
                        {{ $student->student->id }}
                    </td>

                    <td class="p-3 align-top">
                        <span
                            class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium
                            <?php echo $student->status == 1 ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800'; ?> 
                            text-green-800">
                                @if ($student->status == 1)
                                    <P>Present</P>

                                @elseif ($student->status == 0)
                                    <P>Absent</P>
                                @endif
                        </span>
                    </td>
                    <td class="p-3 align-top">On time</td>
                    <td class="p-3 align-top">
                    <button
                        class="edit-btn inline-flex items-center gap-2 px-3 py-1 border rounded-full text-sm text-indigo-600 hover:bg-indigo-50"
                        data-record="1">
                        <i class="bi bi-pencil-fill"></i>
                        <span class="hidden md:inline">Edit</span>
                    </button>
                </td>

                @endforeach

            @else
                <tr>
                    <td colspan="7" class="p-3 text-center text-gray-500">
                        No attendance records found.
                    </td>
                </tr>

            @endif

        </tbody>
    </table>

    <!-- Pagination links -->
    <div class="mt-4">
        {{ $students->links('vendor.pagination.tailwind') }}
    </div>


</div>

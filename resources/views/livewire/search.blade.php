<div>
    {{-- The Master doesn't talk, he acts. --}}

    <div class="mb-3">

        <input id="exceptionsSearch" 
        class="w-full border px-3 py-2 rounded-sm" 
        placeholder="Search student name or admission" 
        wire:model.live="search"
        />

    </div>


    <div id="exceptionsList" class="max-h-56 overflow-auto space-y-1 mb-3">

        <form id="exceptionsForm" method="POST" action="">
        @csrf

        {{-- bind the hidden date to the Livewire property --}}
        <input type="hidden" name="date" wire:model="date" value="{{ old('date') }}">
        
        <!--check if the students variable is set-->
        @if(isset($students) && $students->isNotEmpty() && empty($Searchedstudents))

        @foreach($students as $student)

            <label class="flex items-center gap-2 p-1">
                <input type="checkbox" 
                name="absent_students[]" 
                value="{{ $student->id }}"

                >
                <span class="text-sm">
                    {{ $student->fname }} 
                    {{ $student->lname }}
                    {{ $student->admission ? ' ('.$student->admission.')' : '' }}
                </span>

            </label>

        @endforeach

        @elseif (isset($Searchedstudents) && $Searchedstudents->isNotEmpty())

            @foreach($Searchedstudents as $Searchedstudent)

            <label class="flex items-center gap-2 p-1">
                <input type="checkbox" 
                name="absent_students[]" 
                value="{{ $Searchedstudent->id }}"

                >
                <span class="text-sm">
                    {{ $Searchedstudent->fname }} 
                    {{ $Searchedstudent->lname }}
                    {{ $Searchedstudent->admission ? ' ('.$Searchedstudent->admission.')' : '' }}
                </span>

            </label>

            @endforeach

        @endif

        </form>

    </div>

</div>

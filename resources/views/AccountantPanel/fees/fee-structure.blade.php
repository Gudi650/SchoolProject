<x-Account-sidebar>
  <x-slot name="title">Fee Structure</x-slot>
  
    <!-- Page Header -->
    <div class="mb-6">
      <div class="flex flex-col sm:flex-row sm:items-start sm:justify-between items-start gap-4">
        <div class="sm:flex-1">
          <h1 class="text-2xl font-bold text-slate-900">Fee Structure</h1>
          <p class="text-sm text-slate-600 mt-1">Manage and configure annual fee structure for all classes</p>
        </div>

        <div class="flex flex-col sm:flex-row sm:items-center gap-3 w-full sm:w-auto">
          <button class="w-full sm:w-auto px-4 py-2 text-sm font-medium text-slate-700 bg-white border border-slate-300 rounded-lg hover:bg-slate-50 transition-colors flex items-center gap-2 justify-center">
            <i data-lucide="download" class="w-4 h-4"></i>
            <span>Export</span>
          </button>

          <div class="w-full sm:w-auto">
            <button id="openEditStructureModal" class="w-full sm:w-auto px-4 py-2 text-sm font-medium text-white bg-indigo-600 rounded-lg hover:bg-indigo-700 transition-colors flex items-center gap-2 justify-center">
              <i data-lucide="edit-3" class="w-4 h-4"></i>
              <span>Create Structure</span>
            </button>
          </div>
        </div>
      </div>
    </div>

    {{-- Flash messages --}}
    <div class="space-y-3 mb-6">
      @if(session('success'))
        <div class="flex items-start gap-3 rounded-lg border border-emerald-200 bg-emerald-50 px-4 py-3 text-emerald-900 shadow-sm">
          <div class="mt-0.5 text-emerald-600">
            <i data-lucide="check-circle" class="w-5 h-5"></i>
          </div>
          <div class="flex-1">
            <p class="font-semibold">Success</p>
            <p class="text-sm">{{ session('success') }}</p>
          </div>
        </div>
      @endif

      @if(session('error'))
        <div class="flex items-start gap-3 rounded-lg border border-rose-200 bg-rose-50 px-4 py-3 text-rose-900 shadow-sm">
          <div class="mt-0.5 text-rose-600">
            <i data-lucide="alert-octagon" class="w-5 h-5"></i>
          </div>
          <div class="flex-1">
            <p class="font-semibold">Error</p>
            <p class="text-sm">{{ session('error') }}</p>
          </div>
        </div>
      @endif

      @if ($errors->any())
        <div class="flex items-start gap-3 rounded-lg border border-amber-200 bg-amber-50 px-4 py-3 text-amber-900 shadow-sm">
          <div class="mt-0.5 text-amber-600">
            <i data-lucide="alert-triangle" class="w-5 h-5"></i>
          </div>
          <div class="flex-1 space-y-1">
            <p class="font-semibold">Please check the following:</p>
            <ul class="list-disc list-inside text-sm space-y-0.5">
              @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
              @endforeach
            </ul>
          </div>
        </div>
      @endif
    </div>

    <!-- Info Cards -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
      <div class="bg-white rounded-xl p-6 border border-slate-200">
        <div class="flex items-center justify-between">
          <div>
            <p class="text-sm text-slate-600 mb-1">Total Classes</p>
            <p class="text-2xl font-bold text-slate-900">3</p>
          </div>
          <div class="w-12 h-12 bg-indigo-100 rounded-lg flex items-center justify-center">
            <i data-lucide="book-open" class="w-6 h-6 text-indigo-600"></i>
          </div>
        </div>
      </div>
      <div class="bg-white rounded-xl p-6 border border-slate-200">
        <div class="flex items-center justify-between">
          <div>
            <p class="text-sm text-slate-600 mb-1">Fee Components</p>
            <p class="text-2xl font-bold text-slate-900">6</p>
          </div>
          <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
            <i data-lucide="layers" class="w-6 h-6 text-blue-600"></i>
          </div>
        </div>
      </div>
      <div class="bg-white rounded-xl p-6 border border-slate-200">
        <div class="flex items-center justify-between">
          <div>
            <p class="text-sm text-slate-600 mb-1">Highest Fee</p>
            <p class="text-2xl font-bold text-slate-900">₹43,500</p>
          </div>
          <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center">
            <i data-lucide="trending-up" class="w-6 h-6 text-green-600"></i>
          </div>
        </div>
      </div>
    </div>

    <!-- Fee Structure -->
    <div class="bg-white rounded-xl border border-slate-200">
      <div class="px-6 py-4 border-b border-slate-200 flex items-center justify-between">
        <div>
          <h2 class="text-lg font-semibold text-slate-900">General Fee Structure</h2>
          <p class="text-sm text-slate-600">Applies to all classes</p>
        </div>
        <button id="editGeneralStructureBtn" class="px-4 py-2 text-sm font-medium text-indigo-600 bg-indigo-50 rounded-lg hover:bg-indigo-100 transition-colors flex items-center gap-2">
          <i data-lucide="edit-2" class="w-4 h-4"></i>
          <span>Edit</span>
        </button>
      </div>
      <div class="overflow-x-auto">
        <table class="w-full text-left text-sm">
          <thead class="bg-slate-50 border-b border-slate-200">
            <tr>
              <th class="px-6 py-3 font-semibold text-slate-700">Fee Component</th>
              <th class="px-6 py-3 font-semibold text-slate-700 text-right">Amount</th>
              <th class="px-6 py-3 font-semibold text-slate-700">Currency</th>
            </tr>
          </thead>
          <tbody class="divide-y divide-slate-200">

            {{-- 
                this is where we will loop through the fee structure values from the database
            --}}

            {{-- check if the feeStructure variable is not empty
                then display the fee structure values
            --}}

            @if ($feeStructures && $feeStructures->isNotEmpty())

              {{-- loop through the fee structures --}}
              @foreach ($feeStructures as $structure)

                {{-- empty the total after every iteation --}}

                @php
                  $totalFees = 0;
                @endphp

                {{-- display the tuition fee first --}}

                <tr class="hover:bg-slate-50 transition-colors">
                  <td class="px-6 py-4 font-medium text-slate-900">Tuition Fee</td>
                  <td class="px-6 py-4 text-slate-700 text-right">{{ number_format($structure->tuition_fee, 3, '.', ',') }}</td>
                  <td class="px-6 py-4 text-slate-700">{{ $structure->currency }}</td>

                  {{-- add the total number of the fees --}}
                  @php
                    $totalFees += $structure->tuition_fee;
                  @endphp

                </tr>

                {{-- now check for other table columns if they exists and display their contents --}}
                @foreach (['transport_fee' => 'Transport Fee', 'library_fee' => 'Library Fee', 'exam_fee' => 'Exam Fee', 'hostel_fee' => 'Hostel Fee'] as $field => $label)

                  @if ($structure->$field)
                    <tr class="hover:bg-slate-50 transition-colors">
                      <td class="px-6 py-4 font-medium text-slate-900">{{ $label }}</td>
                      <td class="px-6 py-4 text-slate-700 text-right">{{ number_format($structure->$field, 3, '.', ',') }}</td>
                      <td class="px-6 py-4 text-slate-700">{{ $structure->currency }}</td>

                      {{-- add the total number of the fees --}}
                      @php
                        $totalFees += $structure->$field;
                      @endphp

                    </tr>
                  @endif

                @endforeach


                {{-- now check for the json file to display --}}
                @if (!empty($structure->dynamic_attributes['all_components']))
                  @foreach ($structure->dynamic_attributes['all_components'] as $component)
                    <tr class="hover:bg-slate-50 transition-colors">
                      <td class="px-6 py-4 font-medium text-slate-900">
                        {{ $component['name'] }}
                        <span class="text-xs text-blue-600">(Custom)</span>
                      </td>
                      <td class="px-6 py-4 text-slate-700 text-right">{{ number_format($component['amount'], 3, '.', ',') }}</td>
                      <td class="px-6 py-4 text-slate-700">{{ $structure->currency }}</td>

                      {{-- add the total number of the fees --}}
                      @php
                        $totalFees += $component['amount'];
                      @endphp

                    </tr>
                  @endforeach
                @endif

                {{-- finally display the total --}}

                <tr class="bg-slate-50">
                  <td class="px-6 py-4 font-semibold text-slate-900">Total</td>
                  <td class="px-6 py-4 font-semibold text-slate-900 text-right">{{ number_format($totalFees, 3, '.', ',') }}</td>
                  <td class="px-6 py-4">{{ $structure->currency }} </td>
                </tr>
              
              @endforeach

            {{-- if there is no data yet --}}
            @else
              <tr>
                <td colspan="3" class="px-6 py-4 text-center text-slate-500">
                  No fee structure defined yet.
                </td>
              </tr>


            @endif

            
            

          </tbody>
        </table>
      </div>
    </div>

    <!-- Fee Structure by Class -->
    <div class="mt-8">
      <div class="mb-6">
        <h2 class="text-lg font-semibold text-slate-900">Fee Structure by Class</h2>
        <p class="text-sm text-slate-600 mt-1">Each class can have different fee components applied</p>
      </div>

      <!-- Class 10 Card -->
      <div class="bg-white rounded-xl border border-slate-200 shadow-sm mb-6">
        <div class="px-6 py-4 border-b border-slate-200 bg-slate-50 flex items-center justify-between">
          <h3 class="font-semibold text-slate-800">Class 10</h3>
          <button class="edit-class-btn px-4 py-2 text-sm font-medium text-indigo-600 bg-indigo-50 rounded-lg hover:bg-indigo-100 transition-colors flex items-center gap-2" data-class="Class 10">
            <i data-lucide="edit-2" class="w-4 h-4"></i>
            <span>Edit</span>
          </button>
        </div>
        <div class="overflow-x-auto">
          <table class="w-full text-left text-sm">
            <thead class="bg-slate-50 border-b border-slate-200">
              <tr>
                <th class="px-6 py-3 font-semibold text-slate-700">Fee Component</th>
                <th class="px-6 py-3 font-semibold text-slate-700 text-right">Amount</th>
                <th class="px-6 py-3 font-semibold text-slate-700">Currency</th>
              </tr>
            </thead>
            <tbody class="divide-y divide-slate-200">
              <tr class="hover:bg-slate-50">
                <td class="px-6 py-3 text-slate-800">Tuition Fee</td>
                <td class="px-6 py-3 text-slate-700 text-right">₹15,000</td>
                <td class="px-6 py-3 text-slate-700">TSH</td>
              </tr>
              <tr class="hover:bg-slate-50">
                <td class="px-6 py-3 text-slate-800">Transport Fee</td>
                <td class="px-6 py-3 text-slate-700 text-right">₹5,000</td>
                <td class="px-6 py-3 text-slate-700">TSH</td>
              </tr>
              <tr class="hover:bg-slate-50">
                <td class="px-6 py-3 text-slate-800">Hostel Fee</td>
                <td class="px-6 py-3 text-slate-700 text-right">₹20,000</td>
                <td class="px-6 py-3 text-slate-700">TSH</td>
              </tr>
              <tr class="hover:bg-slate-50">
                <td class="px-6 py-3 text-slate-800">Library Fee</td>
                <td class="px-6 py-3 text-slate-700 text-right">₹1,500</td>
                <td class="px-6 py-3 text-slate-700">TSH</td>
              </tr>
              <tr class="hover:bg-slate-50">
                <td class="px-6 py-3 text-slate-800">Exam Fee</td>
                <td class="px-6 py-3 text-slate-700 text-right">₹2,000</td>
                <td class="px-6 py-3 text-slate-700">TSH</td>
              </tr>
              <tr class="hover:bg-slate-50 bg-blue-50">
                <td class="px-6 py-3 text-slate-800 font-medium">Lab Fee <span class="text-xs text-blue-600">(Custom)</span></td>
                <td class="px-6 py-3 text-slate-700 text-right">₹7,500</td>
                <td class="px-6 py-3 text-slate-700">TSH</td>
              </tr>
              <tr class="bg-slate-50">
                <td class="px-6 py-3 font-semibold text-slate-900">Total</td>
                <td class="px-6 py-3 font-semibold text-slate-900 text-right">₹51,000</td>
                <td class="px-6 py-3"></td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>

      <!-- Class 9 Card -->
      <div class="bg-white rounded-xl border border-slate-200 shadow-sm mb-6">
        <div class="px-6 py-4 border-b border-slate-200 bg-slate-50 flex items-center justify-between">
          <h3 class="font-semibold text-slate-800">Class 9</h3>
          <button class="edit-class-btn px-4 py-2 text-sm font-medium text-indigo-600 bg-indigo-50 rounded-lg hover:bg-indigo-100 transition-colors flex items-center gap-2" data-class="Class 9">
            <i data-lucide="edit-2" class="w-4 h-4"></i>
            <span>Edit</span>
          </button>
        </div>
        <div class="overflow-x-auto">
          <table class="w-full text-left text-sm">
            <thead class="bg-slate-50 border-b border-slate-200">
              <tr>
                <th class="px-6 py-3 font-semibold text-slate-700">Fee Component</th>
                <th class="px-6 py-3 font-semibold text-slate-700 text-right">Amount</th>
                <th class="px-6 py-3 font-semibold text-slate-700">Currency</th>
              </tr>
            </thead>
            <tbody class="divide-y divide-slate-200">
              <tr class="hover:bg-slate-50">
                <td class="px-6 py-3 text-slate-800">Tuition Fee</td>
                <td class="px-6 py-3 text-slate-700 text-right">₹15,000</td>
                <td class="px-6 py-3 text-slate-700">TSH</td>
              </tr>
              <tr class="hover:bg-slate-50">
                <td class="px-6 py-3 text-slate-800">Transport Fee</td>
                <td class="px-6 py-3 text-slate-700 text-right">₹5,000</td>
                <td class="px-6 py-3 text-slate-700">TSH</td>
              </tr>
              <tr class="hover:bg-slate-50">
                <td class="px-6 py-3 text-slate-800">Hostel Fee</td>
                <td class="px-6 py-3 text-slate-700 text-right">₹20,000</td>
                <td class="px-6 py-3 text-slate-700">TSH</td>
              </tr>
              <tr class="hover:bg-slate-50">
                <td class="px-6 py-3 text-slate-800">Library Fee</td>
                <td class="px-6 py-3 text-slate-700 text-right">₹1,500</td>
                <td class="px-6 py-3 text-slate-700">TSH</td>
              </tr>
              <tr class="hover:bg-slate-50">
                <td class="px-6 py-3 text-slate-800">Exam Fee</td>
                <td class="px-6 py-3 text-slate-700 text-right">₹2,000</td>
                <td class="px-6 py-3 text-slate-700">TSH</td>
              </tr>
              <tr class="bg-slate-50">
                <td class="px-6 py-3 font-semibold text-slate-900">Total</td>
                <td class="px-6 py-3 font-semibold text-slate-900 text-right">₹43,500</td>
                <td class="px-6 py-3"></td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>

      <!-- Class 8 Card -->
      <div class="bg-white rounded-xl border border-slate-200 shadow-sm mb-6">
        <div class="px-6 py-4 border-b border-slate-200 bg-slate-50 flex items-center justify-between">
          <h3 class="font-semibold text-slate-800">Class 8</h3>
          <button class="edit-class-btn px-4 py-2 text-sm font-medium text-indigo-600 bg-indigo-50 rounded-lg hover:bg-indigo-100 transition-colors flex items-center gap-2" data-class="Class 8">
            <i data-lucide="edit-2" class="w-4 h-4"></i>
            <span>Edit</span>
          </button>
        </div>
        <div class="overflow-x-auto">
          <table class="w-full text-left text-sm">
            <thead class="bg-slate-50 border-b border-slate-200">
              <tr>
                <th class="px-6 py-3 font-semibold text-slate-700">Fee Component</th>
                <th class="px-6 py-3 font-semibold text-slate-700 text-right">Amount</th>
                <th class="px-6 py-3 font-semibold text-slate-700">Currency</th>
              </tr>
            </thead>
            <tbody class="divide-y divide-slate-200">
              <tr class="hover:bg-slate-50">
                <td class="px-6 py-3 text-slate-800">Tuition Fee</td>
                <td class="px-6 py-3 text-slate-700 text-right">₹15,000</td>
                <td class="px-6 py-3 text-slate-700">TSH</td>
              </tr>
              <tr class="hover:bg-slate-50">
                <td class="px-6 py-3 text-slate-800">Transport Fee</td>
                <td class="px-6 py-3 text-slate-700 text-right">₹5,000</td>
                <td class="px-6 py-3 text-slate-700">TSH</td>
              </tr>
              <tr class="hover:bg-slate-50">
                <td class="px-6 py-3 text-slate-800">Hostel Fee</td>
                <td class="px-6 py-3 text-slate-700 text-right">₹20,000</td>
                <td class="px-6 py-3 text-slate-700">TSH</td>
              </tr>
              <tr class="hover:bg-slate-50">
                <td class="px-6 py-3 text-slate-800">Library Fee</td>
                <td class="px-6 py-3 text-slate-700 text-right">₹1,500</td>
                <td class="px-6 py-3 text-slate-700">TSH</td>
              </tr>
              <tr class="hover:bg-slate-50">
                <td class="px-6 py-3 text-slate-800">Exam Fee</td>
                <td class="px-6 py-3 text-slate-700 text-right">₹2,000</td>
                <td class="px-6 py-3 text-slate-700">TSH</td>
              </tr>
              <tr class="hover:bg-slate-50 bg-amber-50">
                <td class="px-6 py-3 text-slate-800 font-medium">Field Trip <span class="text-xs text-amber-600">(Custom)</span></td>
                <td class="px-6 py-3 text-slate-700 text-right">₹4,000</td>
                <td class="px-6 py-3 text-slate-700">TSH</td>
              </tr>
              <tr class="bg-slate-50">
                <td class="px-6 py-3 font-semibold text-slate-900">Total</td>
                <td class="px-6 py-3 font-semibold text-slate-900 text-right">₹47,500</td>
                <td class="px-6 py-3"></td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>

  </main>

</x-Account-sidebar>

<!-- Edit Class Fee Modal -->
<div id="editClassFeeModal" class="fixed inset-0 z-[9999] flex items-center justify-center bg-black/50 p-4 overflow-y-auto hidden">
  <div class="bg-white w-full max-w-2xl rounded-2xl shadow-2xl overflow-hidden flex flex-col my-auto" style="max-height: 90vh;">
    <!-- Header -->
    <div class="flex items-center justify-between px-6 py-4 bg-gradient-to-r from-indigo-600 to-purple-600 text-white">
      <div class="flex items-center gap-3">
        <div class="w-10 h-10 bg-white/20 rounded-lg flex items-center justify-center">
          <i data-lucide="edit-3" class="w-5 h-5"></i>
        </div>
        <div>
          <h2 class="text-lg font-bold">Edit Fee Structure</h2>
          <p class="text-sm text-white/80" id="editModalClassName">Class Name</p>
        </div>
      </div>
      <button id="closeEditClassModal" type="button" class="text-white/80 hover:text-white p-2 rounded-lg hover:bg-white/10 transition-colors">
        <i data-lucide="x" class="w-6 h-6"></i>
      </button>
    </div>

    <!-- Body -->
    <div class="px-6 py-6 flex-1 overflow-y-auto">
      <form id="editClassFeeForm" class="space-y-6">
        <!-- Currency Selection -->
        <div>
          <label for="editCurrency" class="block text-sm font-semibold text-slate-700 mb-2 flex items-center gap-2">
            <i data-lucide="coins" class="w-4 h-4 text-indigo-600"></i>
            Currency
          </label>
          <select id="editCurrency" class="w-full border border-slate-300 rounded-lg px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
            <option value="TSH">TSH (Tanzanian Shilling)</option>
            <option value="USD">USD (US Dollar)</option>
            <option value="EUR">EUR (Euro)</option>
            <option value="INR">INR (Indian Rupee)</option>
            <option value="KES">KES (Kenyan Shilling)</option>
          </select>
        </div>

        <!-- Fee Fields -->
        <div class="space-y-4">
          <p class="text-sm font-semibold text-slate-700">Fee Components</p>
          <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
              <label for="editTuition" class="block text-sm font-semibold text-slate-700 mb-2 flex items-center gap-2">
                <i data-lucide="graduation-cap" class="w-4 h-4 text-indigo-600"></i>
                Tuition Fee
              </label>
              <input type="number" id="editTuition" class="w-full border border-slate-300 rounded-lg px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500" placeholder="0" min="0" step="0.01">
            </div>

            <div>
              <label for="editTransport" class="block text-sm font-semibold text-slate-700 mb-2 flex items-center gap-2">
                <i data-lucide="bus" class="w-4 h-4 text-sky-600"></i>
                Transport Fee
              </label>
              <input type="number" id="editTransport" class="w-full border border-slate-300 rounded-lg px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500" placeholder="0" min="0" step="0.01">
            </div>

            <div>
              <label for="editHostel" class="block text-sm font-semibold text-slate-700 mb-2 flex items-center gap-2">
                <i data-lucide="home" class="w-4 h-4 text-amber-600"></i>
                Hostel Fee
              </label>
              <input type="number" id="editHostel" class="w-full border border-slate-300 rounded-lg px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500" placeholder="0" min="0" step="0.01">
            </div>

            <div>
              <label for="editLibrary" class="block text-sm font-semibold text-slate-700 mb-2 flex items-center gap-2">
                <i data-lucide="library" class="w-4 h-4 text-emerald-600"></i>
                Library Fee
              </label>
              <input type="number" id="editLibrary" class="w-full border border-slate-300 rounded-lg px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500" placeholder="0" min="0" step="0.01">
            </div>

            <div>
              <label for="editExam" class="block text-sm font-semibold text-slate-700 mb-2 flex items-center gap-2">
                <i data-lucide="file-check" class="w-4 h-4 text-rose-600"></i>
                Exam Fee
              </label>
              <input type="number" id="editExam" class="w-full border border-slate-300 rounded-lg px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500" placeholder="0" min="0" step="0.01">
            </div>

            <div class="flex items-end">
              <div class="w-full">
                <label class="block text-sm font-semibold text-slate-700 mb-2 flex items-center gap-2">
                  <i data-lucide="calculator" class="w-4 h-4 text-slate-600"></i>
                  Total Fee
                </label>
                <div class="w-full bg-indigo-50 border border-indigo-300 rounded-lg px-4 py-2.5 text-lg font-bold text-indigo-900" id="editTotalDisplay">₹0</div>
              </div>
            </div>
          </div>
        </div>
      </form>
    </div>

    <!-- Footer -->
    <div class="px-6 py-4 border-t border-slate-200 flex justify-end gap-3 bg-slate-50">
      <button id="cancelEditClassModal" type="button" class="px-5 py-2.5 rounded-lg bg-red-100 text-red-700 hover:bg-red-200 font-medium transition-colors flex items-center gap-2">
        <i data-lucide="x" class="w-4 h-4"></i>
        Cancel
      </button>
      <button id="saveEditClassFee" type="button" class="px-5 py-2.5 rounded-lg bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-700 hover:to-purple-700 text-white font-medium shadow-lg hover:shadow-xl transition-all flex items-center gap-2">
        <i data-lucide="check" class="w-4 h-4"></i>
        Save Changes
      </button>
    </div>
  </div>
</div>

<script>
  document.addEventListener('DOMContentLoaded', function() {
    if (window.lucide) lucide.createIcons();

    // Auto-dismiss flash messages after 5 seconds
    document.querySelectorAll('.space-y-3.mb-6 > div').forEach(message => {
      setTimeout(() => {
        message.style.transition = 'opacity 0.5s ease-out';
        message.style.opacity = '0';
        setTimeout(() => message.remove(), 500);
      }, 5000);
    });

    // DOM Elements
    const editClassModal = document.getElementById('editClassFeeModal');
    const feeStructureModal = document.getElementById('feeStructureModal');
    let currentRow = null;

    // Helper function to close edit modal
    const closeEditModal = () => {
      editClassModal.classList.add('hidden');
      currentRow = null;
    };

    // Calculate total fee
    const calculateTotal = () => {
      const total = ['editTuition', 'editTransport', 'editHostel', 'editLibrary', 'editExam']
        .reduce((sum, id) => sum + (parseInt(document.getElementById(id).value) || 0), 0);
      document.getElementById('editTotalDisplay').textContent = '₹' + total.toLocaleString('en-IN');
    };

    // Open edit class modal
    document.querySelectorAll('.edit-fee-btn').forEach(btn => {
      btn.addEventListener('click', function() {
        currentRow = this.closest('tr');
        const data = currentRow.dataset;
        
        document.getElementById('editModalClassName').textContent = data.class;
        document.getElementById('editTuition').value = data.tuition;
        document.getElementById('editTransport').value = data.transport;
        document.getElementById('editHostel').value = data.hostel;
        document.getElementById('editLibrary').value = data.library;
        document.getElementById('editExam').value = data.exam;
        
        calculateTotal();
        editClassModal.classList.remove('hidden');
        if (window.lucide) lucide.createIcons();
      });
    });

    // Close edit class modal
    document.querySelectorAll('#closeEditClassModal, #cancelEditClassModal').forEach(btn => {
      btn.addEventListener('click', closeEditModal);
    });
    editClassModal.addEventListener('click', e => { if (e.target === editClassModal) closeEditModal(); });

    // Auto-calculate total on input change
    ['editTuition', 'editTransport', 'editHostel', 'editLibrary', 'editExam'].forEach(id => {
      document.getElementById(id).addEventListener('input', calculateTotal);
    });

    // Save changes
    document.getElementById('saveEditClassFee').addEventListener('click', function() {
      if (!currentRow) return;
      closeEditModal();
    });

    // Fee structure modal controls
    const openStructureBtn = document.getElementById('openEditStructureModal');
    if (openStructureBtn && feeStructureModal) {
      openStructureBtn.addEventListener('click', () => feeStructureModal.style.display = 'flex');
      
      ['closeFeeStructureModal', 'closeFeeStructureModalBottom'].forEach(id => {
        const btn = document.getElementById(id);
        if (btn) btn.addEventListener('click', () => feeStructureModal.style.display = 'none');
      });
      
      feeStructureModal.addEventListener('click', e => {
        if (e.target === feeStructureModal) feeStructureModal.style.display = 'none';
      });
    }

    // Edit class fee structure
    document.querySelectorAll('.edit-class-btn').forEach(btn => {
      btn.addEventListener('click', function() {
        const className = this.dataset.class;
        document.getElementById('editModalClassName').textContent = className;
        
        // In a real application, fetch the fees for this class and populate the form
        // For now, just open the modal
        editClassModal.classList.remove('hidden');
        if (window.lucide) lucide.createIcons();
      });
    });

    // Edit general fee structure
    document.getElementById('editGeneralStructureBtn').addEventListener('click', function() {
      document.getElementById('editModalClassName').textContent = 'General Fee Structure';
      editClassModal.classList.remove('hidden');
      if (window.lucide) lucide.createIcons();
    });
  });
</script>

@include('AccountantPanel.fees.feeStructureModal')



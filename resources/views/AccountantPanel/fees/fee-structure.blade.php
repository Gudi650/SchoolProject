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
              <span>Edit Structure</span>
            </button>
          </div>
        </div>
      </div>
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
        <h2 class="text-lg font-semibold text-slate-900">Annual Fee Structure</h2>
        <span class="px-3 py-1 bg-indigo-100 text-indigo-700 text-xs font-medium rounded-full">6 Components</span>
      </div>
      <div class="overflow-x-auto">
        <table class="w-full text-left text-sm">
          <thead class="bg-slate-50 border-b border-slate-200">
            <tr>
              <th class="px-6 py-3 font-semibold text-slate-700">Class</th>
              <th class="px-6 py-3 font-semibold text-slate-700">Tuition</th>
              <th class="px-6 py-3 font-semibold text-slate-700">Transport</th>
              <th class="px-6 py-3 font-semibold text-slate-700">Hostel</th>
              <th class="px-6 py-3 font-semibold text-slate-700">Library</th>
              <th class="px-6 py-3 font-semibold text-slate-700">Exam</th>
              <th class="px-6 py-3 font-semibold text-slate-700 text-right">Total</th>
              <th class="px-6 py-3 font-semibold text-slate-700 text-center">Actions</th>
            </tr>
          </thead>
          <tbody class="divide-y divide-slate-200">
            <tr class="hover:bg-slate-50 transition-colors">
              <td class="px-6 py-4 font-medium text-slate-900">Class 10</td>
              <td class="px-6 py-4 text-slate-700">₹15,000</td>
              <td class="px-6 py-4 text-slate-700">₹5,000</td>
              <td class="px-6 py-4 text-slate-700">₹20,000</td>
              <td class="px-6 py-4 text-slate-700">₹1,500</td>
              <td class="px-6 py-4 text-slate-700">₹2,000</td>
              <td class="px-6 py-4 font-semibold text-slate-900 text-right">₹43,500</td>
              <td class="px-6 py-4 text-center">
                <button class="text-indigo-600 hover:text-indigo-700 font-medium text-sm inline-flex items-center gap-1 p-1 rounded hover:bg-indigo-50">
                  <i data-lucide="edit-2" class="w-4 h-4"></i>
                </button>
              </td>
            </tr>
            <tr class="hover:bg-slate-50 transition-colors">
              <td class="px-6 py-4 font-medium text-slate-900">Class 9</td>
              <td class="px-6 py-4 text-slate-700">₹14,000</td>
              <td class="px-6 py-4 text-slate-700">₹5,000</td>
              <td class="px-6 py-4 text-slate-700">₹20,000</td>
              <td class="px-6 py-4 text-slate-700">₹1,500</td>
              <td class="px-6 py-4 text-slate-700">₹2,000</td>
              <td class="px-6 py-4 font-semibold text-slate-900 text-right">₹42,500</td>
              <td class="px-6 py-4 text-center">
                <button class="text-indigo-600 hover:text-indigo-700 font-medium text-sm inline-flex items-center gap-1 p-1 rounded hover:bg-indigo-50">
                  <i data-lucide="edit-2" class="w-4 h-4"></i>
                </button>
              </td>
            </tr>
            <tr class="hover:bg-slate-50 transition-colors">
              <td class="px-6 py-4 font-medium text-slate-900">Class 8</td>
              <td class="px-6 py-4 text-slate-700">₹13,000</td>
              <td class="px-6 py-4 text-slate-700">₹4,500</td>
              <td class="px-6 py-4 text-slate-700">₹18,000</td>
              <td class="px-6 py-4 text-slate-700">₹1,200</td>
              <td class="px-6 py-4 text-slate-700">₹1,800</td>
              <td class="px-6 py-4 font-semibold text-slate-900 text-right">₹38,500</td>
              <td class="px-6 py-4 text-center">
                <button class="text-indigo-600 hover:text-indigo-700 font-medium text-sm inline-flex items-center gap-1 p-1 rounded hover:bg-indigo-50">
                  <i data-lucide="edit-2" class="w-4 h-4"></i>
                </button>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </main>

</x-Account-sidebar>

@include('AccountantPanel.feeStructureModal')

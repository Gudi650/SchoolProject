<x-Account-sidebar>
	<x-slot name="title">Fee Settings</x-slot>

	<style>
		/* Toggle switch styles copied from modal */
		.toggle-track{ position: relative; transition: background-color .18s ease; display: inline-block; }
		.toggle-track::after{
			content: '';
			position: absolute;
			top: 50%;
			left: 4px;
			width: 18px;
			height: 18px;
			background: #fff;
			border-radius: 9999px;
			transform: translateY(-50%);
			transition: transform .18s cubic-bezier(.4,0,.2,1), box-shadow .18s;
			box-shadow: 0 1px 2px rgba(2,6,23,0.08);
		}
		.toggle-checkbox:focus + .toggle-track{ box-shadow: 0 0 0 6px rgba(99,102,241,0.08); }
		.toggle-checkbox:checked + .toggle-track{ background-color: #6366f1; }
		.toggle-checkbox:checked + .toggle-track::after{ transform: translateY(-50%) translateX(18px); }
		.sr-only{ position: absolute !important; width: 1px; height: 1px; padding: 0; margin: -1px; overflow: hidden; clip: rect(0,0,0,0); white-space: nowrap; border: 0; }
	</style>

	<div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">
		<div class="mb-6">
		<div class="flex items-start justify-between gap-4">
			<div>
				<h1 class="text-2xl font-bold text-slate-900">Fee Settings</h1>
				<p class="text-sm text-slate-600 mt-1">Configure which fee components are required or optional for students</p>
			</div>
		</div>
	</div>

	<!-- Info cards removed per request -->

	<div class="bg-white rounded-xl border border-slate-200 p-6 shadow-sm">
		<form method="POST" action="">
			@csrf

			<!-- General settings container -->
			<div class="bg-white rounded-xl border border-slate-200 pb-6 px-6 mb-6">
				<div class="mb-4">
					<div class="-mx-6 px-6 py-3 bg-indigo-50 rounded-t-lg flex items-center justify-between">
						<div>
							<h2 class="text-lg font-semibold text-slate-900">Fee Structure — General</h2>
							<p class="text-sm text-slate-600">Applies to all classes</p>
						</div>
						<button id="editGeneralStructureBtn" type="button" class="px-3 py-1 text-sm font-medium text-indigo-600 bg-white rounded-lg hover:bg-indigo-100 transition-colors flex items-center gap-2">
							<i data-lucide="edit-2" class="w-4 h-4"></i>
							<span>Edit</span>
						</button>
					</div>
				</div>
				
				<p class="text-sm font-semibold text-slate-700">Core Components</p>
				<div class="grid grid-cols-1 gap-3 mt-3">
                    {{-- 

                        check if the feeStructure variable is not empty
                        then display the fee structure values

                    --}}

                    @if($feeStructures && $feeStructures->isNotEmpty())

                        {{-- loop through the fee structure --}}
                        @foreach ($feeStructures as $structure)

                            {{-- now check for other table columns if they exists and display their contents --}}
                            @foreach (['tuition_fee' => 'Tution Fee', 'transport_fee' => 'Transport Fee', 'library_fee' => 'Library Fee', 'exam_fee' => 'Exam Fee', 'hostel_fee' => 'Hostel Fee'] as $field => $label)

                                {{-- check if the fee structure is in the core components --}}
                                @if($structure->$field)
                                    <div class="flex items-center justify-between bg-slate-50 rounded-lg px-4 py-3">
                                        <div class="text-slate-800 font-medium">{{ $label }}</div>
                                        <div class="flex items center gap-3">
                                            <input type="hidden" name="{{ $field }}" value="optional">
                                            <label class="relative inline-flex items-center cursor-pointer">
                                                <input type="checkbox" name="{{ $field }}" value="required" class="sr-only toggle-checkbox" {{ $structure->is_required ? 'checked' : '' }}>
                                                <div class="w-11 h-6 bg-slate-300 rounded-full shadow-inner transition-colors duration-200 toggle-track"></div>
                                                <span class="ml-3 text-sm text-slate-700">Required</span>
                                            </label>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        @endforeach
                    @endif

                    {{-- now check for the json file to display dynamic components --}}
                    @if (!empty($structure->dynamic_attributes['all_components']))

                        @foreach ($structure->dynamic_attributes['all_components'] as $component)
                            <div class="flex items center justify-between bg-slate-50 rounded-lg px-4 py-3">
                                <div class="text-slate-800 font-medium">{{ $component['name'] }}</div>
                                <div class="flex items center gap-3">
                                    <input type="hidden" name="{{ $field }}" value="optional">
                                    <label class="relative inline-flex items-center cursor-pointer">
                                        <input type="checkbox" name="custom_{{ \Illuminate\Support\Str::slug($component['name']) }}" value="required" class="sr-only toggle-checkbox" {{ !empty($component['amount']) ? 'checked' : '' }}>
                                        <div class="w-11 h-6 bg-slate-300 rounded-full shadow-inner transition-colors duration-200 toggle-track"></div>
                                        <span class="ml-3 text-sm text-slate-700">Required</span>
                                    </label>
                                </div>
                            </div>
                        @endforeach
                    @endif

				</div>
			</div>

			<!-- Specific settings container -->
			<div class="bg-white rounded-xl border border-slate-200 pb-6 px-6">
				<div class="mb-4">
					<div class="-mx-6 px-6 py-3 bg-indigo-50 rounded-t-lg flex items-center justify-between">
						<div>
							<h2 class="text-lg font-semibold text-slate-900">Fee Structure — Specific (by class)</h2>
							<p class="text-sm text-slate-600">Set required/optional per class</p>
						</div>
						<button id="editSpecificStructureBtn" type="button" class="px-3 py-1 text-sm font-medium text-indigo-600 bg-white rounded-lg hover:bg-indigo-100 transition-colors flex items-center gap-2">
							<i data-lucide="edit-2" class="w-4 h-4"></i>
							<span>Edit</span>
						</button>
					</div>
				</div>
				<div class="space-y-4">
					@if(isset($customFeeStructures) && $customFeeStructures->isNotEmpty())

                        {{-- loop through the custom fee structure --}}
						@foreach($customFeeStructures as $customStructure)


							<div class="bg-white rounded-xl border border-slate-200 shadow-sm p-4">
								<div class="flex items-center justify-between mb-3">
									<h3 class="font-semibold text-slate-800">{{ $customStructure->classes->pluck('name')->join(', ') ?: 'No classes' }}</h3>
									<div class="flex items-center gap-3">
										<span class="text-sm text-slate-600">Class settings</span>
										<button type="button" class="px-2 py-1 rounded-md bg-indigo-50 text-indigo-600 hover:bg-indigo-100 transition-colors flex items-center" data-class-id="{{ $customStructure->id }}">
											<i data-lucide="edit-2" class="w-4 h-4"></i>
										</button>
									</div>
								</div>

                                 {{-- now check for other table columns if they exists and display their contents --}}
                                 @foreach (['tuition_fee'=>'Tuition Fee','transport_fee' => 'Transport Fee', 'library_fee' => 'Library Fee', 'exam_fee' => 'Exam Fee', 'hostel_fee' => 'Hostel Fee'] as $field => $label)
                                    @if($customStructure->$field)
                                        <div class="flex items-center justify-between bg-slate-50 rounded-lg px-4 py-3 mt-3">
                                            <div class="text-slate-800 font-medium">{{ $label }}</div>
                                            <div>
                                                <input type="hidden" name="class_{{ $customStructure->id }}_{{ $field }}" value="optional">
                                                <label class="relative inline-flex items-center cursor-pointer">
                                                    <input type="checkbox" name="class_{{ $customStructure->id }}_{{ $field }}" value="required" class="sr-only toggle-checkbox" {{ $customStructure->is_required ? 'checked' : '' }}>
                                                    <div class="w-11 h-6 bg-slate-300 rounded-full shadow-inner transition-colors duration-200 toggle-track"></div>
                                                </label>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach

                                {{-- 
								<div class="grid grid-cols-1 md:grid-cols-2 gap-3">
									<div class="bg-slate-50 rounded-lg p-3">
										<div class="flex items-center justify-between">
											<div class="font-medium">Tuition Fee</div>
											<div>
												<input type="hidden" name="class_{{ $custom->id }}_tuition_fee" value="optional">
												<label class="relative inline-flex items-center cursor-pointer">
													<input type="checkbox" name="class_{{ $custom->id }}_tuition_fee" value="required" class="sr-only toggle-checkbox" {{ $custom->tuition_fee ? 'checked' : '' }}>
													<div class="w-11 h-6 bg-slate-300 rounded-full shadow-inner transition-colors duration-200 toggle-track"></div>
												</label>
											</div>
										</div>
									</div>

									<div class="bg-slate-50 rounded-lg p-3">
										<div class="flex items-center justify-between">
											<div class="font-medium">Transport Fee</div>
											<div>
												<input type="hidden" name="class_{{ $custom->id }}_transport_fee" value="optional">
												<label class="relative inline-flex items-center cursor-pointer">
													<input type="checkbox" name="class_{{ $custom->id }}_transport_fee" value="required" class="sr-only toggle-checkbox" {{ $custom->transport_fee ? 'checked' : '' }}>
													<div class="w-11 h-6 bg-slate-300 rounded-full shadow-inner transition-colors duration-200 toggle-track"></div>
												</label>
											</div>
										</div>
									</div>

								</div>    --}}

								@if(!empty($custom->dynamic_attributes['all_components']))
									@foreach($custom->dynamic_attributes['all_components'] as $component)
										<div class="flex items-center justify-between bg-white rounded-lg border border-slate-200 px-4 py-3 mt-3">
											<div class="text-slate-800 font-medium">{{ $component['name'] }}</div>
											<div>
												<input type="hidden" name="class_{{ $custom->id }}_custom_{{ \Illuminate\Support\Str::slug($component['name']) }}" value="optional">
												<label class="relative inline-flex items-center cursor-pointer">
													<input type="checkbox" name="class_{{ $custom->id }}_custom_{{ \Illuminate\Support\Str::slug($component['name']) }}" value="required" class="sr-only toggle-checkbox" {{ !empty($component['amount']) ? 'checked' : '' }}>
													<div class="w-11 h-6 bg-slate-300 rounded-full shadow-inner transition-colors duration-200 toggle-track"></div>
												</label>
											</div>
										</div>
									@endforeach
								@endif

							</div>
						@endforeach
					@else
						<div class="p-6 text-center text-slate-500">No class-specific structures found.</div>
					@endif
				</div>
			</div>

			<div class="mt-6 flex justify-end">
				<button type="submit" class="px-5 py-2.5 rounded-lg bg-green-600 hover:bg-green-700 text-white font-medium flex items-center gap-2">
					<i data-lucide="save" class="w-4 h-4"></i>
					<span>Save Settings</span>
				</button>
			</div>
            
		</form>
		</div>
	</div>

</x-Account-sidebar>
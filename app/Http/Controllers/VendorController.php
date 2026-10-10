<?php

namespace App\Http\Controllers;

use App\Models\Vendor;
use App\Models\VendorAudit;
use App\Services\AccountantContextService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VendorController extends Controller
{
    public function __construct(private AccountantContextService $accountantContext)
    {
    }

    public function index()
    {
        $schoolId = $this->accountantContext->requireSchoolId();

        $vendors = Vendor::with('creator')->where('school_id', $schoolId)->latest()->limit(50)->get();
        $audits = VendorAudit::with('user')->where('school_id', $schoolId)->latest('created_at')->limit(20)->get();
        $stats = [
            'total' => Vendor::where('school_id', $schoolId)->count(),
            'active' => Vendor::where('school_id', $schoolId)->where('status', 'active')->count(),
            'inactive' => Vendor::where('school_id', $schoolId)->where('status', 'inactive')->count(),
            'month' => Vendor::where('school_id', $schoolId)->where('created_at', '>=', now()->startOfMonth())->count(),
        ];

        return view('AccountantPanel.vendors.vendorsManagement', compact('vendors', 'audits', 'stats'));
    }

    public function create()
    {
        $schoolId = $this->accountantContext->requireSchoolId();
        $editVendor = request('edit')
            ? Vendor::where('school_id', $schoolId)->find(request('edit'))
            : null;

        return view('AccountantPanel.vendors.createvendors', compact('editVendor'));
    }

    public function store(Request $request)
    {
        $schoolId = $this->accountantContext->requireSchoolId();
        $data = $this->validated($request);

        $vendor = Vendor::create([
            ...$data,
            'school_id' => $schoolId,
            'created_by' => Auth::id(),
            'updated_by' => Auth::id(),
        ]);

        $this->audit($schoolId, $vendor->id, 'created', ['after' => $data]);

        return redirect()->route('accounting.vendorsManagement')->with('success', 'Vendor saved.');
    }

    public function update(Request $request, int $vendor)
    {
        $schoolId = $this->accountantContext->requireSchoolId();
        $row = Vendor::where('school_id', $schoolId)->findOrFail($vendor);
        $data = $this->validated($request);
        $before = $row->only(array_keys($data));

        $row->fill([...$data, 'updated_by' => Auth::id()])->save();
        $this->audit($schoolId, $row->id, 'updated', ['before' => $before, 'after' => $data]);

        return redirect()->route('accounting.vendorsManagement')->with('success', 'Vendor updated.');
    }

    public function destroy(int $vendor)
    {
        $schoolId = $this->accountantContext->requireSchoolId();
        $row = Vendor::where('school_id', $schoolId)->findOrFail($vendor);
        $this->audit($schoolId, $row->id, 'deleted', ['before' => $row->toArray()]);
        $row->delete();

        return redirect()->route('accounting.vendorsManagement')->with('success', 'Vendor deleted.');
    }

    private function validated(Request $request): array
    {
        return $request->validate([
            'type' => 'required|in:person,company',
            'name' => 'required|string|max:255',
            'email' => 'nullable|email|max:255',
            'phone' => 'nullable|string|max:32',
            'category' => 'nullable|string|max:64',
            'status' => 'required|in:active,inactive',
            'notes' => 'nullable|string|max:500',
        ]);
    }

    private function audit(int $schoolId, ?int $vendorId, string $action, array $changes): void
    {
        VendorAudit::create([
            'school_id' => $schoolId,
            'vendor_id' => $vendorId,
            'user_id' => Auth::id(),
            'action' => $action,
            'changes' => $changes,
        ]);
    }
}

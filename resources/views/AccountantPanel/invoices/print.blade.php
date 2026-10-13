@php $fmt = fn ($n) => money_format_app($n); @endphp
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>{{ $invoice->invoice_number }}</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-white text-slate-900 p-10" onload="window.print()">
  <div class="flex justify-between mb-8">
    <div>
      <h1 class="text-2xl font-bold">Invoice {{ $invoice->invoice_number }}</h1>
      <p class="text-sm text-slate-600">{{ ucfirst($invoice->displayStatus()) }}</p>
    </div>
    <div class="text-right text-sm">
      <p>Issued {{ $invoice->issue_date?->format('Y-m-d') }}</p>
      <p>Due {{ $invoice->due_date?->format('Y-m-d') }}</p>
    </div>
  </div>
  <p class="mb-6"><span class="text-slate-500">Bill to</span><br><strong>{{ $invoice->partyName() }}</strong>
    @if($invoice->customer_email)<br>{{ $invoice->customer_email }}@endif
    @if($invoice->customer_phone)<br>{{ $invoice->customer_phone }}@endif
  </p>
  <table class="w-full text-sm mb-6">
    <thead class="border-b"><tr class="text-left"><th class="py-2">Item</th><th>Qty</th><th>Rate</th><th class="text-right">Amount</th></tr></thead>
    <tbody>
      @foreach($invoice->items as $item)
        <tr class="border-b">
          <td class="py-2">{{ $item->name }}<div class="text-xs text-slate-500">{{ $item->description }}</div></td>
          <td>{{ $item->quantity }}</td>
          <td>{{ $fmt($item->rate) }}</td>
          <td class="text-right">{{ $fmt($item->amount) }}</td>
        </tr>
      @endforeach
    </tbody>
  </table>
  <div class="text-right space-y-1 text-sm">
    <div>Subtotal {{ $fmt($invoice->subtotal) }}</div>
    <div>Tax {{ $fmt($invoice->tax_total) }}</div>
    <div>Discount {{ $fmt($invoice->discount_total) }}</div>
    <div class="text-lg font-bold">Total {{ $fmt($invoice->total) }}</div>
    <div>Paid {{ $fmt($invoice->paid_amount) }}</div>
    <div>Balance {{ $fmt($invoice->remaining()) }}</div>
  </div>
  @if($invoice->notes)<p class="mt-8 text-sm">{{ $invoice->notes }}</p>@endif
  @if($invoice->terms)<p class="mt-2 text-xs text-slate-500">{{ $invoice->terms }}</p>@endif
</body>
</html>

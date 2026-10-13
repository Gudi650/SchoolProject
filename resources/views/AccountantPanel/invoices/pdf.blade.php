@php $fmt = fn ($n) => money_format_app($n); @endphp
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <style>
    body { font-family: DejaVu Sans, sans-serif; font-size: 12px; color: #0f172a; }
    h1 { font-size: 20px; margin: 0 0 4px; }
    .muted { color: #64748b; }
    table { width: 100%; border-collapse: collapse; margin: 16px 0; }
    th, td { padding: 8px 6px; border-bottom: 1px solid #e2e8f0; text-align: left; }
    th { font-size: 11px; text-transform: uppercase; color: #334155; }
    .right { text-align: right; }
    .totals { margin-left: auto; width: 240px; }
    .totals div { display: flex; justify-content: space-between; padding: 3px 0; }
    .total { font-size: 16px; font-weight: bold; }
  </style>
</head>
<body>
  <table>
    <tr>
      <td>
        <h1>Invoice {{ $invoice->invoice_number }}</h1>
        <div class="muted">{{ ucfirst($invoice->displayStatus()) }}</div>
      </td>
      <td class="right muted">
        Issued {{ $invoice->issue_date?->format('Y-m-d') }}<br>
        Due {{ $invoice->due_date?->format('Y-m-d') }}
      </td>
    </tr>
  </table>
  <p class="muted">Bill to</p>
  <p><strong>{{ $invoice->partyName() }}</strong>
    @if($invoice->customer_email)<br>{{ $invoice->customer_email }}@endif
    @if($invoice->customer_phone)<br>{{ $invoice->customer_phone }}@endif
    @if($invoice->billing_address)<br>{{ $invoice->billing_address }}@endif
  </p>
  <table>
    <thead>
      <tr><th>Item</th><th>Qty</th><th>Rate</th><th class="right">Amount</th></tr>
    </thead>
    <tbody>
      @foreach($invoice->items as $item)
        <tr>
          <td>{{ $item->name }}@if($item->description)<br><span class="muted">{{ $item->description }}</span>@endif</td>
          <td>{{ $item->quantity }}</td>
          <td>{{ $fmt($item->rate) }}</td>
          <td class="right">{{ $fmt($item->amount) }}</td>
        </tr>
      @endforeach
    </tbody>
  </table>
  <div class="totals">
    <div>Subtotal <span>{{ $fmt($invoice->subtotal) }}</span></div>
    <div>Tax <span>{{ $fmt($invoice->tax_total) }}</span></div>
    <div>Discount <span>{{ $fmt($invoice->discount_total) }}</span></div>
    <div class="total">Total <span>{{ $fmt($invoice->total) }}</span></div>
    <div>Paid <span>{{ $fmt($invoice->paid_amount) }}</span></div>
    <div>Balance <span>{{ $fmt($invoice->remaining()) }}</span></div>
  </div>
  @if($invoice->notes)<p>{{ $invoice->notes }}</p>@endif
  @if($invoice->terms)<p class="muted">{{ $invoice->terms }}</p>@endif
</body>
</html>

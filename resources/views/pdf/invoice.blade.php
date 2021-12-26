<h1>Invoice</h1>
<h1>Status {{ $payment->amount }}</h1>
<h1>Status {{ $payment->paid ? 'Paid' : 'Due' }}</h1>
<h1>Date {{ $payment->created_at->format('d-m-Y') }}</h1>


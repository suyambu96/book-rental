<p>Dear {{ $rental->user->name }},</p>

<p>Your rental for the book "{{ $rental->book->title }}" is overdue as of {{ $rental->due_date }}. Please return the book as soon as possible.</p>

<p>Thank you!</p>

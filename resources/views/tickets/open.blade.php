<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Ticket Opened</title>
</head>
<body>
    <h1>New Ticket Opened</h1>
    <p>A new ticket has been opened by Customer ID: {{ $ticket->customer_id }}</p>

    <h2>Ticket Details:</h2>
    <ul>
        <li><strong>Subject:</strong> {{ $ticket->subject }}</li>
        <li><strong>Message:</strong> {{ $ticket->ticket_message }}</li>
        <li><strong>Status:</strong> {{ $ticket->status }}</li>
    </ul>

    <p>Please address this issue as soon as possible.</p>
</body>
</html>

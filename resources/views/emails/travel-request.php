<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>New Travel Request</title>
</head>
<body class="bg-gray-100 py-8">
    <div class="max-w-lg mx-auto bg-white rounded-lg shadow-lg overflow-hidden">
        <div class="p-6">
            <h1 class="text-2xl font-bold text-gray-900 mb-4">New Travel Request</h1>
            <p class="text-gray-700 mb-4">
                Hello {{ $receiverName }},
            </p>
            <p class="text-gray-700 mb-4">
                You have received a new travel request from <span class="font-semibold">{{ $senderName }}</span> on UniBuddy.
            </p>
            <p class="text-gray-700 mb-6">
                Please log in to your account to view and respond to the request.
            </p>
            <div class="text-center">
                <a href="{{ route('requests.index') }}" class="inline-block bg-blue-600 text-white px-5 py-2 rounded-lg text-sm font-semibold hover:bg-blue-700">
                    View Requests
                </a>
            </div>
            <p class="text-gray-600 text-sm mt-6">
                Thanks,<br>
                {{ config('app.name') }}
            </p>
        </div>
    </div>
</body>
</html>

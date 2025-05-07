@extends('layouts.app')

@section('header')
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Notifications
    </h2>
@endsection

@section('content')
    <div class="py-6">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow rounded-lg">
                <div class="p-6">
                    @if($notifications->isEmpty())
                        <p class="text-gray-500">You don't have any notifications.</p>
                    @else
                        <div class="space-y-4">
                            @foreach($notifications as $notification)
                                <div class="p-4 border border-gray-200 rounded-lg shadow-sm 
                                    @if(!$notification->is_read) bg-blue-50 @endif">
                                    <div class="flex justify-between items-center">
                                        <div>
                                            <p class="text-sm text-gray-900">{{ $notification->message }}</p>
                                            <p class="mt-1 text-xs text-gray-500">{{ $notification->created_at->diffForHumans() }}</p>
                                        </div>
                                        @if(!$notification->is_read)
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                                New
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            // Mark all notifications as read when page loads
            document.addEventListener('DOMContentLoaded', function() {
                fetch("{{ route('notifications.markAsRead') }}", {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Content-Type': 'application/json',
                    },
                });
            });
        </script>
    @endpush
@endsection

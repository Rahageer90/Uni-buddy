@extends('layouts.app')

@section('header')
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Travel Requests
    </h2>
@endsection

@section('content')
    <div class="py-6">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow rounded-lg">
                <div class="p-6 space-y-10">
                    <!-- Sent Requests -->
                    <div>
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Sent Requests</h3>

                        @if($sentRequests->isEmpty())
                            <p class="text-gray-500">You haven't sent any requests yet.</p>
                        @else
                            <div class="space-y-4">
                                @foreach($sentRequests as $request)
                                    <div class="p-4 bg-gray-50 border border-gray-200 rounded-lg shadow-sm">
                                        <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center">
                                            <div>
                                                <h4 class="text-base font-medium text-gray-900">To: {{ $request->receiver->name }}</h4>
                                                <p class="mt-1 text-sm text-gray-600">
                                                    <span class="font-medium">Destination:</span> {{ $request->schedule->toDest }} <br>
                                                    <span class="font-medium">Day:</span> {{ \Carbon\Carbon::now()->format('l') }} <br>
                                                    <span class="font-medium">Time:</span> {{ \Carbon\Carbon::parse($request->schedule->{strtolower(\Carbon\Carbon::now()->format('D'))})->format('h:i A') }}
                                                </p>
                                                @if($request->message)
                                                    <p class="mt-2 text-sm text-gray-700">Your message: "{{ $request->message }}"</p>
                                                @endif
                                            </div>
                                            <div class="mt-3 sm:mt-0">
                                                <span class="inline-block px-3 py-1 text-xs font-semibold rounded-full 
                                                    @if($request->status == 'pending') bg-yellow-100 text-yellow-800
                                                    @elseif($request->status == 'accepted') bg-green-100 text-green-800
                                                    @else bg-red-100 text-red-800 @endif">
                                                    {{ ucfirst($request->status) }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>

                    <!-- Received Requests -->
                    <div>
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Received Requests</h3>

                        @if($receivedRequests->isEmpty())
                            <p class="text-gray-500">You haven't received any requests yet.</p>
                        @else
                            <div class="space-y-4">
                                @foreach($receivedRequests as $request)
                                    <div class="p-4 bg-gray-50 border border-gray-200 rounded-lg shadow-sm">
                                        <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center">
                                            <div>
                                                <h4 class="text-base font-medium text-gray-900">From: {{ $request->sender->name }}</h4>
                                                <p class="mt-1 text-sm text-gray-600">
                                                    <span class="font-medium">Destination:</span> {{ $request->schedule->toDest }} <br>
                                                    <span class="font-medium">Day:</span> {{ \Carbon\Carbon::now()->format('l') }} <br>
                                                    <span class="font-medium">Time:</span> {{ \Carbon\Carbon::parse($request->schedule->{strtolower(\Carbon\Carbon::now()->format('D'))})->format('h:i A') }}
                                                </p>
                                                @if($request->message)
                                                    <p class="mt-2 text-sm text-gray-700">Message: "{{ $request->message }}"</p>
                                                @endif
                                            </div>
                                            <div class="mt-3 sm:mt-0 flex space-x-2">
                                                @if($request->status == 'pending')
                                                    <form action="{{ route('requests.respond', $request->id) }}" method="POST">
                                                        @csrf
                                                        <input type="hidden" name="status" value="accepted">
                                                        <button type="submit"
                                                            class="px-3 py-1 text-xs font-medium text-white bg-green-600 hover:bg-green-700 rounded shadow focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                                                            Accept
                                                        </button>
                                                    </form>
                                                    <form action="{{ route('requests.respond', $request->id) }}" method="POST">
                                                        @csrf
                                                        <input type="hidden" name="status" value="rejected">
                                                        <button type="submit"
                                                            class="px-3 py-1 text-xs font-medium text-white bg-red-600 hover:bg-red-700 rounded shadow focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                                                            Reject
                                                        </button>
                                                    </form>
                                                @else
                                                    <span class="inline-block px-3 py-1 text-xs font-semibold rounded-full 
                                                        @if($request->status == 'accepted') bg-green-100 text-green-800
                                                        @else bg-red-100 text-red-800 @endif">
                                                        {{ ucfirst($request->status) }}
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

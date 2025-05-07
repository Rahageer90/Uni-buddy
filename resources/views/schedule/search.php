@extends('layouts.app')

@section('header')
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Find Travel Mates
    </h2>
@endsection

@section('content')
    <div class="py-6">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow rounded-lg">
                <div class="p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">
                        Matching Travel Mates for {{ ucfirst($day) }} (around {{ \Carbon\Carbon::now()->format('h:i A') }})
                    </h3>

                    @if($matchingSchedules->isEmpty())
                        <p class="text-gray-500">No matching schedules found for today.</p>
                    @else
                        <div class="space-y-4">
                            @foreach($matchingSchedules as $schedule)
                                <div class="p-4 bg-gray-50 border border-gray-200 rounded-lg shadow-sm">
                                    <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center">
                                        <div>
                                            <h4 class="text-base font-medium text-gray-900">{{ $schedule->user->name }}</h4>
                                            <p class="mt-1 text-sm text-gray-600">
                                                <span class="font-medium">Destination:</span> {{ $schedule->toDest }} <br>
                                                <span class="font-medium">Vehicle:</span> {{ $schedule->prefVehicle }} <br>
                                                <span class="font-medium">Time:</span> {{ \Carbon\Carbon::parse($schedule->{$day})->format('h:i A') }}
                                            </p>
                                        </div>
                                        <div class="mt-3 sm:mt-0">
                                            <button onclick="document.getElementById('request-form-{{ $schedule->id }}').submit()"
                                                class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 rounded-md shadow focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                                Send Request
                                            </button>
                                            <form id="request-form-{{ $schedule->id }}" action="{{ route('requests.send') }}" method="POST" class="hidden">
                                                @csrf
                                                <input type="hidden" name="receiver_id" value="{{ $schedule->user->studentID }}">
                                                <input type="hidden" name="schedule_id" value="{{ $schedule->id }}">
                                            </form>
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
@endsection

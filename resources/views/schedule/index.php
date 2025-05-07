@extends('layouts.app')

@section('header')
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        My Travel Schedule
    </h2>
@endsection

@section('content')
    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow rounded-lg">
                <div class="p-6 border-b border-gray-200">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-lg font-semibold text-gray-900">Your Scheduled Times</h3>
                        <a href="{{ route('schedule.create') }}"
                            class="px-4 py-2 bg-blue-600 text-white text-sm font-semibold rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-400">
                            Add New Schedule
                        </a>
                    </div>

                    @if (session('success'))
                        <div class="mb-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if($schedules->isEmpty())
                        <p class="text-gray-500">You haven't created any schedules yet.</p>
                    @else
                        <div class="overflow-x-auto">
                            <table class="min-w-full text-sm text-left text-gray-700">
                                <thead class="bg-gray-100 uppercase text-xs text-gray-600">
                                    <tr>
                                        <th class="px-4 py-3">Destination</th>
                                        <th class="px-4 py-3">Vehicle</th>
                                        <th class="px-4 py-3">Sunday</th>
                                        <th class="px-4 py-3">Monday</th>
                                        <th class="px-4 py-3">Tuesday</th>
                                        <th class="px-4 py-3">Wednesday</th>
                                        <th class="px-4 py-3">Thursday</th>
                                        <th class="px-4 py-3">Friday</th>
                                        <th class="px-4 py-3">Saturday</th>
                                        <th class="px-4 py-3">Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-200 bg-white">
                                    @foreach($schedules as $schedule)
                                        <tr>
                                            <td class="px-4 py-3">{{ $schedule->toDest }}</td>
                                            <td class="px-4 py-3">{{ $schedule->prefVehicle }}</td>
                                            <td class="px-4 py-3">{{ $schedule->sun ? \Carbon\Carbon::parse($schedule->sun)->format('h:i A') : '-' }}</td>
                                            <td class="px-4 py-3">{{ $schedule->mon ? \Carbon\Carbon::parse($schedule->mon)->format('h:i A') : '-' }}</td>
                                            <td class="px-4 py-3">{{ $schedule->tue ? \Carbon\Carbon::parse($schedule->tue)->format('h:i A') : '-' }}</td>
                                            <td class="px-4 py-3">{{ $schedule->wed ? \Carbon\Carbon::parse($schedule->wed)->format('h:i A') : '-' }}</td>
                                            <td class="px-4 py-3">{{ $schedule->thu ? \Carbon\Carbon::parse($schedule->thu)->format('h:i A') : '-' }}</td>
                                            <td class="px-4 py-3">{{ $schedule->fri ? \Carbon\Carbon::parse($schedule->fri)->format('h:i A') : '-' }}</td>
                                            <td class="px-4 py-3">{{ $schedule->sat ? \Carbon\Carbon::parse($schedule->sat)->format('h:i A') : '-' }}</td>
                                            <td class="px-4 py-3 space-x-2">
                                                <a href="{{ route('schedule.edit', $schedule->id) }}"
                                                    class="text-blue-600 hover:text-blue-900">
                                                    Edit
                                                </a>
                                                <form action="{{ route('schedule.destroy', $schedule->id) }}" method="POST"
                                                    class="inline-block"
                                                    onsubmit="return confirm('Are you sure you want to delete this schedule?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                        class="text-red-600 hover:text-red-900">
                                                        Delete
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection

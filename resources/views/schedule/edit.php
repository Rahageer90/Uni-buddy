@extends('layouts.app')

@section('header')
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ isset($schedule) ? 'Edit' : 'Create' }} Travel Schedule
    </h2>
@endsection

@section('content')
    <div class="py-6">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow rounded-lg">
                <div class="p-6">
                    <form method="POST" action="{{ isset($schedule) ? route('schedule.update', $schedule->id) : route('schedule.store') }}">
                        @csrf
                        @if(isset($schedule))
                            @method('PUT')
                        @endif

                        <div class="grid grid-cols-1 gap-4">
                            <div>
                                <label for="toDest" class="block text-sm font-medium text-gray-700">Destination</label>
                                <input type="text" name="toDest" id="toDest"
                                    value="{{ old('toDest', $schedule->toDest ?? '') }}" required
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                                @error('toDest')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="prefVehicle" class="block text-sm font-medium text-gray-700">Preferred Vehicle</label>
                                <select name="prefVehicle" id="prefVehicle" required
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                                    <option value="">Select Vehicle</option>
                                    <option value="Car" {{ old('prefVehicle', $schedule->prefVehicle ?? '') == 'Car' ? 'selected' : '' }}>Car</option>
                                    <option value="Bike" {{ old('prefVehicle', $schedule->prefVehicle ?? '') == 'Bike' ? 'selected' : '' }}>Bike</option>
                                    <option value="Public Transport" {{ old('prefVehicle', $schedule->prefVehicle ?? '') == 'Public Transport' ? 'selected' : '' }}>Public Transport</option>
                                    <option value="Any" {{ old('prefVehicle', $schedule->prefVehicle ?? '') == 'Any' ? 'selected' : '' }}>Any</option>
                                </select>
                                @error('prefVehicle')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="mt-6 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                            @foreach(['sun' => 'Sunday', 'mon' => 'Monday', 'tue' => 'Tuesday', 'wed' => 'Wednesday', 'thu' => 'Thursday', 'fri' => 'Friday', 'sat' => 'Saturday'] as $dayKey => $dayName)
                                <div>
                                    <label for="{{ $dayKey }}" class="block text-sm font-medium text-gray-700">{{ $dayName }}</label>
                                    <input type="time" name="{{ $dayKey }}" id="{{ $dayKey }}"
                                        value="{{ old($dayKey, $schedule->$dayKey ?? '') }}"
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                                </div>
                            @endforeach
                        </div>

                        <div class="mt-6 flex justify-end space-x-3">
                            <a href="{{ route('schedule.index') }}"
                                class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-blue-500">
                                Cancel
                            </a>
                            <button type="submit"
                                class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                                {{ isset($schedule) ? 'Update' : 'Save' }} Schedule
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

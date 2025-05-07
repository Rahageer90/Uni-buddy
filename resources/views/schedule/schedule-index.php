<div class="py-6">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <div class="flex justify-between items-center mb-6">
                    <h3 class="text-lg font-medium text-gray-900">Your Scheduled Times</h3>
                    <a href="#" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 transition ease-in-out duration-150">
                        Add New Schedule
                    </a>
                </div>

                <!-- Example success alert -->
                <div class="mb-4 px-4 py-3 bg-green-100 border border-green-400 text-green-700 rounded relative">
                    Successfully added!
                </div>

                <!-- Example table -->
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Destination</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Vehicle</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Sunday</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Monday</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Tuesday</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Wednesday</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Thursday</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Friday</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Saturday</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">Dhaka</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">Car</td>
                                <td class="px-6 py-4 text-sm text-gray-500">08:00 AM</td>
                                <td class="px-6 py-4 text-sm text-gray-500">09:00 AM</td>
                                <td class="px-6 py-4 text-sm text-gray-500">-</td>
                                <td class="px-6 py-4 text-sm text-gray-500">-</td>
                                <td class="px-6 py-4 text-sm text-gray-500">-</td>
                                <td class="px-6 py-4 text-sm text-gray-500">-</td>
                                <td class="px-6 py-4 text-sm text-gray-500">-</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <a href="#" class="text-blue-600 hover:text-blue-900 mr-3">Edit</a>
                                    <button class="text-red-600 hover:text-red-900" onclick="alert('Are you sure you want to delete this schedule?');">Delete</button>
                                </td>
                            </tr>
                            <!-- Add more rows as needed -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<x-admin-layout>
    <main class="flex-1 p-6 overflow-y-auto bg-gray-100">
        <div class="mb-6">
            <h1 class="text-2xl font-bold text-gray-800">User — {{ $user->name }}</h1>
            <p class="text-sm text-gray-500">Profile and activity details</p>
        </div>

        <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
            <div class="grid grid-cols-1 gap-6 md:grid-cols-3">
                <div class="flex flex-col items-center">
                    <img src="https://i.pravatar.cc/150?u={{ $user->id }}" class="w-32 h-32 rounded-full mb-4">
                    <p class="text-sm text-gray-600">Joined {{ $user->created_at->format('M d, Y') }}</p>
                </div>
                <div class="md:col-span-2">
                    <p><strong class="text-gray-700">Email:</strong> {{ $user->email }}</p>
                    <p class="mt-2"><strong class="text-gray-700">Name:</strong> {{ $user->name }}</p>
                    <p class="mt-2"><strong class="text-gray-700">ID:</strong> {{ $user->id }}</p>
                </div>
            </div>
        </div>
    </main>
</x-admin-layout>

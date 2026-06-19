<x-admin-layout>
    <main class="flex-1 p-6 overflow-y-auto bg-gray-100">
        <div class="mb-6">
            <h1 class="text-2xl font-bold text-gray-800">Order Details</h1>
            <p class="text-sm text-gray-500">Order #{{ $order->id }}</p>
        </div>

        <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
            <pre class="whitespace-pre-wrap text-sm">{{ json_encode($order, JSON_PRETTY_PRINT) }}</pre>
        </div>
    </main>
</x-admin-layout>

<x-admin-layout>
      <main class="flex-1 p-6 overflow-y-auto bg-gray-100">
                
                <div class="flex flex-col items-start justify-between gap-4 mb-6 sm:flex-row sm:items-center">
                    <div>
                        <h1 class="text-2xl font-bold text-gray-800">Orders</h1>
                        <p class="text-sm text-gray-500">Manage and track customer orders</p>
                    </div>
                    <button class="border border-gray-300 bg-white hover:bg-gray-50 text-gray-700 px-5 py-2.5 rounded-lg text-sm font-medium transition flex items-center gap-2 shadow-sm">
                        <i class="fa-solid fa-file-export"></i> Export All
                    </button>
                </div>

                <div class="p-4 mb-6 bg-white border border-gray-100 shadow-sm rounded-xl">
                    <div class="flex flex-col justify-between gap-4 md:flex-row">
                        <div class="flex flex-col w-full gap-4 md:flex-row md:w-auto">
                            <div class="relative w-full md:w-64">
                                <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                                    <i class="text-gray-400 fa-solid fa-search"></i>
                                </span>
                                <input type="text" class="w-full py-2 pl-10 pr-4 text-sm border rounded-lg focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary" placeholder="Order ID or Customer Name...">
                            </div>
                            
                            <select class="w-full px-3 py-2 text-sm text-gray-600 bg-white border rounded-lg md:w-48 focus:outline-none focus:border-primary">
                                <option value="">Order Status</option>
                                <option value="pending">Pending</option>
                                <option value="processing">Processing</option>
                                <option value="shipped">Shipped</option>
                                <option value="delivered">Delivered</option>
                                <option value="cancelled">Cancelled</option>
                            </select>

                            <input type="date" class="w-full px-3 py-2 text-sm text-gray-500 border rounded-lg md:w-48 focus:outline-none focus:border-primary">
                        </div>
                    </div>
                </div>

                <div class="overflow-hidden bg-white border border-gray-100 shadow-sm rounded-xl">
                    <div class="overflow-x-auto">
                        <table class="w-full text-left whitespace-nowrap">
                            <thead class="text-xs font-semibold text-gray-500 uppercase bg-gray-50">
                                <tr>
                                    <th class="px-6 py-4">Order ID</th>
                                    <th class="px-6 py-4">Customer</th>
                                    <th class="px-6 py-4">Date</th>
                                    <th class="px-6 py-4">Total</th>
                                    <th class="px-6 py-4">Payment</th>
                                    <th class="px-6 py-4">Status</th>
                                    <th class="px-6 py-4 text-right">Action</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100">
                                <tr class="transition hover:bg-gray-50">
                                    <td class="px-6 py-4">
                                        <span class="font-bold text-gray-700">#ORD-5521</span>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex items-center gap-3">
                                            <div class="flex items-center justify-center w-8 h-8 text-xs font-bold text-blue-600 bg-blue-100 rounded-full">JD</div>
                                            <div>
                                                <p class="text-sm font-semibold text-gray-800">John Doe</p>
                                                <p class="text-xs text-gray-500">john@example.com</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-600">Oct 24, 2025</td>
                                    <td class="px-6 py-4 text-sm font-bold text-gray-800">$120.50</td>
                                    <td class="px-6 py-4">
                                        <span class="px-2 py-1 text-xs font-semibold text-green-700 rounded-full bg-green-50">Paid</span>
                                    </td>
                                    <td class="px-6 py-4">
                                        <span class="bg-blue-100 text-blue-700 px-2.5 py-1 rounded-full text-xs font-semibold">Processing</span>
                                    </td>
                                    <td class="px-6 py-4 text-right">
                                        <div class="flex items-center justify-end gap-2">
                                            <button class="flex items-center justify-center w-8 h-8 text-gray-500 transition rounded-full hover:bg-gray-100" title="View Details">
                                                <i class="fa-solid fa-eye"></i>
                                            </button>
                                            <button class="flex items-center justify-center w-8 h-8 text-gray-500 transition rounded-full hover:bg-gray-100" title="Download Invoice">
                                                <i class="fa-solid fa-download"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>

                                <tr class="transition hover:bg-gray-50">
                                    <td class="px-6 py-4">
                                        <span class="font-bold text-gray-700">#ORD-5520</span>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex items-center gap-3">
                                            <div class="flex items-center justify-center w-8 h-8 text-xs font-bold text-purple-600 bg-purple-100 rounded-full">AS</div>
                                            <div>
                                                <p class="text-sm font-semibold text-gray-800">Alice Smith</p>
                                                <p class="text-xs text-gray-500">alice@example.com</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-600">Oct 23, 2025</td>
                                    <td class="px-6 py-4 text-sm font-bold text-gray-800">$45.00</td>
                                    <td class="px-6 py-4">
                                        <span class="px-2 py-1 text-xs font-semibold text-yellow-700 rounded-full bg-yellow-50">Unpaid</span>
                                    </td>
                                    <td class="px-6 py-4">
                                        <span class="bg-yellow-100 text-yellow-700 px-2.5 py-1 rounded-full text-xs font-semibold">Pending</span>
                                    </td>
                                    <td class="px-6 py-4 text-right">
                                        <div class="flex items-center justify-end gap-2">
                                            <button class="flex items-center justify-center w-8 h-8 text-gray-500 transition rounded-full hover:bg-gray-100" title="View Details">
                                                <i class="fa-solid fa-eye"></i>
                                            </button>
                                            <button class="flex items-center justify-center w-8 h-8 text-gray-500 transition rounded-full hover:bg-gray-100" title="Download Invoice">
                                                <i class="fa-solid fa-download"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>

                                <tr class="transition hover:bg-gray-50">
                                    <td class="px-6 py-4">
                                        <span class="font-bold text-gray-700">#ORD-5519</span>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex items-center gap-3">
                                            <div class="flex items-center justify-center w-8 h-8 text-xs font-bold text-green-600 bg-green-100 rounded-full">RJ</div>
                                            <div>
                                                <p class="text-sm font-semibold text-gray-800">Robert Johnson</p>
                                                <p class="text-xs text-gray-500">robert@example.com</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-600">Oct 22, 2025</td>
                                    <td class="px-6 py-4 text-sm font-bold text-gray-800">$250.00</td>
                                    <td class="px-6 py-4">
                                        <span class="px-2 py-1 text-xs font-semibold text-green-700 rounded-full bg-green-50">Paid</span>
                                    </td>
                                    <td class="px-6 py-4">
                                        <span class="bg-green-100 text-green-700 px-2.5 py-1 rounded-full text-xs font-semibold">Delivered</span>
                                    </td>
                                    <td class="px-6 py-4 text-right">
                                        <div class="flex items-center justify-end gap-2">
                                            <button class="flex items-center justify-center w-8 h-8 text-gray-500 transition rounded-full hover:bg-gray-100" title="View Details">
                                                <i class="fa-solid fa-eye"></i>
                                            </button>
                                            <button class="flex items-center justify-center w-8 h-8 text-gray-500 transition rounded-full hover:bg-gray-100" title="Download Invoice">
                                                <i class="fa-solid fa-download"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>

                                <tr class="transition hover:bg-gray-50">
                                    <td class="px-6 py-4">
                                        <span class="font-bold text-gray-700">#ORD-5518</span>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex items-center gap-3">
                                            <div class="flex items-center justify-center w-8 h-8 text-xs font-bold text-red-600 bg-red-100 rounded-full">MK</div>
                                            <div>
                                                <p class="text-sm font-semibold text-gray-800">Michael King</p>
                                                <p class="text-xs text-gray-500">michael@example.com</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-600">Oct 21, 2025</td>
                                    <td class="px-6 py-4 text-sm font-bold text-gray-800">$85.00</td>
                                    <td class="px-6 py-4">
                                        <span class="px-2 py-1 text-xs font-semibold text-red-700 rounded-full bg-red-50">Refunded</span>
                                    </td>
                                    <td class="px-6 py-4">
                                        <span class="bg-red-100 text-red-700 px-2.5 py-1 rounded-full text-xs font-semibold">Cancelled</span>
                                    </td>
                                    <td class="px-6 py-4 text-right">
                                        <div class="flex items-center justify-end gap-2">
                                            <button class="flex items-center justify-center w-8 h-8 text-gray-500 transition rounded-full hover:bg-gray-100" title="View Details">
                                                <i class="fa-solid fa-eye"></i>
                                            </button>
                                            <button class="flex items-center justify-center w-8 h-8 text-gray-500 transition rounded-full hover:bg-gray-100" title="Download Invoice">
                                                <i class="fa-solid fa-download"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="flex flex-col items-center justify-between gap-4 px-6 py-4 border-t border-gray-100 sm:flex-row">
                        <span class="text-sm text-gray-500">Showing <span class="font-bold text-gray-700">1-4</span> of <span class="font-bold text-gray-700">56</span> orders</span>
                        
                        <div class="flex gap-2">
                            <button class="px-3 py-1 text-sm text-gray-600 border rounded hover:bg-gray-50 disabled:opacity-50" disabled>Previous</button>
                            <button class="px-3 py-1 text-sm text-white border rounded bg-primary">1</button>
                            <button class="px-3 py-1 text-sm text-gray-600 border rounded hover:bg-gray-50">2</button>
                            <button class="px-3 py-1 text-sm text-gray-600 border rounded hover:bg-gray-50">3</button>
                            <button class="px-3 py-1 text-sm text-gray-600 border rounded hover:bg-gray-50">Next</button>
                        </div>
                    </div>
                </div>

            </main>
    
</x-admin-layout>
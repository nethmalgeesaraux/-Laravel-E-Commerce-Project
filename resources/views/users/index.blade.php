<x-app-layout>
    <!-- Main Content Start -->

    <div class="relative flex items-center justify-center h-64 text-white bg-center bg-cover bg-sky-700" style="background-image: url('assets/images/page-banner.jpg');">
        <div class="absolute inset-0 bg-black bg-opacity-40"></div>
        <div class="relative z-10 text-center">
            <h2 class="mb-2 text-4xl font-bold">My Account</h2>
            <ul class="flex justify-center space-x-2 text-sm">
                <li><a href="index.php" class="hover:text-primary">Home</a></li>
                <li>/</li>
                <li class="text-primary">My Account</li>
            </ul>
        </div>
    </div>

    <section class="py-16">
        <div class="container px-4 mx-auto">
            <div class="flex flex-col gap-8 lg:flex-row">

              @include('users.sidebar')

                <div class="w-full lg:w-3/4">

                    <div id="dashboard" class="account-tab-content">
                        <div class="p-6 bg-white border rounded">
                            <h4 class="mb-4 text-xl font-bold">Dashboard</h4>
                            <div class="p-4 mb-6 border-l-4 bg-blue-50 border-primary">
                                <p>Hello, <strong>{{Auth::user()->name}}</strong> (If Not <strong>{{Auth::user()->name}}</strong> <a href="{{route('login')}}" class="text-primary hover:underline">Logout</a>)</p>
                            </div>
                            <p class="leading-relaxed text-gray-600">
                                From your account dashboard, you can easily check & view your recent orders, manage your shipping and billing addresses, and edit your password and account details.
                            </p>
                        </div>
                    </div>

                    <div id="orders" class="hidden account-tab-content">
                        <div class="p-6 bg-white border rounded">
                            <h4 class="mb-6 text-xl font-bold">Orders</h4>
                            <div class="overflow-x-auto">
                                <table class="w-full text-left border-collapse">
                                    <thead>
                                        <tr class="bg-gray-100 border-b">
                                            <th class="p-4 font-bold">No</th>
                                            <th class="p-4 font-bold">Name</th>
                                            <th class="p-4 font-bold">Date</th>
                                            <th class="p-4 font-bold">Status</th>
                                            <th class="p-4 font-bold">Total</th>
                                            <th class="p-4 font-bold">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y">
                                        <tr>
                                            <td class="p-4">1</td>
                                            <td class="p-4">Mostarizing Oil</td>
                                            <td class="p-4">Aug 22, 2020</td>
                                            <td class="p-4"><span class="px-2 py-1 text-xs text-yellow-800 bg-yellow-100 rounded">Pending</span></td>
                                            <td class="p-4">$100</td>
                                            <td class="p-4"><a href="#" class="px-4 py-1 text-sm text-white rounded bg-primary hover:bg-blue-600">View</a></td>
                                        </tr>
                                        <tr>
                                            <td class="p-4">2</td>
                                            <td class="p-4">Katopeno Altuni</td>
                                            <td class="p-4">July 22, 2020</td>
                                            <td class="p-4"><span class="px-2 py-1 text-xs text-green-800 bg-green-100 rounded">Approved</span></td>
                                            <td class="p-4">$45</td>
                                            <td class="p-4"><a href="#" class="px-4 py-1 text-sm text-white rounded bg-primary hover:bg-blue-600">View</a></td>
                                        </tr>
                                        <tr>
                                            <td class="p-4">3</td>
                                            <td class="p-4">Murikhete Paris</td>
                                            <td class="p-4">June 22, 2020</td>
                                            <td class="p-4"><span class="px-2 py-1 text-xs text-red-800 bg-red-100 rounded">On Hold</span></td>
                                            <td class="p-4">$99</td>
                                            <td class="p-4"><a href="#" class="px-4 py-1 text-sm text-white rounded bg-primary hover:bg-blue-600">View</a></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div id="downloads" class="hidden account-tab-content">
                        <div class="p-6 bg-white border rounded">
                            <h4 class="mb-6 text-xl font-bold">Download</h4>
                            <div class="overflow-x-auto">
                                <table class="w-full text-left border-collapse">
                                    <thead>
                                        <tr class="bg-gray-100 border-b">
                                            <th class="p-4 font-bold">Product</th>
                                            <th class="p-4 font-bold">Date</th>
                                            <th class="p-4 font-bold">Expire</th>
                                            <th class="p-4 font-bold">Download</th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y">
                                        <tr>
                                            <td class="p-4">Mostarizing Oil</td>
                                            <td class="p-4">Aug 22, 2020</td>
                                            <td class="p-4">Yes</td>
                                            <td class="p-4"><a href="#" class="text-primary hover:underline">Download File</a></td>
                                        </tr>
                                        <tr>
                                            <td class="p-4">Katopeno Altuni</td>
                                            <td class="p-4">July 22, 2020</td>
                                            <td class="p-4">Never</td>
                                            <td class="p-4"><a href="#" class="text-primary hover:underline">Download File</a></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div id="payment" class="hidden account-tab-content">
                        <div class="p-6 bg-white border rounded">
                            <h4 class="mb-4 text-xl font-bold">Payment Method</h4>
                            <div class="p-4 border-l-4 border-yellow-400 bg-yellow-50">
                                <p class="text-yellow-700">You Can't Save Your Payment Method yet.</p>
                            </div>
                        </div>
                    </div>

                    <div id="address" class="hidden account-tab-content">
                        <div class="p-6 bg-white border rounded">
                            <h4 class="mb-6 text-xl font-bold">Address</h4>
                            <div class="grid gap-8 md:grid-cols-2">
                                <div class="p-4 border rounded bg-gray-50">
                                    <h5 class="mb-2 text-lg font-bold">Billing Address</h5>
                                    <address class="mb-4 text-sm not-italic text-gray-600">
                                        <strong class="block mb-1 text-base text-gray-800">Alex Tuntuni</strong>
                                        1355 Market St, Suite 900<br>
                                        San Francisco, CA 94103<br>
                                        Mobile: (123) 456-7890
                                    </address>
                                    <a href="#" class="inline-block px-4 py-2 text-sm text-white rounded bg-primary hover:bg-blue-600"><i class="fa fa-edit"></i> Edit Address</a>
                                </div>
                                <div class="p-4 border rounded bg-gray-50">
                                    <h5 class="mb-2 text-lg font-bold">Shipping Address</h5>
                                    <address class="mb-4 text-sm not-italic text-gray-600">
                                        <strong class="block mb-1 text-base text-gray-800">Alex Tuntuni</strong>
                                        1355 Market St, Suite 900<br>
                                        San Francisco, CA 94103<br>
                                        Mobile: (123) 456-7890
                                    </address>
                                    <a href="#" class="inline-block px-4 py-2 text-sm text-white rounded bg-primary hover:bg-blue-600"><i class="fa fa-edit"></i> Edit Address</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div id="details" class="hidden account-tab-content">
                        <div class="p-6 bg-white border rounded">
                            <h4 class="mb-6 text-xl font-bold">Account Details</h4>
                            <form action="#" class="space-y-4">
                                <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                                    <div>
                                        <label class="block mb-1 text-sm">First Name</label>
                                        <input type="text" class="w-full p-3 border rounded focus:outline-none focus:border-primary">
                                    </div>
                                    <div>
                                        <label class="block mb-1 text-sm">Last Name</label>
                                        <input type="text" class="w-full p-3 border rounded focus:outline-none focus:border-primary">
                                    </div>
                                </div>
                                <div>
                                    <label class="block mb-1 text-sm">Display Name</label>
                                    <input type="text" class="w-full p-3 border rounded focus:outline-none focus:border-primary">
                                </div>
                                <div>
                                    <label class="block mb-1 text-sm">Email Address</label>
                                    <input type="email" class="w-full p-3 border rounded focus:outline-none focus:border-primary">
                                </div>

                                <div class="pt-4">
                                    <h5 class="mb-3 text-lg font-bold">Password Change</h5>
                                    <div class="space-y-4">
                                        <input type="password" placeholder="Current Password" class="w-full p-3 border rounded focus:outline-none focus:border-primary">
                                        <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                                            <input type="password" placeholder="New Password" class="w-full p-3 border rounded focus:outline-none focus:border-primary">
                                            <input type="password" placeholder="Confirm Password" class="w-full p-3 border rounded focus:outline-none focus:border-primary">
                                        </div>
                                    </div>
                                </div>

                                <button class="px-6 py-3 text-white transition rounded shadow bg-primary hover:bg-blue-600">Save Changes</button>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>

    <!-- Main Content End -->
</x-app-layout>
  <div class="w-full lg:w-1/4">
                    <div class="overflow-hidden border rounded bg-gray-50">
                        <ul class="flex flex-col divide-y">
                            <li>
                                <button class="flex items-center w-full gap-3 px-6 py-4 text-left transition account-tab-btn active" data-target="dashboard">
                                    <i class="w-5 text-center fa fa-tachometer"></i> Dashboard
                                </button>
                            </li>
                            <li>
                                <button class="flex items-center w-full gap-3 px-6 py-4 text-left transition account-tab-btn" data-target="orders">
                                    <i class="w-5 text-center fa fa-shopping-cart"></i> Orders
                                </button>
                            </li>
                            <li>
                                <button class="flex items-center w-full gap-3 px-6 py-4 text-left transition account-tab-btn" data-target="downloads">
                                    <i class="w-5 text-center fa fa-cloud-download"></i> Downloads
                                </button>
                            </li>
                            <li>
                                <button class="flex items-center w-full gap-3 px-6 py-4 text-left transition account-tab-btn" data-target="payment">
                                    <i class="w-5 text-center fa fa-credit-card"></i> Payment Method
                                </button>
                            </li>
                            <li>
                                <button class="flex items-center w-full gap-3 px-6 py-4 text-left transition account-tab-btn" data-target="address">
                                    <i class="w-5 text-center fa fa-map-marker"></i> Address
                                </button>
                            </li>
                            <li>
                                <button class="flex items-center w-full gap-3 px-6 py-4 text-left transition account-tab-btn" data-target="details">
                                    <i class="w-5 text-center fa fa-user"></i> Account Details
                                </button>
                            </li>
                            <li>
                                <a href="{{ route('logout') }}"
                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit()"
                                    class="flex items-center w-full gap-3 px-6 py-4 text-left transition hover:bg-gray-100 hover:text-red-500">
                                    <i class="w-5 text-center fa fa-sign-out"></i> Logout
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
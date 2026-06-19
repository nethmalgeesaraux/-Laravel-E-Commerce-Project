<x-admin-layout>
     <main class="flex-1 p-6 overflow-y-auto bg-gray-100">
                
                <div class="mb-6">
                    <h1 class="text-2xl font-bold text-gray-800">Account Settings</h1>
                    <p class="text-sm text-gray-500">Update your profile, security, and store preferences.</p>
                </div>

                <div class="w-full mx-auto">
                    <div class="flex mb-8 overflow-x-auto border-b border-gray-200 no-scrollbar">
                        <button class="px-6 py-3 text-sm font-medium transition border-b-2 border-transparent tab-btn active whitespace-nowrap" data-target="profile-tab">
                            <i class="mr-2 fa-solid fa-user-gear"></i> Profile Info
                        </button>
                        <button class="px-6 py-3 text-sm font-medium transition border-b-2 border-transparent tab-btn whitespace-nowrap" data-target="security-tab">
                            <i class="mr-2 fa-solid fa-shield-halved"></i> Password & Security
                        </button>
                        <button class="px-6 py-3 text-sm font-medium transition border-b-2 border-transparent tab-btn whitespace-nowrap" data-target="store-tab">
                            <i class="mr-2 fa-solid fa-store"></i> Store Configuration
                        </button>
                    </div>

                    <div id="profile-tab" class="block tab-content animate-fadeIn">
                        <form action="#" class="space-y-6">
                            <div class="p-8 bg-white border border-gray-100 shadow-sm rounded-xl">
                                <h3 class="pb-4 mb-6 text-lg font-bold text-gray-800 border-b">Personal Information</h3>
                                
                                <div class="flex flex-col items-start gap-8 mb-8 md:flex-row">
                                    <div class="relative group">
                                        <img src="https://i.pravatar.cc/150?img=12" class="object-cover w-32 h-32 border-4 border-gray-100 rounded-full shadow-sm" alt="Profile">
                                        <label class="absolute inset-0 flex items-center justify-center text-white transition bg-black rounded-full opacity-0 cursor-pointer bg-opacity-40 group-hover:opacity-100">
                                            <i class="fa-solid fa-camera"></i>
                                            <input type="file" class="hidden">
                                        </label>
                                    </div>
                                    <div class="flex-1 w-full space-y-4">
                                        <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                                            <div>
                                                <label class="block mb-1 text-sm font-medium text-gray-700">Full Name</label>
                                                <input type="text" value="Admin User" class="w-full px-4 py-2 text-sm border rounded-lg outline-none focus:ring-1 focus:ring-primary">
                                            </div>
                                            <div>
                                                <label class="block mb-1 text-sm font-medium text-gray-700">Email Address</label>
                                                <input type="email" value="admin@surfsidemedia.com" class="w-full px-4 py-2 text-sm border rounded-lg outline-none focus:ring-1 focus:ring-primary">
                                            </div>
                                        </div>
                                        <div>
                                            <label class="block mb-1 text-sm font-medium text-gray-700">Phone Number</label>
                                            <input type="text" value="+1 234 567 890" class="w-full px-4 py-2 text-sm border rounded-lg outline-none focus:ring-1 focus:ring-primary">
                                        </div>
                                    </div>
                                </div>

                                <div class="flex justify-end gap-3 pt-6 border-t">
                                    <button type="submit" class="px-6 py-2 text-sm font-medium text-white transition rounded-lg shadow-md bg-primary hover:bg-blue-600">Save Changes</button>
                                </div>
                            </div>
                        </form>
                    </div>

                    <div id="security-tab" class="hidden tab-content animate-fadeIn">
                        <div class="max-w-2xl p-8 mx-auto bg-white border border-gray-100 shadow-sm rounded-xl">
                            <h3 class="pb-4 mb-6 text-lg font-bold text-gray-800 border-b">Update Password</h3>
                            <form class="space-y-4">
                                <div>
                                    <label class="block mb-1 text-sm font-medium text-gray-700">Current Password</label>
                                    <input type="password" class="w-full px-4 py-2 text-sm border rounded-lg outline-none focus:ring-1 focus:ring-primary">
                                </div>
                                <div>
                                    <label class="block mb-1 text-sm font-medium text-gray-700">New Password</label>
                                    <input type="password" class="w-full px-4 py-2 text-sm border rounded-lg outline-none focus:ring-1 focus:ring-primary">
                                </div>
                                <div>
                                    <label class="block mb-1 text-sm font-medium text-gray-700">Confirm New Password</label>
                                    <input type="password" class="w-full px-4 py-2 text-sm border rounded-lg outline-none focus:ring-1 focus:ring-primary">
                                </div>
                                <div class="pt-4">
                                    <button type="submit" class="w-full bg-primary text-white py-2.5 rounded-lg hover:bg-blue-600 transition font-medium shadow-sm">Update Password</button>
                                </div>
                            </form>
                            
                            <div class="pt-6 mt-8 border-t">
                                <h4 class="mb-2 text-sm font-bold text-red-600">Two-Factor Authentication</h4>
                                <p class="mb-4 text-xs text-gray-500">Add an extra layer of security to your account.</p>
                                <button class="px-4 py-2 text-xs font-bold transition border rounded-lg border-primary text-primary hover:bg-primary hover:text-white">Enable 2FA</button>
                            </div>
                        </div>
                    </div>

                    <div id="store-tab" class="hidden tab-content animate-fadeIn">
                        <div class="p-8 bg-white border border-gray-100 shadow-sm rounded-xl">
                            <h3 class="pb-4 mb-6 text-lg font-bold text-gray-800 border-b">Store Settings</h3>
                            <form action="{{ route('admin.settings.update') }}" method="POST" class="grid grid-cols-1 gap-8 md:grid-cols-2">
                                @csrf
                                <div class="space-y-4">
                                    <div>
                                        <label class="block mb-1 text-sm font-medium text-gray-700">Store Name</label>
                                        <input type="text" name="site_name" value="{{ old('site_name', $settings['site_name'] ?? '') }}" class="w-full px-4 py-2 text-sm border rounded-lg outline-none focus:ring-1 focus:ring-primary">
                                    </div>
                                    <div>
                                        <label class="block mb-1 text-sm font-medium text-gray-700">Currency</label>
                                        <select class="w-full px-4 py-2 text-sm bg-white border rounded-lg outline-none focus:ring-1 focus:ring-primary" name="currency">
                                            <option value="USD" {{ (old('currency', $settings['currency'] ?? 'USD') == 'USD') ? 'selected' : '' }}>USD ($)</option>
                                            <option value="EUR" {{ (old('currency', $settings['currency'] ?? '') == 'EUR') ? 'selected' : '' }}>EUR (€)</option>
                                            <option value="GBP" {{ (old('currency', $settings['currency'] ?? '') == 'GBP') ? 'selected' : '' }}>GBP (£)</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="space-y-4">
                                    <div>
                                        <label class="block mb-1 text-sm font-medium text-gray-700">Store Status</label>
                                        <div class="flex items-center gap-3 py-2">
                                            <select name="store_status" class="px-3 py-2 border rounded">
                                                <option value="online" {{ (old('store_status', $settings['store_status'] ?? 'online') == 'online') ? 'selected' : '' }}>Online</option>
                                                <option value="offline" {{ (old('store_status', $settings['store_status'] ?? '') == 'offline') ? 'selected' : '' }}>Offline</option>
                                            </select>
                                            <span class="text-sm text-gray-600">Online / Public</span>
                                        </div>
                                    </div>
                                    <div>
                                        <label class="block mb-1 text-sm font-medium text-gray-700">Order Notifications Email</label>
                                        <input type="email" name="contact_email" value="{{ old('contact_email', $settings['contact_email'] ?? '') }}" class="w-full px-4 py-2 text-sm border rounded-lg outline-none focus:ring-1 focus:ring-primary">
                                    </div>
                                </div>
                                <div class="md:col-span-2 flex justify-end pt-8">
                                    <button type="submit" class="px-6 py-2 text-sm font-medium text-white transition rounded-lg shadow-md bg-primary hover:bg-blue-600">Save Settings</button>
                                </div>
                            </form>
                        </div>
                    </div>

                </div>

            </main>



             <script>
         // Tabs Switching Logic
         const tabBtns = document.querySelectorAll('.tab-btn');
        const tabContents = document.querySelectorAll('.tab-content');

        tabBtns.forEach(btn => {
            btn.addEventListener('click', () => {
                // Remove active classes
                tabBtns.forEach(b => b.classList.remove('active', 'border-primary', 'text-primary'));
                tabContents.forEach(c => c.classList.add('hidden'));

                // Add active classes
                btn.classList.add('active', 'border-primary', 'text-primary');
                const target = btn.getAttribute('data-target');
                document.getElementById(target).classList.remove('hidden');
            });
        });
    </script>
</x-admin-layout>

 
                {{-- Mobile Menu Toggle --}}
                <button @click="$store.sidebar.navOpen = !$store.sidebar.navOpen" class="sm:hidden absolute top-5 right-5 focus:outline-none">
                    {{-- Menu Icon --}}
                    <svg  xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6" x-bind:class="$store.sidebar.navOpen ? 'hidden':''">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                    </svg>

                    {{-- Close Icon --}}
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6" x-bind:class="$store.sidebar.navOpen ? '':'hidden'">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                    </svg>
                </button>
                <div class="h-screen bg-sidebar transition-all duration-500 space-y-2 fixed sm:relative"
                    x-data 
                    x-bind:class="{'w-64': $store.sidebar.full, 'w-64 sm:w-20': !$store.sidebar.full, 'top-0 left-0': $store.sidebar.navOpen, 'top-0 -left-64 sm:left-0': !$store.sidebar.navOpen}">
                    <div class="flex items-center justify-center py-4">
                        <img src="{{ asset('image/logo.png') }}" alt="logo" class="w-14">
                        <h1 class="text-white font-black py-4 ps-2 text-lg md:text-lg lg:text-2xl" x-bind:class="$store.sidebar.full ? '':'sm:hidden'">Tanihub</h1>
                    </div>
                    <div class="px-4 space-y-2">
                        {{-- Sidebar Toggle --}}
                        <button @click="$store.sidebar.full = !$store.sidebar.full" class="hidden sm:block focus:outline-none absolute p-1 -right-3 top-10 bg-gray-900 rounded-full shadow-md">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 transition-all duration-500 text-white transform" x-bind:class="$store.sidebar.full ? 'rotate-180':'rotate-0'">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" />
                            </svg>
                        </button>
                        {{-- Dashboard --}}
                        <a href="{{ route('page.dashboard') }}" 
                            class="relative flex items-center text-font-dark hover:text-font-dark hover:bg-hover space-x-2 rounded-md p-2 cursor-pointer {{ Request::is('/') ? 'text-font-dark bg-hover' : 'text-font-light' }}"
                            x-bind:class="{'justify-start': $store.sidebar.full, 'sm:justify-center':!$store.sidebar.full}">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 h-8">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m2.25 12 8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                            </svg>
                            <h1 x-bind:class="$store.sidebar.full ? '':'sm:hidden'">Dashboard</h1>
                        </a>
                        {{-- Analytics --}}
                        <a href="{{ route('page.analytics') }}"
                            class="relative flex items-center text-font-dark hover:text-font-dark hover:bg-hover space-x-2 rounded-md p-2 cursor-pointer {{ Request::is('analytics') ? 'text-font-dark bg-hover' : 'text-font-light' }}"
                            x-bind:class="{'justify-start': $store.sidebar.full, 'sm:justify-center':!$store.sidebar.full}">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 h-8">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3 13.125C3 12.504 3.504 12 4.125 12h2.25c.621 0 1.125.504 1.125 1.125v6.75C7.5 20.496 6.996 21 6.375 21h-2.25A1.125 1.125 0 0 1 3 19.875v-6.75ZM9.75 8.625c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125v11.25c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 0 1-1.125-1.125V8.625ZM16.5 4.125c0-.621.504-1.125 1.125-1.125h2.25C20.496 3 21 3.504 21 4.125v15.75c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 0 1-1.125-1.125V4.125Z" />
                            </svg>
                            <h1 x-bind:class="$store.sidebar.full ? '':'sm:hidden'">Analytics</h1>
                        </a>
                        {{-- Monitor --}}
                        <a href="{{ route('page.monitor') }}"
                            class="relative flex items-center text-font-dark hover:text-font-dark hover:bg-hover space-x-2 rounded-md p-2 cursor-pointer {{ Request::is('monitor') ? 'text-font-dark bg-hover' : 'text-font-light'}}" 
                            x-bind:class="{'justify-start': $store.sidebar.full, 'sm:justify-center':!$store.sidebar.full}">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 h-8">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 17.25v1.007a3 3 0 0 1-.879 2.122L7.5 21h9l-.621-.621A3 3 0 0 1 15 18.257V17.25m6-12V15a2.25 2.25 0 0 1-2.25 2.25H5.25A2.25 2.25 0 0 1 3 15V5.25m18 0A2.25 2.25 0 0 0 18.75 3H5.25A2.25 2.25 0 0 0 3 5.25m18 0V12a2.25 2.25 0 0 1-2.25 2.25H5.25A2.25 2.25 0 0 1 3 12V5.25" />
                            </svg>
                            <h1 x-bind:class="$store.sidebar.full ? '':'sm:hidden'">Monitor</h1>
                        </a>
                        {{-- Device --}}
                        <a href="{{ route('page.device') }}"
                            class="relative flex items-center text-font-dark hover:text-font-dark hover:bg-hover space-x-2 rounded-md p-2 cursor-pointer {{ Request::is('device') ? 'text-font-dark bg-hover' : 'text-font-light'}}" 
                            x-bind:class="{'justify-start': $store.sidebar.full, 'sm:justify-center':!$store.sidebar.full}">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 h-8">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v6m3-3H9m12 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                            </svg>
                            <h1 x-bind:class="$store.sidebar.full ? '':'sm:hidden'">Device</h1>
                        </a>
                        {{-- Profile --}}
                        <a href="{{ route('page.profile') }}"
                            class="relative flex items-center text-font-dark hover:text-font-dark hover:bg-hover space-x-2 rounded-md p-2 cursor-pointer {{ Request::is('profile') ? 'text-font-dark bg-hover' : 'text-font-light'}}" 
                            x-bind:class="{'justify-start': $store.sidebar.full, 'sm:justify-center':!$store.sidebar.full}">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 h-8">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 12c2.25 0 4.5-1.5 4.5-4.5S14.25 3 12 3s-4.5 1.5-4.5 4.5S9.75 12 12 12ZM6 18v1.5c0 1.5 1.5 1.5 3 1.5h6c1.5 0 3 0 3-1.5V18c0-2.5-4-3-6-3s-6 .5-6 3Z" />
                            </svg>
                            <h1 x-bind:class="$store.sidebar.full ? '':'sm:hidden'">Profile</h1>
                        </a>
                    </div>
                    <div class="px-4 space-y-2 absolute bottom-0 w-full pb-4">
                        {{-- Logout --}}
                        <form method="POST" action="{{ route('logout' )}}">
                            @csrf
                            <button type="submit" 
                                class="w-full flex items-center text-font-light hover:text-font-dark hover:bg-hover-logout space-x-2 rounded-md p-2 cursor-pointer"
                                x-bind:class="{'justify-start': $store.sidebar.full, 'sm:justify-center':!$store.sidebar.full}">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 h-8  rotate-180">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 9V5.25A2.25 2.25 0 0 1 10.5 3h6a2.25 2.25 0 0 1 2.25 2.25v13.5A2.25 2.25 0 0 1 16.5 21h-6a2.25 2.25 0 0 1-2.25-2.25V15m-3 0-3-3m0 0 3-3m-3 3H15" />
                                </svg>
                                
                                <h1 x-bind:class="$store.sidebar.full ? '':'sm:hidden'">Logout</h1>
                            </button>
                        </form>
                    </div>
                </div>

<nav class="bg-white shadow relative z-50">
    <div class="container">
        <div class="flex items-center justify-between flex-wrap">
            <div>
                <a href="{{ url('/') }}" class="flex items-center flex-no-shrink text-blue-dark mr-6 no-underline">
                    <span class="font-semibold text-xl tracking-tight">{{ config('app.name', 'Laravel') }}</span>
                </a>
            </div>
            <div class="block sm:hidden">
                <button v-on:click="toggleSidebar"
                        class="flex items-center px-3 py-2 border rounded text-blue-light border-blue-light hover:text-white hover:border-white">
                    <i class="fas fa-bars"></i>
                </button>
            </div>
            <div :class="sidebar ? 'block': 'hidden'" class="w-full sm:flex sm:items-center sm:w-auto">
                <div class="flex">
                    @component('components.layout.navbar-link',['url'=>url('/community')])
                        Browse Community Listings
                    @endcomponent

                <!-- Authentication Links -->
                    @guest

                        @component('components.layout.navbar-link',['url'=>route('login')])
                            {{ __('Login') }}
                        @endcomponent

                        @if (Route::has('register'))
                            @component('components.layout.navbar-link',['url'=>route('register')])
                                {{ __('Register') }}
                            @endcomponent
                        @endif

                    @else
                        <div class="relative">
                            @component('components.layout.navbar-link-dropdown',['dropdownKey'=>'user'])
                                My Account
                            @endcomponent
                            <transition name="slide">
                                <div class="slide-transition-element relative" v-if="dropdown=='user'">
                                    <div class="bg-white shadow absolute mt-0 pin-t pin-r z-50"
                                         style="min-width:300px;">
                                        <div class="bg-blue p-4 text-white">
                                            @if(!empty(\Auth::user()->name)){{ \Auth::user()->name }}<br>@endif
                                            <small>{{ \Auth::user()->email }}</small>
                                        </div>
                                        <div class="bg-white">

                                            @if(\Auth::user()->hasRole('admin'))
                                                @component('components.layout.navbar-link-dropdown-item',['url'=>url('/manage/user')])
                                                    Manage Users
                                                @endcomponent
                                                @component('components.layout.navbar-link-dropdown-item',['url'=>url('/manage/community-management-request')])
                                                    Manage Community Management Requests
                                                @endcomponent
                                            @endif

                                            @component('components.layout.navbar-link-dropdown-item',['url'=>url('/account/user')])
                                                My Account
                                            @endcomponent

                                            @if(\Auth::user()->isCCRCManager())
                                                @component('components.layout.navbar-link-dropdown-item',['url'=>url('/account/community')])
                                                    My Communities
                                                @endcomponent
                                                    @component('components.layout.navbar-link-dropdown-item',['url'=>url('/account/billing')])
                                                        Billing Information
                                                    @endcomponent
                                            @endif

                                            @component('components.layout.navbar-link-dropdown-item',['url'=>'javascript:document.getElementById(\'logout-form\').submit();'])
                                               {{ __('Logout') }}
                                            @endcomponent
                                            <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                                  class="hidden">
                                                {{ csrf_field() }}
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </transition>
                        </div>
                    @endguest
                </div>
            </div>
        </div>
    </div>
</nav>
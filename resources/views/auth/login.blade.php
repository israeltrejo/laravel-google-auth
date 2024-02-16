@extends('layouts.login')

@section('content')
    <section class="rounded-lg w-full h-screen">
        <div class="w-full h-full flex flex-col mx-auto bg-white dark:bg-gray-900 rounded-lg justify-center items-center">
            <div class="flex justify-center w-full h-full my-auto xl:gap-14 lg:justify-normal md:gap-5 draggable">
                <div class="flex items-center justify-center w-full lg:p-12">
                    <div class="flex items-center xl:p-10">
                        <form class="flex flex-col w-full h-full pb-6 text-center bg-white dark:bg-gray-900 rounded-3xl" method="POST"
                            action="{{ route('login') }}">
                            @csrf
                            <h3 class="mb-3 text-4xl font-extrabold text-slate-900 dark:text-slate-100">Sign In</h3>
                            <p class="mb-4 text-slate-700 dark:text-slate-300">Enter your email and password</p>
                            <a
                                href="{{ GoogleAuth::getAuthUrl() }}"
                                class="cursor-pointer flex items-center justify-center w-full py-4 mb-6 text-sm font-medium transition duration-300 rounded-2xl text-slate-900 dark:bg-white bg-slate-100 hover:bg-slate-200 hover:dark:bg-gray-200">
                                <img class="h-5 mr-2" src="{{ URL::to('images/icons/google.png') }}" alt="Google Icon">
                                Sign in with Google
                            </a>
                            <div class="flex items-center mb-3">
                                <hr class="h-0 border-b border-solid border-slate-300 dark:border-slate-500 grow">
                                <p class="mx-4 text-slate-400">or</p>
                                <hr class="h-0 border-b border-solid border-slate-300 dark:border-slate-500 grow">
                            </div>
                            <x-input-error :messages="$errors->get('email')" class="mb-3 max-w-[24rem]" />
                            <label for="email" class="mb-2 text-sm text-start text-slate-700 dark:text-slate-100">Email</label>
                            <input id="email" required type="email" name="email" placeholder="mail@example.com"
                                autocomplete="off"
                                class="flex items-center w-full px-5 py-4 mr-2 text-sm font-medium outline-none border-none active:outline-none active:border-none active:bg-slate-100 focus:outline-none focus:border-none focus:bg-slate-50 mb-7 placeholder:text-slate-400 bg-slate-100 text-slate-600 dark:bg-white dark:text-slate-900 rounded-2xl focus:ring-0" />
                            <label for="password" class="mb-2 text-sm text-start text-slate-700 dark:text-slate-100">Password</label>
                            <input id="password" required type="password" name="password" placeholder="Enter a password"
                                autocomplete="off"
                                class="flex items-center w-full px-5 py-4 mr-2 text-sm font-medium outline-none border-none active:outline-none active:border-none active:bg-slate-100 focus:outline-none focus:border-none focus:bg-slate-50 mb-7 placeholder:text-slate-400 bg-slate-100 text-slate-600 dark:bg-white dark:text-slate-900 rounded-2xl focus:ring-0" />
                            <div class="flex flex-row justify-between mb-8">
                                <label class="relative inline-flex items-center mr-3 cursor-pointer select-none">
                                    <input type="checkbox" checked value="" class="sr-only peer">
                                    <div
                                        class="w-5 h-5 bg-white border-2 rounded-sm border-slate-500 peer peer-checked:border-0 peer-checked:bg-blue-500">
                                        <img class=""
                                            src="https://raw.githubusercontent.com/Loopple/loopple-public-assets/main/motion-tailwind/img/icons/check.png"
                                            alt="tick">
                                    </div>
                                    <span class="ml-3 text-sm font-normal text-slate-900 dark:text-slate-100">Keep me logged in</span>
                                </label>
                                @if (Route::has('password.request'))
                                    <a href="{{ route('password.request') }}"
                                        class="mr-4 text-sm font-medium text-blue-500">Forget password?</a>
                                @endif
                            </div>
                            <button
                                class="w-full px-6 py-5 mb-5 text-sm font-bold leading-none text-white transition duration-300 md:w-96 rounded-2xl hover:bg-blue-600 focus:ring-4 focus:ring-blue-100 bg-blue-500">Sign
                                In</button>
                            <p class="text-sm leading-relaxed text-slate-900 dark:text-slate-100">
                                Not registered yet?
                                <a href="{{ route('register') }}" class="font-medium text-blue-500">Create an Account</a>
                            </p>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

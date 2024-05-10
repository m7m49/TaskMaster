@extends('layout')

@section('content')

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link
    href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;0,800;1,200;1,300;1,400;1,500;1,600;1,700;1,800&display=swap"
    rel="stylesheet">

<style>
    body {
        font-family: 'Plus Jakarta Sans', sans-serif;
    }
</style>

<div class="bg-white w-full flex flex-col gap-5 px-3 md:px-16 lg:px-28 md:flex-row text-[#161931] overflow-y-scroll">
    <main class="w-full min-h-screen py-1 md:w-2/3 lg:w-3/4">
        <div class="p-2 md:p-4">
            <div class="w-full pb-8 mt-8 sm:max-w-xl sm:rounded-lg">
                
                <form method="POST" action="/updateProfile" class="mt-10 inline" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')
                
                    <div class="grid max-w-2xl mx-auto mt-8">
                        <div class="flex flex-col items-center space-y-5 sm:flex-row sm:space-y-0">

                            <img class="object-cover w-40 h-40 p-1 rounded-full ring-2 ring-indigo-300 dark:ring-indigo-500"
                            src="{{ asset('storage/' . auth()->user()->picture) }}"
                            alt="Bordered avatar">

                            <div class="flex flex-col space-y-5 sm:ml-8">
                                <label 
                                    class="py-3.5 px-7 text-base font-medium text-indigo-100 focus:outline-none bg-[#202142] rounded-lg border border-indigo-200 hover:bg-indigo-900 focus:z-10 focus:ring-4 focus:ring-indigo-200"
                                    for="picture">
                                    Change picture
                                </label>
                                <input class="border border-gray-400 p-2 w-full rounded-lg hidden"
                                    type="file"
                                    name="picture"
                                    id="picture"
                                    value="{{old('picture', auth()->user()->picture)}}"
                                >
                                @error('picture')
                                    <div class="text-red-500 text-xs mt-2">{{ $message }}</div>
                                @enderror
                    
                            </div>
                        </div>

                        <div class="items-center mt-8 sm:mt-14 text-[#202142]">
                            <div
                                class="flex flex-col items-center w-full mb-2 space-x-0 space-y-2 sm:flex-row sm:space-x-4 sm:space-y-0 sm:mb-6">
                                <div class="w-full">
                                    <label for="username"
                                    class="block mb-2 text-sm font-medium text-indigo-900 dark:text-white">Username</label>
                                
                                    <input type="text" id="username"
                                    class="bg-indigo-50 border border-indigo-300 text-indigo-900 text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full p-2.5 pointer-events-none"
                                    value="{{old('username', auth()->user()->username)}}">
                                </div>
                            
                                <div class="w-full">
                                    <label for="email"
                                    class="block mb-2 text-sm font-medium text-indigo-900 dark:text-white">Email</label>

                                    <input type="text" id="email"
                                        class="bg-indigo-50 border border-indigo-300 text-indigo-900 text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full p-2.5 pointer-events-none"
                                        value="{{old('email', auth()->user()->email)}}">
                                </div>

                            </div>
                                <button type="button" id="changePasswordBtn" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Change Password?</button>
                            
                                <div id="changePassword" class="hidden">
                                    <div class="mb-2 sm:mb-6">
                                        <label for="current_password"
                                        class="block mb-2 text-sm font-medium text-indigo-900 dark:text-white mt-4">Current Password
                                    </label>
                                    
                                    <input type="password"
                                    class="bg-indigo-50 border border-indigo-300 text-indigo-900 text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full p-2.5 "
                                    name="current_password">

                                    @error('current_password')
                                        <div class="text-red-500 text-xs mt-2">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="mb-2 sm:mb-6">
                                    <label for="newPassword"
                                           class="block mb-2 text-sm font-medium text-indigo-900 dark:text-white">New Password
                                    </label>
                                    
                                    <input type="password"
                                        class="bg-indigo-50 border border-indigo-300 text-indigo-900 text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full p-2.5 "
                                        name="newPassword">

                                        @error('newPassword')
                                            <div class="text-red-500 text-xs mt-2">{{ $message }}</div>
                                        @enderror
                                </div>
                            
                                <div class="mb-2 sm:mb-6">
                                    <label for="newPassword_confirmation"
                                           class="block mb-2 text-sm font-medium text-indigo-900 dark:text-white">Confirm New Password
                                    </label>
                            
                                    <input type="password"
                                           class="bg-indigo-50 border border-indigo-300 text-indigo-900 text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full p-2.5 "
                                           name="newPassword_confirmation">

                                           @error('newPassword_confirmation')
                                            <div class="text-red-500 text-xs mt-2">{{ $message }}</div>
                                        @enderror
                                </div>
                                
                                <script>
                                    document.getElementById('changePasswordBtn').addEventListener('click', function() {
                                        document.getElementById('changePassword').style.display = 'block';
                                    });
                                </script> 
                        </div>
                        
                        <div class="flex justify-end">
                            <button type="submit"
                                class="text-white bg-indigo-700 hover:bg-indigo-800 focus:ring-4 focus:outline-none focus:ring-indigo-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-indigo-600 dark:hover:bg-indigo-700 dark:focus:ring-indigo-800">Save</button>
                        </div>
                    </div>    
                </form>
            </div>
        </div>
    </main>
</div>

@endsection
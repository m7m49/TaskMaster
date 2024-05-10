@extends('layout')

{{-- The following styles are to highlight the selected button in the priority section --}}
<style>
    input[type="radio"]:checked + label {
        border: 2px solid black; /* Add a red border around the label when the radio button is checked */
        padding: 4px; /* Optional: Add padding to make the border more visible */
        border-radius: 4px; /* Optional: Add border radius for rounded corners */
    }
</style>

@section('content')

<div class="flex items-center justify-center p-12 overflow-y-scroll">
    <!-- Author: FormBold Team -->
    <div class="mx-auto w-full max-w-[550px]">
        <form action="/newTask" method="POST">
            @csrf 

            <div class="mb-12">
                <label for="title" class="mb-3 block text-base font-medium text-[#07074D]">
                    Task Title
                </label>
                <input type="text" name="title" id="title" value="{{old('title')}}"
                    class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-4 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md" />

                @error('title')
                    <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-12">
                <label for="phone" class="mb-3 block text-base font-medium text-[#07074D]">
                    Task Description (Optional)
                </label>
                <textarea 
                id="description" rows="4" 
                name="description"
                class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-4 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md" 
                placeholder="Write more details about the task...">{{old('description')}}</textarea>

                @error('description')
                    <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                @enderror

            </div>
            <div class="mb-12">
                    <label class="mb-3 block text-base font-medium text-[#07074D]">
                        Priority Level
                    </label>

                    <div class="inline-flex items-center rounded-md bg-red-50 px-2 py-1 text-xs font-medium text-red-700 ring-1 ring-inset ring-red-600 mr-12">
                        <input id="critical" type="radio" value="Critical" name="priority" class="hidden" @if(old('priority') == 'Critical') checked ="true" @endif>
                        <label for="critical" class="ms-2 text-sm font-medium text-red-900 dark:text-red-300 cursor-pointer">Critical</label>
                    </div>
                    <div class="inline-flex items-center rounded-md bg-purple-50 px-2 py-1 text-xs font-medium text-purple-700 ring-1 ring-inset ring-purple-700 mr-12">
                        <input id="high_priority" type="radio" value="High Priority" name="priority" class="hidden" @if(old('priority') == 'High Priority') checked ="true" @endif>
                        <label for="high_priority" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300 cursor-pointer">High Priority</label>
                    </div>
                    <div class="inline-flex items-center rounded-md bg-green-50 px-2 py-1 text-xs font-medium text-green-700 ring-1 ring-inset ring-green-600 mr-12">
                        <input id="neutral" type="radio" value="Neutral" name="priority" class="hidden" @if(old('priority') == 'Neutral') checked ="true" @endif>
                        <label for="neutral" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300 cursor-pointer">Neutral</label>
                    </div>
                    <div class="inline-flex items-center rounded-md bg-yellow-50 px-2 py-1 text-xs font-medium text-yellow-800 ring-1 ring-inset ring-yellow-600 mr-12">
                        <input id="low_priority" type="radio" value="Low Priority" name="priority" class="hidden" @if(old('priority') == 'Low Priority') checked ="true" @endif>
                        <label for="low_priority" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300 cursor-pointer">Low Priority</label>
                    </div>
                    <div class="inline-flex items-center rounded-md bg-gray-50 px-2 py-1 text-xs font-medium text-gray-600 ring-1 ring-inset ring-gray-500 mr-12">
                        <input id="unkown" type="radio" value="Unknown" name="priority" class="hidden" @if(old('priority') == 'Unknown') checked ="true" @endif>
                        <label for="unkown" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300 cursor-pointer">Unknown</label>
                    </div>
                    
                @error('priority')
                    <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                @enderror
                
            </div>
            <div class="-mx-3 flex flex-wrap">
                <div class="w-full px-3 sm:w-1/2">
                    <div class="mb-5">
                        <label for="deadline" class="mb-3 block text-base font-medium text-[#07074D]">
                            Task Deadline
                        </label>
                        <input type="datetime-local" name="deadline" id="deadline" value="{{old('deadline')}}"
                            class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md" />

                            @error('deadline')
                                <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                            @enderror
                    </div>
                </div>
            </div>
            <div class="flex flex-col items-center">
                <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-12 py-2.5 me-2 mb-2 mt-6 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                    Add it!
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
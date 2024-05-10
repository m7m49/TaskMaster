@extends('layout')

@section('content')
<main class="flex-1 overflow-x-auto overflow-y-auto bg-gray-200">
    <div class="container px-6 py-8 mx-auto">
    <h4 class="text-xl font-medium text-gray-700 mb-6">Completed Tasks</h4>    
     
    <section class="">
        <div class="flex flex-col">
          <div class="">
            <form action="" method="GET">
              <div class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-4">
                <div class="flex flex-col">
                  <label for="priority" class="text-sm font-medium text-indigo-900">Priority</label>
                  <select id="priority" name="priority" class="block w-full px-2 py-2 mt-2 bg-indigo-100 border border-indigo-100 rounded-md shadow-sm outline-none cursor-pointer focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    <option value="">Any</option>
                    <option @if(request()->priority == 'Critical') selected @endif>Critical</option>
                    <option @if(request()->priority == 'High Priority') selected @endif>High Priority</option>
                    <option @if(request()->priority == 'Neutral') selected @endif>Neutral</option>
                    <option @if(request()->priority == 'Low Priority') selected @endif>Low Priority</option>
                    <option @if(request()->priority == 'Unknown') selected @endif>Unknown</option>
                    </select>
    
                </div>

                <div class="flex flex-col">
                  <label for="status" class="text-sm font-medium text-indigo-900">Status</label>
                  <select id="status" name="status" class="block w-full px-2 py-2 mt-2 bg-indigo-100 border border-indigo-100 rounded-md shadow-sm outline-none cursor-pointer focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                      <option value="">Any</option>
                      <option @if(request()->status == 'On Time') selected @endif>On Time</option>
                      <option @if(request()->status == 'Overdue') selected @endif>Overdue</option>
                    </select>
    
                </div>
                <div class="flex flex-col">
                    <label for="deadline_bf" class="text-sm font-medium text-indigo-900">Deadline Before:</label>
                    <input value="{{request()->deadline_bf}}" type="datetime-local" id="deadline_bf" name="deadline_bf" class="block w-full px-2 py-2 mt-2 bg-indigo-100 border border-indigo-100 rounded-md shadow-sm outline-none cursor-pointer focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                  </div>

                  <div class="flex flex-col">
                    <label for="deadline_af" class="text-sm font-medium text-indigo-900">De-adline After:</label>
                    <input value="{{request()->deadline_af}}" type="datetime-local" id="deadline_af" name="deadline_af" class="block w-full px-2 py-2 mt-2 bg-indigo-100 border border-indigo-100 rounded-md shadow-sm outline-none cursor-pointer focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                  </div>
                </div>
              </div>
              <div class="flex items-center justify-between mt-4">
                <input class="w-1/3 h-8 pl-3 pr-4 rounded-md form-input sm:w-1/3 focus:border-indigo-600" type="text" name="search" placeholder="Search" value="{{request()->search}}">
                <div class="grid grid-cols-2 justify-end space-x-4 md:flex">
                    <a href="/" class="rounded-lg bg-white px-8 py-2 font-medium text-gray-700 outline-none hover:opacity-80 focus:ring">Reset</a>
                    <button class="rounded-lg bg-blue-600 px-8 py-2 font-medium text-white outline-none hover:opacity-80 focus:ring">Apply</button>
                </div>
            </div>
                
            </form>
          </div>
        </div>
    </section>          
    <div class="flex flex-col px-4">
        <div class="py-2 -my-2 sm:-mx-6 sm:px-6 lg:-mx-8 lg:px-8">
            <div
                class="inline-block min-w-full align-middle border-b border-gray-200 shadow sm:rounded-lg">
                <table class="min-w-full">
                    <thead class="sticky top-0">
                        <tr>
                            <th
                                class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase border-b border-gray-200 bg-gray-50">
                                Task</th>
                            <th
                                class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase border-b border-gray-200 bg-gray-50">
                                Description</th>
                            <th
                                class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-center text-gray-500 uppercase border-b border-gray-200 bg-gray-50">
                                Priority</th>
                            <th
                                class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-center text-gray-500 uppercase border-b border-gray-200 bg-gray-50">
                                Deadline</th>
                            <th
                                class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-center text-gray-500 uppercase border-b border-gray-200 bg-gray-50 whitespace-nowrap">
                                Done At</th>
                            <th
                                class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-center text-gray-500 uppercase border-b border-gray-200 bg-gray-50">
                                Status</th>
                            
                        </tr>
                    </thead>
                    <tbody class="bg-white">
                        @foreach ($doneTask as $done)
                            <tr>
                                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                    <div class="text-sm font-medium leading-5 text-left text-gray-900">{{$done->title}}</div>
                                </td>

                                <td class="px-6 py-4 whitespace-no-wrap text-left border-b border-gray-200 break-all">
                                    <div class="text-sm leading-5 text-gray-900">{{$done->description}}</div>
                                </td>

                                <td class="px-6 py-4 whitespace-no-wrap text-center border-b border-gray-200">
                                    <span
                                        @php $imp = $done->priority @endphp
                                        class="inline-flex px-2 text-xs font-semibold leading-5 
                                        @if ($imp == 'Critical') bg-red-300 text-red-900 dark:text-red-300
                                        @elseif ($imp == 'High Priority') bg-purple-50 text-purple-700 
                                        @elseif ($imp == 'Neutral') text-green-800 bg-green-100 
                                        @elseif ($imp == 'Low Priority') bg-yellow-50 text-yellow-800
                                        @else bg-gray-50 text-gray-600 
                                        @endif rounded-full whitespace-nowrap">

                                        {{$done->priority}}
                                    </span>
                                </td>

                                <td
                                    class="px-6 py-4 text-sm leading-5 text-center text-gray-500 whitespace-no-wrap border-b border-gray-200">
                                    {{$done->deadline}}
                                </td>

                                <td class="py-4 text-sm font-medium leading-5 text-center whitespace-no-wrap border-b border-gray-200">
                                    {{$done->done_at}}
                                </td>

                                <td class="py-4 text-sm font-medium leading-5 text-center whitespace-no-wrap border-b border-gray-200">
                                    <span
                                        class="inline-flex px-2 text-xs font-semibold leading-5 
                                        @if ($done->status == 'Overdue') text-red-900 dark:text-red-300 bg-red-200
                                        @else text-green-800 bg-green-100 
                                        @endif rounded-full whitespace-nowrap">
                                        {{$done->status}}
                                    </span>
                                </td>
                            </tr>
                        @endforeach    
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
</main>
@endsection
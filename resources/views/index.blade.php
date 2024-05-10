@extends('layout')
@section('content')
<main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-200">
                <div class="container px-6 py-8 mx-auto">
                    <span class="text-s font-bold uppercase float-right mb-4">Welcome, {{ auth()->user()->username }}!</span>
                    <h3 class="text-3xl font-medium text-gray-700">Dashboard</h3>
                    
                    <div class="mt-4">
                        <div class="flex flex-wrap -mx-6">
                            <div class="w-full px-6 sm:w-1/2 xl:w-1/3">
                                <div class="flex items-center px-5 py-6 bg-white rounded-md shadow-sm">
                                    <div class="p-3 bg-indigo-600 bg-opacity-75 rounded-full">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="35" height="35" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-pending-tasks">
                                            <circle cx="12" cy="12" r="10"></circle>
                                            <path d="M12 6v6l4 2"></path>
                                            <path d="M12 18v-4"></path>
                                          </svg>
                                    </div>
                                    <div class="mx-5">
                                        <h4 class="text-2xl font-semibold text-gray-700">{{count(auth()->user()->task)}}</h4>
                                        <div class="text-gray-500">Pending Tasks</div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="w-full px-6 mt-6 sm:w-1/2 xl:w-1/3 sm:mt-0">
                                <div class="flex items-center px-5 py-6 bg-white rounded-md shadow-sm">
                                    <div class="p-3 bg-green-600 bg-opacity-75 rounded-full">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="35" height="35" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-circle">
                                            <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                                            <polyline points="22 4 12 14.01 9 11.01"></polyline>
                                            <circle cx="12" cy="12" r="10" stroke="currentColor" stroke-width="2"></circle>
                                          </svg>
                                    </div>
    
                                    <div class="mx-5">
                                        <h4 class="text-2xl font-semibold text-gray-700">{{ $done->where('status', 'On time')->count() }}</h4>
                                        <div class="text-gray-500">On-time Completed Tasks</div>
                                    </div>
                                </div>
                            </div>
    
                            <div class="w-full px-6 mt-6 sm:w-1/2 xl:w-1/3 xl:mt-0">
                                <div class="flex items-center px-5 py-6 bg-white rounded-md shadow-sm">
                                    <div class="p-3 bg-red-500  rounded-full">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="35" height="35" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-overdue-tasks">
                                            <rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect>
                                            <line x1="9" y1="15" x2="15" y2="9"></line>
                                            <line x1="9" y1="9" x2="15" y2="15"></line>
                                          </svg>
                                          
                                          
                                    </div>
    
                                    <div class="mx-5">
                                        <h4 class="text-2xl font-semibold text-gray-700">{{$done->where('status', 'Overdue')->count()}}</h4>
                                        <div class="text-gray-500">Overdue Tasks</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
    
                    <div class="mt-8">
                        
                    </div>
                    <a href="/newTask" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800 float-right">Add a New Task</a>
                    <h4 class="text-xl font-medium text-gray-700 mb-8">Current Tasks</h4><div class="relative">
                        <section class="">
                            <div class="flex flex-col">
                              <div class="">
                                <form action="" method="GET">
                                    <div class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-3">
                                        <div class="flex flex-col">
                                      <label for="priority" class="text-sm font-medium text-indigo-900">Priority</label>
                                      {{-- @dd(request()->priority) --}}
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
                                        <label for="deadline_bf" class="text-sm font-medium text-indigo-900">Deadline Before:</label>
                                        <input value="{{request()->deadline_bf}}" type="date" id="deadline_bf" name="deadline_bf" class="block w-full px-2 py-2 mt-2 bg-indigo-100 border border-indigo-100 rounded-md shadow-sm outline-none cursor-pointer focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                      </div>

                                      <div class="flex flex-col">
                                        <label for="deadline_af" class="text-sm font-medium text-indigo-900">Deadline After:</label>
                                        <input value="{{request()->deadline_af}}" type="date" id="deadline_af" name="deadline_af" class="block w-full px-2 py-2 mt-2 bg-indigo-100 border border-indigo-100 rounded-md shadow-sm outline-none cursor-pointer focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                      </div>
                                    </div>
                                  </div>
                                  <div class="flex items-center justify-between">                          
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
                        
                    <div class="flex flex-col mt-8">
                        @if (!count($tasks) && !request('search'))
                            <h1 class="flex mt-12 text-sm font-bold tracking-tight items-center justify-center text-gray-900 sm:text-2xl">No Tasks Currently!</h1>
                        @elseif(request('search'))
                            <h1 class="flex mt-12 text-sm font-bold tracking-tight items-center justify-center text-gray-900 sm:text-2xl">No Matched Tasks!</h1>
                        @else    
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
                                                    class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-center text-gray-500 uppercase border-b border-gray-200 bg-gray-50">
                                                    Options</th>
                                                
                                            </tr>
                                        </thead>
                                        <tbody class="bg-white">
                                            @foreach ($tasks as $task)
                                                <tr id={{$task->id}}>
                                                    <td class="px-6 py-4 whitespace-no-wrap border-b text-left border-gray-200">
                                                        <div class="text-sm font-medium leading-5 text-gray-900">{{$task->title}}</div>
                                                    </td>
        
                                                    <td class="px-6 py-4 whitespace-no-wrap text-left border-b border-gray-200 break-all">
                                                        <div class="text-sm leading-5 text-gray-900">{{$task->description}}</div>
                                                    </td>
            
                                                    <td class="px-6 py-4 whitespace-no-wrap text-center border-b border-gray-200">
                                                        <span
                                                            @php $imp = $task->priority @endphp
                                                            class="inline-flex px-2 text-xs font-semibold leading-5 
                                                            @if ($imp == 'Critical') bg-red-300 text-red-900 dark:text-red-300
                                                            @elseif ($imp == 'High Priority') bg-purple-50 text-purple-700 
                                                            @elseif ($imp == 'Neutral') text-green-800 bg-green-100 
                                                            @elseif ($imp == 'Low Priority') bg-yellow-50 text-yellow-800
                                                            @else bg-gray-50 text-gray-600 
                                                            @endif rounded-full whitespace-nowrap">

                                                            {{$task->priority}}
                                                        </span>
                                                    </td>
            
                                                    <td
                                                        class="px-6 py-4 text-sm leading-5 text-center text-gray-500 whitespace-no-wrap border-b border-gray-200">
                                                        {{$task->deadline}}
                                                    </td>
            
                                                    <td class="py-4 text-sm font-medium leading-5 whitespace-no-wrap border-b border-gray-200">
                                                        <a href="/task/{{$task->id}}/edit" class="text-indigo-600 hover:text-indigo-900 pl-10">Edit</a>
                                                        <form method="POST" action="{{ route('deleteTask', $task->id) }}">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="text-red-600 font-medium hover:text-red-800 pl-10 block mt-4 btn btn-xs btn-danger btn-flat delete" data-toggle="tooltip" title='Delete'>Delete</button>
                                                        </form>
                                                        <script type="text/javascript">
                                             
                                                            $('.delete').click(function(event) {
                                                                 var form =  $(this).closest("form");
                                                                 var name = $(this).data("name");
                                                                 event.preventDefault();
                                                                 Swal.fire({
                                                                    title: "Are you sure?",
                                                                    text: "You won't be able to revert this!",
                                                                    icon: "warning",
                                                                    showCancelButton: true,
                                                                    confirmButtonColor: "#3085d6",
                                                                    cancelButtonColor: "#d33",
                                                                    confirmButtonText: "Yes, delete it!"
                                                                    }).then((result) => {
                                                                    if (result.isConfirmed) {
                                                                        form.submit();
                                                                    }
                                                                });
                                                             });
                                                         
                                                       </script>
                                                        <form method="POST" action="{{ route('check', $task->id) }}">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="text-green-600 font-medium hover:text-green-900 pl-10 block mt-4 btn btn-xs btn-danger btn-flat check" data-toggle="tooltip" title='Delete'>Check</button>
                                                        </form>
                                                        
                                                        <script type="text/javascript">
                                             
                                                            $('.check').click(function(event) {
                                                                var form =  $(this).closest("form");
                                                                var name = $(this).data("name");
                                                                event.preventDefault();
                                                                Swal.fire({
                                                                    title: "Did you complete this task successfully?",
                                                                    showDenyButton: true,
                                                                    showCancelButton: true,
                                                                    confirmButtonText: "YES",
                                                                    denyButtonText: `NO`
                                                                }).then((result) => {
                                                                    if (result.isConfirmed) 
                                                                    {
                                                                        Swal.fire({
                                                                            position: "center",
                                                                            icon: "success",
                                                                            title: "GOOD JOB!",
                                                                            showConfirmButton: false,
                                                                            timer: 1500
                                                                        });
                                                                        form.submit();
                                                                    }    
                                                                });
                                                            });
                                                         
                                                       </script>
                                                    </td>
                                                </tr>
                                            @endforeach    
                                        </tbody>
                                    </table>
                                @endif    
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
  </div>
 @endsection
</html>  
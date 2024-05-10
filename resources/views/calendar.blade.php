@extends('layout')
@section('content')

<div class="container overflow-scroll p-4">
   

    <div id="calendar" class="bg-white p-4"></div>

</div>

<script>
    
    $(document).ready(function () {
        var tasks = @json($events);
        // console.log(tasks);
        $.ajaxSetup({
            headers:{
                'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
            }
        });
        var calendar = $('#calendar').fullCalendar({
        editable:true,
        header:{
            left:'prev,next today',
            center:'title',
            right:'month,agendaWeek,agendaDay'
        },
        events:tasks,
        editable:true,

        eventClick:function(event)
        {
            var id = event.id;
            console.log(id);
            window.open("/#" + id);
        }
    });
});
 
</script>

@endsection
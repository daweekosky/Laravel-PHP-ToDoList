<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Wykonane zadania - ') }}
            <?php
            $counter = 0;
            for($i = 0; $i < count($tasks); $i++){
                if($tasks[$i]->is_done == 1)
                    $counter = $counter+1;
            }
            echo "$counter";
        ?>
        
        </h2>
    </x-slot>

    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/bootstrap-table@1.15.5/dist/bootstrap-table.min.css">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/bootstrap-table@1.15.5/dist/bootstrap-table.min.js"></script>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="table-container">
                        <table  data-toggle="table" class="table table-dark table-striped">
                            <thead>
                                <tr>
                                    <th>Nazwa zadania</th>
                                    <th>Opis</th>
                                    <th>Termin ukończenia</th>
                                    <th>Utworzono</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($tasks as $task)
                                    @if($task->is_done == 1)
                                        <tr>
                                                <td class="text-center">{{$task->title}}</td>
                                                <td class="text-center">{{$task->description}}</td>
                                                <td class="text-center">{{$task->end_date}}</td>
                                                <td class="text-center">{{$task->created_at}}</td>
                                        </tr>
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

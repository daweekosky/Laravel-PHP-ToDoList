<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Stwórz zadanie') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-gray dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="table-container">
                        @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif
                        <div class="box box-primary">
                        <!-- /.box-header -->
                        <!-- form start -->
                            <form role="form"  action="{{ route('store') }}" id="comment-form" method="post" enctype="multipart/form-data" >
                                {{ csrf_field() }}
                                <div class="box">
                                    <div class="box-body">
                                        <div class="form-group{{ $errors->has('message')?'has-error':'' }}" id="roles_box">
                                            <x-input-label for="title" :value="__('Nazwa zadania')" />
                                            <x-text-input id="title" class="block mt-1" type="text" name="title" />
                                            <br/>
                                            <x-input-label for="description" :value="__('Opis zdarzenia')" />
                                            <x-text-input id="description" class="block mt-1 w-full" type="text" name="description" />
                                            <br/>
                                            <x-input-label for="enddate" :value="__('Termin ukończenia')" />
                                            <x-text-input id="enddate" class="block mt-1" type="date" name="enddate" />
                                        </div>
                                    </div>
                                </div>
                                <div class="box-footer">
                                    <button type="submit" class="btn  btn-success">Utwórz</button> 
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

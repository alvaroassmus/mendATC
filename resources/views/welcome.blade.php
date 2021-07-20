@extends('base')
@section('main')
    <div
        class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center py-4 sm:pt-0">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            <div class="flex justify-center pt-8 sm:justify-start sm:pt-0">
                HERE GOES DE MEND LOGO
            </div>
            @if ($errors->any())
                <div class="flex justify-center alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div><br/>
            @endif
            <div class="flex justify-center">
                <form action="javascript:void(0)" id="frm-boot" method="post">
                    @csrf
                    <button type="submit" class="btn btn-primary-outline" id="submit-boot">BOOT
                    </button>
                </form>
                <form action="javascript:void(0)" id="frm-enqueue" method="post">
                    @csrf
                    <button type="submit" class="btn btn-primary-outline" id="submit-enqueue">ENQUEUE
                    </button>
                </form>
                <form action="javascript:void(0)" id="frm-dequeue" method="post">
                    @csrf
                    <button type="submit" class="btn btn-primary-outline" id="submit-dequeue">DEQUEUE
                    </button>
                </form>
                <form action="javascript:void(0)" id="frm-list" method="post">
                    @csrf
                    <button type="submit" class="btn btn-primary-outline" id="submit-list">LIST
                    </button>
                </form>
            </div>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.2/jquery.validate.min.js"></script>
    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $("#frm-boot").validate({
            submitHandler: function () {
                $.ajax({
                    url: "{{ route('boot') }}",
                    type: 'POST',
                    dataType: "json",
                    data: {
                        _token: "{{ csrf_token() }}"
                    },
                    success: function (data) {
                        console.log(1, data);
                    },
                    error: function (error) {
                        console.error(2, error);
                    }
                });
            }
        });

        $("#frm-enqueue").validate({
            submitHandler: function () {
                $.ajax({
                    url: "{{ route('enqueue') }}",
                    type: 'POST',
                    dataType: "json",
                    data: {
                        _token: "{{ csrf_token() }}",
                        aircraft: {
                            type: 'C',
                            size: 'L'
                        }
                    },
                    success: function (data) {
                        console.log(1, data);
                    },
                    error: function (error) {
                        console.error(2, error);
                    }
                });
            }
        });

        $("#frm-dequeue").validate({
            submitHandler: function () {
                $.ajax({
                    url: "{{ route('dequeue') }}",
                    type: 'POST',
                    dataType: "json",
                    data: {
                        _token: "{{ csrf_token() }}",
                        queueName: 'cargoSmall'
                    },
                    success: function (data) {
                        console.log(1, data);
                    },
                    error: function (error) {
                        console.error(2, error);
                    }
                });
            }
        });

        $("#frm-list").validate({
            submitHandler: function () {
                $.ajax({
                    url: "{{ route('list') }}",
                    type: 'POST',
                    dataType: "json",
                    data: {
                        _token: "{{ csrf_token() }}"
                    },
                    success: function (data) {
                        console.log(1, data);
                    },
                    error: function (error) {
                        console.error(2, error);
                    }
                });
            }
        });
    </script>
@endsection

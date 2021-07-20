@extends('base')
@section('main')
    <div
        class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center py-4 sm:pt-0">
        <div class="col-12 text-center">
            <div class="flex justify-center">
                <img alt="logo"
                     src="https://raw.githubusercontent.com/alvaroassmus/mendATC/master/docs/assets/radar-svgrepo-com.svg"
                     width="200">
                <h1>mendATC Air Traffic Control</h1>
            </div>
            <div class="row justify-center">
                <div class="col-md-4 col-12 card">
                    <div class="card-body">
                        <h5 class="card-title">Boot</h5>
                        <p class="card-text">Starts the ATC system.</p>
                        <form action="javascript:void(0)" id="frm-boot" method="post">
                            <button type="submit" class="btn btn-primary-outline" id="submit-boot">
                                <img title="Boot" alt="logo" src="{{asset('images/boot.png')}}" width="100">
                            </button>
                        </form>
                    </div>
                </div>
                <div class="col-md-4 col-12 card">
                    <div class="card-body">
                        <h5 class="card-title">Enqueue</h5>
                        <p class="card-text">Adds an Aircraft to the queue.</p>
                        <form action="javascript:void(0)" id="frm-enqueue" method="post">
                            <div class="row">
                                <div class="col-12">
                                    <p>
                                        <label for="aircraftSize">Size</label>
                                        <select class="form-control" id="aircraftSize">
                                            <option value="L">Large</option>
                                            <option value="S">Small</option>
                                        </select>
                                    </p>
                                </div>
                                <div class="col-12">
                                    <p>
                                        <label for="aircraftType">Type</label>
                                        <select class="form-control" id="aircraftType">
                                            <option value="E">Emergency</option>
                                            <option value="V">Vip</option>
                                            <option value="P">People</option>
                                            <option value="C">Cargo</option>
                                        </select>
                                    </p>
                                </div>
                                <div class="col-12 button-container">
                                    <button type="submit" class="btn btn-primary" id="submit-enqueue">ENQUEUE
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-md-4 col-12 card">
                    <div class="card-body">
                        <h5 class="card-title">Dequeue</h5>
                        <p class="card-text">Removes an Aircraft from a queue.</p>
                        <form action="javascript:void(0)" id="frm-dequeue" method="post">
                            <div class="row">
                                <div class="col-12">
                                    <p>
                                        <label for="queueName">Queue Name</label>
                                        <select class="form-control" id="queueName">
                                            <option value="emergencyLarge">Emergency Large</option>
                                            <option value="emergencySmall">Emergency Small</option>
                                            <option value="vipLarge">Vip Large</option>
                                            <option value="vipSmall">Vip Small</option>
                                            <option value="peopleLarge">People Large</option>
                                            <option value="peopleSmall">People Small</option>
                                            <option value="cargoLarge">Cargo Large</option>
                                            <option value="cargoSmall">Cargo Small</option>
                                        </select>
                                    </p>
                                </div>
                                <div class="col-12 button-container">
                                    <button type="submit" class="btn btn-primary" id="submit-dequeue">DEQUEUE
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-12 card">
                    <div class="card-body">
                        <h5 class="card-title">List</h5>
                        <p class="card-text">Loads all the queues of the ATC system.</p>
                        <form action="javascript:void(0)" id="frm-list" method="post">
                            <button type="submit" class="btn btn-primary-outline" id="submit-list">LIST
                            </button>
                        </form>
                    </div>
                </div>
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
                        type: $('#aircraftType').val(),
                        size: $('#aircraftSize').val()
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
                        queueName: $('#queueName').val()
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

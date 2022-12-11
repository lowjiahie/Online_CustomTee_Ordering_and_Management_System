@extends('layouts.master')

@section('content')
    <div>
        <div style="margin: 0 auto; padding: 10px 10px 10px 10px;">
            <div class="shadow p-3 mb-5 bg-white rounded" style="width:80%; margin: 0 auto;">
                <div class='container'>
                    <form action="{{ route('admin.plainTeeDetailUpdate') }}" method="POST">
                        @csrf
                        <h1 style="font-size:24px;">Plain Tee Update Shirt</h1>
                        @foreach ($plainTeeUpdate as $plainTee)
                        <div class='row'
                            style='background-color: rgb(200, 197, 197); margin: 10px 10px 10px 10px; padding: 10px 10px 10px 10px;'>
                            <div class='col' style='color:rgb(0, 0, 0);'>
                                Plain Tee ID:
                            </div>
                            <div class='col' style='color:rgb(0, 0, 0);'>
                                {{ $plainTee->plain_tee_size_id }}
                                <input type="hidden" name="plain_tee_size_id" value="{{ $plainTee->plain_tee_size_id }}" />
                            </div>
                        </div>

                        <div class='row'
                            style='background-color: white; margin: 10px 10px 10px 10px; padding: 10px 10px 10px 10px;'>
                            <div class='col' style='color:rgb(0, 0, 0);'>
                                Stocks:
                            </div>
                            <div class='col' style='color:rgb(0, 0, 0);'>
                                <input type="number" name="stocks" value="{{ $plainTee->stocks }}" />
                            </div>
                        </div>

                        <div class='row'
                            style='background-color: rgb(200, 197, 197); color:rgb(0, 0, 0); margin: 10px 10px 10px 10px; padding: 20px 10px 20px 10px;'>
                            <div class='col' style='color:rgb(0, 0, 0);'>
                                Size Name:
                            </div>
                            <div class='col' style='color:rgb(0, 0, 0);'>
                                {{ $plainTee->size_name }}
                            </div>
                        </div>

                        <div class='row'
                            style='background-color: white; margin: 10px 10px 10px 10px; padding: 10px 10px 10px 10px;'>
                            <div class='col' style='color:rgb(0, 0, 0);'>
                                Type Color:
                            </div>
                            <div class='col' style='color:rgb(0, 0, 0);'>
                                {{ $plainTee->name }} {{ $plainTee->color_name }} {{ $plainTee->detail }}
                            </div>
                        </div>

                        <div class='row'
                            style='background-color: white; color:rgb(0, 0, 0); margin: 10px 10px 10px 10px; padding: 20px 10px 20px 10px;'>
                            <div class='col' style='color:rgb(0, 0, 0);'>
                                <input type="submit" name="updateCancel" value="Update"
                                    onclick="return confirm('Are you sure you want to update this shirt?')"
                                    style="border-style:none; border-radius:5px; color:white; background-color:black; padding:8px 50px;
                                    font-family:'system-ui'; text-transform:uppercase; letter-spacing:.8px; display:block;
                                    margin: 0 auto; box-shadow:2px 2px 5px rgb(0, 0, 0, 0.2); cursor:pointer;" />
                            </div>
                            <div class='col' style='color:rgb(0, 0, 0);'>
                                <input type="submit" name="updateCancel" value="Cancel"
                                    style="border-style:none; border-radius:5px; color:white; background-color:black; padding:8px 50px;
                                    font-family:'system-ui'; text-transform:uppercase; letter-spacing:.8px; display:block;
                                    margin: 0 auto; box-shadow:2px 2px 5px rgb(0, 0, 0, 0.2); cursor:pointer;" />
                            </div>
                        </div>
                        @endforeach
                    </form>
                </div>
            </div>
        </div>

    </div>
@endsection

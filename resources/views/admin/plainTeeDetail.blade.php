@extends('layouts.master')

@section('content')
    <div>
        <div>
            <form action="{{ route('admin.plainTeeDetailFunction') }}" method="POST">
                @csrf
                <div class="shadow p-3 mb-5 bg-white rounded" style="width:80%; height:80%; margin: 0 auto;">
                    <h1>Plain Tee Detail</h1>
                    @foreach ($plainTeeDetail as $plainTee)
                    <div class='row'
                        style='background-color: white; color:rgb(0, 0, 0); margin: 10px 10px 10px 10px; padding: 20px 10px 20px 10px;'>
                        <div class='col' style='color:rgb(0, 0, 0); margin: 0 auto;'>
                            <img src="{{ asset('plainTee/'.$plainTee->plain_tee_img) }}" alt="Plain Tee" width="200" height="200"
                            style="display: block; margin: 0 auto;" />
                        </div>
                    </div>
                    <div class='row'
                        style='background-color: rgb(200, 197, 197); color:rgb(0, 0, 0); margin: 10px 10px 10px 10px; padding: 20px 10px 20px 10px;'>
                        <div class='col' style='color:rgb(0, 0, 0);'>
                            Plain Tee ID:
                        </div>
                        <div class='col' style='color:rgb(0, 0, 0);'>
                            {{ $plainTee->plain_tee_size_id }}
                            <input type="hidden" name="plain_tee_size_id" value="{{ $plainTee->plain_tee_size_id }}" />
                        </div>
                        <div class='col' style='color:rgb(0, 0, 0);'>

                        </div>
                    </div>
                    <div class='row'
                        style='background-color: white; margin: 10px 10px 10px 10px; padding: 10px 10px 10px 10px;'>
                        <div class='col' style='color:rgb(0, 0, 0);'>
                            Stocks:
                        </div>
                        <div class='col' style='color:rgb(0, 0, 0);'>
                            {{ $plainTee->stocks }}
                        </div>
                        <div class='col' style='color:rgb(0, 0, 0);'>

                        </div>
                    </div>
                    <div class='row'
                        style='background-color: rgb(200, 197, 197); color:rgb(0, 0, 0); margin: 10px 10px 10px 10px; padding: 20px 10px 20px 10px;'>
                        <div class='col' style='color:rgb(0, 0, 0);'>
                            Size:
                        </div>
                        <div class='col' style='color:rgb(0, 0, 0);'>
                            {{ $plainTee->size_name }}
                        </div>
                        <div class='col' style='color:rgb(0, 0, 0);'>

                        </div>
                    </div>
                    <div class='row'
                        style='background-color: white; margin: 10px 10px 10px 10px; padding: 10px 10px 10px 10px;'>
                        <div class='col' style='color:rgb(0, 0, 0);'>
                            Type Name:
                        </div>
                        <div class='col' style='color:rgb(0, 0, 0);'>
                            {{ $plainTee->name }}
                        </div>
                        <div class='col' style='color:rgb(0, 0, 0);'>

                        </div>
                    </div>
                    <div class='row'
                        style='background-color: rgb(200, 197, 197); color:rgb(0, 0, 0); margin: 10px 10px 10px 10px; padding: 20px 10px 20px 10px;'>
                        <div class='col' style='color:rgb(0, 0, 0);'>
                            Material:
                        </div>
                        <div class='col' style='color:rgb(0, 0, 0);'>
                            {{ $plainTee->material }}
                        </div>
                        <div class='col' style='color:rgb(0, 0, 0);'>

                        </div>
                    </div>
                    <div class='row'
                        style='background-color: white; margin: 10px 10px 10px 10px; padding: 10px 10px 10px 10px;'>
                        <div class='col' style='color:rgb(0, 0, 0);'>
                            Description:
                        </div>
                        <div class='col' style='color:rgb(0, 0, 0);'>
                            {{ $plainTee->description }}
                        </div>
                        <div class='col' style='color:rgb(0, 0, 0);'>

                        </div>
                    </div>
                    <div class='row'
                        style='background-color: rgb(200, 197, 197); color:rgb(0, 0, 0); margin: 10px 10px 10px 10px; padding: 20px 10px 20px 10px;'>
                        <div class='col' style='color:rgb(0, 0, 0);'>
                            Detail:
                        </div>
                        <div class='col' style='color:rgb(0, 0, 0);'>
                            {{ $plainTee->detail }}
                        </div>
                        <div class='col' style='color:rgb(0, 0, 0);'>

                        </div>
                    </div>
                    <div class='row'
                        style='background-color: white; margin: 10px 10px 10px 10px; padding: 10px 10px 10px 10px;'>
                        <div class='col' style='color:rgb(0, 0, 0);'>
                            Price(RM):
                        </div>
                        <div class='col' style='color:rgb(0, 0, 0);'>
                            {{ $plainTee->price }}
                        </div>
                        <div class='col' style='color:rgb(0, 0, 0);'>

                        </div>
                    </div>
                    <div class='row'
                        style='background-color: rgb(200, 197, 197); color:rgb(0, 0, 0); margin: 10px 10px 10px 10px; padding: 20px 10px 20px 10px;'>
                        <div class='col' style='color:rgb(0, 0, 0);'>
                            Color Name:
                        </div>
                        <div class='col' style='color:rgb(0, 0, 0);'>
                            {{ $plainTee->color_name }}
                        </div>
                        <div class='col' style='color:rgb(0, 0, 0);'>

                        </div>
                    </div>
                    <div class='row'
                        style='background-color: white; margin: 10px 10px 10px 10px; padding: 10px 10px 10px 10px;'>
                        <div class='col' style='color:rgb(0, 0, 0);'>
                            Color Code:
                        </div>
                        <div class='col' style='color:rgb(0, 0, 0);'>
                            {{ $plainTee->color_code }}
                        </div>
                        <div class='col' style='color:rgb(0, 0, 0);'>

                        </div>
                    </div>

                    <div class='row' style='background-color: white; margin: 0 auto; padding: 10px 10px 10px 10px;'>
                        <div class='col' style='color:rgb(0, 0, 0);'>
                            <input type="submit" name="updateDeleteCancel" value="Update"
                            style="border-style:none; border-radius:5px; color:white; background-color:black; padding:8px 50px;
                            font-family:'system-ui'; text-transform:uppercase; letter-spacing:.8px; display:block;
                            margin: 0 auto; box-shadow:2px 2px 5px rgb(0, 0, 0, 0.2); cursor:pointer;" />
                            <input type="hidden" name="plain_tee_size_id" value="{{ $plainTee->plain_tee_size_id }}" />
                        </div>
                        <div class='col' style='color:rgb(0, 0, 0);'>
                            <input type="submit" name="updateDeleteCancel" value="Delete" onclick="return confirm('Are you sure you want to delete this data?')"
                            style="border-style:none; border-radius:5px; color:white; background-color:black; padding:8px 50px;
                            font-family:'system-ui'; text-transform:uppercase; letter-spacing:.8px; display:block;
                            margin: 0 auto; box-shadow:2px 2px 5px rgb(0, 0, 0, 0.2); cursor:pointer;" />
                        </div>
                        <div class='col' style='color:rgb(0, 0, 0);'>
                            <input type="submit" name="updateDeleteCancel" value="Cancel"
                            style="border-style:none; border-radius:5px; color:white; background-color:black; padding:8px 50px;
                            font-family:'system-ui'; text-transform:uppercase; letter-spacing:.8px; display:block;
                            margin: 0 auto; box-shadow:2px 2px 5px rgb(0, 0, 0, 0.2); cursor:pointer;" />
                        </div>
                    </div>
                    @endforeach
                </div>
            </form>
        </div>
    </div>
@endsection

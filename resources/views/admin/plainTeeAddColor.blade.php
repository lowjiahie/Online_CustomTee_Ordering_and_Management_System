@extends('layouts.master')

@section('content')
    <div>
        <div style="margin: 0 auto; padding: 10px 10px 10px 10px;">
            <div class="shadow p-3 mb-5 bg-white rounded" style="width:80%; margin: 0 auto;">
                <div class='container'>
                    <form action="{{ route('admin.plainTeeAddColorSubmit') }}" method="POST">
                        @csrf
                        <h1 style="font-size:24px;">Plain Tee Add Color</h1>
                        <div class='row'
                            style='background-color: rgb(200, 197, 197); margin: 10px 10px 10px 10px; padding: 10px 10px 10px 10px;'>
                            <div class='col' style='color:rgb(0, 0, 0);'>
                                Color Name:
                            </div>
                            <div class='col' style='color:rgb(0, 0, 0);'>
                                <input type="text" name="color_name" />
                            </div>
                        </div>

                        <div class='row'
                            style='background-color: white; color:rgb(0, 0, 0); margin: 10px 10px 10px 10px; padding: 20px 10px 20px 10px;'>
                            <div class='col' style='color:rgb(0, 0, 0);'>
                                Color Code:
                            </div>
                            <div class='col' style='color:rgb(0, 0, 0);'>
                                <input type="color" name="color_code" />
                            </div>
                        </div>

                        <div class='row'
                            style='background-color: white; color:rgb(0, 0, 0); margin: 10px 10px 10px 10px; padding: 20px 10px 20px 10px;'>
                            <div class='col' style='color:rgb(0, 0, 0);'>
                                <input type="submit" name="addCancel" value="Add Color"
                                    onclick="return confirm('Are you sure you want to add this color?')"
                                    style="border-style:none; border-radius:5px; color:white; background-color:black; padding:8px 50px;
                                    font-family:'system-ui'; text-transform:uppercase; letter-spacing:.8px; display:block;
                                    margin: 0 auto; box-shadow:2px 2px 5px rgb(0, 0, 0, 0.2); cursor:pointer;" />
                            </div>
                            <div class='col' style='color:rgb(0, 0, 0);'>
                                <input type="submit" name="addCancel" value="Cancel"
                                    style="border-style:none; border-radius:5px; color:white; background-color:black; padding:8px 50px;
                                    font-family:'system-ui'; text-transform:uppercase; letter-spacing:.8px; display:block;
                                    margin: 0 auto; box-shadow:2px 2px 5px rgb(0, 0, 0, 0.2); cursor:pointer;" />
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
@endsection

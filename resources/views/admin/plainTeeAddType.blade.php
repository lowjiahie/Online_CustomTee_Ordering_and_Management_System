@extends('layouts.master')

@section('content')
    <div>
        <div style="margin: 0 auto; padding: 10px 10px 10px 10px;">
            <div class="shadow p-3 mb-5 bg-white rounded" style="width:80%; margin: 0 auto;">
                <div class='container'>
                    <form action="{{ route('admin.plainTeeAddTypeSubmit') }}" method="POST">
                        @csrf
                        <h1 style="font-size:24px;">Plain Tee Add Type</h1>
                        <div class='row'
                            style='background-color: rgb(200, 197, 197); margin: 10px 10px 10px 10px; padding: 10px 10px 10px 10px;'>
                            <div class='col' style='color:rgb(0, 0, 0);'>
                                Type Name:
                            </div>
                            <div class='col' style='color:rgb(0, 0, 0);'>
                                <input type="text" name="name" value="{{ $name }}" />
                            </div>
                        </div>

                        <div class='row'
                            style='background-color: white; color:rgb(0, 0, 0); margin: 10px 10px 10px 10px; padding: 20px 10px 20px 10px;'>
                            <div class='col' style='color:rgb(0, 0, 0);'>
                                Material:
                            </div>
                            <div class='col' style='color:rgb(0, 0, 0);'>
                                <input type="text" name="material" value="{{ $material }}" />
                            </div>
                        </div>

                        <div class='row'
                            style='background-color: rgb(200, 197, 197); margin: 10px 10px 10px 10px; padding: 10px 10px 10px 10px;'>
                            <div class='col' style='color:rgb(0, 0, 0);'>
                                Description:
                            </div>
                            <div class='col' style='color:rgb(0, 0, 0);'>
                                <input type="text" name="description" value="{{ $description }}" />
                            </div>
                        </div>

                        <div class='row'
                            style='background-color: white; color:rgb(0, 0, 0); margin: 10px 10px 10px 10px; padding: 20px 10px 20px 10px;'>
                            <div class='col' style='color:rgb(0, 0, 0);'>
                                Detail:
                            </div>
                            <div class='col' style='color:rgb(0, 0, 0);'>
                                <input type="text" name="detail" value="{{ $detail }}" />
                            </div>
                        </div>

                        <div class='row'
                            style='background-color: rgb(200, 197, 197); margin: 10px 10px 10px 10px; padding: 10px 10px 10px 10px;'>
                            <div class='col' style='color:rgb(0, 0, 0);'>
                                Price(RM):
                            </div>
                            <div class='col' style='color:rgb(0, 0, 0);'>
                                <input type="number" name="price" step="any" value="{{ $price }}" />
                            </div>
                        </div>

                        <div class='row'
                            style='background-color: white; color:rgb(0, 0, 0); margin: 10px 10px 10px 10px; padding: 20px 10px 20px 10px;'>
                            <div class='col' style='color:rgb(0, 0, 0);'>
                                <input type="submit" name="addCancel" value="Add Type"
                                    onclick="return confirm('Are you sure you want to add this type?')"
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

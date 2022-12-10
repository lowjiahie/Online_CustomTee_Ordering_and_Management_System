@extends('layouts.master')

@section('content')
    <div>
        <div>
            <form action="{{ route('admin.competitionAddSubmit') }}" method="POST">
                @csrf
                <div class="shadow p-3 mb-5 bg-white rounded" style="width:80%; height:80%; margin: 0 auto;">
                    <h1>Add Competition</h1>
                    <div class='row'
                        style='background-color: rgb(200, 197, 197); color:rgb(0, 0, 0); margin: 10px 10px 10px 10px; padding: 20px 10px 20px 10px;'>
                        <div class='col' style='color:rgb(0, 0, 0);'>
                            Topic:
                        </div>
                        <div class='col' style='color:rgb(0, 0, 0);'>
                            <input type="text" name="topic"  />
                        </div>
                    </div>
                    <div class='row'
                        style='background-color: white; margin: 10px 10px 10px 10px; padding: 10px 10px 10px 10px;'>
                        <div class='col' style='color:rgb(0, 0, 0);'>
                            Description:
                        </div>
                        <div class='col' style='color:rgb(0, 0, 0);'>
                            <input type="text" name="description" />
                        </div>
                    </div>
                    <div class='row'
                        style='background-color: rgb(200, 197, 197); color:rgb(0, 0, 0); margin: 10px 10px 10px 10px; padding: 20px 10px 20px 10px;'>
                        <div class='col' style='color:rgb(0, 0, 0);'>
                            Rules:
                        </div>
                        <div class='col' style='color:rgb(0, 0, 0);'>
                            <input type="text" name="rules" />
                        </div>
                    </div>
                    <div class='row'
                        style='background-color: white; margin: 10px 10px 10px 10px; padding: 10px 10px 10px 10px;'>
                        <div class='col' style='color:rgb(0, 0, 0);'>
                            Start Date:
                        </div>
                        <div class='col' style='color:rgb(0, 0, 0);'>
                            <input type="datetime-local" name="start_date_time" />
                        </div>
                    </div>
                    <div class='row'
                        style='background-color: rgb(200, 197, 197); color:rgb(0, 0, 0); margin: 10px 10px 10px 10px; padding: 20px 10px 20px 10px;'>
                        <div class='col' style='color:rgb(0, 0, 0);'>
                            End Date:
                        </div>
                        <div class='col' style='color:rgb(0, 0, 0);'>
                            <input type="datetime-local" name="end_date_time" />
                        </div>
                    </div>
                    <div class='row' style='background-color: white; margin: 0 auto; padding: 10px 10px 10px 10px;'>
                        <div class='col' style='color:rgb(0, 0, 0);'>
                            <input type="submit" name="addCancel" value="Add" onclick="return confirm('Are you sure you want to add this data?')"
                            style="border-style:none; border-radius:5px; color:white; background-color:black; padding:8px 50px;
                            font-family:'system-ui'; text-transform:uppercase; letter-spacing:.8px; display:block;
                            margin: 0 auto; box-shadow:2px 2px 5px rgb(0, 0, 0, 0.2); cursor:pointer;" />
                            <input type="hidden" name="staff_id" value="{{ $staffInfo->staff_id }}" />
                        </div>
                        <div class='col' style='color:rgb(0, 0, 0);'>
                            <input type="submit" name="addCancel" value="Cancel"
                            style="border-style:none; border-radius:5px; color:white; background-color:black; padding:8px 50px;
                            font-family:'system-ui'; text-transform:uppercase; letter-spacing:.8px; display:block;
                            margin: 0 auto; box-shadow:2px 2px 5px rgb(0, 0, 0, 0.2); cursor:pointer;" />
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

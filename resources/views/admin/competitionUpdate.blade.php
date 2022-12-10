@extends('layouts.master')

@section('content')
    <div>
        <div>
            <form action="{{ route('admin.competitionDetailUpdate') }}" method="POST">
                @csrf
                <div class="shadow p-3 mb-5 bg-white rounded" style="width:80%; height:80%; margin: 0 auto;">
                    <h1>Competition Update</h1>
                    <div class='row'
                        style='background-color: rgb(200, 197, 197); color:rgb(0, 0, 0); margin: 10px 10px 10px 10px; padding: 20px 10px 20px 10px;'>
                        <div class='col' style='color:rgb(0, 0, 0);'>
                            Competition ID:
                        </div>
                        <div class='col' style='color:rgb(0, 0, 0);'>
                            {{ $competitionUpdate->competition_id }}
                            <input type="hidden" name="competition_id" value="{{ $competitionUpdate->competition_id }}" />
                        </div>
                    </div>
                    <div class='row'
                        style='background-color: white; margin: 10px 10px 10px 10px; padding: 10px 10px 10px 10px;'>
                        <div class='col' style='color:rgb(0, 0, 0);'>
                            Topic:
                        </div>
                        <div class='col' style='color:rgb(0, 0, 0);'>
                            {{ $competitionUpdate->topic }}
                        </div>
                    </div>
                    <div class='row'
                        style='background-color: rgb(200, 197, 197); color:rgb(0, 0, 0); margin: 10px 10px 10px 10px; padding: 20px 10px 20px 10px;'>
                        <div class='col' style='color:rgb(0, 0, 0);'>
                            Description:
                        </div>
                        <div class='col' style='color:rgb(0, 0, 0);'>
                            <input type="text" name="description" value="{{ $competitionUpdate->description }}" />
                        </div>
                    </div>
                    <div class='row'
                        style='background-color: white; margin: 10px 10px 10px 10px; padding: 10px 10px 10px 10px;'>
                        <div class='col' style='color:rgb(0, 0, 0);'>
                            Rules:
                        </div>
                        <div class='col' style='color:rgb(0, 0, 0);'>
                            <input type="text" name="rules" value="{{ $competitionUpdate->rules }}" />
                        </div>
                    </div>
                    <div class='row'
                        style='background-color: rgb(200, 197, 197); color:rgb(0, 0, 0); margin: 10px 10px 10px 10px; padding: 20px 10px 20px 10px;'>
                        <div class='col' style='color:rgb(0, 0, 0);'>
                            Start Date:
                        </div>
                        <div class='col' style='color:rgb(0, 0, 0);'>
                            {{ $competitionUpdate->start_date_time }}
                        </div>
                    </div>
                    <div class='row'
                        style='background-color: white; margin: 10px 10px 10px 10px; padding: 10px 10px 10px 10px;'>
                        <div class='col' style='color:rgb(0, 0, 0);'>
                            End Date:
                        </div>
                        <div class='col' style='color:rgb(0, 0, 0);'>
                            <input type="datetime-local" name="end_date_time" value="{{ $competitionUpdate->end_date_time }}" />
                        </div>
                    </div>
                    <div class='row' style='background-color: white; margin: 0 auto; padding: 10px 10px 10px 10px;'>
                        <div class='col' style='color:rgb(0, 0, 0);'>
                            <input type="submit" name="updateCancel" value="Update" onclick="return confirm('Are you sure you want to update this data?')"
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
                </div>
            </form>
        </div>
    </div>
@endsection

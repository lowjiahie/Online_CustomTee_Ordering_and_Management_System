@extends('layouts.master')

@section('content')
    <div>
        <div>
            <form action="{{ route('admin.competitionDetailFunction') }}" method="POST">
                @csrf
                <div class="shadow p-3 mb-5 bg-white rounded" style="width:80%; height:80%; margin: 0 auto;">
                    <h1>Competition Detail</h1>
                    <div class='row'
                        style='background-color: rgb(200, 197, 197); color:rgb(0, 0, 0); margin: 10px 10px 10px 10px; padding: 20px 10px 20px 10px;'>
                        <div class='col' style='color:rgb(0, 0, 0);'>
                            Competition ID:
                        </div>
                        <div class='col' style='color:rgb(0, 0, 0);'>
                            {{ $competitionDetail->competition_id }}
                        </div>
                        <div class='col' style='color:rgb(0, 0, 0);'>

                        </div>
                    </div>
                    <div class='row'
                        style='background-color: white; margin: 10px 10px 10px 10px; padding: 10px 10px 10px 10px;'>
                        <div class='col' style='color:rgb(0, 0, 0);'>
                            Topic:
                        </div>
                        <div class='col' style='color:rgb(0, 0, 0);'>
                            {{ $competitionDetail->topic }}
                        </div>
                        <div class='col' style='color:rgb(0, 0, 0);'>

                        </div>
                    </div>
                    <div class='row'
                        style='background-color: rgb(200, 197, 197); color:rgb(0, 0, 0); margin: 10px 10px 10px 10px; padding: 20px 10px 20px 10px;'>
                        <div class='col' style='color:rgb(0, 0, 0);'>
                            Description:
                        </div>
                        <div class='col' style='color:rgb(0, 0, 0);'>
                            {{ $competitionDetail->description }}
                        </div>
                        <div class='col' style='color:rgb(0, 0, 0);'>

                        </div>
                    </div>
                    <div class='row'
                        style='background-color: white; margin: 10px 10px 10px 10px; padding: 10px 10px 10px 10px;'>
                        <div class='col' style='color:rgb(0, 0, 0);'>
                            Rules:
                        </div>
                        <div class='col' style='color:rgb(0, 0, 0);'>
                            {{ $competitionDetail->rules }}
                        </div>
                        <div class='col' style='color:rgb(0, 0, 0);'>

                        </div>
                    </div>
                    <div class='row'
                        style='background-color: rgb(200, 197, 197); color:rgb(0, 0, 0); margin: 10px 10px 10px 10px; padding: 20px 10px 20px 10px;'>
                        <div class='col' style='color:rgb(0, 0, 0);'>
                            Start Date:
                        </div>
                        <div class='col' style='color:rgb(0, 0, 0);'>
                            {{ $competitionDetail->start_date_time }}
                        </div>
                        <div class='col' style='color:rgb(0, 0, 0);'>

                        </div>
                    </div>
                    <div class='row'
                        style='background-color: white; margin: 10px 10px 10px 10px; padding: 10px 10px 10px 10px;'>
                        <div class='col' style='color:rgb(0, 0, 0);'>
                            End Date:
                        </div>
                        <div class='col' style='color:rgb(0, 0, 0);'>
                            {{ $competitionDetail->end_date_time }}
                        </div>
                        <div class='col' style='color:rgb(0, 0, 0);'>

                        </div>
                    </div>
                    <div class='row'
                        style='background-color: rgb(200, 197, 197); color:rgb(0, 0, 0); margin: 10px 10px 10px 10px; padding: 20px 10px 20px 10px;'>
                        <div class='col' style='color:rgb(0, 0, 0);'>
                            Created By:
                        </div>
                        <div class='col' style='color:rgb(0, 0, 0);'>
                            {{ $staffName->name }}
                        </div>
                        <div class='col' style='color:rgb(0, 0, 0);'>

                        </div>
                    </div>
                    @if($competitionDetail->winner != null)
                    <div class='row'
                        style='background-color: white; margin: 10px 10px 10px 10px; padding: 10px 10px 10px 10px;'>
                        <div class='col' style='color:rgb(0, 0, 0);'>
                            Winner:
                        </div>
                        <div class='col' style='color:rgb(0, 0, 0);'>
                            {{ $competitionDetail->winner }}
                        </div>
                        <div class='col' style='color:rgb(0, 0, 0);'>

                        </div>
                    </div>
                    @endif

                    @if ($competitionDetail->winner == null)
                    <div class='row' style='background-color: white; margin: 0 auto; padding: 10px 10px 10px 10px;'>
                        <div class='col' style='color:rgb(0, 0, 0);'>
                            <input type="submit" name="competitionFunction" value="View Participant"
                            style="border-style:none; border-radius:5px; color:white; background-color:black; padding:8px 50px;
                            font-family:'system-ui'; text-transform:uppercase; letter-spacing:.8px; display:block;
                            margin: 0 auto; box-shadow:2px 2px 5px rgb(0, 0, 0, 0.2); cursor:pointer;" />
                            <input type="hidden" name="competition_id" value="{{ $competitionDetail->competition_id }}" />
                        </div>
                        <div class='col' style='color:rgb(0, 0, 0);'>
                            <input type="submit" name="competitionFunction" value="Announce Winner"
                            style="border-style:none; border-radius:5px; color:white; background-color:black; padding:8px 50px;
                            font-family:'system-ui'; text-transform:uppercase; letter-spacing:.8px; display:block;
                            margin: 0 auto; box-shadow:2px 2px 5px rgb(0, 0, 0, 0.2); cursor:pointer;" />
                        </div>
                        <div class='col' style='color:rgb(0, 0, 0);'>
                            <input type="submit" name="competitionFunction" value="Update"
                            style="border-style:none; border-radius:5px; color:white; background-color:black; padding:8px 50px;
                            font-family:'system-ui'; text-transform:uppercase; letter-spacing:.8px; display:block;
                            margin: 0 auto; box-shadow:2px 2px 5px rgb(0, 0, 0, 0.2); cursor:pointer;" />
                        </div>
                    </div>
                    <div class='row' style='background-color: white; margin: 0 auto; padding: 10px 10px 10px 10px;'>
                        <div class='col' style='color:rgb(0, 0, 0);'>
                            <input type="submit" name="competitionFunction" value="Delete" onclick="return confirm('Are you sure you want to delete this data?')"
                            style="border-style:none; border-radius:5px; color:white; background-color:black; padding:8px 50px;
                            font-family:'system-ui'; text-transform:uppercase; letter-spacing:.8px; display:block;
                            margin: 0 auto; box-shadow:2px 2px 5px rgb(0, 0, 0, 0.2); cursor:pointer;" />
                        </div>
                        <div class='col' style='color:rgb(0, 0, 0);'>
                            <input type="submit" name="competitionFunction" value="Cancel"
                            style="border-style:none; border-radius:5px; color:white; background-color:black; padding:8px 50px;
                            font-family:'system-ui'; text-transform:uppercase; letter-spacing:.8px; display:block;
                            margin: 0 auto; box-shadow:2px 2px 5px rgb(0, 0, 0, 0.2); cursor:pointer;" />
                        </div>
                    </div>
                    @else
                    <div class='row' style='background-color: white; margin: 0 auto; padding: 10px 10px 10px 10px;'>
                        <div class='col' style='color:rgb(0, 0, 0);'>
                            <input type="submit" name="competitionFunction" value="View Participant"
                            style="border-style:none; border-radius:5px; color:white; background-color:black; padding:8px 50px;
                            font-family:'system-ui'; text-transform:uppercase; letter-spacing:.8px; display:block;
                            margin: 0 auto; box-shadow:2px 2px 5px rgb(0, 0, 0, 0.2); cursor:pointer;" />
                            <input type="hidden" name="competition_id" value="{{ $competitionDetail->competition_id }}" />
                        </div>
                        <div class='col' style='color:rgb(0, 0, 0);'>
                            <input type="submit" name="competitionFunction" value="Update"
                            style="border-style:none; border-radius:5px; color:white; background-color:black; padding:8px 50px;
                            font-family:'system-ui'; text-transform:uppercase; letter-spacing:.8px; display:block;
                            margin: 0 auto; box-shadow:2px 2px 5px rgb(0, 0, 0, 0.2); cursor:pointer;" />
                        </div>
                        <div class='col' style='color:rgb(0, 0, 0);'>
                            <input type="submit" name="competitionFunction" value="Delete" onclick="return confirm('Are you sure you want to delete this data?')"
                            style="border-style:none; border-radius:5px; color:white; background-color:black; padding:8px 50px;
                            font-family:'system-ui'; text-transform:uppercase; letter-spacing:.8px; display:block;
                            margin: 0 auto; box-shadow:2px 2px 5px rgb(0, 0, 0, 0.2); cursor:pointer;" />
                        </div>
                        <div class='col' style='color:rgb(0, 0, 0);'>
                            <input type="submit" name="competitionFunction" value="Cancel"
                            style="border-style:none; border-radius:5px; color:white; background-color:black; padding:8px 50px;
                            font-family:'system-ui'; text-transform:uppercase; letter-spacing:.8px; display:block;
                            margin: 0 auto; box-shadow:2px 2px 5px rgb(0, 0, 0, 0.2); cursor:pointer;" />
                        </div>
                    </div>
                    @endif
                </div>
            </form>
        </div>
    </div>
@endsection

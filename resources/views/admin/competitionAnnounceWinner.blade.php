@extends('layouts.master')

@section('content')
    <div>
        <div>
            <form action="{{ route('admin.competitionAnnounceWinner') }}" method="POST">
                @csrf
                <div class="shadow p-3 mb-5 bg-white rounded" style="width:80%; height:80%; margin: 0 auto;">
                    <h1>Announce Winner</h1>
                    <div class='row'
                        style='background-color: rgb(200, 197, 197); color:rgb(0, 0, 0); margin: 10px 10px 10px 10px; padding: 20px 10px 20px 10px;'>
                        <div class='col' style='color:rgb(0, 0, 0);'>
                            Competition ID:
                        </div>
                        <div class='col' style='color:rgb(0, 0, 0);'>
                            {{ $competitionDetail->competition_id }}
                            <input type="hidden" name="competition_id" value="{{ $competitionDetail->competition_id }}" />
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
                    </div>
                    <div class='row'
                        style='background-color: rgb(200, 197, 197); margin: 10px 10px 10px 10px; padding: 10px 10px 10px 10px;'>
                        <div class='col' style='color:rgb(0, 0, 0);'>
                            Select Winner:
                        </div>
                        <div class='col' style='color:rgb(0, 0, 0);'>
                            <select name="cus_id">
                                @foreach ($competitionUpdate as $competition)
                                    <option value="{{ $competition->cus_id }}">{{ $competition->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class='row'
                        style='background-color: white; color:rgb(0, 0, 0); margin: 10px 10px 10px 10px; padding: 20px 10px 20px 10px;'>
                        <div class='col'>
                            <input type="submit" name="selectWinnerCancel" value="Select As Winner"
                                onclick="return confirm('Are you sure you want to select this participant as winner?')"
                                style="border-style:none; border-radius:5px; color:white; background-color:black; padding:8px 50px;
                                font-family:'system-ui'; text-transform:uppercase; letter-spacing:.8px; display:block;
                                margin: 0 auto; box-shadow:2px 2px 5px rgb(0, 0, 0, 0.2); cursor:pointer;" />
                        </div>
                        <div class='col'>
                            <input type="submit" name="selectWinnerCancel" value="Cancel"
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

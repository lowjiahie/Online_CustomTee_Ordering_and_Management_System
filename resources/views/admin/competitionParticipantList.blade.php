@extends('layouts.master')

@section('content')
    <div>
        <div style="margin: 0 auto; padding: 10px 10px 10px 10px;">
            <div>
                <h1 style="float: left; font-size:24px; margin-left: 10%;">Competition List</h1>
                <form action="{{ route('admin.participantSearch') }}" method="POST">
                    @csrf
                    <input type="submit" name="search" value="Search"
                        style="float: right; border-style:none; border-radius:5px; color:white; background-color:black; padding:8px 50px;
                        font-family:'system-ui'; text-transform:uppercase; letter-spacing:.8px; display:block;
                        margin-right:10%; box-shadow:2px 2px 5px rgb(0, 0, 0, 0.2); cursor:pointer;" />
                    <input type="text" name="searchParticipant" placeholder="Search customer name" style="width:35%; float: right; margin-right:2%;"; />
                </form>
            </div>
            <br /><br />
            <div class="shadow p-3 mb-5 bg-white rounded" style="width:80%; margin: 0 auto;">
                <div class='container'>
                    <?php $rowColor = 1; ?>

                    <div class='row' style='background-color: rgb(200, 197, 197); margin: 10px 10px 10px 10px; padding: 20px 10px 20px 10px;'>
                        <div class='col'>
                            <a href='#' style='color:rgb(0, 0, 0); text-decoration:none; background-color:none;'>Participant ID</a>
                        </div>
                        <div class='col'>
                            <a href='#' style='color:rgb(0, 0, 0); text-decoration:none; background-color:none;'>Participant Name</a>
                        </div>
                        <div class='col'>
                            <a href='#' style='color:rgb(0, 0, 0); text-decoration:none; background-color:none;'>Status</a>
                        </div>
                        <div class='col'>
                            <a href='#' style='color:rgb(0, 0, 0); text-decoration:none; background-color:none;'>Front Design</a>
                        </div>
                        <div class='col'>
                            <a href='#' style='color:rgb(0, 0, 0); text-decoration:none; background-color:none;'>Back Design</a>
                        </div>
                    </div>

                    @foreach ($participantList as $participant)
                        @if ($rowColor == 1)
                            <div class='row'
                                style='background-color: white; margin: 10px 10px 10px 10px; padding: 10px 10px 10px 10px;'>
                                <div class='col' style='color:rgb(0, 0, 0);'>
                                    {{ $participant->cus_id }}
                                </div>
                                <div class='col' style='color:rgb(0, 0, 0);'>
                                    {{ $participant->name }}
                                </div>
                                <div class='col' style='color:rgb(0, 0, 0);'>
                                    {{ $participant->status }}
                                </div>
                                <div class='col' style='color:rgb(0, 0, 0);'>
                                    <img src="{{ asset("competition/$participant->front_design_img") }}" alt="Front Design" width="150" height="150"
                                    style="display: block; margin: 0 auto;" />
                                </div>
                                <div class='col' style='color:rgb(0, 0, 0);'>
                                    <img src="{{ asset("competition/$participant->back_design_img") }}" alt="Back Design" width="150" height="150"
                                    style="display: block; margin: 0 auto;" />
                                </div>
                            </div>
                            <?php $rowColor = 0; ?>
                        @else
                            <div class='row'
                                style='background-color: rgb(200, 197, 197); color:rgb(0, 0, 0); margin: 10px 10px 10px 10px; padding: 20px 10px 20px 10px;'>
                                <div class='col' style='color:rgb(0, 0, 0);'>
                                    {{ $participant->cus_id }}
                                </div>
                                <div class='col' style='color:rgb(0, 0, 0);'>
                                    {{ $participant->name }}
                                </div>
                                <div class='col' style='color:rgb(0, 0, 0);'>
                                    {{ $participant->status }}
                                </div>
                                <div class='col' style='color:rgb(0, 0, 0);'>
                                    <img src="{{ asset("competition/$participant->front_design_img") }}" alt="Front Design" width="150" height="150"
                                    style="display: block; margin: 0 auto;" />
                                </div>
                                <div class='col' style='color:rgb(0, 0, 0);'>
                                    <img src="{{ asset("competition/$participant->back_design_img") }}" alt="Back Design" width="150" height="150"
                                    style="display: block; margin: 0 auto;" />
                                </div>
                            </div>
                            <?php $rowColor = 1; ?>
                        @endif
                    @endforeach
                    <form action="{{ route('admin.participantFunction') }}" method="POST">
                        @csrf
                        <div class='row' style='background-color: white; margin: 0 auto; padding: 10px 10px 10px 10px;'>
                            <div class='col' style='color:rgb(0, 0, 0);'>
                                <input type="submit" name="participantFunction" value="Back"
                                style="border-style:none; border-radius:5px; color:white; background-color:black; padding:8px 50px;
                                font-family:'system-ui'; text-transform:uppercase; letter-spacing:.8px; display:block;
                                margin: 0 auto; box-shadow:2px 2px 5px rgb(0, 0, 0, 0.2); cursor:pointer;" />
                                <input type="hidden" name="competition_id" value="{{ $participant->competition_id }}" />
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

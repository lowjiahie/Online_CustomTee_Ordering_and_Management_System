@extends('layouts.master')

@section('content')
    <div>
        <div>
            <form action="{{ route('admin.designDetailFunction') }}" method="POST">
                @csrf
                <div class="shadow p-3 mb-5 bg-white rounded" style="width:80%; height:80%; margin: 0 auto;">
                    <h1>Published Design Detail</h1>
                    <div class='row'
                        style='background-color: white; color:rgb(0, 0, 0); margin: 10px 10px 10px 10px; padding: 20px 10px 20px 10px;'>
                        <div class='col' style='color:rgb(0, 0, 0); margin: 0 auto;'>
                            <img src="{{ asset('image/published_design/'.$designDetail->front_design_img) }}" alt="Front Design" width="200" height="200"
                            style="display: block; margin-left: 25%; float: left;" />
                            <img src="{{ asset('image/published_design/'.$designDetail->back_design_img) }}" alt="Back Design" width="200" height="200"
                            style="display: block; margin-right: 25%; float: right;" />
                        </div>
                    </div>
                    <div class='row'
                        style='background-color: rgb(200, 197, 197); color:rgb(0, 0, 0); margin: 10px 10px 10px 10px; padding: 20px 10px 20px 10px;'>
                        <div class='col' style='color:rgb(0, 0, 0);'>
                            Published Design ID:
                        </div>
                        <div class='col' style='color:rgb(0, 0, 0);'>
                            {{ $designDetail->p_design_id }}
                        </div>
                    </div>
                    <div class='row'
                        style='background-color: white; margin: 10px 10px 10px 10px; padding: 10px 10px 10px 10px;'>
                        <div class='col' style='color:rgb(0, 0, 0);'>
                            Customer Name:
                        </div>
                        <div class='col' style='color:rgb(0, 0, 0);'>
                            {{ $cusInfo->name }}
                        </div>
                    </div>
                    <div class='row'
                        style='background-color: rgb(200, 197, 197); color:rgb(0, 0, 0); margin: 10px 10px 10px 10px; padding: 20px 10px 20px 10px;'>
                        <div class='col' style='color:rgb(0, 0, 0);'>
                            Design Name:
                        </div>
                        <div class='col' style='color:rgb(0, 0, 0);'>
                            {{ $designDetail->name }}
                        </div>
                    </div>
                    <div class='row'
                        style='background-color: white; margin: 10px 10px 10px 10px; padding: 10px 10px 10px 10px;'>
                        <div class='col' style='color:rgb(0, 0, 0);'>
                            Description:
                        </div>
                        <div class='col' style='color:rgb(0, 0, 0);'>
                            {{ $designDetail->description }}
                        </div>
                    </div>
                    <div class='row'
                        style='background-color: rgb(200, 197, 197); color:rgb(0, 0, 0); margin: 10px 10px 10px 10px; padding: 20px 10px 20px 10px;'>
                        <div class='col' style='color:rgb(0, 0, 0);'>
                            Price:
                        </div>
                        <div class='col' style='color:rgb(0, 0, 0);'>
                            {{ $designDetail->price }}
                        </div>
                    </div>
                    <div class='row'
                        style='background-color: white; margin: 10px 10px 10px 10px; padding: 10px 10px 10px 10px;'>
                        <div class='col' style='color:rgb(0, 0, 0);'>
                            Published Design Status:
                        </div>
                        <div class='col' style='color:rgb(0, 0, 0);'>
                            {{ $designDetail->status }}
                        </div>
                    </div>
                    <div class='row'
                        style='background-color: rgb(200, 197, 197); color:rgb(0, 0, 0); margin: 10px 10px 10px 10px; padding: 20px 10px 20px 10px;'>
                        <div class='col' style='color:rgb(0, 0, 0);'>
                            Published Design Type:
                        </div>
                        <div class='col' style='color:rgb(0, 0, 0);'>
                            {{ $designDetail->type }}
                        </div>
                    </div>
                    @if($designDetail->status == "Banned")
                    <div class='row'
                        style='background-color: white; margin: 10px 10px 10px 10px; padding: 10px 10px 10px 10px;'>
                        <div class='col' style='color:rgb(0, 0, 0);'>
                            Reason Banned:
                        </div>
                        <div class='col' style='color:rgb(0, 0, 0);'>
                            {{ $designDetail->reason_banned_denied }}
                        </div>
                    </div>
                    @endif
                    <div class='row' style='background-color: white; margin: 0 auto; padding: 10px 10px 10px 10px;'>
                        <div class='col' style='color:rgb(0, 0, 0);'>
                            <input type="submit" name="updateCancel" value="Update Status"
                            style="border-style:none; border-radius:5px; color:white; background-color:black; padding:8px 50px;
                            font-family:'system-ui'; text-transform:uppercase; letter-spacing:.8px; display:block;
                            margin: 0 auto; box-shadow:2px 2px 5px rgb(0, 0, 0, 0.2); cursor:pointer;" />
                            <input type="hidden" name="designID" value="{{ $designDetail->p_design_id }}" />
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

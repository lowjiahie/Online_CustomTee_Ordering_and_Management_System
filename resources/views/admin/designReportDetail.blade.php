@extends('layouts.master')

@section('content')
    <div>
        <div>
            <form action="{{ route('admin.designReportDetailFunction') }}" method="POST">
                @csrf
                <div class="shadow p-3 mb-5 bg-white rounded" style="width:80%; height:80%; margin: 0 auto;">
                    <h1>Published Design Report Detail</h1>
                    <div class='row'
                        style='background-color: rgb(200, 197, 197); color:rgb(0, 0, 0); margin: 10px 10px 10px 10px; padding: 20px 10px 20px 10px;'>
                        <div class='col' style='color:rgb(0, 0, 0);'>
                            Published Design Report ID:
                        </div>
                        <div class='col' style='color:rgb(0, 0, 0);'>
                            {{ $designReportDetail->p_design_report_id }}
                        </div>
                    </div>
                    <div class='row'
                        style='background-color: white; margin: 10px 10px 10px 10px; padding: 10px 10px 10px 10px;'>
                        <div class='col' style='color:rgb(0, 0, 0);'>
                            Title:
                        </div>
                        <div class='col' style='color:rgb(0, 0, 0);'>
                            {{ $designReportDetail->title }}
                        </div>
                    </div>
                    <div class='row'
                        style='background-color: rgb(200, 197, 197); margin: 10px 10px 10px 10px; padding: 10px 10px 10px 10px;'>
                        <div class='col' style='color:rgb(0, 0, 0);'>
                            Description:
                        </div>
                        <div class='col' style='color:rgb(0, 0, 0);'>
                            {{ $designReportDetail->description }}
                        </div>
                    </div>
                    <div class='row'
                        style='background-color: white; color:rgb(0, 0, 0); margin: 10px 10px 10px 10px; padding: 20px 10px 20px 10px;'>
                        <div class='col' style='color:rgb(0, 0, 0);'>
                            Reported By:
                        </div>
                        <div class='col' style='color:rgb(0, 0, 0);'>
                            {{ $reportBy->name }}
                        </div>
                    </div>
                    <div class='row'
                        style='background-color: rgb(200, 197, 197); margin: 10px 10px 10px 10px; padding: 10px 10px 10px 10px;'>
                        <div class='col' style='color:rgb(0, 0, 0);'>
                            Published Design ID:
                        </div>
                        <div class='col' style='color:rgb(0, 0, 0);'>
                            {{ $designReportDetail->p_design_id }}
                        </div>
                    </div>
                    <div class='row' style='background-color: white; margin: 0 auto; padding: 10px 10px 10px 10px;'>
                        <div class='col' style='color:rgb(0, 0, 0);'>
                            <input type="submit" name="viewCancel" value="View Published Design"
                            style="border-style:none; border-radius:5px; color:white; background-color:black; padding:8px 50px;
                            font-family:'system-ui'; text-transform:uppercase; letter-spacing:.8px; display:block;
                            margin: 0 auto; box-shadow:2px 2px 5px rgb(0, 0, 0, 0.2); cursor:pointer;" />
                            <input type="hidden" name="designID" value="{{ $designReportDetail->p_design_report_id }}" />
                        </div>
                        <div class='col' style='color:rgb(0, 0, 0);'>
                            <input type="submit" name="viewCancel" value="Cancel"
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

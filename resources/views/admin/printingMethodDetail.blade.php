@extends('layouts.master')

@section('content')
    <div>
        <div>
            <form action="{{ route('admin.printingMethodDetailFunction') }}" method="POST">
                @csrf
                <div class="shadow p-3 mb-5 bg-white rounded" style="width:80%; height:80%; margin: 0 auto;">
                    <h1>Printing Method Detail</h1>
                    <div class='row'
                        style='background-color: rgb(200, 197, 197); color:rgb(0, 0, 0); margin: 10px 10px 10px 10px; padding: 20px 10px 20px 10px;'>
                        <div class='col' style='color:rgb(0, 0, 0);'>
                            Printing Method ID:
                        </div>
                        <div class='col' style='color:rgb(0, 0, 0);'>
                            {{ $printingMethodDetail->p_method_id }}
                        </div>
                        <div class='col' style='color:rgb(0, 0, 0);'>

                        </div>
                    </div>
                    <div class='row'
                        style='background-color: white; margin: 10px 10px 10px 10px; padding: 10px 10px 10px 10px;'>
                        <div class='col' style='color:rgb(0, 0, 0);'>
                            Printing Method Name:
                        </div>
                        <div class='col' style='color:rgb(0, 0, 0);'>
                            {{ $printingMethodDetail->name }}
                        </div>
                        <div class='col' style='color:rgb(0, 0, 0);'>

                        </div>
                    </div>
                    <div class='row'
                        style='background-color: rgb(200, 197, 197); color:rgb(0, 0, 0); margin: 10px 10px 10px 10px; padding: 20px 10px 20px 10px;'>
                        <div class='col' style='color:rgb(0, 0, 0);'>
                            Price(RM):
                        </div>
                        <div class='col' style='color:rgb(0, 0, 0);'>
                            {{ $printingMethodDetail->price }}
                        </div>
                        <div class='col' style='color:rgb(0, 0, 0);'>

                        </div>
                    </div>
                    <div class='row'
                        style='background-color: white; margin: 10px 10px 10px 10px; padding: 10px 10px 10px 10px;'>
                        <div class='col' style='color:rgb(0, 0, 0);'>
                            Minimum Order:
                        </div>
                        <div class='col' style='color:rgb(0, 0, 0);'>
                            {{ $printingMethodDetail->minimum_order }}
                        </div>
                        <div class='col' style='color:rgb(0, 0, 0);'>

                        </div>
                    </div>
                    <div class='row'
                        style='background-color: rgb(200, 197, 197); color:rgb(0, 0, 0); margin: 10px 10px 10px 10px; padding: 20px 10px 20px 10px;'>
                        <div class='col' style='color:rgb(0, 0, 0);'>
                            Printing Method Status:
                        </div>
                        <div class='col' style='color:rgb(0, 0, 0);'>
                            {{ $printingMethodDetail->status }}
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
                            <input type="hidden" name="printingMethodID" value="{{ $printingMethodDetail->p_method_id }}" />
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
                </div>
            </form>
        </div>
    </div>
@endsection

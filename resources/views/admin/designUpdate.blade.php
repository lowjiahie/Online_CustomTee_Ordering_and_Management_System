@extends('layouts.master')

@section('content')
    <div>
        <div>
            <form action="{{ route('admin.designDetailUpdate') }}" method="POST">
                @csrf
                <div class="shadow p-3 mb-5 bg-white rounded" style="width:80%; height:80%; margin: 0 auto;">
                    <h1>Published Design update</h1>
                    <div class='row'
                        style='background-color: white; color:rgb(0, 0, 0); margin: 10px 10px 10px 10px; padding: 20px 10px 20px 10px;'>
                        <div class='col' style='color:rgb(0, 0, 0); margin: 0 auto;'>
                            <img src="{{ asset('image/published_design/'.$designUpdate->front_design_img) }}" alt="Front Design" width="200" height="200"
                            style="display: block; margin-left: 25%; float: left;" />
                            <img src="{{ asset('image/published_design/'.$designUpdate->back_design_img) }}" alt="Back Design" width="200" height="200"
                            style="display: block; margin-right: 25%; float: right;" />
                        </div>
                    </div>
                    <div class='row'
                        style='background-color: rgb(200, 197, 197); color:rgb(0, 0, 0); margin: 10px 10px 10px 10px; padding: 20px 10px 20px 10px;'>
                        <div class='col' style='color:rgb(0, 0, 0);'>
                            Published Design ID:
                        </div>
                        <div class='col' style='color:rgb(0, 0, 0);'>
                            {{ $designUpdate->p_design_id }}
                            <input type="hidden" name="p_design_id" value="{{ $designUpdate->p_design_id }}" />
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
                            {{ $designUpdate->name }}
                        </div>
                    </div>
                    <div class='row'
                        style='background-color: white; margin: 10px 10px 10px 10px; padding: 10px 10px 10px 10px;'>
                        <div class='col' style='color:rgb(0, 0, 0);'>
                            Description:
                        </div>
                        <div class='col' style='color:rgb(0, 0, 0);'>
                            {{ $designUpdate->description }}
                        </div>
                    </div>
                    <div class='row'
                        style='background-color: rgb(200, 197, 197); color:rgb(0, 0, 0); margin: 10px 10px 10px 10px; padding: 20px 10px 20px 10px;'>
                        <div class='col' style='color:rgb(0, 0, 0);'>
                            Price:
                        </div>
                        <div class='col' style='color:rgb(0, 0, 0);'>
                            {{ $designUpdate->price }}
                        </div>
                    </div>
                    <div class='row'
                        style='background-color: white; margin: 10px 10px 10px 10px; padding: 10px 10px 10px 10px;'>
                        <div class='col' style='color:rgb(0, 0, 0);'>
                            Published Design Status:
                        </div>
                        <div class='col' style='color:rgb(0, 0, 0);'>
                            @if ($designUpdate->status == "Published")
                            <select name="status">
                                <option value="Published" selected="selected">Published</option>
                                <option value="Banned">Banned</option>
                            </select>
                            @elseif ($designUpdate->status == "Banned")
                            <select name="status">
                                <option value="Published">Published</option>
                                <option value="Banned" selected="selected">Banned</option>
                            </select>
                            @else
                            <select name="status">
                                <option value="Published">Published</option>
                                <option value="Banned">Banned</option>
                            </select>
                            @endif
                        </div>
                    </div>
                    <div class='row'
                        style='background-color: rgb(200, 197, 197); color:rgb(0, 0, 0); margin: 10px 10px 10px 10px; padding: 20px 10px 20px 10px;'>
                        <div class='col' style='color:rgb(0, 0, 0);'>
                            Published Design Type:
                        </div>
                        <div class='col' style='color:rgb(0, 0, 0);'>
                            {{ $designUpdate->type }}
                        </div>
                    </div>
                    <div class='row'
                        style='background-color: white; margin: 10px 10px 10px 10px; padding: 10px 10px 10px 10px;'>
                        <div class='col' style='color:rgb(0, 0, 0);'>
                            Reason Banned:
                        </div>
                        <div class='col' style='color:rgb(0, 0, 0);'>
                            <input type="text" name="reason_banned_denied" placeholder="Fill in here if the design is banned." />
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

@extends('layouts.master')

@section('content')
    <div>
        <div style="margin: 0 auto; padding: 10px 10px 10px 10px;">
            <div class="shadow p-3 mb-5 bg-white rounded" style="width:80%; margin: 0 auto;">
                <div class='container'>
                    <form action="{{ route('admin.plainTeeAddTypeColorSubmit') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <h1 style="font-size:24px;">Plain Tee Add Type Color</h1>
                        <div class='row'
                            style='background-color: rgb(200, 197, 197); margin: 10px 10px 10px 10px; padding: 10px 10px 10px 10px;'>
                            <div class='col' style='color:rgb(0, 0, 0);'>
                                Type Color Image:
                            </div>
                            <div class='col' style='color:rgb(0, 0, 0);'>
                                <input type="file" name="plain_tee_img" accept="image/jpg, image/png" />
                            </div>
                        </div>

                        <div class='row'
                            style='background-color: white; color:rgb(0, 0, 0); margin: 10px 10px 10px 10px; padding: 20px 10px 20px 10px;'>
                            <div class='col' style='color:rgb(0, 0, 0);'>
                                Color:
                            </div>
                            <div class='col' style='color:rgb(0, 0, 0);'>
                                <select name="color_id">
                                    @foreach ($allColor as $color)
                                    @if($color_id == $color->color_id)
                                    <option value="{{ $color->color_id }}" selected="selected">{{ $color->color_name }}</option>
                                    @else
                                    <option value="{{ $color->color_id }}">{{ $color->color_name }}</option>
                                    @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class='row'
                            style='background-color: rgb(200, 197, 197); margin: 10px 10px 10px 10px; padding: 10px 10px 10px 10px;'>
                            <div class='col' style='color:rgb(0, 0, 0);'>
                                Type:
                            </div>
                            <div class='col' style='color:rgb(0, 0, 0);'>
                                <select name="type_id">
                                @foreach ($allType as $type)
                                @if($type_id == $type->type_id)
                                <option value="{{ $type->type_id }}" selected="selected">{{ $type->name }} {{ $type->detail }}</option>
                                @else
                                <option value="{{ $type->type_id }}">{{ $type->name }} {{ $type->detail }}</option>
                                @endif
                                @endforeach
                                </select>
                            </div>
                        </div>

                        <div class='row'
                            style='background-color: white; color:rgb(0, 0, 0); margin: 10px 10px 10px 10px; padding: 20px 10px 20px 10px;'>
                            <div class='col' style='color:rgb(0, 0, 0);'>
                                <input type="submit" name="addCancel" value="Add Type Color"
                                    onclick="return confirm('Are you sure you want to add this shirt?')"
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

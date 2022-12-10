@extends('layouts.master')

@section('content')
    <div>
        <div style="margin: 0 auto; padding: 10px 10px 10px 10px;">
            <div class="shadow p-3 mb-5 bg-white rounded" style="width:80%; margin: 0 auto;">
                <div class='container'>
                    <form action="{{ route('admin.plainTeeDetailUpdate') }}" method="POST">
                        @csrf
                        <h1 style="font-size:24px;">Plain Tee Update Shirt</h1>
                        <div class='row'
                            style='background-color: rgb(200, 197, 197); margin: 10px 10px 10px 10px; padding: 10px 10px 10px 10px;'>
                            <div class='col' style='color:rgb(0, 0, 0);'>
                                Plain Tee ID:
                            </div>
                            <div class='col' style='color:rgb(0, 0, 0);'>
                                {{ $plainTeeUpdate->plain_tee_size_id }}
                                <input type="hidden" name="plain_tee_size_id" value="{{ $plainTeeUpdate->plain_tee_size_id }}" />
                            </div>
                        </div>

                        <div class='row'
                            style='background-color: white; margin: 10px 10px 10px 10px; padding: 10px 10px 10px 10px;'>
                            <div class='col' style='color:rgb(0, 0, 0);'>
                                Stocks:
                            </div>
                            <div class='col' style='color:rgb(0, 0, 0);'>
                                <input type="number" name="stocks" value="{{ $plainTeeUpdate->stocks }}" />
                            </div>
                        </div>

                        <div class='row'
                            style='background-color: rgb(200, 197, 197); color:rgb(0, 0, 0); margin: 10px 10px 10px 10px; padding: 20px 10px 20px 10px;'>
                            <div class='col' style='color:rgb(0, 0, 0);'>
                                Size Name:
                            </div>
                            <div class='col' style='color:rgb(0, 0, 0);'>
                                <select name="size_name">
                                    @if($plainTeeUpdate->size_name == 'xs')
                                    <option value="XS" selected="selected">XS</option>
                                    <option value="S">S</option>
                                    <option value="M">M</option>
                                    <option value="L">L</option>
                                    <option value="XL">XL</option>
                                    @elseif($plainTeeUpdate->size_name == 's')
                                    <option value="XS">XS</option>
                                    <option value="S" selected="selected">S</option>
                                    <option value="M">M</option>
                                    <option value="L">L</option>
                                    <option value="XL">XL</option>
                                    @elseif($plainTeeUpdate->size_name == 'm')
                                    <option value="XS">XS</option>
                                    <option value="S">S</option>
                                    <option value="M" selected="selected">M</option>
                                    <option value="L">L</option>
                                    <option value="XL">XL</option>
                                    @elseif($plainTeeUpdate->size_name == 'l')
                                    <option value="XS">XS</option>
                                    <option value="S">S</option>
                                    <option value="M">M</option>
                                    <option value="L" selected="selected">L</option>
                                    <option value="XL">XL</option>
                                    @elseif($plainTeeUpdate->size_name == 'xl')
                                    <option value="XS">XS</option>
                                    <option value="S">S</option>
                                    <option value="M">M</option>
                                    <option value="L">L</option>
                                    <option value="XL" selected="selected">XL</option>
                                    @else
                                    <option value="XS" selected="selected">XS</option>
                                    <option value="S">S</option>
                                    <option value="M">M</option>
                                    <option value="L">L</option>
                                    <option value="XL">XL</option>
                                    @endif
                                </select>
                            </div>
                        </div>

                        <div class='row'
                            style='background-color: white; margin: 10px 10px 10px 10px; padding: 10px 10px 10px 10px;'>
                            <div class='col' style='color:rgb(0, 0, 0);'>
                                Type Color:
                            </div>
                            <div class='col' style='color:rgb(0, 0, 0);'>
                                <select name="pt_type_color_id">
                                @foreach ($allTypeColor as $typeColor)
                                    @if($plainTeeUpdate->pt_type_color_id == $typeColor->pt_type_color_id)
                                    <option value="{{ $typeColor->pt_type_color_id }}" selected="selected">{{ $typeColor->color_name }} {{ $typeColor->name }} {{ $typeColor->detail }}</option>
                                    @else
                                    <option value="{{ $typeColor->pt_type_color_id }}">{{ $typeColor->color_name }} {{ $typeColor->name }} {{ $typeColor->detail }}</option>
                                    @endif
                                @endforeach
                                </select>
                            </div>
                        </div>

                        <div class='row'
                            style='background-color: white; color:rgb(0, 0, 0); margin: 10px 10px 10px 10px; padding: 20px 10px 20px 10px;'>
                            <div class='col' style='color:rgb(0, 0, 0);'>
                                <input type="submit" name="updateCancel" value="Update"
                                    onclick="return confirm('Are you sure you want to update this shirt?')"
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
                    </form>
                </div>
            </div>
        </div>

    </div>
@endsection

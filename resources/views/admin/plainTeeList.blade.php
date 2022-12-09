@extends('layouts.master')

@section('content')
    <div>
        <div style="margin: 0 auto; padding: 10px 10px 10px 10px;">
            <div>
                <h1 style="float: left; font-size:24px; margin-left: 10%;">Plain Tee List</h1>
                <a href="{{ route('admin.plainTeeAddShirt') }}">
                    <i class="fas fa-plus"
                        style="float: left; padding: 2px 2px 2px 2px; margin: 0px 10px 5px 5px;
                        font-size:24px; color:grey; margin-right:10%;"></i>
                </a>
                <form action="{{ route('admin.plainTeeSizeSearch') }}" method="POST">
                    @csrf
                    <input type="submit" name="search" value="Search"
                        style="float: right; border-style:none; border-radius:5px; color:white; background-color:black; padding:8px 50px;
                        font-family:'system-ui'; text-transform:uppercase; letter-spacing:.8px; display:block;
                        margin-right:10%; box-shadow:2px 2px 5px rgb(0, 0, 0, 0.2); cursor:pointer;" />
                    <input type="text" name="searchSize" placeholder="Search size" style="width:35%; float: right; margin-right:2%;"; />
                    </form>
            </div>
            <br /><br />
            <div class="shadow p-3 mb-5 bg-white rounded" style="width:80%; margin: 0 auto;">
                <div class='container'>
                    <?php
                    // Get sorting decision
                    if (isset($_GET['sortingDecision'])) {
                        $sortingDecision = $_GET['sortingDecision'];
                    } else {
                        $sortingDecision = 'plain_tee_size_id';
                    }

                    // Set Ascending Sort
                    if (isset($_GET['sort'])) {
                        $sort = $_GET['sort'];
                    } else {
                        $sort = 'DESC';
                    }

                    // Change everytime when we click
                    $sort == 'ASC' ? ($sort = 'DESC') : ($sort = 'ASC');

                    //Query
                    $sql = "SELECT * FROM plain_tee_sizes AS S, plain_tee_type_colors AS TC, types AS T, colors AS C
                    WHERE S.pt_type_color_id=TC.pt_type_color_id AND TC.type_id=T.type_id AND TC.color_id=C.color_id
                    ORDER BY $sortingDecision $sort";

                    // Count all the records inside database
                    $recordCount = 0;

                    // Variable to connect the database
                    $serverName = 'localhost';
                    $userName = 'root';
                    $password = '';
                    $database = 'online_custom_tee_db';

                    // Check and connect to the databse
                    ($connection = mysqli_connect($serverName, $userName, $password, $database)) or die('Cannot conenct to mysql' . $connection->connect_error);

                    $sqlResult = $connection->query($sql);

                    $rowColor = 1;

                    echo "
                        <div class='row' style='background-color: rgb(200, 197, 197); margin: 10px 10px 10px 10px; padding: 20px 10px 20px 10px;'>
                            <div class='col'>
                                <a href='/admin/plainTeeList?sortingDecision=plain_tee_size_id&sort=$sort' style='color:rgb(0, 0, 0); text-decoration:none; background-color:none;'>Plain Tee ID</a>
                            </div>
                            <div class='col'>
                                <a href='/admin/plainTeeList?sortingDecision=stocks&sort=$sort' style='color:rgb(0, 0, 0); text-decoration:none; background-color:none;'>Stock</a>
                            </div>
                            <div class='col'>
                                <a href='/admin/plainTeeList?sortingDecision=size_name&sort=$sort' style='color:rgb(0, 0, 0); text-decoration:none; background-color:none;'>Size Name</a>
                            </div>
                            <div class='col'>
                                <a href='/admin/plainTeeList?sortingDecision=name&sort=$sort' style='color:rgb(0, 0, 0); text-decoration:none; background-color:none;'>Type</a>
                            </div>
                            <div class='col'>
                                <a href='/admin/plainTeeList?sortingDecision=detail&sort=$sort' style='color:rgb(0, 0, 0); text-decoration:none; background-color:none;'>Type</a>
                            </div>
                            <div class='col'>
                                <a href='/admin/plainTeeList?sortingDecision=color_name&sort=$sort' style='color:rgb(0, 0, 0); text-decoration:none; background-color:none;'>Color</a>
                            </div>
                            <div class='col'>

                            </div>
                        </div>
                    ";
                    ?>
                    <?php
                // Display data from database
                if(isset($_GET['sortingDecision']) && isset($_GET['sort'])){
                    // Check database whether got any data
                    if($sqlResult -> num_rows > 0){
                        while($row = $sqlResult -> fetch_assoc()){
                            if ($rowColor == 1){
                                echo "
                                    <div class='row' style='background-color: white; margin: 10px 10px 10px 10px; padding: 10px 10px 10px 10px;'>
                                        <div class='col' style='color:rgb(0, 0, 0);'>".
                                            $row["plain_tee_size_id"]."
                                        </div>
                                        <div class='col' style='color:rgb(0, 0, 0);'>".
                                            $row["stocks"]."
                                        </div>
                                        <div class='col' style='color:rgb(0, 0, 0);'>".
                                            $row["size_name"]."
                                        </div>
                                        <div class='col' style='color:rgb(0, 0, 0);'>".
                                            $row["name"]."
                                        </div>
                                        <div class='col' style='color:rgb(0, 0, 0);'>".
                                            $row["detail"]."
                                        </div>
                                        <div class='col' style='color:rgb(0, 0, 0);'>".
                                            $row["color_name"]."
                                        </div>
                                        <div class='col' style='color:rgb(0, 0, 0);'>
                                            <a href='/admin/plainTeeDetailInfo/".$row["plain_tee_size_id"]."' style='color:rgb(0, 0, 0); text-decoration:none; background-color:none;'>View Detail</a>
                                        </div>
                                    </div>
                                ";
                                $rowColor = 0;
                            }else{
                                echo "
                                    <div class='row' style='background-color: rgb(200, 197, 197); color:rgb(0, 0, 0); margin: 10px 10px 10px 10px; padding: 20px 10px 20px 10px;'>
                                        <div class='col' style='color:rgb(0, 0, 0);'>".
                                            $row["plain_tee_size_id"]."
                                        </div>
                                        <div class='col' style='color:rgb(0, 0, 0);'>".
                                            $row["stocks"]."
                                        </div>
                                        <div class='col' style='color:rgb(0, 0, 0);'>".
                                            $row["size_name"]."
                                        </div>
                                        <div class='col' style='color:rgb(0, 0, 0);'>".
                                            $row["name"]."
                                        </div>
                                        <div class='col' style='color:rgb(0, 0, 0);'>".
                                            $row["detail"]."
                                        </div>
                                        <div class='col' style='color:rgb(0, 0, 0);'>".
                                            $row["color_name"]."
                                        </div>
                                        <div class='col' style='color:rgb(0, 0, 0);'>
                                            <a href='/admin/plainTeeDetailInfo/".$row["plain_tee_size_id"]."' style='color:rgb(0, 0, 0); text-decoration:none; background-color:none;'>View Detail</a>
                                        </div>
                                    </div>
                                ";
                                $rowColor = 1;
                            }
                        }
                    }
                }else{
                    ?>
                    @foreach ($sizeList as $size)
                        @if ($rowColor == 1)
                            <div class='row'
                                style='background-color: white; margin: 10px 10px 10px 10px; padding: 10px 10px 10px 10px;'>
                                <div class='col' style='color:rgb(0, 0, 0);'>
                                    {{ $size->plain_tee_size_id }}
                                </div>
                                <div class='col' style='color:rgb(0, 0, 0);'>
                                    {{ $size->stocks }}
                                </div>
                                <div class='col' style='color:rgb(0, 0, 0);'>
                                    {{ $size->size_name }}
                                </div>
                                <div class='col' style='color:rgb(0, 0, 0);'>
                                    {{ $size->name }}
                                </div>
                                <div class='col' style='color:rgb(0, 0, 0);'>
                                    {{ $size->detail }}
                                </div>
                                <div class='col' style='color:rgb(0, 0, 0);'>
                                    {{ $size->color_name }}
                                </div>
                                <div class='col' style='color:rgb(0, 0, 0);'>
                                    <a href="{{ '/admin/plainTeeDetailInfo/' . $size->plain_tee_size_id }}"
                                        style='color:rgb(0, 0, 0); text-decoration:none; background-color:none;'>View Detail
                                    </a>
                                </div>
                            </div>
                            <?php $rowColor = 0; ?>
                        @else
                            <div class='row'
                                style='background-color: rgb(200, 197, 197); color:rgb(0, 0, 0); margin: 10px 10px 10px 10px; padding: 20px 10px 20px 10px;'>
                                <div class='col' style='color:rgb(0, 0, 0);'>
                                    {{ $size->plain_tee_size_id }}
                                </div>
                                <div class='col' style='color:rgb(0, 0, 0);'>
                                    {{ $size->stocks }}
                                </div>
                                <div class='col' style='color:rgb(0, 0, 0);'>
                                    {{ $size->size_name }}
                                </div>
                                <div class='col' style='color:rgb(0, 0, 0);'>
                                    {{ $size->name }}
                                </div>
                                <div class='col' style='color:rgb(0, 0, 0);'>
                                    {{ $size->detail }}
                                </div>
                                <div class='col' style='color:rgb(0, 0, 0);'>
                                    {{ $size->color_name }}
                                </div>
                                <div class='col' style='color:rgb(0, 0, 0);'>
                                    <a href="{{ '/admin/plainTeeDetailInfo/' . $size->plain_tee_size_id }}"
                                        style='color:rgb(0, 0, 0); text-decoration:none; background-color:none;'>View Detail
                                    </a>
                                </div>
                            </div>
                            <?php $rowColor = 1; ?>
                        @endif
                    @endforeach
                </div>
                <?php
                    $connection -> close();
                }
            ?>
            </div>
        </div>

    </div>
@endsection

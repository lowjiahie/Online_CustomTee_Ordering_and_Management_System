@extends('layouts.master')

@section('content')
    <div>
        <div style="margin: 0 auto; padding: 10px 10px 10px 10px;">
            <div>
                <h1 style="float: left; font-size:24px; margin-left: 10%;">Printing Method List</h1>
                <a href="{{ route('admin.printingMethodAddPage') }}">
                    <i class="fas fa-plus"
                        style="float: left; padding: 2px 2px 2px 2px; margin: 0px 10px 5px 5px;
                        font-size:24px; color:grey; margin-right:10%;"></i>
                </a>
                <form action="{{ route('admin.printingMethodSearch') }}" method="POST">
                    @csrf
                    <input type="submit" name="search" value="Search"
                        style="float: right; border-style:none; border-radius:5px; color:white; background-color:black; padding:8px 50px;
                        font-family:'system-ui'; text-transform:uppercase; letter-spacing:.8px; display:block;
                        margin-right:10%; box-shadow:2px 2px 5px rgb(0, 0, 0, 0.2); cursor:pointer;" />
                    <input type="text" name="searchPrintingMethod" placeholder="Search printing method name" style="width:25%; float: right; margin-right:2%;"; />
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
                        $sortingDecision = 'p_method_id';
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
                    $sql = "SELECT * FROM printing_methods ORDER BY $sortingDecision $sort";

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
                                <a href='/admin/printingMethodList?sortingDecision=p_method_id&sort=$sort' style='color:rgb(0, 0, 0); text-decoration:none; background-color:none;'>Printing Method ID</a>
                            </div>
                            <div class='col'>
                                <a href='/admin/printingMethodList?sortingDecision=name&sort=$sort' style='color:rgb(0, 0, 0); text-decoration:none; background-color:none;'>Name</a>
                            </div>
                            <div class='col'>
                                <a href='/admin/printingMethodList?sortingDecision=price&sort=$sort' style='color:rgb(0, 0, 0); text-decoration:none; background-color:none;'>Price(RM)</a>
                            </div>
                            <div class='col'>
                                <a href='/admin/printingMethodList?sortingDecision=minimum_order&sort=$sort' style='color:rgb(0, 0, 0); text-decoration:none; background-color:none;'>Minimum Order</a>
                            </div>
                            <div class='col'>
                                <a href='/admin/printingMethodList?sortingDecision=status&sort=$sort' style='color:rgb(0, 0, 0); text-decoration:none; background-color:none;'>Status</a>
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
                                            $row["p_method_id"]."
                                        </div>
                                        <div class='col' style='color:rgb(0, 0, 0);'>".
                                            $row["name"]."
                                        </div>
                                        <div class='col' style='color:rgb(0, 0, 0);'>".
                                            $row["price"]."
                                        </div>
                                        <div class='col' style='color:rgb(0, 0, 0);'>".
                                            $row["minimum_order"]."
                                        </div>
                                        <div class='col' style='color:rgb(0, 0, 0);'>".
                                            $row["status"]."
                                        </div>
                                        <div class='col' style='color:rgb(0, 0, 0);'>
                                            <a href='/admin/printingMethodDetailInfo/".$row["p_method_id"]."' style='color:rgb(0, 0, 0); text-decoration:none; background-color:none;'>View Detail</a>
                                        </div>
                                    </div>
                                ";
                                $rowColor = 0;
                            }else{
                                echo "
                                    <div class='row' style='background-color: rgb(200, 197, 197); color:rgb(0, 0, 0); margin: 10px 10px 10px 10px; padding: 20px 10px 20px 10px;'>
                                        <div class='col' style='color:rgb(0, 0, 0);'>".
                                            $row["p_method_id"]."
                                        </div>
                                        <div class='col' style='color:rgb(0, 0, 0);'>".
                                            $row["name"]."
                                        </div>
                                        <div class='col' style='color:rgb(0, 0, 0);'>".
                                            $row["price"]."
                                        </div>
                                        <div class='col' style='color:rgb(0, 0, 0);'>".
                                            $row["minimum_order"]."
                                        </div>
                                        <div class='col' style='color:rgb(0, 0, 0);'>".
                                            $row["status"]."
                                        </div>
                                        <div class='col' style='color:rgb(0, 0, 0);'>
                                            <a href='/admin/printingMethodDetailInfo/".$row["p_method_id"]."' style='color:rgb(0, 0, 0); text-decoration:none; background-color:none;'>View Detail</a>
                                        </div>
                                    </div>
                                ";
                                $rowColor = 1;
                            }
                        }
                    }
                }else{
                    ?>
                    @foreach ($printingMethodList as $printingMethod)
                        @if ($rowColor == 1)
                            <div class='row'
                                style='background-color: white; margin: 10px 10px 10px 10px; padding: 10px 10px 10px 10px;'>
                                <div class='col' style='color:rgb(0, 0, 0);'>
                                    {{ $printingMethod->p_method_id }}
                                </div>
                                <div class='col' style='color:rgb(0, 0, 0);'>
                                    {{ $printingMethod->name }}
                                </div>
                                <div class='col' style='color:rgb(0, 0, 0);'>
                                    {{ $printingMethod->price }}
                                </div>
                                <div class='col' style='color:rgb(0, 0, 0);'>
                                    {{ $printingMethod->minimum_order }}
                                </div>
                                <div class='col' style='color:rgb(0, 0, 0);'>
                                    {{ $printingMethod->status }}
                                </div>
                                <div class='col' style='color:rgb(0, 0, 0);'>
                                    <a href="{{ '/admin/printingMethodDetailInfo/' . $printingMethod->p_method_id }}"
                                        style='color:rgb(0, 0, 0); text-decoration:none; background-color:none;'>View
                                        Detail</a>
                                </div>
                            </div>
                            <?php $rowColor = 0; ?>
                        @else
                            <div class='row'
                                style='background-color: rgb(200, 197, 197); color:rgb(0, 0, 0); margin: 10px 10px 10px 10px; padding: 20px 10px 20px 10px;'>
                                <div class='col' style='color:rgb(0, 0, 0);'>
                                    {{ $printingMethod->p_method_id }}
                                </div>
                                <div class='col' style='color:rgb(0, 0, 0);'>
                                    {{ $printingMethod->name }}
                                </div>
                                <div class='col' style='color:rgb(0, 0, 0);'>
                                    {{ $printingMethod->price }}
                                </div>
                                <div class='col' style='color:rgb(0, 0, 0);'>
                                    {{ $printingMethod->minimum_order }}
                                </div>
                                <div class='col' style='color:rgb(0, 0, 0);'>
                                    {{ $printingMethod->status }}
                                </div>
                                <div class='col' style='color:rgb(0, 0, 0);'>
                                    <a href="{{ '/admin/printingMethodDetailInfo/' . $printingMethod->p_method_id }}"
                                        style='color:rgb(0, 0, 0); text-decoration:none; background-color:none;'>View
                                        Detail</a>
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

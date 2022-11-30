@extends('layouts.master')

@section('content')
<div>
    <div style="width: 100%; height: 40%; margin-left: auto; margin-right: auto; padding: 10px 10px 10px 10px;">
        <div>
            <h1 style="float: left; font-size:24px; margin-left: 7%;">Printing Method List</h1>
            <a href="#">
                <i class="fas fa-user-plus" style="float: right; padding: 2px 2px 2px 2px; margin: 2px 5px 2px 2px; font-size:24px; color:grey; margin-right:7%;"></i>
            </a>
        </div>
        <br/><br/>
        <div class='container'>
            <?php
                // Get sorting decision
                if(isset($_GET['sortingDecision'])){
                    $sortingDecision = $_GET['sortingDecision'];
                }else{
                    $sortingDecision = 'p_method_id';
                }

                // Set Ascending Sort
                if(isset($_GET["sort"])){
                    $sort = $_GET["sort"];
                }
                else{
                    $sort = 'DESC';
                }

                // Change everytime when we click
                $sort == 'ASC' ? $sort = 'DESC' : $sort = 'ASC';

                //Query
                $sql = "SELECT * FROM printing_methods ORDER BY $sortingDecision $sort";

                // Count all the records inside database
                $recordCount = 0;

                // Variable to connect the database
                $serverName = "localhost";
                $userName = "root";
                $password = "";
                $database = "online_custom_tee_db";

                // Check and connect to the databse
                $connection = mysqli_connect($serverName, $userName, $password, $database) OR
                        die("Cannot conenct to mysql" . $connection -> connect_error);

                $sqlResult = $connection -> query($sql);

                $rowColor = 1;

                echo "
                    <div class='row' style='background-color: rgb(200, 197, 197); margin: 10px 10px 10px 10px; padding: 20px 10px 20px 10px;'>
                        <div class='col'>
                            <a href=' ?sortingDecision=p_method_id&sort=$sort' style='color:rgb(0, 0, 0); text-decoration:none; background-color:none;'>Printing Method ID</a>
                        </div>
                        <div class='col'>
                            <a href='?sortingDecision=name&sort=$sort' style='color:rgb(0, 0, 0); text-decoration:none; background-color:none;'>Name</a>
                        </div>
                        <div class='col'>
                            <a href='?sortingDecision=price&sort=$sort' style='color:rgb(0, 0, 0); text-decoration:none; background-color:none;'>Price</a>
                        </div>
                        <div class='col'>
                            <a href='?sortingDecision=minimum_order&sort=$sort' style='color:rgb(0, 0, 0); text-decoration:none; background-color:none;'>Minimum Order</a>
                        </div>
                        <div class='col'>
                            <a href='?sortingDecision=status&sort=$sort' style='color:rgb(0, 0, 0); text-decoration:none; background-color:none;'>Status</a>
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
                                            <a href='#?p_method_id=".$row["p_method_id"]."' style='color:rgb(0, 0, 0); text-decoration:none; background-color:none;'>View Detail</a>
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
                                            <a href='#?p_method_id=".$row["p_method_id"]."' style='color:rgb(0, 0, 0); text-decoration:none; background-color:none;'>View Detail</a>
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
                        <div class='row' style='background-color: white; margin: 10px 10px 10px 10px; padding: 10px 10px 10px 10px;'>
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
                                <a href='#' style='color:rgb(0, 0, 0); text-decoration:none; background-color:none;'>View Detail</a>
                            </div>
                        </div>
                        <?php $rowColor = 0 ?>
                    @else
                        <div class='row' style='background-color: rgb(200, 197, 197); color:rgb(0, 0, 0); margin: 10px 10px 10px 10px; padding: 20px 10px 20px 10px;'>
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
                                <a href="{{ ('/admin/printingMethodDetailInfo/'.$printingMethod->p_method_id) }}" style='color:rgb(0, 0, 0); text-decoration:none; background-color:none;'>View Detail</a>
                            </div>
                        </div>
                        <?php $rowColor = 1 ?>
                    @endif
                    @endforeach
    </div>
                    <?php
                    $connection -> close();
                }
            ?>
    </div>

</div>
@endsection

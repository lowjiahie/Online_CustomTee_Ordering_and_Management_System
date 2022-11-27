@extends('layouts.master')

@section('content')
<div>
    <h1>Printing Method</h1>

    <div style="width: 100%; height: 40%; margin-left: auto; margin-right: auto; padding: 10px 10px 10px 10px;">
        <legend>Printing Method List</legend>
        <table style="border: 3px solid grey; width:100%;">
            <tr>
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

                    echo"
                        <th><a href=' ?sortingDecision=p_method_id&sort=$sort'>Printing Method ID</a></th>
                        <th><a href='?sortingDecision=name&sort=$sort'>Name</a></th>
                        <th><a href='?sortingDecision=price&sort=$sort'>Price</a></th>
                        <th><a href='?sortingDecision=minimum_order&sort=$sort'>Minimum Order</a></th>
                        <th><a href='?sortingDecision=status&sort=$sort'>Status</a></th>
                        <th></th>";
                ?>
            </tr>
            <?php
                if(isset($_GET['sortingDecision']) && isset($_GET['sort'])){
                    // Check database whether got any data
                    if($sqlResult -> num_rows > 0){
                        while($row = $sqlResult -> fetch_assoc()){
                            echo "<tr>";
                            echo "<td>".$row["p_method_id"]."</td>";
                            echo "<td>".$row["name"]."</td>";
                            echo "<td>".$row["price"]."</td>";
                            echo "<td>".$row["minimum_order"]."</td>";
                            echo "<td>".$row["status"]."</td>";
                            echo "<td><a href='?p_method_id=".$row["p_method_id"]."'>View Detail</a></td>";
                            echo "</tr>";
                        }
                    }
                }else{
                    ?>
                    @foreach ($printingMethodList as $printingMethod)
                    <tr>
                        <td>{{ $printingMethod->p_method_id }}</td>
                        <td>{{ $printingMethod->name }}</td>
                        <td>{{ $printingMethod->price }}</td>
                        <td>{{ $printingMethod->minimum_order }}</td>
                        <td>{{ $printingMethod->status }}</td>
                        <td><a href="#">View Detail</a></td>
                    </tr>
                    @endforeach
                    <?php
                    $connection -> close();
                }
            ?>
        </table>
    </div>

</div>
@endsection

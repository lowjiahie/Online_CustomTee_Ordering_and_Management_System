@extends('layouts.master')

@section('content')
    <div>
        <div style="margin: 0 auto; padding: 10px 10px 10px 10px;">
            <div>
                <h1 style="float: left; font-size:24px; margin-left: 10%;">Competition List</h1>
                <a href="{{ route('admin.competitionAddPage') }}">
                    <i class="fas fa-plus"
                        style="float: left; padding: 2px 2px 2px 2px; margin: 0px 10px 5px 5px;
                        font-size:24px; color:grey; margin-right:10%;"></i>
                </a>
                <form action="{{ route('admin.competitionSearch') }}" method="POST">
                    @csrf
                    <input type="submit" name="search" value="Search"
                        style="float: right; border-style:none; border-radius:5px; color:white; background-color:black; padding:8px 50px;
                        font-family:'system-ui'; text-transform:uppercase; letter-spacing:.8px; display:block;
                        margin-right:10%; box-shadow:2px 2px 5px rgb(0, 0, 0, 0.2); cursor:pointer;" />
                    <input type="text" name="searchCompetition" placeholder="Search topic" style="width:35%; float: right; margin-right:2%;"; />
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
                        $sortingDecision = 'competition_id';
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
                    $sql = "SELECT * FROM competitions ORDER BY $sortingDecision $sort";

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
                                <a href='/admin/competitionList?sortingDecision=competition_id&sort=$sort' style='color:rgb(0, 0, 0); text-decoration:none; background-color:none;'>Competition ID</a>
                            </div>
                            <div class='col'>
                                <a href='/admin/competitionList?sortingDecision=topic&sort=$sort' style='color:rgb(0, 0, 0); text-decoration:none; background-color:none;'>Topic</a>
                            </div>
                            <div class='col'>
                                <a href='/admin/competitionList?sortingDecision=start_date_time&sort=$sort' style='color:rgb(0, 0, 0); text-decoration:none; background-color:none;'>Start Date</a>
                            </div>
                            <div class='col'>
                                <a href='/admin/competitionList?sortingDecision=end_date_time&sort=$sort' style='color:rgb(0, 0, 0); text-decoration:none; background-color:none;'>End Date</a>
                            </div>
                            <div class='col'>
                                <a href='/admin/competitionList?sortingDecision=winner&sort=$sort' style='color:rgb(0, 0, 0); text-decoration:none; background-color:none;'>Winner</a>
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
                                            $row["competition_id"]."
                                        </div>
                                        <div class='col' style='color:rgb(0, 0, 0);'>".
                                            $row["topic"]."
                                        </div>
                                        <div class='col' style='color:rgb(0, 0, 0);'>".
                                            $row["start_date_time"]."
                                        </div>
                                        <div class='col' style='color:rgb(0, 0, 0);'>".
                                            $row["end_date_time"]."
                                        </div>
                                        <div class='col' style='color:rgb(0, 0, 0);'>".
                                            $row["winner"]."
                                        </div>
                                        <div class='col' style='color:rgb(0, 0, 0);'>
                                            <a href='/admin/competitionDetailInfo/".$row["competition_id"]."' style='color:rgb(0, 0, 0); text-decoration:none; background-color:none;'>View Detail</a>
                                        </div>
                                    </div>
                                ";
                                $rowColor = 0;
                            }else{
                                echo "
                                    <div class='row' style='background-color: rgb(200, 197, 197); color:rgb(0, 0, 0); margin: 10px 10px 10px 10px; padding: 20px 10px 20px 10px;'>
                                        <div class='col' style='color:rgb(0, 0, 0);'>".
                                            $row["competition_id"]."
                                        </div>
                                        <div class='col' style='color:rgb(0, 0, 0);'>".
                                            $row["topic"]."
                                        </div>
                                        <div class='col' style='color:rgb(0, 0, 0);'>".
                                            $row["start_date_time"]."
                                        </div>
                                        <div class='col' style='color:rgb(0, 0, 0);'>".
                                            $row["end_date_time"]."
                                        </div>
                                        <div class='col' style='color:rgb(0, 0, 0);'>".
                                            $row["winner"]."
                                        </div>
                                        <div class='col' style='color:rgb(0, 0, 0);'>
                                            <a href='/admin/competitionDetailInfo/".$row["competition_id"]."' style='color:rgb(0, 0, 0); text-decoration:none; background-color:none;'>View Detail</a>
                                        </div>
                                    </div>
                                ";
                                $rowColor = 1;
                            }
                        }
                    }
                }else{
                    ?>
                    @foreach ($competitionList as $competition)
                        @if ($rowColor == 1)
                            <div class='row'
                                style='background-color: white; margin: 10px 10px 10px 10px; padding: 10px 10px 10px 10px;'>
                                <div class='col' style='color:rgb(0, 0, 0);'>
                                    {{ $competition->competition_id }}
                                </div>
                                <div class='col' style='color:rgb(0, 0, 0);'>
                                    {{ $competition->topic }}
                                </div>
                                <div class='col' style='color:rgb(0, 0, 0);'>
                                    {{ $competition->start_date_time }}
                                </div>
                                <div class='col' style='color:rgb(0, 0, 0);'>
                                    {{ $competition->end_date_time }}
                                </div>
                                <div class='col' style='color:rgb(0, 0, 0);'>
                                    {{ $competition->winner }}
                                </div>
                                <div class='col' style='color:rgb(0, 0, 0);'>
                                    <a href="{{ '/admin/competitionDetailInfo/' . $competition->competition_id }}"
                                        style='color:rgb(0, 0, 0); text-decoration:none; background-color:none;'>View
                                        Detail</a>
                                </div>
                            </div>
                            <?php $rowColor = 0; ?>
                        @else
                            <div class='row'
                                style='background-color: rgb(200, 197, 197); color:rgb(0, 0, 0); margin: 10px 10px 10px 10px; padding: 20px 10px 20px 10px;'>
                                <div class='col' style='color:rgb(0, 0, 0);'>
                                    {{ $competition->competition_id }}
                                </div>
                                <div class='col' style='color:rgb(0, 0, 0);'>
                                    {{ $competition->topic }}
                                </div>
                                <div class='col' style='color:rgb(0, 0, 0);'>
                                    {{ $competition->start_date_time }}
                                </div>
                                <div class='col' style='color:rgb(0, 0, 0);'>
                                    {{ $competition->end_date_time }}
                                </div>
                                <div class='col' style='color:rgb(0, 0, 0);'>
                                    {{ $competition->winner }}
                                </div>
                                <div class='col' style='color:rgb(0, 0, 0);'>
                                    <a href="{{ '/admin/competitionDetailInfo/' . $competition->competition_id }}"
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

@extends('applicants.layout')
@section('title','หน้าหลัก')

@section('content')

<body>
    <div class="container col-12" style="margin-top:100px;">
        <div class="row">
            <div class="col-md-3">
                <!-- <a type="button" href="{{ route('applicants_show_history') }}" class="btn btn-success" style="width: 100%;">ฝากประวัติ</a> -->

                <!-- <br><br><br> -->

                <div class="card">
                    <div class="card-header" align="center" style="background-color:#607D8B; color:white;">
                        รายละเอียดการค้นหา
                    </div>

                    <div class="card-body">
                        @if(isset($ent_post))
                        {!! Form::open(['route' => 'search','method' => 'get']) !!}
                        <div class="dropdown show">
                            <p>ตำแหน่งงาน :</p>
                            <select name="jobs_name" id="mySelect" onchange="this.form.submit()" style="width: 100%;">

                                <!-- check request  -->
                                @if(!isset($_REQUEST['jobs_name']))
                                <option value="" selected>ตำแหน่งงานที่ต้องการ</option>
                                <!-- @foreach($ent_post as $row)
                                <option name="query">{{ $row['_source']['jobs_name'] }}</option>
                                @endforeach -->
                                @else
                                <option value="{{ $_REQUEST['jobs_name'] }}" selected>{{ $_REQUEST['jobs_name'] }}</option>
                                @endif

                                @if(isset($options))
                                @foreach($options['jobs_name'] as $row)
                                <option value="{{ $row }}">{{ $row }}</option>
                                @endforeach
                                @endif

                            </select>
                        </div>
                        <noscript><input type=”submit” value=”Submit”></noscript>
                        {!! Form::close() !!}

                        <br>

                        {!! Form::open(['route' => 'search','method' => 'get']) !!}
                        <div class="dropdown show">
                            <p>ประเภทงาน :</p>
                            <select name="jobs_type" id="mySelect" onchange="this.form.submit()" style="width: 100%;">

                                <!-- check request  -->
                                @if(!isset($_REQUEST['jobs_type']))
                                <option value="" selected>ประเภทงานที่ต้องการ</option>
                                <!-- @foreach($ent_post as $row)
                                <option name="query">{{ $row['_source']['jobs_type'] }}</option>
                                @endforeach -->
                                @else
                                <option value="{{ $_REQUEST['jobs_type'] }}" selected>{{ $_REQUEST['jobs_type'] }}</option>
                                @endif

                                @if(isset($options))
                                @foreach($options['jobs_type'] as $row)
                                <option value="{{ $row }}">{{ $row }}</option>
                                @endforeach
                                @endif

                            </select>
                        </div>
                        <noscript><input type=”submit” value=”Submit”></noscript>
                        {!! Form::close() !!}

                        <br>

                        {!! Form::open(['route' => 'search','method' => 'get']) !!}
                        <div class="dropdown show">
                            <p>ชื่อบริษัท :</p>
                            <select name="jobs_name_company" id="mySelect" onchange="this.form.submit()" style="width: 100%;">

                                <!-- check request  -->
                                @if(!isset($_REQUEST['jobs_name_company']))
                                <option value="" selected>ประเภทงานที่ต้องการ</option>
                                <!-- @foreach($ent_post as $row)
                                <option name="query">{{ $row['_source']['jobs_name_company'] }}</option>
                                @endforeach -->
                                @else
                                <option value="{{ $_REQUEST['jobs_name_company'] }}" selected>{{ $_REQUEST['jobs_name_company'] }}</option>
                                @endif

                                @if(isset($options))
                                @foreach($options['jobs_name_company'] as $row)
                                <option value="{{ $row }}">{{ $row }}</option>
                                @endforeach
                                @endif

                            </select>
                        </div>
                        <noscript><input type=”submit” value=”Submit”></noscript>
                        {!! Form::close() !!}

                        <br>

                        {!! Form::open(['route' => 'search','method' => 'get']) !!}
                        <div class="dropdown show">
                            <p>วันที่ลงประกาศ :</p>
                            <select name="start_post" id="mySelect" onchange="this.form.submit()" style="width: 100%;">

                                <!-- check request  -->
                                @if(!isset($_REQUEST['start_post']))
                                <option value="" selected>ประเภทงานที่ต้องการ</option>
                                <!-- @foreach($ent_post as $row)
                                <option name="query">{{ $row['_source']['start_post'] }}</option>
                                @endforeach -->
                                @else
                                <option value="{{ $_REQUEST['start_post'] }}" selected>{{ $_REQUEST['start_post'] }}</option>
                                @endif

                                @if(isset($options))
                                @foreach($options['start_post'] as $row)
                                <option value="{{ $row }}">{{ $row }}</option>
                                @endforeach
                                @endif

                            </select>
                        </div>
                        <noscript><input type=”submit” value=”Submit”></noscript>
                        {!! Form::close() !!}

                        @endif

                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <!-- text search -->
                {!! Form::open(['route' => 'search','method' => 'get']) !!}
                <div class="input-group" style="margin-bottom:10px;">
                    <input type="text" value="{{$query}}" class="form-control" style="width: 100%;" name="query" aria-label="Small" aria-describedby="inputGroup-sizing-sm" placeholder="search jobs...">
                </div>
                {!! Form::close() !!}



                <!-- @if(isset($jobs))
                @foreach($jobs["hits"]["hits"] as $job)
                <div class="card">
                    <div class="card-body">

                        <img src="{{ asset('uploads/logo/'.$job['_source']['logo']) }}" alt="Lamp" width="100" height="100" style="margin-left: 19px; float:left; border:black 1px solid;">

                        <div class="date" style="float: right;">
                            <p>{{ $job['_source']['start_post'] }} ถึง {{ $job['_source']['stop_post'] }}</p>

                            <br><br><br><br><br><br><br><br><br><br>

                            <button type="submit" class="btn btn-warning" style="margin-left: 0px;" name="action_type" value="{{ $job['_source']['jobs_id'] }}" onclick="addmise(value);window.location.reload()">สนใจ</button>

                            <a type="button" style="margin-left: 0px;" href="{{ route('see_detail',$job['_source']['jobs_id']) }}" class="btn btn-primary">ดูรายละเอียด</a>
                        </div>

                        <div class="jobs_detail" style="margin-left: 19px; float: left; width:450px;" align="left">
                            <p>ตำแหน่งงาน : {{ $job['_source']['jobs_name'] }}</p>
                            <p>ชื่อบริษัท : {{ $job['_source']['jobs_name_company'] }}</p>
                            <p>ที่อยู่ : {{ $job['_source']['jobs_address'] }}</p>
                            <p>จำนวนที่รับ : {{ $job['_source']['jobs_quantity'] }}</p>
                            <p>จำนวนที่รับ : {{ $job['_source']['jobs_salary'] }}</p>
                        </div>
                    </div>
                </div>
                <br>
                @endforeach
                @endif -->

                @if(isset($ent_post))
                @foreach($ent_post as $ent)
                <div class="card">
                    <div class="card-body">

                        <img src="{{ asset('uploads/logo/'.$ent['_source']['logo']) }}" alt="Lamp" width="100" height="100" style="float:left;">

                        <div class="date" style="float: right;">
                            <p>{{ $ent['_source']['start_post'] }} ถึง {{ $ent['_source']['stop_post'] }}</p>

                            <br><br><br><br><br><br><br><br><br><br>

                            <button type="submit" class="btn btn-warning" style="margin-left: 0px;" name="action_type" value="{{ $ent['_source']['jobs_id'] }}" onclick="addmise(value);window.location.reload();">สนใจ</button>

                            <a type="button" style="margin-left: 0px;" href="{{ route('see_detail',$ent['_source']['jobs_id']) }}" class="btn btn-primary">ดูรายละเอียด</a>
                        </div>

                        <div class="jobs_detail" style="float: left; width:450px;" align="left">
                            <p>ตำแหน่งงาน : {{ $ent['_source']['jobs_name'] }}</p>
                            <p>ชื่อบริษัท : {{ $ent['_source']['jobs_name_company'] }}</p>
                            <p>ที่อยู่ : {{ $ent['_source']['jobs_address'] }}</p>
                            <p>จำนวนที่รับ : {{ $ent['_source']['jobs_quantity'] }}</p>
                            <p>จำนวนที่รับ : {{ $ent['_source']['jobs_salary'] }}</p>
                        </div>
                    </div>
                </div>
                <br>
                @endforeach
                @endif
            </div>

            <div class="col-md-3">
                <div class="card-header" style="background-color:#607D8B; color:white;">
                    <span class="align-top">งานยอดนิยม (งานที่มีการสมัครมากที่สุด)</span>
                </div>
                <div class="card">
                    <div class="card-body" style="width:100%;">

                        @if(isset($count_Jobs_list_top))
                        @foreach($count_Jobs_list_top as $row=>$key)

                        <table class="table table-hover">
                            <tr>{{ $row }} : {{ $key }} คน</tr>
                        </table>

                        @endforeach
                        @endif

                    </div>
                </div>

                <br>

                <div class="card-header" style="background-color:#607D8B; color:white;">
                    <span class="align-top">งานที่ไม่นิยม (งานที่มีการสมัครน้อยที่สุด)</span>
                </div>
                <div class="card">
                    <div class="card-body" style="width:100%;">

                        @if(isset($count_Jobs_list_less))
                        @foreach($count_Jobs_list_less as $row=>$key)

                        <table class="table table-hover">
                            <tr>{{ $row }} : {{ $key }} คน</tr>
                        </table>

                        @endforeach
                        @endif

                    </div>
                </div>
            </div>

        </div>
        <br>
    </div>

    <script>
        function addmise(jobs_id) {
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = () => {

                if (xmlhttp.readyState == 4 && xmlhttp.status == 200 && xmlhttp.responseText == 'false') {
                    alert("กดสนใจงานนี้ไปแล้ว")

                }
            }
            xmlhttp.open("GET", "/applicants/add_interest_jobs?id=" + jobs_id, true);
            xmlhttp.send();
            window.location.reload()
        }
    </script>
</body>


@endsection
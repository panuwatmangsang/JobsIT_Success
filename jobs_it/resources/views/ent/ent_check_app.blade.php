@extends('ent.layout')
@section('title','ตรวจสอบผู้สมัคร')

@section('content')

<body>

    <!-- ตรวจสอบผู้สมัคร -->
    <div class="container col-10" id="Page1">

        <!-- <a href="#" class="btn btn-info" style="margin-top:100px;" onclick="return show('Page1','Page2');">ตรวจสอบผู้สมัคร</a>
        <a href="#" class="btn btn-info" style="margin-top:100px; margin-left:5px;" onclick="return show('Page2','Page1');">แฟ้มบันทึกประวัติผู้สมัครที่สนใจ</a>
        <a href="#" class="btn btn-info" style="margin-top:100px; margin-left:5px;" onclick="return show('Page3','Page2');">แฟ้มบันทึกการสมัคร</a>
        <a href="#" class="btn btn-info" style="margin-top:100px; margin-left:5px;" onclick="return show('Page4','Page3');">รายชื่อคนที่อนุมัติ</a> -->

        <a href="#" class="btn btn-info" style="margin-top:100px;" onclick="return show('Page1');">ตรวจสอบผู้สมัคร</a>
        <a href="#" class="btn btn-info" style="margin-top:100px; margin-left:5px;" onclick="return show('Page2');">แฟ้มบันทึกประวัติผู้สมัครที่สนใจ</a>
        <a href="#" class="btn btn-info" style="margin-top:100px; margin-left:5px;" onclick="return show('Page3');">แฟ้มบันทึกการสมัคร</a>
        <a href="#" class="btn btn-info" style="margin-top:100px; margin-left:5px;" onclick="return show('Page4');">รายชื่อคนที่อนุมัติ</a>

        <div class="row justify-content-center">
            <div class="card" style="width:100%; margin-top:50px;">
                <div class="card-header" style="background-color:#6369ED; color:White;">
                    <p class="card-text" style="font-size: 18px;">ตรวจสอบผู้สมัคร</p>
                </div>

                <div class="card-body">
                    <table id="datatable" class="table table-bordered">

                        <tr class="text-center">
                            <td>ชื่องาน</td>
                            <td>ชื่อผู้สมัคร</td>
                            <td>ภาษาที่ถนัด</td>
                            <td>รายละเอียด</td>
                            <td>การกระทำ</td>
                        </tr>

                        @if(isset($mamber))
                        @foreach ($mamber as $datas)
                        <tr>
                            <td>{{ $datas->myjobs_name}}</td>
                            <td>{{ $datas->first_name}}</td>
                            <td>{{ $datas->dominant_language }}</td>

                            <td class="text-center"> <a type="button" href="{{ route('ent.ent_see_detail_history_check',$datas->history_id) }}" class="btn btn-primary">ดูรายละเอียด</a></td>
                            <td class="text-center">
                                <a href="{{route('approve' , $datas->myjobs_id)}}" class="btn btn-success">อนุมัติ</a>
                                <a href="{{route('reject',$datas->myjobs_id)}}" class="btn btn-danger">ปฏิเสธ</a>
                                <a href="{{route('save_file',$datas->myjobs_id)}}" class="btn btn-info" role="button">เพิ่มลงในแฟ้ม</a>
                            </td>
                        </tr>
                        @endforeach
                        @endif
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- บันทึกประวัติผู้สมัคร -->
    <div class="container col-10" id="Page2" style="display:none">

        <!-- <a href="#" class="btn btn-info" style="margin-top:100px;" onclick="return show('Page1','Page2');">ตรวจสอบผู้สมัคร</a>
        <a href="#" class="btn btn-info" style="margin-top:100px; margin-left:5px;" onclick="return show('Page2','Page1');">แฟ้มบันทึกประวัติผู้สมัครที่สนใจ</a>
        <a href="#" class="btn btn-info" style="margin-top:100px; margin-left:5px;" onclick="return show('Page3','Page2');">แฟ้มบันทึกการสมัคร</a>
        <a href="#" class="btn btn-info" style="margin-top:100px; margin-left:5px;" onclick="return show('Page4','Page3');">รายชื่อคนที่อนุมัติ</a> -->

        <a href="#" class="btn btn-info" style="margin-top:100px;" onclick="return show('Page1');">ตรวจสอบผู้สมัคร</a>
        <a href="#" class="btn btn-info" style="margin-top:100px; margin-left:5px;" onclick="return show('Page2');">แฟ้มบันทึกประวัติผู้สมัครที่สนใจ</a>
        <a href="#" class="btn btn-info" style="margin-top:100px; margin-left:5px;" onclick="return show('Page3');">แฟ้มบันทึกการสมัคร</a>
        <a href="#" class="btn btn-info" style="margin-top:100px; margin-left:5px;" onclick="return show('Page4');">รายชื่อคนที่อนุมัติ</a>

        <div class="row justify-content-center">
            <div class="card" style="width:100%; margin-top:50px;">
                <div class="card-header" style="background-color:#6369ED; color:White;">
                    <p class="card-text" style="font-size: 18px;">แฟ้มบันทึกประวัติผู้สมัครที่สนใจ</p>
                </div>

                <div class="card-body">
                    <table id="datatable" class="table table-bordered">

                        <tr class="text-center">
                            <td>ชื่อผู้สมัคร</td>
                            <td>นามสกุลผู้สมัคร</td>
                            <td>รายละเอียด</td>
                            <td class="text-center">รายละเอียด</td>
                        </tr>

                        @if(isset($save_app))
                        @foreach ($save_app as $datas)
                        <tr>
                            <td>{{ $datas->first_name}}</td>
                            <td>{{ $datas->last_name}}</td>
                            <td>{{ $datas->dominant_language }}</td>

                            <td class="text-center"> <a type="button" href="{{ route('ent.ent_see_detail_history_check',$datas->history_id) }}" class="btn btn-primary">ดูรายละเอียด</a></td>

                        </tr>
                        @endforeach
                        @endif
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- บันทึกลงแฟ้ม -->
    <div class="container col-10" id="Page3" style="display:none">

        <!-- <a href="#" class="btn btn-info" style="margin-top:100px;" onclick="return show('Page1','Page2');">ตรวจสอบผู้สมัคร</a>
        <a href="#" class="btn btn-info" style="margin-top:100px; margin-left:5px;" onclick="return show('Page2','Page1');">แฟ้มบันทึกประวัติผู้สมัครที่สนใจ</a>
        <a href="#" class="btn btn-info" style="margin-top:100px; margin-left:5px;" onclick="return show('Page3','Page2');">แฟ้มบันทึกการสมัคร</a>
        <a href="#" class="btn btn-info" style="margin-top:100px; margin-left:5px;" onclick="return show('Page4','Page3');">รายชื่อคนที่อนุมัติ</a> -->

        <a href="#" class="btn btn-info" style="margin-top:100px;" onclick="return show('Page1');">ตรวจสอบผู้สมัคร</a>
        <a href="#" class="btn btn-info" style="margin-top:100px; margin-left:5px;" onclick="return show('Page2');">แฟ้มบันทึกประวัติผู้สมัครที่สนใจ</a>
        <a href="#" class="btn btn-info" style="margin-top:100px; margin-left:5px;" onclick="return show('Page3');">แฟ้มบันทึกการสมัคร</a>
        <a href="#" class="btn btn-info" style="margin-top:100px; margin-left:5px;" onclick="return show('Page4');">รายชื่อคนที่อนุมัติ</a>

        <div class="row justify-content-center">
            <div class="card" style="width: 100%; margin-top:50px;">
                <div class="card-header" style="background-color:#6369ED; color:White;">
                    <p class="card-text" style="font-size: 18px;">แฟ้มบันทึกการสมัคร</p>
                </div>

                <div class="card-body">
                    <table class="table table-bordered">

                        <tr class="text-center">
                            <td>ชื่องาน</td>
                            <td>ชื่อผู้สมัคร</td>
                            <td>ภาษาที่ถนัด</td>
                            <td class="text-center">รายละเอียด</td>
                            <td class="text-center">การกระทำ</td>
                        </tr>
                        @if(isset($file_save))
                        @foreach($file_save as $rows)
                        <tr>
                            <td>{{ $rows->myjobs_name}}</td>
                            <td>{{ $rows->first_name}}</td>
                            <td>{{ $rows->dominant_language }}</td>

                            <td class="text-center"> <a type="button" href="{{ route('ent.ent_see_detail_history_check',$rows->history_id) }}" class="btn btn-primary">ดูรายละเอียด</a></td>
                            <td class="text-center">
                                <a href="{{route('approve' , $rows->myjobs_id)}}" class="btn btn-success">อนุมัติ</a>
                                <a href="{{route('reject',$rows->myjobs_id)}}" class="btn btn-danger">ปฏิเสธ</a>
                            </td>
                        </tr>
                        @endforeach
                        @endif
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- รายชื่อคนที่อนุมัติ -->
    <div class="container col-10" id="Page4" style="display:none">

        <!-- <a href="#" class="btn btn-info" style="margin-top:100px;" onclick="return show('Page1','Page2');">ตรวจสอบผู้สมัคร</a>
        <a href="#" class="btn btn-info" style="margin-top:100px; margin-left:5px;" onclick="return show('Page2','Page1');">แฟ้มบันทึกประวัติผู้สมัครที่สนใจ</a>
        <a href="#" class="btn btn-info" style="margin-top:100px; margin-left:5px;" onclick="return show('Page3','Page2');">แฟ้มบันทึกการสมัคร</a>
        <a href="#" class="btn btn-info" style="margin-top:100px; margin-left:5px;" onclick="return show('Page4','Page3');">รายชื่อคนที่อนุมัติ</a> -->

        <a href="#" class="btn btn-info" style="margin-top:100px;" onclick="return show('Page1');">ตรวจสอบผู้สมัคร</a>
        <a href="#" class="btn btn-info" style="margin-top:100px; margin-left:5px;" onclick="return show('Page2');">แฟ้มบันทึกประวัติผู้สมัครที่สนใจ</a>
        <a href="#" class="btn btn-info" style="margin-top:100px; margin-left:5px;" onclick="return show('Page3');">แฟ้มบันทึกการสมัคร</a>
        <a href="#" class="btn btn-info" style="margin-top:100px; margin-left:5px;" onclick="return show('Page4');">รายชื่อคนที่อนุมัติ</a>

        <div class="row justify-content-center">
            <div class="card" style="width: 100%; margin-top:50px;">
                <div class="card-header" style="background-color:#6369ED; color:White;">
                    <p class="card-text" style="font-size: 18px;">รายชื่อคนที่อนุมัติ</p>
                </div>

                <div class="card-body">
                    <table class="table table-bordered">

                        <tr class="text-center">
                            <td>ชื่องาน</td>
                            <td>ชื่อผู้สมัคร</td>
                            <td>รายละเอียด</td>
                            <td>วันสัมภาษณ์</td>
                            <td class="text-center">รายละเอียด</td>
                            <td class="text-center">ยกเลิกการอนุมัติ</td>
                            <td>สถานะ</td>
                        </tr>
                        @if(isset($rove))
                        @foreach($rove as $rows)
                        <tr>
                            <td>{{ $rows->myjobs_name}}</td>
                            <td>{{ $rows->first_name}}</td>
                            <td>{{ $rows->dominant_language }}</td>
                            <td>{{ $rows->message }}</td>
                            <td class="text-center"> <a type="button" href="{{ route('ent.ent_see_detail_history_check',$rows->history_id) }}" class="btn btn-primary">ดูรายละเอียด</a></td>
                            <td class="text-center"> <a type="button" href="{{ route('edit_cancel',$rows->myjobs_id) }}" class="btn btn-danger">ยกเลิก</a></td>
                            <td class="text-center" style="color: green">อนุมัติเรียบร้อย</td>
                        </tr>
                        @endforeach
                        @endif
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        function addmise(id) {
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.open("GET", "/Ent/addmiseappli?id=" + id, true);
            xmlhttp.send();
        }
    </script>

    <!-- multiple page -->
    <script>
        // function show(shown, hidden) {
        //     document.getElementById(shown).style.display = 'block';
        //     document.getElementById(hidden).style.display = 'none';
        //     return false;
        // }

        // ===========================================================================================
        function show(page) {
            switch (page) {
                case "Page1":
                    document.getElementById('Page1').style.display = "";
                    document.getElementById('Page2').style.display = "none";
                    document.getElementById('Page3').style.display = "none";
                    document.getElementById('Page4').style.display = "none";
                    break;
                case "Page2":
                    document.getElementById('Page1').style.display = "none";
                    document.getElementById('Page2').style.display = "";
                    document.getElementById('Page3').style.display = "none";
                    document.getElementById('Page4').style.display = "none";
                    break;
                case "Page3":
                    document.getElementById('Page1').style.display = "none";
                    document.getElementById('Page2').style.display = "none";
                    document.getElementById('Page3').style.display = "";
                    document.getElementById('Page4').style.display = "none";
                    break;
                case "Page4":
                    document.getElementById('Page1').style.display = "none";
                    document.getElementById('Page2').style.display = "none";
                    document.getElementById('Page3').style.display = "none";
                    document.getElementById('Page4').style.display = "";
                    break;
                default:
                    $output = location.hash.slice(1);
            }
        }
    </script>
</body>
@endsection
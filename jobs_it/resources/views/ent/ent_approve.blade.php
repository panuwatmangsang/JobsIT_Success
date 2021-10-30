@extends('ent.layout')
@section('title','ยืนยันผู้สมัคร')

@section('content')

<body>
    <div class="container">
        <div class="row justify-content-center">

            <div class="col-md-10" style="margin-top: 100px;">
                <h1>ยืนยันการอนุมัติ</h1>
                <form action="{{ route('ent_update_approve') }}" method="POST">
                    @csrf
                    <input type="hidden" name="myjobs_id" value="{{$mamber['myjobs_id']}}">
                    <input type="hidden" name="action_type" value="{{$mamber['action_type']='ApproveForm'}}">
                    <!-- <input type="hidden" name="message" value="{{$mamber['message']='interview'}}"> -->

                    <div class="form-group">
                        <label for="exampleFormControlTextarea1">แจ้งรายละเอียดการสัมภาษณ์งาน</label>
                        <textarea class="form-control" id="message" rows="10" name="message"></textarea>
                    </div>

                    <input type="hidden" name="a_id" value="{{$mamber['a_id']=4}}">

                    <a class="btn btn-danger" href="{{ route('ent_check_app') }}" class="btn btn-danger" role="button">ยกเลิก</a>
                    <button type="submit" class="btn btn-success" style="float:right;">ยืนยัน</button>
                </form>

            </div>

        </div>


    </div>

</body>
@endsection
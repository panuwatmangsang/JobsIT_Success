@extends('ent.layout')
@section('title','ยืนยันผู้สมัคร')

@section('content')

<body>
    <div class="container ">
        <div class="row">

            <div class="col-mb-3 offset-md-5" style="margin-top: 25%;">
                <h1>ยกเลิกการอนุมัติ</h1>
                <form action="{{ route('ent_update_approve') }}" method="POST">
                    @csrf
                    <input type="hidden" name="myjobs_id" value="{{$row['myjobs_id']}}">
                    <input type="hidden" name="action_type" value="{{$row['action_type']='AppliForm'}}">
                    <input type="hidden" name="message" value="{{$mamber['message']='cancel'}}">
                    <input type="hidden" name="a_id" value="{{$row['a_id']=2}}">
                    <a class="btn btn-danger" href="{{ route('ent_check_app') }}" class="btn btn-danger" role="button">ยกเลิก</a>
                    <button type="submit" class="btn btn-success" style="float:right;width:35%">ยืนยัน</button>
                </form>

            </div>

        </div>


    </div>

</body>
@endsection
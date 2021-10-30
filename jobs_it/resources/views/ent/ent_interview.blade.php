@extends('ent.layout')
@section('title','สัมภาษณ์')

@section('content')

<body>
    <div class="container">
        <!-- @if(isset($jobs))

        <form method="POST" action="{{route('store_inter,$jobs_edit->myjobs_id')}}">
            {{csrf_field()}}
            <div class="form-group">
                <label for="exampleFormControlInput1">ชื่อบริษัท</label>
                <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="{{ $jobs->name_company }}" value="{{$jobs->name_company}}">
            </div>
            <div class="form-group">
                <input type="hidden" class="form-control" name="job_id" placeholder="{{ $jobs->id }}" value="{{ $jobs->id }}">
            </div>
            <div class="form-group">
                <label for="exampleFormControlTextarea1">แจ้งรายละเอียดการสัมภาษณ์งาน</label>
                <textarea class="form-control" id="message" rows="10" name="message"></textarea>
            </div>
            <div class="button" style="float: right;">
                <a class="btn btn-danger" href="/Ent/entCheck" class="btn btn-danger" role="button">ยกเลิก</a>
                <button type="submit" class="btn btn-primary">ส่ง</button>
            </div>
        </form>
        @endif -->
        <form method="POST" action="{{route('store_inter')}}">
            {{csrf_field()}}
            <div class="form-group">
                <label for="exampleFormControlInput1">ชื่อบริษัท</label>
                <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="ชื่อบริษัท">
            </div>
            <div class="form-group">
                <input type="hidden" class="form-control" name="job_id" >
            </div>
            <div class="form-group">
                <label for="exampleFormControlTextarea1">แจ้งรายละเอียดการสัมภาษณ์งาน</label>
                <textarea class="form-control" id="message" rows="10" name="message"></textarea>
            </div>
            <div class="button" style="float: right;">
                <a class="btn btn-danger" href="/ent/ent_check_app" class="btn btn-danger" role="button">ยกเลิก</a>
                <button type="submit" class="btn btn-primary">ส่ง</button>
            </div>
        </form>
    </div>
</body>

@endsection
@extends('ent.layout')
@section('title','แสดงใบประกาศรับสมัครพนักงาน')

@section('cssBlock')
<!-- css -->
<link rel="stylesheet" href="../jobs_it/css/step.css">
@stop

@section('content')

<body>
    <div class="container col-10" style="margin-top:100px">
        <div class="row justify-content-center">
            <div class="card" style="width: 80%;height:100%">

                <div class="card-header" style="background-color:#6369ED; color:White;">
                    <p class="card-text" style="font-size: 18px;top:2px;text-align:center">แสดงรายละเอียดการฝากประวัติ</p>
                </div>

                @if ($message = Session::get('success'))
                <div class="alert alert-success">
                    <p>{{ $message }}</p>
                </div>
                @endif

                <div class="card-body">
                    @if(isset($history))

                    <!-- ======================== ประวัติส่วนตัว ======================= -->
                    <div class="tab" style="display: none;">
                        <div class="head position-relative mt-1">
                            <p class="card-text" style="font-size:18px;">ประวัติส่วนตัว</p>

                        </div>
                        <div class="form-row">
                            <div class="form-row col align-self-center" align="center">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="exampleFormControlFile1">รูปประจำตัว</label> <br>
                                        <img src="{{ asset('uploads/profile/'.$history->profile) }}" width="100px" height="130px" alt="profile">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <br>

                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="exampleFormControlTextarea1">คำนำหน้า :</label>
                                <input readonly type="text" class="form-control" name="name_prefix" value="{{ $history->name_prefix }}" placeholder="กรอกชื่อ">
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="exampleFormControlTextarea1">ชื่อ :</label>
                                <input readonly type="text" class="form-control" name="first_name" value="{{ $history->first_name }}" placeholder="กรอกชื่อ">
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="exampleFormControlTextarea1">นามสกุล :</label>
                                <input readonly type="text" class="form-control" name="last_name" value="{{ $history->last_name }}" placeholder="กรอกนามสกุล">
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="exampleFormControlTextarea1">อีเมล :</label>
                                <input readonly type="text" class="form-control" name="email" value="{{ $history->email }}" placeholder="กรอกอีเมล">
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="exampleFormControlTextarea1">เบอร์โทรศัพท์ :</label>
                                <input readonly type="text" class="form-control" name="phone_number" value="{{ $history->phone_number }}" placeholder="กรอกเบอร์โทรศัพท์">
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="exampleFormControlTextarea1">วันเกิด :</label>
                                <input readonly type="text" class="form-control" name="birthday" value="{{ $history->birthday }}" placeholder="กรอกอายุ">
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="exampleFormControlTextarea1">อายุ:</label>
                                <input readonly type="text" class="form-control" name="year_old" value="{{ $history->year_old }}" placeholder="กรอกอายุ">
                            </div>
                        </div>
                    </div>
                    <!-- <br>

                    <div class="alert alert-danger p-1" role="alert"></div>

                    <br> -->
                    <!-- ===================================================================================================ประวัติการศึกษา================================================================================ -->
                    <div class="tab" style="display: none;">
                        <div class="head position-relative mt-1">
                            <p class="card-text" style="font-size:18px;">ประวัติการศึกษา</p>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="exampleFormControlTextarea1">จบจากมหาวิทยาลัย/วิทลัย :</label>
                                <input readonly type="text" class="form-control" name="university" value="{{ $history->university }}" placeholder="กรอกชื่อมหาวิทยาลัย/วิทลัย">
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="exampleFormControlTextarea1">คณะ :</label>
                                <input readonly type="text" class="form-control" name="faculty" value="{{ $history->faculty }}" placeholder="กรอกคณะ">
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="exampleFormControlTextarea1">สาขา :</label>
                                <input readonly type="text" class="form-control" name="branch" value="{{ $history->branch }}" placeholder="กรอกชื่อสาขา">
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="exampleFormControlTextarea1">GPA :</label>
                                <input readonly type="text" class="form-control" name="gpa" value="{{ $history->gpa }}" placeholder="กรอกGPA">
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="exampleFormControlTextarea1">วุฒิการศึกษา :</label>
                                <input readonly type="text" class="form-control" name="educational" value="{{ $history->educational }}" placeholder="กรอกชื่อ">
                            </div>
                        </div>
                    </div>

                    <!-- <br>
                    <div class="alert alert-danger p-1" role="alert"></div>
                    <br> -->
                    <!-- ===================================================================================================ประสบการณ์ทำงาน================================================================================ -->
                    <div class="tab" style="display: none;">
                        <div class="head position-relative mt-1">
                            <p class="card-text" style="font-size:18px;">ประสบการณ์ทำงาน</p>
                        </div>
                        <div class="form-row">
                            <div class="col-md-12">
                                <div class="form-inline form-group">
                                    <label for="exampleFormControlTextarea1">ประสบการณ์ที่เคยทำงานกับบริษัท (ปี) :</label>
                                    <input readonly type="text" class="form-control" name="experience" value="{{ $history->experience }}" style="width: 50%; margin-left: 10px;" placeholder="กรอกประสบการณ์ที่เคยทำงานกับบริษัท (ปี)">
                                </div>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="exampleFormControlTextarea1">ภาษาที่ถนัด</label>
                                    <textarea readonly class="form-control" name="dominant_language" id="exampleFormControlTextarea1" rows="8"> {{ $history->dominant_language }}</textarea>
                                </div>
                            </div>
                        </div>

                        <br>

                        <div class="form-row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="exampleFormControlTextarea1">ภาษาที่เคยเรียน</label>
                                    <textarea readonly class="form-control" name="language_learned" id="exampleFormControlTextarea1" rows="8">{{ $history->language_learned }}</textarea>
                                </div>
                            </div>
                        </div>

                        <br>

                        <div class="form-row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="exampleFormControlTextarea1">ความสามารถพิเศษ</label>
                                    <textarea readonly class="form-control" name="charisma" id="exampleFormControlTextarea1" rows="8">{{ $history->charisma }}</textarea>
                                </div>
                            </div>
                        </div>

                        <br>

                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="exampleFormControlFile1">ผลงาน</label>
                                <br>
                                <a href="{{ route('view_portfolio',$history->history_id) }}">ดูเอกสาร</a>
                            </div>
                        </div>
                    </div>
                    <!-- <br>
                    <div class="alert alert-danger p-1" role="alert"></div>
                    <br> -->
                    <!-- ===================================================================================================ภูมิลำเนา================================================================================ -->
                    <div class="tab" style="display: none;">
                        <div class="head position-relative mt-1">
                            <p class="card-text" style="font-size:18px;">ภูมิลำเนา</p>
                        </div>

                        <br>

                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="exampleFormControlTextarea1">หมู่บ้าน :</label>
                                <input readonly type="text" class="form-control" name="name_village" value="{{ $history->name_village }}" placeholder="กรอกหมู่บ้าน">
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="exampleFormControlTextarea1">บ้านเลขที่ :</label>
                                <input readonly type="text" class="form-control" name="home_number" value="{{ $history->home_number }}" placeholder="กรอกบ้านเลขที่">
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="exampleFormControlTextarea1">ซอย/ตรอก :</label>
                                <input readonly type="text" class="form-control" name="alley" value="{{ $history->alley }}" placeholder="กรอกซอย/ตรอก">
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="exampleFormControlTextarea1">ถนน :</label>
                                <input readonly type="text" class="form-control" name="road" value="{{ $history->road }}" placeholder="กรอกถนน">
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="exampleFormControlTextarea1">ตำบล :</label>
                                <input readonly type="text" class="form-control" name="district" value="{{ $history->district }}" placeholder="กรอกตำบล">
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="exampleFormControlTextarea1">อำเภอ :</label>
                                <input readonly type="text" class="form-control" name="canton" value="{{ $history->canton }}" placeholder="กรอกอำเภอ">
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="exampleFormControlTextarea1">จังหวัด :</label>
                                <input readonly type="text" class="form-control" name="province" value="{{ $history->province }}" placeholder="กรอกจังหวัด">
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="exampleFormControlTextarea1">รหัสไปรษณีย์ :</label>
                                <input readonly type="text" class="form-control" name="postal_code" value="{{ $history->postal_code }}" placeholder="กรอกรหัสไปรษณีย์">
                            </div>
                        </div>
                    </div>

                    <!-- <br>
                    <div class="alert alert-danger p-1" role="alert"></div>
                    <br> -->
                    <!-- ===================================================================================================ที่อยู่ปัจจุบัน================================================================================ -->
                    <div class="tab" style="display: none;">
                        <div class="head position-relative mt-1">
                            <p class="card-text" style="font-size:18px;">ที่อยู่ปัจจุบัน</p>
                        </div>
                        <br>

                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="exampleFormControlTextarea1">หมู่บ้าน :</label>
                                <input readonly type="text" class="form-control" name="my_name_village" value="{{ $history->my_name_village }}" placeholder="กรอกหมู่บ้าน">
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="exampleFormControlTextarea1">บ้านเลขที่ :</label>
                                <input readonly type="text" class="form-control" name="my_home_number" value="{{ $history->my_home_number }}" placeholder="กรอกบ้านเลขที่">
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="exampleFormControlTextarea1">ซอย/ตรอก :</label>
                                <input readonly type="text" class="form-control" name="my_alley" value="{{ $history->my_alley }}" placeholder="กรอกซอย/ตรอก">
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="exampleFormControlTextarea1">ถนน :</label>
                                <input readonly type="text" class="form-control" name="my_road" value="{{ $history->my_road }}" placeholder="กรอกถนน">
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="exampleFormControlTextarea1">ตำบล :</label>
                                <input readonly type="text" class="form-control" name="my_district" value="{{ $history->my_district }}" placeholder="กรอกตำบล:">
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="exampleFormControlTextarea1">อำเภอ :</label>
                                <input readonly type="text" class="form-control" name="my_canton" value="{{ $history->my_canton }}" placeholder="กรอกอำเภอ">
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="exampleFormControlTextarea1">จังหวัด :</label>
                                <input readonly type="text" class="form-control" name="my_province" value="{{ $history->my_province }}" placeholder="กรอกจังหวัด">
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="exampleFormControlTextarea1">รหัสไปรษณีย์ :</label>
                                <input readonly type="text" class="form-control" name="my_postal_code" value="{{ $history->my_postal_code }}" placeholder="กรอกรหัสไปรษณีย์">
                            </div>
                        </div>
                    </div>

                    <div style="overflow:auto;">
                        <div style="float:right;">
                            <button type="button" class="btn btn-secondary" id="prevBtn" onclick="nextPrev(-1)">Previous</button>
                            <button type="button" class="btn btn-success" id="nextBtn" onclick="nextPrev(1)">Next</button>
                        </div>
                    </div>

                    <div style="text-align:center;margin-top:40px;">
                        <span class="step"></span>
                        <span class="step"></span>
                        <span class="step"></span>
                        <span class="step"></span>
                        <span class="step"></span>
                    </div>
                    <!-- <br>

                    <div class="alert alert-danger p-1" role="alert"></div>
                    <br> -->

                    <!-- <a href="#" class="btn btn-info" style="float:right; margin-left:10px">เพิ่มลงแฟ้ม</a> -->
                    <button type="submit" class="btn btn-info" style="float:right; margin-left:10px" value="{{ $history->history_id }}" onclick="add(value);window.location.reload()">สนใจ</button>

                    <a href="{{ route('ent_check_app') }}" class="btn btn-danger" style="float:right; margin-left:10px">กลับ</a>

                    @endif
                </div>
            </div>
        </div>
    </div>
    </div>

    <script>
        function add(history_id) {
            console.log('ok');
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.open("GET", "/interest_app?id=" + history_id, true);
            xmlhttp.send();
        }
    </script>

    <!-- multiple form -->
    <script>
        var currentTab = 0; // Current tab is set to be the first tab (0)
        showTab(currentTab); // Display the current tab

        function showTab(n) {
            // This function will display the specified tab of the form...
            var x = document.getElementsByClassName("tab");
            x[n].style.display = "block";
            //... and fix the Previous/Next buttons:
            if (n == 0) {
                document.getElementById("prevBtn").style.display = "none";
            } else {
                document.getElementById("prevBtn").style.display = "inline";
            }
            if (n == (x.length - 1)) {
                document.getElementById("nextBtn").innerHTML = "สิ้นสุด";
            } else {
                document.getElementById("nextBtn").innerHTML = "Next";
            }
            if (n == (x.length - 1)) {
                document.getElementById("nextBtn").style.display = "none";
            } else {
                document.getElementById("nextBtn").style.display = "inline";
            }
            //... and run a function that will display the correct step indicator:
            fixStepIndicator(n)
        }

        function nextPrev(n) {
            // This function will figure out which tab to display
            var x = document.getElementsByClassName("tab");
            // Exit the function if any field in the current tab is invalid:
            if (n == 1 && !validateForm()) return false;
            // Hide the current tab:
            x[currentTab].style.display = "none";
            // Increase or decrease the current tab by 1:
            currentTab = currentTab + n;
            // if you have reached the end of the form...
            if (currentTab >= x.length) {
                // ... the form gets submitted:
                document.getElementById("regForm").submit();
                return false;
            }
            // Otherwise, display the correct tab:
            showTab(currentTab);
        }

        function validateForm() {
            // This function deals with validation of the form fields
            var x, y, i, valid = true;
            x = document.getElementsByClassName("tab");
            y = x[currentTab].getElementsByTagName("input");
            // A loop that checks every input field in the current tab:
            for (i = 0; i < y.length; i++) {
                // If a field is empty...
                if (y[i].value == "") {
                    // add an "invalid" class to the field:
                    y[i].className += " invalid";
                    // and set the current valid status to false
                    valid = false;
                }
            }
            // If the valid status is true, mark the step as finished and valid:
            if (valid) {
                document.getElementsByClassName("step")[currentTab].className += " finish";
            }
            return valid; // return the valid status
        }

        function fixStepIndicator(n) {
            // This function removes the "active" class of all steps...
            var i, x = document.getElementsByClassName("step");
            for (i = 0; i < x.length; i++) {
                x[i].className = x[i].className.replace(" active", "");
            }
            //... and adds the "active" class on the current step:
            x[n].className += " active";
        }
    </script>
</body>
@endsection
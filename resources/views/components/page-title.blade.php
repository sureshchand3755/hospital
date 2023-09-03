<div class="row">
    @if(Route::is(['activities','add-invoice','attendance','blank-page','blog-details',
    'compose','create-invoice','edit-profile','form-basic-inputs','form-horizontal','form-input-groups','form-vertical','gallery',
    'inbox','mail-view','payments','tables-basic','tables-datatables','tabs','typography']))
    <div class="col-sm-12">
    @endif   
    @if(!Route::is(['activities','add-invoice','add-invoice','edit-invoice','appointments','assests','attendance','blank-page',
    'blog-details','blog','calendar','compose','create-invoice','departments','doctor','edit-profile','form-basic-inputs','form-horizontal',
    'form-input-groups','form-vertical','gallery','holidays','inbox','leave-type','leaves','mail-view','patients','payments',
    'profile','provident-fund','roles-permissions','salary-view','salary','schedule','tables-basic','tables-datatables','tabs','taxes','typography']))
    <div class="col-lg-8 offset-lg-2">
    @endif
    @if(Route::is(['appointments','doctor','patients','schedule']))
    <div class="col-sm-4 col-3">
    @endif
    @if(Route::is(['assests','taxes']))
    <div class="col-sm-8 col-6">
    @endif  
    @if(Route::is(['blog','calendar'])) 
    <div class="col-sm-8 col-4">
    @endif   
    @if(Route::is(['departments','holidays']))
    <div class="col-sm-5 col-5">  
    @endif 
    @if(Route::is(['leave-type']))  
    <div class="col-sm-8 col-5"> 
    @endif  
    @if(Route::is(['leaves'])) 
    <div class="col-sm-8 col-6"> 
    @endif  
    @if(Route::is(['profile']))
    <div class="col-sm-7 col-6">
    @endif  
    @if(Route::is(['provident-fund','salary-view']))
    <div class="col-sm-5 col-4">
    @endif  
    @if(Route::is(['roles-permissions']))
    <div class="col-sm-8">
    @endif 
    @if(Route::is(['salary']))
    <div class="col-sm-4 col-5">
    @endif 
        <h4 class="page-title">{{ $li_1 }}</h4>
    </div>
    @if(Route::is(['salary']))
    <div class="col-sm-8 col-7 text-end m-b-30">
        <a href="{{url('add-salary')}}" class="btn btn-primary btn-rounded float-end"><i class="fa fa-plus"></i> Add Salary</a>
    </div>
    @endif 
    @if(Route::is(['taxes']))
    <div class="col-sm-4 col-6 text-end m-b-30">
        <a href="{{url('add-tax')}}" class="btn btn-primary btn-rounded"><i class="fa fa-plus"></i> Add Tax</a>
    </div>
    @endif 
    @if(Route::is(['schedule']))
    <div class="col-sm-8 col-9 text-right m-b-20">
        <a href="{{url('add-schedule')}}" class="btn btn btn-primary btn-rounded float-end"><i class="fa fa-plus"></i> Add Schedule</a>
    </div>
    @endif 
    @if(Route::is(['salary-view']))
    <div class="col-sm-7 col-8 text-end m-b-30">
        <div class="btn-group btn-group-sm">
            <button class="btn btn-white">CSV</button>
            <button class="btn btn-white">PDF</button>
            <button class="btn btn-white"><i class="fa fa-print fa-lg"></i> Print</button>
        </div>
    </div>
    @endif 
    @if(Route::is(['profile']))
    <div class="col-sm-5 col-6 text-end m-b-30">
        <a href="{{url('edit-profile')}}" class="btn btn-primary btn-rounded"><i class="fa fa-plus"></i> Edit Profile</a>
    </div>
    @endif
    @if(Route::is(['provident-fund']))
    <div class="col-sm-7 col-8 text-end m-b-30">
        <a href="{{url('add-provident-fund')}}" class="btn btn-primary btn-rounded"><i class="fa fa-plus"></i> Add Provident Fund</a>
    </div>
    @endif
    @if(Route::is(['leaves'])) 
    <div class="col-sm-4 col-6 text-end m-b-30">
        <a href="{{url('add-leave')}}" class="btn btn-primary btn-rounded float-end"><i class="fa fa-plus"></i> Add Leave</a>
    </div>
    @endif 
    @if(Route::is(['patients']))
    <div class="col-sm-8 col-9 text-end m-b-20">
        <a href="{{url('add-patients')}}" class="btn btn btn-primary btn-rounded float-end"><i class="fa fa-plus"></i> Add Patient</a>
    </div>
    @endif
    @if(Route::is(['leave-type'])) 
    <div class="col-sm-4 col-7 text-end m-b-30">
        <a href="{{url('add-leave-type')}}" class="btn btn-primary btn-rounded float-end"><i class="fa fa-plus"></i> Add Leave Type</a>
    </div>
    @endif
    @if(Route::is(['appointments']))
    <div class="col-sm-8 col-9 text-end m-b-20">
        <a href="{{url('add-appointments')}}" class="btn btn btn-primary btn-rounded float-end"><i class="fa fa-plus"></i> Add Appointment</a>
    </div>
    @endif
    @if(Route::is(['assests']))
    <div class="col-sm-4 col-6 text-end m-b-30">
        <a href="{{url('add-assest')}}" class="btn btn-primary btn-rounded float-end"><i class="fa fa-plus"></i> Add Asset</a>
    </div>
    @endif
    @if(Route::is(['blog']))
    <div class="col-sm-4 col-8 text-end m-b-30">
        <a class="btn btn-primary btn-rounded float-end" href="{{url('add-blog')}}"><i class="fa fa-plus"></i> Add Blog</a>
    </div>
    @endif
    @if(Route::is(['calendar']))
    <div class="col-sm-4 col-8 text-end m-b-30">
        <a href="#" class="btn btn-primary btn-rounded" data-bs-toggle="modal" data-bs-target="#add_event"><i class="fa fa-plus"></i> Add Event</a>
    </div>
    @endif
    @if(Route::is(['departments']))
    <div class="col-sm-7 col-7 text-end m-b-30">
        <a href="{{url('add-departments')}}" class="btn btn-primary btn-rounded"><i class="fa fa-plus"></i> Add Department</a>
    </div>
    @endif
    @if(Route::is(['holidays']))
    <div class="col-sm-7 col-7 text-end m-b-30">
        <a href="{{url('add-holiday')}}" class="btn btn-primary btn-rounded"><i class="fa fa-plus"></i> Add Holiday</a>
    </div>
    @endif
    @if(Route::is(['doctor']))
    <div class="col-sm-8 col-9 text-end m-b-20">
        <a href="add-doctor" class="btn btn-primary btn-rounded float-end"><i class="fa fa-plus"></i> Add Doctor</a>
    </div>
    @endif
</div>

        
 

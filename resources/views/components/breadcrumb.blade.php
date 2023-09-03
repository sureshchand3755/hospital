@if(Route::is(['add-invoice','edit-invoice']))
    
    <div class="page-header invoices-page-header">
        <div class="row align-items-center">
            <div class="col">
                <ul class="breadcrumb invoices-breadcrumb">
                    <li class="breadcrumb-item invoices-breadcrumb-item">
                        <a href="{{url('invoices')}}">
                            <i class="fas fa-chevron-left"></i> Back to Invoice List
                        </a>
                    </li>
                </ul>
            </div>
            <div class="col-auto">
                <div class="invoices-create-btn">
                    <a class="invoices-preview-link" href="#" data-bs-toggle="modal" data-bs-target="#invoices_preview"><i class="fas fa-eye"></i> Preview</a>
                    <a  href="#" data-bs-toggle="modal" data-bs-target="#delete_invoices_details" class="btn delete-invoice-btn">
                        Delete Invoice
                    </a>
                    <a href="#" data-bs-toggle="modal" data-bs-target="#save_invocies_details" class="btn save-invoice-btn">
                        Save Draft
                    </a>
                </div>
            </div>
        </div>
    </div>
    
    @endif

    @if(Route::is(['bank-settings','invoices-settings','tax-settings']))
    
    <div class="page-header">
        <div class="row">
            <div class="col-sm-6">
                <h3 class="page-title">{{ $title }}</h3>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{url('index')}}">{{ $li_1 }}</a>
                    </li>
                    <li class="breadcrumb-item active">{{ $li_2 }}</li>
                </ul>
            </div>
        </div>
    </div>
    
    @endif
    @if(Route::is(['social-links','settings','localization','email-settings','leave-type','payment-settings','social-settings','social-links','seo-settings','others-settings','change-password']))
    <div class="page-header">
        <div class="row">
            <div class="col-sm-6">
                <h3 class="page-title">{{ $title }}</h3>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{url('index')}}">{{ $li_1 }}</a></li>
                    <li class="breadcrumb-item"><a href="{{url('settings')}}">{{ $li_2 }}</a></li>
                    <li class="breadcrumb-item active">{{ $li_3 }}</li>
                </ul>
            </div>
        </div>
    </div>
    @endif
    @if(Route::is(['invoice-grid','invoices']))
    <div class="page-header">
    <div class="row align-items-center">
        <div class="col">
            <h3 class="page-title">{{ $title }}</h3>
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('index')}}">{{ $li_1 }}</a></li>
                <li class="breadcrumb-item active">{{ $li_2 }}</li>
            </ul>
        </div>
        <div class="col-auto">
            <a href="{{url('invoices')}}" class="invoices-links">
                <i class="feather feather-list"></i>
            </a>
            <a href="{{url('invoice-grid')}}" class="invoices-links active">
                <i class="feather feather-grid"></i>
            </a>
        </div>
    </div>
    </div>
    @endif
    @if(Route::is(['invoices-paid','invoices-overdue','invoices-cancelled','invoices-draft','invoices-recurring']))
    <div class="page-header">
    <div class="row align-items-center">
        <div class="col">
            <h3 class="page-title">{{ $title }}</h3>
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('index')}}">{{ $li_1 }}</a></li>
                <li class="breadcrumb-item"><a href="{{url('invoices')}}">{{ $li_2 }}</a></li>
                <li class="breadcrumb-item active">{{ $li_3 }}</li>
            </ul>
        </div>
        <div class="col-auto">
            <a href="{{url('invoices')}}" class="invoices-links active">
                <i class="feather feather-list"></i>
            </a>
            <a href="{{url('invoice-grid')}}" class="invoices-links">
                <i class="feather feather-grid"></i>
            </a>
        </div>
    </div>
    </div>
    @endif

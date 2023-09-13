<div class="main-wrapper">
    <div class="sidebar" id="sidebar">
        <div class="sidebar-inner slimscroll">
            <div id="sidebar-menu" class="sidebar-menu">
                <ul id="navi">
                    <li class="menu-title">Main</li>
                    @if (Auth::user()->type==0)
                        <li class="{{ Request::is('reception/dashboard') ? 'active' : '' }}">
                            <a href="{{ url('reception/dashboard') }}"><span class="menu-side"><img src="{{ URL::asset('/assets/img/icons/menu-icon-01.svg')}}" alt=""></span> <span> Dashboard </span></a>
                        </li>
                        <li class="{{ Request::is('patient/appointments','appointment/add','appointment/edit/1') ? 'active' : '' }}">
                            <a href="{{ url('patient/appointments') }}"><span class="menu-side"><img src="{{ URL::asset('/assets/img/icons/menu-icon-03.svg')}}" alt=""></span> <span> OP Bookings </span></a>
                        </li>
                    @elseif (Auth::user()->type==1)
                        <li class="{{ Request::is('doctor/dashboard') ? 'active' : '' }}">
                            <a href="{{ url('doctor/dashboard') }}"><span class="menu-side"><img src="{{ URL::asset('/assets/img/icons/menu-icon-01.svg')}}" alt=""></span> <span> Dashboard </span></a>
                        </li>
                        <li class="{{ Request::is('appointments','doctor/appointment/edit/*') ? 'active' : '' }}">
                            <a href="{{ url('appointments') }}"><span class="menu-side"><img src="{{ URL::asset('/assets/img/icons/menu-icon-03.svg')}}" alt=""></span> <span> OP Booking List </span></a>
                        </li>

                    @elseif (Auth::user()->type==2)
                        <li class="{{ Request::is('hospital/dashboard') ? 'active' : '' }}">
                            <a href="{{ url('hospital/dashboard') }}"><span class="menu-side"><img src="{{ URL::asset('/assets/img/icons/menu-icon-01.svg')}}" alt=""></span> <span> Dashboard </span></a>
                        </li>
                        <li  class="{{ Request::is('doctors','edit-doctor','doctor/add') ? 'active' : '' }}">
                            <a href="{{ url('doctors') }}"><span class="menu-side"><img src="{{ URL::asset('/assets/img/icons/menu-icon-02.svg')}}" alt=""></span> <span> Doctors </span></a>
                        </li>
                        <li class="{{ Request::is('departments','edit-department','add-departments') ? 'active' : '' }}">
                            <a href="{{ url('departments') }}"><span class="menu-side"><img src="{{ URL::asset('/assets/img/icons/menu-icon-06.svg')}}" alt=""></span> <span> Departments </span></a>
                        </li>
                    @elseif (Auth::user()->type==3)
                        <li class="{{ Request::is('admin/dashboard') ? 'active' : '' }}">
                            <a href="{{ url('admin/dashboard') }}"><span class="menu-side"><img src="{{ URL::asset('/assets/img/icons/menu-icon-01.svg')}}" alt=""></span> <span> Dashboard </span></a>
                        </li>
                        <li class="{{ Request::is('admin/patient/appointments','admin/appointment/add','appointment/edit/1') ? 'active' : '' }}">
                            <a href="{{ url('admin/patient/appointments') }}"><span class="menu-side"><img src="{{ URL::asset('/assets/img/icons/menu-icon-03.svg')}}" alt=""></span> <span> OP Bookings </span></a>
                        </li>
                        <li  class="{{ Request::is('admin/doctors','edit-doctor','doctor/add') ? 'active' : '' }}">
                            <a href="{{ url('admin/doctors') }}"><span class="menu-side"><img src="{{ URL::asset('/assets/img/icons/menu-icon-02.svg')}}" alt=""></span> <span> Doctors </span></a>
                        </li>
                        <li class="{{ Request::is('admin/departments','edit-department','add-departments') ? 'active' : '' }}">
                            <a href="{{ url('admin/departments') }}"><span class="menu-side"><img src="{{ URL::asset('/assets/img/icons/menu-icon-06.svg')}}" alt=""></span> <span> Departments </span></a>
                        </li>
                        {{-- <li class="{{ Request::is('departments','edit-department','add-departments') ? 'active' : '' }}">
                            <a href="{{ url('departments') }}"><span class="menu-side"><img src="{{ URL::asset('/assets/img/icons/menu-icon-06.svg')}}" alt=""></span> <span> Hospitals </span></a>
                        </li> --}}

                    {{-- <li class="{{ Request::is('index') ? 'active' : '' }}">
                        <a href="{{ url('index') }}"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a>
                    </li>
                    <li class="{{ Request::is('doctor','add-doctor','edit-doctor') ? 'active' : '' }}">
                        <a href="{{ url('doctor') }}"><i class="fa fa-user-md"></i><span> Doctors</span></a>
                    </li>

                    <li class="{{ Request::is('patients','add-patients','edit-patient') ? 'active' : '' }}">
                        <a href="{{ url('patients') }}"><i class="fa fa-wheelchair"></i> <span> Patients</span></a>
                    </li>
                    <li class="{{ Request::is('appointments','add-appointments','edit-appointment') ? 'active' : '' }}">
                        <a href="{{ url('appointments') }}"><i class="fa fa-calendar"></i><span>Appointments</span></a>
                    </li>
                    <li class="{{ Request::is('schedule','add-schedule','edit-schedule','schedule') ? 'active' : '' }}">
                        <a href="{{ url('schedule') }}"><i class="fa fa-calendar-check-o"></i><span>Doctor Schedule</span></a>
                    </li>
                    <li class="{{ Request::is('departments','edit-department','add-departments') ? 'active' : '' }}">
                        <a href="{{ url('departments') }}"><i class="fa fa-hospital-o"></i><span>Departments</span></a>
                    </li>

					<li class="submenu">
						<a class="{{ Request::is('employees','leaves','leave-type','holidays','attendance','add-employee','add-holiday','add-leave','edit-holiday','edit-leave','edit-leave-type','add-leave-type') ? 'active' : '' }}" href="#"><i class="fa fa-user"></i> <span> Employees </span> <span class="menu-arrow"></span></a>
						<ul style="display: none;">
							<li class="{{ Request::is('employees','add-employee') ? 'active' : '' }}"><a href="{{url('employees')}}">Employees List</a></li>
							<li class="{{ Request::is('leaves','add-leave','edit-leave','edit-leave-type','add-leave-type','leave-type') ? 'active' : '' }}"><a href="{{url('leaves')}}">Leaves</a></li>
							<li class="{{ Request::is('holidays','add-holiday','edit-holiday') ? 'active' : '' }}"><a href="{{url('holidays')}}" >Holidays</a></li>
							<li class="{{ Request::is('attendance') ? 'active' : '' }}"><a href="{{url('attendance')}}" >Attendance</a></li>
						</ul>
					</li>
					<li class="submenu">
						<a class="{{ Request::is('payments','expenses','taxes','add-expense','provident-fund','add-provident-fund','add-tax','edit-tax','edit-expense','edit-provident-fund') ? 'active' : '' }}" href="#"><i class="fa fa-money"></i> <span> Accounts </span> <span class="menu-arrow"></span></a>
						<ul style="display: none;">
							<li class="{{ Request::is('payments') ? 'active' : '' }}"><a href="{{url('payments')}}">Payments</a></li>
							<li class="{{ Request::is('expenses','edit-expense','add-expense') ? 'active' : '' }}"><a href="{{url('expenses')}}">Expenses</a></li>
							<li class="{{ Request::is('taxes','add-tax','edit-tax') ? 'active' : '' }}"><a href="{{url('taxes')}}">Taxes</a></li>
							<li class="{{ Request::is('provident-fund','add-provident-fund','edit-provident-fund') ? 'active' : '' }}"><a href="{{url('provident-fund')}}">Provident Fund</a></li>
						</ul>
					</li>
                    <li class="submenu">
                        <a class="{{ Request::is('invoices','invoices-paid','invoices-overdue','invoices-draft','invoices-recurring','invoices-cancelled','invoice-grid','add-invoice','edit-invoice','view-invoice','invoices-settings','create-invoice') ? 'active' : '' }}" href="{{ url('invoices')}}"><i class="fas fa-clipboard"></i> <span> Invoices</span>
                            <span class="menu-arrow"></span>
                        </a>
                        <ul>
                            <li><a class=" {{ Request::is('invoices','invoices-paid','invoices-overdue','invoices-draft','invoices-recurring','invoices-cancelled','create-invoice') ? 'active' : '' }}" href="{{ url('invoices')}}">Invoices List</a></li>
                            <li><a class=" {{ Request::is('invoice-grid') ? 'active' : '' }}" href="{{ url('invoice-grid')}}">Invoices Grid</a></li>
                            <li><a class=" {{ Request::is('add-invoice') ? 'active' : '' }}" href="{{ url('add-invoice')}}">Add Invoices</a></li>
                            <li><a class=" {{ Request::is('edit-invoice') ? 'active' : '' }}" href="{{ url('edit-invoice')}}">Edit Invoices</a></li>
                            <li><a class=" {{ Request::is('view-invoice') ? 'active' : '' }}" href="{{ url('view-invoice')}}">Invoices Details</a></li>
                            <li><a class=" {{ Request::is('invoices-settings','tax-settings','bank-settings') ? 'active' : '' }}" href="{{ url('invoices-settings')}}">Invoices Settings</a></li>
                        </ul>
                    </li>
					<li class="submenu">
						<a class="{{ Request::is('salary','salary-view','add-salary','edit-salary') ? 'active' : '' }}" href="#"><i class="fa fa-book"></i> <span> Payroll </span> <span class="menu-arrow"></span></a>
						<ul style="display: none;">
							<li class="{{ Request::is('salary','add-salary','edit-salary') ? 'active' : '' }}"><a href="{{url('salary')}}"> Employee Salary </a></li>
							<li class="{{ Request::is('salary-view') ? 'active' : '' }}"><a href="{{url('salary-view')}}"> Payslip </a></li>
						</ul>
					</li>
                    <li class="{{ Request::is('chat') ? 'active' : '' }}">
                        <a href="{{url('chat')}}"><i class="fa fa-comments"></i> <span>Chat</span> <span class="badge rounded-pill bg-primary float-end">5</span></a>
                    </li>
                    <li class="submenu">
                        <a class="{{ Request::is('voice-call','video-call','incoming-call') ? 'active' : '' }}" href="#"><i class="fa fa-video-camera camera"></i> <span> Calls</span> <span class="menu-arrow"></span></a>
                        <ul style="display: none;">
                            <li class="{{ Request::is('voice-call') ? 'active' : '' }}"><a href="{{url('voice-call')}}">Voice Call</a></li>
                            <li class="{{ Request::is('video-call') ? 'active' : '' }}"><a href="{{url('video-call')}}">Video Call</a></li>
                            <li class="{{ Request::is('incoming-call') ? 'active' : '' }}"><a href="{{url('incoming-call')}}">Incoming Call</a></li>
                        </ul>
                    </li>
                    <li class="submenu">
                        <a class="{{ Request::is('compose','inbox','mail-view') ? 'active' : '' }}" href="#"><i class="fa fa-envelope"></i> <span> Email</span> <span class="menu-arrow"></span></a>
                        <ul style="display: none;">
                            <li class="{{ Request::is('compose') ? 'active' : '' }}"><a href="{{url('compose')}}">Compose Mail</a></li>
                            <li class="{{ Request::is('inbox') ? 'active' : '' }}"><a href="{{url('inbox')}}">Inbox</a></li>
                            <li class="{{ Request::is('mail-view') ? 'active' : '' }}"><a href="{{url('mail-view')}}">Mail View</a></li>
                        </ul>
                    </li>
                    <li class="submenu">
                        <a class="{{ Request::is('blog','blog-details','add-blog','edit-blog') ? 'active' : '' }}" href="#"><i class="fa fa-commenting-o"></i> <span> Blog</span> <span class="menu-arrow"></span></a>
                        <ul style="display: none;">
                            <li class="{{ Request::is('blog') ? 'active' : '' }}"><a href="{{url('blog')}}">Blog</a></li>
                            <li class="{{ Request::is('blog-details') ? 'active' : '' }}"><a href="{{url('blog-details')}}">Blog View</a></li>
                            <li class="{{ Request::is('add-blog') ? 'active' : '' }}"><a href="{{url('add-blog')}}">Add Blog</a></li>
                            <li class="{{ Request::is('edit-blog') ? 'active' : '' }}"><a href="{{url('edit-blog')}}">Edit Blog</a></li>
                        </ul>
                    </li>
					<li class="{{ Request::is('assests','add-assest') ? 'active' : '' }}">
						<a href="{{url('assests')}}"><i class="fa fa-cube"></i> <span>Assets</span></a>
					</li>
					<li class="{{ Request::is('activities') ? 'active' : '' }}">
						<a href="{{url('activities')}}"><i class="fa fa-bell-o"></i> <span>Activities</span></a>
					</li>
					<li class="submenu">
						<a class="{{ Request::is('expense-report','invoice-reports') ? 'active' : '' }}" href="#"><i class="fa fa-flag-o"></i> <span> Reports </span> <span class="menu-arrow"></span></a>
						<ul style="display: none;">
							<li class="{{ Request::is('expense-report') ? 'active' : '' }}"><a href="{{url('expense-report')}}"> Expense Report </a></li>
							<li class="{{ Request::is('invoice-reports') ? 'active' : '' }}"><a href="{{url('invoice-reports')}}"> Invoice Report </a></li>
						</ul>
					</li>
                    <li class="{{ Request::is('settings','localization','payment-settings','email-settings','social-settings','social-links','seo-settings','others-settings') ? 'active' : '' }}">
                        <a href="{{ url('settings') }}"><i class="fas fa-cog"></i> <span> Settings</span>
                        </a>
                    </li>
                    <li class="menu-title">UI Elements</li>
                    <li class="submenu">
                        <a class="{{ Request::is('uikit','typography','tabs') ? 'active' : '' }}" href="#"><i class="fa fa-laptop"></i> <span> Components</span> <span class="menu-arrow"></span></a>
                        <ul style="display: none;">
                            <li class="{{ Request::is('uikit') ? 'active' : '' }}"><a href="{{url('uikit')}}">UI Kit</a></li>
                            <li class="{{ Request::is('typography') ? 'active' : '' }}"><a href="{{url('typography')}}">Typography</a></li>
                            <li class="{{ Request::is('tabs') ? 'active' : '' }}"><a href="{{url('tabs')}}">Tabs</a></li>
                        </ul>
                    </li>
                    <li class="submenu">
                        <a class="{{ Request::is('form-basic-inputs','form-input-groups','form-horizontal','form-vertical') ? 'active' : '' }}" href="#"><i class="fa fa-edit"></i> <span> Forms</span> <span class="menu-arrow"></span></a>
                        <ul style="display: none;">
                            <li class="{{ Request::is('form-basic-inputs') ? 'active' : '' }}"><a href="{{url('form-basic-inputs')}}">Basic Inputs</a></li>
                            <li class="{{ Request::is('form-input-groups') ? 'active' : '' }}"><a href="{{url('form-input-groups')}}">Input Groups</a></li>
                            <li class="{{ Request::is('form-horizontal') ? 'active' : '' }}"><a href="{{url('form-horizontal')}}">Horizontal Form</a></li>
                            <li class="{{ Request::is('form-vertical') ? 'active' : '' }}"><a href="{{url('form-vertical')}}">Vertical Form</a></li>
                        </ul>
                    </li>
                    <li class="submenu">
                        <a class="{{ Request::is('tables-basic','tables-datatables') ? 'active' : '' }}" href="#"><i class="fa fa-table"></i> <span> Tables</span> <span class="menu-arrow"></span></a>
                        <ul style="display: none;">
                            <li class="{{ Request::is('tables-basic') ? 'active' : '' }}"><a href="{{url('tables-basic')}}">Basic Tables</a></li>
                            <li class="{{ Request::is('tables-datatables') ? 'active' : '' }}"><a href="{{url('tables-datatables')}}">Data Table</a></li>
                        </ul>
                    </li>


                    <li class="{{ Request::is('calendar') ? 'active' : '' }}">
                        <a href="{{ url('calendar') }}"><i class="fa fa-calendar"></i><span> Calendar</span></a>
                    </li>


                    <li class="menu-title">Extras</li>
                    <li class="submenu">
                        <a class="{{ Request::is('login','register','forgot-password','change-password2','lock-screen','profile','edit-profile','gallery','error-404','error-500','blank-page') ? 'active' : '' }}" href="#"><i class="fa fa-columns"></i> <span>Pages</span> <span class="menu-arrow"></span></a>
                        <ul style="display: none;">
                            <li class="{{ Request::is('login') ? 'active' : '' }}"><a href="{{url('login')}}"> Login </a></li>
                            <li class="{{ Request::is('register') ? 'active' : '' }}"><a href="{{url('register')}}"> Register </a></li>
                            <li class="{{ Request::is('forgot-password') ? 'active' : '' }}"><a href="{{url('forgot-password')}}"> Forgot Password </a></li>
                            <li class="{{ Request::is('change-password2') ? 'active' : '' }}"><a href="{{url('change-password2')}}"> Change Password </a></li>
                            <li class="{{ Request::is('lock-screen') ? 'active' : '' }}"><a href="{{url('lock-screen')}}"> Lock Screen </a></li>
                            <li class="{{ Request::is('profile','edit-profile') ? 'active' : '' }}"><a href="{{url('profile')}}"> Profile </a></li>
                            <li class="{{ Request::is('gallery') ? 'active' : '' }}"><a href="{{url('gallery')}}"> Gallery </a></li>
                            <li class="{{ Request::is('error-404') ? 'active' : '' }}"><a href="{{url('error-404')}}">404 Error </a></li>
                            <li class="{{ Request::is('error-500') ? 'active' : '' }}"><a href="{{url('error-500')}}">500 Error </a></li>
                            <li class="{{ Request::is('blank-page') ? 'active' : '' }}"><a href="{{url('blank-page')}}"> Blank Page </a></li>
                        </ul>
                    </li>
                    <li class="submenu">
                        <a href="javascript:void(0);"><i class="fa fa-share-alt"></i> <span>Multi Level</span> <span class="menu-arrow"></span></a>
                        <ul style="display: none;">
                            <li class="submenu">
                                <a href="javascript:void(0);"><span>Level 1</span> <span class="menu-arrow"></span></a>
                                <ul style="display: none;">
                                    <li><a href="javascript:void(0);"><span>Level 2</span></a></li>
                                    <li class="submenu">
                                        <a href="javascript:void(0);"> <span> Level 2</span> <span class="menu-arrow"></span></a>
                                        <ul style="display: none;">
                                            <li><a href="javascript:void(0);">Level 3</a></li>
                                            <li><a href="javascript:void(0);">Level 3</a></li>
                                        </ul>
                                    </li>
                                    <li><a href="javascript:void(0);"><span>Level 2</span></a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="javascript:void(0);"><span>Level 1</span></a>
                            </li>
                        </ul>
                    </li> --}}
                    @endif
                </ul>
                <div class="logout-btn">
                    <a href="{{url('logout')}}"><span class="menu-side"><img src="{{ URL::asset('/assets/img/icons/logout.svg')}}" alt=""></span> <span>Logout</span></a>
                </div>
            </div>
        </div>
    </div>

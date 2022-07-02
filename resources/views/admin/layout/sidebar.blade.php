<div id="wrapper">
    <nav class="navbar-default navbar-static-side" role="navigation">
        <div class="sidebar-collapse">
            <ul class="nav metismenu" id="side-menu">
                <li class="nav-header">
                    <div class="dropdown profile-element"> <span>
                        <img alt="image" class="img-circle" src="{{asset('dist/img/icon.jpg')}}" />
                             </span>
                             <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                             <span class="clear"> <span class="block m-t-xs"> <strong class="font-bold">{{Auth()->user()->username}}</strong>
                             </span> <span class="text-muted text-xs block">Administrator <b class="caret"></b></span> </span> </a>
                        <ul class="dropdown-menu animated fadeInRight m-t-xs">
                            <li><a href="#">Profile</a></li>
                            <li><a href="#">Contacts</a></li>

                            <li class="divider"></li>
                            <li><a href="{{route('logout')}}">Logout</a></li>
                        </ul>
                    </div>
                    <div class="logo-element">
                        <img alt="image" class="img-circle" src="{{asset('dist/img/icon.jpg')}}" />
                    </div>
                </li>
                {{-- <li class="active">
                    <a href="#"><i class="fa fa-th-large"></i> <span class="nav-label">User Management</span> <span class="fas fa-arrow-circle-right"></span></a>
                    <ul class="nav nav-second-level collapse">
                        <li><a href="{{route('admin.user.profile')}}">User Profile</a></li>
                        <li><a href="#">Remove User</a></li>
                    </ul>
                </li> --}}
                {{-- <li>
                    <a href="#"><i class="fa fa-sitemap"></i> <span class="nav-label">Account Management</span><span class="fas fa-arrow-circle-right"></span></a>
                    <ul class="nav nav-second-level collapse">
                        <li><a href="graph_flot.html">Account Head</a></li>
                        <li><a href="graph_morris.html">Account Group</a></li>
                        <li><a href="graph_rickshaw.html">Account Subgroup</a></li>

                    </ul>
                </li> --}}
                <li>
                    <a href="#"><i class="fa fa-sitemap"></i> <span class="nav-label">Member </span><span class="fas fa-arrow-circle-right"></span></a>
                    <ul class="nav nav-second-level collapse">
                        <li><a href="{{route('admin.member')}}">List</a></li>
                        <li><a href="{{route('admin.member.add')}}">New Member</a></li>
                        <li><a href="{{route('admin.member.LoWise')}}">Members per LO</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#"><i class="fa fa-sitemap"></i> <span class="nav-label">Account </span><span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level collapse">
                        <li>
                            <a href="#">Daily Deposit <span class="fa arrow"></span></a>
                            <ul class="nav nav-third-level">
                                <li>
                                    <a href="{{route('admin.account.ddcollection')}}">Collection</a>
                                </li>
                                <li>
                                <a href="{{route('admin.account.ddaccount')}}">New Account</a>
                                </li>
                                <li>
                                    <a href="{{route('admin.account.ddlist')}}">List Account</a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                     <ul class="nav nav-second-level collapse">
                        <li>
                            <a href="{{route('admin.account.withdraw')}}">Withdrawal<span class="fa arrow"></span></a>
                        </li>
                        <li>
                            <a href="{{route('admin.account.passbook')}}">Passbook<span class="fa arrow"></span></a>
                        </li>
                    </ul>

                    <ul class="nav nav-second-level collapse">
                        <li>
                            <a href="#">Monthly Deposit <span class="fa arrow"></span></a>
                            <ul class="nav nav-third-level">
                                <li>
                                    <a href="{{route('admin.account.mdcollection')}}">Collection</a>
                                </li>
                                <li>
                                    <a href="{{route('admin.account.mdaccount')}}">New Account</a>
                                </li>
                                <li>
                                    <a href="{{route('admin.account.mdlist')}}">List Account</a>
                                </li>

                            </ul>
                        </li>
                        {{-- <li><a href="#">Second Level Item</a></li>
                        <li>
                            <a href="#">Second Level Item</a></li>
                        <li>
                            <a href="#">Second Level Item</a></li> --}}
                    </ul>
                </li>

                <li>
                    <a href="{{route('admin.new_user')}}"><i class="fa fa-sitemap"></i> <span class="nav-label">New User </span></a>
                </li>
                <li>
                    <a href="#"><i class="fa fa-sitemap"></i> <span class="nav-label">Loan</span>&nbsp;<span class="fas fa-arrow-circle-right"></span></a>
                    <ul class="nav nav-second-level collapse">
                        <li><a href="{{route('admin.AccountholderList')}}">Account Holder List</a></li>
                        <li><a href="{{route('admin.ApplicantList')}}">Loan Applicants List</a></li>
                        <li><a href="{{route('admin.Activeloans')}}">Loan Collect</a></li>
                        <li><a href="{{route('admin.loan_calculator')}}">Loan Calculator</a></li>
                    </ul>
                </li>

                {{-- <li>
                    <a href="#"><i class="fa fa-sitemap"></i> <span class="nav-label">Payroll</span><span class="fas fa-arrow-circle-right"></span></a>
                    <ul class="nav nav-second-level collapse">
                        <li><a href="{{route('admin.Payroll')}}">Add Employee Details</a></li>
                    </ul>
                    <ul class="nav nav-second-level collapse">
                        <li><a href="{{route('admin.employeelist')}}">Employee list</a></li>
                    </ul>
                    <ul class="nav nav-second-level collapse">
                        <li><a href="{{route('admin.salaryhead')}}">Salary Head</a></li>
                    </ul>
                    <ul class="nav nav-second-level collapse">
                        <li><a href="{{route('admin.Psalary')}}">Provide Salary Head</a></li>
                    </ul>
                    <ul class="nav nav-second-level collapse">
                        <li><a href="{{route('admin.SalaryProcess')}}">Salary Processing</a></li>
                    </ul>
                </li> --}}
                <li>
                    <a href="#"><i class="fa fa-sitemap"></i> <span class="nav-label">Share </span><span class="fas fa-arrow-circle-right"></span></a>
                    <ul class="nav nav-second-level collapse">
                        <li><a href="{{route('admin.share.extrashare')}}">Extra Share Purchase</a></li>
                        <li><a href="{{route('admin.share.sharetrans')}}">Share Transter</a></li>
                    </ul>
                </li>

                <li>
                    <a href="#"><i class="fa fa-sitemap"></i> <span class="nav-label">Payroll</span>&nbsp;<span class="fas fa-arrow-circle-right"></span></a>
                    <ul class="nav nav-second-level collapse">
                        <li>
                            <a href="#">Employee <span class="fa arrow"></span></a>
                            <ul class="nav nav-third-level">
                                <li>
                                    <a href="{{route('admin.Payroll')}}">Add Employee Details</a>
                                </li>
                                <li>
                                    <a href="{{route('admin.employeelist')}}">Employee list</a>
                                </li>
                                <li>
                                    <a href="{{route('admin.Attendence')}}">Employee Attendence</a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                    <ul class="nav nav-second-level collapse">
                        <li>
                            <a href="#">Salary <span class="fa arrow"></span></a>
                            <ul class="nav nav-third-level">
                                <li>
                                    <a href="{{route('admin.salaryhead')}}">Salary Head</a>
                                </li>
                                <li>
                                    <a href="{{route('admin.Psalary')}}">Assign Salary Head</a>
                                </li>
                                <li>
                                    {{-- <a href="{{route('admin.SalaryProcess')}}">Salary Processing Temp </a> --}}
                                </li>
                                <li>
                                    <a href="{{route('admin.SalaryProcessF')}}">Salary Processing</a>
                                </li>
                                <li>
                                    <a href="{{route('admin.PaySlip')}}">Pay Slip</a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </li>
                <li>
                <a href="{{route('admin.collection.index')}}"><i class="fas fa-hand-holding-usd"></i> <span class="nav-label">Dta Transfer </span></a>
                </li>
                <li>
                    <a href="#"><i class="fa fa-sitemap"></i> <span class="nav-label">Reports</span>&nbsp;<span class="fas fa-arrow-circle-right"></span></a>
                    {{-- <ul class="nav nav-second-level collapse">
                        <li><a href="{{route('admin.Shares')}}">Share Holder List</a></li>
                    </ul> --}}
                    <ul class="nav nav-second-level collapse">
                        <li>
                            <a href="#">General Report <span class="fa arrow"></span></a>
                            <ul class="nav nav-third-level">
                                <li>
                                    <a href="{{route('admin.Shares')}}">Share Holder List</a>
                                </li>
                                <li>
                                    <a href="{{route('admin.loanreports')}}">All Loan Reports</a>
                                </li>
                                <li>
                                    <a href="{{route('admin.ylyintreport')}}">Yearly Interest Report</a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                    <ul class="nav nav-second-level collapse">
                        <li>
                            <a href="#">LO Report <span class="fa arrow"></span></a>
                            <ul class="nav nav-third-level">
                                <li>
                                    <a href="{{route('admin.lowiseloan')}}">Lo wise Loan Collection</a>
                                </li>
                                <li>
                                    <a href="{{route('admin.lowisedeposit')}}">Lo wise Deopsit</a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                    {{-- <ul class="nav nav-second-level collapse">
                        <li><a href="{{route('admin.Details')}}">Member Details</a></li>
                    </ul> --}}
                </li>
                <li>
                    <a href="#"><i class="fa fa-sitemap"></i> <span class="nav-label">Voucher Entry</span><span class="fas fa-arrow-circle-right"></span></a>
                    <ul class="nav nav-second-level collapse">
                        <li><a href='{{route('admin.accounts.cash_voucher')}}'>Cash Voucher</a></li>
                        <li><a href='{{route('admin.accounts.bank_voucher')}}'>Bank Voucher</a></li>
                        <li><a href='{{route('admin.accounts.journal_entry')}}'>Journal Entry</a></li>
                        <li><a href='{{route('admin.accounts.contra_entry')}}'>Contra Entry</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#"><i class="fa fa-sitemap"></i> <span class="nav-label">Ledger </span><span class="fas fa-arrow-circle-right"></span></a>
                    <ul class="nav nav-second-level collapse">
                        <li><a href="{{route('admin.accounts.ledger_master')}}">Ledger Master</a></li>
                        <li><a href="{{route('admin.accounts.dailycashbooksummary')}}">Cashbook Daily Summary</a></li>
                        <li><a href="{{route('admin.accounts.cashbookperdate')}}">Cashbook Per Date</a></li>
                        <li><a href="{{route('admin.accounts.balancesheetdtl')}}">Balance Sheet Detail</a></li>
                        <li><a href="{{route('admin.accounts.bankbook')}}">Bank Book</a></li>
                        <li><a href="{{route('admin.accounts.profitnloss')}}">Profit And Loss</a></li>
                        <li><a href="{{route('admin.accounts.generalledger')}}">General Ledger</a></li>
                        <li><a href="{{route('admin.accounts.ledgersummery')}}">Ledger Summary Report</a></li>
                        <li><a href="{{route('admin.accounts.membersavings')}}">Member (Savings Report)</a></li>
                        {{-- <li><a href="#">Reconciliation Statement</a></li> --}}


                        {{-- <li><a href="#">Loan Status Detail Rrport</a></li> --}}
                        {{-- <li><a href="#">Disbursment Report[all]</a></li> --}}
                        {{-- <li><a href="#">Disbursment Summ.[all]</a></li> --}}

                        {{-- <li><a href="#">Receipt & Payment </a></li> --}}

                        {{-- <li><a href="#">Trail Balance</a></li> --}}
                    </ul>
                </li>
            </ul>

    </nav>



{{-- <div id="layoutSidenav_nav">
    <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
        <div class="sb-sidenav-menu">
            <div class="nav">
                <a class="nav-link" href="#">
                    <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                   Admin Dashboard
                </a>
                <div class="sb-sidenav-menu-heading"></div>
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                    <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                    User
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                    <a class="nav-link collapsed" data-toggle="collapse" data-target="#collapseLayouts" href="{{route('admin.index')}}" aria-expanded="false" aria-controls="collapseLayouts">
                            Management
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                    </nav>
                </div>
            </div>
        </div>
        <div class="sb-sidenav-footer">
            <div class="small">Logged in as:{{Auth()->user()->username}}</div>
        </div>
    </nav>
</div> --}}

<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ url('/') }}">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Marketvine <sup>Ltd.</sup></div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link <?php if($active == 'dashboard') echo 'active'; ?>" href="{{ url('/') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span>
        </a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Main Menu
    </div>

    <!-- Nav Item - Pages Collapse Menu -->
{{--        <li class="nav-item">--}}
{{--            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"--}}
{{--               aria-expanded="true" aria-controls="collapseTwo">--}}
{{--                <i class="fas fa-fw fa-cog"></i>--}}
{{--                <span>Components</span>--}}
{{--            </a>--}}
{{--            <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">--}}
{{--                <div class="bg-white py-2 collapse-inner rounded">--}}
{{--                    <h6 class="collapse-header">Custom Components:</h6>--}}
{{--                    <a class="collapse-item" href="buttons.html">Buttons</a>--}}
{{--                    <a class="collapse-item" href="cards.html">Cards</a>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </li>--}}

    <li class="nav-item">
        <a class="nav-link <?php if($active == 'customer') echo 'active'; ?>" href="{{ url('/customerInfo/0') }}">
            <i class="fas fa-fw fa-user"></i>
            <span>Customer Info</span>
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link <?php if($active == 'supplier') echo 'active'; ?>" href="{{ url('/supplierInfo') }}">
            <i class="fas fa-fw fa-user"></i>
            <span>Supplier Info</span>
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link <?php if($active == 'product') echo 'active'; ?>" href="{{ url('/product/0') }}">
            <i class="fab fa-fw fa-product-hunt"></i>
            <span>Product</span>
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link <?php if($active == 'sale_budget') echo 'active'; ?>" href="{{ url('/sales-budget') }}">
            <i class="fab fa-fw fa-product-hunt"></i>
            <span>Sales Budget</span>
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link {{ $mainActive === "sales" ? "collapsed active" : "" }}" href="#" data-toggle="collapse" data-target="#collapseOne"
           aria-expanded="{{ $mainActive === "sales" ? "true" : "false" }}" aria-controls="collapseOne">
            <i class="fab fa-fw fa-product-hunt"></i>
            <span>Sales</span>
        </a>

        <div id="collapseOne" class="collapse {{ $mainActive === "sales" ? "show" : "" }}" aria-labelledby="headingOne" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Sampling</h6>
                <a class="collapse-item <?php if($active == 'sample_submission') echo 'active'; ?>" href="{{ url('/sample-submission') }}">Sample Submission</a>
                <a class="collapse-item" href="{{ url('/sample-sub-register') }}">Sample Sub. Register</a>
                <h6 class="collapse-header">Sales</h6>
                <a class="collapse-item <?php if($active == 'enter_sales') echo 'active'; ?>" href="{{ url('/sales') }}">Enter Sales</a>
                <a class="collapse-item <?php if($active == 'sales_register') echo 'active'; ?>" href="{{ url('/sales-register') }}">Sales Register</a>
                <a class="collapse-item <?php if($active == 'rec_payment') echo 'active'; ?>" href="{{ url('/receive-payments') }}">Receive Payment</a>
            </div>
        </div>
    </li>

    {{--    <li class="nav-item">--}}
    {{--        <a class="nav-link" href="{{ url('/receive-payments') }}">--}}
    {{--            <i class="fab fa-fw fa-product-hunt"></i>--}}
    {{--            <span>Receive Payment</span>--}}
    {{--        </a>--}}
    {{--    </li>--}}

    <li class="nav-item">
        <a class="nav-link <?php if($active == 'purchases') echo 'active'; ?>" href="{{ url('/purchases') }}">
            <i class="fab fa-fw fa-product-hunt"></i>
            <span>Purchases</span>
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link {{ $mainActive === "reports" ? "collapsed active" : "" }}" href="#" data-toggle="collapse" data-target="#collapseTwo"
           aria-expanded="{{ $mainActive === "reports" ? "true" : "false" }}" aria-controls="collapseTwo">
            <i class="fas fa-fw fa-cog"></i>
            <span>Reports</span>
        </a>
        <div id="collapseTwo" class="collapse {{ $mainActive === "reports" ? "show" : "" }}" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">All Reports:</h6>
                <a class="collapse-item <?php if($active == 'payment_history') echo 'active'; ?>" href="{{ url('/payments-history/0') }}">Payment History</a>
                <a class="collapse-item <?php if($active == 'sales_analysis') echo 'active'; ?>" href="{{ url('/sales-table-analysis') }}">Sales Analysis</a>
                <a class="collapse-item <?php if($active == 'sales_prd') echo 'active'; ?>" href="{{ url('/productCusWSale') }}">Sales-Prd Vs Customer(Vol)</a>
                <a class="collapse-item <?php if($active == 'ageing_summery') echo 'active'; ?>" href="{{ url('/ageingSummery') }}">Ageing Summery</a>
                <a class="collapse-item <?php if($active == 'ageing_details') echo 'active'; ?>" href="{{ url('/ageingDetails/0') }}">Ageing Details</a>
            </div>
        </div>
    </li>


    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>
</ul>
<!-- End of Sidebar -->

<div class="vertical-nav">
    <!-- Collapse menu starts -->
    <button class="collapse-menu">
        <i class="icon-menu2"></i>
    </button>
    <!-- Collapse menu ends -->

    <!-- Current user starts -->
    <div class="user-details clearfix">
        <a href="profile.html" class="user-img">
            <img src="{{asset('admin/img/thumbs/Capture.PNG')}}" alt="User Info">

        </a>
        <h5 class="user-name">Mehedi</h5>
    </div>
    <!-- Current user ends -->

    <!-- Sidebar menu starts -->
    <ul class="menu clearfix">
        <li>
            <a href="index.php">
                <i class="icon-air-play"></i>
                <span class="menu-item">Dashboard</span>
            </a>
        </li>
        <li>
            <a href="#">
                <i class="icon-head"></i>
                <span class="menu-item">Order</span>
                <span class="down-arrow"></span>
            </a>
            <ul>
                <li>
                    <a href='{{ route('order.index') }}'>Order List</a>
                </li>


            </ul>
        </li>


    </ul>


</div>

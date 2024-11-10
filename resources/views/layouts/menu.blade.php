@if (Auth::user()->modul == 1)
   <li> <a class="has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i
            class="icon-speedometer"></i><span class="hide-menu">Dashboard<span
                class="badge badge-pill badge-cyan ml-auto">4</span></span></a>
    <ul aria-expanded="false" class="collapse">
        <li><a href="{{ url('/') }}/">Dashboard</a></li>
    </ul>
    </li>
    <li> <a class="has-arrow waves-effect waves-dark two-column" href="javascript:void(0)" aria-expanded="false"><i
                class="ti-palette"></i><span class="hide-menu">Master Catalogue<span
                    class="badge badge-pill badge-primary text-white ml-auto">25</span></span></a>
        <ul aria-expanded="false" class="collapse">
            <li><a href="{{ url('/') }}/vehiclemodel">Vehicle Model</a></li>
            <li><a href="{{ url('/') }}/vehicle">Vehicle Catalogue</a></li>
            <li><a href="{{ url('/') }}/package">Service Catalogue</a></li>
            <li><a href="{{ url('/') }}/supplier">Supplier Catalogue</a></li>

            <li><a href="{{ url('/') }}/sparepart">Part Catalogue</a></li>
            <li><a href="{{ url('/') }}/employee">Employee Catalogue</a></li>
            <li><a href="{{ url('/') }}/customer">Customer Catalogue</a></li>
            <li><a href="{{ url('/') }}/manufacturer">Manufacturer Catalogue</a></li>
        </ul>
    </li>
    <li> <a class="has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i
                class="icon-speedometer"></i><span class="hide-menu">Vehicle Lisence <span
                    class="badge badge-pill badge-cyan ml-auto">4</span></span></a>
        <ul aria-expanded="false" class="collapse">
            <li><a href="{{ url('/') }}/lisence">Vehicle Lisence </a></li>
        </ul>
    </li>
    <li> <a class="has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i
                class="icon-speedometer"></i><span class="hide-menu">Kimper<span
                    class="badge badge-pill badge-cyan ml-auto">4</span></span></a>
        <ul aria-expanded="false" class="collapse">
            <li><a href="{{ url('/') }}/kimper">Kimper </a></li>
        </ul>
    </li>
    <li> <a class="has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i
                class="ti-palette"></i><span class="hide-menu">Maintenance<span
                    class="badge badge-pill badge-primary text-white ml-auto">25</span></span></a>
        <ul aria-expanded="false" class="collapse">
            <li><a href="{{ url('/') }}/createwo">Initial Maintenance</a></li>
            <li><a href="{{ url('/') }}/maintenance">Maintenance List</a></li>
            <li><a href="{{ url('/') }}/workorder">Work Order</a></li>
            <li><a href="{{ url('/') }}/history">Maintenance History</a></li>
        </ul>
    </li>
    <li> <a class="has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i
                class="ti-palette"></i><span class="hide-menu">Operation<span
                    class="badge badge-pill badge-primary text-white ml-auto">25</span></span></a>
        <ul aria-expanded="false" class="collapse">
            <li><a href="{{ url('/') }}/daily">Daily Log</a></li>
            <li><a href="{{ url('/') }}/dailyhistory">Daily Log History</a></li>
        </ul>
    </li>

    <li> <a class="has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i
                class="ti-palette"></i><span class="hide-menu">Part Requisition<span
                    class="badge badge-pill badge-primary text-white ml-auto">25</span></span></a>

        <ul aria-expanded="false" class="collapse">
            {{-- <li><a href="{{ url('/') }}/newpr">Part Requisition</a></li> --}}
            <li><a href="{{ url('/') }}/newpr">Part Requisition</a></li>
            {{-- <li><a href="{{ url('/') }}/newpo">Purchase Order</a></li> --}}
            <li><a href="{{ url('/') }}/newpo">Purchase Order</a></li>
            <li><a href="{{ url('/') }}/statuspo">Purchase Order Report</a></li>
            <li><a href="{{ url('/') }}/indexprtracker">Requisition Status Tracker</a></li>
            

        </ul>
    </li>
    <li> <a class="has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i
                class="ti-palette"></i><span class="hide-menu">Warehouse Inventory<span
                    class="badge badge-pill badge-primary text-white ml-auto">25</span></span></a>
        <ul aria-expanded="false" class="collapse">
            <li><a href="{{ url('/') }}/booking">Part Booking</a></li>

            <li><a href="{{ url('/') }}/newgr">Good Receipt Note</a></li>
            <li><a href="{{ url('/') }}/gin">Good Issue Note</a></li>
            <li><a href="{{ url('/') }}/stockopname">Stock Opname</a></li>
            <li><a href="{{ url('/') }}/inventory">Inventory</a></li>
            <li><a href="{{ url('/') }}/stockhistory">Stock History</a></li>

        </ul>
    </li>


@elseif ((Auth::user()->modul == 2))
    <li> <a class="has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i
            class="icon-speedometer"></i><span class="hide-menu">Dashboard<span
                class="badge badge-pill badge-cyan ml-auto">4</span></span></a>
    <ul aria-expanded="false" class="collapse">
        <li><a href="{{ url('/') }}/">Dashboard</a></li>
    </ul>
    </li>
    <li> <a class="has-arrow waves-effect waves-dark two-column" href="javascript:void(0)" aria-expanded="false"><i
                class="ti-palette"></i><span class="hide-menu">Master Catalogue<span
                    class="badge badge-pill badge-primary text-white ml-auto">25</span></span></a>
        <ul aria-expanded="false" class="collapse">
            <li><a href="{{ url('/') }}/vehiclemodel">Vehicle Model</a></li>
            <li><a href="{{ url('/') }}/vehicle">Vehicle Catalogue</a></li>
            <li><a href="{{ url('/') }}/package">Service Catalogue</a></li>
            <li><a href="{{ url('/') }}/supplier">Supplier Catalogue</a></li>

            <li><a href="{{ url('/') }}/sparepart">Part Catalogue</a></li>
            <li><a href="{{ url('/') }}/employee">Employee Catalogue</a></li>
            <li><a href="{{ url('/') }}/customer">Customer Catalogue</a></li>
            <li><a href="{{ url('/') }}/manufacturer">Manufacturer Catalogue</a></li>
        </ul>
    </li>

    <li> <a class="has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i
                class="ti-palette"></i><span class="hide-menu">Part Requisition<span
                    class="badge badge-pill badge-primary text-white ml-auto">25</span></span></a>

        <ul aria-expanded="false" class="collapse">
            <li><a href="{{ url('/') }}/newpr">Part Requisition</a></li>
            <li><a href="{{ url('/') }}/newpo">Purchase Order</a></li>
            <li><a href="{{ url('/') }}/statuspo">Purchase Order Report</a></li>
            

        </ul>
    </li>
    <li> <a class="has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i
                class="ti-palette"></i><span class="hide-menu">Warehouse Inventory<span
                    class="badge badge-pill badge-primary text-white ml-auto">25</span></span></a>
        <ul aria-expanded="false" class="collapse">
            <li><a href="{{ url('/') }}/newgr">Good Receipt Note</a></li>
            <li><a href="{{ url('/') }}/gin">Good Issue Note</a></li>
            <li><a href="{{ url('/') }}/inventory">Inventory</a></li>
        </ul>
    </li>
@elseif ((Auth::user()->modul == 3))
    <li> <a class="has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i
            class="icon-speedometer"></i><span class="hide-menu">Dashboard<span
                class="badge badge-pill badge-cyan ml-auto">4</span></span></a>
    <ul aria-expanded="false" class="collapse">
        <li><a href="{{ url('/') }}/">Dashboard</a></li>
    </ul>
    </li>
    
    <li> <a class="has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i
                class="icon-speedometer"></i><span class="hide-menu">Vehicle Lisence <span
                    class="badge badge-pill badge-cyan ml-auto">4</span></span></a>
        <ul aria-expanded="false" class="collapse">
            <li><a href="{{ url('/') }}/lisence">Vehicle Lisence </a></li>
        </ul>
    </li>
    <li> <a class="has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i
                class="icon-speedometer"></i><span class="hide-menu">Kimper<span
                    class="badge badge-pill badge-cyan ml-auto">4</span></span></a>
        <ul aria-expanded="false" class="collapse">
            <li><a href="{{ url('/') }}/kimper">Kimper </a></li>
        </ul>
    </li>
    <li> <a class="has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i
                class="ti-palette"></i><span class="hide-menu">Maintenance<span
                    class="badge badge-pill badge-primary text-white ml-auto">25</span></span></a>
        <ul aria-expanded="false" class="collapse">
            <li><a href="{{ url('/') }}/createwo">Initial Maintenance</a></li>
            <li><a href="{{ url('/') }}/maintenance">Maintenance List</a></li>
            <li><a href="{{ url('/') }}/workorder">Work Order</a></li>
            <li><a href="{{ url('/') }}/history">Maintenance History</a></li>
        </ul>
    </li>
    <li> <a class="has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i
                class="ti-palette"></i><span class="hide-menu">Operation<span
                    class="badge badge-pill badge-primary text-white ml-auto">25</span></span></a>
        <ul aria-expanded="false" class="collapse">
            <li><a href="{{ url('/') }}/daily">Daily Log</a></li>
            <li><a href="{{ url('/') }}/dailyhistory">Daily Log History</a></li>

        </ul>
    </li>

    <li> <a class="has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i
                class="ti-palette"></i><span class="hide-menu">Part Requisition<span
                    class="badge badge-pill badge-primary text-white ml-auto">25</span></span></a>

        <ul aria-expanded="false" class="collapse">
            <li><a href="{{ url('/') }}/newpr">Part Requisition</a></li>
            <li><a href="{{ url('/') }}/statuspo">Purchase Order Report</a></li>

            

        </ul>
    </li>
    <li> <a class="has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i
                class="ti-palette"></i><span class="hide-menu">Warehouse Inventory<span
                    class="badge badge-pill badge-primary text-white ml-auto">25</span></span></a>
        <ul aria-expanded="false" class="collapse">
            <li><a href="{{ url('/') }}/newgr">Good Receipt Note</a></li>
            <li><a href="{{ url('/') }}/gin">Good Issue Note</a></li>
            <li><a href="{{ url('/') }}/inventory">Inventory</a></li>
        </ul>
    </li>
@elseif ((Auth::user()->modul == 4))
    

    <li> <a class="has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i
                class="ti-palette"></i><span class="hide-menu">Part Requisition<span
                    class="badge badge-pill badge-primary text-white ml-auto">25</span></span></a>

        <ul aria-expanded="false" class="collapse">
            <li><a href="{{ url('/') }}/newpr">Part Requisition</a></li>
            <li><a href="{{ url('/') }}/statuspo">Purchase Order Report</a></li>
            

        </ul>
    </li>
    <li> <a class="has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i
                class="ti-palette"></i><span class="hide-menu">Warehouse Inventory<span
                    class="badge badge-pill badge-primary text-white ml-auto">25</span></span></a>
        <ul aria-expanded="false" class="collapse">
            <li><a href="{{ url('/') }}/newgr">Good Receipt Note</a></li>
            <li><a href="{{ url('/') }}/gin">Good Issue Note</a></li>
            <li><a href="{{ url('/') }}/inventory">Inventory</a></li>
        </ul>
    </li>
@elseif ((Auth::user()->modul == 5))
    <li> <a class="has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i
            class="icon-speedometer"></i><span class="hide-menu">Dashboard<span
                class="badge badge-pill badge-cyan ml-auto">4</span></span></a>
    <ul aria-expanded="false" class="collapse">
        <li><a href="{{ url('/') }}/">Dashboard</a></li>
    </ul>
    </li>
    

    <li> <a class="has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i
                class="ti-palette"></i><span class="hide-menu">Part Requisition<span
                    class="badge badge-pill badge-primary text-white ml-auto">25</span></span></a>

        <ul aria-expanded="false" class="collapse">
            <li><a href="{{ url('/') }}/newpr">Part Requisition</a></li>
            <li><a href="{{ url('/') }}/statuspo">Purchase Order Report</a></li>

        </ul>
    </li>
    <li> <a class="has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i
                class="ti-palette"></i><span class="hide-menu">Warehouse Inventory<span
                    class="badge badge-pill badge-primary text-white ml-auto">25</span></span></a>
        <ul aria-expanded="false" class="collapse">
            <li><a href="{{ url('/') }}/newgr">Good Receipt Note</a></li>
            <li><a href="{{ url('/') }}/gin">Good Issue Note</a></li>
            <li><a href="{{ url('/') }}/inventory">Inventory</a></li>
        </ul>
    </li>

{{-- @endif --}}


@elseif ((Auth::user()->modul == 6))
    <li> <a class="has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i
            class="icon-speedometer"></i><span class="hide-menu">Dashboard<span
                class="badge badge-pill badge-cyan ml-auto">4</span></span></a>
        <ul aria-expanded="false" class="collapse">
            <li><a href="{{ url('/') }}/">Dashboard</a></li>
        </ul>
    </li>

    <li> <a class="has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i
                class="icon-speedometer"></i><span class="hide-menu">Kimper<span
                    class="badge badge-pill badge-cyan ml-auto">4</span></span></a>
        <ul aria-expanded="false" class="collapse">
            <li><a href="{{ url('/') }}/kimper">Kimper </a></li>
        </ul>
    </li>
    <li> <a class="has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i
                class="icon-speedometer"></i><span class="hide-menu">Vehicle Lisence <span
                    class="badge badge-pill badge-cyan ml-auto">4</span></span></a>
        <ul aria-expanded="false" class="collapse">
            <li><a href="{{ url('/') }}/lisence">Vehicle Lisence </a></li>
        </ul>
    </li>


@endif



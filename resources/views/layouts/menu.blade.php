<ul class="sidebar-menu">
    <li class="header">MENU</li>
    <!--<li class="{{ Route::getCurrentRoute()->getPath() == 'types' ? ' active' : '' }}"><a href="{{ url('/types') }}"><span>Type</span></a></li> -->
    <li class="{{ Route::getCurrentRoute()->getPath() == 'tickets' ? ' active' : '' }}"><a href="{{ url('/tickets') }}"><span>Ticket</span></a></li>
    <li class="{{ Route::getCurrentRoute()->getPath() == 'orders' ? ' active' : '' }}"><a href="{{ url('/orders') }}"><span>Order</span></a></li>
    <li class="{{ Route::getCurrentRoute()->getPath() == 'confirmations' ? ' active' : '' }}"><a href="{{ url('/confirmations') }}"><span>Confirmation</span></a></li>
    <li><a href="{{ url('/logout') }}"><span>Logout</span></a></li>
</ul>

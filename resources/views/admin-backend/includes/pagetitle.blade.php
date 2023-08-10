{{-- <div class="pagetitle">
  <h1>Dashboard</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="index.html">Home</a></li>
      <li class="breadcrumb-item active">Dashboard</li>
    </ol>
  </nav>
</div> --}}



<div class="pagetitle">
  <h1>
    {{ request()->is('*/admin-Dashboard') ? 'Dashboard' : '' }}
    {{ request()->is('*/Add-Event') ? 'Add-Event' : '' }}
    {{ request()->is('*/Events') ? 'Events' : '' }}
  </h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
      @if(request()->is('*/Add-Question') || request()->is('*/Edit-Question/*'))
      <li class="breadcrumb-item">
        <a href="{{url('AnnualReport/Admin-Dashboard/Questions')}}">
          {{ request()->is('*/Add-Question') ? 'Questions' : '' }}
          {{ request()->is('*/Edit-Question/*') ? 'Questions' : '' }}
        </a>
      </li>
      @endif
      <li class="breadcrumb-item active">
        {{ request()->is('*/admin-Dashboard') ? 'Dashboard' : '' }}
        {{ request()->is('*/Events') ? 'Events' : '' }}
        {{ request()->is('*/Add-Event') ? 'Add-Event' : '' }}
      </li>
    </ol>
  </nav>
</div>

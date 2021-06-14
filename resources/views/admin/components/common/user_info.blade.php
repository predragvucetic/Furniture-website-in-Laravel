<!-- User Info -->
<div class="user-info">
    <div class="image">
        <img src="{{ asset('images/user.png') }}" width="48" height="48" alt="User" />
    </div>
    <div class="info-container">
        <div class="name" style="color: black" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{ session()->get('user')->firstName . " " . session()->get('user')->lastName  }}</div>
        <div class="email" style="color: black">{{ session()->get('user')->email }}</div>
    </div>
</div>
<!-- #User Info -->

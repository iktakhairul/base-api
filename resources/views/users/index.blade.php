<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <style>
        body {
            font-family: 'Nunito', sans-serif;
        }
        .home {
            margin: 50px;
        }
        .dashboard-item{
            margin-left: 30px;
        }
        .category-block{
            font-weight: normal;
        }
    </style>
</head>
<body class="antialiased">
<div class="container home">
    <h3>Domains User</h3>
    <div class="col-md-3 category-responsive dashboard-item">
        <h4>This is {{$users->domain}} users panel</h4>
        <h4 class="category-block">Role: {{$users->role}}</h4>
    </div>
</div>
<div class="container home">
    <h3>User Details</h3>
    <div class="col-md-3 category-responsive dashboard-item">
        <h4 class="category-block">Name: {{$users->name}}</h4>
        <h4 class="category-block">Email: {{$users->email}}</h4>
        <h4 class="category-block">Role: {{$users->role}}</h4>
        <h4 class="category-block">Contact No: {{$users->contact_no}}</h4>
        <h4 class="category-block">Type: {{$users->type}}</h4>
        <h4 class="category-block">Weight: {{$users->weight}}</h4>
        <h4 class="category-block">Access: {{$users->access}}</h4>
        <h4 class="category-block">Status: {{$users->status}}</h4>
    </div>
</div>
</body>
</html>

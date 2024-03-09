<!DOCTYPE html>
<html lang="en">
<head>
    @include('admin.css')
    <style>
           .div_center{
            text-align: left !important;
            align-items: left !important;
            margin:auto;
        }
        .cat_label{
        text-align: center;
        font-size:25px;
        font-weight:bold;
    }
        .center{
          margin:auto;
          text-align: center;
          width: 80%;
          margin-top:50px;
          border:1px solid white;
        }
        th{
          background-color: #00000; 
          padding: 10px;
        }
        tr{
          border:1px solid white;
          padding: auto;
        }
        .input_c{
            color:black;
            background-color: #f2f2f2;
        }
        hr {
        border-color: white;
    }
    </style>
</head>
<body>
    <div class="container-scroller">
        @include('admin.sidebar')
        @include('admin.nav')

        <div class="main-panel bg-secondary">
            <div class="content-wrapper">
                <div class="container">
                    @if(session('success'))
                        <div class="alert alert-success">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">X</button>
                            {{ session('success') }}
                        </div>
                    @endif

                    @if($errors->any())
                        <div class="alert alert-danger">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">X</button>
                            <ul>
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <h1 class="cat_label"> Users</h1>
                    <hr style="border-color: white;         margin: 5px;">


                    <div>
    <table class="center">
        <tr>
            <th>User</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Role</th>
            <th>Created Date</th>
            <th>Last Update</th>
            <th>Delete</th>
        </tr>
        @foreach($data as $user)
            <tr>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->phone_number }}</td>
                <td>{{ $user->role }}</td>
                <td>{{ $user->created_at->format('Y-m-d ') }}</td>
                <td>{{ $user->updated_at->format('Y-m-d ') }}</td>
                <td>
                    <a href="{{ url('user_delete', $user->id) }}" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this user?')">Delete</a>
                </td>
            </tr>
        @endforeach
    </table>
</div>

            </div>
        </div>

        @include('admin.scripts')
    </div>
</body>
</html>

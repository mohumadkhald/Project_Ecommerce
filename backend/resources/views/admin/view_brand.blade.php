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
            font-size:30px;
            font-weight:bold;
            padding: 30px;
            color:white;
        }
        .center{
          margin:auto;
          text-align: center;
          width: 50%;
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
<h1 class="cat_label">Add Brand</h1>
<hr style="border-color: white;         margin: 5px;">
<br>
<form action="{{ url('add_brand') }}" method="POST" >
                        @csrf
                        <div class="form-group">

                        <label class="h6" for="category">Brand Name</label>
                        <input class="form-control input_c" type="text" name="brand_name" required>
                        </div>

                        <input class="btn btn-primary ml-2" type="submit" value="Add Brand">
                    </form>

                    <hr style="border-color: white;         margin: 5px;">


                    <div>
                    <table class="center">
    <tr>
        <th>Brand</th>
        <th>Delete</th>
    </tr>
    @foreach($data as $brand)
        <tr>
            <td>{{ $brand->name }}</td>
         
            <td>
                <a href="{{ url('brand_delete', $brand->id) }}" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this category?')">Delete</a>
            </td>
        </tr>
    @endforeach
</table>


                </div>

</div>

            </div>
        </div>
        @include('admin.scripts')
</body>

</html>
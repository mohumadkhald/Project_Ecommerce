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
            background-color: #000;
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

      <div class="main-panel">

            <div class="content-wrapper">
                <div class="div-center">
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

                <h1 class="cat_label">Category</h1>
                <hr style="border-color: white;         margin: 5px;">

                    <form action="{{ url('add_category') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">

                        <label class="h6" for="category">Category Name</label>
                        <input class="form-control" type="text" name="category_name" required>
                        </div>

                        <div class="form-group">
                            <label for="category_img">Category Image</label>
                            <input type="file" class="form-control-file" id="category_img" name="category_img">
                        </div>

                        <input class="btn btn-primary ml-2" type="submit" value="Add Category">
                    </form>
                    <hr style="border-color: white;         margin: 5px;">


                    <div>
                    <table class="center">
    <tr>
        <th>Categories</th>
        <th>Image</th>
        <th>Delete</th>
    </tr>
    @foreach($data as $category)
        <tr>
            <td>{{ $category->name }}</td>
            <td>
                <img src="{{ asset($category->image) }}" alt="Category Image" style="max-width: 100px; max-height: 100px;">
            </td>
            <td>
                <!-- <a href="{{ url('cat_update', $category->id) }}" class="btn btn-info">Update</a> -->
                <a href="{{ url('cat_delete', $category->id) }}" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this category?')">Delete</a>
            </td>
        </tr>
    @endforeach
</table>


                </div>
            </div>
        </div>
    @include('admin.scripts')

  </body>
</html>
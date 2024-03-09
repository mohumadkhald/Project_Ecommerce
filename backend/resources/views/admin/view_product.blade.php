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
          <div class="content-wrapper bg-dark">

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

          <h1 class="cat_label mb-3" >Products</h1>
          <div class="cat_label">
            <form action="{{url('search')}}" method="get">
                @csrf
                <input type="text" name="search" placeholder="Search" style="color:black;">
                <input type="submit" value="search" class="btn btn-outline-primary">
            </form>
          </div>
          <hr style="border-color: white;         margin: 5px;">

          <div >
                    <table class="center">
    <tr>
        <th>Product</th>
        <th>Description</th>
        <th>Rate</th>
        <th>Seller</th>
        <th>Seller-Email</th>
        <th>Image</th>
        <th>Price</th>
        <th>Quantity</th>
        <th>Total Price</th>
        <th>Delete</th>
    </tr>
    @foreach($data as $product)
        <tr>
            <td>{{ $product->title }}</td>
            <td>{{ $product->description }}</td>
            <td>{{ $product->rating }}</td>
            <td>{{ $product->user->name }}</td>
            <td>{{ $product->user->email }}</td>
            <td>
            <img src="{{ asset('../storage/' . $product->image) }}" alt="{{ $product->title }} Image" style="max-width: 100px; max-height: 100px;">
            </td>
            <td>{{ $product->price }}</td>
            <td>{{ $product->quantity }}</td>
            <td>{{ $product->quantity * $product->price }}</td>

            <td>
                <!-- <a href="{{ url('cat_update', $product->id) }}" class="btn btn-info">Update</a> -->
                <a href="{{ url('product_delete', $product->id) }}" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this category?')">Delete</a>
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
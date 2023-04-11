<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>All Customers</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
</head>

<body class=" bg-body-tertiary">
    <header>
        <nav class="navbar navbar-expand-md bg-dark navbar-dark">
            <div class="container">
                <a href="{{ route('homepage') }}" class="navbar-brand">Homepage</a>
                <ul class="navbar-nav">
                    <li class="nav-item"><a href="{{ route('customers.index') }}" class="nav-link">All Customers</a>
                    </li>
                    <li class="nav-item"><a href="{{ route('customers.create') }}" class="nav-link">Add Customer</a>
                    </li>
                </ul>
            </div>
        </nav>
    </header>

    <div class="container my-5">

        @if (session()->has('success'))
            <div class="alert alert-success">{{session()->get('success')}}</div>
        @endif

        <div class="table-responsive card card-dark">
            <div class="card-header">
                <h4 class="card-title">All Customers</h4>
            </div>
            <table class="card-body table table-bordered table-hover table-striped">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Customer name</th>
                        <th>Customer area</th>
                        <th>Customer package</th>
                        <th>Customer status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @if (count($customers) > 0)
                        @foreach ($customers as $customer)
                            <tr>
                                <td>{{$customer->id}}</td>
                                <td>{{$customer->name}}</td>
                                <td>{{$customer->area}}</td>
                                <td>{{$customer->package}}</td>
                                <td class="{{$customer->status === 'Active' ? 'text-success' : 'text-danger'}}">{{$customer->status}}</td>
                                <td class="d-flex gap-2">
                                    <a href="{{route('customers.edit', $customer->id)}}" class="btn btn-sm btn-primary">Edit</a>
                                    <form action="{{route('customers.destroy', $customer->id)}}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <input type="submit" class="btn btn-sm btn-danger" value="Delete">
                                    </form>
                                </td>
                            </tr>
                        @endforeach

                    @endif
                </tbody>
            </table>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous">
    </script>
</body>

</html>

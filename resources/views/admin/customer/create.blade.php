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
        <div class="card w-50 mx-auto">
            <div class="card-header">
                <h4 class="card-title">Create Customer</h4>
            </div>
            <div class="card-body">
                <form action="{{route('customers.store')}}" method="POST">
                    @csrf

                    <div class="form-floating mb-3">
                        <input type="text" name="name" class="form-control" id="name" placeholder="Customer name" value="{{old('name')}}">
                        <label for="name">Customer name <small class="text-danger">*</small></label>
                        @error('name')
                        <div class="form-text text-danger">{{$message}}</div>
                        @enderror
                    </div>

                    <div class="form-floating mb-3">
                        <select name="area" id="area" class="form-select" placeholder="Customer area">
                            <option value="">Select</option>
                            <option {{ old('area') === 'Magura' ? 'selected' : null}} value="Magura">Magura</option>
                            <option {{ old('area') === 'Kushtia' ? 'selected' : null}} value="Kushtia">Kushtia</option>
                            <option {{ old('area') === 'Dhaka' ? 'selected' : null}} value="Dhaka">Dhaka</option>
                            <option {{ old('area') === 'Kumilla' ? 'selected' : null}} value="Kumilla">Kumilla</option>
                        </select>
                        <label for="area">Customer area <small class="text-danger">*</small></label>
                        @error('area')
                        <div class="form-text text-danger">{{$message}}</div>
                        @enderror
                    </div>

                    <div class="form-floating mb-3">
                        <select name="package" id="package" class="form-select" placeholder="Customer package">
                            <option value="">Select</option>
                            <option {{ old('package') === 'Analog' ? 'selected' : null}} value="Analog">Analog</option>
                            <option {{ old('package') === 'Set Top Box' ? 'selected' : null}} value="Set Top Box">Set Top Box</option>
                        </select>
                        <label for="package">Customer package <small class="text-danger">*</small></label>
                        @error('package')
                        <div class="form-text text-danger">{{$message}}</div>
                        @enderror
                    </div>

                    <div class="form-floating mb-3">
                        <select name="status" id="status" class="form-select" placeholder="Customer status">
                            <option value="">Select</option>
                            <option {{ old('status') === 'Active' ? 'selected' : null}} value="Active">Active</option>
                            <option {{ old('status') === 'Deactivate' ? 'selected' : null}} value="Deactivate">Deactivate</option>
                        </select>
                        <label for="status">Customer status <small class="text-danger">*</small></label>
                        @error('status')
                        <div class="form-text text-danger">{{$message}}</div>
                        @enderror
                    </div>

                    <input type="submit" class="btn btn-success" value="Custormer Create">

                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous">
    </script>
</body>

</html>

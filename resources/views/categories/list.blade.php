{{-- <!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>News Crud</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <div class="bg-dark py-3">
        <h3 class="text-white text-center">Category Crud</h3>
    </div>
    <div class="container">
        <div class="row justify-content-center mt-4">
            <div class="col-md-10">
                <div class="d-flex justify-content-between">
                    <form action="{{ route('categories.index') }}" method="GET" class="d-flex">
                        <select name="sort_by" class="form-select ms-2">
                            <option value="category" {{ request()->get('sort_by') == 'category' ? 'selected' : '' }}>Category</option>
                        </select>
                        <input type="hidden" name="sort_order" value="{{ request()->get('sort_order') == 'asc' ? 'desc' : 'asc' }}">
                        <button type="submit" class="btn btn-secondary ms-2">
                            <i class="bi {{ request()->get('sort_order') == 'asc' ? 'bi-sort-down' : 'bi-sort-up' }}"></i> Sort
                        </button>
                    </form>

                    <a href="{{ route('categories.create') }}" class="btn btn-dark">Add</a>
                </div>
            </div>
        </div>
        <div class="row d-flex justify-content-center">
            @if (Session::has('success'))
            <div class="col-md-10 mt-4">
                <div class="alert alert-success">
                    {{ Session:: get('success') }}
                </div>
            </div>
            @endif
            <div class="col-md-10">
                <div class="card border-0 shadow-lg my-4">
                    <div class="card-header bg-dark">
                        <h3 class="text-white">Categories</h3>
                    </div>
                    <div class="card-body">
                        <table class="table">
                            <tr>
                                <th>ID</th>
                                <th>Category</th>
                                <th>Action</th>
                            </tr>
                            @if ($category->isNotEmpty())
                            @foreach ($category as $category)
                            <tr>
                                <td>{{ $category->id}}</td>
                                <td>{{ $category->category}}</td>
                                 <td>
                                    <a href="{{ route('categories.edit',$category->id)}}" class="btn btn-dark">Edit</a>
                                    <a href="#" onclick="deleteProduct({{ $category->id }})"
                                        class="btn btn-danger">Delete</a>
                                    <form id="delete-news-form{{ $category->id}}"
                                        action="{{ route('categories.destroy',$category->id)}}" method="post">
                                        @csrf
                                        @method('delete')
                                    </form>
                                </td>
                            </tr>
                            @endforeach

                            @endif

                        </table>
                    </div>
                </div>

            </div>
        </div>
    </div>
</body>

</html>

<script>
    function deleteProduct(id){
        if(confirm("Are you sure you want to delete?")){
            document.getElementById("delete-news-form"+id).submit();
        }
    }
</script> --}}



 <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Categories List</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-4">
    <h2>Categories List</h2>
    <a href="{{ route('categories.create') }}" class="btn btn-primary mb-3">Add Category</a>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <table class="table table-bordered">
        <thead>
        <tr>
            <th>ID</th>
            <th>Category</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($categories as $category)
            <tr>
                <td>{{ $category->id }}</td>
                <td>{{ $category->category }}</td>
                <td>
                    <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-primary btn-sm">Edit</a>
                    <form action="{{ route('categories.destroy', $category->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    {{ $categories->links() }}
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

{{-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>News List</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-4">
    <h2>News List</h2>
    <a href="{{ route('news.create') }}" class="btn btn-primary mb-3">Add News</a>
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <table class="table table-bordered">
        <thead>
        <tr>
            <th>ID</th>
            <th>Title</th>
            <th>Category</th>
            <th>Description</th>
            <th>Author</th>
            <th>Tag</th>
            <th>Image</th>
            <th>Published</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($news as $item)
            <tr>
                <td>{{ $item->id }}</td>
                <td>{{ $item->title }}</td>
                <td>{{ $item->category->category }}</td>
                <td>{{ $item->description }}</td>
                <td>{{ $item->author }}</td>
                <td>{{ $item->tag }}</td>
                <td><img src="{{ asset('uploads/news/' . $item->image) }}" alt="{{ $item->title }}" width="50"></td>
                <td>{{ $item->published ? 'Yes' : 'No' }}</td>
                <td>
                    <a href="{{ route('news.edit', $item->id) }}" class="btn btn-primary btn-sm">Edit</a>
                    <form action="{{ route('news.destroy', $item->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    {{ $news->links() }}
</div>
</body>
</html> --}}


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>News List</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-4">
    <h2>News List</h2>
    <a href="{{ route('news.create') }}" class="btn btn-primary mb-3">Add News</a>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <form method="GET" action="{{ route('news.index') }}" class="mb-3">
        <div class="row">
            <div class="col-md-3">
                <select name="category" class="form-control">
                    <option value="">All Categories</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                            {{ $category->category }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3">
                <input type="text" name="title" class="form-control" placeholder="Title" value="{{ request('title') }}">
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn btn-primary">Filter</button>
            </div>
            <div class="col-md-4 text-end">
                <div class="btn-group">
                    <a href="{{ route('news.index', array_merge(request()->all(), ['sort_by' => 'title', 'sort_order' => request('sort_order') == 'asc' ? 'desc' : 'asc'])) }}" class="btn btn-secondary">
                        Title @if(request('sort_by') == 'title') {{ request('sort_order') == 'asc' ? '↑' : '↓' }} @endif
                    </a>
                    <a href="{{ route('news.index', array_merge(request()->all(), ['sort_by' => 'created_at', 'sort_order' => request('sort_order') == 'asc' ? 'desc' : 'asc'])) }}" class="btn btn-secondary">
                        Date @if(request('sort_by') == 'created_at') {{ request('sort_order') == 'asc' ? '↑' : '↓' }} @endif
                    </a>
                </div>
            </div>
        </div>
    </form>

    <table class="table table-bordered">
        <thead>
        <tr>
            <th>ID</th>
            <th>Title</th>
            <th>Category</th>
            <th>Description</th>
            <th>Author</th>
            <th>Tag</th>
            <th>Image</th>
            <th>Published</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($news as $item)
            <tr>
                <td>{{ $item->id }}</td>
                <td>{{ $item->title }}</td>
                <td>{{ $item->category->category }}</td>
                <td>{{ $item->description }}</td>
                <td>{{ $item->author }}</td>
                <td>{{ $item->tag }}</td>
                <td><img src="{{ asset('uploads/news/' . $item->image) }}" alt="{{ $item->title }}" width="50"></td>
                <td>{{ $item->published ? 'Yes' : 'No' }}</td>
                <td>
                    <a href="{{ route('news.edit', $item->id) }}" class="btn btn-primary btn-sm">Edit</a>
                    <form action="{{ route('news.destroy', $item->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    {{ $news->links() }}
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

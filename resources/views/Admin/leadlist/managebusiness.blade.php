@extends('SuperAdmin.main')

@section('body')
<div class="container">
    <h2>Business List</h2>

    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Status</th>
                <th>Created At</th>
            </tr>
        </thead>
        <tbody>
            @forelse($businesses as $business)
                <tr>
                    <td>{{ $business->id }}</td>
                    <td>{{ $business->name }}</td>
                    <td>
                        @if($business->status == 1)
                            <span class="badge bg-success">Active</span>
                        @else
                            <span class="badge bg-danger">Inactive</span>
                        @endif
                    </td>
                    <td>{{ $business->created_at->format('d M Y') }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="4">No businesses found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection

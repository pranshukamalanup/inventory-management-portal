@extends('admin.layouts.app')

@section('title', 'Import History')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="fw-bold mb-0">Product Import History</h4>

    <a href="/admin/products/import" class="btn btn-primary">
        + New Import
    </a>
</div>

<div class="card shadow-sm border-0">
    <div class="card-body p-0">

        <table class="table table-hover mb-0">
            <thead class="table-light">
                <tr>
                    <th>#</th>
                    <th>File Name</th>
                    <th>Status</th>
                    <th>Total Rows</th>
                    <th>Imported</th>
                    <th>Failed</th>
                    <th>Started At</th>
                    <th class="text-end">Action</th>
                </tr>
            </thead>
            <tbody>

            @forelse ($imports as $import)
                <tr>
                    <td>{{ $import->id }}</td>

                    <td>
                        <span class="fw-semibold">
                            {{ $import->file_name }}
                        </span>
                    </td>

                    <td>
                        @if($import->status === 'completed')
                            <span class="badge bg-success">Completed</span>
                        @elseif($import->status === 'processing')
                            <span class="badge bg-warning text-dark">Processing</span>
                        @else
                            <span class="badge bg-danger">Failed</span>
                        @endif
                    </td>

                    <td>{{ $import->total_rows }}</td>
                    <td>{{ $import->success_rows }}</td>
                    <td>{{ $import->failed_rows }}</td>

                    <td>
                        {{ $import->created_at->format('d M Y, h:i A') }}
                    </td>

                    <td class="text-end">
                        @if($import->failed_rows > 0)
                            <a href="/admin/imports/{{ $import->id }}/failed"
                               class="btn btn-sm btn-outline-danger">
                                View Failed
                            </a>
                        @else
                            <span class="text-muted">—</span>
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="8" class="text-center text-muted py-4">
                        No import history found.
                    </td>
                </tr>
            @endforelse

            </tbody>
        </table>

    </div>
</div>

@endsection

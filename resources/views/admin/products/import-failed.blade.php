@extends('admin.layouts.app')

@section('title', 'Failed Import Rows')

@section('content')

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="fw-bold mb-0">Failed Import Rows</h4>

        <a href="/admin/imports" class="btn btn-light">
            ← Back to Import History
        </a>
    </div>

    <div class="card shadow-sm border-0">
        <div class="card-body p-0">

            <table class="table table-bordered table-hover mb-0">
                <thead class="table-light">
                    <tr>
                        <th>Row #</th>
                        <th>Row Data</th>
                        <th>Error Message</th>
                    </tr>
                </thead>
                <tbody>

                    @forelse ($rows as $row)
                                        <tr>
                                            <td>{{ $row->row_number }}</td>

                                            <td>
                                                <pre class="mb-0 small">
                        {{ json_encode($row->row_data, JSON_PRETTY_PRINT) }}
                                                </pre>
                                            </td>

                                            <td class="text-danger fw-semibold">
                                                {{ $row->error_message }}
                                            </td>
                                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="text-center text-muted py-4">
                                No failed rows found.
                            </td>
                        </tr>
                    @endforelse

                </tbody>
            </table>

        </div>
    </div>

@endsection
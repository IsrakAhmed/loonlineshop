@extends('backEnd.layouts.master')

@section('title', 'Manage Fraud APIs')

@section('content')
<div class="container py-4">
    <h4 class="mb-4 fw-bold text-primary">🔒 Manage Fraud APIs</h4>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <form action="{{ route('fraudapi.update') }}" method="POST">
        @csrf
        <div class="table-responsive">
            <table class="table table-bordered align-middle text-center shadow-sm">
                <thead class="table-primary">
                    <tr>
                        <th style="width: 5%;">#</th>
                        <th style="width: 15%;">Type</th>
                        <th style="width: 30%;">API URL</th>
                        <th style="width: 30%;">API Key</th>
                        <th style="width: 10%;">Active</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($fraudapis as $index => $api)
                        <tr>
                            <td class="fw-semibold">{{ $index + 1 }}</td>
                            
                            <td>
                                <span class="badge bg-info text-dark px-3 py-2 fs-6">{{ $api->type }}</span>
                            </td>

                            <td>
                                <input type="text" 
                                       name="apis[{{ $api->id }}][url]" 
                                       value="{{ old('apis.'.$api->id.'.url', $api->url) }}" 
                                       class="form-control border-primary" 
                                       required>
                            </td>
                            <td>
                                <input type="text" 
                                       name="apis[{{ $api->id }}][api_key]" 
                                       value="{{ old('apis.'.$api->id.'.api_key', $api->api_key) }}" 
                                       class="form-control border-primary" 
                                       required>
                            </td>
                            <td>
                                <div class="form-check d-flex justify-content-center">
                                    <input class="form-check-input" 
                                           type="radio" 
                                           name="active_api_id" 
                                           value="{{ $api->id }}" 
                                           {{ old('active_api_id', $api->active_status ? $api->id : null) == $api->id ? 'checked' : '' }}>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="text-end mt-4">
            <button type="submit" class="btn btn-success px-4 py-2">
                💾 Save Changes
            </button>
        </div>
    </form>
</div>




<div class="page-title-box d-flex align-items-center justify-content-center">
    <style>
        .btn-custom-primary {
            background: #1e88e5;
            border: none;
            color: #fff;
            font-weight: 600;
            box-shadow: 0 4px 15px rgba(30, 136, 229, 0.4);
            transition: background 0.3s ease, box-shadow 0.3s ease;
            padding: 12px 30px;
            font-size: 1rem;
            border-radius: 30px;
        }
        .btn-custom-primary:hover {
            background: #1565c0;
            box-shadow: 0 6px 20px rgba(21, 101, 192, 0.6);
            color: #fff;
        }

        .btn-dev-support {
            background-color: rgb(104, 6, 173);
            color: #ffffff;
            font-weight: 600;
            border: none;
            border-radius: 30px;
            box-shadow: 0 4px 12px rgba(75, 0, 130, 0.3);
            transition: all 0.3s ease;
            padding: 12px 30px;
            font-size: 1rem;
        }

        .btn-dev-support:hover {
            background-color: rgb(89, 4, 155);
            box-shadow: 0 6px 20px rgba(55, 0, 98, 0.5);
            color: #fff;
        }

        .btn-custom-primary i,
        .btn-dev-support i {
            vertical-align: middle;
        }
    </style>

    <div class="page-title-right d-flex gap-3">
        <a href="{{ config('app.url') }}" target="_blank" class="btn btn-custom-primary">
            <i class="mdi mdi-web me-1"></i> Visit Website
        </a>
        <a href="http://www.websolutionltd.com/" target="_blank" class="btn btn-dev-support">
            <i class="mdi mdi-headset me-1"></i> Developer Support
        </a>
    </div>
</div>

@endsection

@extends('layouts.app')
@section('content')
    <main id="main-container">
        <div class="content content-max-width">
            <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
                <h1 class="flex-sm-fill font-size-h2 font-w400 mt-2 mb-0 mb-sm-2">{{ __('DawnstarLang::admin.edit_title') }}</h1>
            </div>
        </div>

        <div class="content">
            <form action="#" method="POST">
                <input type="hidden" name="_method" value="PUT">
                @csrf
                <div class="block block-rounded">
                    <div class="block-header block-header-default block-header-rtl">
                        <div class="block-options">
                            <a href="{{ route('clinics.index') }}" class="btn btn-sm btn-outline-secondary">
                                <i class="fa fa-arrow-left"></i>
                                {{ __('DawnstarLang::general.go_back') }}
                            </a>
                            <button type="reset" class="btn btn-sm btn-outline-danger">
                                <i class="fa fa-sync"></i>
                                {{ __('DawnstarLang::general.refresh') }}
                            </button>
                            <button type="submit" class="btn btn-sm btn-outline-primary">
                                <i class="fa fa-check"></i>
                                {{ __('DawnstarLang::general.submit') }}
                            </button>
                        </div>
                    </div>
                    <div class="block-content">
                        <div class="row justify-content-center py-sm-3 py-md-5">
                            <div class="col-sm-10 col-md-8">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="d-block">{{ __('DawnstarLang::admin.labels.status') }}</label>
                                            <div class="custom-control custom-radio custom-control-inline custom-control-success custom-control-lg">
                                                <input type="radio" class="custom-control-input" id="status_active" name="status" value="1" {{ old('status') == 1 ? 'checked' : '' }}>
                                                <label class="custom-control-label" for="status_active">{{ __('DawnstarLang::general.status_title.active') }}</label>
                                            </div>
                                            <div class="custom-control custom-radio custom-control-inline custom-control-danger custom-control-lg">
                                                <input type="radio" class="custom-control-input" id="status_passive" name="status" value="3" {{ old('status') == 3 ? 'checked' : '' }}>
                                                <label class="custom-control-label" for="status_passive">{{ __('DawnstarLang::general.status_title.passive') }}</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="name">{{ __('DawnstarLang::admin.labels.fullname') }}</label>
                                            <input type="text" class="form-control" id="fullname" name="fullname" value="{{ old('fullname') }}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </main>
@endsection


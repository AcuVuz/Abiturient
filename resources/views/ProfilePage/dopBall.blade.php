@extends('layout.layout-2')

@section('styles')
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/bootstrap-select/bootstrap-select.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/bootstrap-tagsinput/bootstrap-tagsinput.css') }}">
    <!-- Page -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/pages/account.css') }}">
    <style>
		.dropdown-menu .show{
			max-height: 200px;
			overflow: hidden scroll;
		}
	</style>
@endsection

@section('scripts')
    <!-- Dependencies -->
    <script src="{{ asset('assets/vendor/libs/bootstrap-select/bootstrap-select.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/bootstrap-tagsinput/bootstrap-tagsinput.js') }}"></script>
    <script>

    </script>
@endsection

@section('content')
    <h4 class="font-weight-bold py-3 mb-4">
        Дополнительные баллы
    </h4>
    <form action="/statement/dop_ball_save" method="POST" enctype="multipart/form-data">
        {{ csrf_field() }}
        <input type="hidden" name="sid" id="sid" value="{{ $sid }}">
        <input type="hidden" name="pid" id="pid" value="{{ $pid }}">
        <div class="card overflow-hidden">
            <div class="row no-gutters row-bordered row-border-light">
                <div class="col-md-3 pt-0">
                    <div class="list-group list-group-flush account-settings-links">
                        <a class="list-group-item list-group-item-action active" data-toggle="list" href="#info-dop-ball">Дополнительные баллы / льготы</a>
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="info-dop-ball">
                            <div class="card-body pb-2">
                                <div class="col">
                                    <div class="form-row">
                                        <div class="form-group col-md-4">
                                            <label class="form-label">1-й предмет</label>
                                            <select class="form-control" data-style="btn-default" data-icon-base="ion" data-tick-icon="ion-md-checkmark" name="dovuz_one" id="dovuz_one">
                                                <option value="-1"></option>
                                                @foreach ($predmet_dovuz as $pd)
                                                    <option value="{{ $pd->id }}" {{ count($pers_dovuz_arr) > 0 ? isset($pers_dovuz_arr[0]['predmet_id']) ? $pers_dovuz_arr[0]['predmet_id'] == $pd->id ? 'selected' : '' : '' : '' }}>{{ $pd->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label class="form-label">Балл</label>
                                            <input type="text" class="form-control required" name="dovuz_one_ball" id="dovuz_one_ball" value="{{ count($pers_dovuz_arr) > 0 ? isset($pers_dovuz_arr[0]['ball']) ? $pers_dovuz_arr[0]['ball'] : '': '' }}">
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-4">
                                            <label class="form-label">2-й предмет</label>
                                            <select class="form-control" data-style="btn-default" data-icon-base="ion" data-tick-icon="ion-md-checkmark" name="dovuz_two" id="dovuz_two">
                                                <option value="-1"></option>
                                                @foreach ($predmet_dovuz as $pd)
                                                    <option value="{{ $pd->id }}" {{ count($pers_dovuz_arr) > 0 ? isset($pers_dovuz_arr[1]['predmet_id']) ? $pers_dovuz_arr[1]['predmet_id'] == $pd->id ? 'selected' : '' : '' : '' }}>{{ $pd->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label class="form-label">Балл</label>
                                            <input type="text" class="form-control required" name="dovuz_two_ball" id="dovuz_two_ball" value="{{ count($pers_dovuz_arr) > 0 ? isset($pers_dovuz_arr[1]['ball']) ? $pers_dovuz_arr[1]['ball'] : '': '' }}">
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-4">
                                            <label class="form-label">3-й предмет</label>
                                            <select class="form-control" data-style="btn-default" data-icon-base="ion" data-tick-icon="ion-md-checkmark" name="dovuz_three" id="dovuz_three">
                                                <option value="-1"></option>
                                                @foreach ($predmet_dovuz as $pd)
                                                    <option value="{{ $pd->id }}" {{ count($pers_dovuz_arr) > 0 ? isset($pers_dovuz_arr[2]['predmet_id']) ? $pers_dovuz_arr[2]['predmet_id'] == $pd->id ? 'selected' : '' : '' : '' }}>{{ $pd->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label class="form-label">Балл</label>
                                            <input type="text" class="form-control required" name="dovuz_three_ball" id="dovuz_three_ball" value="{{ count($pers_dovuz_arr) > 0 ? isset($pers_dovuz_arr[2]['ball']) ? $pers_dovuz_arr[2]['ball'] : '': '' }}">
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-4">
                                            <label class="form-label">Награда</label>
                                            <select class="form-control" data-style="btn-default" data-icon-base="ion" data-tick-icon="ion-md-checkmark" name="nagrada" id="nagrada">
                                                <option value="-1"></option>
                                                @foreach ($nagrada_list as $nag)
                                                    <option value="{{ $nag->id }}" {{ isset($pers_nagrada) ? $nag->id == $pers_nagrada->nag_id ? 'selected' : '' : '' }}>{{ $nag->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label class="form-label">Балл</label>
                                            <input type="text" class="form-control required" name="nagrada_ball" id="nagrada_ball" value="{{ isset($pers_nagrada) ? $pers_nagrada->ball : '' }}">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Льгота</label>
                                        <select class="form-control" data-style="btn-default" data-icon-base="ion" data-tick-icon="ion-md-checkmark" name="lgota" id="lgota">
                                            <option value="-1"></option>
                                            @foreach ($lgota_list as $lgot)
                                                <option value="{{ $lgot->id }}" {{ isset($pers_lgota) ? $lgot->id == $pers_lgota->lgot_id ? 'selected' : '' : '' }}>{{ $lgot->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <label class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" name="marafon" id="marafon" value="T" {{ isset($pers_marafon) ? 'checked' : '' }} >
                                    <span class="custom-control-label">Участие в марафоне</span>
                                </label>
                                <label class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" name="celevoe" id="celevoe" value="T" {{ isset($pers_celevoe) ? 'checked' : '' }} >
                                    <span class="custom-control-label">Целевое место</span>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="text-right mt-3">
            <button type="submit" class="btn btn-primary">Сохранить</button>&nbsp;
        </div>
    </form>
@endsection

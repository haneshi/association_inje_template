<form id="frm-edit" autocomplete="off" novalidate>
    <input type="hidden" name="pType" value="setAdmin">
    <input type="hidden" name="id" value="{{ $view->id }}">
    <div class="card-body">
        <div class="row g-3">
            <div class="col-md">
                <label for="user_id" class="form-label">아이디</label>
                <input type="text" class="form-control" id="user_id" name="user_id" value="{{ $view->user_id }}"
                    disabled>
            </div>
            <div class="col-md">
                <label for="name" class="form-label">이름</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ $view->name }}">
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <div class="form-check form-switch">
                        <input class="form-check-input ms-auto mt-1" type="checkbox" id="is_active"
                            name="is_active" @if ($view->is_active) checked @endif>
                        <label class="form-check-label ms-2" for="is_active">사용유무</label>
                    </div>
                </div>
            </div>
        </div>
        <hr class="horizontal dark">
        <div class="d-flex justify-content-end gap-2">
            <a href="{{ route('admin.setting.manager') }}" class="btn btn-outline-secondary">목록으로</a>
            <button id="submitBtn" type="submit" class="btn btn bg-gradient-warning">관리자 정보 수정</button>
        </div>
    </div>
</form>
@section('afterScript')
    @parent
    <script>
        const procEditValidator = new JustValidate('#frm-edit', apps.plugins.JustValidate.basic());
        procEditValidator
            .onSuccess((e) => {
                e.preventDefault();
                common.ajax.postFormSelector('{{ route('admin.setting.data') }}', '#frm-edit');
            })
            .addField('#name', [{
                rule: 'required',
                errorMessage: '이름을 입력해 주세요!'
            }, ]);
    </script>
@endsection

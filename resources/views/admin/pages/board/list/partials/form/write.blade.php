@section('afterStyle')
    <link rel="stylesheet" href="{{ asset('assets/plugins/ckeditor/css/ckeditor.min.css') }}">
    @if ($board->is_period)
        <link href="{{ asset('assets/plugins/litepicker/css/litepicker.min.css') }}" rel="stylesheet" />
    @endif
@endsection
<div class="row">
    <div class="flex-fill">
        <div class="card">
            <div class="card-header pb-0">
                <div class="d-flex align-items-center">
                    <p class="mb-0">{{ $pageData['title'] }} 추가</p>
                </div>
            </div>
            <div class="card-body">
                <form id="frm" autocomplete="off" novalidate>
                    <input type="hidden" name="pType" value="addPension">

                    @if ($board->is_fixed)
                        <div class="col-md-12">
                            <div class="form-group">
                                <div class="form-check form-switch">
                                    <input class="form-check-input ms-auto mt-1" type="checkbox" id="is_fixed"
                                        name="is_fixed">
                                    <label class="form-check-label ms-2" for="is_active">알림고정</label>
                                </div>
                            </div>
                        </div>
                    @endif

                    @if ($board->is_period)
                        <div class="col-md">
                            <label class="form-label">게시기간</label>
                            <div class="row">
                                <div class="col-md">
                                    <label for="start_date" class="form-label">시작일</label>
                                    <div class="row g-1">
                                        <div class="col">
                                            <input type="text" class="form-control" id="start_date"
                                                name="start_date">
                                        </div>
                                        <div class="col-auto">
                                            <button type="button" class="btn btn-muted btn-icon"
                                                onclick="common.resetValueId('start_date', '')">
                                                <x-tabler-reload />
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md">
                                    <label for="end_date" class="form-label">종료일</label>
                                    <div class="row g-1">
                                        <div class="col">
                                            <input type="text" class="form-control" id="end_date" name="end_date">
                                        </div>
                                        <div class="col-auto">
                                            <button type="button" class="btn btn-muted btn-icon"
                                                onclick="common.resetValueId('end_date', '')">
                                                <x-tabler-reload />
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="title" class="form-control-label">제목<span
                                    class="text-danger">*</span></label>
                            <input class="form-control" type="text" id="title" name="title"
                                placeholder="Enter title" required>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="col-md">
                            <label for="content" class="form-label">내용</label>
                            <textarea class=".ck5-content" id="content" name="content"></textarea>
                        </div>
                    </div>
                    <hr class="horizontal dark">
                    <div class="col-md-12">
                        <div class="form-group">
                            <div class="form-check form-switch">
                                <input class="form-check-input ms-auto mt-1" type="checkbox" id="is_active"
                                    name="is_active">
                                <label class="form-check-label ms-2" for="is_active">사용유무</label>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-end gap-2">
                        <a href="{{ route('admin.pension', $paramData) }}" class="btn btn-outline-secondary">목록으로</a>
                        <button id="submitBtn" type="submit" class="btn btn bg-gradient-primary">게시글 작성</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@section('afterScript')
    <script src="{{ asset('assets/plugins/ckeditor/js/ckeditor.js') }}"></script>
    <script src="{{ asset('assets/plugins/ckeditor/js/editor.js') }}"></script>
    @if ($board->is_period)
        <script src="{{ asset('assets/plugins/litepicker/js/litepicker.min.js') }}"></script>
        <script>
            setEditor.ckeditor.classic('#content');

            common.litepicker('start_date');
            common.litepicker('end_date');
        </script>
    @endif
@endsection

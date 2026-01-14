@section('beforeStyle')
    <link rel="stylesheet" href="{{ asset('assets/plugins/uppy/uppy.min.css') }}?v={{ env('SITES_ADMIN_ASSETS_VERSION') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/ckeditor/css/ckeditor.min.css') }}">
@endsection
<div class="row">
    <div class="flex-fill">
        <div class="card">
            <div class="card-header pb-0">
                <div class="d-flex align-items-center">
                    <p class="mb-0">{{ $pageData['title'] }}</p>
                </div>
            </div>
            <div class="card-body">
                <form id="frm" autocomplete="off" novalidate>
                    <input type="hidden" name="pType" value="addBoardPost">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="name" class="form-control-label">대표이미지<span
                                    class="text-danger">*</span></label>
                            <input type="file" id="image" name="image" class="form-control"
                                placeholder="대표이미지를 입력해주세요!" value="">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="title" class="form-control-label">제목<span
                                    class="text-danger">*</span></label>
                            <input class="form-control" type="text" id="title" title="title"
                                placeholder="제목을 입력해주세요" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="mb-3">
                            <div class="d-flex align-items-center">
                                <p class="mb-0">등록할 이미지</p>
                            </div>
                            <div class="mb-1 p-2 bg-gradient-warning text-white opacity-8">
                                <small>최대 5개 이미지 업로드 가능 (최대 10MB, 이미지 파일만 허용)</small><br>
                                <small>5개 이상일때는 우선 5개 업로드 후 추가해 주세요!</small>
                            </div>
                            <div id="drop-area"></div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="col-md">
                            <label for="content" class="form-label">내용</label>
                            <textarea class=".ck5-content" id="content" name="content"></textarea>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <div class="form-check form-switch">
                                <input class="form-check-input ms-auto mt-1" type="checkbox" id="is_active"
                                    name="is_active">
                                <label class="form-check-label ms-2" for="is_active">사용유무</label>
                            </div>
                        </div>
                    </div>
                    <hr class="horizontal dark">
                    <div class="d-flex justify-content-end gap-2">
                        <a href="{{ route('admin.pension', $paramData) }}" class="btn btn-outline-secondary">목록으로</a>
                        <button id="submitBtn" type="submit" class="btn btn bg-gradient-primary">펜션 추가</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@section('afterScript')
    <script src="{{ asset('assets/plugins/ckeditor/js/ckeditor.js') }}"></script>
    <script src="{{ asset('assets/plugins/ckeditor/js/editor.js') }}"></script>
    <script src="{{ asset('assets/plugins/validation/just-validate.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/uppy/uppy.min.js') }}"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            setEditor.ckeditor.classic('#content');
            const uppy = new Uppy.Uppy({
                    autoProceed: false, // 파일 추가 시 자동 업로드 방지
                    restrictions: {
                        maxFileSize: 10000000, // 10MB 제한
                        maxNumberOfFiles: 5, // 최대 5개 파일
                        allowedFileTypes: ['image/*'], // 이미지 파일만 허용
                    },
                })
                .use(Uppy.Dashboard, {
                    target: '#drop-area',
                    inline: true,
                    showProgressDetails: true,
                    note: '이미지 파일만 업로드 가능 (최대 10MB, 최대 5개)',
                    height: 320,
                    width: '100%',
                    hideUploadButton: true, // 업로드 버튼 숨기기
                });
            const procAddValidator = new JustValidate('#frm', apps.plugins.JustValidate.basic());
            procAddValidator.onSuccess((e) => {
                    e.preventDefault();

                    const form = document.getElementById('frm');
                    const formData = new FormData(form);

                    const files = uppy.getFiles();
                    files.forEach((file, index) => {
                        formData.append(`images[${index}]`, file.data);
                    });
                    common.ajax.postFormData('{{ route('admin.board.data', $board->board_name) }}', formData);
                })
                .addField('#title', [{
                    rule: 'required',
                    errorMessage: '펜션명을 입력해주세요.',
                }, ])
        });
    </script>
@endsection

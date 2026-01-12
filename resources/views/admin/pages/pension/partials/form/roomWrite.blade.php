@section('afterStyle')
    <link rel="stylesheet" href="{{ asset('assets/plugins/tagify/tagify.css') }}?v={{ env('SITES_ADMIN_ASSETS_VERSION') }}">
@endsection
<form id="frm-room-write" autocomplete="off" novalidate>
    <input type="hidden" name="pType" value="addRoom">
    <input type="hidden" name="pension_id" value="{{ $pension->id }}">
    <div class="row">
        <div class="col-md-3">
            <div class="form-group">
                <label for="name" class="form-control-label">객실명<span class="text-danger">*</span></label>
                <input class="form-control" type="text" id="name" name="name" placeholder="객실명을 입력해주세요!"
                    required>
            </div>
        </div>
        <div class="col-md-3"></div>
        <div class="row">
            <div class="mb-3">
                <div class="d-flex align-items-center">
                    <p class="mb-0">객실 전경</p>
                </div>
                <div class="mb-1 p-2 bg-gradient-warning text-white opacity-8">
                    <small>최대 5개 이미지 업로드 가능 (최대 10MB, 이미지 파일만 허용)</small><br>
                    <small>5개 이상일때는 우선 5개 업로드 후 추가해 주세요!</small>
                </div>
                <div id="drop-area-room-write">
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label for="person_min" class="form-control-label">기준인원<span class="text-danger">*</span></label>
                <input class="form-control" type="text" id="person_min" name="person_min" placeholder="기준인원을 입력해주세요!"
                    required>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label for="person_max" class="form-control-label">최대인원<span class="text-danger">*</span></label>
                <input class="form-control" type="text" id="person_max" name="person_max" placeholder="최대인원을 입력해주세요!"
                    required>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="shape" class="form-control-label">객실 유형<span class="text-danger">*</span></label>
                <input class="form-control" type="text" id="shape" name="shape"
                    placeholder="예시) 온돌방1, 화장실1, 테라스. . ." required>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="area1" class="form-control-label">객실 면적(㎡)<span class="text-danger">*</span></label>
                <input class="form-control" type="text" id="area1" name="area1" placeholder="면적(㎡)을 입력해주세요!"
                    required>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="area2" class="form-control-label">객실 면적(평)</label>
                <input class="form-control" type="text" id="area2" name="area2" readonly>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="amenities" class="form-control-label">구비시설<span class="text-danger">*</span></label>
                <input class="form-control" type="text" placeholder="예시) TV, WI-FI, 전자렌지, 스타일러" id="amenities"
                    name="amenities" required>
                <small class="text-muted">Enter로 구분하여 입력해주세요!!</small>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12 mb-3">
            <h6 class="mb-3">객실 가격 설정</h6>
        </div>

        <!-- 비수기 -->
        <div class="col-12 mb-4">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-gradient-success">
                    <h6 class="text-white mb-0">
                        <i class="fas fa-snowflake me-2"></i>비수기
                    </h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label class="form-label" for="priceData-off-day">주중</label>
                            <div class="input-group">
                                <input type="text" class="form-control text-end priceOnly" id="priceData-off-day"
                                    name="priceData[off][day]" placeholder="0">
                                <span class="input-group-text">원</span>
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label" for="priceData-off-fri">금요일</label>
                            <div class="input-group">
                                <input type="text" class="form-control text-end priceOnly" id="priceData-off-fri"
                                    name="priceData[off][fri]" placeholder="0">
                                <span class="input-group-text">원</span>
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label" for="priceData-off-holiday">주말/공휴일</label>
                            <div class="input-group">
                                <input type="text" class="form-control text-end priceOnly" id="priceData-off-holiday"
                                    name="priceData[off][holiday]" placeholder="0">
                                <span class="input-group-text">원</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- 준성수기 -->
        <div class="col-12 mb-4">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-gradient-info">
                    <h6 class="text-white mb-0">
                        <i class="fas fa-sun me-2"></i>준성수기
                    </h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label class="form-label" for="priceData-semi-day">주중</label>
                            <div class="input-group">
                                <input type="text" class="form-control text-end priceOnly" id="priceData-semi-day"
                                    name="priceData[semi][day]" placeholder="0">
                                <span class="input-group-text">원</span>
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label" for="priceData-semi-fri">금요일</label>
                            <div class="input-group">
                                <input type="text" class="form-control text-end priceOnly" id="priceData-semi-fri"
                                    name="priceData[semi][fri]" placeholder="0">
                                <span class="input-group-text">원</span>
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label" for="priceData-semi-holiday">주말/공휴일</label>
                            <div class="input-group">
                                <input type="text" class="form-control text-end priceOnly" id="priceData-semi-holiday"
                                    name="priceData[semi][holiday]" placeholder="0">
                                <span class="input-group-text">원</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- 성수기 -->
        <div class="col-12 mb-4">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-gradient-primary">
                    <h6 class="text-white mb-0">
                        <i class="fas fa-fire me-2"></i>성수기
                    </h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label class="form-label" for="priceData-peak-day">주중</label>
                            <div class="input-group">
                                <input type="text" class="form-control text-end priceOnly" id="priceData-peak-day"
                                    name="priceData[peak][day]" placeholder="0">
                                <span class="input-group-text">원</span>
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label" for="priceData-peak-fri">금요일</label>
                            <div class="input-group">
                                <input type="text" class="form-control text-end priceOnly" id="priceData-peak-fri"
                                    name="priceData[peak][fri]" placeholder="0">
                                <span class="input-group-text">원</span>
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label" for="priceData-peak-holiday">주말/공휴일</label>
                            <div class="input-group">
                                <input type="text" class="form-control text-end priceOnly" id="priceData-peak-holiday"
                                    name="priceData[peak][holiday]" placeholder="0">
                                <span class="input-group-text">원</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12 mb-3">
            <label class="form-label" for="info">미리보기 설명</label>
            <textarea id="info" name="info" class="form-control saveFocusOut" rows="7" data-idx=""
                data-name="info"></textarea>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12 mb-3">
            <label class="form-label" for="detail">상세설명</label>
            <textarea id="detail" name="detail" class="form-control saveFocusOut" rows="7" data-idx=""
                data-name="detail"></textarea>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12 mb-3">
            <label class="form-label" for="special">추가설명</label>
            <textarea id="special" name="special" class="form-control saveFocusOut" rows="7" data-idx=""
                data-name="special"></textarea>
        </div>
    </div>
    <div class="col-md-12">
        <div class="form-group">
            <div class="form-check form-switch">
                <input class="form-check-input ms-auto mt-1" type="checkbox" id="is_active" name="is_active">
                <label class="form-check-label ms-2" for="is_active">사용유무</label>
            </div>
        </div>
    </div>
    <hr class="horizontal dark">
    <div class="d-flex justify-content-end gap-2">
        <a href="{{ route('admin.pension', $paramData) }}" class="btn btn-outline-secondary">목록으로</a>
        <button id="submitBtn" type="submit" class="btn btn bg-gradient-warning">객실 추가</button>
    </div>
</form>


@section('afterScript')
    @parent
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // 펜션 객실추가 uppy
            const uppy_room_write = new Uppy.Uppy({
                    autoProceed: false, // 파일 추가 시 자동 업로드 방지
                    restrictions: {
                        maxFileSize: 10000000, // 10MB 제한
                        maxNumberOfFiles: 5, // 최대 5개 파일
                        allowedFileTypes: ['image/*'], // 이미지 파일만 허용
                    },
                })
                .use(Uppy.Dashboard, {
                    target: '#drop-area-room-write',
                    inline: true,
                    showProgressDetails: true,
                    note: '이미지 파일만 업로드 가능 (최대 10MB, 최대 5개)',
                    height: 320,
                    width: '100%',
                    hideUploadButton: true, // 업로드 버튼 숨기기
                });
            const area1Input = document.getElementById('area1');
            const area2Input = document.getElementById('area2');
            area1Input.addEventListener('input', function() {
                const sqMeters = parseFloat(this.value);

                if (!isNaN(sqMeters) && sqMeters > 0) {
                    const pyeong = (sqMeters / 3.3058).toFixed(2);
                    area2Input.value = pyeong;
                } else {
                    area2Input.value = '';
                }
            });

            const amenitiesInput = document.getElementById('amenities');
            let tagify = new Tagify(amenitiesInput);

            const procAddValidator = new JustValidate('#frm-room-write', apps.plugins.JustValidate.basic());
            procAddValidator.onSuccess((e) => {
                    e.preventDefault();
                    const form = document.getElementById('frm-room-write');
                    const formData = new FormData(form);

                    const files = uppy_room_write.getFiles();
                    files.forEach((file, index) => {
                        formData.append(`images[${index}]`, file.data);
                    });

                    const amenitiesData = tagify.value;
                    const amenities = amenitiesData.map(tag => tag.value);
                    formData.set('amenities', JSON.stringify(amenities));

                    common.ajax.postFormData('{{ route('admin.pension.data') }}', formData);
                })
                .addField('#name', [{
                    rule: 'required',
                    errorMessage: '객실명을 입력해주세요!',
                }, ])
                .addField('#person_min', [{
                        rule: 'number',
                        errorMessage: '숫자만 입력 가능합니다!'
                    },
                    {
                        rule: 'required',
                        errorMessage: "기준인원을 입력해주세요!"
                    }
                ])
                .addField('#person_max', [{
                        rule: 'number',
                        errorMessage: '숫자만 입력 가능합니다!'
                    },
                    {
                        rule: 'required',
                        errorMessage: "최대인원을 입력해주세요!"
                    }
                ])
                .addField('#area1', [{
                        rule: 'number',
                        errorMessage: '숫자만 입력 가능합니다!'
                    },
                    {
                        rule: 'required',
                        errorMessage: "면적을 입력해주세요!"
                    }
                ])
                .addField('#shape', [{
                    rule: 'required',
                    errorMessage: '객실유형을 입력해주세요!'
                }, ])
                .addField('#amenities', [{
                    rule: 'required',
                    errorMessage: '구비시설을 입력해주세요!'
                }, ]);
        });
    </script>
@endsection

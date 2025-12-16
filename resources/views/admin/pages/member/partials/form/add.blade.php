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
                    <input type="hidden" name="pType" value="addAdmin">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="avatar" class="form-control-label">프로필 사진</label>
                                <div class="d-flex align-item-center">
                                    <input class="d-none" type="file" id="avatar" name="avatar" accept="image/*">
                                    <span class="avatar avatar-xxl rounded me-2 bg-primary" id="preview-avatar">

                                    </span>
                                    <button type="button" class="btn btn-primary mb-0 align-self-center"
                                        onclick="document.getElementById('avatar').click();">
                                        프로필 사진 추가
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group w-25">
                                <label for="name" class="form-control-label">관리자 이름<span
                                        class="text-danger">*</span></label>
                                <input class="form-control" type="text" id="name" name="name"
                                    placeholder="Enter admin name" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="user_id" class="form-control-label">아이디<span
                                        class="text-danger">*</span></label>
                                <input class="form-control" type="text" id="user_id" name="user_id"
                                    placeholder="Enter admin ID" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="password_confirm" class="form-control-label">비밀번호<span
                                        class="text-danger">*</span></label>
                                <input class="form-control" type="password" id="password_confirm"
                                    name="password_confirm" placeholder="Enter admin password" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="password" class="form-control-label">비밀번호 확인<span
                                        class="text-danger">*</span></label>
                                <input class="form-control" type="password" id="password" name="password"
                                    placeholder="Enter admin password confirm" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="job" class="form-control-label">직업<span
                                        class="text-danger">*</span></label>
                                <input class="form-control" type="text" id="job" name="job"
                                    placeholder="EX. 사무직" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="email" class="form-control-label">Email</label>
                                <input class="form-control" type="text" id="email" name="email"
                                    placeholder="example@example.com">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="address" class="form-control-label">주소</label>
                                <div class="input-group">
                                    <input class="form-control" id="address" name="address"
                                        placeholder="경기도 하남시 덕풍동 . . ." required>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="phone" class="form-control-label">전화</label>
                                <input class="form-control" id="phone" name="phone"
                                    placeholder="010 0000 0000" required>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group w-25">
                                <label for="birth">생년월일</label>
                                <input type="date" class="form-control" id="birth" name="birth"
                                    min="1995-01-01" max="{{ date('Y-m-d') }}" value="1998-01-01">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="profile" class="form-control-label">간단소개</label>
                                <textarea class="form-control" id="profile" name="profile" rows="4" placeholder="Enter description"></textarea>
                            </div>
                        </div>
                    </div>
                    <hr class="horizontal dark">
                    <div class="d-flex justify-content-end gap-2">
                        {{-- <a href="{{ route('admin.manager.users') }}" class="btn btn-outline-secondary">목록으로</a> --}}
                        <button id="submitBtn" type="submit" class="btn btn-primary">관리자 추가</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@section('afterScript')
    <script src="{{ asset('assets/plugins/js/cleave.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/js/cleave-phone.kr.js') }}" \></script>
    <script src="{{ asset('assets/plugins/validation/just-validate.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/js/preview-image.min.js') }}"></script>
    <script>
        const avatarEl = document.getElementById('avatar');
        const previewEl = document.getElementById('preview-avatar');
        avatarEl.addEventListener('change', (e) => actPreviewImage.resizeImageFix(e, previewEl, 150, 150));

        var cleave = new Cleave('#phone', {
            phone: true,
            phoneRegionCode: 'KR'
        });


        const procAddValidator = new JustValidate('#frm', apps.plugins.JustValidate.basic());
        procAddValidator.onSuccess((e) => {
                e.preventDefault();
                common.ajax.postFormSelector('{{ route('admin.setting.data') }}', '#frm');
            }).addField('#user_id', [{
                rule: 'minLength',
                value: 3,
                errorMessage: '아이디는 3자 이상 입력 해주세요!',
            }, {
                validator: (value) => () => {
                    if (value.trim() !== '') {
                        return new Promise((resolve) => {
                            common.ajax.returnFetch(
                                '{{ route('admin.setting.data') }}', {
                                    pType: 'checkUserId',
                                    value
                                }).then(data => {
                                resolve(!data.hasUserId);
                            }).catch(() => {
                                resolve(false);
                            });
                        })
                    }

                    return new Promise((resolve) => {
                        resolve(false);
                    });
                },
                errorMessage: '사용할 수 없는 아이디 입니다.',
            }, ]).addField('#name', [{
                rule: 'required',
                errorMessage: '이름을 입력해주세요!'
            }, ]).addField('#password', [{
                    rule: 'required',
                    errorMessage: '비밀번호를 입력해주세요!'
                },
                {
                    rule: 'minLength',
                    value: 4,
                    errorMessage: '비밀번호는 4자 이상 입력해주세요!'
                },
            ])
            .addField('#password_confirm', [{
                    rule: 'required',
                    errorMessage: '비밀번호 확인을 입력해주세요!'
                },
                {
                    validator: (value, fields) => {
                        if (fields['#password'] && fields['#password'].elem) {
                            const repeatPasswordValue = fields['#password'].elem.value;
                            return value === repeatPasswordValue;
                        }

                        return true;
                    },
                    errorMessage: '비밀번호가 같지 않습니다.',
                },
            ])
            .addField('#job', [{
                rule: 'required',
                errorMessage: '직업을 입력해주세요!',
            }]);
    </script>
@endsection

<div class="row">
    <div class="col-12">
        <div class="card mb-4">
            <div class="card-header pb-0 d-flex justify-content-between align-items-center">
                <h6>관리자 리스트</h6>
                <a href="{{ route('admin.setting.member.add') }}" class="btn btn-sm btn-primary mb-0">
                    <x-tabler-plus />관리자 추가
                </a>
            </div>
            <div class="card-body px-0 pt-0 pb-2">
                <div class="table-responsive p-0">
                    <table class="table align-items-center mb-0">
                        <thead>
                            <tr>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                    이름
                                </th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                    직업</th>
                                <th
                                    class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                    Phone</th>
                                <th
                                    class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                    생년월일</th>
                                <th class="text-secondary opacity-7"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($admins as $admin)
                                <tr class="@if (!$admin->is_active) bg-danger @endif">
                                    <td>
                                        <a href="{{ route('admin.setting.member.view', $admin->id) }}">
                                            <div class="d-flex px-2 py-1">
                                                <div>
                                                    <img src="{{ $admin->avatar }}" class="avatar avatar-sm me-3">
                                                </div>
                                                <div class="d-flex flex-column justify-content-center">
                                                    <h6 class="mb-0 text-sm">{{ $admin->name }}</h6>
                                                    <p class="text-xs text-secondary mb-0">{{ $admin->email }}</p>
                                                </div>
                                            </div>
                                        </a>
                                    </td>
                                    <td>
                                        <p class="text-xs font-weight-bold mb-0">{{ $admin->job }}</p>
                                        <p class="text-xs text-secondary mb-0">Organization</p>
                                    </td>
                                    <td class="align-middle text-center text-sm">
                                        <span class="badge badge-sm bg-gradient-success">{{ $admin->phone }}</span>
                                    </td>
                                    <td class="align-middle text-center">
                                        <span
                                            class="text-secondary text-xs font-weight-bold">{{ $admin->created_at->format('y.m.d') }}</span>
                                    </td>
                                    <td class="align-middle">
                                        <a href="{{ route('admin.setting.member.view', $admin->id) }}"
                                            class="text-secondary font-weight-bold text-xs" data-toggle="tooltip"
                                            data-original-title="Edit user">
                                            자세히 보기
                                        </a>
                                    </td>
                                </tr>
                            @empty
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            @if (str_contains(url()->current(), 'users'))
                <div class="card-footer d-flex align-items-center">
                    <div class="m-auto"><!-- mx-auto ms-auto -->
                        {{ $admins->onEachSide(1)->withQueryString()->links('admin.components.pagination') }}
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>

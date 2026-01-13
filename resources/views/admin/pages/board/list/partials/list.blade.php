<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header pb-0 d-flex justify-content-between align-items-center">
                <h6>{{ $pageData['name'] }}</h6>
                <div class="ms-md-auto pe-md-3 d-flex align-items-center">
                    <form class="col-auto auto" action="{{ route('admin.travel') }}">
                        <div class="input-icon">
                            <div class="input-group">
                                <span class="input-group-text text-body"><x-tabler-search /></span>
                                <input type="text" id="st" name="st" value="{{ $paramData['st'] }}"
                                    class="form-control" placeholder="게시글명">
                            </div>
                        </div>
                    </form>
                </div>
                <a href="{{ route('admin.travel.write', request()->query()) }}" class="btn btn-sm btn-primary mb-0">
                    <x-tabler-plus />게시글 추가
                </a>
            </div>
            <div class="card-body px-0 pt-0 pb-2">
                <div class="table-responsive p-0">
                    <table class="table align-items-center mb-0">
                        <thead>
                            <tr>
                                <th
                                    class="w-auto text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7">
                                    No</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">제목
                                </th>
                                <th
                                    class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                    사용유무</th>
                                <th
                                    class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                    등록일</th>
                            </tr>
                        </thead>
                        <tbody id="sortTable">
                            @forelse ($dataList as $data)
                                <tr>
                                    <td>
                                        <p class="text-center mb-0"></p>
                                    </td>
                                    <td>
                                        <a href="">{{ $data->title }}</a>
                                    </td>
                                    <td>
                                        <p class="text-xs font-weight-bold mb-0">{{ $data->address_basic }}</p>
                                    </td>
                                    <td class="align-middle text-center text-sm">
                                        <span
                                            class="badge badge-sm bg-gradient-{{ $data->is_active ? 'success' : 'danger' }}">{{ $data->is_active ? '사용중' : '미사용' }}</span>
                                    </td>
                                    <td class="align-middle text-center">
                                        <span
                                            class="text-secondary text-xs font-weight-bold">{{ $data->created_at->format('y.m.d') }}</span>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td class="text-center text-w p-5" colspan="20">
                                        @if (isset($paramData['st']))
                                            검색하신 [ {{ $paramData['st'] }} ]
                                        @else
                                            등록된
                                        @endif 게시글가 없습니다.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

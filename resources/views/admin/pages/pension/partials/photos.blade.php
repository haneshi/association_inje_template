<div class="row g-2 mb-3 sorTable">
    @foreach ($files as $index => $image)
        <div data-id="{{ $image->id }}" class="col-6 col-md-4">
            <div class="position-relative">
                <div class="image-container drop-area-image">
                    <img src="{{ $image->preview }}" alt="{{ $image->filename }}" class="w-100 h-100"
                        style="object-fit: cover;" />
                </div>
                <!-- 삭제 버튼 (오른쪽 위) -->
                <button type="button" class="btn btn-danger btn-sm position-absolute"
                    style="top: 10px; right: 10px; z-index: 10;" onclick="deleteImage({{ $image->id }})">
                    <x-tabler-trash />
                </button>
                <!-- 숫자 (왼쪽 위) -->
                <span class="handle badge bg-primary position-absolute cursor-pointer"
                    style="top: 10px; left: 10px; z-index: 10;">
                    {{ $index + 1 }}
                </span>
            </div>
        </div>
    @endforeach
</div>
@section('afterScript')
    @parent
    <script>
        document.querySelectorAll('.sorTable').forEach(element => {
            new Sortable(element, {
                animation: 150,
                handle: '.handle',
                onEnd: function(e) {
                    const seqIdxes = [];
                    element.querySelectorAll('[data-id]').forEach(item => {
                        seqIdxes.push(item.getAttribute('data-id'));
                    });

                    if (seqIdxes.length > 1) {
                        common.ajax.postJson('{{ route('admin.pension.data') }}', {
                            pType: 'setImagesSeq',
                            seqIdxes
                        });
                    }
                }
            });
        });
        window.deleteImage = function(id) {
            if (confirm('선택된 이미지를 삭제하시겠습니까?')) {
                common.ajax.postJson('{{ route('admin.pension.data') }}', {
                    pType: 'deleteImages',
                    id
                });
            }
        };
    </script>
@endsection
